<?php
namespace App\Helpers;
use App\Product;
use Auth;

class zshop_flow_helpers
{
    static function check_product_exist()
    {
        $product = Product::get();
        if($product)
        	return count($product);
    }
}