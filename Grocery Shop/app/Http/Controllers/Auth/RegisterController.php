<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo ='home';
    protected function redirectTo()
    {
        if (auth()->user()) {
            session()->flash('danger', 'You have Successfully Registered!');
            return '/';
        }
        // return '/';
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:customers'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobile' => ['required', 'string', 'min:10', 'unique:customers'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'mobile'=> $data['phone'],
        ]);
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $customer = $this->create($request->all());

        //DB::table('sf_wallet')->insertGetId(['cust_id'=>$customer->id,'wallet_amnt'=>0]);

        event(new Registered($customer));

        $this->guard('customer')->login($customer);

        return $this->registered($request, $customer)
                        ?: redirect($this->redirectPath());
    }


    public function create_account()
    {
        return view('auth.newregister');
    }
    public function register_account(Request $request)
    {
        
        // $customer=new Customer();
        // $customer->name=$request->name;
        // $customer->email=$request->email;
        // $customer->password= bcrypt($request->password);
        // $customer->verification_token = str_random(40);
        
        $id = DB::table('customers')->insertGetId([
            'name' => $request->name, 
            'mobile'=>$request->phone, 
            'email' => $request->email, 
            'password' => bcrypt($request->password), 
            'verification_token' => Str::random(40),
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now()]);
        //dd($id);
        
        session()->flash('success','registered_successfully | Please Login');
        return redirect()->back();
    }

    public function customer_login_index()
    {
        return view('customer_login');
    }
}
