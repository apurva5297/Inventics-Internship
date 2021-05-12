<?php

namespace App\Repositories\Product;
use Illuminate\Http\Request;

interface ProductRepository{
	public function productList(Request $request);

	public function productDetail(Request $request);

	public function productAddUpdate(Request $request);
	
}