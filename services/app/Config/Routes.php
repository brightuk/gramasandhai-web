<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ApiController::index');
$routes->post('login', 'ApiController::login');
$routes->post('shop/login', 'ApiController::shoplogin');

$routes->get('locations', 'ApiController::locations');
$routes->post('add_location/(:segment)', 'ApiController::location_add/$1');

$routes->match(['get', 'post'], 'add_shop', 'ApiController::add_shop');
$routes->get('shop_list', 'ApiController::shop_list');
$routes->get('shop/edit/(:num)', 'ApiController::shopEdit/$1');

$routes->match(['get', 'post'], 'posts', 'FirebaseController::web_posts');
$routes->get('posts_list', 'ApiController::postsList');


$routes->get('sendPost/(:num)', 'FirebaseController::sendPost/$1');

$routes->get('send-notification', 'FirebaseController::sendNotification');



$routes->match(['get', 'post'], 'banner_add', 'ApiController::addBanner');
$routes->get('banners', 'ApiController::bannerManagement');
$routes->get('banners/(en)', 'ApiController::bannerManagement/$1');

$routes->get('banner/(:num)', 'ApiController::bannerEdit/$1');

$routes->get('(:segment)/enable/(:num)', 'ApiController::enable/$1/$2');
$routes->get('(:segment)/hide/(:num)', 'ApiController::hider/$1/$2');

$routes->get('action/(:segment)/(:segment)/(:num)', 'ApiController::action/$1/$2/$3');
$routes->get('categories', 'ApiController::categories');

$routes->get('location/(:num)/(:num)', 'ApiController::locationbyshop/$1/$2');

$routes->get('category_filter/(:segment)', 'ApiController::categoryFilter/$1');

$routes->post('get-orders', 'ApiController::getOrders');

$routes->get('order-list', 'ApiController::ordersList');

$routes->post('product_add_category', 'ShopAdminController::productAddCategory');
$routes->get('product_categories', 'ShopAdminController::productCategories');
$routes->get('product_editCategory/(:num)', 'ShopAdminController::productEditCategory/$1');

$routes->get('product_subcategories', 'ShopAdminController::subcategories');
$routes->get('addSubcategoriesPage', 'ShopAdminController::addSubcategoriesPage');
$routes->post('addSubCategory', 'ShopAdminController::addSubCategory');
$routes->get('product_editSubCategory/(:num)', 'ShopAdminController::editSubCategory/$1');
$routes->get('(:segment)/delete/(:num)', 'ShopAdminController::hider/$1/$2');

$routes->get('(:segment)/position/(:segment)/(:num)', 'ShopAdminController::updatePosition/$1/$2/$3');

$routes->get('(:segment)/enabled/(:num)', 'ShopAdminController::enable/$1/$2');

$routes->get('shops', 'StoresApiController::shop_list');
$routes->get('allvariants', 'StoresApiController::allvariants');

// FrontEnd
$routes->post('registrationProcess', 'StoresApiController::registrationProcess');
$routes->post('regVerify', 'StoresApiController::regVerify');
$routes->post('address', 'StoresApiController::saveAddressApi');
$routes->get('address/(:num)', 'StoresApiController::getCustomerAddress/$1');
$routes->get('address_edit/(:num)', 'StoresApiController::editCustomerAddress/$1');
$routes->get('orders_history/(:segment)', 'StoresApiController::orderHistory/$1');

$routes->post('test', 'FirebaseAuthController::verifyOtp');



$routes->group('store/(:num)/', function ($routes) {
    $routes->get('all', 'StoresApiController::all/$1');
    $routes->get('productsfilter/(:num)/(:num)', 'StoresApiController::productsfilter/$1/$2/$3');
    $routes->get('productsfilter/(:num)/(:num)/(:num)', 'StoresApiController::productsfilter/$1/$2/$3/$4');
    $routes->get('shop_cash_details', 'StoresApiController::shop_cashDetails/$1');

    $routes->post('order/(:num)', 'StoresApiController::orderProcess/$1/$2');
    $routes->get('orders_history', 'StoresApiController::totalOrderHistory');
    $routes->get('catesub', 'StoresApiController::catesub/$1');
    $routes->get('random_products', 'StoresApiController::randomProducts/$1');

    $routes->get('offersFilter/(:num)', 'StoresApiController::offersFilter/$1/');
    $routes->get('offers/(:num)/(:num)', 'StoresApiController::offers/$1/$2');
    $routes->get('categoryFilter/(:num)', 'StoresApiController::categoryFilter/$1/$2');
    $routes->get('(:segment)/delete/(:num)', 'ShopAdminController::hider/$1/$2');



});

$routes->group('store/(:segment)', function ($routes) {
    $routes->get('/', 'StoresApiController::findShop/$1');
    $routes->get('offers', 'StoresApiController::offers/$1');
    $routes->get('offer/products', 'StoresApiController::offerProducts/$1');


});





$routes->group('shop/(:num)', function ($routes) {

    $routes->match(['get', 'post'], 'fee-manage', 'ShopAdminController::feeManage/$1');
    $routes->get('(:segment)/second_ch/(:num)', 'ShopAdminController::second_ch/$1/$2/$3');
    $routes->get('(:segment)/enableInall', 'ShopAdminController::enableInALL/$1/$2');
    $routes->get('category_subcategory', 'ShopAdminController::category_subcategory/$1');
    $routes->post('category_add', 'ShopAdminController::categoryAdd/$1');
    $routes->post('subcategory_add', 'ShopAdminController::subCategoryAdd/$1');

    $routes->get('products', 'ShopAdminController::products/$1');
    $routes->post('productUpdate/(:num)', 'ShopAdminController::productUpdate/$2');
    $routes->get('addproduct', 'ShopAdminController::addProductPage/$1');
    $routes->post('addproduct', 'ShopAdminController::addUpProduct/$1');
    $routes->get('editProduct/(:num)', 'ShopAdminController::editProductPage/$1/$2');


    $routes->get('filterCategory_Sub/', 'ShopAdminController::filterCategory_Sub/$1');

    $routes->post('offersadmin', 'ShopAdminController::offersAdmin/$1');
    $routes->get('offerslist', 'ShopAdminController::offerslist/$1');
    $routes->get('offer/(:num)', 'ShopAdminController::offerEdit/$1/$2');


    $routes->match(['get', 'post'], 'paymentdetials', 'ShopAdminController::paymentdetials/$1');

    $routes->get('(:segment)/enabled/(:num)', 'ShopAdminController::enable/$1/$2/$3');
    $routes->match(['get', 'post'], 'shopBannerAdd', 'ShopAdminController::shopBannerAdd/$1');
    $routes->get('shopBanner', 'ShopAdminController::shopBanner/$1');
    $routes->post('import_data', 'ShopAdminController::importData/$1');
    $routes->get('orders', 'ShopAdminController::shopOrders/$1');
    $routes->get('dashboard', 'ShopAdminController::shopdashboard/$1');
    $routes->post('orderUpdate/(:num)', 'ShopAdminController::orderUpdate/$2');
    $routes->get('product/(:num)', 'ShopAdminController::product_Var/$2');









    $routes->get('(:segment)/delete/(:num)', 'ApiController::hideR/$1/$2');
    $routes->get('(:segment)/hide/(:num)', 'ShopAdminController::shophideR/$2/$3');





    $routes->post('registration', 'ApiHome::registrationProcess');
    $routes->post('reg', 'ApiHome::regVerify');


    $routes->get('(:segment)/enable/(:num)', 'ApiController::enable/$1/$2');

    $routes->post('regVerify', 'ApiController::regVerify');
    $routes->post('testform', 'ApiController::orderProcess');


    // $routes->get('api/offers/(:any)/(:any)', 'ApiController::offers/$1/$2');






    $routes->match(['get', 'post'], 'ordertest', 'ApiController::ordertest');




});





