<?php

namespace App\Controllers;
use Config\App;
use Mpdf\Mpdf;

use App\Controllers\Authenticated;

use App\Controllers\Reports;


class AdminController extends Authenticated
{
    public $config, $sapi_url, $sapi_key;
    protected $api_url;
    protected $baseURL;
    public $uploadPath;

    protected $image_url;
    protected $api_key;
    protected $role;
    protected $targetRole = '4';

    public function __construct()
    {
        parent::__construct();
        $this->config = config('AccessProperties');
        $this->api_url = $this->config->api_url;
        $this->uploads_url = $this->config->uploads;
        $this->api_key = $this->config->key;

        $this->uploadPath = realpath(FCPATH . '../') . '/uploads/images/';

        $this->sapi_url = $this->config->sapi['url'];
        $this->sapi_key = $this->config->sapi['key'];

        $this->role = session()->get('role');
        $this->lasturl();

    }

    public function lasturl()
    {
        $isLoggedIn = $this->session->get('loggedIn');
        if (!$isLoggedIn) {
            $current_url = $_SERVER['REQUEST_URI'];
            setcookie("last_url", $current_url, time() + (86400 * 7), "/");  // 86400 = 1 day
        }

    }

    public function login()
    {
        $isLoggedIn = $this->session->get('loggedIn');
        if ($isLoggedIn) {
            return redirect()->to('dashboard');
        }



        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $data = $this->request->getJSON(true);

                if (!$data) {
                    throw new \Exception('Invalid JSON data');
                }

                $username = $data['username'] ?? '';
                $password = $data['password'] ?? '';

                if (empty($username) || empty($password)) {
                    throw new \Exception('Username and password are required');
                }

                $postData = [
                    'username' => $username,
                    'password' => $password
                ];



                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => $this->api_url . 'login',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $postData,
                    CURLOPT_HTTPHEADER => [
                        'X-Api: Bearer ' . $this->api_key
                    ]
                ]);

                $response = curl_exec($curl);

                if ($response === false) {
                    throw new \Exception('cURL error: ' . curl_error($curl));
                }

                $apiResponse = json_decode($response, true);
                curl_close($curl);

                if (!$apiResponse || !isset($apiResponse['status'])) {
                    throw new \Exception('Invalid API response');
                }

                if ($apiResponse['status'] === 'success' && isset($apiResponse['data'])) {
                    $user = $apiResponse['data'];


                    if (isset($user['role']) && $user['role'] == '4') {
                        // Store session
                        session()->set([
                            'loggedIn' => true,
                            'user_id' => $user['id'],
                            'role' => $user['role']
                        ]);
                        $redirect_url = base_url() . 'dashboard';
                        if (isset($_COOKIE["last_url"])) {
                            $redirect_url = $_COOKIE["last_url"];
                        }
                        return $this->response->setJSON([
                            'status' => 'success',
                            'message' => 'Login successful',
                            'redirect' => $redirect_url
                        ])->setStatusCode(200);
                    }

                    // User exists, but not authorized
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'You are not authorized to access this page'
                    ])->setStatusCode(403);
                }

                // Invalid credentials or API error
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Invalid username or password'
                ])->setStatusCode(401);


            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'redirect' => base_url('/')
                ])->setStatusCode(500);
            }

        }
        return view('login');
    }

    public function dashboard()
    {
        if ($this->role != $this->targetRole) {
            return redirect()->to('/');
        }
        return view('dashboard');
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }

    public function addLocation()
    {
        $raw = $this->apiGetfetch($this->api_url . 'locations');

        $data = [
            'states' => $raw['states'],
            'districts' => $raw['districts'],
            'citylist' => $raw['citylist'],
        ];
        // echo "<pre>", print_r($data, true), "</pre>";

        return view('path/location_add', $data);
    }

    public function apiGetfet($url, $key)
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
                'X-Api: Bearer ' . $key,
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);
        return $data;
    }

    public function apiPostFetch($postData, $url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'X-Api: Bearer ' . $this->api_key
            ]
        ]);

        $response = curl_exec($curl);

        if ($response === false) {
            throw new \Exception('cURL error: ' . curl_error($curl));
        }

        $apiResponse = json_decode($response, true);
        return $apiResponse;
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

    public function location_add($seg)
    {


        $postData = $this->request->getJSON(true);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->api_url . 'add_location/' . $seg,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
            CURLOPT_HTTPHEADER => [
                'X-Api: Bearer ' . $this->api_key
            ]
        ]);

        $response = curl_exec($curl);

        $data = json_decode($response, true);
        $mess = $data['message'];


        return $this->response->setJSON([
            'status' => $data['status'],
            'message' => $mess,
            'data' => $data,
            // 'postData' => $postData

        ])->setStatusCode(200);

    }

    private function handleImageUpload($fieldName, $default = null)
    {
        $file = $this->request->getFile($fieldName);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $ext = $file->getExtension(); // Get file extension
            $imageName = 'img' . bin2hex(random_bytes(10)) . '.' . $ext;
            $file->move($this->uploadPath, $imageName);
            return $imageName;
        }
        return $default;
    }

    private function handleImage($fieldName, $uploadPath)
    {
        $file = $this->request->getFile($fieldName);

        if ($file && $file->isValid() && !$file->hasMoved()) {

            // Create folder if it doesn't exist
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true); // recursive = true
            }

            $ext = $file->getExtension(); // Get file extension
            $imageName = 'img' . bin2hex(random_bytes(10)) . '.' . $ext;
            $file->move($uploadPath, $imageName);
            return $imageName;
        }

    
    }


    public function addshop()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $postData = $this->request->getPost();

            $qr_image = $this->handleImageUpload('qr_image');
            $shop_logo = $this->handleImageUpload('shop_logo');
            $shop_images = $this->request->getFileMultiple('shop_images');
            $old_shop_images = $this->request->getPost('old_shop_images');
            $uploadedFiles = [];
            if (!empty($shop_images)) {
                foreach ($shop_images as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $ext = $file->getExtension(); // Get file extension
                        $newName = 'img' . bin2hex(random_bytes(10)) . '.' . $ext;
                        $file->move($this->uploadPath, $newName);
                        $uploadedFiles[] = $newName;
                    }
                }
            }

            $fields = [
                'shop_id' => $this->request->getPost('shop_id') ?? null,
                'shop_name' => ucwords($postData['shop_name'] ?? ''),
                'owner_name' => $postData['owner_name'] ?? '',
                'email' => $postData['email'] ?? '',
                'urlname' => $this->request->getPost('urlname') ?? '',
                'phone' => $postData['shop_phone'] ?? '',
                'address' => $postData['shop_address'] ?? '',
                'shop_category' => $postData['shop_category'] ?? '',
                'state_id' => $postData['state_id'] ?? '',
                'district_id' => $postData['district_id'] ?? '',
                'city_id' => $postData['city_id'] ?? '',
                'pincode' => $postData['pincode'] ?? '',
                'shop_logo' => $shop_logo,
                'shop_images' => $uploadedFiles != null ? json_encode($uploadedFiles) : $old_shop_images,
                'qr_image' => $qr_image,
                'discount' => $postData['discount'] ?? '',
                'latitude' => trim($postData['latitude'] ?? ''),
                'longitude' => trim($postData['longitude'] ?? ''),
            ];


            $result = $this->apiPostFetch($fields, $this->api_url . 'add_shop');
            // echo "<pre>", print_r($result, true), "</pre>";
            // die;
            if ($result['status'] == 'success') {
                $redirect = $result['type'] == 'insert' ? previous_url() : 'shop/list';
                return redirect()->to($redirect)->with($result['status'], $result['message']);
            } else {
                return redirect()->back()->with('error', 'Something went wrong, please try again later');
            }

        }
        $raw = $this->apiGetfetch($this->api_url . 'locations');
        $cy = $this->apiGetfetch($this->api_url . 'categories');

        $data = [
            'states' => $raw['states'],
            'districts' => $raw['districts'],
            'citylist' => $raw['citylist'],
            'categories' => $cy['categories'],
        ];
        return view('path/add_shop', $data);

    }


    public function shop_list()
    {
        $raw = $this->apiGetfetch($this->api_url . 'shop_list');
        $data = [
            'shoplist' => $raw['shops'],
        ];
        // echo "<pre>", print_r($data, true), "</pre>";
        return view('path/shop_list', $data);


    }

    public function shopManagement()
    {
        $raw = $this->apiGetfetch($this->api_url . 'shop_list');
        $data = [
            'shoplist' => $raw['shops'],
        ];
        // echo "<pre>", print_r($data, true), "</pre>";
        return view('shop/shops', $data);

    }




    public function addBanner()
    {
        $raw = $this->apiGetfetch($this->api_url . 'shop_list');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $this->request->getPost();
            $banner_image = $this->handleImageUpload('banner_image');
            $fields = [
                'id' => $this->request->getPost('id') ?? '',
                'banner_image' => $banner_image ?? '',
                'banner_link' => $postData['banner_link'] ?? '',
                'labelname' => $postData['labelname'] ?? '',
                'shop_id' => $postData['shop_id'] ?? '',
            ];

            // echo "<pre>", print_r($fields, true), "</pre>";
            $result = $this->apiPostFetch($fields, $this->api_url . 'banner_add');
            echo "<pre>", print_r($result, true), "</pre>";

            // die;

            if ($result['status'] == 'success') {
                if ($result['method'] == 'update') {
                    return redirect()->to('banner/management')->with($result['status'], $result['message']);

                }
                return redirect()->to('banner/add')->with($result['status'], $result['message']);
            }
        }
        if ($raw['status'] == 'success') {
            $data = [
                'shoplist' => $raw['shops'],
            ];
            // echo "<pre>", print_r($data, true), "</pre>";
            return view('path/add_banner', $data);
        } else {
            print_r($raw);
        }

    }

    public function bannerManagement()
    {
        $raw = $this->apiGetfetch($this->api_url . 'banners/en');
        if ($raw['status'] == 'success') {
            $data = [
                'banners' => $raw['banners'],
            ];
            return view('path/banners', $data);
        }

        echo "<pre>", print_r($raw, true), "</pre>";
    }

    public function bannerEdit($id)
    {
        $raw = $this->apiGetfetch($this->api_url . 'banner/' . $id);
        $shop = $this->apiGetfetch($this->api_url . 'shop_list');

        if ($raw['status'] == 'success') {

            $data = [
                'shoplist' => $shop['shops'],
                'banners' => $raw['banner'],
            ];
            // echo "<pre>", print_r($data, true), "</pre>";die;
            return view('path/add_banner', $data);
        }

        echo "<pre>", print_r($raw, true), "</pre>";

    }

    public function enable($seg, $seg2, $id)
    {
        $url = $this->api_url . 'action/' . $seg . '/' . $seg2 . '/' . $id;
        if ($seg == 'showpayment') {
            $url = $this->api_url . $seg . '/' . $seg2 . '/' . $id;
        }
        $raw = $this->apiGetfetch($url);
        // echo "<pre>", print_r($raw, true), "</pre>"; 
// die;
        return redirect()->back()->with($raw['status'], $raw['message']);

    }

    public function hider($seg, $id)
    {
        $raw = $this->apiGetfetch($this->api_url . $seg . '/hide/' . $id);
        // echo "<pre>", print_r($raw, true), "</pre>";
        return redirect()->back()->with($raw['status'], $raw['message']);

    }


    public function shopEdit($id)
    {
        $url = $this->api_url . 'shop/edit/' . $id;
        $raw = $this->apiGetfetch($url);


        $pl = $this->apiGetfetch($this->api_url . 'locations');
        $cy = $this->apiGetfetch($this->api_url . 'categories');


        if ($raw['status'] == 'success') {
            $data = [
                'shop' => $raw['shop'],
                'otherShops' => $raw['otherShops'],
                'states' => $pl['states'],
                'districts' => $pl['districts'],
                'citylist' => $pl['citylist'],
                'categories' => $cy['categories'],
            ];
            // echo "<pre>", print_r($data, true), "</pre>";
            return view('path/add_shop', $data);
        }


    }


    public function ordersList()
    {
        $dateFilter = $this->request->getGet('dateFilter') ?? '';
        $shopId = $this->request->getGet('shopId') ?? '';
        $report = $this->request->getGet('report') ?? '';
        $startdate = $this->request->getGet('startdate') ?? '';
        $enddate = $this->request->getGet('enddate') ?? '';

        // $raw = $this->apiGetfet($this->sapi_url . 'order-list', $this->sapi_key);
        // if (!empty($dateFilter) || !empty($shopId)) {
        //     $raw = $this->apiGetfet($this->sapi_url . 'order-list?dateFilter=' . $dateFilter . '&shopId=' . $shopId, $this->sapi_key);
        // }
        $apiUrl = $this->api_url . 'order-list';

        if (!empty($dateFilter) || !empty($shopId) || !empty($startdate) || !empty($enddate)) {
            $params = [];
            if (!empty($dateFilter)) {
                $params[] = 'dateFilter=' . urlencode($dateFilter);
            }
            if (!empty($shopId)) {
                $params[] = 'shopId=' . urlencode($shopId);
            }
            if (!empty($startdate)) {
                $params[] = 'startdate=' . urlencode($startdate);
            }
            if (!empty($enddate)) {
                $params[] = 'enddate=' . urlencode($enddate);
            }
            $apiUrl .= '?' . implode('&', $params);
        }

        $raw = $this->apiGetfetch($apiUrl);

        if (isset($raw['status']) && $raw['status'] == 'success') {
     

            $data = [
                'orders' => $raw['orders'],
                'shops' => $raw['shops'],
                'selectedDateFilter' => $raw['selectedDateFilter'],
                'selectedShopId' => $raw['selectedShopId'],
            ];

            foreach ($raw['shops'] as $shop) {
                if ($shop['id'] == $shopId) {
                    $data['shop_name'] = $shop['shop_name'];
                }
            }
          

            return view('path/orders', $data);
        }
        $data = [
            'shops' => $raw['shops'],
            'selectedDateFilter' => $raw['selectedDateFilter'],
            'selectedShopId' => $raw['selectedShopId'],
        ];

        return view('path/orders', $data);

    }






    public function ordersReports()
    {
        $postdata = $this->request->getPost();
        $dateFilter = $this->request->getPost('dateFilter') ?? '';
        $shopId = $this->request->getPost('shopId') ?? '';
        $startdate = $this->request->getPost('startdate') ?? '';
        $enddate = $this->request->getPost('enddate') ?? '';

        $amt = [
            'sales' => 0,
            'platformfee' => 0,
            'deliveryfee' => 0,
            'gstfee' => 0,
            'discount' => 0,
        ];

        try {
            // Build API URL with filters
            $apiUrl = $this->api_url . 'order-list';

            if (!empty($dateFilter) || !empty($shopId) || !empty($startdate) || !empty($enddate)) {
                $params = [];
                if (!empty($dateFilter)) {
                    $params[] = 'dateFilter=' . urlencode($dateFilter);
                }
                if (!empty($shopId)) {
                    $params[] = 'shopId=' . urlencode($shopId);
                }
                if (!empty($startdate)) {
                    $params[] = 'startdate=' . urlencode($startdate);
                }
                if (!empty($enddate)) {
                    $params[] = 'enddate=' . urlencode($enddate);
                }
                $apiUrl .= '?' . implode('&', $params);
            }


            $raw = $this->apiGetfetch($apiUrl);

            

            // Validate API response
            if (!$raw || !isset($raw['orders']) || !is_array($raw['orders'])) {
                throw new Exception('Invalid API response or no orders found');
            }



            // Prepare report data
            $reportData = [
                'company_name' => 'GoFresha',
                'report_title' => 'Orders Report',
                'report_period' => $this->getReportPeriod($postdata),
                'report_date' => date('d-m-Y'),
                'generated_by' => 'Gofresha Team',
                'logo_url' => 'https://gofresha.in/shop1/public/images/logo.png',
                'shop_name' => '',

            ];
            if (!empty($shopId)) {
                foreach ($raw['shops'] as $shop) {
                    if ($shop['id'] == $shopId) {
                        $reportData['shop_name'] = $shop['shop_name'];
                    }
                }
            }


            // Calculate totals and prepare transactions
            $transactions = [];
            foreach ($raw['orders'] as $order) {
                $amt['sales'] += (float) $order['amount'];
                $amt['platformfee'] += (float) $order['platformfee'];
                $amt['deliveryfee'] += (float) $order['deliveryFee'];
                $amt['gstfee'] += (float) $order['gstfee'];
                $amt['discount'] += (float) $order['discount'];

                // Prepare transaction data for the report
                $transactions[] = [
                    'date' => $this->formatDate($order['ordered_date']),
                    'order_id' => $order['order_id'],
                    'customer' => $order['receiver_name'],
                    'city' => $order['city'],
                    'amount' => number_format((float) $order['amount'], 2),
                    'status' => $this->getOrderStatus($order)
                ];
            }

            $amt['total_orders'] = count($raw['orders']);

            // Prepare report content
            $reportContent = [
                'summary' => [
                    'total_sales' => '₹' . number_format($amt['sales'], 2),
                    'total_orders' => $amt['total_orders'],
                    'platformfee' => '₹' . number_format($amt['platformfee'], 2),
                    'deliveryfee' => '₹' . number_format($amt['deliveryfee'], 2),
                    'gstfee' => '₹' . number_format($amt['gstfee'], 2),
                    'discount' => '₹' . number_format($amt['discount'], 2)
                ],
                'transactions' => $transactions
            ];

            // Generate PDF
            return $this->generatePDFReport($reportData, $reportContent);

        } catch (Exception $e) {
            // Log error and return error response
            log_message('error', 'Report generation failed: ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to generate report: ' . $e->getMessage()
            ]);
        }
    }

    private function getReportPeriod($postdata)
    {
        if (!empty($postdata['startdate']) && !empty($postdata['enddate'])) {
            $startDate = date('d M Y', strtotime($postdata['startdate']));
            $endDate = date('d M Y', strtotime($postdata['enddate']));
            return $startDate . ' to ' . $endDate;
        }
        return 'All Time';
    }

    private function formatDate($date)
    {
        if ($date && $date !== '0000-00-00') {
            return date('d-m-Y', strtotime($date));
        }
        return 'N/A';
    }

    private function getOrderStatus($order)
    {
        // Determine status based on available data
        if (!empty($order['invoice_no'])) {
            return 'Completed';
        } elseif (!empty($order['transaction_id'])) {
            return 'Processing';
        } else {
            return 'Pending';
        }
    }

    private function generatePDFReport($reportData, $reportContent)
    {
        // Create the HTML content
        $html = $this->generateGofreshaReportHTML($reportData, $reportContent);

        // Initialize mPDF with custom settings
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 20,
            'margin_header' => 5,
            'margin_footer' => 10
        ]);

        // Set document properties
        $mpdf->SetTitle('GoFresha Orders Report');
        $mpdf->SetAuthor('GoFresha');
        $mpdf->SetCreator('GoFresha Report System');
        $mpdf->setFooter('{PAGENO}');

        // Write the HTML content
        $mpdf->WriteHTML($html);

        // Return the PDF response
        $filename = 'orders_report_' . date('Y-m-d_H-i-s') . '.pdf';
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody($mpdf->Output('', 'S'));
    }

    private function generateGofreshaReportHTML($data, $content)
    {
        $html = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", "Roboto", Arial, sans-serif;
            font-size: 13px;
            line-height: 1.5;
            color: #2d3748;
            background: #fff;
            padding-bottom: 15px;
        }

        .header {
            background: linear-gradient(135deg, #a8cca3ff 0%, #46de67ff 100%);
            color: white;
            padding: 20px 30px;
            margin-bottom: 20px;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .logo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: white;
            padding: 5px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.12);
            object-fit: contain;
        }

        .company-info h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .company-info p {
            font-size: 12px;
            opacity: 0.9;
            font-weight: 600;
        }

        .report-details {
            text-align: right;
            font-size: 12px;
        }

        .report-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .main-content {
            padding: 0 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #4f46e5;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
            margin-bottom: 15px;
            position: relative;
        }

        .section-title:after {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 50px;
            height: 2px;
            background: #4f46e5;
        }

        .summary-grid {
            display: flex;
            // grid-template-columns: repeat(5, 1fr);
            // gap: 15px;
            // margin-bottom: 25px;
        }
        @media (max-width: 992px) {
            .summary-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        .summary-card {
            // width: 20%;
            background: white;
            padding: 20px 15px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            border: 1px solid #e2e8f0;
        }

        .summary-value {
            font-size: 20px;
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 5px;
            display: block;
        }

        .summary-label {
            font-size: 11px;
            color: #718096;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .table-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            margin-top: 12px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 12px;
        }

        .table tr:nth-child(even) {
            background: #f8fafc;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .status {
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 10px;
            font-weight: 600;
            display: inline-block;
            text-align: center;
            min-width: 75px;
        }

        .status-completed {
            background: #dcfce7;
            color: #166534;
        }

        .status-processing {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .amount {
            font-weight: 700;
            color: #059669;
        }

        .footer {
            margin-top: 40px;
            padding: 20px 30px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            color: #64748b;
            font-size: 11px;
            border-radius: 10px 10px 0 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="header-content">
            <div class="logo-section" >
                <img src="' . $data['logo_url'] . '" alt="GoFresha Logo" class="logo">
                <div class="company-info">
                    <h1>' . $data['company_name'] . '</h1>
                    <p>Business Intelligence & Analytics</p>
                </div>
            </div>
            <div class="report-details">
                <div class="report-title" style="font-size: 26px;">' . $data['shop_name'] . '</div>
                <div class="report-title">' . $data['report_title'] . '</div>
                <div>Period: ' . $data['report_period'] . '</div>
                <div>Generated: ' . $data['report_date'] . '</div>
                <div>By: ' . $data['generated_by'] . '</div>
            </div>
        </div>
    </div>
    
    <div class="main-content">
        <div class="section">
            <h2 class="section-title">Executive Summary</h2>
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="summary-value">' . $content['summary']['total_sales'] . '</div>
                    <div class="summary-label">Total Sales</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value">' . $content['summary']['total_orders'] . '</div>
                    <div class="summary-label">Total Orders</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value">' . $content['summary']['platformfee'] . '</div>
                    <div class="summary-label">Platform Fee</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value">' . $content['summary']['deliveryfee'] . '</div>
                    <div class="summary-label">Delivery Fee</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value">' . $content['summary']['gstfee'] . '</div>
                    <div class="summary-label">GST Fee</div>
                </div>
                <div class="summary-card">
                    <div class="summary-value">' . $content['summary']['discount'] . '</div>
                    <div class="summary-label">Total Discount</div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 class="section-title">Order Details</h2>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>City</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>';

        foreach ($content['transactions'] as $transaction) {
            $statusClass = 'status-' . strtolower($transaction['status']);
            $html .= '
                        <tr>
                            <td>' . $transaction['date'] . '</td>
                            <td><strong>' . $transaction['order_id'] . '</strong></td>
                            <td>' . $transaction['customer'] . '</td>
                            <td>' . $transaction['city'] . '</td>
                            <td><span class="amount">₹' . $transaction['amount'] . '</span></td>
                            <td><span class="status ' . $statusClass . '">' . $transaction['status'] . '</span></td>
                        </tr>';
        }

        $html .= '
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <p><strong>GoFresha Orders Report</strong></p>
        <p>This report was generated automatically on ' . date('F j, Y \a\t g:i A') . '</p>
        <p>For questions or support, visit: gofresha.in</p>
    </div>
</body>
</html>';

        return $html;
    }

    // Add this method to handle AJAX requests for quick reports
    public function generateQuickReport()
    {
        $this->response->setContentType('application/json');

        try {
            $dateFilter = $this->request->getPost('dateFilter') ?? '';
            $shopId = $this->request->getPost('shopId') ?? '';

            // Build API URL
            $apiUrl = $this->sapi_url . 'order-list';
            if (!empty($dateFilter) || !empty($shopId)) {
                $params = [];
                if (!empty($dateFilter))
                    $params[] = 'dateFilter=' . urlencode($dateFilter);
                if (!empty($shopId))
                    $params[] = 'shopId=' . urlencode($shopId);
                $apiUrl .= '?' . implode('&', $params);
            }

            $raw = $this->apiGetfet($apiUrl, $this->sapi_key);

            if (!$raw || !isset($raw['orders'])) {
                throw new Exception('Failed to fetch order data');
            }

            $amt = [
                'sales' => 0,
                'platformfee' => 0,
                'deliveryfee' => 0,
                'gstfee' => 0,
                'discount' => 0,
                'total_orders' => 0
            ];

            foreach ($raw['orders'] as $order) {
                $amt['sales'] += (float) $order['amount'];
                $amt['platformfee'] += (float) $order['platformfee'];
                $amt['deliveryfee'] += (float) $order['deliveryFee'];
                $amt['gstfee'] += (float) $order['gstfee'];
                $amt['discount'] += (float) $order['discount'];
            }

            $amt['total_orders'] = count($raw['orders']);

            return $this->response->setJSON([
                'status' => 'success',
                'data' => $amt,
                'orders' => $raw['orders'],
                'shops' => $raw['shops'] ?? []
            ]);

        } catch (Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }









    // Helper methods to fetch data (implement according to your database structure)
    private function getSalesData($period)
    {
        // Implement your database query here
        return [];
    }

    private function getTopProducts()
    {
        // Implement your database query here
        return [];
    }

    private function getCustomerAnalytics()
    {
        // Implement your database query here
        return [];
    }





    public function web_posts()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $this->request->getPost('title');
            $data = [
                'content' => $this->request->getPost('content'),
                'title' => $title,
                'image' => $this->handleImage('image', $this->uploadPath.'posts/') ?? null,
                'url' => $this->request->getPost('url'),

            ];
            $url = $this->api_url."/posts";
            $resp = $this->apiPostFetch($data,$url); 

        //   echo "<pre>", print_r($resp, true), "</pre>";  die;

            return redirect()->back()->with('success', $resp['message']);
        }

        return view('path/web_posts');
    }
    public function posts()
    {
        $url = $this->api_url."posts_list";
        // print_r($url);die;

        $resp = $this->apiGetfetch($url); 

        if(isset($resp['status']) && $resp['status'] == 'success'){
            $data = [
                'posts' => $resp['posts'],
            ];
            return view('path/posts', $data);

        }
        echo "<pre>", print_r($resp, true), "</pre>";

    }


    public function postResend()
    {
        $url = $this->api_url."send-notification";
        // print_r($url);die;

        $resp = $this->apiGetfetch($url); 

        // echo "<pre>", print_r($resp, true), "</pre>"; die;  
        if(isset($resp['status']) && $resp['status'] == 'success'){
            return redirect()->back()->with('success', "Successfully sent ". $resp['sent_to'] ." notifications. ");
        }

    }
    public function sendPost($id)
    {
        $url = $this->api_url."sendPost/".$id;
        // print_r($url);die;

        $resp = $this->apiGetfetch($url); 

        // echo "<pre>", print_r($resp, true), "</pre>"; die;  
        if(isset($resp['status']) && $resp['status'] ){
            return redirect()->back()->with('success', "Successfully sent notifications. ");
        }

    }
    






    public function notify()
    {
        return view('path/firebase');
    }












    






































}