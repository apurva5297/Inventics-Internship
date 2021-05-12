<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Inventory;
use App\Image;
use App\Category;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Inventory\InventoryRepository;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;

class ProductController extends Controller
{
	use ProcessResponseTrait,ValidationTrait;

    public function __construct(ProductRepository $product, InventoryRepository $inventory)
    {
    	$this->product = $product;
        $this->inventory = $inventory;
    }

    public function topViewedProductList(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array();
            $inventory_visit_count = Inventory::join('product_visit_count','product_visit_count.inventories_id','=','inventories.id')->where('product_visit_count.shop_id',$users->shop_id)->orderBy('product_visit_count.hits','desc')->limit(10)->get();
            if(count($inventory_visit_count) < 1)
                $inventory_visit_count = Inventory::where('shop_id',$users->shop_id)->orderBy('id','desc')->limit(10)->get();
            foreach($inventory_visit_count as $inventory)
            {
                $data[] = array(
                    'inventory_id' => $inventory->id,
                    'inventory_shop_id' => $inventory->shop_id,
                    'brand_name' => $inventory->brand,
                    'inventory_name' => $inventory->title,
                    'sku' => $inventory->sku,
                    'detail' => strip_tags($inventory->description),
                    'sale_price' => $inventory->sale_price,
                    'stock_quantity' => $inventory->stock_quantity ? $inventory->stock_quantity : 0,
                    'status' => $inventory->active == 1 ? 'Active':'In-Active',
                    'feature_images' => $inventory->image['path'] ? $inventory->image['path'] : $inventory->product->image['path'],
                    'images' => $inventory->images,
                );
            }
            return $this->processResponse('product_list',$data,'success','Product List');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function productList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $global_shop = $request->global_shop ? $request->global_shop : null;
        	$request->shop_id = $request->global_shop ? Null : $users->shop_id;
            $data = array();
        	$products = $this->product->productList($request);
            //return $products;
            foreach($products as $product)
            {
                $category_id = $product->categories[0]->category_id;
                $sub_cateogry = Category::where('id',$category_id)->first();
                //return $sub_cateogry;
                $data[] = array(
                    'product_id' => $product->id,
                    'products_shop_id' => $product->shop_id,
                    'brand_name' => $product->brand,
                    'product_name' => $product->name,
                    'product_model_number' => $product->model_number,
                    'detail' => strip_tags($product->description),
                    'minimum_price' => $product->min_price,
                    'maximum_price' => $product->max_price,
                    'number_of_sale' => $product->sale_count ? $product->sale_count : 0,
                    'status' => $product->active == 1 ? 'Active':'In-Active',
                    'count_inventory' => $product->inventories_count,
                    'product_sub_category_id' => $sub_cateogry->subGroup['id'],
                    'product_sub_category_name' => $sub_cateogry->subGroup->name,
                    'product_categories' => $product->categories,
                    'feature_images' => $product->featuredImage['path'] ? $product->featuredImage['path'] : "No Image Found",
                    'products_images' => $product->images,

                );
            }
        	return $this->processResponse('product_list',$data,'success','Product List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function productAdd(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$product = array();
        	if(empty($request->category_list))
        		return $this->processResponse('category_not_selected',null,'success','Category Not Selected');

        	if($users->shop_id != null)
            {
            	$request->shop_id = $users->shop_id;
                
        		$product = $this->product->productAddUpdate($request);

                $product_details = Product::where('slug',$product->slug)->first();
                $request->product_id = $product_details->id;
                $request->title = $product_details->name;
                $request->sale_price = $product_details->max_price;
                $request->brand = $product_details->brand;
                $request->sku = $product_details->id.'_'.rand(000,1000);
                $request->min_order_quantity = 1;
                $request->set_size = 1;
                $request->active = 1;
                $request->description = $product_details->description;
                $request->stock_quantity = 1;
                $request->user_id = $users->id;
                $request->shop_id = $users->shop_id;
                $request->image = $request->image;
                $inventory_create = $this->inventory->inventoryAddUpdate($request);
		    }
            return $this->processResponse('product_add',$product,'success','Product Added Successfully');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function globalProductAdd(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            //return json_decode($request->product_id);
            foreach(json_decode($request->products_id) as $product_id)
            {
                $product_details = Product::find($product_id);
                if($product_details)
                {
                    $request->name = $product_details->name;
                    $request->shop_id = $users->shop_id;
                    $request->slug = str_slug($product_details->name, '-').'-'.md5(uniqid(rand(), true));
                    $request->manufacturer_id = $product_details->manufacturer_id ? $product_details->manufacturer_id : null;
                    $request->brand = $product_details->brand ? $product_details->brand : null;
                    $request->model_number = $product_details->model_number ? $product_details->model_number : null;
                    $request->mpn = $product_details->mpn ? $product_details->mpn : null;
                    $request->gtin = $product_details->gtin ? $product_details->gtin : null;
                    $request->gtin_type = $product_details->gtin_type ? $product_details->gtin_type : null;
                    $request->description = $product_details->description ? $product_details->description : null;
                    $request->min_price = $product_details->min_price ? $product_details->min_price:0;
                    $request->max_price = $product_details->max_price ? $product_details->max_price : 0;
                    $request->origin_country = $product_details->origin_country ? $product_details->origin_country : 356;
                    $request->has_variant = $product_details->has_variant ? $product_details->has_variant : 0;
                    $request->requires_shipping = $product_details->requires_shipping ? $product_details->requires_shipping : 0;
                    $request->downloadable = $product_details->downloadable ? $product_details->downloadable : null;
                    $request->sale_count = 0;
                    $request->active = $product_details->active ? $product_details->active : 1;
                    foreach($product_details->categories as $category)
                    {
                        $category_list[] = $category->id;
                    }
                    if(count($category_list) > 0)
                        $request->category_list = json_encode($category_list);

                    // foreach($product_details->images as $image)
                    // {
                    //     $images[] = $image->path;
                    // }

                    // if(count($images) > 0)
                    //     $request->image = json_encode($images);

                    $product = $this->product->productAddUpdate($request);

                    $request->product_id = $product->id;
                    $request->title = $product_details['name'];
                    $request->sale_price = $product_details->max_price;
                    $request->brand = $product_details->brand;
                    $request->sku = $product_details->id.'_'.rand(000,1000);
                    $request->min_order_quantity = 1;
                    $request->set_size = 1;
                    $request->active = 1;
                    $request->description = $product_details->description;
                    $request->stock_quantity = 1;
                    $request->user_id = $users->id;
                    $request->shop_id = $users->shop_id;
                    $inventory_create = $this->inventory->inventoryAddUpdate($request);
                }
            }

            return $this->processResponse('global_product_inventory',Null,'success','Global Product Inventory created successfully');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function productDetail(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$request->shop_id = $users->shop_id;
    		$product = $this->product->productDetail($request);
    		$product->manufacturer_name = $product->manufacturer->name;
    		return $this->processResponse('product_detail',$product,'success','Product Detail');
    	}
    	else
    		return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function productUpdate(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$product = Product::find($request->product_id);
        	if($product->shop_id == $users->shop_id)
        	{
        		$request->shop_id = $users->shop_id;
        		$product = $this->product->productAddUpdate($request);
            	return $this->processResponse('product_add',$product,'success','Product Added Successfully');
	        }
	        else
	        	return $this->processResponse('product_update_permission_denied',null,'success','Do not have permission to update product');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function productDelete(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$product = Product::find($request->product_id);
        	if($product->shop_id == $users->shop_id)
        	{
        		$product = Product::where('id',$request->product_id)->delete();
        	}
	        else
	        	return $this->processResponse('product_update_permission_denied',null,'success','Do not have permission to update product');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function UploadFile(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $file = $this->product->uploadFile($request);
            return $this->processResponse('File',$file,'success','File uploaded Successfully');
        }
        else
            return $this->processResponse(null,'','connection_error','Invalid Connection');  
    }

    public function removeFile(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	Image::where('id',$request->image_id)->delete();
        	return $this->processResponse('File_remove','','success','File Removed Successfully');
        }
        else
            return $this->processResponse(null,'','connection_error','Invalid Connection'); 
    }
}
