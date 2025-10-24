<?php

namespace App\Controllers;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ShopController extends Authenticated
{
    public $config, $sapi_url, $sapi_key, $uploadPath, $uploads_url, $api_url, $api_key, $api_url_shop;

    private $products_varFieldt = ['prod_id', 'measure', 'price', 'disc_type', 'disc_price', 'stock', 'sku_code', 'hsn_code', 'variant_image'];
    private $productsFieldt = ['id', 'prod_name', 'qty_type', 'tax_id', 'fssai_no', 'category_id', 'subcategory_id', 'prod_type', 'manufacturer', 'made_in', 'return_status', 'cancelable_status', 'cod_allowed', 'total_quantity', 'main_image', 'other_images', 'size_chart', 'description', 'shipping_policy'];


    public function __construct()
    {
        parent::__construct();
        $this->config = config('AccessProperties');
        $this->api_url = $this->config->api_url;
        $this->uploads_url = $this->config->uploads;
        $this->api_key = $this->config->key;
        $this->api_url_shop = $this->config->api_url . 'shop/';

        $this->uploadPath = realpath(FCPATH . '../') . '/uploads/images/';

        // $this->sapi_url = $this->config->sapi['url'];
        // $this->sapi_key = $this->config->sapi['key'];
        // $this->role = session()->get('role');

        // Models

    }

    public function index()
    {
        return view('shop/index');
    }

    public function back()
    {
        return redirect()->back();
    }

    public function apifetch($url)
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

    public function shopPage($id)
    {
        $data = [
            'shop_id' => $id,
            'showTitle' => 'Business Management Dashboard',
        ];
        return view('shop/accessories', $data);
    }

    public function addCategory()
    {
        return view('shop/addcategory');
    }
    public function addcategoriesRedirect()
    {

        return redirect()->to('product/category/add')->with('success', '✅ Category added successfully!');

    }

    public function categoriespage()
    {
        $url = $this->api_url . 'product_categories';
        $data = $this->apifetch($url);

        return view('shop/categories', ['categories' => $data['categories']]);
    }


    public function editcategoryPage($id)
    {
        $url = $this->api_url . 'product_editCategory/' . $id;
        $data = $this->apifetch($url);

        // print_r($data);
        return view('shop/addcategory', ['category' => $data['category']]);

    }


    public function categoriesRedirect()
    {
        return redirect()->to('product/category/list')->with('success', '✅ Category updated successfully!');

    }


    public function hideAll($opt, $id)
    {
        $url = $this->api_url . $opt . '/delete/' . $id;
        $data = $this->apifetch($url);
        if (isset($data['status'])) {
            return redirect()->back()->with($data['status'], $data['message']);
        }
        echo "<pre>", print_r($data, true), "</pre>";

        // return redirect()->back()->with($data['status'], $data['message']);
    }


    public function updatePosition($seg, $seg2, $id)
    {
        $url = $this->api_url . $seg . '/position/' . $seg2 . '/' . $id;
        $data = $this->apifetch($url);
        return redirect()->back()->with($data['status'], $data['message']);

    }

    public function addSubcategories()
    {


        $data = $this->apifetch($this->api_url . 'product_categories');
        $raw = [
            'categories' => $data['categories'],
        ];
        return view('shop/addSubcategory', $raw);
    }




    public function subcategories()
    {
        $url = $this->api_url . 'product_subcategories/';
        $data = $this->apifetch($url);

        $raw = [
            // 'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'api_urlI' => $this->api_url,

        ];
        return view('shop/subcategories', $raw);

    }



    public function addsubcatRedirect()
    {
        return redirect()->to(previous_url())->with('success', '✅ Subcategory added successfully!');
    }
    public function editsubcatRedirect()
    {
        return redirect()->to('product/subcategory/list')->with('success', '✅ Subcategory updated successfully!');
    }


    public function editSubategoryPage($id)
    {
        $url = $this->api_url . 'product_editSubCategory/' . $id;
        $data = $this->apifetch($url);


        $raw = [
            'categories' => $data['categories'],
            'subcategory' => $data['subcategories'],
        ];
        // print_r($raw);

        return view('shop/addSubcategory', $raw);

    }

    public function feeManage($id)
    {
        $url = $this->api_url . 'shop/' . $id . '/fee-manage';
        $raw = $this->apifetch($url);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $this->request->getPost();
            $data1 = $this->postApifetch($url, $postData);

            return redirect()->to(previous_url())->with($data1['status'], $data1['message']);
        }
        $data = [
            'fees_c' => $raw['fees'],
            'showTitle' => 'Fee Management',
            'shop_id' => $id,
        ];
        // echo "<pre>", print_r($data, true), "</pre>";
        // die;
        return view('shop/fee_manage', $data);
    }


    public function second_ch($shop_id, $seg, $id)
    {
        $url = $this->api_url_shop . $shop_id . '/' . $seg . '/' . 'second_ch/' . $id;
        $data = $this->apifetch($url);
        if ($data['status'] == 'success') {
            return redirect()->to(previous_url())->with('success', $data['message']);
        }
    }

    public function feeUpdate($shop_id, $seg, $id)
    {
        $url = $this->api_url_shop . $id . '/' . $seg . '/' . 'enableInall';
        $data = $this->apifetch($url);
        if ($data['status'] == 'success') {
            return redirect()->to(previous_url())->with('success', $data['message']);
        }
    }



    public function shopProCategories($id)
    {

        $url = $this->api_url_shop . $id . '/' . 'category_subcategory';
        $data = $this->apifetch($url);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postdata = [
                'categories' => json_encode($this->request->getPost('categories'), true),
            ];
            $url = $this->api_url_shop . $id . '/category_add';

            $data1 = $this->postApifetch($url, $postdata);
            if ($data1['status'] == 'error') {
                return redirect()->back()->with('error', $data1['message']);
            } else {
                return redirect()->to(previous_url())->with('success', $data1['message']);
            }


        }
        $set = [
            'categories' => $data['categories'],
            'sel_categories' => $data['sel_categories'],
            'shop_id' => $id,
        ];
        //     echo "<pre>", print_r($set, true), "</pre>";
        // die;
        return view('shop/select_category', $set);
    }





    public function shopProSubCategories($id)
    {

        $url = $this->api_url_shop . $id . '/' . 'category_subcategory';
        $data = $this->apifetch($url);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postdata = [
                'subcategories' => json_encode($this->request->getPost('subcategories'), true),

            ];
            $url = $this->api_url_shop . $id . '/subcategory_add';

            $data1 = $this->postApifetch($url, $postdata);
            if ($data1['status'] == 'error') {
                return redirect()->back()->with('error', $data1['message']);
            } else {
                return redirect()->to(previous_url())->with('success', $data1['message']);
            }



        }
        $set = [
            'sel_categories' => $data['sel_categories'],
            'subcategories' => $data['subcategories'],
            'sel_subcategories' => $data['sel_subcategories'],
            'shop_id' => $id,
        ];

        return view('shop/select_subcategory', $set);
    }

    public function addProduct($shop_id)
    {
        $url = $this->api_url_shop . $shop_id . '/addproduct';
        $data = $this->apifetch($url);


        $raw = [
            'shop_id' => $shop_id,
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],

        ];
        // echo "<pre>", print_r($raw, true), "</pre>";die;


        return view('shop/addProduct', $raw);

    }

    public function saveProduct($shop_id)
    {
        $shop_id = service('uri')->getSegment(2);
        $postData = [];

        // Collect all scalar post fields first
        $simpleFields = [
            'product_name',
            'qtytype',
            'is_variant',
            'tax',
            'fssai_no',
            'category',
            'sub_category',
            'productType',
            'manufacturer',
            'made_in',
            'returnable',
            'cancelable',
            'cod_allowed',
            'total_quantity',
            'product_description',
            'shippingPolicy'
        ];
        

        foreach ($simpleFields as $field) {
            $postData[$field] = $this->request->getPost($field);
        }

        // Handle file uploads
        $mainImage = $this->request->getFile('main_image');
        $sizeChart = $this->request->getFile('size_chart');
        $otherImages = $this->request->getFileMultiple('other_images');

        if ($mainImage && $mainImage->isValid() && !$mainImage->hasMoved()) {
            $postData['main_image'] = new \CURLFile(
                $mainImage->getTempName(),
                $mainImage->getMimeType(),
                $mainImage->getName()
            );
        }

        if ($sizeChart && $sizeChart->isValid() && !$sizeChart->hasMoved()) {
            $postData['size_chart'] = new \CURLFile(
                $sizeChart->getTempName(),
                $sizeChart->getMimeType(),
                $sizeChart->getName()
            );
        }

        // Multiple other images
        if (!empty($otherImages)) {
            foreach ($otherImages as $index => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $postData["other_images[$index]"] = new \CURLFile(
                        $file->getTempName(),
                        $file->getMimeType(),
                        $file->getName()
                    );
                }
            }
        }

        $variantImages = $this->request->getFileMultiple('variant_images') ?? [];
        foreach ($variantImages as $index => $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $postData["variant_images[$index]"] = new \CURLFile(
                    $file->getTempName(),
                    $file->getMimeType(),
                    $file->getName()
                );
            }
        }

        // Variant fields
        $variantFields = [
            'measurement',
            'measureUnit',
            'prices',
            'discount_type',
            'discount_price',
            'stock',
            'stock_unit',
            'status',
            'sku_code',
            'hsn_code',
            'variantexist',
            'productid'
        ];

        foreach ($variantFields as $field) {
            $values = (array) $this->request->getPost($field);
            foreach ($values as $i => $val) {
                $postData["{$field}[$i]"] = $val;
            }
        }

// echo "<pre>", print_r($postData, true), "</pre>";die;

        $url = $this->api_url_shop . $shop_id . '/addproduct';

        // Prepare cURL request
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30, // Increased timeout for file uploads
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => [
                'X-Api: Bearer ' . $this->api_key
            ]
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($response === false) {
            $error = curl_error($curl);
            curl_close($curl);
            return $this->response->setJSON(['status' => 'error', 'message' => 'cURL Error: ' . $error]);
        }

        curl_close($curl);

        $result = json_decode($response, true);

echo "<pre>", print_r($result, true), "</pre>";die;


        // Check for JSON decode errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid JSON response from API']);
        }



        if (isset($result['status']) && $result['status'] == 'success') {
            $mess = (isset($result['type']) && $result['type'] == 'create') ?
                '✅ Product added successfully' : '✅ Product updated successfully';
            $redirectUrl = (isset($result['type']) && $result['type'] == 'create') ?
                previous_url() : 'shop/' . $shop_id . '/products';

            return redirect()->to($redirectUrl)->with('message', $mess);
        } else {
            $errorMessage = isset($result['message']) ? $result['message'] : 'Failed to add product';
            return $this->response->setJSON(['status' => 'error', 'message' => $errorMessage]);
        }
    }

    public function products($shop_id)
    {
        $url = $this->api_url_shop . $shop_id . '/products';
        $data = $this->apifetch($url);


        $raw = [
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'products' => $data['products'],
            'products_variants' => $data['products_variants'],
            'shop_id' => $shop_id

        ];
        // echo "<pre>", print_r($raw, true), "</pre>";
        // die;

        return view('shop/products', $raw);

    }



    public function editProduct($shop_id, $id)
    {
        $url = $this->api_url_shop . $shop_id . '/' . 'editProduct/' . $id;

        $data = $this->apifetch($url);


        $raw = [
            'categories' => $data['categories'],
            'subcategories' => $data['subcategories'],
            'product' => $data['product'],
            'product_variants' => $data['product_variants'],
            'shop_id' => $shop_id

        ];



        return view('shop/productEdit', $raw);
        // return view('dashboard/addProduct',$raw );


    }




    public function addOffer($shop_id)
    {
        $data = [
            'shop_id' => $shop_id
        ];
        return view('shop/add_offer', $data);
    }
    public function addoffersave($shop_id)
    {

        $postData = $this->request->getPost();
        $image = $this->request->getFile('offer_image');
        $offerid = $this->request->getPost('offerid');
        $imageName = null; // default

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = 'offer_' . bin2hex(random_bytes(5)) . '.' . $image->getExtension();
            $image->move($this->uploadPath, $imageName);
        }

        if ($imageName == null && empty($offerid)) {
            return redirect()->back()->with('error', 'Image not uploaded');
        }
        $postData['shop_id'] = $shop_id;
        $postData['offer_image'] = $imageName;


        //    echo "<pre>", print_r($postData, true), "</pre>";


        $url = $this->api_url_shop . $shop_id . '/offersadmin';
        $data = $this->postApifetch($url, $postData);
        //         echo "<pre>", print_r($data, true), "</pre>";
        // die;
        if ($data['status'] == 'success') {
            return redirect()->to($data['redirectUrl'])->with('success', $data['message']);
        }

    }



    public function offers($shop_id)
    {
        $url = $this->api_url_shop . $shop_id . '/offerslist';
        $data = $this->apifetch($url);
        $raw = [
            'offers' => $data['offers'],
            'shop_id' => $shop_id,
            'showTitle' => '<i class="fa fa-gift text-primary me-2"></i> Offers Management',
        ];
        return view('shop/offerspage', $raw);

    }

    public function editoffer($shop_id, $id)
    {
        $url = $this->api_url_shop . $shop_id . '/offer' . '/' . $id;
        $raw = $this->apifetch($url);
        $data = [
            'offer' => $raw['offer'],
            'shop_id' => $shop_id,
            'showTitle' => '<i class="fa fa-gift text-primary me-2"></i> Offers Edit',
        ];

        return view('shop/add_offer', $data);

    }


    public function adddetails($shop_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $postData['mobile'] = $this->request->getPost('mobile_number');
            $postData['upi_id'] = $this->request->getPost('upi_id');
            $mainImage = $this->request->getFile('qrcode');

            if ($mainImage && $mainImage->isValid() && !$mainImage->hasMoved()) {
                $postData['qrcode'] = new \CURLFile(
                    $mainImage->getTempName(),
                    $mainImage->getMimeType(),
                    $mainImage->getName()
                );
            }

            // Prepare cURL request
            $url = $this->api_url_shop . $shop_id . '/paymentdetials';
            $raw = $this->postApifetch($url, $postData);

            if ($raw['status'] == 'success') {
                $mess = $raw['message'];
                $redirect = $raw['type'] == 'insert' ? previous_url() : 'shop/list';
                return redirect()->to($redirect)->with($raw['status'], $raw['message']);
            } else {
                return redirect()->back()->with('error', 'Something went wrong, please try again later');
            }

        }
        $data = [
            'shop_id' => $shop_id
        ];
        return view('shop/paymentdetails', $data);
    }

    public function payment_detail_list($shop_id)
    {
        $url = $this->api_url_shop . $shop_id . '/paymentdetials';
        $raw = $this->apifetch($url);

        $raw = [
            'details' => $raw['data'],
            'shop_id' => $shop_id
        ];

        return view('shop/paydetail_list', $raw);
    }

    public function shopBannerAdd($id)
    {
        $raw = $this->apifetch($this->api_url . 'shop_list');

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postData = $this->request->getPost();
            $banner_image = $this->handleImageUpload('banner_image');
            $url = $this->api_url_shop . $id . '/shopBannerAdd';
            $fields = [
                'banner_image' => $banner_image ?? '',
                'banner_link' => $postData['banner_link'] ?? '',
                'labelname' => $postData['labelname'] ?? '',
                'shop_id' => $id,
            ];

            $result = $this->postApifetch($url, $fields);
            // echo "<pre>", print_r($result, true), "</pre>";
            // die;
            if ($result['status'] == 'success') {
                $redirect = $result['method'] == 'update' ? 'shop/' . $id . '/shopBanner' : previous_url();
                return redirect()->to($redirect)->with($result['status'], $result['message']);
            }
        }
        if ($raw['status'] == 'success') {
            $data = [
                'shoplist' => $raw['shops'],
                'shop_id' => $id,
            ];
            // echo "<pre>", print_r($data, true), "</pre>";
            return view('shop/add_Shopbanner', $data);
        } else {
            print_r($raw);
        }
    }





    public function shopBanner($shop_id)
    {
        $raw = $this->apifetch($this->api_url_shop . $shop_id . '/shopBanner');
        if ($raw['status'] == 'success') {
            $data = [
                'banners' => $raw['banners'],
                'shop_id' => $shop_id,
            ];
            return view('shop/sbanners', $data);
        }

        echo "<pre>", print_r($raw, true), "</pre>";
    }


    public function importData($shop_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $option = $this->request->getPost('table_name');

            // determine table fields + file count
            switch ($option) {
                case 'products':
                    $runCount = 2;
                    $fieldMain = $this->productsFieldt;
                    $fieldSecond = $this->products_varFieldt;
                    break;

                default:
                    return $this->response->setJSON(['message' => 'Invalid table name']);
            }

            // files
            $main_excel = $this->request->getFile('main_excel');
            $variant_excel = $this->request->getFile('variant_excel');

            // validate
            if (!$main_excel || !$main_excel->isValid()) {
                return redirect()->back()->with('error', 'Please select the main file');
            }
            if ($runCount === 2 && (!$variant_excel || !$variant_excel->isValid())) {
                return redirect()->back()->with('error', 'Please select the second file for products');
            }

            $collect = [];

            for ($i = 0; $i < $runCount; $i++) {
                if ($i === 0) {
                    $file = $main_excel;
                    $fieldlist = $fieldMain;
                    $table_name = $option;
                } else {
                    $file = $variant_excel;
                    $fieldlist = $fieldSecond;
                    $table_name = 'product_variants';
                }

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $filePath = ROOTPATH . 'uploads/' . $newName;
                    $file->move(ROOTPATH . 'uploads/', $newName);

                    $spreadsheet = IOFactory::load($filePath);
                    $sheet = $spreadsheet->getActiveSheet();
                    $rows = $sheet->toArray(null, true, true, true);

                    $allData = [];
                    foreach (array_slice($rows, 1) as $row) {
                        $data = [];
                        $colIndex = 'A';
                        foreach ($fieldlist as $dbField) {
                            $data[$dbField] = $row[$colIndex] ?? null;
                            $colIndex++;
                        }
                        if (array_filter($data)) {
                            $allData[] = $data;
                        }
                    }

                    $collect[] = [
                        'data' => $allData,
                        'table_name' => $table_name,
                    ];
                }
            }

            // echo "<pre>", print_r($collect, true), "</pre>";
            // die;


            $url = $this->api_url . 'shop/' . $shop_id . '/import_data';


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
                CURLOPT_POSTFIELDS => json_encode($collect),
                CURLOPT_HTTPHEADER => [
                    'X-Api: Bearer ' . $this->api_key
                ]
            ]);

            $response = curl_exec($curl);

            $data = json_decode($response, true);



            return redirect()->back()->with($data['status'], $data['message']);

        }

        $raw = $this->apifetch($this->api_url . 'store/' . $shop_id . '/catesub');
        // Keys to remove from categories
        // echo "<pre>", print_r($raw, true), "</pre>"; die;

        $removeFromCategories = ['position', 'category_subtitle', 'selected_status', 'select_id', 'shop_id', 'category_row_id'];
        $removeFromSubcategories = ['position', 'category_subtitle', 'chk', 'category_ref_id', 'shop_id'];

        foreach ($raw['categories'] as $key => $category) {
            foreach ($removeFromCategories as $field) {
                unset($raw['categories'][$key][$field]);
            }
        }
        foreach ($raw['subcategories'] as $key => $subcategory) {
            foreach ($removeFromSubcategories as $field) {
                unset($raw['subcategories'][$key][$field]);
            }
        }
        $data = [
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
            'shop_id' => $shop_id,
        ];

        return view('shop/import_data', $data);
    }





















}