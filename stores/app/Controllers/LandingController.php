<?php

namespace App\Controllers;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\I18n\Time;

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
         helper('cookie'); 
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

    public function postApifetch($url, $postData)
    {

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'X-Api: Bearer ' . $this->api_key
            ]
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);
        return $result;
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

    public function partner_with_us()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');
        $categories = $this->apiGetfetch($this->api_url . '/categories');
        $resp = $this->apiGetfetch($this->api_url . '/check/shops');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
            'categories' => $categories['categories'] ?? [],
            'existing_shops' => json_encode($resp['shops'] )
        ];

        // echo "<pre>", print_r($data, true), "</pre>"; die;
        return view('path/partner_with_us', $data);
    }

    public function checkPendingShop(){
        $url = $this->api_url . 'check/pending-shop';
        $temp = $this->request->getJSON(true);
        $field = [
            'mobile' => $temp['mobile'] ?? '',
        ];    
        $response = $this->postApifetch($url, $field);

        return $this->response->setJSON([
            'success' =>  true,
            'pending' => $response['pending'] ?? false,
            'shop' => $response['shop']?? []
            // 'shop' => $response
        ]);

    }



    public function partner_JoinProcess()
    {

        $formData = $this->request->getPost();
        // echo "<pre>", print_r($formData, true), "</pre>";

        $uploadDir = rtrim($this->uploadPath, '/\\') . '/partner_docs';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        // print_r($uploadDir);

        $fssai_license = $this->request->getFile('fssai_license_file');
        $gstin_certificate = $this->request->getFile('gstin_certificate_file');
        $bank_details = $this->request->getFile('bank_details_file');
        $pan_card = $this->request->getFile('pan_card_file');
        $shopping_products = $this->request->getFile('shopping_products_file');
        $business_photos = $this->request->getFileMultiple('business_photos_file');

        $fields = [];

        $fields = [
            'shop_name' => ucwords($formData['business_name'] ?? ''),
            'owner_name' => $formData['name'] ?? '',
            'email' => $formData['email'] ?? '',
            'phone' => $formData['mobile'] ?? '',
            'password' => $formData['password'] ?? '',
            'fssai_license_no' => $formData['fssai_license_number'] ?? '',
            'gstin_certificate_no' => $formData['gstin_number'] ?? '',
            'pan_card' => $formData['pancard'] ?? '',
            'shop_category' => $formData['business_type'] ?? '',
            'state_id' => $formData['state'] ?? '',
            'district_id' => $formData['city'] ?? '',
            'city_id' => $formData['area'] ?? '',
            'address' => $formData['business_address'] ?? '',
            'description' => $formData['description'] ?? '',
            'pincode' => $formData['pincode'] ?? '',
            'terms_agreement' => $formData['terms_agreement'] ?? "off"
          ];
// echo "<pre>", print_r($fields, true), "</pre>"; die;


        // Single file fields
        if ($fssai_license && $fssai_license->isValid() && !$fssai_license->hasMoved()) {
            $fields['fssai_license'] = new \CURLFile(
                $fssai_license->getTempName(),
                $fssai_license->getMimeType(),
                $fssai_license->getName()
            );
        }

        if ($gstin_certificate && $gstin_certificate->isValid() && !$gstin_certificate->hasMoved()) {
            $fields['gstin_certificate'] = new \CURLFile(
                $gstin_certificate->getTempName(),
                $gstin_certificate->getMimeType(),
                $gstin_certificate->getName()
            );
        }

        if ($pan_card && $pan_card->isValid() && !$pan_card->hasMoved()) {
            $fields['pan_card'] = new \CURLFile(
                $pan_card->getTempName(),
                $pan_card->getMimeType(),
                $pan_card->getName()
            );
        }

        if ($bank_details && $bank_details->isValid() && !$bank_details->hasMoved()) {
            $fields['bank_details'] = new \CURLFile(
                $bank_details->getTempName(),
                $bank_details->getMimeType(),
                $bank_details->getName()
            );
        }

        if ($shopping_products && $shopping_products->isValid() && !$shopping_products->hasMoved()) {
            $fields['shopping_products'] = new \CURLFile(
                $shopping_products->getTempName(),
                $shopping_products->getMimeType(),
                $shopping_products->getName()
            );
        }

        // Multiple file fields
     
        if (!empty($business_photos)) {
            foreach ($business_photos as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $fields["shop_images[$index]"] = new \CURLFile(
                        $file->getTempName(),
                        $file->getMimeType(),
                        $file->getName()
                    );
                }
            }
        }
        // echo "<pre>", print_r($fields, true), "</pre>"; die;


        $url = $this->api_url . 'join/partner-with-us';

        $response = $this->postApifetch($url, $fields);

    // echo "<pre>", print_r($response, true), "</pre>"; die;
       


            if(isset($response['status']) && $response['status']){
                

            // inside controller method, before sending output
            $cookieData = [
                'application_id' => $response['application_id'] ?? '',
                'timestamp'      => time(),
                'business_name'  => $this->request->getPost('business_name') ?? ''
            ];

                $cookie = [
                'name'     => 'registration_success',
                'value'    => json_encode($cookieData),
                // expire as TTL (seconds) — 11 days:
                'expire'   => 60 * 60 * 24 * 11,
                'path'     => '/',
                'domain'   => '', // leave blank to use current host
                'secure'   => $this->request->isSecure(), // boolean
                'httponly' => true,
                'samesite' => 'Lax', // Response->setCookie supports this
            ];

            // Use the response object (preferred)

            $this->response->setCookie($cookie);
          
            // echo "<pre>", print_r($response, true), "</pre>"; die;
            
           return redirect()->to(base_url('join/register_completed'))->with('success', json_encode($cookieData));
        } else {
            $errorMessage = $response['message'] ?? 'An error occurred while submitting your application.';
            return redirect()->back()->with('error', $errorMessage)->withInput();
        }
   
    }

    public function regCompleted()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');
    

        $data = [
            'location' => $location,
            'place' => $place ?? '',

        ];
        return view('path/reg_complete', $data);
    }
















    // $fields = [
    // 'shop_id' => $this->request->getPost('shop_id') ?? null,
    // // 'shop_name' => ucwords($postData['shop_name'] ?? ''),
    // // 'owner_name' => $postData['owner_name'] ?? '',
    // // 'email' => $postData['email'] ?? '',
    // 'urlname' => $this->request->getPost('urlname') ?? '',
    // // 'phone' => $postData['shop_phone'] ?? '',
    // // 'address' => $postData['shop_address'] ?? '',
    // // 'shop_category' => $postData['shop_category'] ?? '',
    // // 'state_id' => $postData['state_id'] ?? '',
    // // 'district_id' => $postData['district_id'] ?? '',
    // // 'city_id' => $postData['city_id'] ?? '',
    // 'pincode' => $postData['pincode'] ?? '',
    // // 'shop_logo' => $shop_logo,
    // // 'shop_images' => $uploadedFiles != null ? json_encode($uploadedFiles) : $old_shop_images,
    // // 'qr_image' => $qr_image,
    // 'discount' => "0",
    // 'latitude' => "00.000000",
    // 'longitude' => "00.000000",



























    public function privacy_policy()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
        ];
        return view('policy/privacy_policy', $data);
    }

    public function refund_policy()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
        ];
        return view('policy/refund_policy', $data);
    }
    public function cancellation_policy()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
        ];
        return view('policy/cancellation_policy', $data);
    }
    public function cookies_Policy()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
        ];
        return view('policy/cookies_Policy', $data);
    }

    public function terms_of_service()
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');

        $data = [
            'location' => $location,
            'place' => $place ?? '',
        ];
        return view('policy/terms_condition', $data);
    }










    public function placeFind($id)
    {
        $location = $this->apiGetfetch($this->api_url . '/locations');
        $district = "";
        $city = "";
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