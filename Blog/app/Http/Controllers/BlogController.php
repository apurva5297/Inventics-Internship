<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Tag;
use App\Category;
use Session;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Photo;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $name=($request->searchB) ? $request->searchB:'';
        $blogs=Blog::search('name',$name)->paginate(10);
        return view('Blog.index',compact('blogs','name'))
        ;
    }
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        return view('Blog.create',compact('tags','categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:blogs,name|min:3',
            'description'=>'required',
            'category'=>'required',
            'tags'=>'required'
        ]);
        $blog= new Blog;
        $blog->name=$request->name;
        $blog->description=$request->description;
        $blog->category_id=$request->category;
        if($request->file('image'))
        {
            $extension=$request->file('image')->getClientOriginalExtension();
            if($extension!='png' || $extension!='jpg' || $extension!='jpeg')
            {
                session()->flash('danger', 'uploaded file is not an image! TRY AGAIN');
                return redirect()->back();
            }
            $image_name=$this->uploadImage($request->file('image'));
            $blog->image=$image_name;
        }
        $blog->save();
        $blog->tags()->sync($request->tags);
        session()->flash('success', 'Blog Created successfully!');
        return redirect()->route('blog.index');
    }

    public function show(Blog $blog)
    {
        return view('Blog.show')->withBlog($blog);
    }

    public function edit($id)
    {
       $blog=Blog::find($id);
       $categories=Category::all();
       $tags=Tag::all();
       return view('Blog.edit',compact('blog','tags','categories'));
    }
    public function update(Request $request,$id)
    {
        
        $request->validate([
            'name'=>'required|unique:blogs,name,'.$id,
            'description'=>'required',
            'category'=>'required',
            'tags'=>'required',
        ]);
        $blog=Blog::find($id);
        $blog->name=$request->name;
        $blog->description=$request->description;
        if($request->file('image'))
        {
            $extension=$request->file('image')->getClientOriginalExtension();
            // dd($extension);
            // if($extension!=='png' || $extension!=='jpg' || $extension!=='jpeg')
            // {
            //     session()->flash('danger', 'uploaded file is not an image! TRY AGAIN');
            //     return redirect()->back();
            // }
            if($blog->image)
            $delete=$this->delete_image($blog->image);

            $filename=$this->uploadImage($request->file('image'));
            $blog->image=$filename;
        }
       $blog->save();
       $blog->tags()->sync($request->tags);
       session()->flash('warning', 'Blog Updated successfully!');
       return redirect()->route('blog.index');
    }

    public function destroy($id)
    {
        $Blog=Blog::find($id);
        $Blog->delete();
        session()->flash('danger', 'Blog Deleted successfully!');
        return redirect()->back();
    }
    public function uploadImage($image)
    {
        $random_name=time(); //random name
        $extension=$image->getClientOriginalExtension();
        $filename=$random_name.'.'.$extension;
        Photo::make($image)->save(public_path('image/'. $filename));
        return $filename;
    }
    private function delete_image($image)
    {
        $filename = public_path('image/' . $image);
        unlink($filename);
    }
    public function delete_image_only($id)
    {
        $data = Blog::find($id);
        $image= $data->image;
        $image_path =public_path('image/' . $image);
        unlink($image_path);
        $data->image=NULL;
        $data->save();
        return redirect()->route('blog.edit',$id);

    }
}