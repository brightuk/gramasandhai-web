<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->match(['get', 'post'], '/', 'AdminController::login');
$routes->get('dashboard', 'AdminController::dashboard');
$routes->get('logout', 'AdminController::logout');
$routes->get('location/add', 'AdminController::addLocation');
$routes->post('add_location/(:segment)', 'AdminController::location_add/$1');
$routes->match(['get', 'post'], 'shop/add', 'AdminController::addShop');
$routes->get('shop/list', 'AdminController::shop_list');
$routes->get('shop/management', 'AdminController::shopManagement');

$routes->match(['get', 'post'], 'banner/add', 'AdminController::addBanner');
$routes->get('banner/management', 'AdminController::bannerManagement');
$routes->get('banner_edit/(:num)', 'AdminController::bannerEdit/$1');
$routes->get('action/(:segment)/(:segment)/(:num)', 'AdminController::enable/$1/$2/$3');
$routes->get('(:segment)/hide/(:num)', 'AdminController::hider/$1/$2');
$routes->get('shop/edit/(:num)', 'AdminController::shopEdit/$1');

$routes->match(['get', 'post'], 'posts/add', 'AdminController::web_posts');
$routes->get('posts', 'AdminController::posts');
$routes->get('send/post/(:num)', 'AdminController::sendPost/$1');


$routes->get('post-resend', 'AdminController::postResend');

$routes->get('notify', 'AdminController::notify');


$routes->get('order-list', 'AdminController::ordersList');
$routes->get('orders-filter', 'AdminController::ordersList');
$routes->post('orders-reports', 'AdminController::ordersReports');


// $routes->get('shop/(:num)', 'ShopController::shopPage/$1');

$routes->get('product/category/add', 'ShopController::addCategory');
$routes->get('addcategoriesRedirect', 'ShopController::addcategoriesRedirect');
$routes->get('product/category/list', 'ShopController::categoriespage');
$routes->get('categoriesRedirect', 'ShopController::categoriesRedirect');

$routes->get('product/editCategory/(:num)', 'ShopController::editcategoryPage/$1');
$routes->get('(:segment)/delete/(:num)', 'ShopController::hideAll/$1/$2');

$routes->get('(:segment)/position/(:segment)/(:num)', 'ShopController::updatePosition/$1/$2/$3');
$routes->get('back', 'ShopController::back');



$routes->get('product/subcategory/list', 'ShopController::subcategories');
$routes->get('product/subcategory/add', 'ShopController::addSubcategories');
$routes->get('addsubcatRedirect', 'ShopController::addsubcatRedirect');
$routes->get('product/editSubategory/(:num)', 'ShopController::editSubategoryPage/$1');
$routes->get('subcatRedirect', 'ShopController::editsubcatRedirect');


$routes->group('shop/(:num)', function ($routes) {
    $routes->get('/', 'ShopController::shopPage/$1');
    $routes->match(['get', 'post'], 'fee-manage', 'ShopController::feeManage/$1');
    $routes->get('(:segment)/second_ch/(:num)', 'ShopController::second_ch/$1/$2/$3');
    $routes->get('(:segment)/action/(:num)', 'ShopController::feeUpdate/$1/$2/$3');
    $routes->match(['get', 'post'], 'categories', 'ShopController::shopProCategories/$1');
    $routes->match(['get', 'post'], 'subcategories', 'ShopController::shopProSubCategories/$1');

    $routes->get('product/add', 'ShopController::addProduct/$1');
    $routes->get('products', 'ShopController::products/$1');
    $routes->post('saveProduct', 'ShopController::saveProduct/$1');
    $routes->get('editProduct/(:num)', 'ShopController::editProduct/$1/$2');

    $routes->get('addoffer', 'ShopController::addoffer/$1');
    $routes->post('addoffer', 'ShopController::addoffersave/$1');
    $routes->get('offers', 'ShopController::offers/$1');
    $routes->get('offer/edit/(:num)', 'ShopController::editoffer/$1/$2');

    $routes->match(['get', 'post'], 'addPaymentDetails', 'ShopController::adddetails/$1');
    $routes->get('payment_detail_list', 'ShopController::payment_detail_list/$1');
    $routes->get('shopBanner', 'ShopController::shopBanner/$1');
    $routes->match(['get', 'post'], 'shopBannerAdd', 'ShopController::shopBannerAdd/$1');
    $routes->match(['get', 'post'], 'bulk-upload', 'ShopController::importData/$1');




});







$routes->get('areaRange-price', 'ShopController::areaRange_price');



$routes->get('dash', 'ShopController::dash');

$routes->get('orders_history', 'ShopController::orderHistory');





$routes->get('position/(:segment)/(:num)', 'ShopController::updatePosition/$1/$2');




// $routes->get('addproductview', 'ShopController::addProductView');c

// $routes->get('productsview', 'ShopController::productsview');
// $routes->get('productsProcess', 'ShopController::productLoadProcess');
// $routes->get('product-edit/(:num)', 'ShopController::editProduct/$1');
// $routes->get('edit-product/(:num)', 'ShopController::editProductpage/$1');

// $routes->post('categories_add', 'ApiController::addCategory');
// $routes->post('subcategories', 'ApiController::subcategories');
// $routes->post('products', 'ApiController::products');
// $routes->post('productshow', 'ApiController::productshow');









