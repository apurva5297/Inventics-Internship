<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use ProcessResponseTrait;

    /**
     * constructor
     */
    public function __construct()
    {
		// Global actions. Dont remove this constructor
    }

    public function notify($to='',$subject='',$message='',$type='',$id=''){
           
      $subject=$subject!=''?$subject:'';
      $message=$message!=''?$message:'';
      $type=$type!=''?$type:'promotion';
      //$image ="http://ethnicbazaar.com/image/images/5feeefb8a7031.jpg?p=medium";
      $payload='{"push_type":"'.$type.'","data":{"subject":"'.$subject.'","message":"'.$message.'","order_id":"'.$id.'"}}';

      $sento="";
      //get customer token with reciever_id
      if($user = DB::table('customers')->where('id',$to)->first()){
          $sento=$user->fcm_token;
      }
    
      $fields = array(
          'to'=> $sento,
          'data' => json_decode($payload,true),
      );
      //file_put_contents('/var/www/dev.simpel.in/public/logs.txt',json_encode($fields).PHP_EOL, FILE_APPEND);
              
      $result=$this->sendPushNotification($fields);
      //file_put_contents('/var/www/dev.simpel.in/public/logs.txt',$result.PHP_EOL, FILE_APPEND);
      //echo $result;
      return true;
  }

   // function makes curl request to firebase servers
  private function sendPushNotification($fields) {
       
      // Set POST variables
      $url = 'https://fcm.googleapis.com/fcm/send';

      $headers = array(
          'Authorization: key=AAAA3VGaN4M:APA91bExUzG68LhfIbokDJyqs-dHaIpLMpFRSKrlztKFUIYfHa2j5bfi0tIBaD9X_JUCkBSmkSxoiBKDnCm1HtV-uDeNy8Y8IlkaiYEKwRTbYvBpf7A1UZOScDFE2EeitOmURmLocR-Z',
          'Content-Type: application/json'
      );
      // Open connection
      $ch = curl_init();

      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);

      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      // Disabling SSL Certificate support temporarly
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

      // Execute post
      $result = curl_exec($ch);
      if ($result === FALSE) {
          die('Curl failed: ' . curl_error($ch));
      }

      // Close connection
      curl_close($ch);
     return $result;
      // return $this->processResponse('data',$result,'success','Notification Show Successfully');
     // echo $result;
  }
}
