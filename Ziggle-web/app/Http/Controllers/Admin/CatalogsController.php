<?php
namespace App\Http\Controllers\Admin;

use App\Catalog;
use App\Product;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use App\Http\Requests\Validations\CreateCategoryRequest;
use App\Http\Requests\Validations\UpdateCategoryRequest;

class CatalogsController extends Controller
{
   
    public function index()
    {
        $catalogs = Catalog::all();
        return view('admin.catalogs.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.catalogs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $catalog = new Catalog;
        $catalog->catalog_name = $request->name;
        $catalog->active = $request->active;
        $catalog->save();
        return back()->with('success', trans('messages.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catalog = Catalog::find($id);

        return view('admin.catalogs.edit', compact('catalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $catalog = Catalog::find($id);
        $catalog->catalog_name = $request->name;
        $catalog->active = $request->active;
        $catalog->save();
        
        return back()->with('success', trans('messages.updated', ['model' => 'Catalogs']));
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
        // Check for association with products
        if($this->category->find($id)->products->count()){
            return back()->with('error', trans('messages.failed'))
            ->with('global_notice', trans('messages.model_has_association', ['model' => $this->model_name, 'associate' => trans('app.products')]));
        }

        $this->category->trash($id);

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
        $this->category->restore($id);

        return back()->with('success', trans('messages.restored', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $catalog = Catalog::find($id);
            $product_id[] ="";
            foreach($catalog->products as $product)
            {
                $product_id[] = $product->id;
            }
            $catalog->products()->detach($product_id);
       
        $catalog->delete();
        return back()->with('success',  trans('messages.deleted', ['model' => 'Catalog']));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massTrash(Request $request)
    {
        $this->category->massTrash($request->ids);

        if($request->ajax())
            return response()->json(['success' => trans('messages.trashed', ['model' => $this->model_name])]);

        return back()->with('success', trans('messages.trashed', ['model' => $this->model_name]));
    }

    /**
     * Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function massDestroy(Request $request)
    {
        $this->category->massDestroy($request->ids);

        if($request->ajax())
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model_name])]);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    /**
     * Empty the Trash the mass resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function emptyTrash(Request $request)
    {
        $this->category->emptyTrash($request);

        if($request->ajax())
            return response()->json(['success' => trans('messages.deleted', ['model' => $this->model_name])]);

        return back()->with('success', trans('messages.deleted', ['model' => $this->model_name]));
    }

    public function products(Request $request,$id)
    {
        $catalog = Catalog::find($id);
        
        return view('admin.catalogs._create',compact('p','catalog'));
    }

    public function add_products(Request $request,$id)
    {
            $catalog = Catalog::find(1);
            $catalog->products()->attach($request->id);
    }

    public function products_store(Request $request)
    {
        $catalog = Catalog::find($request->cat_id);
        $a=$catalog->products()->attach($request->product_id);
        
        return view('admin.catalogs._create',compact('catalog'));
    }

    public function delete_products(Request $request)
    {
        $catalog = Catalog::find($request->cat_id);
        $catalog->products()->detach($request->product_id);

        return view('admin.catalogs._create',compact('catalog'));
    }

    public function getProducts(Request $request) {

        $products = Product::all();
        
        return Datatables::of($products)
            ->editColumn('checkbox', function($product){
                return view( 'admin.partials.actions.product.checkbox', compact('product'));
            })
            ->addColumn('option', function ($product) {
                return view( 'admin.partials.actions.product.options', compact('product'));
            })
            ->editColumn('image', function($product){
                return view( 'admin.partials.actions.product.image', compact('product'));
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
            ->editColumn('added_by', function($product){
                return view( 'admin.partials.actions.product.added_by', compact('product'));
            })
            ->rawColumns([ 'image', 'name', 'gtin', 'category', 'inventories_count', 'added_by', 'status', 'checkbox', 'option' ])
            ->make(true);
    }
}
