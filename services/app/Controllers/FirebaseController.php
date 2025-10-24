<?php

namespace App\Controllers;
use App\Models\ApiModel;
use App\Libraries\FirebaseNotification;
use PhpOffice\PhpSpreadsheet\IOFactory;

class FirebaseController extends BaseController
{

    private function random_num($length = 8)
    {
        return substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
    }
    private $loginfields = ['username', 'password', 'role', 'status'];

    private $subcategoriesFieldt = ['category_id', 'main_category', 'sub_category_name', 'sub_category_subtitle', 'sub_category_image', 'status'];
    private $districtField = ['state_id', 'district_name', 'status'];

    private $productsFieldt = ['id', 'shop_id', 'prod_name', 'qty_type', 'tax_id', 'fssai_no', 'category_id', 'subcategory_id', 'prod_type', 'manufacturer', 'made_in', 'return_status', 'cancelable_status', 'cod_allowed', 'total_quantity', 'main_image', 'other_images', 'size_chart', 'description', 'shipping_policy', 'color', 'status', 'date_added'];
    private $products_varFieldt = ['id', 'prod_id', 'measure', 'price', 'disc_type', 'disc_price', 'stock', 'status', 'sku_code', 'hsn_code', 'variant_image'];
    private $categoriesField = ['category_name', 'category_subtitle', 'category_image', 'position', 'status'];

    private $customerRegFields = ['user_id', 'mobile_no', 'otp', 'is_verified', 'status', 'created_at', 'updated_at'];
    private $fee_fields = ['id', 'shop_id', 'name', 'code', 'percentage', 'amount', 'status', 'op_select'];


    private $paymentFields = ['shop_id', 'pay_phoneno', 'upi_id', 'pay_qrcode', 'status', 'enable_status'];




    private $addressfields = ['cust_id', 'name', 'street_address', 'phone_no', 'city', 'state', 'pincode', 'country', 'pr_address', 'address_id', 'status'];
    private $value_Field = ['id', 'value1', 'value2', 'value3'];
    public $offers_fields = ['shop_id', 'name', 'label', 'image', 'org_price', 'disc_price', 'offer_notes', 'offer_value', 'type', 'code', 'endoffer', 'enable_status', 'status'];

    // Table  
    public $categoriestb, $fees, $subcategoriestab, $selectCategory, $selectsubCategory, $offers, $shopBanner, $custAddress;


    public $uploadPath, $shopOrders, $ordersDetials,$adminmodel,$model;

    private $db,$base,$imgpath;
    protected $api_url;
    protected $api_key;
    protected $site_url;
    protected $shop_url;
    protected $authorized;
    private $sup_admin;  //  Super Admin 
    public  $adminModel;


    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $config = config('App');
        $this->api_key = $config->api_key;
        $this->shop_url = $config->shop_URL;
        // $this->shop_id = $config->shop_id;
        $this->site_url = $config->admin_url;
        $this->base = $config->base;
        $this->imgpath = $config->base."uploads/images/";
        $this->adminModel = new ApiModel();
        $this->model = new ApiModel();


        $this->uploadPath = realpath(FCPATH . '../') . '/uploads/images/';

        $header = service('request')->getHeaderLine('X-Api');
        $this->authorized = (str_replace('Bearer ', '', $header) === $this->api_key);

        $this->authorize();
        $this->categoriestb = new ApiModel();
        $this->categoriestb->prodCategory();
        $this->selectCategory = new ApiModel();
        $this->selectsubCategory = new ApiModel();
        $this->subcategoriestab = new ApiModel();

    }

    public function authorize()
    {
        if (!$this->authorized) {
            echo "401 - Unauthorized access";
            die;
        }
    }

        public function postsList(){
        $model = $this->adminModel->posts();
        $posts = $model->orderBy('id', 'desc')->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'posts' => $posts
        ]);
    }


    public function web_posts()
    {
        $model = $this->adminModel->posts();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // ✅ Collect form data
            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');

            if (empty($title) || empty($content)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Title and content are required.'
                ]);
            }

            $data = [
                'title'   => $title,
                'content' => $content,
                'image' => $this->request->getPost('image') ,
                'url' => $this->request->getPost('url'),
            ];

            $model->insert($data);
            $da = "";
            // ✅ Call notification function AFTER successful insert
            try {
                $da = $this->sendNotification();
            } catch (\Exception $e) {
                // You can log this if needed
                log_message('error', 'Notification failed: ' . $e->getMessage());
            }

            // ✅ Return success JSON response
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Post added and notification sent successfully '
            ]);
        }

        // ✅ For non-POST requests
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Invalid request method'
        ]);
    }


    public function sendNotification()
    {
        $firebase = new FirebaseNotification();

        // ✅ Latest post
        $posts = $this->adminModel->posts();
        $raw = $posts->orderBy('id', 'desc')->first();

        // ✅ Customer tokens
        $model = $this->model->customers();
        $tokens = $model->select('token')->where('token !=', '')->findAll();

        $deviceTokens = [];

        foreach ($tokens as $row) {
            $decoded = json_decode($row['token'], true);
            if (is_array($decoded)) {
                $deviceTokens = array_merge($deviceTokens, $decoded);
            } elseif (is_string($row['token'])) {
                $deviceTokens[] = $row['token'];
            }
        }

        $deviceTokens = array_filter(array_unique($deviceTokens));

        if (count($deviceTokens) === 0) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "No valid device tokens found"
            ]);
        }

        // ✅ Notification details
         $title = $raw['title'] ?? "New Post";
        $body  = $raw['content'] ?? "You have a new message.";
        $data  = [
            "image_url" => !empty($raw['image']) ? $this->imgpath . "posts/" . $raw['image'] : null,
            'image_is'  => !empty($raw['image']) ? "yes" : "no",
            "url"       => $raw['url'] ?? $this->base,
        ];

        // ✅ Send individually and handle invalid tokens
        $responses = [];
        $invalidTokens = [];

        foreach ($deviceTokens as $token) {
            $response = $firebase->sendNotiDevice($token, $title, $body, $data);

            // ✅ Convert response to string safely for error check
            $responseText = is_array($response) ? json_encode($response) : (string)$response;

            if (strpos($responseText, '404') !== false || strpos($responseText, 'NOT_FOUND') !== false) {
                $invalidTokens[] = $token;
            }

            $responses[] = ["token" => $token, "response" => $response];
        }

        // ✅ Remove invalid tokens (optional)
        if (!empty($invalidTokens)) {
            foreach ($invalidTokens as $badToken) {
                $model->where('token', $badToken)->delete();
            }
        }

        return $this->response->setJSON([
            "status" => "success",
            "sent_to" => count($deviceTokens),
            "invalid_tokens_removed" => count($invalidTokens),
            "responses" => $responses,
            'invalid' => $invalidTokens,
            'invalidTokens' => $this->invalidToken($invalidTokens)
        ]);
    }

    public function sendPost($id)
    {
        $firebase = new FirebaseNotification();
        $model = $this->model->customers();
        $tokens = $model->select('token')->where('token !=', '')->findAll();
        $deviceTokens = [];

        foreach ($tokens as $row) {
            $decoded = json_decode($row['token'], true);
            if (is_array($decoded)) {
                $deviceTokens = array_merge($deviceTokens, $decoded);
            } elseif (is_string($row['token'])) {
                $deviceTokens[] = $row['token'];
            }
        }

        $deviceTokens = array_filter(array_unique($deviceTokens));
        
        if (count($deviceTokens) === 0) {
            return $this->response->setJSON([
                "status" => "error",
                "message" => "No valid device tokens found"
            ]);
        }

        $model = $this->adminModel->posts();
        $raw = $model->find($id);
        $title = $raw['title'] ?? "New Post";
        $body  = $raw['content'] ?? "You have a new message.";
        $data  = [
            "image_url" => !empty($raw['image']) ? $this->imgpath . "posts/" . $raw['image'] : null,
            'image_is'  => !empty($raw['image']) ? "yes" : "no",
            "url"       => $raw['url'] ?? $this->base,
        ];

        $invalidTokens = [];
        $responses = []; // ✅ Initialize before loop

        foreach ($deviceTokens as $token) {
            $response = $firebase->sendNotiDevice($token, $title, $body, $data);

            // ✅ Convert response to string safely for error check
            $responseText = is_array($response) ? json_encode($response) : (string)$response;

            if (strpos($responseText, '404') !== false || strpos($responseText, 'NOT_FOUND') !== false) {
                $invalidTokens[] = $token;
            }

            $responses[] = ["token" => $token, "response" => $response];
        }


        return $this->response->setJSON([
            "status" => true,
            // 'deviceTokens' => $deviceTokens,
            // 'data' => $data,
            'responses' => $responses,
            'invalid' => $invalidTokens,
            'invalidTokens' => $this->invalidToken($invalidTokens)

        ]);


    }


    private function invalidToken(array $invalidTokens)
    {
        $model = $this->model->customers();
        // Get all users with tokens
        $users = $model->select('id, token')->where('token !=', '')->findAll();
        foreach ($users as $user) {
            $decoded = json_decode($user['token'], true) ?? [];
            if (is_array($decoded)) {
                // Remove all invalid tokens from this user's list
                $filtered = array_values(array_filter($decoded, function($t) use ($invalidTokens) {
                    return !in_array($t, $invalidTokens);
                }));
                // If modified, update in database
                if ($filtered !== $decoded) {
                    $model->update($user['id'], ['token' => json_encode($filtered)]);
                }
            }
        }

        return true;
    }





































































}