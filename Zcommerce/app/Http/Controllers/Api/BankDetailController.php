<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankDetail;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use DB;

class BankDetailController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;

    public function bank_list(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$bank_lists = DB::table('banks')->get();
        	return $this->processResponse('all_bank_list',$bank_lists,'success','All Bank List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function index(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$bank_lists = BankDetail::where(['bankable_type'=>'App\Shop', 'bankable_id'=>$users->shop_id])->get();
        	return $this->processResponse('bank_list',$bank_lists,'success','Bank List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function store(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$data = array(
        		'bank_name' => $request->bank_name,	
        		'account_holder_name' => $request->account_holder_name,	
        		'account_number' => $request->account_number,	
        		'ifsc' => $request->ifsc,	
        		'bankable_type' => 	'App\Shop',
        		'bankable_id' => $users->shop_id
        	);
        	if($request->id != '')
        	{
        		BankDetail::where('id',$request->id)->update($data);
        		return $this->processResponse('bank_account_updated',$data,'success','Bank account updated');
        	}
        	else
        	{
	        	BankDetail::insert($data);
	        	return $this->processResponse('bank_created',$data,'success','Bank Created');
	        }
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function view(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$bank_lists = BankDetail::where(['id'=>$request->bank_id])->first();
        	return $this->processResponse('bank_account_detail',$bank_lists,'success','Bank Account Detail');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function update(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$data = array(
        		'bank_name' => $request->bank_name,	
        		'account_holder_name' => $request->account_holder_name,	
        		'account_number' => $request->account_number,	
        		'ifsc' => $request->ifsc,	
        		'bankable_type' => 	'App\Shop',
        		'bankable_id' => $users->shop_id
        	);
        	BankDetail::where('id',$request->id)->update($data);
        	return $this->processResponse('bank_account_updated',$data,'success','Bank account updated');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }
}
