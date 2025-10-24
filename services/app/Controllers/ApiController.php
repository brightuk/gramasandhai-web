<?php

namespace App\Controllers;
use App\Models\ApiModel;

use App\Libraries\FirebaseNotification;
use App\Controllers\ShopAdminController;

class ApiController extends BaseController
{

    private function random_num($length = 8)
    {
        return substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
    }

    private $districtField = ['state_id', 'district_name', 'status'];
    private $loginfields = ['username', 'password', 'role', 'status'];

    public $uploadPath, $uri;



    protected $api_url;
    protected $api_key = 'SEC195C79FC4CCB09B48AA8';
    protected $site_url;
    protected $shop_url;
    protected $authorized;

    public  $adminModel,$model, $shops, $banners, $cityModel, $categories, $orders, $offers, $ShopAdmin, $shopBanner, $custAddress;


    public function __construct()
    {
        $config = config('App');
        $this->api_url = $config->admin_url;
        $this->shop_url = $config->shop_URL;
        $this->adminModel = new ApiModel();
        $this->model = new ApiModel();

        $this->categoriestb = new ApiModel();
        $this->subcategoriestb = new ApiModel();
        $this->uploadPath = realpath(FCPATH . '../') . '/uploads/images/';

        $header = service('request')->getHeaderLine('X-Api');
        $this->authorized = (str_replace('Bearer ', '', $header) === $this->api_key);

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
        $this->custAddress = new ApiModel();
        $this->custAddress->custAddress();

        $this->ShopAdmin = new ShopAdminController();
        $this->offers = new ApiModel();
        $this->offers->tables('offers', 'id', $this->ShopAdmin->offers_fields);




    }

    public function shoplogin()
    {
        $phoneno = $this->request->getPost('phone');
        $password = $this->request->getPost('password');

        if (empty($phoneno) || empty($password)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Username and password are required.'
            ])->setStatusCode(400);
        }
 
        // Step 1: Find user by username
        $user = $this->shops->where('shop_phone', $phoneno)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found.'
            ])->setStatusCode(404);
        }

        // Step 4: Check password (plain text match)
        if ($user['password'] !== $password) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid password.'
            ])->setStatusCode(401);
        }


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => $user
        ])->setStatusCode(200);
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($password)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Username and password are required.'
            ])->setStatusCode(400);
        }


        $model = new ApiModel();
        $model->tables('login', 'id', $this->loginfields);

        // Step 1: Find user by username
        $user = $model->where('username', $username)->first();

        if (!$user) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'User not found.'
            ])->setStatusCode(404);
        }


        // Step 3: Check status
        if ($user['status'] !== '1') {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Account is inactive.'
            ])->setStatusCode(403);
        }

        // Step 4: Check password (plain text match)
        if ($user['password'] !== $password) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid password.'
            ])->setStatusCode(401);
        }

        // Success: set session and respond

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Login successful.',
            'data' => $user
        ])->setStatusCode(200);
    }

    public function locations()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $model = new ApiModel();
        $district = new ApiModel();
        $city = new ApiModel();

        $model->states();
        $district->district();
        $city->city();

        $statelist = $model->where('status', '1')->findAll();
        $districtlist = $district->where('status', '1')->findAll();
        $citylist = $city->where('status', '1')->findAll();


        return $this->response->setJSON([
            'status' => 'success',
            'states' => $statelist,
            'districts' => $districtlist,
            'citylist' => $citylist,
        ]);
    }

    private function handleImageUpload($fieldName, $default = 'no_image.jpg')
    {
        $file = $this->request->getFile($fieldName);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            // $file->move($this->uploadPath, $imageName);
            return $imageName;
        }
        return $default;
    }


    public function location_add($seg)
    {
        $districtModel = new ApiModel();
        $cityModel = new ApiModel();
        $model = new ApiModel();
        $model->states();

        $districtModel->tables('district', 'id', $this->districtField);
        $cityModel->city();

        if ($seg == 'district') {
            $state_id = $this->request->getPost('state_id');
            $district = $this->request->getPost('district_name');
            $existingDistrict = $districtModel->like('district_name', $district)->first();

            $data = [
                'state_id' => $state_id,
                'district_name' => ucwords($district),
            ];
            if ($existingDistrict) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'District already exists',
                ])->setStatusCode(400);
            }
            $districtModel->insert($data);

        } elseif ($seg == 'city') {
            $district_id = $this->request->getPost('district_id');
            $city_name = $this->request->getPost('city_name');
            $existingCity = $cityModel->like('city_name', $city_name)->first();

            $district_d = $districtModel->where('id', $district_id)->first();
            $state = $model->where('id', $district_d['state_id'])->first();

            $data = [
                'state_name' => $state['state'],
                'district_name' => $district_d['district_name'],
                'district_id' => $district_id,
                'city_name' => ucwords($city_name),
            ];
            if ($existingCity) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'City already exists',
                ])->setStatusCode(400);
            }
            $cityModel->insert($data);

        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Location added successfully',
            'data' => $data,
            // 'state' => $state,
        ])->setStatusCode(200);
    }


    public function add_shop()
    {
        helper(['form', 'url']);

        $shops = new ApiModel();
        $shops->shop();

        $postData = $this->request->getPost();
        $shop_id = $this->request->getPost('shop_id');
        $url_name = strtolower(trim(str_replace(' ', '_', $postData['shop_name'] ?? '')));
        $shop_url = $this->shop_url . $url_name;

        $existingShop = null;
        if (!empty($shop_id)) {
            $existingShop = $shops->where('id', $shop_id)->first();
        }

        $data = [
            'shop_id' => $existingShop['shop_id'] ?? random_int(100000, 999999),
            'shop_name' => $postData['shop_name'] ?? ($existingShop['shop_name'] ?? ''),
            'owner_name' => $postData['owner_name'] ?? ($existingShop['owner_name'] ?? ''),
            'email' => $postData['email'] ?? ($existingShop['email'] ?? ''),
            'shop_address' => $postData['address'] ?? ($existingShop['shop_address'] ?? ''),
            'pincode' => $postData['pincode'] ?? ($existingShop['pincode'] ?? ''),
            'state_id' => $postData['state_id'] ?? ($existingShop['state_id'] ?? ''),
            'district_id' => $postData['district_id'] ?? ($existingShop['district_id'] ?? ''),
            'city_id' => $postData['city_id'] ?? ($existingShop['city_id'] ?? ''),
            'shop_email' => $postData['email'] ?? ($existingShop['shop_email'] ?? ''),
            'category_id' => $postData['shop_category'] ?? ($existingShop['category_id'] ?? ''),
            'shop_phone' => $postData['phone'] ?? ($existingShop['shop_phone'] ?? ''),
            'shop_images' => empty($postData['shop_images']) ? $existingShop['shop_images'] : ($postData['shop_images'] ?? ''),
            'shop_logo' => !empty($postData['shop_logo']) ? $postData['shop_logo'] : ($existingShop['shop_logo'] ?? ''),
            // 'shop_images' => !empty($postData['shop_images']) ? $existingShop['shop_images'] : '',
            'qr_img' => !empty($postData['qr_image']) ? $postData['qr_image'] : ($existingShop['qr_img'] ?? ''),
            'shop_url' => $shop_url,
            'discount' => $postData['discount'] ?? ($existingShop['discount'] ?? ''),
            'latitude' => $postData['latitude'] ?? ($existingShop['latitude'] ?? ''),
            'longitude' => $postData['longitude'] ?? ($existingShop['longitude'] ?? ''),
            'url_name' => !empty($postData['urlname'])
                ? $postData['urlname']
                : ($existingShop['url_name'] ?? $url_name),

        ];

        if ($existingShop) {
            // Update
            $shops->update($shop_id, $data);
            $message = 'Shop updated successfully';
            $type = 'update';
        } else {
            // Insert
            $shops->insert($data);
            $message = 'Shop added successfully';
            $type = 'insert';

        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $message,
            'type' => $type,
            'data' => $data,


        ]);
    }




    public function addBanner()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $fet = $this->request->getPost();
        $shop = $this->shops->where('id', $fet['shop_id'])->first();
        $id = $this->request->getPost('id');
        $exitingBanner = $this->banners->where('id', $id)->first();
        $fields = [
            'image' => !empty($fet['banner_image'])
                ? $fet['banner_image']
                : ($existingBanner['image'] ?? ''),
            'banner_link' => $fet['banner_link'] ?? '',
            'label_name' => $fet['labelname'] ?? '',
            'shop_id' => $fet['shop_id'] ?? '',
            'shop_name' => $shop['shop_name'] ?? '',
            'city_id' => $shop['city_id'] ?? '',
        ];
        if (!empty($id)) {
            $this->banners->update($id, $fields);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Banner updated successfully',
                'method' => 'update',

            ]);
        }
        if ($this->banners->insert($fields)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Banner added successfully',
                'method' => 'insert',

            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Something went wrong',

        ]);

    }

    public function bannerManagement($en = null)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $builder = $this->banners->where('status', '1')->orderBy('id', 'DESC');

        if ($en == null) {
            $builder = $builder->where('enable', '1');
        }
        $sliders = $builder->findAll();
        foreach ($sliders as $key => $slider) {
            $loc = $this->cityModel->find($slider['city_id']);
            $sliders[$key]['city'] = $loc['city_name'] ?? '';
            $sliders[$key]['district'] = $loc['district_name'] ?? '';
        }

        return $this->response->setJSON([
            'status' => 'success',
            'banners' => $sliders,
        ]);
    }


    public function getShopLo($id)
    {
        $city = $this->cityModel->find($id);
        return $city;
    }

    public function bannerEdit($id)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $banner = $this->banners->find($id);
        return $this->response->setJSON([
            'status' => 'success',
            'banner' => $banner,
        ]);

    }
    public function enable($seg, $id)
    {
        if ($seg == 'banner') {
            $redirect = 'banner/management';
            $msg = 'Banner ';
            $model = $this->banners;
        }

        $data = $model->find($id);
        if ($data['enable'] == '1') {
            $val = '0';
            $type = "disbale";
        } else {
            $type = "enable";
            $val = '1';
        }

        $model->update($id, ['enable' => $val]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => $msg . $type . ' successfully',
            'redirect' => $redirect,
        ]);

    }

    public function hider($seg, $id)
    {
        if ($seg == 'banner') {
            $redirect = 'banner/management';
            $model = $this->banners;
        } else if ($seg == 'shop') {
            $redirect = 'shop/list';
            $model = $this->shops;
        } else if ($seg == 'shopbanner') {
            $redirect = null;
            $model = $this->shopBanner;

        }

        $data = $model->find($id);
        if ($data['status'] == '1') {
            $val = '0';
            $msg = $seg . ' hide successfully';

        } else {
            $val = '1';
            $msg = $seg . ' enable successfully';

        }

        $model->update($id, ['status' => $val]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => ucwords($msg),
            'redirect' => $redirect,
        ]);

    }
    public function action($seg, $seg2, $id)
    {

        $id = $this->uri->getSegment(4);

        if ($seg == 'offer') {
            $model = $this->offers;
        } else if ($seg == 'banner') {
            $model = $this->banners;
            $redirect = 'banner/management';
        }

        $data = $model->find($id);

        if ($data['enable_status'] == 1) {
            $val = '0';

        } else {
            $val = '1';
        }

        $model->update($id, ['enable_status' => $val]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => ucwords($seg . ' ' . $seg2 . ' successfully'),
            // 'val' => $val,
            // 'id' => $id,
            // 'data' => $data,

        ]);


    }

    public function categories()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $this->categories->where('status', '1')->orderBy('id', 'DESC')->findAll(),
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
            // ->where('status', '1')
            ->orderBy('id', 'DESC')->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'shops' => $data,
        ]);

    }


    public function locationbyshop($dis, $area)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $shop = $this->shops->where('district_id', $dis)->where('city_id', $area)->where('status', 1)->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'hfhhf' => 'ioidzoi',
            'shops' => $shop,
            'place' => $this->cityModel->find($area)['city_name'] ?? '',
        ]);
    }


    public function categoryFilter($cat)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $raw = $this->categories->like('url_name', $cat)->orderBy('id', 'DESC')->first();
        $shop = $this->shops->where('category_id', $raw['id'])->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'shops' => $shop,
        ]);
    }


    public function getOrders()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $order = $this->request->getPost();

        $data = [
            'shop_id' => $order['shop_id'] ?? '',
            'order_id' => $order['order_id'] ?? '',
            'user_id' => $order['user_id'] ?? '',
            'receiver_name' => $order['receiver_name'] ?? '',
            'city' => $order['city'] ?? '',
            'transaction_id' => $order['transaction_id'] ?? 'NTX',
            'discount' => $order['discount'] ?? '',
            'gstfee' => $order['gstfee'] ?? '',
            'deliveryFee' => $order['deliveryFee'] ?? '',
            'platformfee' => $order['platformfee'] ?? '',
            'amount' => $order['amount'] ?? '',
            'ordered_date' => $order['ordered_date'] ?? '',
            'invoice_no' => $order['invoice_no'] ?? '',
            'invoice_date' => $order['invoice_date'] ?? '',
        ];


        if ($this->orders->insert($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Order added successfully',
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Order not added',
            ]);
        }

    }

    public function orderList()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        return $this->response->setJSON([
            'status' => 'success',
            'orders' => $this->orders->orderBy('id', 'DESC')->findAll(),
        ]);
    }



    public function ordersList()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $dateFilter = $this->request->getGet('dateFilter') ?? '';
        $shopId = $this->request->getGet('shopId') ?? '';
        $startdate = $this->request->getGet('startdate') ?? '';
        $enddate = $this->request->getGet('enddate') ?? '';


        $shops = $this->shops->findAll();

        $orders = $this->orders->filterOrders($dateFilter, $shopId, $startdate, $enddate);
        // foreach ($orders as $key => $value) {
        //     $value['shop_id'] = $this->findshop($value['shop_id'])['shop_name'];
        // }

        foreach ($orders as $key => $value) {
            $orders[$key]['receiver_name'] = $this->custAddress->where('cust_id', $value['user_id'])->first()['name'] ?? '';
        }

        return $this->response->setJSON([
            'status' => 'success',
            'start' => $startdate,
            'end' => $enddate,
            'orders' => $orders,
            'shops' => $shops,
            'selectedDateFilter' => $dateFilter,
            'selectedShopId' => $shopId
        ]);
    }


    public function findshop($id)
    {
        $shop = $this->shops->find($id);
        return $shop;
    }






    public function index()
    {
        echo 'Go Fresha API';
    }

    public function updatePosition($seg, $id)
    {
        $categories = new ApiModel();
        $categories->tables('categories', 'id', $this->categoriesField);

        $model = $categories;


        $groups = $model->orderBy('position', 'ASC')->findAll(); // List sorted by position
        $index = array_search($id, array_column($groups, 'id'));

        if ($index === false) {
            // id not found!
            return redirect()->to('/');
        }

        // Swapping logic based on position in display order:
        if ($seg == 'next' && isset($groups[$index + 1])) {
            $current = $groups[$index];
            $next = $groups[$index + 1];

            // Swap their positions
            $model->update($current['id'], ['position' => $next['position']]);
            $model->update($next['id'], ['position' => $current['position']]);

        } elseif ($seg == 'previous' && isset($groups[$index - 1])) {
            $current = $groups[$index];
            $prev = $groups[$index - 1];

            // Swap their positions
            $model->update($current['id'], ['position' => $prev['position']]);
            $model->update($prev['id'], ['position' => $current['position']]);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Position updated successfully',
        ]);



    }


    public function addCategory()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $model = new ApiModel();
        $model->tables('categories', 'id', $this->categoriesField);

        $categoryName = $this->request->getPost('categoryName');
        $categorySubtitle = $this->request->getPost('categorySubtitle');

        $categoryId = $this->request->getPost('categoryId');

        $image = $this->request->getFile('categoryImage');
        $lastinsert = $model->orderby('id', 'desc')->first();


        $imageName = '';

        if (!empty($image)) {
            if ($image && $image->isValid() && !$image->hasMoved()) {
                $imageName = $image->getRandomName();

                // Define the path OUTSIDE public folder
                $targetPath = realpath(FCPATH . '../') . '/uploads/images/';
                // Move the file
                $image->move($targetPath, $imageName);
            }
        }


        if ($categoryId) {
            $exiting = $model->where('id', $categoryId)->first();
            if (!empty($imageName)) {
                $prodImage = $imageName;
            } else {
                $prodImage = $exiting['category_image'];
            }
            $data = [
                'category_name' => ucwords(trim($categoryName ?? $exiting['category_name'] )),
                'category_subtitle' => ucwords(trim($categorySubtitle ?? $exiting['category_subtitle'])),
                'category_image' => $prodImage
            ];
            $redirectUrl = $this->site_url . 'categoriesRedirect';

            $model->update($categoryId, $data);
        } else {
            $data = [
                'position' => (isset($lastinsert['position']) ? $lastinsert['position'] + 1 : 1),
                'category_name' => ucwords(trim($categoryName)),
                'category_subtitle' => ucwords(trim($categorySubtitle)),
                'category_image' => $imageName
            ];
            $redirectUrl = $this->site_url . 'addcategoriesRedirect';

            $id = $model->insert($data);

        }
        return $this->response->setJSON([
            'status' => 'success',
            'redirect' => $redirectUrl
        ]);
    }

    public function shopEdit($id)
    {
        $shops = new ApiModel();
        $shops->shop();

        $shop = $shops->find($id);
        $otherShops = $shops->select('id, shop_name,url_name')->where('id !=', $id)->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'shop' => $shop,
            'otherShops' => $otherShops

        ]);
    }
    public function postsList(){
        $model = $this->adminModel->posts();
        $posts = $model->orderBy('id', 'desc')->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'posts' => $posts
        ]);
    }







    // $model = $this->adminModel->customers();
      // $tokens = $model->select('token')->where('token != ""')->findAll();
        // $deviceToken = [];

        // foreach ($tokens as $row) {
        //     $decoded = json_decode($row['token'], true);
        //     if (is_array($decoded)) {
        //         $deviceToken = array_merge($deviceToken, $decoded);
        //     }
        // }
        // $deviceToken = array_unique($deviceToken);









}