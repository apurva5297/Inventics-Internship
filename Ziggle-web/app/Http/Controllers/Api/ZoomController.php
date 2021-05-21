<?php

namespace App\Http\Controllers\Api;
use DB;
use Auth;
use App\Product;
use App\Wishlist;
use App\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductWishlistResource;
use App\Http\Resources\WishlistResource;
use App\Http\Requests\Validations\DirectCheckoutRequest;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class ZoomController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        { 
            $zoom_data = DB::table('zoom_data')->where('customer_id',$cust_id->user_id)->get();

        return $this->processResponse('Webinar_details',$zoom_data,'success','Webinar data show successfully!!');
    } 
      else
          return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function store(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        { 
            DB::table('zoom_data')->insert(
                ['product_id' => trim($request->product_id,'"'),
                'customer_id'=> $cust_id->user_id,
                'host_name'=> $request->host_name,
                'start_time'=> $request->start_time,
                'end_time'=> $request->end_time,
                'date'=> $request->date,
                'meeting_number'=> $request->meeting_number,
                'meeting_password'=> $request->meeting_password,
                'topic'=> $request->topic,
                'status'=>$request->status,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                ]
            ); 
        return $this->processResponse(null,null,'success','Webinar data store successfully!!');
    } 
      else
          return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Add item to the wishlist.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        { 
            $zoom_data = DB::table('zoom_data')->where('meeting_number',$request->meeting_number)->delete();

            return $this->processResponse(null,null,'success','Webinar deleted successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }

}