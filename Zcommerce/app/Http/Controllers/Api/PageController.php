<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;

class PageController extends Controller
{
	use ProcessResponseTrait,ValidationTrait;

    public function page(Request $request)
    {
    	$page = Page::where('slug',$request->page_slug)->first();
    	$data = array(
    		'title' => $page->title,
    		'content' => strip_tags($page->content)
    	);
    	return $this->processResponse('page_detail',$data,'success','Page Detail');
    }
}
