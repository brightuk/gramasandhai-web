<?php

namespace App\Controllers;

class LandingController extends BaseController
{
    protected $config;
    protected $api_url, $api_key;
    protected $baseURL;
    public $uploadPath, $image_url, $userId;



    public function __construct()
    {
        $this->config = config('AccessProperties');
        $this->api_url = $this->config->api_url;
        $this->uploads_url = $this->config->uploads;
        $this->api_key = $this->config->key;
        $this->uploadPath = realpath(FCPATH . '../') . '/uploads/images/';
        $this->userId = null;
        if (isset($_COOKIE['userId'])) {
            $this->userId = $_COOKIE['userId'];
        }

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
                'X-Api: Bearer ' . $this->api_key
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        return $data;
    }



    public function index()
    {
        // Get API data
        $page = $this->request->getGet('page');
        $resp = $this->apiGetfetch($this->api_url . '/shops');
        $location = $this->apiGetfetch($this->api_url . '/locations');
        $var = $this->apiGetfetch($this->api_url . '/allvariants');
        $area = $this->request->getGet('area');
        $dist = $this->request->getGet('district');
        $category = $this->request->getGet('category');
        // echo "<pre>", print_r($resp, true), "</pre>";die;


        if (!empty($dist) && !empty($area)) {
            $locationShop = $this->api_url . 'location/' . $dist . '/' . $area;
            $shopfilter = $this->apiGetfetch($locationShop);
            if (!empty($shopfilter) && $shopfilter['status'] == 'success') {
                $resp['shops'] = $shopfilter['shops'];
                $place = $shopfilter['place'];
            }
        }
        // print_r($locationShop);
  
        if (!empty($category)) {
            $catebyshop = $this->apiGetfetch($this->api_url . 'category_filter/' . $category);
            if (!empty($catebyshop) && $catebyshop['status'] == 'success') {
                $resp['shops'] = $catebyshop['shops'];
                // $resp['place'] = $this->placeFind($catebyshop['place']);
            }
        }
  
        if ($resp['status'] == 'success' && $var['status'] == 'success') {
            // echo "<pre>", print_r($ss, true), "</pre>"; die;
            foreach ($resp['shops'] as $key => $value) {
                $resp['shops'][$key]['place'] = $this->placeFind($value['city_id']);
                $resp['shops'][$key]['category_name'] = $this->categorisFind($value['category_id']);
                $resp['shops'][$key]['image'] = $this->getImage($value['shop_images']);
            }

            $data = [
                'location' => $location,
                'banners' => $var['banners'],
                'shop_list' => $resp['shops'],
                'categories' => $var['categories'],
                'place' => $place ?? '',
            ];
            // echo "<pre>", print_r($data, true), "</pre>";
            // die;
            return view('dashboard', $data);
        }


    }

    public function about_us_privacy_policy()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
        ];
        return view('about_us_privacy_policy', $data);
    }

    public function placeFind($id)
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        foreach ($location['citylist'] as $key => $value) {
            if ($value['id'] == $id) {
                $district = $value['district_name'] ?? '';
                $city = $value['city_name'] ?? '';
            }
        }
        return ucwords($district . ', ' . $city);
    }


    public function categorisFind($id)
    {
        $var = $this->apiGetfetch($this->api_url . '/allvariants');
$category = '';
        foreach ($var['categories'] as $key => $value) {
            if ($value['id'] == $id) {
                $category = $value['label_name'] ?? '';

            }
        }
        return ucwords($category);
    }

    public function getImage($data)
    {
        $enc = json_decode($data);
        $fina = $enc[0] ?? [];
        return $fina;
    }



    public function locationby_filter()
    {

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Location added successfully',
        ]);
    }

    public function orderhistory()
    {
        if ($this->userId === null) {
            return redirect()->back()->with('error', 'Please login first');
        }
        
        $url = $this->api_url . 'orders_history/' . $this->userId;
        $raw = $this->apiGetfetch($url);
        // echo "<pre>", print_r($raw, true), "</pre>";die;
        $location = $this->apiGetfetch($this->api_url . '/locations');


        $data = [
            'orders' => $raw['orders'],
            'order_details' => $raw['order_details'],
            'location' => $location,
            'place' => $place ?? '',
        ];


        return view('orderHistory', $data);
    }



}