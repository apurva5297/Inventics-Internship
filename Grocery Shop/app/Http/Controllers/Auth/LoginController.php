<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $current_currency = "Rs";
        $categories=$this->getsubgroup();
        $announcement=$this->announcements();
        $sub_categories=$this->getsubgroupcategories();
        $cat_product=$this->getcategoriesproduct();
        return view('Layout.Account.AccountLogin',Compact('categories','sub_categories','cat_product','current_currency','announcement'));
    }

    public function login(Request $request)
    {
        $current_currency = "Rs.";
        // Check validation
        // $this->validate($request, [
        //     'phone' => 'required',
        //     //'phone' => 'required|regex:/[0-9]{10}/|digits:10',
        // ]);

        // Get user record
        $user = Customer::where('mobile', $request->get('phone'))->first();
        // Check Condition Mobile No. Found or Not

        if($request->get('phone') != $user->mobile) {
            \Session::put('errors', 'Your mobile number not match in our system..!!');
            return back();
        }
        $img_url=$this->server_image_path;
        $minicartItems=array();
        if(Auth::check())
            $minicartItems=$this->minicart();
        $categories=$this->getsubgroup();
        $announcement=$this->announcements();
        $sub_categories=$this->getsubgroupcategories();
        $cat_product=$this->getcategoriesproduct();
        $newotp=$this->generate_otp($request->get('phone'));
        $phone_no=$request->get('phone');


        // Set Auth Details
//        \Auth::login($user);

        // Redirect home page
        return view('auth.verifyOtp',Compact('categories','sub_categories','cat_product','minicartItems','img_url','newotp','phone_no','current_currency','announcement'));
    }

public function verifyotp(Request $request)
{
    //dd($request);
    $otp=$request->OTP;
    $phone=$request->Phoneno;
    $img_url=$this->server_image_path;
    $minicartItems=array();
    if(Auth::check())
        $minicartItems=$this->minicart();
    $categories=$this->getsubgroup();
    $announcement=$this->announcements();
    $sub_categories=$this->getsubgroupcategories();
    $cat_product=$this->getcategoriesproduct();
    $verifyotp=$this->validate_otp($otp,$phone);
    //dd("hello");
    if($verifyotp==true)
    {
        $user = Customer::where('mobile',$phone)->first();

// }
        \Auth::login($user);
        return redirect()->route('Food');
    }
    else{
        return redirect()->back();
    }

}
}


