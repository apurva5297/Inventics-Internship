<?php

namespace App\Http\Controllers\Api;

use App\Banner;
use App\Slider;
use App\Category;
use App\Order;
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
use Carbon;

class BonusController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bonus_tracker(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      {
        $mytime = Carbon\Carbon::now(); 
        $today = $mytime->toDateTimeString();
        $current_year = date("20y", strtotime($today));
        $current_month = date("m", strtotime($today));
        $current_date = date("d", strtotime($today)); 
        $current_format_date = $current_year.'-'.$current_month.'-'.$current_date;
        $date = Carbon\Carbon::create($current_year, $current_month, $current_date); 
        $start_day_of_week = $date->startOfWeek();
        $start_day = $start_day_of_week->toDateTimeString();
        $end_day_of_week = $date->endOfWeek();
        $end_day = $end_day_of_week->toDateTimeString();

        $start_week_year = date("20y", strtotime($start_day));
        $start_week_month = date("m", strtotime($start_day));
        $start_week_date = date("d", strtotime($start_day)); 
        $start_date = $start_week_year.'-'.$start_week_month.'-'.$start_week_date;
        $end_week_year = date("20y", strtotime($end_day));
        $end_week_month = date("m", strtotime($end_day));
        $end_week_date = date("d", strtotime($end_day)); 
        $end_date = $end_week_year.'-'.$end_week_month.'-'.$end_week_date;

         //Total value of verified orders
         $value_of_verified_orders = DB::table('orders')
         ->where('customer_id',$cust_id->user_id)
         ->where('order_status_id',6)
         ->whereBetween('created_at', [$start_day, $end_day])
         ->sum('total');

         //Total value of pending orders
         $value_of_pending_orders = DB::table('orders')
         ->where('customer_id',$cust_id->user_id)
         ->where('order_status_id',1)
         ->whereBetween('created_at', [$start_day, $end_day])
         ->sum('total'); 

        
        //Bonus Paid
         $bonus_paid = DB::table('bonuses')
         ->where('start_date',$start_day)
         ->where('end_date',$end_day)
         ->where('customer_id',$cust_id->user_id)
         ->where('order_status','Delivered')
        ->where('bonus_type','Bonus Paid')
        ->sum('bonus_paid');

         //Bonus Outstanding
         $bonus_outstanding = DB::table('bonuses')
         ->where('start_date',$start_day)
         ->where('end_date',$end_day)
         ->where('customer_id',$cust_id->user_id)
         ->where('order_status','Pending')
        ->where('bonus_type','Outstanding Bonus')
        ->sum('bonus_outstanding');

          //Bonus Order Count
          $bonus_order_count = DB::table('bonuses')
          ->where('start_date',$start_day)
          ->where('end_date',$end_day)
          ->where('customer_id',$cust_id->user_id)
         ->where('bonus_type','Bonus Paid')
         ->count();

         $total_sale = $value_of_pending_orders + $value_of_verified_orders;
         
         $bonus_targets = DB::table('bonus_target')->get();
         $level = 0;
         $level_bonus = 0;
         if($total_sale >= 5000 && $total_sale<=10000)
         {
            $level = 6;
            $level_bonus = (6/100) * $total_sale;
         }
         else if($total_sale >= 10000 && $total_sale <=20000)
         {
           $level = 8;
           $level_bonus = (8/100) * $total_sale;
         }
         else if($total_sale >=20000 && $total_sale <=50000 )
         {
           $level = 10;
           $level_bonus = (10/100) * $total_sale;
         }
         else if($total_sale >= 50000)
         {
           $level = 12;
           $level_bonus = (12/100) * $total_sale; 
         }

         //Total of paid and outstanding orders
         $bonus_total = $bonus_paid + $bonus_outstanding;

         $p = array(
           'bonus_paid'=>$bonus_paid,
           'bonus_outstanding'=> $bonus_outstanding,
           'bonus_earned'=> $bonus_total,
           'start_current_week_date'=>$start_date,
           'end_current_week_date'=>$end_date,
           'no_of_verified_order_current_week'=>$bonus_order_count,
           'total_value_of_verified_orders_current_week'=>$value_of_verified_orders,
           'total_value_of_pending_orders_current_week'=>$value_of_pending_orders,
           'percentage_of_level_achieved'=>$level,
           'level_bonus'=>$level_bonus,
           'Bonus_Targets'=>$bonus_targets,
           'total_sale'=>$total_sale
         );
      
        return $this->processResponse('Bonus_Details',$p,'success','Bonus Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function bonus_tracker_order(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust_id)
      {
        $mytime = Carbon\Carbon::now(); 
        $today = $mytime->toDateTimeString();
        $current_year = date("20y", strtotime($today));
        $current_month = date("m", strtotime($today));
        $current_date = date("d", strtotime($today)); 
        $current_format_date = $current_year.'-'.$current_month.'-'.$current_date;
        $date = Carbon\Carbon::create($current_year, $current_month, $current_date); 
        $start_day_of_week = $date->startOfWeek();
        $start_day = $start_day_of_week->toDateTimeString();
        $end_day_of_week = $date->endOfWeek();
        $end_day = $end_day_of_week->toDateTimeString();

        $start_week_year = date("20y", strtotime($start_day));
        $start_week_month = date("m", strtotime($start_day));
        $start_week_date = date("d", strtotime($start_day)); 
        $start_date = $start_week_year.'-'.$start_week_month.'-'.$start_week_date;
        $end_week_year = date("20y", strtotime($end_day));
        $end_week_month = date("m", strtotime($end_day));
        $end_week_date = date("d", strtotime($end_day)); 
        $end_date = $end_week_year.'-'.$end_week_month.'-'.$end_week_date;
        
        //Bonus Paid
         $bonus_paid = DB::table('bonuses')
         ->where('start_date',$start_day)
         ->where('end_date',$end_day)
         ->where('customer_id',$cust_id->user_id)
         ->where('order_status','Delivered')
        ->where('bonus_type','Bonus Paid')
        ->sum('bonus_paid');

         //Bonus Outstanding
         $bonus_outstanding = DB::table('bonuses')
         ->where('start_date',$start_day)
         ->where('end_date',$end_day)
         ->where('customer_id',$cust_id->user_id)
         ->where('order_status','Pending')
        ->where('bonus_type','Outstanding Bonus')
        ->sum('bonus_outstanding');

        $bonus_earned = DB::table('orders')
        ->where('customer_id',$cust_id->user_id)
        ->whereBetween('created_at', [$start_day, $end_day])
        ->sum('total');
         
         $bonus_target = 5000;
         if($bonus_earned <= 5000)
         $bonus_target = 5000;
         else if($bonus_target <= 10000)
         $bonus_target = 10000;
         else if($bonus_target <= 20000)
         $bonus_target = 20000;
         else
         $bonus_target = 50000;

         $p = array(
           'start_date'=>$start_date,
           'end_date'=>$end_date,
           'bonus_paid'=>round($bonus_paid),
           'bonus_outstanding'=> round($bonus_outstanding),
           'bonus_earned'=> round($bonus_earned),
           'bonus_target'=>$bonus_target
         );
      
        return $this->processResponse('Bonus_Details',$p,'success','Bonus Show Successfully!!');
    } 
    else
         return $this->processResponse(null,null,'error','Enter correct login details');
    }
}