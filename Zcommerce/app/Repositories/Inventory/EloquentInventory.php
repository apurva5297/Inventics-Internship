<?php

namespace App\Repositories\Inventory;

use Auth;
use App\Product;
use App\Inventory;
use App\Image;
use App\Attribute;
use App\AttributeValue;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;
use Carbon\Carbon;

class EloquentInventory extends EloquentRepository implements BaseRepository, InventoryRepository
{
	protected $model;

	public function __construct(Inventory $inventory)
	{
		$this->model = $inventory;
	}

    public function all()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->limit(10)->with('product', 'image')->get();

        return $this->model->limit(10)->with('product', 'image')->get();
    }

    public function trashOnly()
    {
        if (!Auth::user()->isFromPlatform())
            return $this->model->mine()->onlyTrashed()->with('product', 'image')->get();

        return $this->model->onlyTrashed()->with('product', 'image')->get();
    }

    public function checkInveoryExist($productId)
    {
        return $this->model->mine()->where('product_id', $productId)->first();
    }

    public function store(Request $request)
    {
        $inventory = parent::store($request);

        $this->setAttributes($inventory, $request->input('variants'));

        if ($request->input('packaging_list'))
            $inventory->packagings()->sync($request->input('packaging_list'));

        if ($request->input('tag_list'))
            $inventory->syncTags($inventory, $request->input('tag_list'));

        if ($request->hasFile('image'))
            $inventory->saveImage($request->file('image'));

        return $inventory;
    }

    public function storeWithVariant(Request $request)
    {
        $product = json_decode($request->input('product'));
        // Common informations
        $commonInfo['user_id'] = $request->user()->id; //Set user_id

        $commonInfo['shop_id'] = $request->user()->merchantId(); //Set shop_id

        $commonInfo['title'] = $request->has('title') ? $request->input('title') : $product->name;

        $commonInfo['product_id'] = $product->id;

        $commonInfo['brand'] = $product->brand;

        $commonInfo['warehouse_id'] = $request->input('warehouse_id');

        $commonInfo['supplier_id'] = $request->input('supplier_id');

        $commonInfo['packaging_id'] = $request->input('packaging_id');

        $commonInfo['shipping_width'] = $request->input('shipping_width');

        $commonInfo['shipping_height'] = $request->input('shipping_height');

        $commonInfo['shipping_depth'] = $request->input('shipping_depth');

        $commonInfo['shipping_weight'] = $request->input('shipping_weight');

        $commonInfo['available_from'] = $request->input('available_from');

        $commonInfo['active'] = $request->input('active');

        $commonInfo['tax_id'] = $request->input('tax_id');

        $commonInfo['min_order_quantity'] = $request->input('min_order_quantity');

        $commonInfo['alert_quantity'] = $request->input('alert_quantity');

        $commonInfo['description'] = $request->input('description');

        $commonInfo['key_features'] = $request->input('key_features');

        $commonInfo['linked_items'] = $request->input('linked_items');

        // Arrays
        $skus = $request->input('sku');

        $conditions = $request->input('condition');

        $stock_quantities = $request->input('stock_quantity');

        $purchase_prices = $request->input('purchase_price');

        $sale_prices = $request->input('sale_price');

        $offer_prices = $request->input('offer_price');

        $images = $request->file('image');

        // Relations
        $carrier_lists = $request->input('carrier_list');

        $variants = $request->input('variants');

        //Preparing data and insert records.
        $dynamicInfo = [];
        foreach ($skus as $key => $sku)
        {
            $dynamicInfo['sku'] = $skus[$key];

            $dynamicInfo['condition'] = $conditions[$key];

            $dynamicInfo['stock_quantity'] = $stock_quantities[$key];

            $dynamicInfo['purchase_price'] = $purchase_prices[$key];

            $dynamicInfo['sale_price'] = $sale_prices[$key];

            $dynamicInfo['offer_price'] = ($offer_prices[$key]) ? $offer_prices[$key] : NULL ;

            $dynamicInfo['offer_start'] = ($offer_prices[$key]) ? $request->input('offer_start') : NULL ;

            $dynamicInfo['offer_end'] = ($offer_prices[$key]) ? $request->input('offer_end') : NULL ;

            $dynamicInfo['slug'] = str_slug($product->name . ' ' . $conditions[$key] . ' ' . $sku, '-');

            // Merge the common info and dynamic info to data array
            $data = array_merge($dynamicInfo, $commonInfo);

            // Insert the record
            $inventory = Inventory::create($data);

            // Sync Attributes
            if ($variants[$key])
                $this->setAttributes($inventory, $variants[$key]);

            // Save Images
            if ($images[$key])
                $inventory->saveImage($images[$key]);
        }

        return true;
    }

    public function updateQtt(Request $request, $id)
    {
        $inventory = parent::find($id);

        $inventory->stock_quantity = $request->input('stock_quantity');

        return $inventory->save();
    }

    public function update(Request $request, $id)
    {
        $inventory = parent::update($request, $id);

        $this->setAttributes($inventory, $request->input('variants'));

        $inventory->packagings()->sync($request->input('packaging_list', []));

        $inventory->syncTags($inventory, $request->input('tag_list', []));

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $inventory->deleteImage();

        if ($request->hasFile('image'))
            $inventory->saveImage($request->file('image'));

        return $inventory;
    }

    public function destroy($inventory)
    {
        if(! $inventory instanceof Inventory)
            $inventory = parent::findTrash($inventory);

        $inventory->detachTags($inventory->id, 'inventory');

        $inventory->flushImages();

        return $inventory->forceDelete();
    }

    public function findProduct($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Set attribute pivot table for the product variants like color, size and more
     * @param obj $inventory
     * @param array $attributes
     */
    public function setAttributes($inventory, $attributes)
    {
        $attributes = array_filter($attributes);        // remove empty elements

        $temp = [];
        foreach ($attributes as $attribute_id => $attribute_value_id){
            $temp[$attribute_id] = ['attribute_value_id' => $attribute_value_id];
        }

        if (!empty($temp)){
            $inventory->attributes()->sync($temp);
        }

        return true;
    }

    public function getAttributeList(array $variants)
    {
        return Attribute::find($variants)->pluck('name', 'id');
    }

    /**
     * Check the list of attribute values and add new if need
     * @param  [type] $attribute
     * @param  array  $values
     * @return array
     */
    public function confirmAttributes($attributeWithValues)
    {
        $results = array();

        foreach ($attributeWithValues as $attribute => $values){
            foreach ($values as $value){
                $oldValueId = AttributeValue::find($value);

                $oldValueName = AttributeValue::where('value', $value)->where('attribute_id', $attribute)->first();

                if ($oldValueId || $oldValueName){
                    $results[$attribute][($oldValueId) ? $oldValueId->id : $oldValueName->id] = ($oldValueId) ? $oldValueId->value : $oldValueName->value;
                }
                else{
                    // if the value not numeric thats meaninig that its new value and we need to create it
                    $newID = AttributeValue::insertGetId(['attribute_id' => $attribute, 'value' => $value]);

                    $newAttrValue = AttributeValue::find($newID);

                    $results[$attribute][$newAttrValue->id] = $newAttrValue->value;
                }
            }
        }
        return $results;
    }

    public function ShopInventoryList(Request $request)
    {
        $page = $request->page ? $request->page : 1;
        $start = ($page-1)*10;
        $shop_id = $request->shop_id;
        $product_id = $request->product_id ? $request->product_id : null;
        return $this->model->with('product','featuredImage', 'image')
                            ->where('shop_id',$shop_id)
                            ->where(function($query) use ($product_id){
                                        if($product_id !='' && $product_id != null)
                                            $query->where('product_id',$product_id);
                                    })
                            ->offset($start)
                            ->take(10)
                            ->get();
    }

    public function inventoryAddUpdate(Request $request)
    {
        $rand = rand(0,100000);
        $inventory_data = array(
            'user_id'            => $request->user_id,
            'shop_id'         => $request->shop_id,
            'slug'            => str_slug($request->name, '-').'-'.md5(uniqid(rand(), true)),
            'title'           => $request->title,
            'warehouse_id'    => $request->warehouse_id ? $request->warehouse_id : 2,
            'product_id'      => $request->product_id,
            'brand'           => $request->brand,
            'supplier_id'     => $request->supplier_id ? $request->supplier_id : null,
            'sku'             => $request->sku,
            'barcode'         => $request->barcode ? $request->barcode : $rand,
            'qrcode'          => $request->qrcode ? $request->qrcode : $rand,
            'is_sample'       => $request->is_sample ? $request->is_sample : 0,
            'condition'       => $request->condition ? $request->condition : "New",
            'set_size'        => $request->set_size ? $request->set_size : 1,
            'set_desc'        => $request->set_desc ? $request->set_desc : null,
            'condition_note'  => $request->condition_note ? $request->condition_note : "Latest Collection",
            'description'     => $request->description,
            'stock_quantity'  => $request->stock_quantity ? $request->stock_quantity : 0,
            'damaged_quantity'=> $request->damaged_quantity ? $request->damaged_quantity : 0,
            'purchase_price'  => $request->purchase_price ? $request->purchase_price : $request->sale_price,
            'sale_price'      => $request->sale_price,
            'offer_price'     => $request->offer_price ? $request->offer_price : null,
            'offer_start'     => $request->offer_start ? $request->offer_start : null,
            'offer_end'       => $request->offer_end ? $request->offer_end : null,
            'shipping_weight' => $request->shipping_weight ? $request->shipping_weight : 1,
            'free_shipping'   => $request->free_shipping ? $request->free_shipping : 0,
            'min_order_quantity'=> $request->min_order_quantity ? $request->min_order_quantity : 1,
            'linked_items'    => $request->linked_items ? $request->linked_items : null,
            'meta_title'      => $request->meta_title ? $request->meta_title : null,
            'meta_description'=> $request->meta_description ? $request->meta_description : null,
            'stuff_pick'      => $request->stuff_pick ? $request->stuff_pick : null,
            'measuring_unit'  => $request->measuring_unit ? $request->measuring_unit : null,
            'active'          => $request->active ? $request->active : 1
        );

        //create update product start
        if($request->inventory_id)
        {
            $inventory = Inventory::find($request->inventory_id);
            $inventory->update($inventory_data);
        }
        else
            $inventory = Inventory::create($inventory_data);

        $count_image = 0;
        if($request->image)
        {
            foreach (json_decode($request->image) as $image) 
            {
                $image_data = array(
                    'path' => $image,
                    'imageable_id' => $inventory->id,
                    'name' => str_replace('images/', '', $image),
                    'extension' => '.jpeg',
                    'featured' => $count_image == 0 ? 1:0,
                    'imageable_type' => 'App\Inventory'
                );
                Image::create($image_data);
                $count_image++;
            }
        }
        return $inventory;
    }

    public function ShopInventoryDetail(Request $request)
    {
        return $this->model->with('product','featuredImage:path,imageable_id,id', 'images:path,imageable_id,id')->where(['shop_id'=>$request->shop_id,'id'=>$request->inventory_id])->first();
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