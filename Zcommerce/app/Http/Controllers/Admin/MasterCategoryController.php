<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master_cat;

class MasterCategoryController extends Controller
{  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $master_categories = Master_cat::get();

        return view('admin.category.master_category', compact('master_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category._createMaster');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('image'))
        {
            $path = 'images/';
            $image = $this->imageUpload($request->file('image'), $path);
        }
        else
            $image = '';  

        $data = array(
            'name' => $request->name,
            'image' => $image,
            'status' => $request->status ? $request->status : 1,
        );
        Master_cat::insert($data);
        return back()->with('success', 'Master Cateogry created');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $master_category = Master_cat::where('cate_id',$id)->first();
        return view('admin.category._editMaster', compact('master_category'));
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
        $master_cat = Master_cat::where('cate_id',$id)->first();
        if($request->hasFile('image'))
        {
            $path = 'images/';
            $image = $this->imageUpload($request->file('image'), $path);
        }
        else
            $image = $master_cat->image;  

        $data = array(
            'name' => $request->name,
            'image' => $image,
            'status' => $request->status ? $request->status : 1,
        );
        Master_cat::where('cate_id',$id)->update($data);

        return back()->with('success', 'Master Category Updated');
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
        Master_cat::where('cate_id',$id)->delete();
        return back()->with('success','');
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
        //$this->category->restore($id);

        return back()->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //$this->category->destroy($id);

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }

}
