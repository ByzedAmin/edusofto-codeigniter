<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bkash_payment
{

    private $ci;
    public $api_config;


    function __construct()
    {
        $this->ci = &get_instance();
        $this->initialize();
    }

    public function initialize($branchID = '')
    {
        if (empty($branchID)) {
            $branchID = get_loggedin_branch_id();
        }
        $this->api_config = $this->ci->db->select('bkash_app_key,bkash_secret_key,bkash_username,bkash_password,bkash_sandbox')->where('branch_id', 1)->get('payment_config')->row_array();
        if (empty($this->api_config)) {
            $this->api_config = ['bkash_app_key' => '', 'bkash_secret_key' => '', 'bkash_username' => '', 'bkash_password' => '', 'bkash_sandbox' => ''];
        }
    }

    public function getAccessToken()
    {
        $data = [
            'app_key' => $this->api_config['bkash_app_key'],
            'app_secret' => $this->api_config['bkash_secret_key']
        ];

        $url = $this->api_config['bkash_sandbox'] == 1
            ? 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/token/grant'
            : 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/token/grant';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'password:' . $this->api_config["bkash_password"],
            'username:' . $this->api_config["bkash_username"]
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function createCheckoutRequest($data)
    {
        $paymentData = [
            'amount' => (string)$data['amount'],
            'currency' => (string)$data['currency'],
            'merchantInvoiceNumber' => (string)$data['invoice_no'],
            'intent' => (string)$data['intent'],
        ];

        $url = $this->api_config['bkash_sandbox'] == 1
            ? 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/create'
            : 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/create';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept:application/json',
            'Content-Type:application/json',
            'Authorization:' . $data['token'],
            'X-APP-Key:' . $this->api_config['bkash_app_key']
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function executePayment($token, $paymentID)
    {

        $url = $this->api_config['bkash_sandbox'] == 1
            ? 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/execute'
            : 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/execute';

        $url = curl_init($url.'/'.$paymentID);
        curl_setopt($url,CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization:'.$token,
            'X-App-Key:'.$this->api_config['bkash_app_key']
        ]);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);

        $response = curl_exec($url);
        curl_close($url);

        return $response;
    }

    public function verifyPayment($token, $paymentId)
    {
        $url = $this->api_config['bkash_sandbox'] == 1
            ? 'https://checkout.sandbox.bka.sh/v1.2.0-beta/checkout/payment/query/'
            : 'https://checkout.pay.bka.sh/v1.2.0-beta/checkout/payment/query/';

        $url = curl_init($url . $paymentId);
        curl_setopt($url, CURLOPT_HTTPHEADER, [
            'Content-Type:application/json',
            'Authorization:'.$token,
            'X-App-Key:'.$this->api_config['bkash_app_key']
        ]);
        curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);

        $response = curl_exec($url);
        curl_close($url);
        return $response;
    }
}