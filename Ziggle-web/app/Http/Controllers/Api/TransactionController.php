<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use App\Http\Controllers\Api\Traits\ValidationTrait;
use App\Customer;
use App\PaytmRequest;
use Config;
use Carbon;
use App\ConnectionRequest;
use App\Wallet;
use App\Transaction;


class TransactionController extends Controller
{
  use ProcessResponseTrait;
  use ValidationTrait;
   /* public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }
    */
    /*public function walletBalance(Request $request)
    {
        $user_id=$this->validate_user_request($request->connection_id,$request->auth_code); // validate request
        $wallet=Wallet::where('cuid',$user_id)->first();
        return '{"Status":"success", "Message":"Wallet Balance", "Error":"0000","Balance":"'.$wallet->wallet_amnt.'"}';
    }*/

    public function walletBalance(Request $request)
    {
      $user_id=$this->validate_user_request($request->connection_id,$request->auth_code); // validate request
      $wallet = Wallet::where('cuid',$user_id)->first();

      $year=date('Y-m-d H:i:s', strtotime('-30 days'));
      $transaction= Transaction::where('cuid', $user_id)->whereRaw("created_ts >='".$year."'")->orderBy('tid', 'desc')->get();

      $newtran=array();
      foreach ($transaction as $list) {
        $list->data=$this->getPaymentMode($list->data,$list->tsid);
        $list->ttid=$this->getTtype($list->ttid);
        $list->tsid=$this->getTstatus($list->tsid);
        $list->response=NULL;
        array_push($newtran,$list);
      }
      return '{"Status":"success", "Message":"Wallet Balance", "Error":"0000","Balance":"'.$wallet->wallet_amnt.'","Transaction":'.json_encode($newtran).'}';
    }

    public function walletNewBalance(Request $request)
    {
      $user_id=$this->validate_user_request($request->connection_id,$request->auth_code); // validate request
      //$user_id=2066;
      $wallet = DB::select(DB::raw("SELECT COALESCE(SUM(CASE WHEN wttid = 1 THEN amount WHEN wttid = 2 THEN -amount ELSE 0 END), 0) AS wallet_amnt FROM `wallet_history_view` WHERE cuid = ".$user_id." AND tsid IN (1, 2)"));

      $year=date('Y-m-d H:i:s', strtotime('-30 days'));
      $transaction = Transaction::where('cuid',$user_id)->where('tsid',1)->whereRaw("created_ts >='".$year."'")->orderBy('tid', 'desc')->get();
      $newtran=array();
      foreach ($transaction as $list) {
        $list->data=$this->getPaymentMode($list->data,$list->ttid,$list->response,$list->tid);
        $list->ttid=$list->ttid ==1 ? "Credit" : "Debit";
        $list->tsid="Success";
        $list->response=NULL;
        array_push($newtran,$list);
      }
      return '{"Status":"success", "Message":"Wallet Balance", "Error":"0000","Balance":"'.$wallet[0]->wallet_amnt.'","Transaction":'.json_encode($newtran).'}';
    }

    public function create_transaction(Request $request)
    {
        $cust = DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        if($cust)
        {
         //get user information
        // $row = DB::table("customers")->where('id', $cust->user_id)->first();
         $request_id=time();
       
          $payloadData=json_decode($request->payload,true);

          $paytmParams = array();
          $paytmParams["MID"] = $payloadData['MID'];
          $paytmParams["ORDER_ID"] = $request_id;
          $paytmParams["CUST_ID"] = $payloadData['CUST_ID'];
          $paytmParams["MOBILE_NO"] = $payloadData['MOBILE_NO'];
          $paytmParams["EMAIL"] = $payloadData['EMAIL'];
          $paytmParams["CHANNEL_ID"] = $payloadData['CHANNEL_ID'];
          $paytmParams["TXN_AMOUNT"] = $payloadData['TXN_AMOUNT'];
          $paytmParams["WEBSITE"] = $payloadData['WEBSITE'];
          $paytmParams["INDUSTRY_TYPE_ID"] = $payloadData['INDUSTRY_TYPE_ID'];
          $paytmParams["CALLBACK_URL"] = $payloadData['CALLBACK_URL'];
          
          $paytmChecksum = $this->getChecksumFromArray($paytmParams, 'jc1Y8c9mn95zuQ9g');


          //save transaction request in database table
          DB::table('payment_request_logs')->insert(
              ['order_id' => $paytmParams["ORDER_ID"], 'amount'=>$paytmParams["TXN_AMOUNT"],'cuid' => $paytmParams["CUST_ID"], 'mobile'=>$paytmParams["MOBILE_NO"],'paytmChecksum'=>$paytmChecksum,'request_ts'=>date('Y-m-d H:i:s'),'response_ts'=>date('Y-m-d H:i:s')]
          );

        $data=array(
            "payload"=>$paytmParams,
            "paytmChecksum"=>$paytmChecksum,
        );
        
        // file_put_contents('/var/www/html/salary/public/log.txt', '----------------------------Request------------------------'.PHP_EOL, FILE_APPEND);
        // file_put_contents('/var/www/html/salary/public/log.txt', json_encode($paytmParams).PHP_EOL, FILE_APPEND);

      //  return '{"Status":"success", "Message":"Request log created", "Error":"0000", "Data":'.json_encode($data).'}';
             return $this->processResponse("Data",$data,'success','Request log created');
        } 
        else
      return $this->processResponse(null,null,'error','Enter correct login details'); 
    }
    
    public function walletResponse(Request $request)
    {
        $cust = DB::table('connection_request')->select('user_id')->where('connection_id','=', $request->connection_id)->where('auth_code','=', $request->auth_code)->first();
        //get user information
        $row = Customer::where('id', $cust->user_id)->first();
        $paytmChecksum = "";
        $paramList = array();
        $isValidChecksum = "FALSE";

        $paramList = json_decode($_POST['response'],true);
        
        $paytmChecksum = isset($paramList["CHECKSUMHASH"]) ? $paramList["CHECKSUMHASH"] : ""; //Sent by Paytm pg
        
        //--- remove unwanted space with + sign
        $paytmChecksum=str_replace(' ', '+', $paytmChecksum);
        
        // file_put_contents('/var/www/html/spinCycle/public/test.txt', '-----------------------------Response-----------------------'.PHP_EOL, FILE_APPEND);
        // file_put_contents('/var/www/html/spinCycle/public/test.txt', $_POST['response'].PHP_EOL,FILE_APPEND);

        $isValidChecksum = $this->verifychecksum_e($paramList,'jc1Y8c9mn95zuQ9g', $paytmChecksum); //will return TRUE or FALSE string.
    
        if($isValidChecksum == "TRUE") {
            if ($paramList["STATUS"] == "TXN_SUCCESS") {

                //record response data
                DB::table('payment_request_logs')
                        ->where('order_id', $paramList['ORDERID'])
                        ->update(['response_ts' => date('Y-m-d H:i:s'), 'paid_amount'=>$paramList['TXNAMOUNT'],'TXNID'=>$paramList['TXNID'],'STATUS'=>$paramList['STATUS'],'RESPONSE'=>json_encode($paramList) ]);

                  //update transaction table which will auto update wallet
              //  $this->transaction($paramList['ORDERID'],1);

                $paydata=PaytmRequest::where('order_id',$paramList['ORDERID'])->first();
                return '{"status":"success", "message":"Amount added to wallet", "Error":"0000", "data":'.json_encode($paydata).'}';
            }
            else{
                //record response data
                DB::table('payment_request_logs')
                        ->where('order_id', $paramList['ORDERID'])
                        ->update(['response_ts' => date('Y-m-d H:i:s'),'TXNID'=>$paramList['TXNID'],'STATUS'=>$paramList['STATUS'],'RESPONSE'=>json_encode($paramList) ]);

                //update transaction table which will auto update wallet
              //  $this->transaction($paramList['ORDERID'],4);
                $paydata=PaytmRequest::where('order_id',$paramList['ORDERID'])->first();
                return '{"status":"failed", "message":"Payment cancelled or failed", "error":"1011", "data":'.json_encode($paydata).'}';
            }
        }
        else {
       //   file_put_contents('/var/www/html/spinCycle/public/paysuspicious.txt', "4:".json_encode($_POST).PHP_EOL, FILE_APPEND);
            return '{"status":"failed", "message":"Suspicious Transaction! Please contact customer support.", "Error":"1009"}';
        }
    }
    public function test_checksum(){

       $paytmChecksum=$_POST['checksum'];
       $paramList = json_decode($_POST['response'],true);
       $isValidChecksum = $this->verifychecksum_e($paramList, 'Waad#Lo7&w#5KBr4', $paytmChecksum);
       if($isValidChecksum == "TRUE") {
          echo 'Valid';
       }
       else{
          echo 'Invalid';
       }
    }

    private function transaction($order_id,$status)
    {
        $data=PaytmRequest::where('order_id',$order_id)->first();

        $transaction = new Transaction();
        $transaction->cuid = $data->cuid;
        $transaction->uid = 1;
        $transaction->cpoid = 4;
        $transaction->cpmid = NULL;
        $transaction->ttid = 1;
        $transaction->tsid = $status;
        $transaction->wapaid = NULL;
        $transaction->data = '';
        $transaction->response = $data->RESPONSE;
        $transaction->topup = NULL;
        $transaction->amount = $data->paid_amount;
        if($status==4){
          $transaction->amount = $data->amount;
        }
        
        $transaction->created_ts = date('Y-m-d H:i:s');
        $transaction->updated_ts = date('Y-m-d H:i:s');

        $transaction->save();

        if($status==1){
          // wallet entry
                $wallet = new WalletTransaction();
                $wallet->amount=$data->paid_amount;
                $wallet->cuid=$data->cuid;
                $wallet->wttid=1; // credit
                $wallet->comment=""; // credit
                $wallet->data="";
                $wallet->tid=$transaction->tid;
                $wallet->save();

          // wallet should auto update
                
          /*$wallet = Wallet::where('cuid',$data->cuid)->first();
          $wallet_amnt = $wallet->wallet_amnt+$data->paid_amount;
          DB::table('wallet')
                ->where('cuid', $data->cuid)
                ->update(['wallet_amnt' => $wallet_amnt]);*/
        }
    }

    private function validate_user_request($connection_id,$auth_code)
    {
        $row = ConnectionRequest::where('connection_id', $connection_id)->where('auth_code', $auth_code)->first();
        if(count($row)>0){
            return $row->user_id;
        }
        else
        {
            return '{"Status":"failed", "Message":"Invalid connection", "Error":"1002"}';
            exit();
        }
    }

    private function sendMsg($recipients,$message)
    {
        $settings = array();
        $settings['route'] = 4;
        $settings['authkey'] = "226912AppUI8j4akp5b503a45";
        $settings['mobiles'] = urlencode($recipients);
        $settings['message'] = urlencode($message);
        $settings['country'] = 91;
        $settings['response'] = "json";
        
        $uri="http://api.msg91.com/api/sendhttp.php?sender=SPNCYL";
        foreach($settings as $key=>$value){
            $uri.='&'.$key.'='.$value;
        }
        //echo $uri;
        $result = file_get_contents($uri);
    }
    public function encrypt_e($input, $ky) {
      $key   = html_entity_decode($ky);
      $iv = "@@@@&&&&####$$$$";
      $data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
      return $data;
    }

    public function decrypt_e($crypt, $ky) {
      $key   = html_entity_decode($ky);
      $iv = "@@@@&&&&####$$$$";
      $data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
      return $data;
    }

    public function generateSalt_e($length) {
      $random = "";
      srand((double) microtime() * 1000000);

      $data = "AbcDE123IJKLMN67QRSTUVWXYZ";
      $data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
      $data .= "0FGH45OP89";

      for ($i = 0; $i < $length; $i++) {
        $random .= substr($data, (rand() % (strlen($data))), 1);
      }

      return $random;
    }

    public function checkString_e($value) {
      if ($value == 'null')
        $value = '';
      return $value;
    }

    public function getChecksumFromArray($arrayList, $key, $sort=1) {
      if ($sort != 0) {
        ksort($arrayList);
      }
      $str = $this->getArray2Str($arrayList);
      $salt = $this->generateSalt_e(4);
      $finalString = $str . "|" . $salt;
      $hash = hash("sha256", $finalString);
      $hashString = $hash . $salt;
      $checksum = $this->encrypt_e($hashString, $key);
      return $checksum;
    }
    public function getChecksumFromString($str, $key) {
      
      $salt = $this->generateSalt_e(4);
      $finalString = $str . "|" . $salt;
      $hash = hash("sha256", $finalString);
      $hashString = $hash . $salt;
      $checksum = $this->encrypt_e($hashString, $key);
      return $checksum;
    }

    public function verifychecksum_e($arrayList, $key, $checksumvalue) {
      $arrayList = $this->removeCheckSumParam($arrayList);
      ksort($arrayList);
      $str = $this->getArray2StrForVerify($arrayList);
      $paytm_hash = $this->decrypt_e($checksumvalue, $key);
      $salt = substr($paytm_hash, -4);

      $finalString = $str . "|" . $salt;

      $website_hash = hash("sha256", $finalString);
      $website_hash .= $salt;

      $validFlag = "FALSE";
      if ($website_hash == $paytm_hash) {
        $validFlag = "TRUE";
      } else {
        $validFlag = "FALSE";
      }
      return $validFlag;
    }

    public function verifychecksum_eFromStr($str, $key, $checksumvalue) {
      $paytm_hash = $this->decrypt_e($checksumvalue, $key);
      $salt = substr($paytm_hash, -4);

      $finalString = $str . "|" . $salt;

      $website_hash = hash("sha256", $finalString);
      $website_hash .= $salt;

      $validFlag = "FALSE";
      if ($website_hash == $paytm_hash) {
        $validFlag = "TRUE";
      } else {
        $validFlag = "FALSE";
      }
      return $validFlag;
    }

    public function getArray2Str($arrayList) {
      $findme   = 'REFUND';
      $findmepipe = '|';
      $paramStr = "";
      $flag = 1;  
      foreach ($arrayList as $key => $value) {
        $pos = strpos($value, $findme);
        $pospipe = strpos($value, $findmepipe);
        if ($pos !== false || $pospipe !== false) 
        {
          continue;
        }
        
        if ($flag) {
          $paramStr .= $this->checkString_e($value);
          $flag = 0;
        } else {
          $paramStr .= "|" . $this->checkString_e($value);
        }
      }
      return $paramStr;
    }

    public function getArray2StrForVerify($arrayList) {
      $paramStr = "";
      $flag = 1;
      foreach ($arrayList as $key => $value) {
        if ($flag) {
          $paramStr .= $this->checkString_e($value);
          $flag = 0;
        } else {
          $paramStr .= "|" . $this->checkString_e($value);
        }
      }
      return $paramStr;
    }

    public function redirect2PG($paramList, $key) {
      $hashString = $this->getchecksumFromArray($paramList);
      $checksum = $this->encrypt_e($hashString, $key);
    }

    public function removeCheckSumParam($arrayList) {
      if (isset($arrayList["CHECKSUMHASH"])) {
        unset($arrayList["CHECKSUMHASH"]);
      }
      return $arrayList;
    }

    public function getTxnStatus($requestParamList) {
      return $this->callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
    }

    public function getTxnStatusNew($requestParamList) {
      return $this->callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
    }

    public function initiateTxnRefund($requestParamList) {
      $CHECKSUM = $this->getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
      $requestParamList["CHECKSUM"] = $CHECKSUM;
      return $this->callAPI(PAYTM_REFUND_URL, $requestParamList);
    }

    public function callAPI($apiURL, $requestParamList) {
      $jsonResponse = "";
      $responseParamList = array();
      $JsonData =json_encode($requestParamList);
      $postData = 'JsonData='.urlencode($JsonData);
      $ch = curl_init($apiURL);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
      'Content-Type: application/json', 
      'Content-Length: ' . strlen($postData))                                                                       
      );  
      $jsonResponse = curl_exec($ch);   
      $responseParamList = json_decode($jsonResponse,true);
      return $responseParamList;
    }

    public function callNewAPI($apiURL, $requestParamList) {
      $jsonResponse = "";
      $responseParamList = array();
      $JsonData =json_encode($requestParamList);
      $postData = 'JsonData='.urlencode($JsonData);
      $ch = curl_init($apiURL);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
      'Content-Type: application/json', 
      'Content-Length: ' . strlen($postData))                                                                       
      );  
      $jsonResponse = curl_exec($ch);   
      $responseParamList = json_decode($jsonResponse,true);
      return $responseParamList;
    }
    public function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
      if ($sort != 0) {
        ksort($arrayList);
      }
      $str = $this->getRefundArray2Str($arrayList);
      $salt = $this->generateSalt_e(4);
      $finalString = $str . "|" . $salt;
      $hash = hash("sha256", $finalString);
      $hashString = $hash . $salt;
      $checksum = $this->encrypt_e($hashString, $key);
      return $checksum;
    }
    public function getRefundArray2Str($arrayList) { 
      $findmepipe = '|';
      $paramStr = "";
      $flag = 1;  
      foreach ($arrayList as $key => $value) {    
        $pospipe = strpos($value, $findmepipe);
        if ($pospipe !== false) 
        {
          continue;
        }
        
        if ($flag) {
          $paramStr .= checkString_e($value);
          $flag = 0;
        } else {
          $paramStr .= "|" . checkString_e($value);
        }
      }
      return $paramStr;
    }
    public function callRefundAPI($refundApiURL, $requestParamList) {
      $jsonResponse = "";
      $responseParamList = array();
      $JsonData =json_encode($requestParamList);
      $postData = 'JsonData='.urlencode($JsonData);
      $ch = curl_init($apiURL); 
      curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_URL, $refundApiURL);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      $headers = array();
      $headers[] = 'Content-Type: application/json';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
      $jsonResponse = curl_exec($ch);   
      $responseParamList = json_decode($jsonResponse,true);
      return $responseParamList;
    }

    //wallet related methods

    public static function getPaymentModeName($cpoid)
    {
      $row=DB::table('customer_payment_option')
                    ->select('name')->where('cpoid',$cpoid)->first();
      if(count($row)>0)
        return $row->name;
      else
         return "NA";
    }

    public static function getPaymentMode($data,$ttid,$response,$tid)
    {
      if(!empty($data)){
        $info = json_decode($data, TRUE);
        if (isset($info["OrderId"]) && is_numeric($info["OrderId"]))
        {
            return "{'title':'Paid For Order', 'remark': '#".$info['OrderId']."'}";
        }
        else if (isset($info["credit_note_id"]) && is_numeric($info["credit_note_id"]))
        {
            return "{'title':'Added To Wallet', 'remark': 'Via : Credit Note'}";
        }
        else if (isset($info["hub_transaction_id"]) && is_numeric($info["hub_transaction_id"]))
        {
          
          $row=DB::table('hub_transaction')
                        ->select('pay_by')->where('hutid',$info["hub_transaction_id"])->first();
          if(count($row)>0)
          {
            switch ($row->pay_by)
            {
                    case 1:
                        $mode = "{'title':'Added To Wallet', 'remark': 'Via : Cash Payment'}";
                        break;
                    case 2:
                        $mode = "{'title':'Added To Wallet', 'remark': 'Via : Card Payment'}";
                        break;
                    case 3:
                        $mode = "{'title':'Added To Wallet', 'remark': 'Via : Online Payment'}";
                        break;
                    default :
                        $mode = "{'title':'Added To Wallet', 'remark': 'Via : Wallet Payment'}";
                        break;
            }
            return $mode;
          }
          else
            return "{'title':'Added To Wallet', 'remark': 'Via : Online Payment'}";
        }
        else
          return "{'title':'Added To Wallet', 'remark': 'Via : Online Payment'}";
      }
      else{
        if($ttid==2){
          $wtransaction= WalletTransaction::where('tid', $tid)->first();
          $info = json_decode($wtransaction->data, TRUE);
          if (isset($info["OrderId"]) && is_numeric($info["OrderId"]))
          {
              return "{'title':'Paid For Order', 'remark': '#".$info['OrderId']."'}";
          }
        }
        else
          return "{'title':'Added To Wallet', 'remark': 'Via : Online Payment'}";
      }
    }

    public static function getTtype($ttid)
    {
        switch ($ttid)
        {
                case 1:
                    $mode = "Credit";
                    break;
                case 2:
                    $mode = "Debit";
                    break;
        }
        return $mode;
    }

    public static function getTstatus($tsid)
    {
        switch ($tsid)
        {
                case 1:
                    $mode = "Success";
                    break;
                case 2:
                    $mode = "Approved";
                    break;
                case 3:
                    $mode = "Pending";
                    break;
                case 4:
                    $mode = "Failed";
                    break;
                case 5:
                    $mode = "Cancelled";
                    break;
        }
        return $mode;
    }
}
