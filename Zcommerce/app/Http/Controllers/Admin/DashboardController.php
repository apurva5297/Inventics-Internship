<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Request;
use App\User;
use App\Dashboard;
use App\Common\Authorizable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SecretLoginRequest;
use App\Helpers\ListHelper;
use App\Shop;
use App\Product;
use App\Inventory;

class DashboardController extends Controller
{
   // use Authorizable;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth');
        //$this->middleware('seller_categories');
    }

    /**
     * Display Dashboard of the logged in users.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkFlow()
    {
        $shop_id = Auth::user()->shop->id;
        //return $shop_id;
        if(!empty($shop_id))
        {
            $shops = Shop::where('id',$shop_id)->first();
             
            $products = Product::where('shop_id',$shop_id)->get();
            $inventories = Inventory::where('shop_id',$shop_id)->get();
            if(count($products) > 1 || count($inventories) < 1 || $shops->image < 2 || !$shops->primaryAddress)
                return view('admin.dashboard.check_flow', compact('products','inventories','shops'));
        }
        // else
        // {
        //     return redirect()->route('admin.dashboard');
        // }
    }

    public function index()
    {
        if(Auth::user()->isFromPlatform())
            return view('admin.dashboard.platform');

        return view('admin.dashboard.merchant');
    }

    /**
     * Display the secret_login.
     *
     * @return \Illuminate\Http\Response
     */
    public function secretLogin(SecretLoginRequest $request, $id)
    {
        session(['impersonated' => $id, 'secretUrl' => \URL::previous()]);

        return redirect()->route('admin.admin.dashboard')->with('success', trans('messages.secret_logged_in'));
    }

    /**
     * Display the secret_login.
     *
     * @return \Illuminate\Http\Response
     */
    public function secretLogout()
    {
        $secret_url = Request::session()->get('secretUrl');

        Request::session()->forget('impersonated', 'secretUrl');

        return $secret_url ?
            redirect()->to($secret_url)->with('success', trans('messages.secret_logged_out')) :
            redirect()->route('admin.admin.dashboard');
    }

    /**
     * Toggle Configuration of the current user, Its uses the ajax middleware
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str  $node
     * @return \Illuminate\Http\Response
     */
    public function toggleConfig(Request $request, $node)
    {
        $config = Dashboard::findOrFail(Auth::user()->id);

        $config->$node = !$config->$node;

        if($config->save()){
            return response("success", 200);
        }

        return response('error', 405);
    }
}
