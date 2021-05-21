<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Traits\ProcessResponseTrait;
use Illuminate\Http\Request;
use App\Wallet;
use App\Transaction;
use App\OrderTransaction;
use App\Customer;
use App\Order;
use App\Payment;
use Carbon\Carbon;
use Config;
use DB;  

class WalletController extends Controller
{
    use ProcessResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction(Request $request)
    {
        $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
         if($cust)
         {
            $wallet = Wallet::where('customer_id',$cust->user_id)->first();
            if($wallet==null)
            {
                return $this->processResponse('balance_trans',null,'success','Wallet is not found!!');
            }
            $transactions = Transaction::where('wallet_id',$wallet->id)
            ->orderBy('created_at','desc')
            ->get();
             $transactions_details=[];
             if($transactions)
            {
            // $total_balance = 0; 
           foreach($transactions as $i=>$transaction)
            {
            $created_at = $transaction->created_at->format('m-d-Y');
            $updated_at = $transaction->updated_at->format('m-d-Y');
            $transactions_details[$i]=array('id'=>$transaction->id,'wallet_id'=>$transaction->wallet_id,'transaction_id'=>$transaction->transaction_id,'source'=>$transaction->source,'razorpay_response'=>json_decode($transaction->razorpay_response),'amount'=>$transaction->amount,'balance'=>$transaction->balance,'trans_type'=>$transaction->trans_type,'status'=>$transaction->status,'created_at'=>$created_at,'updated_at'=>$updated_at);
            }
            // $total_balance =  $total_balance + $transaction->amount; 
          
            $balance = array('customer' => $wallet->customer->name,'curr_balance' => $wallet->balance,'transactions'=> $transactions_details);
   
            return $this->processResponse('balance_trans',$balance,'success','Wallet transactions Successfully!!');
              }
              else
              {
                return $this->processResponse('balance_trans',$balance,'error','No transactions for this user');
              }

            }
            else
             return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wallet_balance(Request $request)
    {
        $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
            if($cust)
            {
            $wallet = Wallet::where('customer_id',$cust->user_id)->first();
            if($wallet==null)
            {
                return $this->processResponse('balance',null,'success','Wallet is not found!!');
            }
            else
            {
                $customer_name = $wallet->customer->name;
                $wallet_balance = $wallet->balance;

            }
                $balance = array('customer' => $customer_name,'balance' => $wallet_balance,'wallet_id'=>$wallet->id);
                return $this->processResponse('balance',$balance,'success','Wallet balance displayed Successfully!!');
            }
            else
                return $this->processResponse(null,null,'error','Enter correct login details');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_balance(Request $request)
    {
        $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
         if($cust)
         {
            $wallet = Wallet::where('customer_id',$cust->user_id)->first();
         
            if($wallet == null)
            {
                $increment = $request->amount;
                $curr_bal = $increment;

                $wallet = new Wallet;
                $wallet->customer_id = $cust->user_id;
                $wallet->balance = $request->amount;
                $wallet->save();
            }
            else
            {
                $pre_bal = $wallet->balance;
                $increment = $request->amount;
                $curr_bal = $pre_bal + $increment;
                $wallet->balance = $curr_bal;
                $wallet->save();
            }
            $transaction = new Transaction;
            $transaction->wallet_id = $wallet->id;
            $transaction->amount = $increment;
            $transaction->transaction_id = 'TRANS1234';
            $transaction->source = 'paytm';
            $transaction->trans_type = 'credit';
            $transaction->balance = $curr_bal ? $curr_bal : $increment;
            $transaction->save();

            $balance = array('customer' => $wallet->customer->name,'balance' => $wallet->balance);
               return $this->processResponse('add_balance',$balance,'success','Money added successfully!!');

            }
            else
             return $this->processResponse(null,null,'error','Enter correct login details');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deduct_balance(Request $request)
    {
      $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
      if($cust)
      {
        $wallet = Wallet::where('customer_id',$cust->user_id)->first();
        $post_bal = $wallet->balance;
        $decrement = $request->amount;
        $curr_bal = $post_bal - $decrement;
        $wallet->balance = $curr_bal;
        $wallet->save();

        $transaction = new Transaction;
        $transaction->wallet_id = $wallet->id;
        $transaction->amount = $decrement;
        $transaction->transaction_id = time();
        $transaction->source = 'Withdraw Request';
        $transaction->trans_type = 'debit';
        $transaction->balance = $curr_bal;
        $transaction->save();

        $balance = array('customer' => $wallet->customer->name,'balance' => $wallet->balance);
          return $this->processResponse('add_balance',$balance,'success','Withdraw request done');
        }
        else
            return $this->processResponse(null,null,'error','Enter correct login details');

    }

    public function walletRequest(Request $request)
    {
      $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
      if($cust)
      {
            //get user information
          $row = Customer::where('id', $cust->user_id)->first();
          $request_id=rand(10000,99999999);
          $amount=$request->amount;
          $paytmParams = array();
          $paytmParams["MID"] = 'SpiCyc12598606781613';
          $paytmParams["ORDER_ID"] = $request_id;
          $paytmParams["CUST_ID"] = $row->id;
          $paytmParams["MOBILE_NO"] = $row->mobile;
          $paytmParams["EMAIL"] = $row->email;
          $paytmParams["CHANNEL_ID"] = 'WAP';
          $paytmParams["TXN_AMOUNT"] = $amount;
          $paytmParams["WEBSITE"] = 'SpiCycWEB';
          $paytmParams["INDUSTRY_TYPE_ID"] = 'Retail109';
          $paytmParams["CALLBACK_URL"] = 'https://securegw.paytm.in/theia/paytmCallback?ORDER_ID='.$request_id;
          $paytmChecksum = $this->getChecksumFromArray($paytmParams, 'Waad#Lo7&w#5KBr4');
          //$transactionURL = "https://secure.paytm.in/oltp-web/processTransaction";

          //save transaction request in database table
          DB::table('payment_request_logs')->insert(
              ['order_id' => $request_id, 'amount'=>$amount,'cuid' => $row->id, 'mobile'=>$row->mobile,'paytmChecksum'=>$paytmChecksum,'request_ts'=>date('Y-m-d H:i:s'),'response_ts'=>date('Y-m-d H:i:s')]
          );

        $data=array(
            "ORDER_ID"=>$request_id,
            "paytmChecksum"=>$paytmChecksum,
        );
        
        // file_put_contents('/var/www/html/spinCycle/public/test.txt', '----------------------------Request------------------------'.PHP_EOL, FILE_APPEND);
        // file_put_contents('/var/www/html/spinCycle/public/test.txt', json_encode($paytmParams).PHP_EOL, FILE_APPEND);

        return $this->processResponse('data_checksum',$data,'success','Money added successfully!!');
      }
      else
          return $this->processResponse(null,null,'error','Enter correct login details');
  }
    public function walletResponse(Request $request)
    {
      $cust= DB::table('connection_request')->select('user_id')->where('auth_code','=', $request->auth_code)->where('connection_id','=', $request->connection_id)->first();
      if($cust)
      {
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

        $isValidChecksum = $this->verifychecksum_e($paramList, 'Waad#Lo7&w#5KBr4', $paytmChecksum); //will return TRUE or FALSE string.

        if($isValidChecksum == "TRUE") {
            if ($paramList["STATUS"] == "TXN_SUCCESS") {

                //record response data
                DB::table('payment_request_logs')
                        ->where('order_id', $paramList['ORDERID'])
                        ->update(['response_ts' => date('Y-m-d H:i:s'), 'paid_amount'=>$paramList['TXNAMOUNT'],'TXNID'=>$paramList['TXNID'],'STATUS'=>$paramList['STATUS'],'RESPONSE'=>json_encode($_POST['response']) ]);

                  //update transaction table which will auto update wallet
                $this->transaction($paramList['ORDERID'],1);

                $paydata=PaytmRequest::where('order_id',$paramList['ORDERID'])->first();
                return '{"Status":"success", "Message":"Amount added to wallet", "Error":"0000", "Data":'.json_encode($paydata).'}';
            }
            else{
                //record response data
                DB::table('payment_request_logs')
                        ->where('order_id', $paramList['ORDERID'])
                        ->update(['response_ts' => date('Y-m-d H:i:s'),'TXNID'=>$paramList['TXNID'],'STATUS'=>$paramList['STATUS'],'RESPONSE'=>json_encode($_POST['response']) ]);

                //update transaction table which will auto update wallet
                $this->transaction($paramList['ORDERID'],4);
                $paydata=PaytmRequest::where('order_id',$paramList['ORDERID'])->first();
                return '{"Status":"failed", "Message":"Payment cancelled or failed", "Error":"1011", "Data":'.json_encode($paydata).'}';
            }
        }
        else {
         // file_put_contents('/var/www/html/spinCycle/public/paysuspicious.txt', "4:".json_encode($_POST).PHP_EOL, FILE_APPEND);
            return '{"Status":"failed", "Message":"Suspicious Transaction! Please contact customer support.", "Error":"1009"}';
        }
      }
      else
          return $this->processResponse(null,null,'error','Enter correct login details');
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


