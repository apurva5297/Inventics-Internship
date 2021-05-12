<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Inventory;
use App\Image;
use App\Http\Controllers\Controller;
use App\Repositories\Inventory\InventoryRepository;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;

class InventoryController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function __construct(InventoryRepository $inventory)
    {
    	$this->inventory = $inventory;
    }

    public function inventoryList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$data = array();
        	if($users->shop_id != null)
            {
            	$request->shop_id = $users->shop_id;
		    	$inventories = $this->inventory->ShopInventoryList($request);
		    	foreach($inventories as $inventory)
		    	{
		    		$data[] = array(
		    			'inventory_id' => $inventory->id,
		    			'product_id' => $inventory->product_id,
		    			'title' => $inventory->title,
		    			'brand' => $inventory->brand,
		    			'sku' => $inventory->sku,
		    			'description' => $inventory->description,
		    			'stock_quantity' => $inventory->stock_quantity,
		    			'sale_price' => $inventory->sale_price,
		    			'min_order_quantity' => $inventory->min_order_quantity,
		    			'image' => $inventory->featuredImage ? $inventory->featuredImage->path : "no image available",
                        'images' => count($inventory->images) > 0 ? $inventory->images[0]->path : "no image available",
                        'measuring_unit' => $inventory->measuring_unit,
                        'shipping_weight'       =>$inventory->shipping_weight,
                       'available'             =>$inventory->active, 
                       'is_free_shipping'      =>$inventory->free_shipping,
                       'measuring_unit_id'     =>$inventory->MeasuringUnit['id'],
                       'measuring_unit_name'   =>$inventory->MeasuringUnit['name'],
                       'measuring_unit_symbol' =>$inventory->MeasuringUnit['symbol']
		    		);
		    	}
		    }
		    return $this->processResponse('inventory_list',$data,'success','Inventory List');
		}
		else
			return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function inventoryAdd(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$inventory = array();
        	if($users->shop_id != null)
            {
            	$request->shop_id = $users->shop_id;
            	$request->user_id = $users->id;
        		$inventory = $this->inventory->inventoryAddUpdate($request);
		    }
            return $this->processResponse('inventory_add',$inventory,'success','Inventory Added Successfully');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function inventoryDetail(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$data = array();
        	$image =array();
        	if($users->shop_id != null)
            {
            	$request->shop_id = $users->shop_id;
		    	$data = $this->inventory->ShopInventoryDetail($request);
		    }
		    return $this->processResponse('inventory_detail',$data,'success','Inventory Detail');
		}
		else
			return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function inventoryUpdate(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $inventory = array();
            if($users->shop_id != null)
            {
                $request->shop_id = $users->shop_id;
                $request->user_id = $users->id;
                $inventory = $this->inventory->inventoryAddUpdate($request);
            }
            return $this->processResponse('inventory_updated',$inventory,'success','Inventory Updated Successfully');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function inventoryDelete(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$inventory = Inventory::find($request->inventory_id);
            //return $inventory;
            if($inventory)
            {
            	if($inventory->shop_id == $users->shop_id)
            	{
            		Inventory::where('id',$request->inventory_id)->delete();
                    return $this->processResponse('inventory_delete',null,'success','Inventory Deleted Successfully');
            	}
    	        else
    	        	return $this->processResponse('permission_denied',null,'success','Do not have permission to delete this inventory');
            }
            else
                return $this->processResponse('inventory_not_exist',null,'success','Inventory Not Exist');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function inventoryUploadImage(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $file = $this->inventory->uploadFile($request);
            return $this->processResponse('File',$file,'success','File uploaded Successfully');
        }
        else
            return $this->processResponse(null,'','connection_error','Invalid Connection'); 
    }

    public function inventoryRemoveImage(Request $request)
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
