<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingController::index');
$routes->get('content/privacy-policy', 'LandingController::privacy_policy');
$routes->get('content/refund-policy', 'LandingController::refund_policy');
$routes->get('content/cancellation-policy', 'LandingController::cancellation_policy');
$routes->get('content/cookies-policy', 'LandingController::cookies_Policy');
$routes->get('content/terms-of-service', 'LandingController::terms_of_service');
$routes->get('content/about-us', 'LandingController::about_us');

$routes->get('join/partner-with-us', 'LandingController::partner_with_us');
$routes->post('join/check-pending-shop', 'LandingController::checkPendingShop');
$routes->post('join/partner-with-us', 'LandingController::partner_JoinProcess');
$routes->get('join/register_completed', 'LandingController::regCompleted');


$routes->get('orderhistory', 'LandingController::orderhistory');
$routes->get('login', 'StoresController::lo');




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



