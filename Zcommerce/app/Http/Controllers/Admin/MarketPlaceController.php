<?php
namespace App\Http\Controllers\Admin;

use Auth;
use DB;
use App\MarketPlace;
use App\MarketplaceModule;
use App\MarketplaceModuleMapping;
use App\Order;
use App\Product;
use App\MarketplaceListing;
use Illuminate\Http\Request;
use App\Common\Authorizable;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepository;
use App\Http\Requests\Validations\CreateCustomerRequest;
use App\Http\Requests\Validations\UpdateCustomerRequest;


class MarketPlaceController extends Controller
{
    //use Authorizable;

    private $model_name;

    private $customer;

    /**
     * construct
     */
    public function __construct(CustomerRepository $customer)
    {
        parent::__construct();

        $this->model_name = trans('app.model.customer');

        $this->customer = $customer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marketplace = MarketPlace::all();

        return view('admin.marketplace.index', compact('marketplace'));
    }

    // function will process the ajax request
    public function getCustomers(Request $request) {

        $customers = $this->customer->all();

        return Datatables::of($customers)
            ->addColumn('option', function ($customer) {
                return view( 'admin.partials.actions.customer.options', compact('customer'));
            })
            ->editColumn('nice_name',  function ($customer) {
                return view( 'admin.partials.actions.customer.nice_name', compact('customer'));
            })
            ->editColumn('name', function($customer){
                return view( 'admin.partials.actions.customer.full_name', compact('customer'));
            })
            ->editColumn('orders_count', function($customer){
                return view( 'admin.partials.actions.customer.orders_count', compact('customer'));
            })
            ->rawColumns([ 'nice_name', 'name', 'orders_count', 'option' ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.marketplace._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

       $marketplace = MarketPlace::create($request->all());

       if ($request->hasFile('image'))
            $marketplace->saveImage($request->file('image'));

        return back()->with('success', trans('Market Place Created', ['model' => $this->model_name]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $custidomer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = $this->customer->find($id);
        $amount=DB::table('sf_wallet')->where('cust_id', '=', $id)->get();

        return view('admin.customer._show', compact('customer','amount'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addresses($id)
    {
        $customer = $this->customer->find($id);

        $addresses = $this->customer->addresses($customer);

        return view('address.show', compact('customer', 'addresses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile($id)
    {
        $customer = $this->customer->profile($id);

        return view('admin.customer.profile', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marketplace = MarketPlace::find($id);

        return view('admin.marketplace._edit', compact('marketplace'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, $id)
    {   
        if($file1 = $request->file('gstin_img_doc')){
        //$file1 = $request->file('gstin_img_doc');
        $name1 = time().$file1->getClientOriginalName();
        $file1->move('images/customer', $name1);
        $request['gstin_img']=$name1;
       }
       if($file2 = $request->file('pan_doc_img')){
        //$file2 = $request->file('pan_doc_img');
        $name2 = time().$file2->getClientOriginalName();
        $file2->move('images/customer', $name2);
        $request['pan_no_img']=$name2;
        }
         if($file3 = $request->file('comp_doc_img2')){
        // $file3 = $request->file('comp_doc_img2');
        $name3 = time().$file3->getClientOriginalName();
        $file3->move('images/customer', $name3);
        $request['comp_doc_img']=$name3;
       }
       
        if( env('APP_DEMO') == true && $id <= config('system.demo.customers', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->customer->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.customers', 1) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->customer->trash($id);

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
        $this->customer->restore($id);

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
        $this->customer->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function custcredit(Request $request){

         $amount=DB::table('sf_wallet')->where('cust_id', '=', $request->customers_id)->get();

        $total=$amount[0]->wallet_amnt+$request->amt;
        DB::table('sf_wallet')->where('cust_id', '=', $request->customers_id)->update(['wallet_amnt'=>$total,'use'=>$request->use]);

          return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));

    }

    public function current_balance(Request $request){

        return 'Hii';
    }

    public function MarketplaceModule()
    {
        $marketplace_module = MarketplaceModuleMapping::get();
        return view('admin.marketplace.module_mapping_list', compact('marketplace_module'));
    }

    public function MarketplaceModuleCreate()
    {
        $order = new Order;
        $table_column_name = $order->getTableColumns();

        $marketplaces = MarketPlace::get();
        $marketplace_modules = MarketplaceModule::get();
        return view('admin.marketplace.module_mapping_create',compact('table_column_name','marketplaces','marketplace_modules'));
    }

    public function MarketplaceModuleField($marketplacemodule_id)
    {
        //$MarketplaceModule = MarketplaceModule::find($marketplacemodule_id);
        if($marketplacemodule_id == 1)
            $object = new Product;

        if($marketplacemodule_id == 2)
            $object = new MarketplaceListing;

        if($marketplacemodule_id == 3)
            $object = new Order;
        
        $table_column_name = $object->getTableColumns();
        $view = view('admin.marketplace.module_mapping_field', ['table_column_name' => $table_column_name])->render();
        return $view;
    }

    public function MarketplaceModuleStore(Request $request)
    {
        for($i=0; $i<count($request->column_name); $i++)
        {
            $mapping_name = $request->mapping_name[$i] ? $request->mapping_name[$i] : 'Null';
            $data[] = $request->column_name[$i].':'.$mapping_name;
        }
        $mapping_data = array(
            'marketplace_id' => $request->marketplace_id,
            'marketplace_module_id' => $request->marketplace_module_id,
            'mapping' => json_encode($data)
        );

        MarketplaceModuleMapping::create($mapping_data);
        return redirect()->back()->with('success','Mapping Done');
    }

    public function MarketplaceModuleEdit(Request $request,$id)
    {
        $order = new Order;
        $table_column_name = $order->getTableColumns();

        $marketplaces = MarketPlace::get();
        $marketplace_modules = MarketplaceModule::get();
        $a = MarketplaceModuleMapping::find($id);
        //return $a;
        return view('admin.marketplace.module_mapping_edit',compact('table_column_name','marketplaces','marketplace_modules','a'));
    }

    public function MarketplaceModuleUpdate(Request $request,$id)
    {
        for($i=0; $i<count($request->column_name); $i++)
        {
            $mapping_name = $request->mapping_name[$i] ? $request->mapping_name[$i] : 'Null';
            $data[] = $request->column_name[$i].':'.$mapping_name;
        }
        $mapping_data = array(
            'marketplace_id' => $request->marketplace_id,
            'marketplace_module_id' => $request->marketplace_module_id,
            'mapping' => json_encode($data)
        );

        MarketplaceModuleMapping::where('id',$id)->update($mapping_data);
        return redirect()->back()->with('success','Mapping Done');
    }

}
