<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Slider;
use App\Category;
use App\Inventory;     
use App\CategoryGroup;
use App\Helpers\ListHelper;
use App\CategorySubGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\SliderResource;
use App\Http\Resources\ListingResource;
use App\Http\Resources\CategoryGroupResource;
use App\Http\Resources\CategorySubGroupResource;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;

class CategoryController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $sub_group = Null)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {
        if($sub_group) {
            $categories = Category::where('category_sub_group_id', $sub_group)->with(['featuredImage'])->active()->get();
        }
        else {
            $categories = Category::with(['featuredImage'])->active()->get();
        }

        $category_sub_groups = CategoryResource::collection($categories);
        
     
        // $sliders = Slider::whereHas('mobile')->with('mobile')->get();
        // $slider = SliderResource::collection($sliders);
        $slider = array();
        
        //Trending Products 
        $category = Category::where('category_sub_group_id', $sub_group)->first();
        if($category == null)
        {
            return $this->processResponse(null,null,'failed','Sub category not found');
        }
        
        $listings = ListHelper::latest_categories_available_items(4,$category->id);
        
        $latest_arrivals = ListingResource::collection($category->listings);
        //Banners 
        // $banners = Banner::with(['bannerbg', 'featuredImage'])->get();
        // $banner = BannerResource::collection($banners);
        $banner = array();

        //Best Seller
        // $best_sellers = ListHelper::best_sellers(4,$category->id);

        // $best_seller = ListingResource::collection($best_sellers);
        $best_seller = array();

        $data = array(
            'categories'=>$category_sub_groups,
            'sliders'=>$slider,
            'latest_arrivals'=>$latest_arrivals,
            'banners'=>$banner,
            'best_seller'=>$best_seller
        );

        return $this->processResponse('Category_sub_group',$data,'success','Category Sub Group Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categoryGroup(Request $request)
    {
      $cust_id= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
      if($cust_id)
    {
        $categories = CategoryGroup::with(['featuredImage'])->active()->get();

        $category_group = CategoryGroupResource::collection($categories);
        return $this->processResponse('Category_group',$category_group,'success','Category Group Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categorySubGroup(Request $request, $group = Null)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {
        if($group){
            $categories = CategorySubGroup::where('category_group_id', $group)
            ->with(['featuredImage'])->active()->get();
        }
        else{
            $categories = CategorySubGroup::with(['featuredImage'])->active()->get();
        }

        $category_sub_groups = CategorySubGroupResource::collection($categories);
        return $this->processResponse('Category_sub_group',$category_sub_groups,'success','Category Sub Group Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function categories(Request $request, $sub_group = Null)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->first();
        if($cust_id)
      {
        if($sub_group) {
            $categories = Category::where('category_sub_group_id', $sub_group)->with(['featuredImage'])->active()->get();
        }
        else {
            $categories = Category::with(['featuredImage'])->active()->get();
        }

        $category_sub_groups = CategoryResource::collection($categories);
        return $this->processResponse('Category_sub_group',$category_sub_groups,'success','Category Sub Group Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }
}