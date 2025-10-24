<?php

namespace App\Controllers;

class StoresController extends BaseController
{
    protected $config;
    protected $api_url, $api_key, $api_url_store, $api_url_shop;
    protected $baseURL;
    public $uploadPath, $image_url, $shop_name, $shop_id, $color;
    protected $request;
    public function __construct()
    {
        $this->config = config('AccessProperties');
        $this->api_url = $this->config->api_url;
        $this->uploads_url = $this->config->uploads;
        $this->api_key = $this->config->key;
        $this->api_url_store = $this->config->api_url . 'store/';
        $this->api_url_shop = $this->config->api_url . 'shop/';
        $this->request = service('request');
        $this->getShop();
        if (!empty($this->shop_id)) {
            $this->config->shop_id = (int) $this->shop_id;
            $this->config->shop_name = $this->shop_name;
            $this->config->color = (string) $this->color;
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


    public function shopHome($seg)
    {
        $url = $this->api_url_store . $seg;
        $raw = $this->apiGetfetch($url);
        // echo "<pre>", print_r($raw, true), "</pre>";
        if (isset($raw['status']) && $raw['status'] == 'success') {
            $shop = $raw['shop'];
            $url2 = $this->api_url_store . $shop['shop_id'] . '/all';
            $raw2 = $this->apiGetfetch($url2);
            $url3 = $this->api_url_store . $shop['shop_id'] . '/random_products';
            $raw3 = $this->apiGetfetch($url3);

            // Use the segment parameter passed from the route, which is the shop URL name
            $shop_url_name = $seg;
            
            $product_details = [
                'banner' => $raw2['banner'],
                'products' => $raw3['products'],
                'allproducts' => $raw2['products'],
                'variants' => $raw2['products_variants'],
                'categories' => $raw2['categories'],
                'subcategories' => $raw2['subcategories'],
                'shop_url_name' => $shop_url_name
            ];

            return view('mainHeader', $product_details);

        } else {
            if (isset($raw['type']) && $raw['type'] == 'STU') {
                return view('errorpage/shoptemp');
            } else if (isset($raw['type']) && $raw['type'] == 'SNF') {
                return view('errorpage/shopnotf');
            }
        }

    }

    public function getShop()
    {
        $seg = $this->request->getUri()->getSegment(1);
        $url = $this->api_url_store . $seg;
        $raw = $this->apiGetfetch($url);

        $this->shop_name = $raw['shop']['shop_name'] ?? '';
        $this->shop_id = $raw['shop']['shop_id'] ?? '';
        $this->color = $raw['shop']['color'] ?? 'no';

    }

    public function registrationProcess()
    {
        $url = $this->api_url . 'registrationProcess';

        $postData = [
            'mobile' => $this->request->getPost('mobile')
        ];
        $result = $this->postApifetch($url, $postData);

        if (isset($result['status']) && $result['status'] == 'success') {
            return $this->response->setJSON([
                'status' => 'success',
                'user_id' => $result['user_id'],
                'otp' => $result['otp'],
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $result['message'],
            ]);
        }
    }

    public function regVerify()
    {
        $postData = [
            'mobile' => $this->request->getPost('mobile'),
            'otp' => $this->request->getPost('otp'),
            'devicetoken' => $this->request->getPost('devicetoken'),
        ];
        $url = $this->api_url . 'regVerify';
        $result = $this->postApifetch($url, $postData);



        return $this->response->setJSON($result);
    }

    public function offerPage($url_name)
    {
        $url = $this->api_url_store . $this->shop_id . '/offers';
        $raw = $this->apiGetfetch($url);

        $funcdata = $this->productsReturn();
        
        // Use the url_name parameter passed from the route, which is the shop URL name
        $shop_url_name = $url_name;

        $data = [
            'offers' => $raw['offers'],
            'products' => $funcdata['products'],
            'categories' => $funcdata['categories'],
            'allproducts' => $funcdata['products'],
            'subcategories' => $funcdata['subcategories'],
            'shop_url_name' => $shop_url_name
        ];
        return view('offerspage', $data);
    }

    public function productsReturn()
    {
        $url = $this->api_url_store . $this->shop_id . '/all';
        $data = $this->apiGetfetch($url);

        $product_details = [
            'products' => $data['products'],
            'allproducts' => $data['products'],
            'products_variants' => $data['products_variants'],
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories']
        ];

        return $product_details;
    }

    public function productShow($seg)
    {
        $data = $this->productsReturn();
        
        // Use the segment parameter passed from the route, which is the shop URL name
        $shop_url_name = $seg;

        $product_details = [
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'allproducts' => $data['products'],
            'allvariants' => $data['products_variants'],
            'shop_url_name' => $shop_url_name,
            'isProductShow' => true
        ];
        // echo "<pre>", print_r($product_details, true), "</pre>";die;

        return view('productshow', $product_details);

    }

    public function productFilter($seg, $category_id = null, $subcategory_id = null, $prod_id = null)
    {
        // Fetch all core product data for fallback/context
        $data = $this->productsReturn();

        // Construct API filter URL for shop, category, and subcategory
        $url = $this->api_url_store . $this->shop_id . '/productsfilter' . '/' . $category_id . '/' . $subcategory_id;
        $raw = $this->apiGetfetch($url);
            // echo "<pre>", print_r($raw, true), "</pre>";die;

        if (!empty($raw['products'])) {
            // Gather only relevant filtered product IDs
            $filteredProdIds = array_column($raw['products'], 'id');
            $filteredVariants = [];

            if (is_array($raw['products_variants'])) {
                foreach ($raw['products_variants'] as $variant) {
                    if (is_array($variant) && isset($variant['prod_id']) && in_array($variant['prod_id'], $filteredProdIds)) {
                        $filteredVariants[] = $variant;
                    }
                }
            }

            $product_details = [
                'categories' => $data['categories'],
                'subcategories' => $data['subcategories'],
                'allproducts' => $raw['products'],
                // 'variant' => $filteredVariants,
                'allvariants' => $data['products_variants'],
                // 'allproducts' => $data['products'],
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'isProductShow' => true
            ];

            // echo "<pre>", print_r($product_details, true), "</pre>";die;


            return view('productshow', $product_details);
        } else {
            // Fallback: Provide all variants & show empty product message
            $message = [
                'status' => 'error',
                'variants' => $data['products_variants'],
                'products' => $data['products'],
                'allvariants' => $data['products_variants'],
                'categories' => $data['categories'],
                'subcategories' => $data['subcategories'],
                'allproducts' => $raw['products'],
                'category_id' => $category_id,
                'subcategory_id' => $subcategory_id,
                'isProductShow' => true,
                'message' => 'No products found for this category and subcategory.'
            ];
            // echo "<pre>", print_r($message, true), "</pre>";die;

            return view('productshow', $message);
        }
    }

    public function searchProduct($subcategory_id, $prod_id)
    {

        $raw = $this->productsReturn();
        // echo "<pre>", print_r($raw, true), "</pre>";

        if (!empty($raw['products'])) {
            // ✅ Step 1: Filter products by given subcategory & product
            $filteredProducts = array_filter($raw['products'], function ($product) use ($subcategory_id, $prod_id) {
                return $product['subcategory_id'] == $subcategory_id || $product['id'] == $prod_id;
            });

            // ✅ Step 2: Collect product IDs for variant matching
            $filteredProdIds = array_column($filteredProducts, 'id');

            $filteredVariants = [];

            if (!empty($raw['products_variants']) && is_array($raw['products_variants'])) {
                foreach ($raw['products_variants'] as $variantGroup) {
                    foreach ($variantGroup as $variant) { // <-- extra loop
                        if (in_array($variant['prod_id'], $filteredProdIds)) {
                            $filteredVariants[] = $variant;
                        }
                    }
                }
            }


            $product_details = [
                'allproducts' => $filteredProducts,  
                'allvariants' => $raw['products_variants'],
                'categories' => $raw['categories'],
                'subcategories' => $raw['subcategories'], 
                'subcategory_id' => $subcategory_id,
                'isProductShow' => true
            ];

            return view('productshow', $product_details);
        }

        return redirect()->back()->with('error', 'No products found');
    }

    public function offersProducts(){
        $url = $this->api_url_store . $this->shop_id . '/offer/products' ;
        $raw = $this->apiGetfetch($url);
        $data = $this->productsReturn();

        $product_details = [
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'allproducts' => $raw['products'],
            'allvariants' => $data['products_variants'],
            'title' => "Offer"
        ];
        return view('productshow', $product_details);

        // echo "<pre>", print_r($product_details, true), "</pre>";die;
    }


    public function cart($seg)
    {
        $data = $this->productsReturn();
        $shop_url_name = $seg;
        
        $viewData = [
            'products' => $data['products'],
            'variants' => $data['products_variants'],
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'shop_url_name' => $shop_url_name
        ];

        // Check for AJAX request
        $isAjax = $this->request->getVar('ajax') == 1;

        if ($isAjax) {
            return view('cart', $viewData);
        }

        return view('cart', $viewData);
    }

    public function checkout($seg)
    {
        $data = $this->productsReturn();
        $cash = $this->apiGetfetch($this->api_url_store . $this->shop_id . '/shop_cash_details');
        // echo "<pre>", print_r($cash, true), "</pre>";die;

        // Use the segment parameter passed from the route, which is the shop URL name
        $shop_url_name = $seg;

        $product_details = [
            'products' => $data['products'],
            'variants' => $data['products_variants'],
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'paymentInfo' => $cash['paymentinfo'],
            'fees' => $cash['fees'],
            'shop_url_name' => $shop_url_name
        ];

        return view('orderDetails', $product_details);
    }

    public function getCustomerAddress($cust_id)
    {
        $url = $this->api_url . 'address/' . $cust_id;
        $data = $this->apiGetfetch($url);
        return $this->response->setJSON([
            'status' => 'success',
            // 'url' => $url,
            'address' => $data['data'] ?? []
        ]);
    }

    public function deleteAddress($id)
    {
        $url = $this->api_url . 'address/delete/' . $id;
        $data = $this->apiGetfetch($url);

        if (isset($data['status']) && $data['status'] === 'success') {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Address deleted successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $data['message'] ?? 'Failed to delete address'
            ])->setStatusCode(400);
        }
    }




    public function saveAddress()
    {

        $address = $this->request->getCookie('address');
        $getdata = json_decode($address, true);

        if (!$getdata) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON input'
            ])->setStatusCode(400);
        }
        $cust_id = $getdata['userId'];

        $data = [
            'cust_id' => $cust_id,
            'name' => $getdata['name'] ?? '',
            'phone_no' => $getdata['phone_no'] ?? '',
            'address' => $getdata['street_address'] ?? '',
            'city' => $getdata['city'] ?? '',
            'state' => $getdata['state'] ?? '',
            'pincode' => $getdata['pincode'] ?? '',
            'country' => $getdata['country'] ?? '',
            'val' => $getdata['defaultAddress'] ?? 0,
            'address_id' => $getdata['id'] ?? ''
        ];


        $raw = $this->postApifetch($this->api_url . 'address', $data);

        $response = service('response');
        $response->deleteCookie('address');
        if ($raw['status'] == 'success') {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $raw['message'] ?? 'Address saved successfully',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $raw['message'] ?? 'Failed to save address',
            ])->setStatusCode(400);
        }

    }

    public function getaddressEdit($id)
    {
        $url = $this->api_url . 'address_edit/' . $id;
        $raw = $this->apiGetfetch($url);

        if (isset($raw['address']) && !empty($raw['address'])) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Address found',
                'data' => $raw['address']
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Address not found',
                'raw' => $raw
            ]);

        }
    }
    public function orderplaced($shop_id, $userId)
    {
        // die();
        helper(['form', 'url']);

        $postData = [];

        // Get POST data
        $address_id = $this->request->getPost('address_data');

        $postData['shop_id'] = $this->shop_id;
        $postData['order_data'] = $this->request->getPost('order_data');
        $postData['address_id'] = $address_id;
        $postData['total_amount'] = $this->request->getPost('total_amount');

        $postData['payment_method'] = $this->request->getPost('payment_method');
        $postData['transaction_id'] = $this->request->getPost('transaction_id');

        $postData['platformfeeAmount'] = $this->request->getPost('platformfeeAmount');
        $postData['gstfeeAmount'] = $this->request->getPost('gstfeeAmount');
        $postData['discountAmount'] = $this->request->getPost('discountAmount');
        $postData['deliveryFeeAmount'] = $this->request->getPost('deliveryFeeAmount');
        $postData['deliverySlot'] = $this->request->getPost('delivery_slot');

        // echo "<pre>", print_r($postData, true), "</pre>"; die;


        // Prepare cURL request
        $url = $this->api_url_store . $this->shop_id . '/order/' . $userId;

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


        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return $this->response->setJSON(['status' => 'error', 'message' => $error]);
        }

        curl_close($curl);

        $result = json_decode($response, true);

        // echo "<pre>", print_r($result, true), "</pre>"; die;

        if (isset($result['status']) && $result['status'] === 'success') {



            $data = $this->productsReturn();

            $product_details = [
                'products' => $data['products'],
                'allproducts' => $data['products'],
                'variants' => $data['products_variants'],
                'categories' => $data['categories'],
                'subcategories' => $data['subcategories'],
                'orderData' => $result['order_details'],
                'addressData' => $result['order_date'],
            ];
            // Redirect to success page

            return view('success', $product_details);
        }
    }





    public function offersFilter($value)
    {
        $url = $this->api_url_shop . $this->shop_id . '/offerslist';
        $data = $this->apiGetfetch($url);

        foreach ($data['offers'] as $offer) {
            if ($offer['code'] == $value) {
                if ($offer['type'] == '1') {
                    $offersurl = 'offersFilter/' . $offer['offer_value'];
                } elseif ($offer['type'] == '2') {
                    $offersurl = 'offers/2/' . $offer['offer_value'];
                } elseif ($offer['type'] == '3') {
                    // $offersurl = 'offers/3' . $offer['offer_value'];
                    return redirect()->back()->with('error', 'This offer is not available');

                } else {
                    return redirect()->back()->with('error', 'This offer is not available');

                }
            }
        }
        $url2 = $this->api_url_store . $this->shop_id . '/' . $offersurl;

        $raw = $this->apiGetfetch($url2);


        $funcdata = $this->productsReturn();


        $product_details = [
            'product' => $raw['products'],
            'variant' => $raw['product_variants'],
            'allvariants' => $raw['product_variants'],
            'categories' => $funcdata['categories'],
            'allproducts' => $funcdata['products'],
            'subcategories' => $funcdata['subcategories'],
            'isProductShow' => true

        ];

        // echo "<pre>", print_r($product_details, true), "</pre>";

        return view('productsFilter', $product_details);
    }


    public function categoryFilter($category_id)
    {
        $url = $this->api_url_store . $this->shop_id . '/categoryFilter/' . $category_id;
        $data = $this->apiGetfetch($url);

        if ($data['status'] == 'error') {
            return redirect()->back()->with('error', $data['message']);
        }

        $funcdata = $this->productsReturn();
        
        // Use the segment parameter passed from the route, which is the shop URL name
        // $shop_url_name = $seg;

        $product_details = [
            'product' => $data['products'],
            'variant' => $data['products_variants'],
            'categories' => $funcdata['categories'],
            'subcategories' => $funcdata['subcategories'],
            'allvariants' => $funcdata['products_variants'],
            'allproducts' => $funcdata['products'],
            'category_id' => $category_id,
            // 'shop_url_name' => $shop_url_name,
            'isProductShow' => true
        ];
        return view('productshow', $product_details);
    }








































































    public function lo()
    {
        return view('templates/lo');
    }























}