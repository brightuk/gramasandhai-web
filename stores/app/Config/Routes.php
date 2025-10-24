<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingController::index');
$routes->get('about-us-privacy-policy', 'LandingController::about_us_privacy_policy');
$routes->get('orderhistory', 'LandingController::orderhistory');
$routes->get('login', 'StoresController::lo');
$routes->get('notification', 'Home::notification');


$routes->get('(:segment)', 'StoresController::shopHome/$1');

$routes->post('account/registaration', 'StoresController::registrationProcess');
$routes->post('account/regVerify', 'StoresController::regVerify');

$routes->match(['get', 'post'], 'customer/address', 'StoresController::saveAddress');
$routes->get('getaddress/(:num)', 'StoresController::getCustomerAddress/$1');
$routes->get('address/delete/(:num)', 'StoresController::deleteAddress/$1');
$routes->post('address/update', 'StoresController::updateAddress');
$routes->get('edit/getaddress/(:num)', 'StoresController::getaddressEdit/$1');



$routes->group('(:num)/', function ($routes) {
    $routes->post('orderplaced/(:num)', 'StoresController::orderplaced/$1/$2');
});

$routes->group('(:segment)/', function ($routes) {
    $routes->post('orderplaced/(:num)', 'StoresController::orderplaced/$1/$2');

    $routes->get('offers', 'StoresController::offerPage/$1');
    // $routes->get('offers/(:segment)', 'StoresController::offersFilter/$2');
    $routes->get('offers/products', 'StoresController::offersProducts');

    $routes->get('products', 'StoresController::productShow/$1');
    $routes->get('products/(:num)/(:num)', 'StoresController::productFilter/$1/$2/$3');
    $routes->get('search-products/(:num)/(:num)', 'StoresController::searchProduct/$2/$3');
    $routes->get('cart', 'StoresController::cart/$1');
    $routes->get('checkout', 'StoresController::checkout/$1');
    $routes->get('orderHistoryPage/(:num)', 'StoresController::orderHistoryPage/$1');
    $routes->get('category/(:num)', 'StoresController::categoryFilter/$2');


    

});



// $routes->get('/', 'Home::index');
// $routes->get('cart', 'Home::cart');
// $routes->get('orderpage', 'Home::orderpage');
// $routes->get('addAddress', 'Home::addAddress');
// $routes->get('success', 'Home::success');
// $routes->get('categories', 'Home::categories');
// $routes->get('productShow/(:num)/(:num)', 'Home::productShow/$1/$2');
// $routes->get('productShow/(:num)/(:num)/(:num)', 'Home::productShow/$1/$2/$3');
// $routes->get('productShow', 'Home::productShow');
// $routes->post('registaration', 'Home::registrationProcess');
// $routes->post('regVerify', 'Home::regVerify');

// $routes->match(['get', 'post'],'address', 'Home::saveAddress');
// $routes->get('getaddress', 'Home::getCustomerAddress');
// $routes->get('address/delete/(:num)', 'Home::deleteAddress/$1');
// $routes->post('address/update', 'Home::updateAddress');
// $routes->get('edit/getaddress/(:num)', 'Home::getaddress/$1');


