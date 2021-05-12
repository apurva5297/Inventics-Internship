<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\CategorySubGroup;
use App\Http\Requests\Validations\CreateCategorySubGroupRequest;
use App\Http\Requests\Validations\UpdateCategorySubGroupRequest;
use App\Repositories\CategorySubGroup\CategorySubGroupRepository;

class CategorySubGroupController extends Controller
{
    use Authorizable;

    private $model_name;

    private $categorySubGroup;

    /**
     * construct
     */
    public function __construct(CategorySubGroupRepository $categorySubGroup)
    {
        parent::__construct();
        $this->model_name = trans('app.model.category_group');
        $this->categorySubGroup = $categorySubGroup;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorySubGrps = $this->categorySubGroup->all();

        $trashes = $this->categorySubGroup->trashOnly();

        return view('admin.category.categorySubGroup', compact('categorySubGrps', 'trashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category._createSubGrp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategorySubGroupRequest $request)
    {
        if($request->hasFile('image'))
        {
            $path = 'images/';
            $image = $this->imageUpload($request->file('image'), $path);
        }
        else
            $image = '';
        $request->image = $image;

        $data = array(
            'name'=>$request->name, 'category_group_id'=>$request->category_group_id, 'slug'=>$request->slug, 'description'=>$request->description,'image'=>$image, 'active'=>$request->active
        );

        CategorySubGroup::create($data);

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    public function imageUpload($request_image_name, $path)
    {
            $random = rand(0,10000);
            $image= $request_image_name;
            
            $image_name = $image->getClientOriginalName();
            $image_extension = $image->getClientOriginalExtension();
            //return $image_extension;
            //$display_image_name_only = explode('.'.$display_image_extension,$display_image_name);
            $new_name = time().'.'.$image->getClientOriginalExtension();
            // if($image_extension != 'jpeg' || $image_extension != 'png' || $image_extension != 'jpg' || $image_extension != 'gif')
            //     return 'not-supported-image-format.png';

            $destinationPath = public_path($path);
            $image->move($destinationPath, $random.$new_name);
            return $path.$random.$new_name;
            
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $categorySubGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorySubGroup = $this->categorySubGroup->find($id);

        return view('admin.category._editSubGrp', compact('categorySubGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorySubGroupRequest $request, $id)
    {
        $category_sub_group = CategorySubGroup::find($id);
        if($request->hasFile('image'))
        {
            $path = 'images/';
            $image = $this->imageUpload($request->file('image'), $path);
        }
        else
            $image = $category_sub_group->image;

        $data = array(
            'name'=>$request->name, 'category_group_id'=>$request->category_group_id, 'slug'=>$request->slug, 'description'=>$request->description,'image'=>$image, 'active'=>$request->active
        );

        CategorySubGroup::where('id',$id)->update($data);

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
        $this->categorySubGroup->trash($id);

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
        $this->categorySubGroup->restore($id);

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
        $this->categorySubGroup->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

}
