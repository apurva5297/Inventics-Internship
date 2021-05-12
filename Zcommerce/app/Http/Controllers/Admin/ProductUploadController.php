<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Product;
use App\Shop;
use Session;
use Auth;
use App\Inventory;
use App\Category;
use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\Validations\ExportCategoryRequest;
use App\Http\Requests\Validations\ProductUploadRequest;
use App\Http\Requests\Validations\ProductImportRequest;

class ProductUploadController extends Controller
{

	private $failed_list = [];

	/**
	 * Show upload form
	 *
     * @return \Illuminate\Http\Response
	 */
	public function showForm()
	{
        return view('admin.product._upload_form');
	}

	/**
	 * Upload the csv file and generate the review table
	 *
	 * @param  ProductUploadRequest $request
     * @return \Illuminate\Http\Response
	 */
	public function upload(ProductUploadRequest $request)
	{
		$path = $request->file('products')->getRealPath();
		$rows = array_map('str_getcsv', file($path));
		$rows[0] = array_map('strtolower', $rows[0]);
	    array_walk($rows, function(&$a) use ($rows) {
	      $a = array_combine($rows[0], $a);
	    });
	    array_shift($rows); # remove header column

        return view('admin.product.upload_review', compact('rows'));
	}

	/**
	 * Perform import action
	 *
	 * @param  ProductImportRequest $request
     * @return \Illuminate\Http\Response
	 */
	public function import(ProductImportRequest $request)
	{
		// Reset the Failed list
		$this->failed_list = [];

		foreach ($request->input('data') as $row) {
			$data = unserialize($row);

			// Ignore if the name field is not given
			if( ! $data['name'] || ! $data['categories'] ){
				$reason = $data['name'] ? trans('help.invalid_category') : trans('help.name_field_required');
				$this->pushIntoFailed($data, $reason);
				continue;
			}

			// If the slug is not given the make it
			if( ! $data['slug'] )
				$data['slug'] = str_slug($data['name'], '-');

			// Ignore if the slug is exist in the database
			$product = Product::select('slug')->where('slug', $data['slug'])->first();
			if( $product ){
				$this->pushIntoFailed($data, trans('help.slug_already_exist'));
				continue;
			}

			// Find categories and make the category_list. Ignore the row if category not found
			$data['category_list'] = Category::whereIn('slug', explode(',', $data['categories']))->pluck('id')->toArray();
			if( empty($data['category_list']) ){
				$this->pushIntoFailed($data, trans('help.invalid_category'));
				continue;
			}
				

			// Create the product and get it, If failed then insert into the ignored list
			$result=$this->createProduct($data);
			if( ! $this->createInventory($result,$request) ){
				$this->pushIntoFailed($data, trans('help.input_error'));
				continue;
			}
		}

        $request->session()->flash('success', trans('messages.imported', ['model' => trans('app.products')]));

        $failed_rows = $this->getFailedList();

		if(!empty($failed_rows))
	        return view('admin.product.import_failed', compact('failed_rows'));

        return redirect()->route('admin.catalog.product.index');
	}

	/**
	 * Create Product
	 *
	 * @param  array $product
	 * @return App\Product
	 */

	 public function createInventory($data,$request)
    {	

    	return true;
    	
    	$key[]=1;
        $inventory = Inventory::create([
                        'shop_id' =>$data->shop_id,
                        'title'=>$data->name,
                        'product_id'=>$data->id,
                        'brand'=>$data->brand,    
                        'sku'=>$data->model_number,
                        'condition'=>'New',
                        'is_sample'=>$data->is_sample,
                        'condition_note'=>'Latest Collection',
                        'description'=>$data->description,
                     	'key_features'=>$key,
                        'purchase_price'=>$data->purchase_price,
                        'stock_quantity'=>$data->stock_quantity,
                        'min_order_quantity'=>$data->min_order_quantity,
                        'user_id'=>$data->user_id,
                        'set_size'=>$data->set_size,
                        'set_desc'=>$data->set_desc,
                        'sale_price'=>$data->sale_price,
                        'free_shipping'=>1,
                        'slug'=>$data->slug,
                        'meta_title'=>$data->name,
                        'meta_description'=>$data->description,
                        'active'=>1
                    ]);


        $image=json_decode($data->image);
    
            foreach ($image as $row) {
           
              if ($row)
                $inventory->saveImageFromUrl($row, Null);
            }
        return $inventory;
    }
	private function createProduct($data)
	{
		if($data['origin_country'])
			$origin_country = DB::table('countries')->select('id')->where('iso_3166_2', strtoupper($data['origin_country']))->first();

		if($data['manufacturer'])
			$manufacturer = Manufacturer::firstOrCreate(['name' => $data['manufacturer']]);
		$shopid=Auth::user()->merchantId();
		//print_r($ownerid);exit();
		/*$shop_id = Shop::select('id')->where('owner_id', $ownerid)->first();*/
		/*print_r($shop_id);exit()*/;
		// Create the product
		$product = Product::create([
						'shop_id'=>$shopid,
						'name' => $data['name'],
						'slug' => $data['slug'].'-'.rand(),
						'model_number' => $data['model_number'],
						'description' => $data['description'],
						'gtin' => $data['gtin'],
						'gtin_type' => $data['gtin_type'],
						'mpn' => $data['mpn'],
						'brand' => $data['brand'],
						'origin_country' => isset($origin_country) ? $origin_country->id : Null,
						'manufacturer_id' => isset($manufacturer) ? $manufacturer->id : Null,
						'min_price' => ($data['minimum_price'] && $data['minimum_price'] > 0) ? $data['minimum_price'] : 0,
						'max_price' => ($data['maximum_price'] && $data['maximum_price'] > $data['minimum_price']) ? $data['maximum_price'] : Null,
						'model_number' => $data['model_number'],
						'requires_shipping' => strtoupper($data['requires_shipping']) == 'TRUE' ? 1 : 0,
						'active' => strtoupper($data['active']) == 'TRUE' ? 1 : 0,
					]);

		// Sync categories
		if($data['category_list'])
            $product->categories()->sync($data['category_list']);

		// Upload featured image
        if ($data['image_link'])
            $product->saveImageFromUrl($data['image_link'], true);

		// Sync tags
		if($data['tags'])
            $product->syncTags($product, explode(',', $data['tags']));

        $product['set_desc']=$data['set_desc'];
        $product['set_size']=$data['set_size'];
        $product['sale_price']=$data['sale_price'];
        $product['is_sample']=$data['is_sample'];
        $product['min_order_quantity']=$data['min_order_quantity'];
        $product['stock_quantity']=$data['stock_quantity'];
        $product['purchase_price']=$data['mrp'];
        $product['image']=$data['in_image'];

		return $product;
	}

	/**
	 * [downloadCategorySlugs]
	 *
	 * @param  Excel  $excel
	 */
	public function downloadCategorySlugs(ExportCategoryRequest $request)
	{
		$categories = Category::select('name','slug')->get();

		return (new FastExcel($categories))->download('categories.xlsx');
	}

	/**
	 * downloadTemplate
	 *
	 * @return response response
	 */
	public function downloadTemplate()
	{
		$pathToFile = public_path("csv_templates/products.csv");

		return response()->download($pathToFile);
	}


	/**
	 * [downloadFailedRows]
	 *
	 * @param  Excel  $excel
	 */
	public function downloadFailedRows(Request $request)
	{
		foreach ($request->input('data') as $row)
			$data[] = unserialize($row);

		return (new FastExcel(collect($data)))->download('failed_rows.xlsx');
	}

	/**
	 * Push New value Into Failed List
	 *
	 * @param  array  $data
	 * @param  str $reason
	 * @return void
	 */
	private function pushIntoFailed(array $data, $reason = Null)
	{
		$row = [
			'data' => $data,
			'reason' => $reason,
		];

		array_push($this->failed_list, $row);
	}

	/**
	 * Return the failed list
	 *
	 * @return array
	 */
	private function getFailedList()
	{
		return $this->failed_list;
	}
	public function MappingFsnPage(Request $request,$id)
	{
        $marketpalce_id= $request->marketplace_id;
        return view('admin.product.product_fsn_csv',compact('id','marketpalce_id'));
	}
	public function MappingFsnUpload(Request $request)
	{
		if($request->hasFile('products'))
        {
            if($request->products->getClientOriginalExtension()!='csv')
            {
                $ext=$request->products->getClientOriginalExtension();
                session()->flash('danger','Whoops! You can not upload '.$ext.' file.Allowed file type is CSV');
                return back();
            }
            $file = $request->file('products');
            $csv_data =  array_map('str_getcsv',file($file));
            $i=0;
            foreach($csv_data as $row)
            {
				if($i!=0 )
                {
                    DB::table('marketplace_products_data_sync')
                    ->insert(
						['product_id'=>$row[0],
						'zproduct_id'=>$row[1],
                        'market_place_id'=> $request->marketplace_id,
                        'synced'=>'0'
                        ]
                    );
                }
                $i++;
            }
            session()->flash('success', 'CSV Imported Successfully!');
            return redirect()->back();
        }
	}
}
