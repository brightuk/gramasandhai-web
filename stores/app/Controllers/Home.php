<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $api_key;
    protected $api_url;
    public $base, $main_api, $shop_name;


    public function __construct()
    {
        $config = config('App');
        $this->api_url = $config->api_url;
        $this->api_key = 'SEC195C79FC4CCB09B48AA8';
        $this->base = $config->base;





    }


    public function notification()
    {
        $data = [];
        // print_r($data);
        return view('notification', $data);
    }


    


    public function apiGetfetch($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-Api: Bearer ' . $this->main_api['key']
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        return $data;
    }


}