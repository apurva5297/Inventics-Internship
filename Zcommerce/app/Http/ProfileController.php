<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Address;
use App\Country;
use App\State;
use App\User;
use App\Shop;
use App\Config;
use App\Image;
use App\MeasuringUnit;
use App\PaymentMethod;

class ProfileController extends Controller
{
	use ProcessResponseTrait,ValidationTrait;

    public function countryList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$countries = Country::where('active',1)->get();
        	return $this->processResponse('country_list',$countries,'success','Country List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function stateList(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
        	$country_id = $request->country_id ? $request->country_id : null;
        	$states = State::where('active',1)
        					->where(function($query) use ($country_id){
        						if($country_id != null)
        							$query->where('country_id',$country_id);
        					})
        					->get();
        	return $this->processResponse('state_list',$states,'success','State List');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function shopAddressCreate(Request $request)
    {
    	$users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $country = Country::where('name',$request->country_name)->first();
            $state = State::where('name',$request->state_name)->first();
            //return $state;
        	$check_address = Address::where(['addressable_id'=>$users->shop_id, 'addressable_type'=>'App\Shop','address_type'=>'Primary'])->first();
        	$data = array(
        		'address_type' => 'Primary',
        		'address_line_1' => $request->address_line_1,
        		'address_line_2' => $request->address_line_2,
        		'city' => $request->city,
        		'state_id' => $state->id,
        		'zip_code' => $request->zip_code,
        		'country_id' => $country->id,
        		'phone' => $request->phone,
        		'latitude' => $request->latitude,
        		'longitude' => $request->longitude,
        		'addressable_id' => $users->shop_id,
        		'addressable_type' => 'App\Shop',
        	);



        	if($check_address)
        		Address::where(['addressable_id'=>$users->shop_id, 'addressable_type'=>'App\Shop','address_type'=>'Primary'])->update($data);
        	else
        		Address::insert($data);

            $data['state_name'] = $request->state_name;
            $data['country_name'] = $request->country_name;
        	return $this->processResponse('shop_address_save',$data,'success','Shop Address Saved');
        }
        else
        	return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function shopProfile(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array(
                'name' => $request->name,
                'legal_name' => $request->shop_name,
                'email' => $request->email,
                'gstin' => $request->gst,
                'pan' => $request->pan
            );
            Shop::where('owner_id',$users->id)->update($data);
            return $this->processResponse('update_profile',$data,'success','Shop Profile Updated');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function shopQRCode(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $img = str_replace('data:image/jpeg;base64,', '', $request->file);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $folderPath = base_path().'/public/images/shop_qr/';
            $file =  time() . '.jpeg';
            $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
            $image = $success ? 'images/shop_qr/'.$file : 'No image found';
            $data = array(
                'shop_qr' => $image,
            );
            Shop::where('owner_id',$users->id)->update($data);
            return $this->processResponse('shop_qr',$data,'success','Shop QR Updated');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function shopQRCodeView(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = Shop::select('shop_qr')->where('id',$users->shop_id)->first();
            return $this->processResponse('shop_qr_code',$data,'success','Shop QR');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function orderHandlingCost(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = Config::select('order_handling_cost')->where('shop_id',$users->shop_id)->first();
            return $this->processResponse('order_handling_cost',$data,'success','Order Handling Cost');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function orderHandlingCostUpdate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = array(
                'order_handling_cost' => $request->order_handling_cost ? $request->order_handling_cost : 0,
            );
            Config::where('shop_id',$users->shop_id)->update($data);
            return $this->processResponse('order_handling_cost_update',$data,'success','Order Handling Cost Update');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function shopLogo(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $data = Image::select('path')->where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->first();
            $databanner = Image::select('bannerpath')->where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->first();
            return $this->processResponse('shop_image',$data,'shop_banner',$databanner,'success','Shop Image');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function shopLogoUpdate(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            //1 means banner upload
            if($request->code==1){
   
                $shop_image = Image::select('bannerpath')->where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->first();

                $img = str_replace('data:image/jpeg;base64,', '', $request->file);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $folderPath = base_path().'/storage/app/public/images/';
                $file =  time() . '.jpeg';
                $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
                $image = $success ? 'images/'.$file : 'No image found';
                $data_logo = array(
                    'bannerpath' => $image,
                    'imageable_id' => $users->shop_id,
                    'imageable_type' => 'App\Shop',
                    'featured' => 0,
                );
                if(!empty($shop_image))
                    Image::where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->update($data_logo);
    
                else
                    Image::create($data_logo);
    
                return $this->processResponse('shop_banner',$data_logo,'success','Shop Banner');
              
            }
            else{

            
            $shop_image = Image::select('path')->where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->first();

            $img = str_replace('data:image/jpeg;base64,', '', $request->file);
            $img = str_replace(' ', '+', $img);
            $data = base64_decode($img);
            $folderPath = base_path().'/storage/app/public/images/';
            $file =  time() . '.jpeg';
            $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
            $image = $success ? 'images/'.$file : 'No image found';
            $data_logo = array(
                'path' => $image,
                'imageable_id' => $users->shop_id,
                'imageable_type' => 'App\Shop',
                'featured' => 0,
            );
            if(!empty($shop_image))
                Image::where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->update($data_logo);

            else
                Image::create($data_logo);

            return $this->processResponse('shop_logo',$data_logo,'success','Shop logo');
        }
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function MeasurngUnits(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $measuring_units = MeasuringUnit::get();
            return $this->processResponse('measuring_unit',$measuring_units,'success','Measuring Units');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }

    public function availablePaymentMethod(Request $request)
    {
        $users = $this->validate_request($request->connection_id,$request->auth_code);
        if($users)
        {
            $payment_methods = PaymentMethod::where('enabled',1)->get();
            return $this->processResponse('available_payment_method',$payment_methods,'success','Available Payments');
        }
        else
            return $this->processResponse(null,null,'connection_error','Invalid Connection');
    }


public function shopBanner(Request $request)
{
    $users = $this->validate_request($request->connection_id,$request->auth_code);
    if($users)
    {
        $data = Image::select('path')->where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->first();
        return $this->processResponse('shop_banner',$data,'success','Shop Banner');
    }
    else
        return $this->processResponse(null,null,'connection_error','Invalid Connection');
}
public function shopBannerUpdate(Request $request)
{
    $users = $this->validate_request($request->connection_id,$request->auth_code);
    if($users)
    {
        $shop_image = Image::select('path')->where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->first();

        $img = str_replace('data:image/jpeg;base64,', '', $request->file);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $folderPath = base_path().'/storage/app/public/images/';
        $file =  time() . '.jpeg';
        $success = file_put_contents($folderPath.$file, $data. FILE_USE_INCLUDE_PATH);
        $image = $success ? 'images/'.$file : 'No image found';
        $data_logo = array(
            'path' => $image,
            'imageable_id' => $users->shop_id,
            'imageable_type' => 'App\Shop',
            'featured' => 0,
        );
        if(!empty($shop_image))
            Image::where(['imageable_id'=>$users->shop_id, 'imageable_type'=>'App\Shop'])->update($data_logo);

        else
            Image::create($data_logo);

        return $this->processResponse('banner_image',$data_logo,'success','Shop Banner');
    }
    else
        return $this->processResponse(null,null,'connection_error','Invalid Connection');
}

}
