<?php (! defined('BASEPATH')) and exit('No direct script access allowed');

class Sms_balance
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }
    public function get_balance($branchID, $providerID)
    {
        $provider = $this->ci->db->where(array('sms_api_id' => $providerID, 'branch_id' => $branchID))
            ->join('sms_api', 'sms_api.id = sms_credential.sms_api_id', 'left')
            ->select('sms_api.name as name, sms_credential.*')
            ->get('sms_credential')->row();

        if($provider){
            return self::{$provider->name}($provider);
        }
    }

    public function bulksmsbd($provider)
    {
        $url = "https://bulksmsbd.net/api/getBalanceApi";
        $api_key = $provider->field_two;
        $data = [
            "api_key" => $api_key
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if ($response->response_code == 202) {
            return $response->balance;
        }
    }
}