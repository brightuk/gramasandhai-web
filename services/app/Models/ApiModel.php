<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiModel extends Model
{
    protected $table = ''; // Default table name
    protected $primaryKey = '';           // Default primary key
    protected $allowedFields = '';

    private $orderFields = ['id','order_id','shop_id','user_id','amount','shipping_address','city','receiver_phone_no','address_id','order_status','delivery_status','platformfee','gstfee','discount','deliveryFee','payment_method','transaction_id','transaction id','invoice_no','invoice_date','ordered_date','time_slot','delivery_info','order_notes','delivery_date','status','created_at'];
    private $orderDetailsFields = ['id', 'ord_tb_id', 'order_id', 'prod_id', 'prod_name', 'prod_price', 'weight', 'imagename', 'prod_qty'];

    private $customerRegFields = ['user_id', 'mobile_no', 'otp', 'is_verified', 'token', 'status', 'created_at', 'updated_at'];
    private $addressfields = ['cust_id', 'name', 'street_address', 'phone_no', 'city', 'state', 'pincode', 'country', 'pr_address', 'address_id', 'status'];

    private $productsFieldt = ['id', 'shop_id', 'prod_name', 'qty_type', 'tax_id', 'fssai_no', 'category_id', 'subcategory_id','disc_value','disc_type', 'is_variant','prod_label', 'prod_price', 'prod_type', 'manufacturer', 'made_in', 'return_status', 'cancelable_status', 'cod_allowed', 'total_quantity', 'main_image', 'other_images', 'size_chart', 'description', 'shipping_policy', 'status', 'date_added'];
    private $products_varFieldt = ['id', 'prod_id', 'measure', 'price', 'disc_type', 'disc_price', 'stock', 'status', 'sku_code', 'hsn_code', 'variant_image'];
  
    private $postsfield = ['shop_id', 'title', 'content', 'url','image','status','created_at'];


    public function tables(string $tableName, string $id, array $allowedFields)
    {
        $this->table = $tableName;
        $this->primaryKey = $id; // Set the primary key
        $this->allowedFields = $allowedFields;
    }

    public function custometable(string $tableName, string $id, array $allowedFields)
    {
        $this->table = $tableName;
        $this->primaryKey = $id; // Set the primary key
        $this->allowedFields = $allowedFields;

        return $this;
    }
    public function customers()
    {
        return $this->custometable('customers', 'id', $this->customerRegFields);
    }
    public function custAddress()
    {
        return $this->custometable('cust_address', 'address_id', $this->addressfields);
    }
    public function shopOrders()
    {
        return $this->custometable('orders', 'id', $this->orderFields);
    }
    public function ordersDetials()
    {
        return $this->custometable('order_details', 'id', $this->orderDetailsFields);
    }

    public function states()
    {
        $this->table = 'states';
        $this->primaryKey = 'id';
        $this->allowedFields = ['state', 'status'];
    }

    public function district()
    {
        $this->table = 'district ';
        $this->primaryKey = 'id';
        $this->allowedFields = ['state_id', 'district_name', 'status'];
    }


    public function city()
    {
        $this->table = 'places ';
        $this->primaryKey = 'id';
        $this->allowedFields = ['state_id', 'state_name', 'district_name', 'district_id', 'city_name', 'status'];
    }

    public function shop()
    {
        $this->table = 'ecom_shop';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'shop_id', 'shop_name', 'url_name', 'shop_logo', 'shop_images', 'owner_name', 'email', 'shop_url', 'category_id', 'qr_img', 'discount', 'state_id', 'district_id', 'city_id', 'shop_address', 'pincode', 'shop_phone', 'latitude', 'longitude', 'status', 'created_at'];
    }

    public function banner()
    {
        $this->table = 'banner';
        $this->primaryKey = 'id';
        $this->allowedFields = ['shop_id', 'shop_name', 'label_name', 'banner_link', 'city_id', 'image', 'status', 'enable_status', 'created_at'];
    }

    public function categories()
    {
        $this->table = 'categories';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'label_name', 'icon', 'url_name', 'status'];
    }

    public function orders()
    {
        $this->table = 'orders';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'shop_id', 'order_id', 'user_id', 'receiver_name', 'city', 'transaction_id', 'discount', 'gstfee', 'deliveryFee', 'platformfee', 'amount', 'created_at', 'invoice_no', 'invoice_date', 'created_at', 'updated_at'];
    }

    public function prodCategory()
    {
        $this->table = 'ecom_categories';
        $this->primaryKey = 'category_id ';
        $this->allowedFields = ['category_id ', 'category_name', 'category_subtitle', 'category_image', 'position', 'status'];
    }


    public function selectCategory()
    {
        $this->table = 'ecom_select_category';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'category_id', 'shop_id', 'chk', 'status'];
    }
    public function selectSubCategory()
    {
        $this->table = 'ecom_select_subcategory';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'subcategory_id', 'category_id', 'shop_id', 'chk', 'status'];
    }


    public function shopBanner()
    {
        $this->table = 'shopbanner';
        $this->primaryKey = 'id';
        $this->allowedFields = ['shop_id', 'label_name', 'banner_link', 'image', 'status', 'enable_status', 'created_at'];
    }



    public function feeManage()
    {
        $this->table = 'fee_manage';
        $this->primaryKey = 'id';
        $this->allowedFields = ['id', 'shop_id', 'name', 'code', 'percentage', 'amount', 'status', 'op_select'];
    }
    public function payment()
    {
        $this->table = 'payment';
        $this->primaryKey = 'id';
        $this->allowedFields = ['shop_id', 'pay_phoneno', 'upi_id', 'pay_qrcode', 'status', 'enable_status'];
    }

    public function posts()
    {
        return $this->custometable('posts', 'id', $this->postsfield);
    }

    public function products()
    {
        return $this->custometable('products', 'id', $this->productsFieldt);
    }
    public function product_var()
    {
        return $this->custometable('product_variants', 'id', $this->products_varFieldt);
    }
























    public function filterOrders($dateFilter = null, $shopId = null, $startDate = null, $endDate = null)
    {
        $builder = $this->db->table('orders');

        // Handle dateFilter options
        if ($dateFilter === 'weekly') {
            // Compare ordered_date using YEARWEEK (mode 1 = ISO-8601 week)
            $builder->where("YEARWEEK(ordered_date, 1) =", "YEARWEEK(CURDATE(), 1)", false);
        } elseif ($dateFilter === 'monthly') {
            // Current year and month
            $builder->where("YEAR(ordered_date)", date('Y'));
            $builder->where("MONTH(ordered_date)", date('m'));
        } elseif ($dateFilter === 'quarterly') {
            // Example: match current quarter
            $currentQuarter = ceil(date('m') / 3);
            $builder->where("YEAR(ordered_date)", date('Y'));
            $builder->where("QUARTER(ordered_date)", $currentQuarter);
        } elseif ($dateFilter === 'yearly') {
            $builder->where("YEAR(ordered_date)", date('Y'));
        }

        // Filter by shop ID if provided
        if (!empty($shopId)) {
            $builder->where('shop_id', $shopId);
        }

        // Filter by start and end date if provided (inclusive)
        if (!empty($startDate)) {
            $builder->where('ordered_date >=', $startDate);
        }
        if (!empty($endDate)) {
            $builder->where('ordered_date <=', $endDate);
        }

        return $builder->get()->getResultArray();
    }

}
