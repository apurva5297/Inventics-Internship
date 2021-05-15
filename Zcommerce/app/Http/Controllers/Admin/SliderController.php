<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CreateSliderRequest;
use App\Http\Requests\Validations\UpdateSliderRequest;

class SliderController extends Controller
{
    use Authorizable;

    private $model_name;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->model_name = trans('app.model.slider');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::with('featuredImage', 'images')->orderBy('order', 'asc')->get();

        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider._create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSliderRequest $request)
    {
  

        $slider = Slider::create($request->all());
      

        if ($request->hasFile('image'))
        $slider->saveImage($request->file('image'), true);
        // {
        //     foreach ( $request->image as $image) {
        //         $imageName = request()->image->getClientOriginalName();
        //         request()->image->move(public_path('upload'), $imageName);
        
        
        //         return response()->json(['uploaded' => '/upload/'.$imageName]);
                
        //     }
        // }
    
        // if ($request->hasFile('image'))
        //  { 
        // $data=[];
        // foreach($request->file('image') as $image)
        //     {
      
        //        // $image->move(public_path().'/images/', $name);  
        //         $data[]=[
        //            'name' => $image->getClientOriginalName(),
        //         ];  
        //     }

        //     $file= new Slider();
        //     $file->image=json_encode($data);
        //     $file->save();
        //  }
         

        
           
       // $slider->saveImage($request->file('image'), true);

        

        if ($request->hasFile('thumb'))
            $slider->saveImage($request->file('thumb'));

        return back()->with('success', trans('messages.created', ['model' => $this->model_name]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        return view('admin.slider._edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $slider->update($request->all());

        if ($request->hasFile('image') || ($request->input('delete_image') == 1)){
            if($slider->featuredImage)
                $slider->deleteImage($slider->featuredImage);
        }

        if ($request->hasFile('image'))
            $slider->saveImage($request->file('image'), true);

        if ($request->hasFile('thumb') || ($request->input('delete_thumb') == 1)){
            if($slider->images->first())
                $slider->deleteImage($slider->images->first());
        }

        if ($request->hasFile('thumb'))
            $slider->saveImage($request->file('thumb'));

        return back()->with('success', trans('messages.updated', ['model' => $this->model_name]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->flushImages();

        $slider->forceDelete();

        return back()->with('success',  trans('messages.deleted', ['model' => $this->model_name]));
    }
}
