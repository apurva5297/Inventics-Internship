<?php 

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\Warehouse\WarehouseRepository;
use App\WarehouseZoneGroup;
use App\WarehouseBin;
use App\Warehouse;
use App\PriceListMapInventory;
use App\Http\Requests\Validations\CreateWarehouseRequest;
use App\Http\Requests\Validations\UpdateWarehouseRequest;
use Image;
use Carbon\Carbon;
use DB;
use App\Repositories\Inventory\InventoryRepository;
use App\PriceList;
use App\Inventory;
use App\MarketplaceListing;
use Auth;
use App\Order;
use App\MarketPlace;
use App\ReturnOrders;
use App\InventoryFsnMapping;
use App\InventoryFlipkartAttributeMapping;
use App\InventoryFlipkartListingIdMapping;
use App\MarketPlaceFlipkartPriceListMapping;
use App\MarketPlaceFlipkartWareHouseMapping;
use App\Repositories\Order\OrderRepository;
use App\Repositories\ReturnOrder\ReturnRepository;
use App\FlipkartOrdersPayment;
use App\UploadError;
use App\Customer;
use Session;
use App\FlipkartPreviousOrder;
use App\FlipkartPaymentStorageRecall;
use App\FlipkartAdsPayment;
use App\FlipkartNonOrderSpfPayment;
use App\FlipkartPaymentTaxDetail;
use App\FlipkartTcsRecoveryPayment;
use App\MarketplaceModuleMapping;

class PriceListController extends Controller
{
    //use Authorizable;

    private $model_name;

    private $warehouse;

    private $inventory;


    /**
     * construct
     */
    public function __construct(WarehouseRepository $warehouse,InventoryRepository $inventory,OrderRepository $order,ReturnRepository $return)
    {
        parent::__construct();

        $this->model_name = trans('app.model.warehouse');

        $this->warehouse = $warehouse;

        $this->inventory = $inventory;

        $this->order = $order;

        $this->return = $return;


    }

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pricelist = PriceList::all();

        return view('admin.pricelist.index', compact('pricelist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pricelist._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateWarehouseRequest $request)
    {   
        $pricelist=PriceList::create($request->all());
        /*map invetory*/
        $this->PriceListMapToInventory($pricelist);

          if ($request->hasFile('image'))
            $pricelist->saveImage($request->file('image'));

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    public function PriceListMapToInventory($postVal=array())
    {
        $inventories = Inventory::where('shop_id',Auth::user()->merchantId())->get();
        $data=array();
        foreach ($inventories as $row) {
           $data[]=array(
                'shop_id'     =>$row->shop_id,
                'pricelist_id'=>$postVal->id,
                'inventory_id'=>$row->id,
                'price'       =>0,
                'created_at'  =>Carbon::now()->toDateTimeString(),
                'updated_at'  =>Carbon::now()->toDateTimeString(),
           );
        }
        PriceListMapInventory::insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $warehouse = $this->warehouse->find($id);

        return view('admin.warehouse._show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pricelist = PriceList::find($id);

        return view('admin.pricelist._edit', compact('pricelist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, $id)
    {
        $this->warehouse->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
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
        PriceList::destroy($id);
        /*pricelist mapping*/
        PriceListMapInventory::where('pricelist_id',$id)->delete();
        //$this->warehouse->trash($id);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
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
        $this->warehouse->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
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
        $this->warehouse->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function addPriceList($type)
    {   
        if ($type=='sale') {
            return view('admin.pricelist.sale_inventory_index');
        }if ($type=='purchase') {
            return view('admin.pricelist.purchase_inventory_index');
        }else{
            return view('admin.pricelist.inventory_index');
        }   
    }

    public function CreateZoneGroup(Request $request)
    {
        WarehouseZoneGroup::create($request->all());
        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    public function EditZoneGroup($id)
    {
        $warehouse = WarehouseZoneGroup::find($id);
        return view('admin.warehouse._edit_zone_group', compact('warehouse'));
    }

    public function UpdateZoneGroup(Request $request,$id)
    {   
        $zonegroup = WarehouseZoneGroup::find($id);
        $zonegroup->name = $request->name;
        $zonegroup->active = $request->active;
        $zonegroup->save();
        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function DeleteZoneGroup($id)
    {
        WarehouseZoneGroup::destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));

    }

    public function IndexBin($id)
    {   
        $zonegroup = WarehouseZoneGroup::find($id);
        $bins      = !empty($zonegroup)>0?$zonegroup->warehouseBin:array();
        $warehouses = Warehouse::find($id);
        $warehouseZoneGroup=!empty($warehouses)>0?$warehouses->warehouseZoneGroup:array();
        return view('admin.warehouse.bin.index', compact('warehouses', 'warehouseZoneGroup','zonegroup','bins'));
    }

    public function CreateBin(Request $request)
    {   
        $validations=WarehouseBin::where(['code'=>$request->code,'warehouse_zone_group_id'=>$request->warehouse_zone_group_id])->get();

        if (count($validations)>0) {
             return back()->with('error', trans('Code Already Exists', ['model' => $this->model_name]));
        }
        WarehouseBin::create($request->all());
        return back()->with('success', trans('Bin Created Successfully', ['model' => $this->model_name]));
    }

    public function EditBin($id)
    {
        $bin = WarehouseBin::find($id);
        return view('admin.warehouse.bin._edit_bin', compact('bin'));
    }

    public function UpdateBin(Request $request,$id)
    {
        $bin = WarehouseBin::find($id);
        $bin->name = $request->name;
        $bin->code = $request->code;
        $bin->active = $request->active;
        $bin->save();
        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    public function DeleteBin($id)
    {
        WarehouseBin::destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function BinCsvshowForm($id=0)
    {   
        return view('admin.warehouse.bin._upload_form',compact('id'));

    }

    public function ImportBinTemplate(Request $request)
    {
        $path = $request->file('products')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $data=array();
        $i=0;
        foreach ($rows as $result) {
            if ($i != 0) {
                if (isset($result[1]) && $result[2] !='') {
                    $bin=WarehouseBin::where(['code'=>$result[2],'warehouse_zone_group_id'=>$request->id])->get();
                    /*check*/
                    if (count($bin)==0) {
                       $data[]=array(
                        'warehouse_zone_group_id'=>$request->id,
                        'name'=>$result[1],
                        'code'=>$result[2],
                        'active'=>1,
                        'created_at'=>Carbon::now()->toDateTimeString(),
                        'updated_at'=>Carbon::now()->toDateTimeString()
                        );
                    }  
                }
            }
            $i++;
        }
        if (DB::table('warehouses_bin')->insert($data)) {
            return back()->with('success', trans('Bin Import Successfully', ['model' => $this->model_name]));
        }
        return back()->with('error', trans('Something Went Wrong', ['model' => $this->model_name]));
    }

    public function DownloadBinTemplate()
    {
       $csv_data[] = array('No','Bin Name','Bin code');
       $this->generateCsvFiles('bin_import_csv.csv',$csv_data);
    }

    public  function DownloadPriceListTemplate(Request $request,$type)
    {   
        $inventory=Inventory::where('shop_id',Auth::user()->merchantId())->get();
        $csv_name = 'price_list_inventory.csv'; 
        if ($type === 'sale') {
            $csv_data[] = array('TITLE','LISTING ID','SKU','TYPE','Sale Price','New Price');
            if(count($inventory) > 0){
                foreach($inventory as $val) {
                    $csv_data[] = array(
                        $val->title,
                        'Simpel-'.$val->id,
                        $val->sku,
                        'REGULAR',
                        $val->sale_price,
                        '',
                    );
                }
            }
            $csv_name = 'sale_price_list_inventory.csv';
            $this->generateCsvFiles($csv_name,$csv_data);

        }if (trim($type) =='purchase') {

            $csv_data[] = array('TITLE','LISTING ID','SKU','TYPE','  Purchase Price','New Price');
            if(count($inventory) > 0){
                foreach($inventory as $val) {
                    $csv_data[] = array(
                        $val->title,
                        'Simpel-'.$val->id,
                        $val->sku,
                        'REGULAR',
                        $val->purchase_price,
                        '',
                    );
                }
            }
            $csv_name = 'purchase_price_list_inventory.csv';
            $this->generateCsvFiles($csv_name,$csv_data);
        }else{
            $inventory=Inventory::join('pricelist_mapping_invetory','pricelist_mapping_invetory.inventory_id','=','inventories.id')->where(['inventories.shop_id'=>Auth::user()->merchantId(),'pricelist_mapping_invetory.pricelist_id'=>$type])->get();
            $csv_data[] = array('TITLE','LISTING ID','SKU','TYPE','Old Price','New Price');
            if(count($inventory) > 0){
                foreach($inventory as $val) {
                    $csv_data[] = array(
                        $val->title,
                        'Simpel-'.$val->inventory_id,
                        $val->sku,
                        'REGULAR',
                        $val->price,
                        '',
                    );
                }
            }
            $csv_name = 'custom_price_list_inventory.csv';
            $this->generateCsvFiles($csv_name,$csv_data);
        }   
    }

    public function PricelistshowForm($id)
    {   
        return view('admin.pricelist.inventory._upload_form',compact('id'));
    }

    public function PriceListUpload(Request $request)
    {
        $path = $request->file('products')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $type=$request->priceListid;

        if ($type=='sale') {
            $i=0;
            foreach ($rows as $result) {
                if ($i != 0) {
                    if (isset($result[1]) && $result[2]) {
                        Inventory::where(array('sku'=>trim($result[2])))->update(array('sale_price'=>trim($result[5])));
                    }
                }
                $i++;
            }
        }elseif ($type=='purchase') {
            $i=0;
            foreach ($rows as $result) {
                if ($i != 0) {
                    if (isset($result[1]) && $result[2]) {
                        Inventory::where(array('sku'=>trim($result[2])))->update(array('purchase_price'=>trim($result[5])));
                    }
                }
                $i++;
            }
        }else{
            $i=0;
            foreach ($rows as $result) {
                if ($i != 0) {
                    if (isset($result[1]) && isset($result[2])) {
                        $id=explode('-', $result[1]);
                        PriceListMapInventory::where(array('inventory_id'=>$id[1],'pricelist_id'=>$type))->update(array('price'=>$result[5]));
                    }
                }
                $i++;
            }
        }
        return back()->with('success',  trans('Price List Update Successfully', ['model' => $this->model_name]));  
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

    public function ShopMarketplace(Request $request)
    {
        $marketplace = MarketPlace::all();

        return view('admin.marketplace.shop.index', compact('marketplace'));
    }

    public function MarketPlaceListing()
    {
        return view('admin.marketplace.shop.listing_inventory_index');
    }

    public function MarketPlaceInventory()
    {
        return view('admin.marketplace.shop.inventory_index');

    }

    public function MarketPlaceshowForm(Request $request,$id)
    {   
        $marketpalce_id= $request->marketplace_id;
        if ($id=='Report') {
            $product=array();
            return view('admin.marketplace.shop._get_report_form',compact('id','marketpalce_id','product'));
        }
        //return view('admin.marketplace.shop._get_report_form',compact('id','marketpalce_id'));
        return view('admin.marketplace.shop._upload_form',compact('id','marketpalce_id'));
    }
    public function MarketPlaceUploadCsvPage(Request $request,$id)
    {   
        $marketpalce_id= $request->marketplace_id;
        return view('admin.marketplace.shop.marketplace_upload',compact('id','marketpalce_id'));
    }
    public function MarketPlaceUploadCsv(Request $request)
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
                if($i!=0)
                {
                    DB::table('marketplace_data_sync')
                    ->insert(
                        ['sku'=>$row[0],
                        'market_place'=> 'flipkart',
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
    public function MarketPlaceSyncUpload(Request $request)
    { 
    $url  = "https://api.flipkart.net/oauth-service/oauth/token?grant_type=client_credentials&scope=Seller_Api";
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL,$url);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_USERPWD, "39945776084559656687a1255b4130513a03:4d4a497909f45ae760448d14ac8cc2ef");
    $result = curl_exec($curl);
    curl_close($curl);
    $tokan = json_decode($result,true);
    dd($tokan);
    $url  = "https://api.flipkart.net/sellers/listings/v3/{Dhoti-2237-DK MRN-S}";
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL,$url);
    curl_setopt($curl, CURLOPT_POSTFIELDS,true);  //Post Fields
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json',
    'Authorization:Bearer '.$tokan['access_token'],
    ''
    ));
    $result = curl_exec($curl);
    $ee = curl_getinfo($curl);
    echo "<pre>";
    //print_r($ee);
    curl_close($curl);
    dd(json_decode($result));
    // print_r($result);
        return view('admin.marketplace.shop.marketplace_sync_option',compact('id','marketpalce_id'));
    }


    public function MarketPlaceshowFormPriceList(Request $request,$id=0)
    {
        $marketpalce_id= $id;
        $pricelist = PriceList::all();
        return view('admin.marketplace.shop._priceList_form',compact('marketpalce_id','pricelist'));
    }

    public function MarketPlaceListingIdMapping($response=array(),$request)
    {   
        $i=1;
        $listing=array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[1]) && !empty($result[1]) && isset($result[4]) && !empty($result[4])) {
                    $inventroy=Inventory::where(['sku'=>$result[4],'shop_id'=>Auth::user()->merchantId()])->first();
                    if (!empty($inventroy)) {
                        $listing[] = array(
                            'shop_id'=>Auth::user()->merchantId(),
                            'inventory_id'=>$inventroy->id,
                            'marketpalce_id'=>$request->marketpalce_id,
                            'flipkart_serial_number'=>$result[0],
                            'listing_id'=>$result[1],
                            'sub_category'=>$result[2],
                            'product_code'=>$result[3],
                            'seller_sku_id'=>$result[4],
                            'mrp'=>$result[5],
                            'your_selling_price'=>$result[6],
                        );
                    }
                }
                else
                {
                    $csv_data[] = $result;
                }
            }
            $i++;
        }
        if($csv_data)
            $this->generateCsvFiles('listing_error.csv',$csv_data);
        return $listing;
    }

    public function MarketPlaceUpload(Request $request)
    {
        $path = $request->file('products')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $type=$request->marketpalce_type;
        $marketpalce_id=$request->marketpalce_id;

        switch ($type) {
            case 'FSNNO':
                $response=$this->MarketPlaceFSNMapping($rows,$request);
                if (count($response)>0) {
                   InventoryFsnMapping::insert($response);
                   if(Session::get('listing_error_session'))
                   {
                    $error_array = array(
                        'shop_id' => Auth::user()->merchantId(),
                        'file_name' => 'marketplace_fsn_mapping',
                        'error_data' => json_encode(Session::get('listing_error_session'))
                    );
                    if(empty(UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_fsn_mapping'])->first()))
                        UploadError::insert($error_array);
                    else
                        UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_fsn_mapping'])->update($error_array);
                   }
                   return back()->with('success',  trans('FSN Mapped Successfully', ['model' => $this->model_name]));
                }
                
                return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
                break;
            case 'Attribute':
                $response=$this->MarketPlaceAttributeMapping($rows,$request);
                if (count($response)>0) {
                   InventoryFlipkartAttributeMapping::insert($response);
                   return back()->with('success',  trans('Attribute Mapped Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
                break;
            case 'listing':
                //return "adfadf";
                $response=$this->MarketPlaceListingIdMapping($rows,$request);
                if (count($response)>0) {
                   InventoryFlipkartListingIdMapping::insert($response);
                   return back()->with('success',  trans('Listing Id Mapped Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
                break;
            case 'Orders': 
                if(Session::get('order_error_session'))
                {
                    $error_array = array(
                        'shop_id' => Auth::user()->merchantId(),
                        'file_name' => 'marketplace_order',
                        'error_data' => json_encode(Session::get('order_error_session'))
                    );
                    if(empty(UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_order'])->first()))
                        UploadError::insert($error_array);
                    else
                        UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_order'])->update($error_array);
                }
                $response=$this->MarketPlaceOrderPlace($rows,$request);
                if (count($response)>0) {
                   $this->MarketPlaceOrderPlaceStore($response,$marketpalce_id);
                   return back()->with('success',  trans('Orders Created Successfully', ['model' => $this->model_name]));
                }

                return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
                break;

            case 'PreviousOrders': 
                if(Session::get('previous_order_error_session'))
                {
                    $error_array = array(
                        'shop_id' => Auth::user()->merchantId(),
                        'file_name' => 'marketplace_previous_order',
                        'error_data' => json_encode(Session::get('previous_order_error_session'))
                    );
                    if(empty(UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_previous_order'])->first()))
                        UploadError::insert($error_array);
                    else
                        UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_previous_order'])->update($error_array);
                }
                $response=$this->MarketPlacepreviousOrderPlace($rows,$request);
                if (count($response)>0) {
                   FlipkartPreviousOrder::insert($response);
                   return back()->with('success',  trans('Orders Created Successfully', ['model' => $this->model_name]));
                }

                return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
                break;

            case 'Return':
                if(Session::get('return_error_session'))
                {
                    $error_array = array(
                        'shop_id' => Auth::user()->merchantId(),
                        'file_name' => 'marketplace_return',
                        'error_data' => json_encode(Session::get('return_error_session'))
                    );
                    if(empty(UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_return'])->first()))
                        UploadError::insert($error_array);
                    else
                        UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_return'])->update($error_array);
                    //return json_encode(Session::get('return_error_session'));
                }
                $response=$this->MarketPlaceReturnOrders($rows,$request);
                //return $response;
                if (count($response)>0) {
                    $this->MarketPlaceOrderPlaceReturnStore($response,$marketpalce_id);

                   return back()->with('success',  trans('Return Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
                break;
            // case 'Payment':
            //     if(Session::get('payment_error_session'))
            //     {
            //         $error_array = array(
            //             'shop_id' => Auth::user()->merchantId(),
            //             'file_name' => 'marketplace_payment',
            //             'error_data' => json_encode(Session::get('payment_error_session'))
            //         );
            //         if(empty(UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_payment'])->first()))
            //             UploadError::insert($error_array);
            //         else
            //             UploadError::where(['shop_id'=>Auth::user()->merchantId(),'file_name'=>'marketplace_payment'])->update($error_array);
            //         return json_encode(Session::get('payment_error_session'));
            //     }
            //     $response=$this->MarketPlaceOrdersPayments($rows,$request);
            //     if (count($response)>0) {
            //        $this->MarketPlaceOrderPlaceOrdersPayments($response,$marketpalce_id);
            //        return back()->with('success',  trans('Return Created Successfully', ['model' => $this->model_name]));
            //     }
            //     return back()->with('error',  trans('SKU Not Matached', ['model' => $this->model_name]));
            //     break;

            case 'OrderPayment':
                $response=$this->MarketPlaceOrdersPayments($rows,$request);
                if (count($response)>0) {
                   FlipkartOrdersPayment::insert($response); 
                   return back()->with('success',  trans('Order Payment Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('Something Went Wrong', ['model' => $this->model_name]));
                break;

            case 'StorageRecallPayment':
                $response=$this->StorageRecallPayment($rows,$request);
                if (count($response)>0) {
                   FlipkartPaymentStorageRecall::insert($response); 
                   return back()->with('success',  trans('Storage Recall Payment Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('Something Went Wrong', ['model' => $this->model_name]));
                break;

            case 'NonOrderSpfPayment':
                $response=$this->NonOrderSpfPayment($rows,$request);
                if (count($response)>0) {
                   FlipkartNonOrderSpfPayment::insert($response); 
                   return back()->with('success',  trans('Non Order SPF Payment Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('Something Went Wrong', ['model' => $this->model_name]));
                break;
            
            case 'AdsPayment':
                $response=$this->AdsPayment($rows,$request);
                if (count($response)>0) {
                   FlipkartAdsPayment::insert($response); 
                   return back()->with('success',  trans('Ads Payment Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('Something Went Wrong', ['model' => $this->model_name]));
                break;

            case 'TaxDetailsPayment':
                $response=$this->TaxDetailsPayment($rows,$request);
                if (count($response)>0) {
                   FlipkartPaymentTaxDetail::insert($response); 
                   return back()->with('success',  trans('Tax Details Payment Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('Something Went Wrong', ['model' => $this->model_name]));
                break;

            case 'TcsRecoveryPayment':
                $response=$this->TcsRecoveryPayment($rows,$request);
                if (count($response)>0) {
                   FlipkartTcsRecoveryPayment::insert($response); 
                   return back()->with('success',  trans('Tcs Recovery Payment Created Successfully', ['model' => $this->model_name]));
                }
                return back()->with('error',  trans('Something Went Wrong', ['model' => $this->model_name]));
                break;

            default:
                # code...
                break;
        }
    }

    public function TcsRecoveryPayment($response=array(),$request)
    {
        $tcs_recovery_payment=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[0]) && !empty($result[0])) {
                    $tcs_recovery_payment[]=array(
                        'shop_id'           => Auth::user()->merchantId(),
                        'marketplace_id'    => $request->marketplace_id ? $request->marketplace_id:1,
                        'neft_id'           => $result[0],  
                        'satlement_type'    => $result[1],   
                        'satlement_value'   => $result[2],  
                        'transaction_id'    => $result[4],   
                        'transaction_date'  => $result[5], 
                        'recovery_month'    => $result[6]
                    );
                }
                else
                    $csv_data = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('tcs_recovery_payment_error_session',$csv_data);
        return $tcs_recovery_payment;
    }

    public function TaxDetailsPayment($response=array(),$request)
    {
        $tax_details_payment=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[0]) && !empty($result[0])) {
                    $tax_details_payment[]=array(
                        'shop_id'           => Auth::user()->merchantId(),
                        'marketplace_id'    => $request->marketplace_id ? $request->marketplace_id:1,
                        'service_type'      => $result[0], 
                        'neft_id'           => $result[1],  
                        'order_item_listing_id_campign_id_transaction_id'=> $result[2],  
                        'recall_id'         => $result[3],    
                        'warehouse_state_code'=> $result[4], 
                        'fee_name'            => $result[5], 
                        'fee_amount_new'      => $result[7],   
                        'cgst_rate'           => $result[8],    
                        'sgst_rate'           => $result[9],    
                        'igst_rate'           => $result[10],    
                        'cgst_amount'         => $result[11],  
                        'sgst_amount'         => $result[12],  
                        'igst_amount'         => $result[13],  
                        'fee_amount_old'      => $result[14],   
                        'service_tax_rate'    => $result[16], 
                        'kkc_rate'            => $result[17], 
                        'sbc_rate'            => $result[18], 
                        'service_tax_amount'  => $result[19],   
                        'kkc_amount'          => $result[20],   
                        'sbc_amount'          => $result[21],   
                        'total_tax'           => $result[23]
                    );
                }
                else
                    $csv_data = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('tax_details_payment_error_session',$csv_data);
        return $tax_details_payment;
    }

    public function AdsPayment($response=array(),$request)
    {
        $ads_payment=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[0]) && !empty($result[0])) {
                    $ads_payment[]=array(
                        'shop_id'                       => Auth::user()->merchantId(),
                        'marketplace_id'                => $request->marketplace_id ? $request->marketplace_id:1,
                        'neft_id'                       => $result[0],  
                        'date'                          => $result[1], 
                        'satlement_value'               => $result[2],  
                        'type'                          => $result[4], 
                        'campaign_id_transaction_id'    => $result[5],   
                        'wallet_redeem'                 => $result[6],    
                        'wallet_redeem_reversal'        => $result[7],   
                        'wallet_topup'                  => $result[8], 
                        'wallet_refund'                 => $result[9],    
                        'taxes'                         => $result[10]
                    );
                }
                else
                    $csv_data = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('ads_payment_error_session',$csv_data);
        return $ads_payment;
    }

    public function NonOrderSpfPayment($response=array(),$request)
    {
        $non_order_spf_payment=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[0]) && !empty($result[0])) {
                    $non_order_spf_payment[]=array(
                        'shop_id'           => Auth::user()->merchantId(),
                        'marketplace_id'    => $request->marketplace_id ? $request->marketplace_id:1,
                        'neft_id'           => $result[0],  
                        'date'              => $result[1], 
                        'satlement_value'   => $result[2],  
                        'claim_id'          => $result[4], 
                        'protection_reason' => $result[5],    
                        'seller_sku'        => $result[7],   
                        'fsn'               => $result[8],  
                        'selling_price'     => $result[9],    
                        'warehouse_id'      => $result[10]
                    );
                }
                else
                    $csv_data = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('non_order_spf_payment_error_session',$csv_data);
        return $non_order_spf_payment;
    }

    public function StorageRecallPayment($response=array(),$request)
    {
        $storage_recall_payment=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[0]) && !empty($result[0])) {
                        $storage_recall_payment[]=array(
                        'shop_id'                       => Auth::user()->merchantId(),
                        'market_place_id'                => $request->marketpalce_id,
                        'neft_id'                       => $result[0],  
                        'date'                          => $result[1], 
                        'satelement_value'              => $result[2], 
                        'service_name'                  => $result[4], 
                        'listing_id'                    => $result[5],   
                        'recall_id'                     => $result[6],    
                        'warehouse_state_code'          => $result[7], 
                        'fsn'                           => $result[8],  
                        'market_place_fee'              => $result[9], 
                        'taxes'                         => $result[10],    
                        'removal_fee_units'             => $result[12],    
                        'removal_fee'                   => $result[13],  
                        'storage_fee_unit'              => $result[14], 
                        'storage_fee'                   => $result[15],
                        'sellable_regular_storeage_unit'=> $result[16],
                        'sellable_regular_storeage'     => $result[17],    
                        'unsellable_regular_storeage_unit'=> $result[18], 
                        'unsellable_regular_storeage'   => $result[19],  
                        'sellable_longterm_1_storage_unit'=> $result[20], 
                        'sellable_longterm_1_storage'   => $result[21],  
                        'unsellable_longterm_1_storage_unit'=> $result[22],   
                        'unsellable_longterm_1_storage' => $result[23],    
                        'sellable_longterm_2_storage_unit'=> $result[24], 
                        'sellable_longterm_2_storage'   => $result[25],  
                        'unsellable_longterm_2_storage_unit'=> $result[27],   
                        'unsellable_longterm_2_storage' => $result[27],    
                        'product_sub_category'          => $result[29], 
                        'dead_weight'                   => $result[30],  
                        'length_breadth_height'         => $result[31],    
                        'volumentric_weight'            => $result[32],   
                    );
                }
                else
                    $csv_data = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('storage_recall_payment_error_session',$csv_data);
        return $storage_recall_payment;
    }

    public function MarketPlacepreviousOrderPlace($response=array(),$request)
    {
        $i=1;
        $previous_orders=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[7]) && !empty($result[7])) {
                    $sku=explode(':', str_replace('"', '', trim($result[7])));
                    $inventroy=Inventory::where(array('sku'=>$sku[1],'shop_id'=>Auth::user()->merchantId()))->first();
                    if (!empty($inventroy)) {
                        $previous_orders[]=array(
                            'shop_id'                       => Auth::user()->merchantId(), 
                            'order_item_id'                 => $result[0], 
                            'order_id'                      => $result[1], 
                            'fulfilment_source'             => $result[2], 
                            'fulfilment_type'               => $result[3], 
                            'order_date'                    => $result[4], 
                            'order_approval_date'           => $result[5], 
                            'order_item_status'             => $result[6], 
                            'sku'                           => $sku[1], 
                            'fsn'                           => $result[8], 
                            'product_title'                 => $result[9], 
                            'quantity'                      => $result[10], 
                            'serial_no_imei'                => $result[11], 
                            'delivery_logistic_partner'     => $result[12], 
                            'pickup_logistic_partner'       => $result[13], 
                            'delivery_tracking_id'          => $result[14], 
                            'forward_logistic_form'         => $result[15], 
                            'forword_logistic_form_no'      => $result[16], 
                            'order_cancellation_date'       => $result[17], 
                            'cancellation_reason'           => $result[18], 
                            'cancellation_sub_reason'       => $result[19], 
                            'order_return_approval_date'    => $result[20], 
                            'return_id'                     => $result[21], 
                            'return_reason'                 => $result[22], 
                            'return_sub_reason'             => $result[23], 
                            'procurement_dispatch_sla'      => $result[24], 
                            'dispatch_after_date'           => $result[25], 
                            'dispatch_by_date'              => $result[26],
                            'order_ready_for_dispatch_on_date'=> $result[27], 
                            'dispatched_date'               => $result[28],  
                            'dispatched_sla_breached'       => $result[29],  
                            'seller_pickup_reattempts'      => $result[30], 
                            'delivery_sla'                  => $result[31], 
                            'delivery_by_date'              => $result[32], 
                            'delivery_sla_breached'         => $result[33],    
                            'delivery_serice_completation_date'=> $result[34],    
                            'service_by_date'               => $result[35],  
                            'service_completaion_sla'       => $result[36],
                            'service_sla_breached'          => $result[37]
                        );
                    }
                    else
                        $csv_data[] = $result;
                }
                else
                    $csv_data[] = $result;

            }
            $i++;
        }
        if($csv_data)
            Session::put('previous_order_error_session',$csv_data);

        return $previous_orders;
    }

    public function MarketPlaceFSNMapping($response=array(),$request)
    {
        $i=1;
        $fns=array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[5]) && !empty($result[5])) {
                    $inventroy=Inventory::where(array('sku'=>trim($result[5]),'shop_id'=>Auth::user()->merchantId()))->first();
                    if (!empty($inventroy) && empty($inventroy['InventoryFsnMapping'])) {
                        $fns[]=array(
                        'shop_id'=>Auth::user()->merchantId(),
                        'inventory_id'=>$inventroy->id,
                        'marketpalce_id'=>$request->marketpalce_id,
                        'flipkart_serial_number'=>$result[0],
                        'listing_id'=>$result[1],
                        'sub_category'=>$result[2],
                        'product_title'=>$result[3],
                        'processing_errors_if_any'=>$result[4],
                        'seller_sku_id'=>$result[5],
                        'mrp'=>$result[6],
                        'your_selling_price'=>$result[7],
                        'ignore_warnings'=>$result[8],
                        'usual_price'=>$result[9],
                        'local_delivery_charge_to_customer'=>$result[10],
                        'zonal_delivery_charge_to_customer'=>$result[11],
                        'national_delivery_charge_to_customer'=>$result[12],
                        'system_stock_count'=>$result[13],
                        'your_stock_count'=>$result[14],
                        'procurement_sla'=>$result[15],
                        'listing_status'=>$result[16],
                        'inactive_reason'=>$result[17],
                        'fulfillment_by'=>$result[18],
                        'package_length'=>$result[19],
                        'package_breadth'=>$result[20],
                        'package_height'=>$result[21],
                        'package_weight'=>$result[22],
                        'procurement_type'=>$result[23],
                        'hsn'=>$result[24],
                        'tax_code'=>$result[25],
                        'luxury_cess_tax_rate'=>$result[26],
                        'listing_archival'=>$result[27],
                        'manufacturer_details'=>$result[28],
                        'importer_details'=>$result[29],
                        'packer_details'=>$result[30],
                        'iso_code'=>$result[31],
                        'date_of_manufacture'=>$result[32],
                        'shelf_life_in_months'=>$result[33],
                        'flipkart_plus'=>$result[34],
                        );
                    }
                    else
                        $csv_data[] = $result;
                }
                // else
                //     $csv_data[] = $result;

            }
            $i++;
        }
        if($csv_data)
            Session::put('listing_error_session',$csv_data);

        return $fns;
    }

    public function MarketPlaceAttributeMapping($response=array(),$request)
    {
        $i=0;
        $attribute=array();
        foreach ($response as $result) {
            if ($i > 55) {
                if (isset($result[6]) && !empty($result[6]) && isset($result[8]) && !empty($result[8])) {
                    $inventroy=Inventory::where(array('sku'=>trim($result[6]),'shop_id'=>Auth::user()->merchantId()))->first();
                    if (!empty($inventroy)) {
                            $attribute[]=array(
                                'shop_id'=>Auth::user()->merchantId(),
                                'inventory_id'=>$inventroy->id,
                                'marketpalce_id'=>$request->marketpalce_id,
                                'flipkart_serial_number'=>$result[0], 
                                'qc_status'=> $result[1],
                                'qc_failed_reason' =>$result[2], 
                                'flipkart_product_link'=>$result[3],
                                'product_data_status'=>$result[4], 
                                'disapproval'=>$result[5], 
                                'seller_sku_id'=>$result[6], 
                                'brand'=>$result[7], 
                                'style_code'=>$result[8], 
                                'size'=>$result[9], 
                                'sleeve_style'=>$result[10], 
                                'occasion'=>$result[11], 
                                'ideal_for'=>$result[12], 
                                'pattern'=>$result[13], 
                                'color'=>$result[14], 
                                'pack_of'=>$result[15], 
                                'brand_color'=>$result[16], 
                                'brand_fabric'=>$result[17], 
                                'type'=>$result[18], 
                                'neck_collar'=>$result[19], 
                                'fit'=>$result[20], 
                                'suitable_for'=>$result[21], 
                                'main_image_url'=>$result[22], 
                                'other_image_url_1'=>$result[23], 
                                'other_image_url_2'=>$result[24], 
                                'other_image_url_3'=>$result[25], 
                                'other_image_url_4'=>$result[26], 
                                'other_image_url_5'=>$result[27], 
                                'main_palette_image_url'=>$result[28], 
                                'group_id'=>$result[29], 
                                'size_for_inwarding'=>$result[30], 
                                'top_length_1'=>$result[31], 
                                'ornamentation_type'=>$result[32], 
                                'fabric_care'=>$result[33], 
                                'model_name'=>$result[34], 
                                'belt_included'=>$result[35], 
                                'other_details'=>$result[36], 
                                'sales_package'=>$result[37], 
                                'description'=>$result[38], 
                                'search_keywords'=>$result[39], 
                                'key_features'=>$result[40], 
                                'video_url'=>$result[41], 
                                'warranty_summary'=>$result[42], 
                                'warranty_service_type'=>$result[43], 
                                'external_identifier'=>$result[44], 
                                'trend'=>$result[45], 
                                'ean_upc'=>$result[46], 
                                'sleeve_length'=>$result[47], 
                                'pattern_print_type'=>$result[48], 
                                'pattern_coverage'=>$result[49], 
                                'detail_placement'=>$result[50], 
                                'transparency'=>$result[51], 
                                'dummy_length'=>$result[52], 
                                'secondary_color'=>$result[53], 
                                'trend_aw_16'=>$result[54], 
                                'supplier_image'=>$result[55], 
                                'applique_type'=>$result[56], 
                                'checkered_type'=>$result[57], 
                                'style_of_the_sleeves'=>$result[58], 
                                'tops_length'=>$result[59], 
                                'dyed_type'=>$result[60], 
                                'colorblock_type'=>$result[61], 
                                'color_shade'=>$result[62], 
                                'surface_styling'=>$result[63], 
                                'sheer'=>$result[64],
                            ); 
                        }
                    }
                }
            $i++;
        }
       return $attribute;
    }

    public function MarketPlaceOrderPlace($response=array(),$request)
    {   
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            
            if ($i > 1) {
                if (isset($result[2]) && !empty($result[2]) && isset($result[3]) && !empty($result[3])) {
                    $orders[]=array(
                    'ordered_on'=>date('d-m-Y', strtotime($result[0])),
                    'shipment_id'=>$result[1],
                    'order_item_id'=>$result[2],
                    'order_id'=>$result[3],
                    'hsn_code'=>$result[4],
                    'order_state'=>$result[5],
                    'order_type'=>$result[6],
                    'fsn'=>$result[7],
                    'sku'=>$result[8],
                    'product'=>$result[9],
                    'invoice_no'=>$result[10],
                    'cgst'=>$result[11],
                    'igst'=>$result[12],
                    'sgst'=>$result[13],
                    'invoice_date'=>date('d-m-Y', strtotime($result[14])),
                    'invoice_amount'=>$result[15],
                    'selling_price_per_item'=>$result[16],
                    'shipping_charge_per_item'=>$result[17],
                    'quantity'=>$result[18],
                    'price_inc'=>$result[19],
                    'buyer_name'=>$result[20],
                    'ship_to_name'=>$result[21],
                    'address_line_1'=>$result[22],
                    'address_line_2'=>$result[23],
                    'city'=>$result[24],
                    'state'=>$result[25],
                    'pin_code'=>$result[26],
                    'dispatch_after_date'=>$result[27],
                    'dispatch_by_date'=>$result[28],
                    'form_requirement'=>$result[29],
                    'tracking_id'=>$result[30],
                    'package_length'=>$result[31],
                    'package_breadth'=>$result[32],
                    'package_height'=>$result[33],
                    'package_weight'=>$result[34],
                    'ready_to_make'=>$result[35],
                    'with_attachment'=>$result[36],
                    );
                }
                else
                    $csv_data[] = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('order_error_session',$csv_data);
        return $orders;
    }

    public function MarketPlaceOrderPlaceStore($response,$id)
    {   $orders_id=array();
        foreach ($response as $order_id) {
            $orders_id[]=$order_id['order_id'];
        }
        $order_id=array_unique($orders_id);
        $order_id=array_values($order_id);
        $cust_id=1;
        $recall=array();
        $picklist=rand();
        $csv_fail_row = 0;
        foreach ($order_id as $key => $row) {
            $getOrders=Order::where('order_id',trim($row))->get();

            if (count($getOrders)==0) {
                $quantity=0;
                $total=0;
                $grand_total=0;
                $orderItems=array();
                $customer_id=0;
                foreach ($response as $orderItem) {
                    if($row == $orderItem['order_id']) {
                        /*check customer*/
                        $customer_id =$this->getCustomerDetails($orderItem);
                        /*end*/
                        $inventory =DB::table('inventories')->where('sku', $orderItem['sku'])->first();
                        /*recall*/
                        /*get all bin*/
                        if(!empty($inventory))
                        {
                            $bins = DB::table('inventory_bin_storage')->where('inventory_id',$inventory->id)->orderBy('created_at','asc')->orderBy('qty','asc')->get();
                            $total_recall=$orderItem['quantity'];
                            $total=0;
                            $decrement=0;
                            foreach ($bins as $bin) {
                                if ($orderItem['quantity'] >= $bin->qty && $total_recall >0) {
                                    $total_recall-=$bin->qty;
                                    $total+=$bin->qty;
                                    $diffrance =abs($orderItem['quantity'] - $total);
                                    $difault=$bin->qty >= $diffrance ?abs($bin->qty - $diffrance):0;
                                    $final=$total >$orderItem['quantity']?$difault:$bin->qty;
                                    $recall[]=array(
                                    'shop_id' =>Auth::user()->merchantId(),
                                    'inventory_id'=>$inventory->id,
                                    'sku'=>$inventory->sku,
                                    'stock'=>$inventory->stock_quantity,    
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
                                }elseif ($orderItem['quantity']<= $bin->qty && $total_recall >0) {
                                    $diffrance = abs($orderItem['quantity'] - $total);
                                    $total_recall-=$diffrance;
                                    $total+=$bin->qty;
                                    $recall[]=array(
                                    'shop_id' =>Auth::user()->merchantId(),
                                    'inventory_id'=>$inventory->id,
                                    'sku'=>$inventory->sku,
                                    'stock'=>$inventory->stock_quantity,    
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
                            $decrement=$orderItem['quantity']>0?$orderItem['quantity']:0;
                            Inventory::where('sku',trim($orderItem['sku']))->decrement('stock_quantity',$decrement);

                            $quantity+=$orderItem['quantity'];
                            $total+=$inventory->sale_price;
                            $grand_total+=$inventory->sale_price;
                            $orderItems[]=array(
                              'inventory_id'      => $inventory->id,
                              'order_item_id'     => $this->RemoveSpecialChar($orderItem['order_item_id']),
                              'item_description'  => $inventory->title.'-'.$inventory->description,
                              'quantity'          => $orderItem['quantity'],
                              'unit_price'        => $inventory->sale_price,
                              'created_at'        => Carbon::now()->toDateTimeString(),
                              'updated_at'        => Carbon::now()->toDateTimeString(),
                            );
                        }
                    }
                }
                $shipping_rates =DB::table('shipping_rates')->where('id', 21)->first();        
                $Shipping_address=DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->first();

                $billing_addres=DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->first();

                if (!empty(($billing_addres))) 
                {
                    $billing_address=$billing_addres;
                }else{

                    $billing_address=$Shipping_address;
                }
                $count_order=DB::table('orders')->get();
                $order_number=$count_order->count();
                $data=array(
                  //'order_number'      =>'#'.rand(1, 999999),
                  'order_number'      =>'#'.($order_number+100000),
                  'order_id'          =>$row,
                  'shop_id'           =>Auth::user()->merchantId(),
                  'customer_id'       =>$customer_id,
                  'item_count'        =>count($orderItems),
                  'quantity'          =>$quantity,
                  'total'             =>$grand_total,
                  'shipping_zone_id'  =>2,
                  'shipping_rate_id'  =>0,
                  'shipping_weight'   =>23,
                  'taxrate'           =>0,
                  'taxes'             =>0,
                  'shipping'          =>0,
                  'grand_total'       =>$grand_total,
                  'billing_address'   =>$billing_address->address_line_1. $billing_address->address_line_2.','.$billing_address->city.','.$billing_address->state_id.' ,('.$billing_address->zip_code.')'.  $billing_address->country_id.','.'Contact No:-'.$billing_address->phone,
                  'shipping_address'  =>$Shipping_address->address_line_1. $Shipping_address->address_line_2.','.$Shipping_address->city.','.$Shipping_address->state_id.', ('.$Shipping_address->zip_code.')'.  $Shipping_address->country_id.', '.'Contact No:-'.$Shipping_address->phone,
                  'carrier_id'        =>NULL,
                  'payment_status'    =>1,
                  'payment_method_id' =>6,
                  'order_status_id'   =>1,
                  'approved'          =>1,
                  'delivery_date'     =>Carbon::now()->toDateTimeString(),
                  'created_at'        => Carbon::now()->toDateTimeString(),
                  'updated_at'        => Carbon::now()->toDateTimeString(),
                ); 
            
                $id=Order::insertGetId($data);
                 $item = [];
                  foreach ($orderItems as $order) {
                    $inventory =DB::table('inventories')->where('id', $order['inventory_id'])->first();

                    DB::table('inventories')->where('id', $order['inventory_id'])->decrement('stock_quantity', $order['quantity']);

                        $item[] = [
                          'order_id'          => $id,
                          'order_item_id'     => $order['order_item_id'],
                          'inventory_id'      => $inventory->id,
                          'item_description'  => $inventory->title.'-'.$inventory->brand,
                          'quantity'          => $order['quantity'],
                          'unit_price'        => $order['unit_price'],
                          'created_at'        => Carbon::now()->toDateTimeString(),
                          'updated_at'        => Carbon::now()->toDateTimeString(),
                              ];   
                          $inventory_present = DB::table('inventories')->where('id',$inventory->id)->first();
                          $remaining_quantity = ($inventory_present->stock_quantity) - ($order['quantity']);

                          DB::table('inventories')->where('id',$inventory->id)->limit(1)->update(['stock_quantity'=>$remaining_quantity]);
                       }
                     \DB::table('order_items')->insert($item);
            }
            else
                $csv_data[] = $response[$csv_fail_row];

            $csv_fail_row++;
        }
        if (count($recall)>0) {
            DB::table('inventory_recall')->insert($recall);
        }

        if($csv_data)
            Session::put('order_error_session',$csv_data);
        
        return true;
           
    }

    public function MarketPlacePriceList(Request $request)
    {   
        $price = MarketPlaceFlipkartPriceListMapping::join('marketplace','marketplace.id','=','marketplace_flipkart_pricelist.marketpalce_id')->select('marketplace_flipkart_pricelist.id as map_priceList_id','marketplace.name as marketplace_name','marketplace_flipkart_pricelist.description','marketplace_flipkart_pricelist.active','marketplace_flipkart_pricelist.pricelist_id')->get();
       
        return view('admin.marketplace.shop.marketplace_pricelist',compact('price'));
    }

    public function MarketPlacePriceListStore(Request $request)
    {   
        $price = new MarketPlaceFlipkartPriceListMapping;

        $price->shop_id = Auth::user()->merchantId();
        $price->marketpalce_id = $request->marketpalce_id;
        $price->pricelist_id = $request->pricelist_id;
        $price->description = $request->description;
        $price->active = 1;
        $price->save();

        return back()->with('success', trans('PriceList Add Successfully', ['model' => $this->model_name]));
    }
    public function MarketplacePriceListDelete($id)
    {
        MarketPlaceFlipkartPriceListMapping::destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function MarketPlaceWarehouse(Request $request)
    {   
        $warehouse = MarketPlaceFlipkartWareHouseMapping::join('marketplace','marketplace.id','=','marketplace_flipkart_warehouse.marketpalce_id')->join('warehouses','marketplace_flipkart_warehouse.warehouse_id','=','warehouses.id')->select('marketplace_flipkart_warehouse.id as map_warehouse_id','marketplace.name as marketplace_name','marketplace_flipkart_warehouse.description','marketplace_flipkart_warehouse.active','marketplace_flipkart_warehouse.warehouse_id','warehouses.name as warehouses_name')->get();

        return view('admin.marketplace.shop.marketplace_warehouse_mapping',compact('warehouse'));
    }

     public function MarketPlaceshowFormWarehouse(Request $request,$id=0)
    {
        $marketpalce_id= $id;
        $warehouses = Warehouse::where('shop_id',Auth::user()->merchantId())->get();
        return view('admin.marketplace.shop._warehouse_form',compact('marketpalce_id','warehouses'));
    }

    public function MarketPlaceAddWarehouse(Request $request)
    {
        
        $warehouse = new MarketPlaceFlipkartWareHouseMapping;
        $warehouse->shop_id = Auth::user()->merchantId();
        $warehouse->marketpalce_id = $request->marketpalce_id;
        $warehouse->warehouse_id = $request->warehouse_id;
        $warehouse->description = $request->description;
        $warehouse->active = 1;
        $warehouse->save();

        return back()->with('success', trans('PriceList Add Successfully', ['model' => $this->model_name]));
    }

    public function marketplaceWarehouseDelete($id)
    {
        MarketPlaceFlipkartWareHouseMapping::destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name])); 
    }

    public function MarketPlaceOrders()
    {   
        $orders = $this->order->all();

        $archives = $this->order->trashOnly();
        return view('admin.marketplace.shop.orders_index',compact('orders','archives'));

    }

    public function MarketPlacePreviousOrders()
    {
        $orders = FlipkartPreviousOrder::where('shop_id',Auth::user()->merchantId())->get();

        //$archives = $this->order->trashOnly();
        return view('admin.marketplace.shop.orders_previous_index',compact('orders'));
    }

    function RemoveSpecialChar($str) { 
      
    // Using str_replace() function  
    // to replace the word  
    $res = str_replace( array( '\'', '"', 
    ',' , ';', '<', '>' ), ' ', $str); 
      
    // Returning the result  
    return $res; 
    } 

    public function getCustomerDetails($response=array())
    {   
        $postVal['buyer_name']=$response['buyer_name'];
        $postVal['ship_to_name']=$response['ship_to_name'];
        $postVal['address_line_1']=$response['address_line_1'];
        $postVal['address_line_2']=$response['address_line_2'];
        $postVal['state']=$response['state'];
        $postVal['pin_code']=$response['pin_code'];
        $customer = Customer::join('addresses','addresses.addressable_id','=','customers.id')->select('customers.id')->where(['addresses.addressable_type'=>'App\Customer','addresses.zip_code'=>$postVal['pin_code'],'customers.name'=>$postVal['buyer_name']])->first();

        if (!empty($customer)) {
            return $customer->id;
        }else{
            $data= array(
             "name"=>$postVal['buyer_name'],
             "nice_name"=>$postVal['buyer_name'],
             "email"=>$response['ship_to_name'].rand().'@uni.com',
             "active"=>1,
             "phone"=>rand(),
             "password"=> bcrypt(123456),
             "created_at" => Carbon::now()->toDateTimeString(),
             "updated_at" => Carbon::now()->toDateTimeString(),
            );
            $id=DB::table('customers')->insertGetId($data);
            $state=DB::table('states')->where('name',$postVal['state'])->first();
            $addresses=array(
             'address_type'   =>'Primary',
             'address_title'  =>$postVal['buyer_name'],
             'address_line_1' =>$postVal['address_line_1'],
             'address_line_2' =>$postVal['address_line_2'],
             'state_id'       =>isset($state->id)?$state->id:624,
             'country_id'     =>isset($state->country_id)?$state->country_id:356,
             'addressable_id' =>$id,
             'addressable_type'=>'App\Customer',
             'zip_code'        =>$postVal['pin_code'],
             'city'            =>$postVal['state'],
             "created_at" => Carbon::now()->toDateTimeString(),
             "updated_at" => Carbon::now()->toDateTimeString(),
             );
            DB::table('addresses')->insert($addresses);

            return $id;
        }
    }

    public function MarketPlaceReturn()
    {   
        $orders = $this->return->all();
        $archives = $this->return->trashOnly();
        return view('admin.marketplace.shop.return_index',compact('orders','archives'));

    }

    public function MarketPlaceReturnOrders($response=array(),$request)
    {   
        $orders=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[1]) && !empty($result[1])) {
                    $return_id=explode(':', $result[0]);
                    $order_item_id=explode(':', $result[1]);
                    $sku=explode(':', $result[12]);
                    if (isset($sku[1]) && isset($return_id[1]) && isset($order_item_id[1])) {
                        $orders[]=array(
                        'return_id'=>isset($return_id[1])?$return_id[1]:'',
                        'order_item_id'=>isset($order_item_id[1])?$order_item_id[1]:'',
                        'fulfilment_type'=>$result[2],
                        'return_requested_date'=>$result[3],
                        'return_approval_date'=>$result[4],
                        'return_status'=>$result[5],
                        'return_reason'=>$result[6],
                        'return_sub_reason'=>$result[7],
                        'return_type'=>$result[8],
                        'return_result'=>$result[9],
                        'return_expectation'=>$result[10],
                        'reverse_logistics_tracking_id'=>$result[11],
                        'sku'=>isset($sku[1])?$sku[1]:'',
                        'fsn'=>$result[13],
                        'product_title'=>$result[14],
                        'quantity'=>$result[15],
                        'return_completion_type'=>$result[16],
                        'primary_pv_output'=>$result[17],
                        'detailed_pv_output'=>$result[18],
                        'final_condition_of_returned_product'=>$result[19],
                        'tech_visit_sla'=>$result[20],
                        'tech_visit_by_date'=>$result[21],
                        'tech_visit_completion_datetime'=>$result[22],
                        'tech_visit_completion_breach'=>$result[23],
                        'return_completion_sla'=>$result[24],
                        'return_complete_by_date'=>$result[25],
                        'return_completion_date'=>$result[26],
                        'return_completion_breach'=>$result[27],
                        'return_cancellation_date'=>$result[28],
                        'return_cancellation_reason'=>$result[29],
                        );
                    }
                    else
                        $csv_data[] = $result;
                }
                else
                    $csv_data[] = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('return_error_session',$csv_data);
        return $orders;
    }

    public function MarketPlaceOrderPlaceReturnStore($response,$id)
    {
        // $orders_id=array();
        // foreach ($response as $order_id) {
        //     $orders_id[]=$order_id['return_id'];
        // }
        // $order_id=array_unique($orders_id);
        // $order_id=array_values($order_id);
        //return $response;
        $cust_id=1;
        $recall=array();
        $picklist=rand();
        $csv_data = array();

        foreach ($response as $key => $row) {
            $getOrders=DB::table('order_items')->where('order_item_id',$row['order_item_id'])->first();
            
            if (!empty($getOrders)) {

                $quantity=0;
                $total=0;
                $grand_total=0;
                $orderItems=array();
                $customer_id=0;
                foreach ($response as $orderItem) {
                    if ($row['return_id'] == $orderItem['return_id']) {
                        /*check customer*/
                        //$customer_id =1;
                        /*$this->getCustomerDetails($orderItem);*/
                        $customer_id =$this->getCustomerDetails($orderItem);
                        /*end*/
                        $inventory =DB::table('inventories')->where('sku', $orderItem['sku'])->first();
                        // /*recall*/
                        // /*get all bin*/
                        $bins = DB::table('inventory_bin_storage')->where('inventory_id',$inventory->id)->where('qty','!=',0)->orderBy('created_at','asc')->orderBy('qty','asc')->get();
                        $total_recall=$orderItem['quantity'];
                        $total=0;
                        $decrement=0;
                        foreach ($bins as $bin) {
                            if ($orderItem['quantity'] >= $bin->qty && $total_recall >0) {
                                $total_recall-=$bin->qty;
                                $total+=$bin->qty;
                                $diffrance =abs($orderItem['quantity'] - $total);
                                $difault=$bin->qty >= $diffrance ?abs($bin->qty - $diffrance):0;
                                $final=$total >$orderItem['quantity']?$difault:$bin->qty;
                                $recall[]=array(
                                'shop_id' =>Auth::user()->merchantId(),
                                'inventory_id'=>$inventory->id,
                                'sku'=>$inventory->sku,
                                'stock'=>$inventory->stock_quantity,    
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
                            }elseif ($orderItem['quantity']<= $bin->qty && $total_recall >0) {
                                $diffrance = abs($orderItem['quantity'] - $total);
                                $total_recall-=$diffrance;
                                $total+=$bin->qty;
                                $recall[]=array(
                                'shop_id' =>Auth::user()->merchantId(),
                                'inventory_id'=>$inventory->id,
                                'sku'=>$inventory->sku,
                                'stock'=>$inventory->stock_quantity,    
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
                        $decrement=$orderItem['quantity']>0?$orderItem['quantity']:0;
                        Inventory::where('sku',trim($orderItem['sku']))->decrement('stock_quantity',$decrement);

                        $quantity+=$orderItem['quantity'];
                        $total+=$inventory->sale_price;
                        $grand_total+=$inventory->sale_price;
                        $orderItems[]=array(
                          'inventory_id'      => $inventory->id,
                          'return_item_id'     => $this->RemoveSpecialChar($orderItem['order_item_id']),
                          'item_description'  => $inventory->title.'-'.$inventory->description,
                          'quantity'          => $orderItem['quantity'],
                          'unit_price'        => $inventory->sale_price,
                          'created_at'        => Carbon::now()->toDateTimeString(),
                          'updated_at'        => Carbon::now()->toDateTimeString(),
                        );
                    }
                }
                $shipping_rates =DB::table('shipping_rates')->where('id', 21)->first();        
                $Shipping_address=DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->first();

                $billing_addres=DB::table('addresses')->where(['addressable_id'=>$customer_id,'addressable_type'=>'App\Customer'])->first();

                if (!empty(($billing_addres))) 
                {
                    $billing_address=$billing_addres;
                }else{

                    $billing_address=$Shipping_address;
                }
                $count_order=DB::table('orders')->get();
                $order_number=$count_order->count();
                $data=array(
                  //'order_number'      =>'#'.rand(1, 999999),
                  'order_number'      =>'#'.($order_number+100000),
                  'return_order_id'   =>$row['return_id'],
                  'shop_id'           =>Auth::user()->merchantId(),
                  'customer_id'       =>$customer_id,
                  'item_count'        =>count($orderItems),
                  'quantity'          =>$quantity,
                  'total'             =>$grand_total,
                  'shipping_zone_id'  =>2,
                  'shipping_rate_id'  =>0,
                  'shipping_weight'   =>23,
                  'taxrate'           =>0,
                  'taxes'             =>0,
                  'shipping'          =>0,
                  'grand_total'       =>$grand_total,
                  'billing_address'   =>$billing_address->address_line_1. $billing_address->address_line_2.','.$billing_address->city.','.$billing_address->state_id.' ,('.$billing_address->zip_code.')'.  $billing_address->country_id.','.'Contact No:-'.$billing_address->phone,
                  'shipping_address'  =>$Shipping_address->address_line_1. $Shipping_address->address_line_2.','.$Shipping_address->city.','.$Shipping_address->state_id.', ('.$Shipping_address->zip_code.')'.  $Shipping_address->country_id.', '.'Contact No:-'.$Shipping_address->phone,
                  'carrier_id'        =>NULL,
                  'payment_status'    =>1,
                  'payment_method_id' =>6,
                  'order_status_id'   =>1,
                  'approved'          =>1,
                  'delivery_date'     =>Carbon::now()->toDateTimeString(),
                  'created_at'        => Carbon::now()->toDateTimeString(),
                  'updated_at'        => Carbon::now()->toDateTimeString(),
                ); 

                $id=ReturnOrders::insertGetId($data);
                 $item = [];
                  foreach ($orderItems as $order) {
                    $inventory =DB::table('inventories')->where('id', $order['inventory_id'])->first();

                    DB::table('inventories')->where('id', $order['inventory_id'])->increment('stock_quantity', $order['quantity']);

                        $item[] = [
                          'return_id'          => $id,
                          'return_item_id'     => $order['return_item_id'],
                          'inventory_id'      => $inventory->id,
                          'item_description'  => $inventory->title.'-'.$inventory->brand,
                          'quantity'          => $order['quantity'],
                          'unit_price'        => $order['unit_price'],
                          'created_at'        => Carbon::now()->toDateTimeString(),
                          'updated_at'        => Carbon::now()->toDateTimeString(),
                              ];   
                          $inventory_present = DB::table('inventories')->where('id',$inventory->id)->first();
                          $remaining_quantity = ($inventory_present->stock_quantity) - ($order['quantity']);

                          DB::table('inventories')->where('id',$inventory->id)->limit(1)->update(['stock_quantity'=>$remaining_quantity]);
                       }
                     \DB::table('return_order_items')->insert($item);
            }
            else
                $csv_data[] = $row;
        }
        if($csv_data)
            Session::put('return_error_session',$csv_data);

        if (count($recall)>0) {
            DB::table('inventory_recall')->insert($recall);
        }
        
        return true;
    }

    public function MarketPlaceOrdersPayments($response=array(),$request)
    {   
        $payment=array();
        $i=1;
        $ordersd=array();
        $csv_data = array();
        foreach ($response as $result) {
            if ($i > 1) {
                if (isset($result[1]) && !empty($result[1])) {
                        $payment[]=array(
                        'shop_id'=>Auth::user()->merchantId(),
                        'marketpalce_id'=>$request->marketpalce_id,
                        'neft_id'=>isset($result[0])?$result[0]:0,
                        'neft_type'=>isset($result[1])?$result[1]:0,
                        'date'=>isset($result[2])?trim($result[2]):0,
                        'settlement_value'=>isset($result[3])?$result[3]:0,
                        'order_id'=>isset($result[5])?$result[5]:0,
                        'order_item_id'=>isset($result[6])?$result[6]:0,
                        'sale_amount'=>isset($result[7])?$result[7]:0,
                        'total_offer_amount'=>isset($result[8])?$result[8]:0,
                        'my_share'=>isset($result[9])?$result[9]:0,
                        'customer_shipping_amount'=>isset($result[10])?$result[10]:0,
                        'marketplace_fee'=>isset($result[11])?$result[11]:0,
                        'tax_collected'=>isset($result[12])?$result[12]:0,
                        'tds'=>isset($result[13])?$result[13]:0,
                        'taxes'=>isset($result[14])?$result[14]:0,
                        'protection_fund'=>isset($result[15])?$result[15]:0,
                        'refund'=>isset($result[16])?$result[16]:0,
                        'order_date'=>isset($result[18])?$result[18]:0,
                        'dispatch_date'=>isset($result[19])?$result[19]:0,
                        'fulfilment_type'=>isset($result[20])?$result[20]:0,
                        'seller_sku'=>isset($result[21])?$result[21]:0,
                        'quantity'=>isset($result[22])?$result[22]:0,
                        'product_sub_category'=>isset($result[23])?$result[23]:0,
                        'additional_information'=>isset($result[24])?$result[24]:0,
                        'return_type'=>isset($result[25])?$result[25]:0,
                        'item_return_status'=>isset($result[26])?$result[26]:0,
                        'sale_amount_2'=>isset($result[28])?$result[28]:0,
                        'total_offer_amount_2'=>isset($result[29])?$result[29]:0,
                        'my_share_2'=>isset($result[30])?$result[30]:0,
                        'tier'=>isset($result[32])?$result[32]:0,
                        'commission_rate'=>isset($result[33])?$result[33]:0,
                        'commission'=>isset($result[34])?$result[34]:0,
                        'commission_fee_waiver'=>isset($result[35])?$result[35]:0,
                        'collection_fee'=>isset($result[36])?$result[36]:0,
                        'collection_fee_waiver'=>isset($result[37])?$result[37]:0,
                        'fixed_fee'=>isset($result[38])?$result[38]:0,
                        'fixed_fee_waiver'=>isset($result[39])?$result[39]:0,
                        'no_cost_emi_fee'=>isset($result[40])?$result[40]:0,
                        'installation_fee'=>isset($result[41])?$result[41]:0,
                        'uninstallation_fee'=>isset($result[42])?$result[42]:0,
                        'tech_visit_fee'=>isset($result[43])?$result[43]:0,
                        'uninstallation_packaging_fee'=>isset($result[44])?$result[44]:0,
                        'pick_and_pack_fee'=>isset($result[45])?$result[45]:0,
                        'pick_and_pack_fee_waiver'=>isset($result[46])?$result[46]:0,
                        'customer_shipping_fee_type'=>isset($result[47])?$result[47]:0,
                        'customer_shipping_fee'=>isset($result[48])?$result[48]:0,
                        'shipping_fee'=>isset($result[49])?$result[49]:0,
                        'shipping_fee_waiver'=>isset($result[50])?$result[50]:0,
                        'reverse_shipping_fee'=>isset($result[51])?$result[51]:0,
                        'franchise_fee'=>isset($result[52])?$result[52]:0,
                        'product_cancellation_fee'=>isset($result[53])?$result[53]:0,
                        'service_cancellation_fee'=>isset($result[54])?$result[54]:0,
                        'fee_discount'=>isset($result[55])?$result[55]:0,
                        'service_cancellation_charge'=>isset($result[56])?$result[56]:0,
                        'multipart_shipment'=>isset($result[58])?$result[58]:0,
                        'profiler_dead_weight'=>isset($result[59])?$result[59]:0,
                        'seller_dead_weight'=>isset($result[60])?$result[60]:0,
                        'length_breadth_height'=>isset($result[61])?$result[61]:0,
                        'volumetric_weight'=>isset($result[62])?$result[62]:0,
                        'chargeable_weight_type'=>isset($result[63])?$result[63]:0,
                        'chargeable_wt'=>isset($result[64])?$result[64]:0,
                        'shipping_zone'=>isset($result[65])?$result[65]:0,
                        'ids_invoice'=>isset($result[67])?$result[67]:0,
                        'date_invoice'=>isset($result[68])?$result[68]:0,
                        'amount_invoice'=>isset($result[28])?$result[28]:0,
                        'created_at'=>Carbon::now()->toDateTimeString(),
                        'updated_at'=>Carbon::now()->toDateTimeString()
                    );
                }
                else
                    $csv_data = $result;
            }
            $i++;
        }
        if($csv_data)
            Session::put('payment_error_session',$csv_data);
        return $payment;
    }

    public function MarketPlaceOrderPlaceOrdersPayments($response,$id)
    {  
        $csv_data = array();
        foreach ($response as $row) {
            $order_item=DB::table('order_items')->where('order_item_id',$row['order_item_id'])->first();
            if (!empty($order_item)) {
                FlipkartOrdersPayment::insert($row); 
                DB::table('order_items')->where('order_item_id',$row['order_item_id'])->update(array('paid_amount'=>$row['amount_invoice']));
            }
            else
                $csv_data = $row;
        }
        if($csv_data)
            Session::put('payment_error_session',$csv_data);
        return true;
    }

    public function MarketPlacePaymentOrders()
    {   
        $orders = $this->order->all();
        $order_payments = FlipkartOrdersPayment::where('shop_id',Auth::user()->merchantId())->get();
        //return $order_payments;
        $storeage_recall_payments = FlipkartPaymentStorageRecall::where('shop_id',Auth::user()->merchantId())->get();
        $non_order_spf_payments = FlipkartNonOrderSpfPayment::where('shop_id',Auth::user()->merchantId())->get();
        $ads_payments = FlipkartAdsPayment::where('shop_id',Auth::user()->merchantId())->get();
        $tax_details = FlipkartPaymentTaxDetail::where('shop_id',Auth::user()->merchantId())->get();
        $tcs_recovery_payments = FlipkartTcsRecoveryPayment::where('shop_id',Auth::user()->merchantId())->get();
        //$archives = $this->order->trashOnly();
        return view('admin.marketplace.shop.payment_index',compact('orders','order_payments','storeage_recall_payments','non_order_spf_payments','ads_payments','tax_details','tcs_recovery_payments'));
    }

    public function MarketPlaceReportType(Request $request)
    {   
        $field=DB::table('marketplace_report_table_field')->where('table_id',$request->id)->get();
        $html='<input type="checkbox" class="icheck" value="">All&nbsp;&nbsp';
        if (count($field)>0) {
            foreach ($field as $row) {
                $html.='<input type="checkbox" name="field[]" class="icheck" value='.$row->table_field.'>&nbsp;'.$row->title.'&nbsp;&nbsp';
            }
        }

        echo $html;
    }

    public function MarketPlaceReport(Request $request)
    {
        $orders=Order::all();
        $request->field = array('TITLE','LISTING ID','SKU','TYPE','Sale Price','New Price');
        $csv_data[] = $request->field; //array('TITLE','LISTING ID','SKU','TYPE','Sale Price','New Price');
        if(count($orders) > 0){
            foreach ($orders as $row) {
                foreach($row->inventories as $inventory)
                {
                $value=array($inventory->title,$inventory->id,$inventory->sku,$inventory->condition,$inventory->sale_price,$inventory->sale_price);
                    foreach ($row->field as $field) {
                        array_push($value, $row->$field);
                    }
                $csv_data[]=$value;
            }
            }
        }
        $csv_name = 'order_report.csv';
        $this->generateCsvFiles($csv_name,$csv_data);
    }






    //////////////////////////////////////
    public function MarketplaceListings()
    {
        $listings = MarketplaceListing::get();
        return view('admin.marketplace.marketplace_listing',compact('listings'));
    }

    public function MarketplaceListingCreate()
    {
        $marketplace = MarketPlace::get();
        return view('admin.marketplace.marketplace_listing_create',compact('marketplace'));
    }

    public function MarketplaceListingUpload(Request $request)
    {
        $i=0;
        $listing=array();
        $path = $request->file('products')->getRealPath();
        $rows = array_map('str_getcsv', file($path));
        $field_mapping = MarketplaceModuleMapping::where(['marketplace_id'=>1, 'marketplace_module_id'=>2])->first();
        //$field_mapping = array("id"=>"Null","inventory_id"=>"Null","seller_sku"=>"seller_sku_id");
        $field_mapping_data = json_decode($field_mapping->mapping);
        return $field_mapping_data[0]->seller_sku;
        return $sku;
        foreach ($rows as $result) 
        {
            if ($i > 0) 
            {
                
                    $inventroy=Inventory::where(['sku'=>$result[4],'shop_id'=>Auth::user()->merchantId()])->first();
                    if (!empty($inventroy)) 
                    {
                        $listing[] = array(
                            'shop_id'=>Auth::user()->merchantId(),
                            'marketpalce_id'=>$request->marketpalce_id,
                            'flipkart_serial_number'=>$result[0],
                            'listing_id'=>$result[1],
                            'sub_category'=>$result[2],
                            'product_code'=>$result[3],
                            'seller_sku_id'=>$result[4],
                            'mrp'=>$result[5],
                            'your_selling_price'=>$result[6],
                        );
                    }
                
            }
            $i++;
        }
        return $listing;
    }

}
