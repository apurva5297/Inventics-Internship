<?php

namespace App\Repositories\Product;

use Auth;
use App\Product;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use App\Image;

class EloquentProduct extends EloquentRepository implements BaseRepository, ProductRepository
{
	protected $model;

	public function __construct(Product $product)
	{
		$this->model = $product;
	}

	public function all()
	{
        if (Auth::user()->isFromPlatform())
    		return $this->model->with('categories', 'featuredImage', 'image')->withCount('inventories')->get();

        return $this->model->mine()->with('categories', 'featuredImage', 'image')->withCount('inventories')->get();
	}

	public function trashOnly()
	{
        if (Auth::user()->isFromPlatform())
    		return $this->model->onlyTrashed()->with('categories', 'featuredImage')->get();

        return $this->model->mine()->onlyTrashed()->with('categories', 'featuredImage')->get();
	}

    public function store(Request $request)
    {
        $product = parent::store($request);

        if ($request->input('category_list'))
            $product->categories()->sync($request->input('category_list'));

        if ($request->input('tag_list'))
            $product->syncTags($product, $request->input('tag_list'));

        if ($request->hasFile('image'))
            $product->saveImage($request->file('image'), true);

        return $product;
    }

    public function update(Request $request, $id)
    {
        //return $request->input('category_list', []);
        $product = parent::update($request, $id);

        $product->categories()->sync($request->input('category_list', []));

        if ($request->input('tag_list'))
            $product->syncTags($product, $request->input('tag_list', []));

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)){
            if($product->featuredImage)
                $product->deleteImage($product->featuredImage);
        }

        if ($request->hasFile('image'))
            $product->saveImage($request->file('image'), true);

        return $product;
    }

	public function destroy($product)
	{
        if(! $product instanceof Product)
            $product = parent::findTrash($product);

        $product->detachTags($product->id, 'product');

        $product->flushImages();

        if($product->hasFeedbacks())
            $product->flushFeedbacks();

        return $product->forceDelete();
	}

    public function productList(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $start = ($page-1)*10;
        $shop_id = $request->shop_id;
        $order_by = $request->order_by ? $request->order_by : 'desc';
        $category_id = $request->category_id ? $request->category_id : Null;

        return $this->model->with('categories:category_id,name,slug,product_id', 'featuredImage:path,imageable_id', 'images:path,imageable_id')
                            ->where(function($query) use ($shop_id, $category_id){
                                if($shop_id == Null)
                                {
                                    $query->whereNull('shop_id')
                                            ->whereHas('categories',function($query2) use ($category_id){
                                                if($category_id != Null)
                                                    $query2->where('category_id',$category_id);
                                            });
                                }
                                else
                                    $query->where('shop_id',$shop_id);
                            })
                            ->withCount('inventories')
                            ->offset($start)
                            ->take(10)
                            ->orderBy('id',$order_by)
                            ->get();
    }

    public function productDetail(Request $request)
    {
        return $this->model->with('categories:category_id,name,slug,product_id', 'featuredImage:path,imageable_id,id', 'images:path,imageable_id,id','manufacturer:id,name')->find($request->product_id);
    }
    public function productAddUpdate(Request $request)
    {
        $product_data = array(
            'name'            => $request->name,
            'shop_id'         => $request->shop_id,
            'slug'            => str_slug($request->name, '-').'-'.md5(uniqid(rand(), true)),
            'manufacturer_id' => $request->manufacturer_id ? $request->manufacturer_id : null,
            'brand'           => $request->brand ? $request->brand : null,
            'model_number'    => $request->model_number ? $request->model_number : null,
            'mpn'             => $request->mpn ? $request->mpn : null,
            'gtin'            => $request->gtin ? $request->gtin : null,
            'gtin_type'       => $request->gtin_type ? $request->gtin_type : null,
            'description'     => $request->description ? $request->description : null,
            'min_price'       => $request->min_price ? $request->min_price:0,
            'max_price'       => $request->max_price ? $request->max_price : 0,
            'origin_country'  => $request->origin_country ? $request->origin_country : 356,
            'has_variant'     => $request->has_variant ? $request->has_variant : 0,
            'requires_shipping' => $request->requires_shipping ? $request->requires_shipping : 0,
            'downloadable'    => $request->downloadable ? $request->downloadable : null,
            'sale_count'      => $request->sale_count ? $request->sale_count : 0,
            'active'          => $request->active ? $request->active : 1
        );

        //create update product start
        if($request->product_id)
        {
            $product = Product::find($request->product_id);
            $product->update($product_data);
        }
        else
            $product = Product::create($product_data);
        //create update product end
        if ($request->category_list)
        {
            foreach(json_decode($request->category_list) as $product_category)
            {
                $product_cate_data[] = array(
                    'category_id' => $product_category,
                );
            }
            $product->categories()->sync(json_decode($request->category_list));
        }

        if ($request->tag_list)
        {
            foreach(json_decode($request->tag_list) as $tags)
            {
                $tag_data = array(
                    'name' => $tags,
                );
                $product->syncTags($product, $tag_data);
            }
        }
        if ($request->image)
        {
            $count_image = 0;
            foreach(json_decode($request->image) as $image) 
            {
                $image_data = array(
                    'path' => $image,
                    'imageable_id' => $product->id,
                    'name' => str_replace('images/', '', $image),
                    'extension' => '.jpeg',
                    'featured' => $count_image == 0 ? 1:0,
                    'imageable_type' => 'App\Product'
                );
                Image::create($image_data);
                $count_image++;
            }
        }
        return $product;
    }

    public function uploadFile(Request $request)
    {
        $img = str_replace('data:image/jpeg;base64,', '', $request->file);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $folderPath = base_path().'/storage/app/public/images/';
        $file =  time() . '.jpeg';
        $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
        return $success ? 'images/'.$file : 'Unable to save the file.';
    }
}