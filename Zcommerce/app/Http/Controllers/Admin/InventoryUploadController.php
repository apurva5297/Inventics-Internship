<?php

// No WORK DONE YET

namespace App\Http\Controllers\Admin;

use DB;
use App\Product;
use App\Category;
use App\Inventory;
use App\Manufacturer;
use Auth;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Http\Requests\Validations\ExportCategoryRequest;
use App\Http\Requests\Validations\ProductUploadRequest;
use App\Http\Requests\Validations\ProductImportRequest;
use Carbon\Carbon;
class InventoryUploadController extends Controller
{

	private $failed_list = [];

	/**
	 * Show upload form
	 *
     * @return \Illuminate\Http\Response
	 */
	public function showForm()
	{
        return view('admin.inventory._upload_form');
	}

	/**
	 * Upload the csv file and generate the review table
	 *
	 * @param  ProductUploadRequest $request
     * @return \Illuminate\Http\Response
	 */

	public function inventoryUpload(ProductUploadRequest $request)
	{
		$path = $request->file('products')->getRealPath();
		$rows = array_map('str_getcsv', file($path));
		$i=0;
		$j=0;
		$product=array();
		$key[]=1;
		foreach ($rows as $result) {
			if ($i != 0) {
				if (isset($result[0]) && $result[2] !='' && $result[3] !='' && $result[4] !='') {
					$data=Product::where('name',trim($result[0]))->first();
					if($data)
					{
						$product[]=array(
							'shop_id' =>Auth::user()->merchantId(),
	                        'title'=>$data->name,
	                        'product_id'=>$data->id,
	                        'brand'=>$data->brand,    
	                        'sku'=>isset($result[2])?$result[2]:0,
	                        'condition'=>'New',
	                        'barcode'	=>isset($result[5]) && $result[5]>0?$result[5]:0,
	                        'is_sample'=>0,
	                        'condition_note'=>'Latest Collection',
	                        'description'=>$data->description,
	                     	'key_features'=>$key,
	                        'purchase_price'=>isset($result[4])?$result[4]:0,
	                        'stock_quantity'=>isset($result[7])?$result[7]:0,
	                        'min_order_quantity'=>1,
	                        'user_id'=>Auth::user()->id,
	                        'set_size'=>'',
	                        'set_desc'=>'',
	                        'sale_price'=>isset($result[3])?$result[3]:0,
	                        'free_shipping'=>1,
	                        'slug'=>isset($result[2])?$result[2]:rand(),
	                        'meta_title'=>$data->name,
	                        'meta_description'=>$data->description,
	                        'active'=>1,
	                        'bin_no'=>isset($result[6])?$result[6]:0
						);
					}
					$j++;
				}	
			}
		 $i++;
		}
		$this->createInventory($product,$request);
		$request->session()->flash('success', trans('messages.imported', ['model' => trans('app.products')]));
		return redirect()->route('admin.stock.inventory.index');
	}

	public function upload(ProductUploadRequest $request)
	{
		$path = $request->file('products')->getRealPath();
		$rows = array_map('str_getcsv', file($path));
		/*barcode update*/
		$i=0;
		$j=0;
		foreach ($rows as $result) {
			if ($i != 0) {
				if (isset($result[3]) && isset($result[4]) && $result[3] && $result[4] != 'NA') {
					DB::table('inventories')->where('sku',trim($result[3]))->update(array('barcode'=>trim($result[4])));
					$j++;
				}	
			}
		 $i++;
		}

		$request->session()->flash('success', trans('messages.imported', ['model' => trans('app.products')]));
		return redirect()->route('admin.stock.inventory.index');
		/*end*/
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
        if( env('APP_DEMO') )
            return redirect()->route('admin.catalog.product.index')->with('warning', trans('messages.demo_restriction'));

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
			if( ! $this->createProduct($data) ){
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
	private function createProduct($data)
	{
		if($data['origin_country'])
			$origin_country = DB::table('countries')->select('id')->where('iso_3166_2', strtoupper($data['origin_country']))->first();

		if($data['manufacturer'])
			$manufacturer = Manufacturer::firstOrCreate(['name' => $data['manufacturer']]);

		// Create the product
		$product = Product::create([
						'name' => $data['name'],
						'slug' => $data['slug'],
						'model_number' => $data['model_number'],
						'description' => $data['description'],
						'gtin' => $data['gtin'],
						'gtin_type' => $data['gtin_type'],
						'mpn' => $data['mpn'],
						'brand' => $data['brand'],
						'origin_country' => isset($origin_country) ? $origin_country->id : Null,
						'manufacturer_id' => isset($manufacturer) ? $manufacturer->id : 2,
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

		return $product;
	}

	public function createInventory($product,$request)
    {	    	

    	$key[]=1;
    	foreach ($product as $data) {
    		$result=Inventory::where(array('slug'=>$data['slug'],'sku'=>$data['sku']))->get();

    		if (count($result) == 0) {
    			/*warehouse*/
    			$bin_no=DB::table('warehouses_bin')->join('warehouses_zone_group','warehouses_bin.warehouse_zone_group_id','=','warehouses_zone_group.id')->select('warehouses_zone_group.warehouse_id','warehouses_bin.code','warehouses_bin.id','warehouses_bin.id')->where('code',trim($data['bin_no']))->first();

    			$inventory = Inventory::create([
	            'shop_id' =>$data['shop_id'],
	            'title'=>$data['title'],
	            'warehouse_id'=>isset($bin_no->warehouse_id)?$bin_no->warehouse_id:0,
	            'product_id'=>$data['product_id'],
	            'brand'=>$data['brand'],    
	            'sku'=>$data['sku'],
	            'barcode'=>$data['barcode'],
	            'condition'=>'New',
	            'is_sample'=>$data['is_sample'],
	            'condition_note'=>'Latest Collection',
	            'description'=>$data['description'],
	         	'key_features'=>$key,
	            'purchase_price'=>$data['purchase_price'],
	            'stock_quantity'=>$data['stock_quantity'],
	            'min_order_quantity'=>$data['min_order_quantity'],
	            'user_id'=>$data['user_id'],
	            'set_size'=>$data['set_size'],
	            'set_desc'=>$data['set_desc'],
	            'sale_price'=>$data['sale_price'],
	            'free_shipping'=>1,
	            'slug'=>$data['slug'],
	            'meta_title'=>$data['meta_title'],
	            'meta_description'=>$data['meta_description'],
	            'active'=>1
	           ]);
    			/*Assign in Bin*/
    			if (!empty($bin_no)) {
    				$BinData=array(
                    'shop_id'     =>$data['shop_id'],
                    'inventory_id'=>$inventory->id,
                    'qty'         =>$data['stock_quantity'],
                    'bin_id'      =>isset($bin_no->id)?$bin_no->id:0,
                    'bin_code'    =>$data['bin_no'],
                    'created_at'  =>Carbon::now()->toDateTimeString(),
                    'updated_at'  =>Carbon::now()->toDateTimeString()
                    );
    			   DB::table('inventory_bin_storage')->insert($BinData);
    			}
    		}
    	}
        // $image=json_decode($data->image);
    
        //     foreach ($image as $row) {
           
        //       if ($row)
        //         $inventory->saveImageFromUrl($row, Null);
        //     }
        return $inventory;
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
		$product=Product::where('shop_id',Auth::user()->merchantId())->get();
		$csv_data[] = array('Product Id','Model No','SKU','Sale Price','Purchase Price','Bar Code','Bin No','Stock');
			if(count($product) > 0){
				foreach($product as $val) {
					$csv_data[] = array(
						$val->name,
						$val->model_number,
						'',
						'',
						'',
						'',
						'',
						''
					);
				}
			}
		$this->generateCsvFiles('inventory_csv.csv',$csv_data);
	}

	function generateCsvFiles($file_name='realcube.csv',$data=array()){
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename='.$file_name);
		$output = fopen('php://output', 'w');
		if (count($data) > 0) {
			foreach ($data as $row) {
				fputcsv($output, $row);
			}
		}
		exit();
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

	public  function DownloadRecallTemplate(Request $request)
	{	
		$recall=Inventory::where('shop_id',Auth::user()->merchantId())->where('stock_quantity','>',0)->get();
		$csv_data[] = array('TITLE','LISTING ID','SKU','TYPE','AVAILABLE FOR RECALL','QUANTITY TO RECALL','ERRORS');
			if(count($recall) > 0){
				foreach($recall as $val) {
					$total =ListHelper::inventory_bin_stock($val->id);
					if ($total>0) {
						$csv_data[] = array(
						$val->title,
						'Simpel-'.$val->id,
						$val->sku,
						'REGULAR',
						$total,
						'',
						'',
						''
					    );
					}
				}
			}
		$this->generateCsvFiles('recall_csv.csv',$csv_data);
	}

	public function RecallshowForm()
	{
		return view('admin.recall._upload_form');
	}

	public function InwardshowForm()
	{
		return view('admin.inward._upload_form');
	}

	public function DownloadInwardTemplate(Request $request)
	{
		$recall=Inventory::where('shop_id',Auth::user()->merchantId())->get();
		$csv_data[] = array('TITLE','LISTING ID','SKU','TYPE','AVAILABLE QUANTITY','QUANTITY','BIN NO');
			if(count($recall) > 0){
				foreach($recall as $val) {
					$csv_data[] = array(
						$val->title,
						'Simpel-'.$val->id,
						$val->sku,
						'REGULAR',
						ListHelper::inventory_bin_stock($val->id),
						'',
						''
					);
				}
			}
		$this->generateCsvFiles('bin_csv.csv',$csv_data);
	}

	public function ImportInwardTemplate(Request $request)
	{
		$path = $request->file('products')->getRealPath();
		$rows = array_map('str_getcsv', file($path));
		$i=0;
		if (count($rows) > 1001) {
			$request->session()->flash('error', trans('import max count is 1000', ['model' => trans('app.products')]));
			return redirect()->route('admin.stock.inventory.inward');
		}

		$data=array();
		foreach ($rows as $result) {
			if ($i != 0) {
				if ($result[2] !='' && $result[5] > 0 && $result[6] !='') {
					$inventory=Inventory::where('sku',trim($result[2]))->first();
					// get bin
					$bin_id=DB::table('warehouses_bin')->where('code',trim($result[6]))->first();
					if (!empty($bin_id) && !empty($inventory)) {
						/*get already insterd*/
	                	$binInv=DB::table('inventory_bin_storage')->where(array('shop_id'=>Auth::user()->merchantId(),'inventory_id'=>$inventory->id,'bin_id'=>$bin_id->id))->first();

	                	if (!empty($binInv)) {
		                   $total_qty=$result[5]>0?$result[5]:0;
		                   $update=array(
		                    'qty'         =>$total_qty+$binInv->qty,
		                    'updated_at'  =>Carbon::now()->toDateTimeString()
		                    );
		                   DB::table('inventory_bin_storage')->where('id',$binInv->id)->update($update);
		                   /*inceriment*/
		                   $stock_quantity=$inventory->stock_quantity > 0?$inventory->stock_quantity:0;
		                   $total=$stock_quantity+$total_qty;
		                   Inventory::where('id',$inventory->id)->update(array('stock_quantity'=>$total));
		                }else{
		                	$total_qty=$result[5]>0?$result[5]:0;
		                    $data=array(
		                    'shop_id'     =>Auth::user()->merchantId(),
		                    'inventory_id'=>$inventory->id,
		                    'qty'         =>$result[5]>0?$result[5]:0,
		                    'bin_id'      =>isset($bin_id->id)?$bin_id->id:0,
		                    'bin_code'    =>isset($bin_id->code)?$bin_id->code:0,
		                    'created_at'  =>Carbon::now()->toDateTimeString(),
		                    'updated_at'  =>Carbon::now()->toDateTimeString()
		                    );
		                    /*create invetory*/
		                    DB::table('inventory_bin_storage')->insert($data);
		                   /*inceriment*/
		                   $stock_quantity=$inventory->stock_quantity > 0?$inventory->stock_quantity:0;
		                   $total=$stock_quantity+$total_qty;
		                   Inventory::where('id',$inventory->id)->update(array('stock_quantity'=>$total));
		                }
		            }
				}
			}
			$i++;
		}
		$request->session()->flash('success', trans('Inventory Inward SuccessFully', ['model' => trans('app.products')]));
		return redirect()->route('admin.stock.inventory.inward');
	}

	public function ImportRecallTemplate(Request $request)
	{
		$path = $request->file('products')->getRealPath();
		$rows = array_map('str_getcsv', file($path));
		if (count($rows) > 1001) {
			$request->session()->flash('error', trans('import max count is 1000', ['model' => trans('app.products')]));
			return redirect()->route('admin.stock.inventory.inward');
		}
		$i=0;
		$recall=array();
		$picklist=rand();
		foreach ($rows as $result) {
			if ($i != 0) {
				if (isset($result[0]) && $result[2] !='' && $result[3] !='' && $result[4] !='') {
					$inventory=Inventory::where('sku',trim($result[2]))->first();
					/*get all bin*/
					$bins = DB::table('inventory_bin_storage')->where('inventory_id',$inventory->id)->where('qty','!=',0)->orderBy('created_at','asc')->orderBy('qty','asc')->get();
					$total_recall=$result[5];
					$total=0;
					$decrement=0;
					foreach ($bins as $bin) {
						if ($result[5] >= $bin->qty && $total_recall >0) {
							$total_recall-=$bin->qty;
							$total+=$bin->qty;
							$diffrance =abs($result[5] - $total);
							$difault=$bin->qty >= $diffrance ?abs($bin->qty - $diffrance):0;
							$final=$total >$result[5]?$difault:$bin->qty;
							$recall[]=array(
							'shop_id' =>Auth::user()->merchantId(),
	                        'inventory_id'=>$inventory->id,
	                        'sku'=>$inventory->sku,
	                        'stock'=>$result[4],    
	                        'qty'=>$final ,
	                        'bin_storage_id'=>$bin->id,
	                        'bin_id'=>$bin->bin_id,
	                        'bin_code'=>$bin->bin_code,
	                        'picklist'=>$picklist,
	                        'created_at'=>Carbon::now()->toDateTimeString(),
	                        'updated_at'=>Carbon::now()->toDateTimeString()
							);
							/*update*/
							DB::table('inventory_bin_storage')->where(array('inventory_id'=>$inventory->id,'id'=>$bin->id))->decrement('qty',$final);
							/*end*/	
						}elseif ($result[5] <= $bin->qty && $total_recall >0) {
							$diffrance = abs($result[5] - $total);
							$total_recall-=$diffrance;
							$total+=$bin->qty;
							$recall[]=array(
							'shop_id' =>Auth::user()->merchantId(),
	                        'inventory_id'=>$inventory->id,
	                        'sku'=>$inventory->sku,
	                        'stock'=>$result[4],    
	                        'qty'=>$diffrance,
	                        'bin_storage_id'=>$bin->id,
	                        'bin_id'=>$bin->bin_id,
	                        'bin_code'=>$bin->bin_code,
	                        'picklist'=>$picklist,
	                        'created_at'=>Carbon::now()->toDateTimeString(),
	                        'updated_at'=>Carbon::now()->toDateTimeString()
							);
							/*update*/
							DB::table('inventory_bin_storage')->where(array('inventory_id'=>$inventory->id,'id'=>$bin->id))->decrement('qty',$diffrance);
							/*end*/	
						}
					}
					$decrement=$result[5]>0?$result[5]:0;
					Inventory::where('sku',trim($result[2]))->decrement('stock_quantity',$decrement);
				}
			}
		 $i++;
		}
		if (count($recall)>0) {
			DB::table('inventory_recall')->insert($recall);
		}
		$request->session()->flash('success', trans('Inventory Recall SuccessFully', ['model' => trans('app.products')]));
		return redirect()->route('admin.stock.inventory.recall');
	}

	public function getRecall($id)
	{
		$result=DB::table('inventory_recall')->where(array('picklist'=>$id,'shop_id' =>Auth::user()->merchantId()))->get();
		$i=1;
		$csv_data[] = array('NO','LISTING ID','SKU','PICK LIST ID','BIN NO','Qty','Date');
			if(count($result) > 0){
				foreach($result as $val) {
					$csv_data[] = array(
						$i++,
						'Simpel-'.$val->id,
						$val->sku,
						$val->picklist,
						$val->bin_code,
						$val->qty,
						$val->created_at
					);
				}
			}
		$this->generateCsvFiles('recall_csv_download.csv',$csv_data);
	}
	public function MappingFsnPage(Request $request,$id)
	{
        $marketpalce_id= $request->marketplace_id;
        return view('admin.inventory.inventory_fsn_csv',compact('id','marketpalce_id'));
	}
	public function MappingFsnUpload(Request $request)
	{
		if($request->hasFile('inventory'))
        {
            if($request->inventory->getClientOriginalExtension()!='csv')
            {
                $ext=$request->inventory->getClientOriginalExtension();
                session()->flash('danger','Whoops! You can not upload '.$ext.' file.Allowed file type is CSV');
                return back();
            }
            $file = $request->file('inventory');
            $csv_data =  array_map('str_getcsv',file($file));
            $i=0;
            foreach($csv_data as $row)
            {
				if($i!=0 )
                {
                    DB::table('marketplace_inventory_data_sync')
                    ->insert(
						['sku_id'=>$row[0],
						'zsku_id'=>$row[1],
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
