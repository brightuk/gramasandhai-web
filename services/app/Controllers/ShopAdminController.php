<?php

namespace App\Controllers;
use App\Models\ApiModel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ShopAdminController extends BaseController
{

    private function random_num($length = 8)
    {
        return substr(str_shuffle(str_repeat('0123456789', $length)), 0, $length);
    }
    private $loginfields = ['username', 'password', 'role', 'status'];

    private $subcategoriesFieldt = ['category_id', 'main_category', 'sub_category_name', 'sub_category_subtitle', 'sub_category_image', 'status'];
    private $districtField = ['state_id', 'district_name', 'status'];

    private $productsFieldt = ['id', 'shop_id', 'prod_name', 'qty_type', 'tax_id', 'fssai_no', 'category_id', 'subcategory_id','disc_value','disc_type', 'prod_label','hsn_code','sku_code','stock','is_variant', 'prod_price', 'prod_type', 'manufacturer', 'made_in', 'return_status', 'cancelable_status', 'cod_allowed', 'total_quantity', 'main_image', 'other_images', 'size_chart', 'description', 'shipping_policy', 'color', 'status', 'date_added'];
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

    private $db;
    protected $api_url;
    protected $api_key;
    protected $site_url;
    protected $shop_url;
    protected $authorized;
    private $sup_admin;  //  Super Admin 



    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $config = config('App');
        $this->api_key = $config->api_key;
        $this->shop_url = $config->shop_URL;
        // $this->shop_id = $config->shop_id;
        $this->site_url = $config->admin_url;
        $this->adminmodel = new ApiModel();
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
        $this->shopBanner = new ApiModel();

        $this->subcategoriestab->tables('ecom_subcategories', 'id', $this->subcategoriesFieldt);
        $this->fees = new ApiModel;
        $this->fees->tables('fee_manage', 'id', $this->fee_fields);
        $this->offers = new ApiModel;
        $this->offers->tables('offers', 'id', $this->offers_fields);

        $this->selectCategory->selectCategory();
        $this->selectsubCategory->selectsubCategory();
        $this->shopBanner->shopBanner();
        $this->shopOrders = new ApiModel();
        $this->shopOrders->shopOrders();
        $this->ordersDetials = new ApiModel();
        $this->ordersDetials->ordersDetials();
        $this->custAddress = new ApiModel();
        $this->custAddress->custAddress();
    }

    public function authorize()
    {
        if (!$this->authorized) {
            echo "401 - Unauthorized access";
            die;
        }
    }

    private function handleImageUpload($fieldName)
    {
        $file = $this->request->getFile($fieldName);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move($this->uploadPath, $imageName);
            return $imageName;
        }
        return '';
    }


    public function productAddCategory()
    {
        $model = $this->categoriestb;
        $categoryName = $this->request->getPost('categoryName');
        $categorySubtitle = $this->request->getPost('categorySubtitle');

        $categoryId = $this->request->getPost('categoryId');

        $image = $this->request->getFile('categoryImage');
        $lastinsert = $model->orderby('category_id', 'desc')->first();

        $imageName = $this->handleImageUpload('categoryImage');

        if (!empty($categoryId)) {
            $exiting = $model->where('category_id', $categoryId)->first();
            if (!empty($imageName)) {
                $prodImage = $imageName;
            } else {
                $prodImage = $exiting['category_image'];
            }
            $data = [
                'category_name' => ucwords(trim($categoryName ?? $exiting['category_name'])),
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
            'data' => $data,
            'redirect' => $redirectUrl
        ]);
    }

    public function productEditCategory($id)
    {
        $model = $this->categoriestb;
        $products = $model->find($id);

        return $this->response->setJSON([
            'status' => 'success',
            'category' => $products
        ]);
    }


    public function productCategories()
    {
        $model = $this->categoriestb;
        $categories = $model->where('status', 1)->orderby('position', 'asc')->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $categories
        ]);
    }



    public function hideR($opt, $id)
    {
        $categories = $this->categoriestb;
        $subcategories = $this->subcategoriestab;

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $payment = new ApiModel;
        $payment->tables('payment', 'id', $this->paymentFields);
        $address = new ApiModel();
        $address->tables('cust_address', 'address_id', $this->addressfields);
        $offers = new ApiModel;
        $offers->tables('offers', 'id', $this->offers_fields);
        if ($opt == 'product_category') {
            $model = $categories;
        } elseif ($opt == 'product_subcategory') {
            $model = $subcategories;
        } elseif ($opt == 'product') {
            $model = $products;
        } elseif ($opt == 'offer') {
            $model = $offers;
        } elseif ($opt == 'showpayment') {
            $model = $payment;
        } elseif ($opt == 'address') {
            $model = $address;
        }
        // }  elseif ($opt == 'category') {
        //     $model = $categories;
        //     $redirect = $this->site_url . 'categories';

        //     $redirect = $this->site_url . 'payment_detail_list';

        //     $redirect = $this->site_url . 'address';

        // }
        if (!$model) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Delete failed',
                'segment' => $opt
            ]);

        }

        if ($model->update($id, ['status' => 0])) {
            $option = ucwords($opt);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => $option . ' deleted successfully',
            ]);
        } else {
            $get = $model->where('category_id', $id)->first();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => !empty($get) ? 'Delete failed' : 'Record not found',
            ]);
        }


    }
    public function shophideR($opt, $id)
    {
        $categories = $this->categoriestb;
        $subcategories = $this->subcategoriestab;

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $product_variant = new ApiModel();
        $product_variant->tables('product_variants', 'id', $this->products_varFieldt);
        $payment = new ApiModel;
        $payment->tables('payment', 'id', $this->paymentFields);
        $address = new ApiModel();
        $address->tables('cust_address', 'address_id', $this->addressfields);
        $offers = new ApiModel;
        $offers->tables('offers', 'id', $this->offers_fields);
        if ($opt == 'product_category') {
            $model = $categories;
        } elseif ($opt == 'product_subcategory') {
            $model = $subcategories;
        } elseif ($opt == 'product') {
            $model = $products;
        } elseif ($opt == 'product_variant') {
            $model = $product_variant;
        } elseif ($opt == 'offer') {
            $model = $offers;
        } elseif ($opt == 'showpayment') {
            $model = $payment;
        } elseif ($opt == 'address') {
            $model = $address;
        }
        // }  elseif ($opt == 'category') {
        //     $model = $categories;
        //     $redirect = $this->site_url . 'categories';

        //     $redirect = $this->site_url . 'payment_detail_list';

        //     $redirect = $this->site_url . 'address';

        // }
        if (!$model) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Delete failed',
                'segment' => $opt
            ]);

        }

        $prod_status = $model->find($id)['status'] ?? null;

        $up_id = $prod_status == 1 ? 0 : 1;

        if ($model->update($id, ['status' => $up_id])) {
            $option = ucwords($opt);
            $action = $up_id == 1 ? 'activated' : 'deactivated';

            return $this->response->setJSON([
                'status' => 'success',
                'message' => $option . ' ' . $action . ' successfully',
            ]);
        } else {
            $get = $model->where('category_id', $id)->first();
            return $this->response->setJSON([
                'status' => 'error',
                'message' => !empty($get) ? 'Delete failed' : 'Record not found',
            ]);
        }


    }


    public function updatePosition($val, $seg, $fid)
    {

        if ($val == 'product_category') {
            $model = $this->categoriestb;
            $id = 'category_id';
        }

        $groups = $model->orderBy('position', 'ASC')->findAll(); // List sorted by position
        $index = array_search($fid, array_column($groups, $id));

        if ($index === false) {
            // id not found!
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Position update failed id not found',
            ]);

        }

        // Swapping logic based on position in display order:
        if ($seg == 'next' && isset($groups[$index + 1])) {
            $current = $groups[$index];
            $next = $groups[$index + 1];

            // Swap their positions
            $model->update($current[$id], ['position' => $next['position']]);
            $model->update($next[$id], ['position' => $current['position']]);

        } elseif ($seg == 'previous' && isset($groups[$index - 1])) {
            $current = $groups[$index];
            $prev = $groups[$index - 1];

            // Swap their positions
            $model->update($current[$id], ['position' => $prev['position']]);
            $model->update($prev[$id], ['position' => $current['position']]);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Position updated successfully',
        ]);



    }



    public function addSubCategory()
    {
        $subcategories = $this->subcategoriestab;


        $category_id = $this->request->getPost('category_id');
        $subCategoryName = trim($this->request->getPost('subCategory'));
        $subCategorySubtitle = trim($this->request->getPost('subCategorySubtitle'));
        $subCategoryId = $this->request->getPost('subCategoryId');
        $category = $this->categoriestb->find($category_id);

        $imageName = $this->handleImageUpload('subCategoryImage');

        if ($subCategoryId) {
            $exiting = $subcategories->where('id', $subCategoryId)->first();
            if (!empty($imageName)) {
                $prodImage = $imageName;
            } else {
                $prodImage = $exiting['sub_category_image'];
            }
            $data = [
                'main_category' => ucwords($mainCategory ?? $exiting['main_category']),
                'sub_category_name' => $subCategoryName ?? $exiting['sub_category_name'],
                'sub_category_subtitle' => $subCategorySubtitle ?? $exiting['sub_category_subtitle'],
                'sub_category_image' => $prodImage,
            ];

            $subcategories->update($subCategoryId, $data);
            $redirectUrl = $this->site_url . 'subcatRedirect';

        } else {
            $data = [
                'category_id' => $category_id ?? 0,
                'main_category' => ucwords(strtolower(trim($category['category_name'] ?? ''))),
                'sub_category_name' => ucwords(strtolower($subCategoryName)),
                'sub_category_subtitle' => ucwords(strtolower($subCategorySubtitle)),
                'sub_category_image' => $imageName
            ];

            try {
                $subcategories->insert($data);
                $redirectUrl = $this->site_url . 'addsubcatRedirect';

            } catch (\Exception $e) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => $e->getMessage()

                ]);
            }

        }
        return $this->response->setJSON([
            'status' => 'success',
            'redirect' => $redirectUrl,
            'data' => $data,

        ]);

    }

    public function subcategories()
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }

        $model = new ApiModel();
        $model->tables('ecom_subcategories', 'id', $this->subcategoriesFieldt);
        // $this->categoriestb->tables('categories', 'id', $this->subcategoriesFieldt);
        // $categories = $this->categoriestb->where('status', 1)->orderby('position', 'asc')->findAll();

        $subcategories = $model->where('status', 1)->orderby('id', 'DESC')->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'subcategories' => $subcategories,
            // 'categories' => $categories
        ]);
    }




    public function editSubCategory($id)
    {

        $subcategoriestb = new ApiModel();

        $this->categoriestb->tables('ecom_categories', 'id', $this->categoriesField);

        $categories = $this->categoriestb->where('status', 1)->orderby('category_id', 'DESC')->findAll();
        $subcategoriestb->tables('ecom_subcategories', 'id', $this->subcategoriesFieldt);
        $subcategories = $subcategoriestb->find($id);


        return $this->response->setJSON([
            'status' => 'success',
            'subcategories' => $subcategories,
            'categories' => $categories,
        ]);
    }



    public function feeManage($shop_id)
    {
        $fees = $this->fees;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $code = $this->request->getPost('code');

            $existing = $fees->where('code', $code)->where('shop_id', $shop_id)->first();
            $data = [
                'shop_id' => $shop_id,
                'name' => $this->request->getPost('field_name'),
                'percentage' => $this->request->getPost('percentage'),
                'amount' => $this->request->getPost('amount'),
                'code' => $code,
            ];
            if (!empty($existing)) {
                $fees->update($existing['id'], $data);
            } else {
                $fees->insert($data);
            }

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Fee updated successfully',
                'data' => $data,
                'existing' => $existing,
            ]);
        }

        $data = $fees->where('shop_id', $shop_id)->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Fee list',
            'fees' => $data,
            'id' => $shop_id,
        ]);
    }





    public function second_ch($shop, $opt, $id)
    {
        $fees = $this->fees;

        if ($opt == 'fee-manage') {
            $model = $fees;
        }

        $raw = $model->where('id', $id)->get()->getRowArray();
        if ($raw['op_select'] == 1) {
            $model->update($id, ['op_select' => 0]);
            // $msg = ' Successfully';
        } else {
            $model->update($id, ['op_select' => 1]);
            // $msg = 'Fee changes Successfully';
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Fee changes Successfully',
        ]);
    }


    public function enableInALL($id, $opt)
    {
        $fees = $this->fees;
        if ($opt == 'fee-manage') {
            $model = $fees;
        }

        $raw = $model->where('id', $id)->get()->getRowArray();
        if ($raw['status'] == 1) {
            $model->update($id, ['status' => 0]);
            $msg = 'Disabled successfully';
        } else {
            $model->update($id, ['status' => 1]);
            $msg = 'Enabled successfully';
        }
        return $this->response->setJSON([
            'status' => 'success',
            'message' => $msg,
        ]);
    }


    public function category_subcategory($shop_id)
    {
        $model = $this->selectCategory;

        $sel_categories = $model->where('status', 1)->where('shop_id', $shop_id)->findAll();
        $sel_subcategories = $this->selectsubCategory->where('status', 1)->where('shop_id', $shop_id)->findAll();
        $categoriestb = $this->categoriestb;
        $categories = $categoriestb->orderby('category_id', 'asc')->findAll();
        $subcategories = $this->subcategoriestab->where('status', 1)->findAll();


        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Category list',
            'categories' => $categories,
            'subcategories' => $subcategories,
            'sel_categories' => $sel_categories,
            'sel_subcategories' => $sel_subcategories,
            'id' => $shop_id,

        ]);
    }



    public function categoryAdd($shop_id)
    {
        $model = $this->selectCategory;
        $categories = json_decode($this->request->getPost('categories'));

        // Step 1: Disable all categories for this shop
        $model->where('shop_id', $shop_id)->set('status', 0)->update();

        // Step 2: Re-enable or insert only the submitted ones
        foreach ($categories as $category) {
            $col = $model
                ->where('shop_id', $shop_id)
                ->where('category_id', $category)
                ->first();

            if (!empty($col)) {
                $model->update($col['id'], ['status' => 1]);
            } else {
                $data = [
                    'shop_id' => $shop_id,
                    'category_id' => $category,
                    'status' => 1
                ];
                $model->insert($data);
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Category updated successfully',
        ]);
    }

    public function getcategory_id($shop_id, $subcid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('ecom_subcategories s');

        $builder->select('sc.id AS selected_category_id, sc.shop_id, sc.category_id, s.id AS subcategory_id, c.category_name, s.sub_category_name');
        $builder->join('ecom_categories c', 's.category_id = c.category_id');
        $builder->join('ecom_select_category sc', 'sc.category_id = c.category_id');
        $builder->where('s.id', $subcid);
        $builder->where('sc.shop_id', $shop_id);

        $query = $builder->get();
        $result = $query->getRowArray();

        return $result['selected_category_id'] ?? '';


    }



    public function subCategoryAdd($shop_id)
    {
        $selectsubCategory = $this->selectsubCategory;
        $subcategories = json_decode($this->request->getPost('subcategories'), true); // decode as array
        $selectsubCategory->where('shop_id', $shop_id)->set('status', 0)->update();

        if (!empty($subcategories)) {
            foreach ($subcategories as $key => $category) {
                $slcategory = $this->getcategory_id($shop_id, $category);
                $col = $selectsubCategory
                    ->where('shop_id', $shop_id)
                    ->where('subcategory_id', $category)
                    ->first();
                if (!empty($col)) {
                    $selectsubCategory->update($col['id'], ['status' => 1]);
                } else {
                    $data = [
                        'shop_id' => $shop_id,
                        'category_id' => $slcategory ?? '',
                        'subcategory_id' => $category,
                        'status' => 1
                    ];
                    $selectsubCategory->insert($data);
                }
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Category updated successfully',

        ]);
    }



    public function addProductPage($shop_id)
    {
        $raw = $this->filterCategory_Sub($shop_id);
        foreach($raw['categories'] as $key => $category){
            $raw['categories'][$key]['subcategory_count'] = $this->sucategory_count($category['category_id'], $raw['subcategories']);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
        ]);
    }

    public function category_subcategories($shop_id)
    {
        $raw = $this->filterCategory_Sub($shop_id);
        foreach($raw['categories'] as $key => $category){
            $raw['categories'][$key]['subcategory_count'] = $this->sucategory_count($category['category_id'], $raw['subcategories']);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
        ]);
    }

    public function categories($shop_id)
    {
        $raw = $this->filterCategory_Sub($shop_id);
        foreach($raw['categories'] as $key => $category){
            $raw['categories'][$key]['subcategory_count'] = $this->sucategory_count($category['category_id'], $raw['subcategories']);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $raw['categories'],

        ]);
    }

    public function subcategory($shop_id)
    {
        $raw = $this->filterCategory_Sub($shop_id);
        foreach($raw['subcategories'] as $key => $subcategory){
            $raw['subcategories'][$key]['products_count'] = $this->products_count($subcategory['subcategory_id']);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'subcategories' => $raw['subcategories'],
        ]);
    }

    

    public function sucategory_count($id, $array){
        $count = 0;
        foreach($array as $key => $value){
            if($value['category_id'] == $id){
                $count++;
            }
        }
        return $count;
    }



    public function filterCategory_Sub($shop_id)
    {
        $category_sel = $this->db->table('ecom_select_category sc');

        $category_sel->select('sc.id AS select_id,
                  sc.shop_id,
                  sc.category_id,
                  c.category_name,
                  c.category_subtitle,
                  c.category_image,
                  c.position,
                  c.status AS category_status,
                  sc.status AS selected_status');

        $category_sel->join('ecom_categories c', 'sc.category_id = c.category_id');
        $category_sel->where('sc.shop_id', $shop_id);
        $category_sel->where('sc.status', 1);

        $query = $category_sel->get();


        $categories = $query->getResultArray();

        $subcategory_sel = $this->db->table('ecom_subcategories as sc');
        $subcategory_sel->select('
                sc.id AS subcategory_id,
                sc.category_id,
                sc.main_category,
                sc.sub_category_name,
                sc.sub_category_subtitle,
                sc.sub_category_image,
                sc.status AS subcategory_status,
                c.id AS category_row_id,
                c.category_id AS category_ref_id,
                c.shop_id,
                c.chk,
                c.status AS category_status
            ');
        $subcategory_sel->join('ecom_select_category as c', 'sc.category_id = c.category_id');
        $subcategory_sel->where('sc.status', 1);
        $subcategory_sel->where('c.shop_id', $shop_id);
        $query2 = $subcategory_sel->get();




        $subcategories = $query2->getResultArray();

        $raw = [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ];
        return $raw;


    }



    public function addUpProduct($shop_id)
    {
        try {
            $categories = new ApiModel();
            $categories->tables('categories', 'id', $this->categoriesField);
            $subcategories = new ApiModel();
            $subcategories->tables('subcategories', 'id', $this->subcategoriesFieldt);
            $products = new ApiModel();
            $products->tables('products', 'id', $this->productsFieldt);
            $product_var = new ApiModel();
            $product_var->tables('product_variants', 'id', $this->products_varFieldt);

            $is_variant = $this->request->getPost('is_variant');

            // Inputs - with validation
            $measurement = $this->request->getPost('measurement') ?? [];
            $measure_unit = $this->request->getPost('measureUnit') ?? [];
            $prices = $this->request->getPost('prices') ?? [];
            $discount_type = $this->request->getPost('discount_type') ?? [];
            $discount_price = $this->request->getPost('discount_price') ?? [];
            $stock = $this->request->getPost('stock') ?? [];
            $stock_unit = $this->request->getPost('stock_unit') ?? [];
            $status = $this->request->getPost('status') ?? [];
            $sku_code = $this->request->getPost('sku_code') ?? [];
            $hsn_code = $this->request->getPost('hsn_code') ?? [];
            $existvar_id = $this->request->getPost('variantexist') ?? [];
            $product_id = $this->request->getPost('productid');

            // Validate arrays have same length
            $count = count($measurement);
            if ($count !== count($measure_unit) || $count !== count($prices)) {
                throw new \Exception('Variant data arrays must have the same length');
            }

            $mainImage = $this->request->getFile('main_image');
            $sizeChart = $this->request->getFile('size_chart');
            $files = $this->request->getFiles();

            $mainImageName = null;
            $otherImagesName = [];
            $sizeChartName = null;
            $variant_image_names = [];

            $uploadPath = realpath(FCPATH . '../') . '/uploads/images/';

            // Check if upload directory exists and is writable
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            if (!is_writable($uploadPath)) {
                throw new \Exception('Upload directory is not writable: ' . $uploadPath);
            }

            // Upload variant images
            if (isset($files['variant_images']) && is_array($files['variant_images'])) {
                foreach ($files['variant_images'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $imageName1 = bin2hex(random_bytes(5)) . '.' . $file->getExtension();
                        if ($file->move($uploadPath, $imageName1)) {
                            $variant_image_names[] = $imageName1;
                        }
                    }
                }
            }

            // Upload main image
            if ($mainImage && $mainImage->isValid() && !$mainImage->hasMoved()) {
                $mainImageName = bin2hex(random_bytes(6)) . '.' . $mainImage->getExtension();
                if (!$mainImage->move($uploadPath, $mainImageName)) {
                    throw new \Exception('Failed to upload main image');
                }
            }

            // Upload size chart
            if ($sizeChart && $sizeChart->isValid() && !$sizeChart->hasMoved()) {
                $sizeChartName = bin2hex(random_bytes(5)) . '.' . $sizeChart->getExtension();
                if (!$sizeChart->move($uploadPath, $sizeChartName)) {
                    throw new \Exception('Failed to upload size chart');
                }
            }

            // Upload other images
            if (isset($files['other_images']) && is_array($files['other_images'])) {
                foreach ($files['other_images'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $otherImage = bin2hex(random_bytes(5)) . '.' . $file->getExtension();
                        if ($file->move($uploadPath, $otherImage)) {
                            $otherImagesName[] = $otherImage;
                        }
                    }
                }
            }

            // Check existing product
            $existing = null;
            if ($product_id) {
                $existing = $products->where('id', $product_id)->first();
            }

            // Prepare product data with proper null coalescing
            $data = [
                'shop_id' => $shop_id,
                'prod_name' => $this->request->getPost('product_name'),
                'qty_type' => $this->request->getPost('qtytype'),
                'tax_id' => $this->request->getPost('tax'),
                'fssai_no' => $this->request->getPost('fssai_no'),
                'category_id' => $this->request->getPost('category'),
                'subcategory_id' => $this->request->getPost('sub_category'),
                'prod_type' => $this->request->getPost('productType'),
                'manufacturer' => $this->request->getPost('manufacturer'),
                'made_in' => $this->request->getPost('made_in'),
                'return_status' => $this->request->getPost('returnable') ?? 0,
                'cancelable_status' => $this->request->getPost('cancelable') ?? 0,
                'cod_allowed' => $this->request->getPost('cod_allowed') ?? 0,
                'total_quantity' => $this->request->getPost('total_quantity'),
                'other_images' => !empty($otherImagesName) ? json_encode($otherImagesName) :
                    (isset($existing['other_images']) ? $existing['other_images'] : null),
                'main_image' => $mainImageName ?? (isset($existing['main_image']) ? $existing['main_image'] : null),
                'size_chart' => $sizeChartName ?? (isset($existing['size_chart']) ? $existing['size_chart'] : null),
                'description' => $this->request->getPost('product_description'),
                'shipping_policy' => $this->request->getPost('shippingPolicy'),
                'is_variant' => $is_variant,
                'stock'   => trim(($stock[0] ?? '') . ' ' . ($stock_unit[0] ?? '')),
                'sku_code'     => $sku_code[0] ?? 'NVT',
                'hsn_code'     => $hsn_code[0] ?? 'NVT',
            ];


            // For NON-variant product (single value)
            if ($is_variant != 1) {

                $data['prod_label'] = trim(
                    (is_array($measurement) ? ($measurement[0] ?? '') : $measurement) 
                    . ' ' .
                    (is_array($measure_unit) ? ($measure_unit[0] ?? '') : $measure_unit)
                );

                $data['prod_price'] = (int) (
                    is_array($prices) ? ($prices[0] ?? 0) : $prices
                );

                $data['disc_type']  = (int) (
                    is_array($discount_type) ? ($discount_type[0] ?? 0) : $discount_type
                );

                $data['disc_value'] = (int) (
                    is_array($discount_price) ? ($discount_price[0] ?? 0) : $discount_price
                );
            }

            // Insert/update product
            if ($existing) {
                if (!$products->update($product_id, $data)) {
                    throw new \Exception('Product update failed');
                }
            } else {
                if (!$products->insert($data)) {
                    throw new \Exception('Product insert failed');
                }
                $product_id = $products->insertID();
            }

            // Delete variants not in the current update (only for existing products)
            if (!empty($existing) && !empty($existvar_id)) {
                $product_var->where('prod_id', $product_id)
                    ->whereNotIn('id', array_filter($existvar_id)) // Filter out empty values
                    ->delete();
            }
            if ($is_variant != 0) {

                // Insert/update product variants
                for ($i = 0; $i < $count; $i++) {
                    // Ensure discount values are properly set
                    $discountType = isset($discount_type[$i]) && !empty($discount_type[$i]) ? (int) $discount_type[$i] : 0;
                    $discountPrice = isset($discount_price[$i]) && !empty($discount_price[$i]) ? (int) $discount_price[$i] : 0;

                    $data2 = [
                        'prod_id' => $product_id,
                        'measure' => ($measurement[$i] ?? '') . '' . ($measure_unit[$i] ?? ''),
                        'price' => isset($prices[$i]) ? (int) $prices[$i] : 0,
                        'disc_type' => $discountType,
                        'disc_price' => $discountPrice,
                        'stock' => (isset($stock[$i]) ? (int) $stock[$i] : 0) . ' ' . ($stock_unit[$i] ?? ''),
                        'sku_code' => $sku_code[$i] ?? '',
                        'hsn_code' => $hsn_code[$i] ?? '',
                        'variant_image' => isset($variant_image_names[$i]) ? $variant_image_names[$i] : null,
                        'status' => isset($status[$i]) ? $status[$i] : 1,
                    ];

                    // Fixed the commented logic
                    if (!empty($existvar_id) && isset($existvar_id[$i]) && !empty($existvar_id[$i])) {
                        // Update existing variant
                        if (!$product_var->update($existvar_id[$i], $data2)) {
                            throw new \Exception('Variant update failed at index ' . $i);
                        }
                    } else {
                        // Insert new variant
                        if (!$product_var->insert($data2)) {
                            throw new \Exception('Variant insert failed at index ' . $i);
                        }
                    }
                }
            }

            return $this->response->setJSON([
                'status' => 'success',
                'type' => $existing ? 'updated' : 'create',
                'product_id' => $product_id,
                'data' => $data,
                'dd' => gettype($data['prod_label']),
                'variants_count' => $count

            ]);

        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ])->setStatusCode(500);
        }
    }

public function addProductVariant()
{
    $products = new ApiModel();
    $products->tables('products', 'id', $this->productsFieldt);
    $product_var = new ApiModel();
    $product_var->tables('product_variants', 'id', $this->products_varFieldt);

    $measurement        = $this->request->getPost('measurement') ?? [];
    $measure_unit       = $this->request->getPost('measureUnit') ?? [];
    $prices             = $this->request->getPost('prices') ?? [];
    $discount_type      = $this->request->getPost('discount_type') ?? [];
    $discount_price     = $this->request->getPost('discount_price') ?? [];
    $stock              = $this->request->getPost('stock') ?? [];
    $stock_unit         = $this->request->getPost('stock_unit') ?? [];
    $status             = $this->request->getPost('status') ?? [];
    $sku_code           = $this->request->getPost('sku_code') ?? [];
    $hsn_code           = $this->request->getPost('hsn_code') ?? [];
    $existvar_id        = $this->request->getPost('variantexist_id') ?? [];
    $product_id         = $this->request->getPost('productid');

    // --- HANDLE IMAGE UPLOAD ---
    $files = $this->request->getFiles();
    $variant_image_names = [];

    if (isset($files['variant_image']) && is_array($files['variant_image'])) {
        foreach ($files['variant_image'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $imageName1 = bin2hex(random_bytes(5)) . '.' . $file->getExtension();
                if ($file->move($this->uploadPath, $imageName1)) {
                    $variant_image_names[] = $imageName1;
                } else {
                    $variant_image_names[] = null;
                }
            } else {
                $variant_image_names[] = null;
            }
        }
    }

    // --- VALIDATE ARRAY COUNTS ---
    $count = count($measurement);
    if ($count !== count($measure_unit) || $count !== count($prices)) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Variant data arrays must have the same length'
        ]);
    }

    $products->update($product_id, ['is_variant' => 1]);


    // --- SAVE VARIANTS ---
    for ($i = 0; $i < $count; $i++) {

        $discountType  = isset($discount_type[$i]) && $discount_type[$i] !== '' ? (int) $discount_type[$i] : 0;
        $discountPrice = isset($discount_price[$i]) && $discount_price[$i] !== '' ? (int) $discount_price[$i] : 0;

        $data2 = [
            'prod_id'     => $product_id,
            'measure'     => trim(($measurement[$i] ?? '') . ' ' . ($measure_unit[$i] ?? '')),
            'price'       => isset($prices[$i]) ? (int)$prices[$i] : 0,
            'disc_type'   => $discountType,
            'disc_price'  => $discountPrice,
            'stock'       => trim((isset($stock[$i]) ? (int)$stock[$i] : 0) . ' ' . ($stock_unit[$i] ?? '')),
            'sku_code'    => $sku_code[$i] ?? '',
            'hsn_code'    => $hsn_code[$i] ?? '',
            'variant_image' => $variant_image_names[$i] ?? null,
            'status'      => isset($status[$i]) ? $status[$i] : 1,
        ];

        if (!empty($existvar_id) && isset($existvar_id[$i]) && !empty($existvar_id[$i])) {
            // UPDATE
            if (!$product_var->update($existvar_id[$i], $data2)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Variant update failed at index ' . $i
                ]);
            }
            $type = 'updated';
        } else {
            // INSERT
            if (!$product_var->insert($data2)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Variant insert failed at index ' . $i
                ]);
            }
            $type = 'added';
        }
    }

    return $this->response->setJSON([
        'status' => true,
        'type' => $type,
        'message' => 'Product variants ' . $type . ' successfully'
    ]);
}





    public function products($shop_id)
    {

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $products = $products->where('shop_id', $shop_id)
            // ->where('status', 1)
            ->orderby('id', 'DESC')->findAll();
            

        foreach ($products as $key => $product) {
            $variants[$key] = $product_var->where('prod_id', $product['id'])->where('off', 1)->findAll();
        }
        $raw = $this->filterCategory_Sub($shop_id);
        foreach($raw['categories'] as $key => $category){
            $raw['categories'][$key]['subcategory_count'] = $this->sucategory_count($category['category_id'], $raw['subcategories']);
        }
   
        foreach($raw['subcategories'] as $key => $subcategory){
            $raw['subcategories'][$key]['products_count'] = $this->products_count($subcategory['subcategory_id']);
        }
        return $this->response->setJSON([
            'status' => 'success',
            'products' => $products,
            'products_variants' => $variants ?? 0,
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
            
        ]);
    }

    public function products_count($id){
        $count = 0;
        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $count = $products->where('subcategory_id', $id)->countAllResults();

        return $count;
    }
    public function editProductPage($shop_id, $id)
    {

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);


        $prod = $products->where('shop_id', $shop_id)->where('id', $id)->first();
        $raw = $this->filterCategory_Sub($shop_id);

        return $this->response->setJSON([
            'status' => 'success',
            'categories' => $raw['categories'],
            'subcategories' => $raw['subcategories'],
            'product' => $prod,
            'product_variants' => $product_var->where('prod_id', $id)->findAll(),
        ]);
    }


    public function offersAdmin($shop_id)
    {
        $offers = new ApiModel;
        $offers->tables('offers', 'id', $this->offers_fields);

        $end_date = $this->request->getPost('end_date');
        $end_time = $this->request->getPost('end_time');
        $imageName = $this->request->getPost('offer_image');

        // Combine end date and time into MySQL datetime format
        $date = date('Y-m-d H:i:s', strtotime("$end_date $end_time"));

        $offerid = $this->request->getPost('offerid');
        $existing = $this->offers->where('id', $offerid)->first();

        $data = [
            'shop_id' => $shop_id,
            'name' => ucwords($this->request->getPost('offer_name')),
            'label' => ucwords($this->request->getPost('offer_label')),
            'org_price' => (int) $this->request->getPost('original_price'),
            'disc_price' => (int) $this->request->getPost('discount_price'),
            'endoffer' => $date,
            'offer_notes' => $this->request->getPost('offer_notes'),
            'image' => $imageName,
            'code' => strtoupper(
                'co' . bin2hex(random_bytes(3))
            ),
            'offer_value' => $this->request->getPost('discount_precentage'),
            'type' => $this->request->getPost('offertype'),
        ];
        if (!empty($existing)) {
            $data['image'] = !empty($imageName) ? $imageName : $existing['image'] ?? null;
            $offers->update($offerid, $data);
            $msg = 'Offer update successfully';
            $redirectUrl = $this->site_url . 'shop/' . $shop_id . '/offers';


        } else {
            $offers->insert($data);
            $msg = 'Offer add successfully';
            $redirectUrl = $this->site_url . 'shop/' . $shop_id . '/addoffer';


        }


        return $this->response->setJSON([
            'status' => 'success',
            'message' => ucwords($msg),
            'redirectUrl' => $redirectUrl,
            'data' => $data,
            'offerid' => $offerid,
        ]);
    }

    public function offerslist($shop_id)
    {
        $offers = new ApiModel;
        $offers->tables('offers', 'id', $this->offers_fields);
        $offerslist = $offers->where('shop_id', $shop_id)->where('status', 1)->findAll();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Offers list',
            'offers' => $offerslist,
        ]);
    }

    public function offerEdit($shop, $id)
    {
        $offers = $this->offers;
        $data = $offers->where('shop_id', $shop)->where('id', $id)->first();
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Offer edited successfully',
            'offer' => $data,
        ]);
    }

    public function paymentdetials($shop_id)
    {

        $payment = new ApiModel;
        $payment->tables('payment', 'id', $this->paymentFields);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $moblie = $this->request->getPost('mobile');
            $qrcode = $this->request->getFile('qrcode');
            if (empty($moblie) || empty($qrcode)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Mobile Number and QRCode is required'
                ])->setStatusCode(401);
            }
            // Upload size chart
            if ($qrcode && $qrcode->isValid() && !$qrcode->hasMoved()) {
                $qrcodeName = 'qrcode_' . bin2hex(random_bytes(5)) . '.' . $qrcode->getExtension();
                $qrcode->move($this->uploadPath, $qrcodeName);
            }
            $data = [
                'shop_id' => $shop_id,
                'pay_phoneno' => $moblie,
                'upi_id' => $this->request->getPost('upi_id'),
                'pay_qrcode' => $qrcodeName ?? '',
            ];
            $payment->where('id !=', 0)->set(['enable_status' => 0])->update();


            $payment->insert($data);
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Added successfully!',
                'type' => 'insert',
                // 'data' => $data,
                // 'shop' => $shop_id,

            ]);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $row = $payment->where('shop_id', $shop_id)->where('status', '1')->orderby('enable_status', 'desc')->findAll();
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $row,
            ]);
        }

    }

    public function enable($opt, $id)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $payment = new ApiModel;
        $payment->tables('payment', 'id', $this->paymentFields);
        $payment->where('id !=', 0)->set(['enable_status' => 0])->update();

        $payment->update($id, ['enable_status' => 1]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Enabled successfully',
        ]);
    }


    public function shopBannerAdd($id)
    {

        $fet = $this->request->getPost();
        $id = $this->request->getPost('id');
        $exitingBanner = $this->shopBanner->where('id', $id)->first();
        $fields = [
            'image' => !empty($fet['banner_image'])
                ? $fet['banner_image']
                : ($existingBanner['image'] ?? ''),
            'banner_link' => $fet['banner_link'] ?? '',
            'label_name' => $fet['labelname'] ?? '',
            'shop_id' => $fet['shop_id'] ?? '',
        ];
        // if (!empty($id)) {
        //     $this->banners->update($id, $fields);
        //     return $this->response->setJSON([
        //         'status' => 'success',
        //         'message' => 'Banner updated successfully',
        //         'method' => 'update',

        //     ]);
        // }
        if ($this->shopBanner->insert($fields)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Banner added successfully',
                'method' => 'insert',

            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Something went wrong',
            'data' => $fields,

        ]);

    }

    public function shopBanner($shop_id)
    {
        $builder = $this->shopBanner
            // ->where('status', '1')
            ->where('shop_id', $shop_id)->orderBy('id', 'DESC');

        $sliders = $builder->findAll();

        return $this->response->setJSON([
            'status' => 'success',
            'banners' => $sliders,
        ]);
    }

    public function importData($shop_id)
    {
        if (!$this->authorized) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Unauthorized access'
            ])->setStatusCode(401);
        }
        $categories = new ApiModel();
        $categories->tables('categories', 'id', $this->categoriesField);

        $subcategories = new ApiModel();
        $subcategories->tables('subcategories', 'id', $this->subcategoriesFieldt);

        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);

        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $data = json_decode($this->request->getBody(), true);

        if (!$data || !is_array($data)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid JSON data'
            ]);
        }

        // priority: first block
        $prodData = $data[0]['data'] ?? [];
        $table1 = $data[0]['table_name'] ?? null;

        $idMapping = []; // old ID => new ID

        if ($table1 && !empty($prodData)) {
            $model1 = match ($table1) {
                'products' => $products,
                'categories' => $categories,
                'subcategories' => $subcategories,
                default => null
            };

            if ($model1) {
                foreach ($prodData as $row) {
                    try {
                        $row['shop_id'] = $shop_id;
                        $oldID = $row['id'] ?? null;
                        unset($row['id']); // remove ID if present to auto-increment
                        if ($model1->insert($row)) {
                            $newID = $model1->insertID();
                            if ($oldID) {
                                $idMapping[$oldID] = $newID;
                            }
                        }
                    } catch (\Exception $e) {
                        return $this->response->setJSON([
                            'status' => 'error',
                            'message' => "Insert failed in $table1: " . $e->getMessage()
                        ]);
                    }
                }
            }
        }

        // second block (variants)
        if (isset($data[1])) {
            $varData = $data[1]['data'] ?? [];
            $table2 = $data[1]['table_name'] ?? null;

            if ($table2 && !empty($varData)) {
                $model2 = match ($table2) {
                    'products_variant', 'product_variants' => $product_var,
                    default => null
                };

                if ($model2) {
                    foreach ($varData as $row) {
                        try {
                            // map old prod_id to new
                            $oldProdId = $row['prod_id'] ?? null;
                            if ($oldProdId && isset($idMapping[$oldProdId])) {
                                $row['prod_id'] = $idMapping[$oldProdId];
                            }
                            // unset($row['id']); // remove ID if present
                            $model2->insert($row);
                        } catch (\Exception $e) {
                            return $this->response->setJSON([
                                'status' => 'error',
                                'message' => "Insert failed in $table2: " . $e->getMessage()
                            ]);
                        }
                    }
                }
            }
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Import completed successfully'
        ]);
    }



    public function productUpdate($var_id)
    {
        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
        $product_var = new ApiModel();
        $product_var->tables('product_variants', 'id', $this->products_varFieldt);

        $data = $this->request->getPost();
        
        if($product_var->update($var_id, $data)){
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Product variant updated successfully',
                'data' => $data,
            ]);
        }else{
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Product variant update failed',
                'data' => $data,
            ]);
        }
 

    }

    public function produpdate($prod_id)
    {
        $products = new ApiModel();
        $products->tables('products', 'id', $this->productsFieldt);
   
        $price =  $this->request->getPost('prod_price');
        $prod_name = $this->request->getPost('prod_name');
        $image = $this->handleImageUpload('main_image');

        

        


        $data =[
            'prod_price' => (int) $price,
            'prod_name' => $prod_name,
            'main_image' => $image,
        ];
        // if(empty($price)){
        //     $data = $this->request->getPost();
        // }

        // $products->update($prod_id, $data);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Product updated successfully',
            'data' => $data,
        ]);

    }

    public function shopOrders($id)
    {

        $customer = new ApiModel();
        $customer->tables('customers', 'id', $this->customerRegFields);
        $ordersModel = $this->shopOrders;
        $orderDetailsModel = $this->ordersDetials;


        $orders = $ordersModel
            ->where('shop_id', $id)
            ->orderBy("FIELD(order_status, '1', 'PRS', 'COM', 'CNL')", '', false)
            ->orderBy('id', 'DESC')
            ->findAll();


        if (empty($orders)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No orders found',

            ]);
        }

        // Collect order details for each order
        $allOrderDetails = [];

        foreach ($orders as $key => $order) {
            $details = $orderDetailsModel->where('order_id', $order['order_id'])->findAll();
            $orders[$key]['variants'] = $details;
            $orders[$key]['customer'] = $this->custAddress->where('address_id', $order['address_id'])->first();
        }

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Customer orders fetched successfully',
            'orders' => $orders,
            // 'order_details' => $allOrderDetails,
        ]);
    }

    public function shopdashboard($id)
    {
        $ordersModel = $this->shopOrders;
        $orderDetailsModel = $this->ordersDetials;
        $pending = $ordersModel
            ->where('shop_id', $id)
            ->where('order_status', 1)
            ->countAllResults();

        $totalord = $ordersModel
            ->where('ordered_date', date('Y-m-d'))
            ->where('shop_id', $id)
            ->countAllResults();

        $process = $ordersModel
            ->where('shop_id', $id)
            ->where('ordered_date', date('Y-m-d'))
            ->where('order_status', 'PRS')
            ->countAllResults();

        $complete = $ordersModel
            ->where('shop_id', $id)
            ->where('ordered_date', date('Y-m-d'))
            ->where('order_status', 'COM')
            ->countAllResults();

        $revenue = $ordersModel
            ->where('shop_id', $id)
            ->where('ordered_date', date('Y-m-d'))
            ->where('order_status', 'COM')
            ->selectSum('amount')
            ->first();

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Customer orders fetched successfully',
            'pending' => $pending,
            'process' => $process,
            'totalorder' => $totalord,
            'completed' => $complete,
            'revenue' => (int) $revenue['amount'] ?? 0,
        ]);


    }


public function orderUpdate(int $id)
{
    $ordersModel = $this->shopOrders;
    $data = $this->request->getPost();
    // Find record either by order_id or direct id
    $order = $ordersModel->where('order_id', $id)->orWhere('id', $id)->first();

    if (!$order) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Order not found'
        ]);
    }

    // Update based on actual DB id
    $ordersModel->update($order['id'], $data);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Order updated successfully',
        'updated_id' => $order['id'],
        'original_input' => $id,
        'data' => $data
    ]);
}




    public function product_Var($prod_id)
    {
        $products = $this->adminmodel->products();
        $product_var = $this->model->product_var();
        
        $data = []; 

        $product = $products->where('id', $prod_id)->first();
        $details = $product_var->where('prod_id', $prod_id)->where('off', 1)->findAll();
        
        $data= [
            'product' => $product,
            'variants' => $details,
        
        ];


        return $this->response->setJSON([
            'status' => true,
            'message' => 'Product variants fetched successfully',
            'data' => $data,
        ]); 
    }

    public function off_delete($seg, $id)
    {
        $products    = $this->adminmodel->products();
        $product_var = $this->model->product_var();

        if ($seg == 'variant') {
            $model = $product_var;
        } elseif ($seg == 'product') { 
            $model = $products;
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid segment passed'
            ]);
        }

        $model->update($id, [
            'status'     => 0,
            'off'        => 0,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => ucfirst($seg) . ' deleted successfully'
        ]);
    }













































































    public function index()
    {
        echo 'Go Fresha API';
    }
























    public function ordertest()
    {
        $data = [
            'order_id' => 'ORD12345',
            'user_id' => 101,
            'amount' => 500.75,
            'receiver_name' => 'John Doe',
            'shipping_address' => '123 Main Street',
            'receiver_phone_no' => '9876543210',
            'state' => 'Karnataka',
            'zip' => '560001',
            'country' => 'India',
            'payment_method' => 'COD',
            'payment_status' => 'UNPAID',
            'transaction_id' => 'TXN987654',
            'city' => 'Bangalore',
            'discount' => 50.00,
            'deliveryFee' => 40.00,
            'gstfee' => 18.00,
            'platformfee' => 10.00,
            'ordered_date' => '2025-08-25',
            'delivery_datetime' => '2025-08-25 15:30:00',
            'delivery_status' => 0,
            'order_status' => 1,
            'invoice_no' => 'INV2025001',
            'invoice_date' => '2025-08-25',
            'status' => 1,
        ];
        $d = $this->orderPasser($data);
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Order placed successfully',
            'data' => $d,
        ]);
    }
    public function orderPasser($order)
    {
        $data = [
            'shop_id' => $this->shop_id ?? 'N/A',
            'order_id' => $order['order_id'] ?? 'N/A',
            'user_id' => $order['user_id'] ?? 'N/A',
            'receiver_name' => $order['receiver_name'] ?? 'N/A',
            'city' => $order['city'] ?? 'N/A',
            'transaction_id' => $order['transaction_id'] ?? 'NTX',
            'discount' => $order['discount'] ?? 'N/A',
            'gstfee' => $order['gstfee'] ?? 'N/A',
            'deliveryFee' => $order['deliveryFee'] ?? 'N/A',
            'platformfee' => $order['platformfee'] ?? 'N/A',
            'amount' => $order['amount'] ?? 'N/A',
            'ordered_date' => $order['ordered_date'] ?? 'N/A',
            'invoice_no' => $order['invoice_no'] ?? 'N/A',
            'invoice_date' => $order['invoice_date'] ?? 'N/A',
        ];
        $url = $this->sup_admin['url'] . 'get-orders';
        $pass = $this->postApi($url, $data);
        return $pass;
    }

    public function postApi($url, $data)
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
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                'X-Api: Bearer ' . $this->sup_admin['key'],
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

        return $result;
    }
}