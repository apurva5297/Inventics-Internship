<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepository;
use App\Http\Requests\Validations\CreateProductRequest;
use App\Http\Requests\Validations\UpdateProductRequest;
use Illuminate\Support\Str;
use DB;
use App\Category;
use App\Product;
use Auth;
class ProductController extends Controller
{
    use Authorizable;

    private $model;

    private $product;

    /**
     * construct
     */
    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->model = trans('app.model.product');
        $this->product = $product;
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $products = $this->product->all();

        $trashes = $this->product->trashOnly();

        return view('admin.product.index', compact('trashes','products'));
    }

    // function will process the ajax request
    public function getProducts(Request $request) {

        $products = $this->product->all();

        return Datatables::of($products)
            ->addColumn('option', function ($product) {
                return view( 'admin.partials.actions.product.options', compact('product'));
            })
            ->editColumn('name', function($product){
                return view( 'admin.partials.actions.product.name', compact('product'));
            })
            ->editColumn('gtin', function($product){
                return view( 'admin.partials.actions.product.gtin', compact('product'));
            })
            ->editColumn('category',  function ($product) {
                return view( 'admin.partials.actions.product.category', compact('product'));
            })
            ->editColumn('inventories_count', function($product){
                return view( 'admin.partials.actions.product.inventories_count', compact('product'));
            })
            ->rawColumns([ 'name', 'gtin', 'category', 'inventories_count', 'status', 'option' ])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Request $request)
    // {
    //     return $request;
    // }
    public function store(CreateProductRequest $request)
    {
        //$this->authorize('create', \App\Product::class); // Check permission

        $product = $this->product->store($request);

        $request->session()->flash('success', trans('messages.created', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        $this->authorize('view', $product); // Check permission

        return view('admin.product._show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->product->find($id);

        $this->authorize('update', $product); // Check permission

        $preview = $product->previewImages();

        return view('admin.product.edit', compact('product', 'preview'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = $this->product->update($request, $id);

        $this->authorize('update', $product); // Check permission

        $request->session()->flash('success', trans('messages.updated', ['model' => $this->model]));

        return response()->json($this->getJsonParams($product));
    }

    /**
     * Trash the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request, $id)
    {
        $this->product->trash($id);

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
        $this->product->restore($id);

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
        $this->product->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model]));
    }

    /**
     * return json params to procceed the form
     *
     * @param  Product $product
     *
     * @return array
     */
    private function getJsonParams($product){
        return [
            'id' => $product->id,
            'model' => 'product',
            'redirect' => route('admin.catalog.product.index')
        ];
    }

    public function fetchData(Request $request)
    {


        $columns = array( 
                0 =>'name', 
                1 =>'gtin',
                2=> 'model_number',
                3=> 'category',
                4=> 'listing',
                4=> 'option',
            );
          
        /*is shop*/
        if (Auth::user()->merchantId()) {
            $totalData = Product::where('shop_id',Auth::user()->merchantId())->count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');

            if(empty($request->input('search.value')))
            {            
                $posts = Product::where('shop_id',Auth::user()->merchantId())->offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('categories', 'featuredImage', 'image')
                             ->withCount('inventories')
                             ->get();
            }else {
               $search = $request->input('search.value'); 

                $posts =  Product::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('gtin', 'LIKE',"%{$search}%")
                             ->orWhere('model_number', 'LIKE',"%{$search}%")
                            ->with('categories', 'featuredImage', 'image')
                            ->withCount('inventories')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = Product::where('shop_id',Auth::user()->merchantId())
                             ->where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('gtin', 'LIKE',"%{$search}%")
                             ->orWhere('model_number', 'LIKE',"%{$search}%")
                             ->with('categories', 'featuredImage', 'image')
                             ->withCount('inventories')
                             ->count();
            }
        }else{
            /*admin*/
            $totalData = Product::count();
            
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
            
            if(empty($request->input('search.value')))
            {            
                $posts = Product::offset($start)
                             ->limit($limit)
                             ->orderBy($order,$dir)
                             ->with('categories', 'featuredImage', 'image')
                             ->withCount('inventories')
                             ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $posts =  Product::where('id','LIKE',"%{$search}%")
                            ->orWhere('name', 'LIKE',"%{$search}%")
                            ->orWhere('gtin', 'LIKE',"%{$search}%")
                             ->orWhere('model_number', 'LIKE',"%{$search}%")
                            ->with('categories', 'featuredImage', 'image')
                            ->withCount('inventories')
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

                $totalFiltered = Product::where('id','LIKE',"%{$search}%")
                             ->orWhere('name', 'LIKE',"%{$search}%")
                             ->orWhere('gtin', 'LIKE',"%{$search}%")
                             ->orWhere('model_number', 'LIKE',"%{$search}%")
                             ->with('categories', 'featuredImage', 'image')
                             ->withCount('inventories')
                             ->count();
            }
        }

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $product)
            {   
                $option = view( 'admin.partials.actions.product.options', compact('product'))->render();
                $name   = view( 'admin.partials.actions.product.name', compact('product'))->render();
                $gtin = view( 'admin.partials.actions.product.gtin', compact('product'))->render();
                $category = view( 'admin.partials.actions.product.category', compact('product'))->render();
                $inventories_count= view( 'admin.partials.actions.product.inventories_count', compact('product'))->render();
                $nestedData['name'] = $name;
                $nestedData['gtin'] = $gtin;
                $nestedData['model_number'] = $product->model_number;
                $nestedData['category'] = $category;
                $nestedData['listing'] = $inventories_count;
                $nestedData['options'] = $option;
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
    
}