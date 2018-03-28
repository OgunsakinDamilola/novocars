<?php
/**
 * Created by PhpStorm.
 * User: UniQue
 * Date: 12/12/2017
 * Time: 2:55 PM
 */

namespace App\Services;


use App\Mail\FailedPayment;
use App\Mail\PaymentPreNotification;
use App\Mail\SuccessfulPayment;
use App\OnlinePayment;
use Exception;
use Illuminate\Support\Facades\Mail;
use nilsenj\Toastr\Facades\Toastr;

class InterswitchConfig
{

    public $web_pay_request_test_url     = 'https://sandbox.interswitchng.com/webpay/pay';

    public  $web_pay_test_query_url      = 'https://sandbox.interswitchng.com/webpay/api/v1/gettransaction.json';

    public $web_pay_request_live_url     = '';

    public $web_pay_query_live_url       = '';

    public $pay_direct_request_test_url  = 'https://sandbox.interswitchng.com/collections/w/pay';

    public $pay_direct_query_test_url    = 'https://sandbox.interswitchng.com/collections/api/v1/gettransaction.json';

    public $pay_direct_request_live_url  = 'https://webpay.interswitchng.com/paydirect/pay';

    public $pay_direct_live_query_url    = 'https://webpay.interswitchng.com/paydirect/api/v1/gettransaction.json';

    public static $ActionUrl             = 'https://sandbox.interswitchng.com/webpay/pay';

    public $mac_key                      = 'D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F';

    public $web_pay_item_id              = '101';

    public $web_pay_product_id           = '6205';

    public $pay_direct_pay_item_id       = '101';

    public $pay_direct_product_id        = '1706';

    public function __construct(){

        $this->requestActionUrl = $this->web_pay_request_test_url;
        $this->queryActionUrl   = $this->web_pay_test_query_url;
        $this->item_id = $this->web_pay_item_id;
        $this->product_id = $this->web_pay_product_id;

    }

    public function queryHash($txnRef){
        $toHash = $this->product_id.$txnRef.$this->mac_key;
        return openssl_digest($toHash, "SHA512");
    }

    public function transactionHash($txnRef,$amount,$redirectUrl,$booking_id){
        $info = [
            'reference' => $txnRef,
            'user_id' => auth()->user()->id,
            'booking_id' => $booking_id,
            'amount' => $amount,
            'payment_status' => 0

        ];
        OnlinePayment::store($info);
        $userInfo = auth()->user();
        try{
            Mail::to($userInfo)->send(new PaymentPreNotification($userInfo,$amount,$txnRef));
        }
        catch(Exception $e){
            Toastr::error('Unable to send pre payment notification');
        }
        $toHash = $txnRef.$this->product_id.$this->item_id.$amount.$redirectUrl.$this->mac_key;
        return openssl_digest($toHash, "SHA512");
    }


    public function cheatTransactionHash($txnRef,$amount,$redirectUrl){
        $toHash = $txnRef.$this->product_id.$this->item_id.$amount.$redirectUrl.$this->mac_key;
        return openssl_digest($toHash, "SHA512");
    }

    public function requery($txnRef,$amount){
        $headers = array(
            "GET /HTTP/1.1",
            "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1",
            "Accept-Language: en-us,en;q=0.5",
            "Keep-Alive: 300",
            "Connection: keep-alive",
            "Hash:" . $this->queryHash($txnRef) );

        $url = $this->queryActionUrl.'?productid='.$this->product_id.'&transactionreference='.$txnRef.'&amount='.$amount;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION ,1);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,120);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER ,false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        $response  = curl_exec($ch);
        curl_close($ch);
        return $this->queryValidator($txnRef,$response);

    }

    public function queryValidator($txnRef,$response){
        $transactionInfo = OnlinePayment::where('reference',$txnRef)->first();
        if(empty($response)){
            return [
                'booking_id' => $transactionInfo->booking_id,
                'reference' => $txnRef,
                'payment_status' => $transactionInfo->payment_status,
                'response_code' => $transactionInfo->response_code,
                'response_description' => 'Could not confirm payment status. Bad Internet Connection',
                'response_full' => $transactionInfo->response_full,
                'amount' => $transactionInfo->amount,
                'user_id' => '0'
            ];
        }else{
            $response  = json_decode($response);
            $responseCode = $response->ResponseCode;
            $amount = $response->Amount;
            $responseDescription = $response->ResponseDescription;
            if(($responseCode == "00" || $responseCode == "11" || $responseCode == "10")){
                $status = 1;
            }else{
                $status = 0;
            }
            $return_array = [
                'booking_id' => $transactionInfo->booking_id,
                'reference' => $txnRef,
                'payment_status' => $status,
                'response_code' => $responseCode,
                'response_description' => $responseDescription,
                'response_full' => json_encode($response,true),
                'amount' => $amount,
                'user_id' => $transactionInfo->user_id
            ];
            if(($responseCode == "00" || $responseCode == "11" || $responseCode == "10")){
                Mail::to(auth()->user())->send(new SuccessfulPayment(auth()->user(),$return_array));
            }else{
                Mail::to(auth()->user())->send(new FailedPayment(auth()->user(),$return_array));
            }
            return $return_array;
        }
    }



}