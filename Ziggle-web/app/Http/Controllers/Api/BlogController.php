<?php

namespace App\Http\Controllers\Api;
use DB;
use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blogs = Blog::recent()->published()->with(['image','author:id,name,nice_name','tags'])
        ->withCount('comments')->paginate(config('mobile_app.view_listing_per_page', 8));

        return BlogResource::collection($blogs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {
        $blog = Blog::where('slug', $slug)->published()->withCount('comments')
        ->with('publishedComments','publishedComments.author')->firstOrFail();

        return new BlogResource($blog);
       // return $this->processResponse('Product_listings',$list_of_products,'success','Category wise products show successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');

    }
}