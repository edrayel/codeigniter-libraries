<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supertext {

    protected $CI;

    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->CI =& get_instance();
    }

    public function send_sms(string $message, string $sender, string $receipient) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.supertextng.com/api.php" . "?username=" . $this->config['username'] . "&password=" . $this->config['password'] . "&destination=" . $receipient . "&message=" . $message . "&sender=" . $sender . "&nodnd=yes",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_COOKIE => "__cfduid=d6c29f0b78fae5d72714d486e1c99e62a1547295992",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function get_acct_balance(): string {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.supertextng.com/getbalance.php" . "?username=" . $this->config['username'] . "&password=" . $this->config['password'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_POSTFIELDS => "",
        CURLOPT_COOKIE => "__cfduid=d6c29f0b78fae5d72714d486e1c99e62a1547295992",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}