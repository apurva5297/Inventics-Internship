<?php

namespace App\Http\Controllers\Storefront;

use DB;
use Auth;
use App\Cart;
use App\Order;
use App\Customer;
use App\ReturnOrders;
use Paypalpayment;
use Instamojo\Instamojo;
use Illuminate\Http\Request;
use App\Events\Order\OrderPaid;
use App\Events\Order\OrderCreated;
use App\Http\Controllers\Controller;
use App\Exceptions\AuthorizeNetException;
use App\Http\Requests\Validations\OrderDetailRequest;
use App\Http\Requests\Validations\CheckoutCartRequest;
use App\Http\Requests\Validations\ConfirmGoodsReceivedRequest;
use App\Notifications\Auth\SendVerificationEmail as EmailVerificationNotification;
use Illuminate\Routing\UrlGenerator;
use net\authorize\api\contract\v1 as AuthorizeNetAPI;
use net\authorize\api\controller as AuthorizeNetController;
use App\ConfigPaytm;

class OrderController extends Controller
{
    protected $url;
    public function __construct(UrlGenerator $url)
    {
        $this->url = $url;
    }

    /**
     * Checkout the specified cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(CheckoutCartRequest $request, Cart $cart)
    {
        // echo "<pre>"; print_r($request->all()); echo "</pre>"; exit();
        if ($request->email && $request->password) {
            $customer = $this->createNewCustomer($request);
            $request->merge(['customer_id' => $customer->id]); //Set customer_id
        }

        crosscheckAndUpdateOldCartInfo($request, $cart);

        // Start transaction!
        DB::beginTransaction();
        try {
            // Create the order
            $order = $this->saveOrderFromCart($request, $cart);

            // Process payment with credit card
            if (
                'saved_card' == $request->payment_method ||
                \App\PaymentMethod::TYPE_CREDIT_CARD == optional($order->paymentMethod)->type ||
                \App\PaymentMethod::TYPE_OTHERS == optional($order->paymentMethod)->type
            ) {
                switch (optional($order->paymentMethod)->code) {
                    case 'stripe':
                        // Charge using Stripe
                        $this->chargeWithStripe($request, $order);
                        break;

                    case 'instamojo':
                        DB::commit();           // Everything is fine. Now commit the transaction Don't change it
                        // Charge using Instamojo
                        $this->chargeWithInstamojo($request, $order, $cart);
                        break;

                    case 'authorize-net':
                        // Charge using authorize.net
                        $this->chargeWithAuthorizeNet($request, $order);
                        break;

                    case 'paystack':
                        DB::commit();           // Everything is fine. Now commit the transaction Don't change it
                        // Charge using paystack
                        $this->chargeWithPaystack($request, $order, $cart);
                        break;

                    case 'paytm':
                        DB::commit();           // Everything is fine. Now commit the transaction Don't change it
                        // Charge using paystack
                        $this->chargeWithPaytm($request, $order, $cart);

                        break;
                }

                // Order has been paided
                $this->markOrderAsPaid($order);
            }
        } catch(\Exception $e){
            \Log::error($e);        // Log the error

            DB::rollback();         // rollback the transaction and log the error

            // Set error messages:
            if (
                $e instanceOf \Stripe\Error\Base ||
                $e instanceOf \Yabacon\Paystack\Exception\ApiException ||
                $e instanceOf AuthorizeNetException
            ) {
                \Log::error('Payment failed:: ' . $e->getMessage());
                $error = trans('theme.notify.invalid_request');
            }
            else {
                $error = trans('theme.notify.order_creation_failed');
            }

            return redirect()->back()->with('error', $error)->withInput();
        }

        DB::commit();           // Everything is fine. Now commit the transaction

        $cart->forceDelete();   // Delete the cart

        // Process payment with PayPal
        if ('paypal-express' == optional($order->paymentMethod)->code) {
            try {
                $payment = $this->chargeWithPayPal($request, $order);
            } catch (\Exception $e) {
                return redirect()->route("payment.failed", $order->id)->withInput();
            }

            return redirect()->to($payment->getData()->approval_url);
        }

        // Decrease the stock of the order items from the listing
        $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }


//charge with paytm

    public function chargeWithPaytm($request, Order $order, Cart $cart)
    {
        $customer = Customer::where('id',$order->customer_id)->first();
        $order = Order::where('order_number',$order->order_number)->first();
        $request_id=rand(10000,99999999);
      
        $paytm_config = ConfigPaytm::where('shop_id',$order->shop_id)->first();

        // $m_id = $paytm_config->m_id;
        // $m_key = $paytm_config->m_key;
        $m_id = 'SPINCY08249850726971';
        $m_key = 'ky&ln&b4gO9X%mrk';
      $paytmParams = array();
      $paytmParams["ORDER_ID"] = $order->id;
      $paytmParams["CUST_ID"] = $order->customer_id;
      $paytmParams["MOBILE_NO"] = $customer->phone;
      $paytmParams["EMAIL"] = $customer->email;
      $paytmParams["CHANNEL_ID"] = 'WEB';
      $paytmParams["TXN_AMOUNT"] = round($order->grand_total,2);
      //$paytmParams["TXN_AMOUNT"] = 1;
      $paytmParams["CALLBACK_URL"] = url('/myaccount/paymentresponse');
      
      
      //For testing ----------------- OTP 489871//
      $paytmParams["MID"] = $m_id;
      $paytmParams["WEBSITE"] = 'DEFAULT';
      $paytmParams["INDUSTRY_TYPE_ID"] = 'Retail';
      $paytmChecksum = $this->getChecksumFromArray($paytmParams, $m_key);
      $transactionURL = "https://securegw-stage.paytm.in/order/process";

      //save transaction request in database table
       DB::table('paytm_request_log')->insert(
          ['order_id' => $order->id, 'amount'=>$order->grand_total,'cuid' => $order->customer_id, 'mobile'=>$customer->phone,'email'=>$customer->email,'paytmChecksum'=>$paytmChecksum,'paytmParams'=>json_encode($paytmParams),'request_ts'=>date('Y-m-d H:i:s'),'response_ts'=>date('Y-m-d H:i:s')]
      );
     // echo json_encode($paytmParams);
      //die;
       
       header('Location: ' . '/myaccount/paytm_redirect/'.$order->id);
        exit();

       //return redirect()->url('http://google.com');
      //return view('payment.patym.payredirect', compact('paytmParams','paytmChecksum', 'transactionURL'));
      //file_put_contents('/var/www/licious/log.txt', json_encode($paytmParams).PHP_EOL, FILE_APPEND);
    

    }

    public function patymRedirect($order_id)
    {
        $data = DB::table('paytm_request_log')->where('order_id',$order_id)->first();
        return view('payment.paytm.payredirect',compact('data'));
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

    public function paytmResponse(Request $request, Order $order, Cart $cart) {
     
      $paytmChecksum = "";
      $paramList = array();
      $isValidChecksum = "FALSE";

      $paramList = $_POST;
     $order_id = $request->ORDERID;
    $order = Order::where('id',$order_id)->first();
    $paytm_config = ConfigPaytm::where('shop_id',$order->shop_id)->first();
    //$m_key = $paytm_config->m_key;
    $m_key = 'ky&ln&b4gO9X%mrk';

      $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg
      $isValidChecksum = $this->verifychecksum_e($paramList, $m_key, $paytmChecksum); //will return TRUE or FALSE string.

      if($isValidChecksum == "TRUE") {

        if ($_POST["STATUS"] == "TXN_SUCCESS") {
          //check request first exist
          /*$paydata=PaytmRequest::where('order_id',$_POST['ORDERID'])->where('STATUS','!=', 'TXN_SUCCESS')->where('STATUS','!=', 'TXN_FAILURE')->first();
          if($paydata){*/
             //record response data
            DB::table('paytm_request_log')
                ->where('order_id', $_POST['ORDERID'])
                ->update(['response_ts' => date('Y-m-d H:i:s'), 'amount'=>$_POST['TXNAMOUNT'],'txn_id'=>$_POST['TXNID'],'status'=>$_POST['STATUS'],'response'=>json_encode($_POST) ]);

            //update transaction table which will auto update wallet
            //$order=PaytmRequest::where('order_id',$_POST['ORDERID'])->first();

            $order_id = $request->ORDERID;
            $order = Order::where('id',$order_id)->first();
            $cart = Cart::where('customer_id',$order->customer_id)->first();

            // Delete the cart
            Cart::find($cart->id)->forceDelete();   // Delete the cart

            // Order has been paided
            $this->markOrderAsPaid($order_id);

            // Decrease the stock of the order items from the listing
            $this->syncInventory($order);

            event(new OrderCreated($order));   // Trigger the Event

            return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
            
         /* }
          else{
            return view('wallet.paysuspicious');
          }*/
        }
        else {
          //record response data
          DB::table('paytm_request_log')
                ->where('order_id', $_POST['ORDERID'])
                ->update(['response_ts' => date('Y-m-d H:i:s'),'TXNID'=>$_POST['TXNID'],'STATUS'=>$_POST['STATUS'],'RESPONSE'=>json_encode($_POST) ]);

          ////update transaction table which will auto update wallet
          $paydata=PaytmRequest::where('order_id',$_POST['ORDERID'])->first();
          
          return view('payment.paytm.payfailed', compact('paydata'));
        }
      }
      else {
        
        return view('payment.paytm.paysuspicious');
      }
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

    public function removeCheckSumParam($arrayList) {
      if (isset($arrayList["CHECKSUMHASH"])) {
        unset($arrayList["CHECKSUMHASH"]);
      }
      return $arrayList;
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

    public function checkString_e($value) {
      if ($value == 'null')
        $value = '';
      return $value;
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




    /**
     * Charge using Stripe
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     *
     * @return [type]
     */
    private function chargeWithStripe($request, Order $order)
    {
        // Get stripe user id for the connected stripe account of the vendor
        $vendorStripeAccountId = $order->shop->stripe->stripe_user_id;

        // If the stripe is not cofigured
        if( ! $vendorStripeAccountId )
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();

        // Get customer
        if(Auth::guard('customer')->check())
            $customer = Auth::guard('customer')->user();

        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));

        if ('saved_card' == $request->payment_method) {  // Charge old card
            // Create stripe token
            $token = \Stripe\Token::create([
              "customer" => $customer->stripe_id,
            ], ["stripe_account" => $vendorStripeAccountId]);

            $stripeToken = $token->id;
        }
        else if ($request->has('cc_token')){    // This is a new card with stripe token

            if ($request->has('remember_the_card')) {  // Create Stripe Customer for future use
                $stripeCustomer = \Stripe\Customer::create([
                    'email' => $customer->email,
                    'source' => $request->cc_token,
                ]);

                // Save cart info for future use
                $customer->stripe_id = $stripeCustomer->id;
                if ( count($stripeCustomer->sources->data) > 0 ) {
                    $customer->card_brand = $stripeCustomer->sources->data[0]->brand;
                    $customer->card_holder_name = $stripeCustomer->sources->data[0]->name;
                    $customer->card_last_four = $stripeCustomer->sources->data[0]->last4;
                }
                $customer->save();

                // Create stripe token
                $token = \Stripe\Token::create([
                  "customer" => $customer->stripe_id,
                ], ["stripe_account" => $vendorStripeAccountId]);

                $stripeToken = $token->id;
            }
            else {      // Just charge the new card (Don't save)
                $stripeToken = $request->cc_token;
            }
        }

        // Get calculated application fee for the order
        $application_fee = getPlatformFeeForOrder($order);

        return \Stripe\Charge::create([
            'amount' => get_cent_from_doller($order->grand_total),
            'currency' => get_currency_code(),
            'description' => trans('app.purchase_from', ['marketplace' => get_platform_title()]),
            'source' => $stripeToken,
            'application_fee' => get_cent_from_doller($application_fee),
            'metadata' => [
                'order_number' => $order->order_number,
                'shipping_address' => $order->shipping_address,
                'buyer_note' => $order->buyer_note
            ],
        ], ["stripe_account" => $vendorStripeAccountId]);
    }

    /**
     * [chargeWithInstamojo description]
     *
     * @param  [type] $request [description]
     * @param  Order  $order   [description]
     * @param  Cart   $cart    [description]
     *
     * @return [type]          [description]
     */
    private function chargeWithInstamojo($request, Order $order, Cart $cart)
    {
        // Get the vendor configs
        $vendorInstamojoConfig = $order->shop->instamojo;
        // If the stripe is not cofigured
        if( ! $vendorInstamojoConfig )
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();

        $instamojoApi = new Instamojo(
                                    $vendorInstamojoConfig->api_key,
                                    $vendorInstamojoConfig->auth_token,
                                    $vendorInstamojoConfig->sandbox == 1 ? 'https://test.instamojo.com/api/1.1/' : Null
                                );

        try {
            $response = $instamojoApi->paymentRequestCreate([
                            "purpose" => trans('theme.order_id') . ': ' . $order->order_number,
                            "amount" => number_format($order->grand_total, 2),
                            "buyer_name" => Auth::guard('customer')->check() ?
                                            Auth::guard('customer')->user()->getName() : $request->address_title,
                            "send_email" => true,
                            "email" =>  Auth::guard('customer')->check() ?
                                        Auth::guard('customer')->user()->email : $request->email,
                            "phone" => Auth::guard('customer')->check() ? '' : $request->phone,
                            "redirect_url" => route('instamojo.redirect', ['order' => $order, 'cart' => $cart])
                        ]);

            // $response = $instamojoApi->paymentRequestStatus($response['id']);
            // print_r($response);
        }
        catch (Exception $e) {
            return $e->getMessage();
        }

        // redirect to page so User can pay
        header('Location: ' . $response['longurl']);
        exit();
    }

    /**
     * [instamojoRedirect description]
     *
     * @param  Request $request [description]
     * @param  [type]  $order   [description]
     * @param  [type]  $cart    [description]
     *
     * @return [type]           [description]
     */
    public function instamojoSuccess(Request $request, $order, $cart)
    {
        if ( $request->payment_status != 'Credit' || ! $request->has('payment_request_id') ||  ! $request->has('payment_id') )
            return redirect()->route("payment.failed", $order);

        if( !$order instanceOf Order )
            $order = Order::find($order);

        // Delete the cart
        Cart::find($cart)->forceDelete();   // Delete the cart

        // Order has been paided
        $this->markOrderAsPaid($order);

        // Decrease the stock of the order items from the listing
        $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    /**
     * [chargeWithAuthorizeNet description]
     *
     * @param  [type] $request [description]
     * @param  Order  $order   [description]
     *
     * @return [type]          [description]
     */
    private function chargeWithAuthorizeNet($request, Order $order)
    {
        // Get the vendor configs
        $vendorAuthorizeNetConfig = $order->shop->authorizeNet;
        // If the stripe is not cofigured
        if( ! $vendorAuthorizeNetConfig )
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();

        // Common setup for API credentials
        $merchantAuthentication = new AuthorizeNetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($vendorAuthorizeNetConfig->api_login_id);
        $merchantAuthentication->setTransactionKey($vendorAuthorizeNetConfig->transaction_key);
        $refId = 'ref'.time();

        // Create the payment data for a credit card
        $creditCard = new AuthorizeNetAPI\CreditCardType();
        $creditCard->setCardNumber($request->cnumber);
        // $creditCard->setExpirationDate( "2038-12");
        $expiry = $request->card_expiry_year . '-' . $request->card_expiry_month;
        $creditCard->setExpirationDate($expiry);
        $paymentOne = new AuthorizeNetAPI\PaymentType();
        $paymentOne->setCreditCard($creditCard);

        // Create a transaction
        $transactionRequestType = new AuthorizeNetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType("authCaptureTransaction");
        $transactionRequestType->setAmount(get_formated_decimal($order->grand_total));
        $transactionRequestType->setPayment($paymentOne);
        $ApiRequest = new AuthorizeNetAPI\CreateTransactionRequest();
        $ApiRequest->setMerchantAuthentication($merchantAuthentication);
        $ApiRequest->setRefId($refId);
        $ApiRequest->setTransactionRequest($transactionRequestType);
        $controller = new AuthorizeNetController\CreateTransactionController($ApiRequest);
        $response = $controller->executeWithApiResponse(
            $vendorAuthorizeNetConfig->sandbox == 1 ?
            \net\authorize\api\constants\ANetEnvironment::SANDBOX :
            \net\authorize\api\constants\ANetEnvironment::PRODUCTION
        );

        if ($response != null) {
            $tresponse = $response->getTransactionResponse();
            if (($tresponse != null) && ($tresponse->getResponseCode() == "1")) { // Approved
                \Log::info("Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n");
                \Log::info("Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n");

                return TRUE;
            }
            else {
                $errMsg = $tresponse == null ? trans('theme.notify.invalid_request') : $tresponse->getErrors()[0]->getErrorText();
                throw new AuthorizeNetException($errMsg);

                return FALSE;
            }
        }

        \Log::error("AuthorizeNetException:: Charge Credit Card Null response returned");

        throw new AuthorizeNetException(trans('theme.notify.payment_failed'));

        return FALSE;
    }

    /**
     * [chargeWithPaystack description]
     *
     * @param  [type] $request [description]
     * @param  Order  $order   [description]
     * @param  Cart   $cart    [description]
     *
     * @return [type]          [description]
     */
    private function chargeWithPaystack($request, Order $order, Cart $cart)
    {
        // Get the vendor configs
        $vendorPaystackConfig = $order->shop->paystack;
        // If the stripe is not cofigured
        if( ! $vendorPaystackConfig )
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();

        $paystack = new \Yabacon\Paystack($vendorPaystackConfig->secret);
        $tranx = $paystack->transaction->initialize([
            'email' => $request->email,
            'amount' => (int) ($order->grand_total * 100),
            'quantity' => $order->quantity,
            'orderID' => $order->id,
            'callback_url' => route('paystack.success', ['order' => $order, 'cart' => $cart]),
            // 'reference' => $order->order_number,
            'metadata'=>json_encode([
                'order_number' => $order->order_number,
                'custom_fields'=> [
                    [
                        'display_name'=> "Order Number",
                        'variable_name'=> "order_number",
                        'value'=> $order->order_number
                    ],[
                        'display_name'=> "Shipping Address",
                        'variable_name'=> "shipping_address",
                        'value'=> $order->order_number
                    ]
                ]
            ])
        ]);

        if(!$tranx->status)
            throw new \Yabacon\Paystack\Exception\ApiException;

        // store transaction reference so we can query in case user never comes back
        // perhaps due to network issue
        // save_last_transaction_reference($tranx->data->reference);

        // redirect to page so User can pay
        header('Location: ' . $tranx->data->authorization_url);
        exit();
    }

    /**
     * [paystackPaymentSuccess description]
     *
     * @param  Request $request [description]
     * @param  [type]  $order   [description]
     * @param  [type]  $cart    [description]
     *
     * @return [type]           [description]
     */
    public function paystackPaymentSuccess(Request $request, $order, $cart)
    {
        if ( ! $request->has('trxref') ||  ! $request->has('reference') )
            return redirect()->route("payment.failed", $order);

        if( !$order instanceOf Order )
            $order = Order::find($order);

        // Delete the cart
        Cart::find($cart)->forceDelete();   // Delete the cart

        // Order has been paided
        $this->markOrderAsPaid($order);

        // Decrease the stock of the order items from the listing
        $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    /**
     * Charge using Stripe
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     *
     * @return [type]
     */
    private function chargeWithPayPal($request, Order $order)
    {
        // Get the vendor configs
        $vendorPaypalConfig = $order->shop->paypalExpress;

        // If the stripe is not cofigured
        if( ! $vendorPaypalConfig )
            return redirect()->back()->with('success', trans('theme.notify.payment_method_config_error'))->withInput();

        // Set vendor's paypal config
        config()->set('paypal_payment.mode', $vendorPaypalConfig->sandbox == 1 ? 'sandbox' : 'live');
        config()->set('paypal_payment.account.client_id', $vendorPaypalConfig->client_id);
        config()->set('paypal_payment.account.client_secret', $vendorPaypalConfig->secret);

        // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        // $shippingAddress= Paypalpayment::shippingAddress();
        // $shippingAddress->setLine1("3909 Witmer Road")
        //     ->setLine2("Niagara Falls")
        //     ->setCity("Niagara Falls")
        //     ->setState("NY")
        //     ->setPostalCode("14305")
        //     ->setCountryCode("US")
        //     ->setPhone("716-298-1822")
        //     ->setRecipientName("Jhone");

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $allItems = [];
        foreach ($order->inventories as $item) {
            $tempItem = Paypalpayment::item();
            $tempItem->setName($item->title)->setDescription($item->pivot->item_description)
            ->setCurrency( get_currency_code() )->setQuantity($item->pivot->quantity)
            ->setTax($order->taxrate)->setPrice($item->pivot->unit_price);

            $allItems[] = $tempItem;
        }

        $itemList = Paypalpayment::itemList();
        $itemList->setItems($allItems);
        // ->setShippingAddress($shippingAddress);

        $details = Paypalpayment::details();
        $details->setShipping( $order->get_shipping_cost() )->setTax($order->taxes)
        ->setGiftWrap($order->packaging)->setShippingDiscount($order->discount)
        ->setSubtotal($order->calculate_total_for_paypal()); //total of items prices

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency( get_currency_code() )
        ->setTotal( $order->grand_total_for_paypal() )
        ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a payment - what is the payment for and who
        // is fulfilling it. Transaction is created with a `Payee` and `Amount` types
        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription( trans('app.purchase_from', ['marketplace' => get_platform_title()]) )
        ->setInvoiceNumber($order->order_number);

        // ### Payment
        // A Payment Resource; create one using the above types and intent as 'sale'
        $redirectUrls = Paypalpayment::redirectUrls();
        $redirectUrls->setReturnUrl(route("payment.success", $order->id))
        ->setCancelUrl(route("payment.failed", $order->id));

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")->setPayer($payer)->setRedirectUrls($redirectUrls)->setTransactions([$transaction]);

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService using a valid ApiContext The return object contains the status;
            $payment->create(Paypalpayment::apiContext());
        } catch (\PPConnectionException $ex) {
            return response()->json(["error" => $ex->getMessage()], 400);
        }

        return response()->json([$payment->toArray(), 'approval_url' => $payment->getApprovalLink()], 200);
    }

    /**
     * Payment done successfully. Sync inventory and trigger event
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentSuccess(Request $request, $order)
    {
        if ( ! $request->has('token') ||  ! $request->has('paymentId') || ! $request->has('PayerID') )
            return redirect()->route("payment.failed", $order);

        if( !$order instanceOf Order )
            $order = Order::find($order);

        // Order has been paided
        $this->markOrderAsPaid($order);

        // Decrease the stock of the order items from the listing
        $this->syncInventory($order);

        event(new OrderCreated($order));   // Trigger the Event

        return redirect()->route('order.success', $order)->with('success', trans('theme.notify.order_placed'));
    }

    /**
     * Payment faile. revert the order
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Order  $order
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentFailed(Request $request, $order)
    {
        $cart = $this->revertOrder($order);

        return redirect()->route('cart.checkout', $cart)->with('error', trans('theme.notify.payment_failed'))->withInput();
    }

    /**
     * Order placed successfully.
     *
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function orderPlaced($order)
    {
        if( !$order instanceOf Order )
            $order = Order::find($order);

        return view('order_complete', compact('order'));
    }

    /**
     * Display order detail page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function detail(OrderDetailRequest $request, Order $order)
    {
        $order->load(['inventories.image','conversation.replies.attachments']);

        return view('order_detail', compact('order'));
    }

  
    /**
     * Buyer confirmed goods received
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function goods_received(ConfirmGoodsReceivedRequest $request, Order $order)
    {
        $order->goods_received();

        return redirect()->route('order.feedback', $order)->with('success', trans('theme.notify.order_updated'));
    }

    /**
     * Track order shippping.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Order   $order
     *
     * @return \Illuminate\Http\Response
     */
    public function track(Request $request, Order $order)
    {
        return view('order_tracking', compact('order'));
    }

    /**
     * Create a new Customer
     *
     * @param  Request $request
     *
     * @return App\Customer
     */
    private function createNewCustomer($request)
    {
        $customer = Customer::create([
            'name' => $request->address_title,
            'email' => $request->email,
            'password' => $request->password,
            'accepts_marketing' => $request->subscribe,
            'verification_token' => str_random(40),
            'active' => 1,
        ]);

        // Sent email address verification notich to customer
        $customer->notify(new EmailVerificationNotification($customer));

        $customer->addresses()->create($request->all()); //Save address

        \Auth::guard('customer')->login($customer); //Login the customer

        return $customer;
    }

    /**
     * Create a new order from the cart
     *
     * @param  Request $request
     * @param  App\Cart $cart
     *
     * @return App\Order
     */
    private function saveOrderFromCart($request, $cart)
    {
        // Get shipping address
        if(is_numeric($request->ship_to))
            $address = \App\Address::find($request->ship_to)->toString(True);
        else
            $address = get_address_str_from_request_data($request);

        // Set shipping_rate_id and handling cost to NULL if its free shipping
        if($cart->is_free_shipping()) {
            $cart->shipping_rate_id = Null;
            $cart->handling = Null;
        }

        // Save the order
        $order = new Order;
        $order->fill(
            array_merge($cart->toArray(), [
                'grand_total' => $cart->grand_total(),
                'order_number' => get_formated_order_number($cart->shop_id),
                'carrier_id' => $cart->carrier() ? $cart->carrier->id : NULL,
                'shipping_address' => $address,
                'billing_address' => $address,
                'email' => $request->email,
                'buyer_note' => $request->buyer_note
            ])
        );
        $order->save();

        // Add order item into pivot table
        $cart_items = $cart->inventories->pluck('pivot');
        $order_items = [];
        foreach ($cart_items as $item) {
            $order_items[] = [
                'order_id'          => $order->id,
                'inventory_id'      => $item->inventory_id,
                'item_description'  => $item->item_description,
                'quantity'          => $item->quantity,
                'unit_price'        => $item->unit_price,
                'created_at'        => $item->created_at,
                'updated_at'        => $item->updated_at,
            ];
        }
        \DB::table('order_items')->insert($order_items);

        return $order;
    }

    /**
     * Revert order to cart
     *
     * @param  App\Order $Order
     *
     * @return App\Cart
     */
    private function revertOrder($order)
    {
        if( !$order instanceOf Order )
            $order = Order::find($order);

        if (!$order) return;

        // Save the cart
        $cart = Cart::create(array_merge($order->toArray(), ['ip_address' => request()->ip()]));

        // Add order item into pivot table
        $order_items = $order->inventories->pluck('pivot');
        $cart_items = [];
        foreach ($order_items as $item) {
            $cart_items[] = [
                'cart_id'           => $cart->id,
                'inventory_id'      => $item->inventory_id,
                'item_description'  => $item->item_description,
                'quantity'          => $item->quantity,
                'unit_price'        => $item->unit_price,
                'created_at'        => $item->created_at,
                'updated_at'        => $item->updated_at,
            ];
        }
        \DB::table('cart_items')->insert($cart_items);

        $order->forceDelete();   // Delete the order

        return $cart;
    }

    /**
     * MarkOrderAsPaid
     */
    private function markOrderAsPaid($order)
    {
        if( !$order instanceOf Order )
            $order = Order::find($order);

        $order->payment_status = Order::PAYMENT_STATUS_PAID;

        $order->save();

        event(new OrderPaid($order));

        return $order;
    }

    /**
     * Sync up the inventory
     * @param  Order $order
     *
     * @return void
     */
    private function syncInventory(Order $order)
    {
        foreach ($order->inventories as $item) {
            $item->decrement('stock_quantity', $item->pivot->quantity);
        }

        return;
    }

    private function logErrors($error, $feedback)
    {
        \Log::error($error);

        // Set error messages:
        // $error = new \Illuminate\Support\MessageBag();
        // $error->add('errors', $feedback);

        return $error;
    }

    public function return(Request $request, $order_id)
    {
        Order::where('id',$order_id)->update(['order_status_id'=>8]);
        $order = Order::find($order_id);
        $data = array(
            'order_number' => $order->order_number,
            'return_order_id' => $order->id,
            'shop_id' => $order->shop_id,
            'customer_id' => $order->customer_id,
            'ship_to' => $order->ship_to,
            'shipping_zone_id' => $order->shipping_zone_id,
            'shipping_rate_id'  => $order->shipping_rate_id,
            'packaging_id' => $order->packaging_id,
            'item_count' => $order->item_count,
            'quantity' => $order->quantity,
            'shipping_weight' => $order->shipping_weight,
            'taxrate' => $order->taxrate,
            'total' => $order->total,
            'discount' => $order->discount,
            'shipping' => $order->shipping,
            'packaging' => $order->packaging,
            'handling' => $order->handling,
            'taxes' => $order->taxes,
            'grand_total'  => $order->grand_total,
            'billing_address'  => $order->billing_address,
            'shipping_address' => $order->shipping_address,
            'shipping_date'  => $order->shipping_date,
            'delivery_date' => $order->delivery_date,
            'tracking_id' => $order->tracking_id,
            'coupon_id' => $order->coupon_id,
            'carrier_id' => $order->carrier_id,
            'message_to_customer' => $order->message_to_customer,
            'send_invoice_to_customer' => $order->send_invoice_to_customer,
            'admin_note' => $order->admin_note,
            'buyer_note' => $order->buyer_note,
            'payment_method_id' => $order->payment_method_id,
            'payment_status' => $order->payment_status,
            'return_status_id' => 1,
            'goods_received' => $order->goods_received,
            'approved' => $order->approved,
            'feedback_id' => $order->feedback_id,
            'disputed' => $order->disputed,
        );
        $return_id = \DB::table('return_orders')->insert($data);
        $orderItems = \DB::table('order_items')->where('order_id',$order_id)->get();
        foreach($orderItems as $items)
        {
            $item = array(
                'return_orders_id' => $return_id,   
                'return_item_id' => $items->order_item_id,
                'inventory_id' => $items->inventory_id,
                'item_description' => $items->item_description,
                'quantity' => $items->quantity,
                'unit_price' => $items->unit_price,
                'feedback_id' => $items->feedback_id,
            );
            \DB::table('return_order_items')->insert($item);
        }
        
        return redirect()->back()->with('success','Returned successfully');
    }

    public function return_old(OrderDetailRequest $request, Order $order)
    {
        $order->load(['inventories.image','conversation.replies.attachments']);

        $return_detail =DB::table('return_request')->where('order_id', $order->id)->first();
        
        return view('return_detail', compact('order','return_detail'));
    }


    public function return_order(Request $request)
    {
        $order_id=$request->order_id;
        $order_number=$request->order_number;
        $customer_id=$request->customer_id;
        $shop_id=$request->shop_id;
        $product_id=$request->product_id;
        $quantity=$request->quantity; 
        $product=array();
        foreach (array_combine($product_id, $quantity) as $id=>$qty) {
                    
            $product[$id]=$qty;
        }
     
        $data=array(

            "order_id"         =>$order_id,
            "order_number"     =>$order_number,
            "customer_id"      =>$customer_id,
            "shop_id"          =>$shop_id,
            "product_details"  =>json_encode($product),

        );  
        
        /*print_r($data);*/
        \DB::table('return_request')->insert($data);
        
        return redirect()->route('order.success', $order_id)->with('success', trans('Return Request Approved'));
    }   

}
