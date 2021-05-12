<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryGroup\CategoryGroupRepository;
use App\Http\Requests\Validations\CreateCategoryGroupRequest;
use App\Http\Requests\Validations\UpdateCategoryGroupRequest;
use DB;
use App\Master_cat;

class CategoryGroupController extends Controller
{
    use Authorizable;

    private $model_name;

    private $categoryGroup;

    /**
     * construct
     */
    public function __construct(CategoryGroupRepository $categoryGroup)
    {
        parent::__construct();
        $this->model_name = trans('app.model.category_group');
        $this->categoryGroup = $categoryGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryGrps = $this->categoryGroup->all();

        $trashes = $this->categoryGroup->trashOnly();
        
        return view('admin.category.categoryGroup', compact('categoryGrps', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $master_cat = DB::table('master_categories')->pluck('name','cate_id');

        return view('admin.category._createGrp',compact('master_cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryGroupRequest $request)
    {
        $this->categoryGroup->store($request);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryGroup = $this->categoryGroup->find($id);
        $master_cat = DB::table('master_categories')->pluck('name','cate_id');
        return view('admin.category._editGrp', compact('categoryGroup','master_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryGroupRequest $request, $id)
    {
        if( env('APP_DEMO') == true && $id <= config('system.demo.category_groups', 9) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->categoryGroup->update($request, $id);

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
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
        if( env('APP_DEMO') == true && $id <= config('system.demo.category_groups', 9) )
            return back()->with('warning', trans('messages.demo_restriction'));

        $this->categoryGroup->trash($id);

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
        $this->categoryGroup->restore($id);

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
        $this->categoryGroup->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

}
