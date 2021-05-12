<?php
 namespace App\Traits;
 
use Illuminate\Http\Request;
use DB;
 
trait CategoryTrait {

    public function sellerCategory($shop_id) {
        return DB::table('shop_categories')->where('shop_id',$shop_id)->get();
    }
 
}
 