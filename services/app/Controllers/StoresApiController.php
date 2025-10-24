<?php

namespace App\Controllers;
use App\Models\ApiModel;
use Config\Database;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Controllers\ShopAdminController;
use PhpOffice\PhpSpreadsheet\Worksheet\AutoFilter\Column;

class StoresApiController extends BaseController
{

    private function random_num($length = 8)
    {
        return substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
    }

    private $districtField = ['state_id', 'district_name', 'status'];
    private $customerRegFields = ['user_id', 'mobile_no', 'otp', 'is_verified','token', 'status', 'created_at', 'updated_at'];
    private $addressfields = ['cust_id', 'name', 'street_address', 'phone_no', 'city', 'state', 'pincode', 'country', 'pr_address', 'address_id', 'status'];

    private $productsFieldt = ['id', 'shop_id', 'prod_name', 'qty_type', 'tax_id', 'fssai_no', 'category_id', 'subcategory_id', 'prod_type', 'manufacturer', 'made_in', 'return_status', 'cancelable_status', 'cod_allowed', 'total_quantity', 'main_image', 'other_images', 'size_chart', 'description', 'shipping_policy', 'status', 'date_added'];
    private $products_varFieldt = ['id', 'prod_id', 'measure', 'price', 'disc_type', 'disc_price', 'stock', 'status', 'sku_code', 'hsn_code', 'variant_image'];
  
    public $uploadPath, $uri, $db;
    protected $api_url;
    protected $api_key = 'SEC195C79FC4CCB09B48AA8';
    protected $site_url;
    protected $shop_url;
    protected $authorized;

    private $shops, $banners, $cityModel, $categories, $orders, $offers, $ShopAdmin, $shopBanner, $product_var, $products, $feeManage;
    public $payment, $address, $shopOrders, $ordersDetials,$adminModel,$model;

    public function __construct()
    {
        $config = config('App');
        $this->api_url = $config->admin_url;
        $this->shop_url = $config->shop_URL;
        $this->categoriestb = new ApiModel();
        $this->subcategoriestb = new ApiModel();
        $this->uploadPath = realpath(FCPATH . '../') . '/uploads/images/';

        $header = service('request')->getHeaderLine('X-Api');
        $this->authorized = (str_replace('Bearer ', '', $header) === $this->api_key);
        $this->authorize();
        $this->adminModel = new ApiModel();
        $this->model = new ApiModel();

        $this->uri = service('uri');
        $this->shops = new ApiModel();
        $this->shops->shop();
        $this->banners = new ApiModel();
        $this->banners->banner();
        $this->cityModel = new ApiModel();
        $this->cityModel->city();
        $this->categories = new ApiModel();
        $this->categories->categories();
        $this->orders = new ApiModel();
        $this->orders->orders();
        $this->shopBanner = new ApiModel();
        $this->shopBanner->shopBanner();

        $this->ShopAdmin = new ShopAdminController();
        $this->offers = new ApiModel();
        $this->offers->tables('offers', 'id', $this->ShopAdmin->offers_fields);
        $this->products = new ApiModel();
        $this->products->tables('products', 'id', $this->productsFieldt);
        $this->product_var = new ApiModel();
        $this->product_var->tables('product_variants', 'id', $this->products_varFieldt);
        $this->feeManage = new ApiModel();
        $this->feeManage->feeManage();
        $this->payment = new ApiModel();
        $this->payment->payment();

        $this->address = new ApiModel();
        $this->address->tables('cust_address', 'address_id', $this->addressfields);

        $this->shopOrders = new ApiModel();
        $this->shopOrders->shopOrders();
        $this->ordersDetials = new ApiModel();
        $this->ordersDetials->ordersDetials();
    }

    public function authorize()
    {
        if (!$this->authorized) {
            echo "401 - Unauthorized access";
            die;
        }
    }
    public function allvariants()
    {
        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $this->categories->where('status', '1')->orderBy('id', 'ASC')->findAll(),
            'banners' => $this->banners->where('status', '1')->where('enable_status', '1')->orderBy('id', 'DESC')->findAll(),
        ]);

    }

    public function shop_list()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $shops = new ApiModel();
        $shops->shop();

        $data = $shops
            ->where('status', '1')
            ->orderBy('id', 'DESC')->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'shops' => $data,
        ]);

    }
    public function findShop($url_name)
    {
        $shop = $this->shops->where('url_name', $url_name)->first();

        if (!$shop) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Shop not found',
                'type' => 'SNF'
            ]);
        }

        if ($shop['status'] != '1') {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Shop Temporarily Unavailable',
                'type' => 'STU'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'shop' => $shop,
        ]);
    }



    public function all($shop_id)
    {
        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $products = $products->where('shop_id', $shop_id)
            ->where('status', 1)->orderby('id', 'DESC')->findAll();

        foreach ($products as $key => $product) {
            $variants[$key] = $product_var->where('prod_id', $product['id'])->findAll();
        }
        $raw = $this->filterCategory_Sub($shop_id);

        $banner = $this->shopBanner->where('shop_id', $shop_id)->where('status', 1)->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'banner' => $banner,
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
            'products' => $products,
            'products_variants' => $variants ?? 0,
        ]);
    }


    public function filterCategory_Sub($shop_id)
    {
        $db = \Config\Database::connect();

        // Fetch active categories selected for the shop
        $category_sel = $db->table('ecom_select_category sc');
        $category_sel->select('
        sc.id AS select_id,
        sc.shop_id,
        sc.category_id,
        c.category_name,
        c.category_subtitle,
        c.category_image,
        c.position,
        c.status AS category_status,
        sc.status AS selected_status
    ');
        $category_sel->join('ecom_categories c', 'sc.category_id = c.category_id');
        $category_sel->where('sc.shop_id', $shop_id);
        $category_sel->where('sc.status', 1);
        $category_sel->where('c.status', 1);
        $category_sel->orderBy('c.position', 'ASC');
        $categories = $category_sel->get()->getResultArray();

        // Fetch active subcategories selected for this shop, category, and subcategory
        $subcategory_sel = $db->table('ecom_subcategories sub');
        $subcategory_sel->select('
        sub.id AS subcategory_id,
        sub.category_id,
        sub.main_category,
        sub.sub_category_name,
        sub.sub_category_subtitle,
        sub.sub_category_image,
        sub.status AS subcategory_status
    ');
        // Proper join to selection table
        $subcategory_sel->join(
            'ecom_select_subcategory ess',
            'sub.id = ess.subcategory_id AND ess.shop_id = ' . $db->escape($shop_id)
        );
        $subcategory_sel->join('ecom_categories cat', 'sub.category_id = cat.category_id');
        $subcategory_sel->where('sub.status', 1);
        $subcategory_sel->where('cat.status', 1);
        $subcategory_sel->where('ess.status', 1);
        $subcategory_sel->where('ess.shop_id', $shop_id);
        $subcategories = $subcategory_sel->get()->getResultArray();

        return [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ];
    }



    public function registrationProcess()
    {


        $customer = new ApiModel();
        $customer->tables('customers', 'id', $this->customerRegFields);

        $mobile = $this->request->getPost('mobile');
        $user = $customer->where('mobile_no', $mobile)->first();

        // if(!empty($user)){
        //     return $this->response->setJSON([
        //         'status' => 'error',
        //         'message' => 'Mobile Number Already Exist',
        //     ]);
        // }

        // Generate unique customer ID
        $user_id = null;
        for ($i = 0; $i < 10; $i++) {
            $tempId = $this->random_num(6);
            if (!$customer->where('user_id', $tempId)->first()) {
                $user_id = $tempId;
                break;
            }
        }

        // $otp = $this->sendSMS($mobile);
        $otp = 6665;

        $data = [
            'user_id' => $user_id,
            'mobile_no' => $mobile,
            'otp' => $otp,

        ];
        if (empty($user)) {
            $customer->insert($data);
            $message = 'Customer New join request';
        } else {
            $customer->update($user['id'], ['otp' => $otp]);
            $message = 'Customer login request';

        }


        return $this->response->setJSON([
            'status' => 'success',
            'message' => $message,
            'user_id' => $user_id,
            'otp' => $otp,
        ]);

    }

    public function regVerify()
    {

        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $customer = new ApiModel();
        $customer->tables('customers', 'id', $this->customerRegFields);

        $mobile = $this->request->getPost('mobile');
        $otp = $this->request->getPost('otp');
        $devicetoken = $this->request->getPost('devicetoken');

        $user = $customer->where('mobile_no', $mobile)->first();
        
        if (!empty($user)) {
            if ($user['otp'] == $otp) {

              $previous_token = json_decode($user['token'], true) ?? []; // decode as array

                if (!in_array($devicetoken, $previous_token)) {
                    $previous_token[] = $devicetoken; // add new token

                    // If more than 3 tokens exist, remove the oldest one
                    if (count($previous_token) > 2) {
                        array_shift($previous_token); // removes the first element
                    }
                }

                $customer->update($user['id'], ['is_verified' => 1,'token' => json_encode($previous_token)]);

           
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Customer verified successfully',
                    'device_token' => $devicetoken,
                    'user_id' => $user['user_id'],
                    'user_details' => $user,

                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid OTP',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Customer not found',
            ]);
        }

    }



    public function sendSMS($mob_no)
    {
        $otp = $this->random_num(4);
        $baseUrl = "http://139.99.131.165/api/v2/SendSMS";

        // Static message content
        $message = "Dear Member registration_otp-$otp Recovered Month of APR-25 Rs.24659. "
            . "Thrift:1500 Installment:21/45, Principal:19000, Interest: 0 "
            . "Insurance:0 Others:0 THURAIYUR TNEBECS www.brightecs.com/ym76/sms/m2504.php?recno=25002 BRIGHT TECH";

        // $message = "Dear customer, use this OTP $otp to log in to your Gramasandhai account. This OTP will be valid for the next 5 mins - BRITUK";
        

        // Build URL with parameters (no need to manually urlencode message, http_build_query handles it)
        $fullUrl = $baseUrl . '?' . http_build_query([
            'SenderId' => 'BRITUK',
            'Is_Unicode' => 'false',
            'Is_Flash' => 'false',
            'Message' => $message,
            'MobileNumbers' => $mob_no,
            'ApiKey' => 'e48fce64-3370-462f-b330-da7831888d94',
            'ClientId' => 'b9808c6d-14c5-49f9-8c37-2b417c44911e'
        ]);

        // Send SMS using file_get_contents
        $response = @file_get_contents($fullUrl);

        if ($response === false) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'SMS API request failed',
            ]);
        }

        return $otp;

        // return $this->response->setJSON([
        //     'status' => 'success',
        //     // 'otp'     => $otp
        // ]);

    }


    public function offers($shop_id)
    {

        $offers = $this->offers->where('shop_id', $shop_id)
            ->where('status', 1)
            ->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Offers',
            'offers' => $offers
        ]);
    }


    public function productsfilter($shop_id, $category_id = null, $subcategory_id = null)
    {
        $product_var = [];
        $builder = $this->products->where('shop_id', $shop_id);

        if (!empty($category_id)) {
            $builder->where('category_id', $category_id);
        }

        if (!empty($subcategory_id)) {
            $builder->where('subcategory_id', $subcategory_id);
        }
        $builder->where('status', 1);
        $products = $builder->findAll();
        if(!empty($products)){
            $product_var = $this->product_var->whereIn('prod_id', array_column($products, 'id'))->where('status', 1)->findAll();

        }



        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Products',
            'products' => $products,
            'products_variants' => $product_var,
            'category' => $category_id,
            'subcategory' => $subcategory_id,
        ]);
    }

    public function offerProducts($shop_id){
        $product_var = $this->product_var->where('disc_price >',  0)->where('status', 1)->findAll();
        $filteredProdIds = array_column($product_var, 'prod_id');
        $filteredProdIds = array_unique($filteredProdIds);
        $products = $this->products->where('shop_id', $shop_id)->whereIn('id', $filteredProdIds)->where('status', 1)->findAll();


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Products',
            'products' => $products,
            'products_variants' => $product_var,
            // 'filteredProdIds' => $filteredProdIds,
        ]);

    }

    public function shop_cashDetails($shop_id)
    {
        $fees = $this->feeManage->where('shop_id', $shop_id)->findAll();
        $payment = $this->payment->where('shop_id', $shop_id)->where('status', 1)->where('enable_status', 1)->first();
        return $this->response->setJSON([
            'status' => 'success',
            'fees' => $fees,
            'paymentinfo' => $payment
        ]);
    }


    public function getCustomerAddress($cust_id)
    {
        $address = $this->address;

        $row = $address->where('cust_id', $cust_id)->where('status', '1')->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'data' => $row,
        ]);

    }






    public function saveAddressApi()
    {

        if ($this->request->getMethod() == 'post') {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(400);
        }

        // $getdata = json_decode($this->request->getBody(), true);
        $getdata = $this->request->getPost();

        $cust_id = $this->request->getPost('cust_id');
        if (empty($cust_id)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Customer ID missing.'
            ])->setStatusCode(400);
        }

        $address = new ApiModel();
        $address->tables('cust_address', 'address_id', $this->addressfields);

        $data = [
            'cust_id' => $cust_id,
            'name' => $this->request->getPost('name'),
            'phone_no' => $this->request->getPost('phone_no'),
            'street_address' => $this->request->getPost('address'),
            'city' => $this->request->getPost('city'),
            'state' => $this->request->getPost('state'),
            'pincode' => (string) $this->request->getPost('pincode'),
            'country' => $this->request->getPost('country'),
            'pr_address' => $this->request->getPost('val'),
        ];


        $address_id = $this->request->getPost('address_id');

        if (!empty($address_id)) {
            // Update flow
            if (!$address->update($address_id, $data)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to update address',
                    'errors' => $address->errors()
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Address updated successfully',
            ]);
        } else {
            // Insert flow
            if (!$address->insert($data)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to save address',
                    'errors' => $address->errors()
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Address saved successfully',
            ]);
        }
    }


    public function editCustomerAddress($address_id)
    {
        $address = $this->address;

        $row = $address->where('address_id', $address_id)->where('status', '1')->first();
        return $this->response->setJSON([
            'status' => 'success',
            'address' => $row,
        ]);
    }


    public function orderProcess($shop_id, $userid)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $orders = $this->shopOrders;
        $order_details = $this->ordersDetials;

        $maxRetries = 10;

        // Generate unique order_id
        $orderid = null;
        for ($i = 0; $i < $maxRetries; $i++) {
            $tempId = $this->random_num(8);
            if (!$orders->where('order_id', $tempId)->first()) {
                $orderid = $tempId;
                break;
            }
        }

        if (!$orderid) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to generate unique order ID'
            ])->setStatusCode(500);
        }

        // Generate unique invoice_no
        $invoice_no = null;
        for ($i = 0; $i < $maxRetries; $i++) {
            $tempInvoice = 'INV-' . $this->random_num(6);
            if (!$orders->where('invoice_no', $tempInvoice)->first()) {
                $invoice_no = $tempInvoice;
                break;
            }
        }

        if (!$invoice_no) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to generate unique invoice number'
            ])->setStatusCode(500);
        }

        // Get POST data
        $postdata = $this->request->getPost();

        $order_prod = json_decode($postdata['order_data'] ?? '[]', true);
        $address_id = json_decode($postdata['address_id'] ?? '{}', true);
        $total_amount = json_decode($postdata['total_amount'] ?? '0', true);
        $pay_method = $postdata['payment_method'];
        $trans_id = $postdata['transaction_id'];
        $order = $address['data'] ?? null;
        $platformfee = $postdata['platformfeeAmount'] ?? 0;
        $gstfeeAmount = $postdata['gstfeeAmount'] ?? 0;
        $discountAmount = $postdata['discountAmount'] ?? 0;
        $deliveryFeeAmount = $postdata['deliveryFeeAmount'] ?? 0;
        $address = $this->address->where('address_id', $address_id)->first();
        $timeslot = $postdata['deliverySlot'] ?? "00:00-00:00";
        // Order data for main table
        $data = [
            'shop_id' => (int) $shop_id,
            'order_id' => $orderid,
            'user_id' => $userid,
            'amount' => $total_amount,
            'receiver_name' => $address['name'] ?? null,
            'shipping_address' => $address['street_address'] ?? null,
            'receiver_phone_no' => $address['phone_no'] ?? null,
            'state' => $address['state'] ?? null,
            'zip' => $address['pincode'] ?? null,
            'country' => $address['country'] ?? null,
            'payment_method' => strtoupper($pay_method),
            'payment_status' => strtoupper($pay_method) == 'COD' ? 'UPAID' : 'PAID',
            'transaction_id' => $trans_id,
            'city' => $address['city'] ?? null,
            'discount' => $discountAmount,
            'deliveryFee' => $deliveryFeeAmount,
            'gstfee' => $gstfeeAmount,
            'platformfee' => $platformfee,
            'ordered_date' => date('Y-m-d'),
            'delivery_datetime' => date('Y-m-d H:i:s'),
            'delivery_status' => 0,
            'order_status' => 1,
            'time_slot' => $timeslot,
            'address_id' => $address_id,
            'invoice_no' => $invoice_no,
            'invoice_date' => date('Y-m-d'),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        // return $this->response->setJSON([
        //     'data' => $data,
        // ]);




        
        // $this->orderPasser($data);

        // Insert order
        if (!$orders->insert($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to place order'
            ])->setStatusCode(500);
        }

        $ord_id = $orders->insertID();

        // Insert order details
        $results = [];

        foreach ($order_prod as $key => $val) {
            $tempPrice = $val['price'] ?? 1;
            $tempQty = $val['quantity'] ?? 1;
            $data2 = [
                'ord_tb_id' => $ord_id,
                'order_id' => $orderid,
                'prod_id' => $val['id'] ?? null,
                'prod_name' => (string) trim($val['name']) ?? null,
                'prod_price' => $tempPrice * $tempQty,
                'prod_qty' => $val['quantity'] ?? null,
                'weight' => $val['measure'] ?? null,
                'imagename' => $val['image_name'] ?? null,
            ];

            if (!$order_details->insert($data2)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Failed to insert order detail for product ID ' . ($val['id'] ?? 'unknown')
                ])->setStatusCode(500);
            }

            $results[] = $data2;
        }


        // Final success response
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Order placed successfully',
            'order_id' => $orderid,
            'invoice_no' => $invoice_no,
            'order_details' => $results,
            'order_date' => $data,
            'method' => $pay_method,
            'total' => $total_amount,
            'id' => $trans_id,
            'data' => $postdata
        ]);


    }

    public function randomProducts($shop_id)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);

        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $redirectUrl = $this->site_url . 'addsubcatRedirect';

        return $this->response->setJSON([
            'status' => 'success',
            'products' => $products->where('shop_id', $shop_id)->where('status', 1)->orderBy('RAND()')->limit(15)->find(), // <- Random 20
            'products_variants' => $product_var->findAll(),
            'redirect' => $redirectUrl,
        ]);
    }




    public function orderHistory($id)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $customer = new ApiModel();
        $customer->tables('customers', 'id', $this->customerRegFields);

        $ordersModel = $this->shopOrders;
        $orderDetailsModel = $this->ordersDetials;


        // Find customer
        $user = $customer->where('user_id', $id)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found',
            ]);
        }

        // Get orders for customer
        $orders = $ordersModel
            ->where('user_id', $id)->orderby('id', 'desc')->findAll();

        if (empty($orders)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No orders found',
                'user_id' => $user['user_id'],
            ]);
        }

        // Collect order details for each order
        $allOrderDetails = [];

        foreach ($orders as $key => $order) {
            $details = $orderDetailsModel->where('order_id', $order['order_id'])->findAll();
            $allOrderDetails[$order['order_id']] = $details;
            $prod_ids = array_column($details, 'prod_id'); 
            $prod_qtys = array_column($details, 'prod_qty'); 
            $weights = array_column($details, 'weight'); 

            $orders[$key]['repeat'] = json_encode($this->repeatorder($prod_ids, $prod_qtys, $weights));
            $orders[$key]['url_name'] = $this->shopfind($order['shop_id']);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Customer orders fetched successfully',
            'user_id' => $user['user_id'],
            'orders' => $orders,
            'order_details' => $allOrderDetails,
        ]);
    }



    public function repeatorder($prod_ids, $qty, $value)
    {
        $products = $this->adminModel->products();
        $product_var = $this->model->product_var();
        
        $data = []; // Initialize array to store multiple product repeats

        foreach ($prod_ids as $key=>  $prod_id) {

            $product = $products->where('id', $prod_id)->where('status', 1)->first();
            $details = $product_var->where('prod_id', $prod_id)->where('status', 1)->findAll();
            $product['previous_value'] = $value[$key];
            $product['previous_qty'] = $qty[$key];
            
            $data[$key] = [
                'product' => $product,
                'variants' => $details,
    
            ];
        }

        return $data; // Return full list
    }

    public function shopfind($shop_id){
        $shop = $this->shops->where('shop_id',  $shop_id)->first();

        return $shop['url_name'] ?? 'unknown';
    }


    



    


    public function totalOrderHistory()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $customer = new ApiModel();
        $customer->tables('customers', 'id', $this->customerRegFields);

        $ordersModel = $this->shopOrders;
        $orderDetailsModel = $this->ordersDetials;


        // Get orders for customer
        $orders = $ordersModel->orderBy('id', 'asc')->findAll();

        if (empty($orders)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No orders found',
            ]);
        }

        // Collect order details for each order
        $allOrderDetails = [];

        foreach ($orders as $order) {
            $details = $orderDetailsModel->where('order_id', $order['order_id'])->findAll();
            $allOrderDetails[$order['order_id']] = $details;
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Customer orders fetched successfully',
            'orders' => $orders,
            'order_details' => $allOrderDetails,
        ]);
    }


    public function offersFilter($shop_id, $val)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);

        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $fetch = $product_var
            ->where('disc_price >=', $val)
            ->get()->getResultArray();

        if (!$fetch) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }

        foreach ($fetch as $key => $value) {
            $prouctsresults[$value['prod_id']] = $products->where('shop_id', $shop_id)
                ->where('id', $value['prod_id'])->get()->getRowArray();
        }


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Filter completed successfully',
            'product_variants' => $fetch,
            'products' => $prouctsresults,
            'shop_id' => $shop_id
        ]);

    }


    public function catesub($shop_id)
    {
        $raw = $this->filterCategory_Sub($shop_id);

        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
            'shop_id' => $shop_id

        ]);
    }


    public function categoryFilter($shop_id, $category_id)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);

        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);


        $prod = $products->where('shop_id', $shop_id)
            ->where('category_id', $category_id)
            ->orderBy('id', 'DESC')
            ->findAll();

        foreach ($prod as $p) {
            $variants = $product_var->where('prod_id', $p['id'])->findAll();
            // process each product with its variants
        }


        if (empty($prod)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No products found',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'success',
            // 'categories' => $categories,
            'products' => $prod,
            'products_variants' => $variants,
        ]);

    }












    public function offers2($val, $seg)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);

        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $alloffers = [];
        $varinats = [];

        if ($val == 1 || $val == 2) {
            $num = ($val == 1) ? 0 : 1;
            $varinats = $product_var->where('disc_type', $num)->where('disc_price >', (int) $seg)->get()->getResultArray();
        } elseif ($val == 3) {
            $varinats = $product_var->where('disc_price >', 1)->findAll();
        }

        if (empty($varinats)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No data found'
            ]);
        }

        $productsresults = [];
        foreach ($varinats as $value) {
            $prod = $products->where('id', $value['prod_id'])->get()->getRowArray();
            if ($prod) {
                $productsresults[$value['prod_id']] = $prod;
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Filter completed successfully',
            'products' => $productsresults,
            'product_variants' => $varinats,

        ]);
    }








    // $db = \Config\Database::connect();

    // // Fetch active categories selected for the shop
    // $category_sel = $db->table('ecom_select_category sc');
    // $category_sel->select('
    //         sc.id AS select_id,
    //         sc.shop_id,
    //         sc.category_id,
    //         c.category_name,
    //         c.category_subtitle,
    //         c.category_image,
    //         c.position,
    //         c.status AS category_status,
    //         sc.status AS selected_status
    //     ');
    // $category_sel->join('ecom_categories c', 'sc.category_id = c.category_id');
    // $category_sel->where('sc.shop_id', $shop_id);
    // $category_sel->where('sc.status', 1);
    // $category_sel->where('c.status', 1);
    // $category_sel->orderBy('c.position', 'ASC');
    // $categories = $category_sel->get()->getResultArray();




































}