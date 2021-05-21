<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Bank;
use App\Wallet;
use App\Transaction;
use App\Common\Authorizable;
use Illuminate\Http\Request;
use App\Events\User\UserCreated;
use App\Events\User\UserUpdated;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Events\Profile\PasswordUpdated;
use App\Repositories\User\UserRepository;
use App\Http\Requests\Validations\CreateUserRequest;
use App\Http\Requests\Validations\UpdateUserRequest;
use App\Http\Requests\Validations\AdminUserUpdatePasswordRequest as UpdatePasswordRequest;

class WalletController extends Controller
{
    use Authorizable;

    public function index()
    {
       $wallets = Wallet::join('customers','wallets.customer_id','=','customers.id')->get();
       return view('admin.wallet.index', compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
       //
    }

    public function transaction_list($customer_id)
    {  
        $wallet = Wallet::where('customer_id',$customer_id)->first(); 
       $transactions = Transaction::where('wallet_id',$wallet->id)->get();
       return view('admin.wallet._create',compact('transactions'));
    }

    public function withdraw()
    {
        $withdraw = DB::table('wallet_transactions')
        ->join('wallets','wallet_transactions.wallet_id','=','wallets.id')
        ->join('customers','wallets.customer_id','=','customers.id')
        ->where('wallet_transactions.trans_type','debit')
        ->get();
        return view('admin.wallet.withdraw_index',compact('withdraw'));
    }

    public function bank_details($customer_id)
    {
        $bank_detail = Bank::where('customer_id',$customer_id)->first();
        return view('admin.wallet.create',compact('bank_detail'));
    }

    public function approved(Request $request)
    {
        DB::table('wallet_transactions')
        ->where('transaction_id',$request->bank_id)
        ->update(['status'=>'approved']);
    }

    public function decline(Request $request)
    {
        DB::table('wallet_transactions')
        ->where('transaction_id',$request->bank_id)
        ->update(['status'=>'declined']);                             
    }

}