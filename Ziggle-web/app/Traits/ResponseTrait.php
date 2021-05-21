<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
trait ResponseTrait
{
    public function processResponse($status,$message=null)
    {
        if($status=='success')
        {
            return response()->json([
                'status' => $status,
                'code' => 200,
                'message' => $message
            ]);
        }
    
        else
        {
            return response()->json([
                'code'=>404,
                'status'=>$status,
                'message'=>$message

            ]);
        }
    }
  
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }
     public function api_login($email,$password)
    {
       
       
       if (Auth::attempt(array('email' => $email, 'password' => $password))){
            return "success";
            }
            else {        
                return "error";
            }
    }
}