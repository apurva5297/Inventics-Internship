<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\Inventory\InventoryRepository;
use App\Http\Requests\Validations\ProductSearchRequest;
use App\Http\Requests\Validations\CreateInventoryRequest;
use App\Http\Requests\Validations\UpdateInventoryRequest;
use App\Http\Requests\Validations\CreateInventoryWithVariantRequest;
use Auth;
use App\InventoryBinStorage;
use App\Inventory;
use DB;
use App\PriceListMapInventory;
use Carbon\Carbon;
use App\InventoryFsnMapping;
use App\InventoryFlipkartAttributeMapping;
use App\InventoryFlipkartListingIdMapping;


class InventoryController extends Controller
{
    use Authorizable;

    private $model;

    private $inventory;

    /**
     * construct
     */
    public function __construct(InventoryRepository $inventory)
    {
        parent::__construct();

        $this->model = trans('app.model.inventory');

        $this->inventory = $inventory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = $this->inventory->all();

        $trashes = $this->inventory->trashOnly();

        return view('admin.inventory.index', compact('inventories', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function setVariant(Request $request, $product_id)
    {
        return view('admin.inventory._set_variant', compact('product_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id)
    {
        if(! $request->user()->shop->canAddMoreInventory())
            return redirect()->route('admin.stock.inventory.index')->with('error', trans('messages.cant_add_more_inventory'));

        $inInventory = $this->inventory->checkInveoryExist($id);

        if($inInventory)
            return redirect()->route('admin.stock.inventory.edit', $inInventory->id)->with('warning', trans('messages.inventory_exist'));

        $product = $this->inventory->findProduct($id);

        return view('admin.inventory.create', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addWithVariant(Request $request, $id)
    {
        if(! $request->user()->shop->canAddMoreInventory())
            return redirect()->route('admin.stock.inventory.index')->with('error', trans('messages.cant_add_more_inventory'));

        $variants = $this->inventory->confirmAttributes($request->except('_token'));

        $combinations = generate_combinations($variants);

        $attributes = $this->inventory->getAttributeList(array_keys($variants));

        $product = $this->inventory->findProduct($id);

        return view('admin.inventory.createWithVariant', compact('combinations', 'attributes', 'product'));
    }

    /**
     * Add a product to inventory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInventoryRequest $request)
    {
        
        $this->authorize('create', \App\Inventory::class); // Check permission

        $inventory = $this->inventory->store($request);

        $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        return response()->json($this->getJsonParams($inventory));
    }

    /**
     * Add inventory with variants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeWithVariant(CreateInventoryWithVariantRequest $request)
    {
        $this->inventory->storeWithVariant($request);

        return redirect()->route('admin.stock.inventory.index')->with('success', trans('messages.created', ['model' => $this->model]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = $this->inventory->find($id);

        return view('admin.inventory._show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = $this->inventory->find($id);

        $this->authorize('update', $inventory); // Check permission

        $product = $this->inventory->findProduct($inventory->product_id);

        $preview = $inventory->previewImages();

        return view('admin.inventory.edit', compact('inventory', 'product', 'preview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editQtt($id)
    {
        $inventory = $this->inventory->find($id);

        $this->authorize('update', $inventory); // Check permission

        return view('admin.inventory._editQtt', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInventoryRequest $request, $id)
    {
        $inventory = $this->inventory->update($request, $id);

        $this->authorize('update', $inventory); // Check permission

        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));

        return response()->json($this->getJsonParams($inventory));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateQtt(Request $request, $id)
    {
        $inventory = $this->inventory->updateQtt($request, $id);

        return response("success", 200);
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->inventory->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model]));
    }

    /**
     * Restore the specified resource from soft delete.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $this->inventory->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->inventory->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * return json params to procceed the form
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($inventory){
        return [
            'id' => $inventory->id,
            'model' => 'inventory',
            // 'path' => image_path("inventories/{$inventory->id}"),
            'redirect' => route('admin.stock.inventory.index')
        ];
    }

    public function Inward()
    {
        $inventories = $this->inventory->all();

        $trashes = $this->inventory->trashOnly();

        return view('admin.inward.index', compact('inventories', 'trashes'));
    }

    public function InwardStore(Request $request)
    {   
        $postVal=$request->all();
        $data=array();
        $user = Auth::user(); //Get current user
        $total_qty=0;
        foreach ($postVal['qty'] as $key => $value) {
            if ($postVal['qty'][$key]>0 && $postVal['bin'][$key] !='') {
                $bin_id=DB::table('warehouses_bin')->where('code',trim($postVal['bin'][$key]))->first();
                /*get already insterd*/
                $binInv=DB::table('inventory_bin_storage')->where(array('shop_id'=>$user->merchantId(),'inventory_id'=>$postVal['inventory_id'],'bin_code'=>$postVal['bin'][$key]))->first();
                if (isset($binInv->inventory_id)) {
                   $total_qty+=$postVal['qty'][$key]+$binInv->qty;
                   $update=array(
                    'qty'         =>$postVal['qty'][$key]+$binInv->qty,
                    'updated_at'  =>Carbon::now()->toDateTimeString()
                    );
                   DB::table('inventory_bin_storage')->where('id',$binInv->id)->update($update);
                }else{
                   $total_qty+=$postVal['qty'][$key];
                   $data[]=array(
                    'shop_id'     =>$user->merchantId(),
                    'inventory_id'=>$postVal['inventory_id'],
                    'qty'         =>$postVal['qty'][$key],
                    'bin_id'      =>isset($bin_id->id)?$bin_id->id:0,
                    'bin_code'    =>$postVal['bin'][$key],
                    'created_at'  =>Carbon::now()->toDateTimeString(),
                    'updated_at'  =>Carbon::now()->toDateTimeString()
                    );
                }
            }
        }
        DB::table('inventory_bin_storage')->insert($data);
        return redirect()->route('admin.stock.inventory.inward')->with('success','Inventory Store In Bin SuccessFully');
    }

    public function AjaxInventory(Request $request)
    {
        $columns = array( 
                0 =>'image', 
                1 =>'sku',
                2=> 'title',
                3=> 'condition',
                4=> 'barcode',
                5=> 'qrcode',
                6=> 'price',
                7=> 'quantity',
                8=> 'option',
            );
          
        /*is shop*/
        if (Auth::user()->merchantId()) {
            $totalData = Inventory::where('shop_id',Auth::user()->merchantId())->count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value')))
            {            
                $posts = Inventory::where('shop_id',Auth::user()->merchantId())->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('product', 'image')
                             ->get();
            }else {
               $search = $request->input('search.value'); 

                $posts =  Inventory::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('sku', 'LIKE',"%{$search}%")
                            ->with('product', 'image')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = Inventory::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
                             ->orWhere('sku', 'LIKE',"%{$search}%")
                             ->with('product', 'image')
                             ->count();
            }
        }else{
            /*admin*/
            $totalData = Inventory::count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            
            if(empty($request->input('search.value')))
            {            
                $posts = Inventory::offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('product', 'image')
                             ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $posts =  Inventory::where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('sku', 'LIKE',"%{$search}%")
                            ->with('product', 'image')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = Inventory::where('id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
                             ->orWhere('sku', 'LIKE',"%{$search}%")
                             ->with('product', 'image')
                             ->count();
            }
        }

        $data = array();
        if(!empty($posts))
        {

            foreach ($posts->where('active', 1) as $inventory)
            {   
                $image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
                $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
                $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
                $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
                $barcode = view( 'admin.inventory.actions.barcode', compact('inventory'))->render();
                $qrcode = view( 'admin.inventory.actions.qrcode', compact('inventory'))->render();
                $price = view( 'admin.inventory.actions.price', compact('inventory'))->render();
                $quantity = view( 'admin.inventory.actions.quantity', compact('inventory'))->render();
                $option = view( 'admin.inventory.actions.option', compact('inventory'))->render();

                $nestedData['image'] = $image;
                $nestedData['sku'] = $sku;
                $nestedData['title'] = $title;
                $nestedData['condition'] = $condition;
                $nestedData['barcode'] = $barcode;
                $nestedData['qrcode'] = $qrcode;
                $nestedData['price'] = $price;
                $nestedData['quantity'] = $inventory->stock_quantity;
                $nestedData['option'] = $option;
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }

    public function Recall(Request $request)
    {
        $recall = DB::table('inventory_recall')->select('id','picklist','created_at',DB::raw('SUM(qty) as total_qty'))->where('shop_id',Auth::user()->merchantId())->orderBy('id','created_at')->groupBy('picklist')->get();

        return view('admin.recall.index', compact('recall', 'trashes'));
    }

    public function PricelistInventory_old(Request $request,$type='sale')
    {
        $columns = array( 
                0 =>'image', 
                1 =>'sku',
                2=> 'title',
                3=> 'condition',
                4=> 'price',
                5=> 'quantity',
                6=> 'option',
            );
          
        /*is shop*/
        if (Auth::user()->merchantId()) {
            $totalData = Inventory::where('shop_id',Auth::user()->merchantId())->count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value')))
            {            
                $posts = Inventory::where('shop_id',Auth::user()->merchantId())->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('product', 'image')
                             ->get();
            }else {
               $search = $request->input('search.value'); 

                $posts =  Inventory::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('sku', 'LIKE',"%{$search}%")
                            ->with('product', 'image')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = Inventory::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
                             ->orWhere('sku', 'LIKE',"%{$search}%")
                             ->with('product', 'image')
                             ->count();
            }
        }else{
            /*admin*/
            $totalData = Inventory::count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            
            if(empty($request->input('search.value')))
            {            
                $posts = Inventory::offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('product', 'image')
                             ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $posts =  Inventory::where('id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('sku', 'LIKE',"%{$search}%")
                            ->with('product', 'image')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = Inventory::where('id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
                             ->orWhere('sku', 'LIKE',"%{$search}%")
                             ->with('product', 'image')
                             ->count();
            }
        }

        $data = array();
        if(!empty($posts))
        {   
           switch ($type) {
                case 'sale':
                    $data = $this->salesInventoryTableData($posts);
                    break;
                case 'purchase':
                    $data = $this->purchaseInventoryTableData($posts);
                    break;
                case 'marketplace-inventory':
                    $data = $this->marketplaceInventoryTableData($posts);
                    break;
                case 'listing':
                    $data = $this->marketplaceListingIdTableData($posts);
                    break;
                default:
                    $data = $this->defaultInventoryTableData($posts,$type);
                    break;
            } 
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }

    public function PricelistInventory(Request $request,$type='sale')
    {
        $columns = array( 
                0 =>'flipkart_serial_number', 
                1 =>'seller_sku_id',
                2=> 'product_title',
                3=> 'listing_id',
                4=> 'your_selling_price',
                5=> 'quantity',
                6=> 'option',
            );
          
        /*is shop*/
        if (Auth::user()->merchantId()) {
            $totalData = InventoryFsnMapping::where('shop_id',Auth::user()->merchantId())->count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value')))
            {            
                $posts = InventoryFsnMapping::where('shop_id',Auth::user()->merchantId())->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('Inventory.product', 'Inventory.image')
                             ->get();
                            
            }else {
               $search = $request->input('search.value'); 

                $posts =  InventoryFsnMapping::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                            ->orWhere('product_title', 'LIKE',"%{$search}%")
                            ->orWhere('listing_id', 'LIKE',"%{$search}%")
                            ->orWhere('seller_sku_id', 'LIKE',"%{$search}%")
                            ->with('Inventory.product', 'Inventory.image')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = InventoryFsnMapping::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                             ->orWhere('product_title', 'LIKE',"%{$search}%")
                             ->orWhere('listing_id', 'LIKE',"%{$search}%")
                             ->orWhere('seller_sku_id', 'LIKE',"%{$search}%")
                             ->with('Inventory.product', 'Inventory.image')
                             ->count();
            }
        }else{
            /*admin*/
            $totalData = InventoryFsnMapping::count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            
            if(empty($request->input('search.value')))
            {            
                $posts = InventoryFsnMapping::offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('Inventory.product', 'Inventory.image')
                             ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $posts =  InventoryFsnMapping::where('id','LIKE',"%{$search}%")
                            ->orWhere('product_title', 'LIKE',"%{$search}%")
                            ->orWhere('listing_id', 'LIKE',"%{$search}%")
                            ->orWhere('seller_sku_id', 'LIKE',"%{$search}%")
                            ->with('Inventory.product', 'Inventory.image')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = InventoryFsnMapping::where('id','LIKE',"%{$search}%")
                             ->orWhere('product_title', 'LIKE',"%{$search}%")
                             ->orWhere('listing_id', 'LIKE',"%{$search}%")
                             ->orWhere('seller_sku_id', 'LIKE',"%{$search}%")
                             ->with('Inventory.product', 'Inventory.image')
                             ->count();
            }
        }

        $data = array();
        if(!empty($posts))
        {   
           switch ($type) {
                case 'sale':
                    $data = $this->salesInventoryTableData($posts);
                    break;
                case 'purchase':
                    $data = $this->purchaseInventoryTableData($posts);
                    break;
                case 'marketplace-inventory':
                    $data = $this->fmarketplaceInventoryTableData($posts);
                    break;
                case 'listing':
                    $data = $this->marketplaceListingIdTableData($posts);
                    break;
                default:
                    $data = $this->defaultInventoryTableData($posts,$type);
                    break;
            } 
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }

    public function fmarketplaceInventoryTableData($posts=array())
    {
        $data = array();
        foreach ($posts as $inventory)
        {   
            //$image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
            $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
            $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
            $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
            $barcode = view( 'admin.inventory.actions.barcode', compact('inventory'))->render();
            //$qrcode = view( 'admin.inventory.actions.qrcode', compact('inventory'))->render();
            $price=$inventory->purchase_price;
            $attribute =InventoryFlipkartAttributeMapping::where('inventory_id',$inventory->id)->get();
            $fsn = InventoryFsnMapping::where(['inventory_id'=>$inventory->id])->get();
            //view( 'admin.inventory.actions.price', compact('inventory'))->render();
            $quantity = view( 'admin.inventory.actions.quantity', compact('inventory'))->render();
            $option = view( 'admin.inventory.actions.option', compact('inventory'))->render();

            $nestedData['image'] = '<img src="'.$inventory->Inventory['image'] ? $inventory->Inventory['image']:''.'" />';
            $nestedData['sku'] = $inventory->seller_sku_id;
            $nestedData['title'] = $inventory->product_title;
            $nestedData['sub_category'] = $inventory->sub_category;
            $nestedData['mrp'] = $inventory->mrp;
            $nestedData['your_price'] = $inventory->your_selling_price;
            $nestedData['usual_price'] = $inventory->usual_price;
            $nestedData['listing_id'] = $inventory->listing_id;
            //$nestedData['attribute'] = count($attribute)>0?"Link":'Not Link';
            $nestedData['fsn'] = $inventory->flipkart_serial_number;
            $data[] = $nestedData;
        } 
      return $data;
    }

    public function defaultInventoryTableData($posts=array(),$type)
    {
        $data = array();
        foreach ($posts->where('active', 1) as $inventory)
        {   
            $image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
            $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
            $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
            $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
            $barcode = view( 'admin.inventory.actions.barcode', compact('inventory'))->render();
            $qrcode = view( 'admin.inventory.actions.qrcode', compact('inventory'))->render();
           
            $priceList=PriceListMapInventory::where(array('inventory_id'=>$inventory->id,'pricelist_id'=>$type))->first();
            $price=isset($priceList->price)?$priceList->price:0;
            //view( 'admin.inventory.actions.price', compact('inventory'))->render();
            $quantity = view( 'admin.inventory.actions.quantity', compact('inventory'))->render();
            $option = view( 'admin.inventory.actions.option', compact('inventory'))->render();

            $nestedData['image'] = $image;
            $nestedData['sku'] = $sku;
            $nestedData['title'] = $title;
            $nestedData['condition'] = $condition;
            $nestedData['price'] = round($price);
            $nestedData['quantity'] = $inventory->stock_quantity;
            $nestedData['option'] = $option;
            $data[] = $nestedData;
        }

        return $data;
    }

    public function salesInventoryTableData($posts=array())
    {   
        $data = array();
        foreach ($posts->where('active', 1) as $inventory)
        {   
            $image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
            $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
            $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
            $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
            $barcode = view( 'admin.inventory.actions.barcode', compact('inventory'))->render();
            $qrcode = view( 'admin.inventory.actions.qrcode', compact('inventory'))->render();
            $price = $inventory->sale_price;
            //view( 'admin.inventory.actions.price', compact('inventory'))->render();
            $quantity = view( 'admin.inventory.actions.quantity', compact('inventory'))->render();
            $option = view( 'admin.inventory.actions.option', compact('inventory'))->render();

            $nestedData['image'] = $image;
            $nestedData['sku'] = $sku;
            $nestedData['title'] = $title;
            $nestedData['condition'] = $condition;
            $nestedData['price'] = round($price);
            $nestedData['quantity'] = $inventory->stock_quantity;
            $nestedData['option'] = $option;
            $data[] = $nestedData;
        }
        return $data;
    }

    public function purchaseInventoryTableData($posts=array())
    {
        $data = array();
        foreach ($posts->where('active', 1) as $inventory)
        {   
            $image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
            $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
            $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
            $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
            $barcode = view( 'admin.inventory.actions.barcode', compact('inventory'))->render();
            $qrcode = view( 'admin.inventory.actions.qrcode', compact('inventory'))->render();
            $price=$inventory->purchase_price;
            //view( 'admin.inventory.actions.price', compact('inventory'))->render();
            $quantity = view( 'admin.inventory.actions.quantity', compact('inventory'))->render();
            $option = view( 'admin.inventory.actions.option', compact('inventory'))->render();

            $nestedData['image'] = $image;
            $nestedData['sku'] = $sku;
            $nestedData['title'] = $title;
            $nestedData['condition'] = $condition;
            $nestedData['price'] = round($price);
            $nestedData['quantity'] = $inventory->stock_quantity;
            $nestedData['option'] = $option;
            $data[] = $nestedData;
        } 
      return $data; 
    }

    public function marketplaceInventoryTableData($posts=array())
    {
        $data = array();
        foreach ($posts->where('active', 1) as $inventory)
        {   
            $image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
            $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
            $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
            $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
            $barcode = view( 'admin.inventory.actions.barcode', compact('inventory'))->render();
            $qrcode = view( 'admin.inventory.actions.qrcode', compact('inventory'))->render();
            $price=$inventory->purchase_price;
            $attribute =InventoryFlipkartAttributeMapping::where('inventory_id',$inventory->id)->get();
            $fsn = InventoryFsnMapping::where(['inventory_id'=>$inventory->id])->get();
            //view( 'admin.inventory.actions.price', compact('inventory'))->render();
            $quantity = view( 'admin.inventory.actions.quantity', compact('inventory'))->render();
            $option = view( 'admin.inventory.actions.option', compact('inventory'))->render();

            $nestedData['image'] = $image;
            $nestedData['sku'] = $sku;
            $nestedData['title'] = $title;
            $nestedData['condition'] = $condition;
            $nestedData['attribute'] = count($attribute)>0?"Link":'Not Link';
            $nestedData['fsn'] = count($fsn)>0?"Link":'Not Link';
            $data[] = $nestedData;
        } 
      return $data;
    }

    public function marketplaceListingIdTableData($posts=array())
    {
        $data = array();
        foreach ($posts->where('active', 1) as $inventory)
        {   
            $image = view( 'admin.inventory.actions.image', compact('inventory'))->render();
            $sku = view( 'admin.inventory.actions.sku', compact('inventory'))->render();
            $title = view( 'admin.inventory.actions.title', compact('inventory'))->render();
            $condition = view( 'admin.inventory.actions.condition', compact('inventory'))->render();
    
            $listing = InventoryFlipkartListingIdMapping::where('inventory_id',$inventory->id)->get();

            $nestedData['image'] = $image;
            $nestedData['sku'] = $sku;
            $nestedData['title'] = $title;
            $nestedData['condition'] = $condition;
            $nestedData['flipkart_serial_number'] = isset($listing->flipkart_serial_number)?$listing->flipkart_serial_number:'None';
            $nestedData['listing_id'] = isset($listing->listing_id)?$listing->listing_id:'None';
            $nestedData['your_selling_price'] = isset($listing->your_selling_price)?$listing->your_selling_price:'None';
            $data[] = $nestedData;
        } 
      return $data; 
    }
}

