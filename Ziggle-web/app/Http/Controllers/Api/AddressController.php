<?php

namespace App\Http\Controllers\Api;
use DB;
use Auth;
use App\Address;
use App\Helpers\ListHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Requests\Validations\CreateAddressRequest;
use App\Http\Requests\Validations\SelfAddressDeleteRequest;
use App\Http\Requests\Validations\SelfAddressUpdateRequest;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;

class AddressController extends Controller
{
    use ProcessResponseTrait,ValidationTrait;
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $addresses = Auth::guard('api')->user()->addresses()->create($request->all());

        return AddressResource::collection(Auth::guard('api')->user()->addresses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return [
            'address_types' => ListHelper::address_types(),
           // 'countries' => ListHelper::countries(),
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {   
            $address = new Address;
            $address->create($request->all());
            
       // return AddressResource::collection(Auth::guard('api')->user()->addresses);
            return $this->processResponse(null,null,'success','Address store successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        return (new AddressResource($address))->additional([
            'address_types' => ListHelper::address_types(),
            'countries' => ListHelper::countries(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(SelfAddressUpdateRequest $request, Address $address)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
        $address->update($request->all());
     //   return AddressResource::collection(Auth::guard('api')->user()->addresses);
        return $this->processResponse(null,null,'success','Address update successfully!!');
    } 
    else
        return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * delete the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(SelfAddressDeleteRequest $request, Address $address)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
            $address->delete();
       // return AddressResource::collection(Auth::guard('api')->user()->addresses);
        return $this->processResponse(null,null,'success','Address deleted successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }

    public function show(Request $request)
    {
        $cust_id= DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=',$request->auth_code)->first();
        if($cust_id)
        {  
            $addresses = DB::table('addresses')->where('addressable_id',$cust_id->user_id)->get();

        return $this->processResponse('Address_show',$addresses,'success','Address show successfully!!');
        } 
        else
            return $this->processResponse(null,null,'error','Enter correct login details');
    }
}