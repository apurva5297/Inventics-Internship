<?php

namespace App\Http\Controllers;

use View;
use Response;
use App\Product;
use App\Inventory;
use App\Message;
use App\Customer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function findProduct(Request $request)
    {
        $term = $request->input('q');

        $results = [];
        if(strlen($term) < 3)
            return Response::json($results);

        /*$products = Product::search($term)->where('active', 1)->take(5)->get();*/

        $products = Product::where('gtin', $term)
                    ->orWhere('model_number', 'LIKE', '%'. $term .'%')
                    ->orWhere('name', 'LIKE', '%'. $term .'%')
                    ->get();

        $not_fond = '<p class="lead"><span class="indent50">' . trans('responses.no_product_found_for_inventory') . '</span></p>';
        $results = '';

        foreach ($products as $product){
            $view = View::make('admin.inventory._product_list', ['product' => $product])->render();
            $results .= $view;
        }

        return (bool) $results ? $results : $not_fond;
    }

    public function findCustomer(Request $request)
    {
        $term = $request->input('q');

        $results = [];
        if(strlen($term) < 3)
			return Response::json($results);

        /*$customers = Customer::search($term)->where('active', 1)->take(5)->get();*/

        $customers = Customer::select('id','nice_name','name','email')
                ->where('active', 1)
        		->where('email', 'LIKE', '%'.$term.'%')
				->orWhere('nice_name', 'LIKE', '%'.$term.'%')
				->orWhere('name', 'LIKE', '%'.$term.'%')
                ->take(5)->get();

        foreach ($customers as $customer)
		    $results[] = ['text' => get_formated_cutomer_str($customer) , 'id' => $customer->id];

		return Response::json($results);
    }

    public function findMessage(Request $request)
    {
        $search_q = $request->input('q');

        $messages = Message::where('subject', 'LIKE', '%'.$search_q.'%')
                ->orWhere('message', 'LIKE', '%'.$search_q.'%')
                ->orWhereHas('customer', function ($query) use($search_q) {
                        $query->where('email', 'LIKE', '%'.$search_q.'%')
                            ->orWhere('nice_name', 'LIKE', '%'.$search_q.'%')
                            ->orWhere('name', 'LIKE', '%'.$search_q.'%');
                    })
                ->with('customer')->withCount('replies')
                ->paginate(config('system_settings.pagination'));

        return view('admin.message.index', compact('messages', 'search_q'));
    }

    public function findInventory(Request $request)
    {
        $term = $request->input('q');

        $results = [];
        if(strlen($term) < 3)
            return Response::json($results);

        /*$products = Product::search($term)->where('active', 1)->take(5)->get();*/

        $inventorys = Inventory::where('title', $term)
                    ->orWhere('barcode', 'LIKE', '%'. $term .'%')
                    ->orWhere('qrcode', 'LIKE', '%'. $term .'%')
                    ->orWhere('sku', 'LIKE', '%'. $term .'%')
                    ->orWhere('brand', 'LIKE', '%'. $term .'%')
                    ->get();

        $not_fond = '<p class="lead"><span class="indent50">' . trans('responses.no_product_found_for_inventory') . '</span></p>';
        $results = '';

        foreach ($inventorys as $inventory){
            $view = View::make('admin.inward._product_list', ['inventory' => $inventory])->render();
            $results .= $view;
        }

        return (bool) $results ? $results : $not_fond;
    }

    public function addToBin(Request $request)
    {
        $term = $request->input('id');
        $results = [];

        /*$products = Product::search($term)->where('active', 1)->take(5)->get();*/

        $inventory = Inventory::where('id', $term)->first();

        $not_fond = '<p class="lead"><span class="indent50">' . trans('responses.no_product_found_for_inventory') . '</span></p>';
        $results = '';

        $view = View::make('admin.inward._add_to_bin_inventory', ['inventory' => $inventory])->render();
        $results .= $view;

        return (bool) $results ? $results : $not_fond;
    }
}
