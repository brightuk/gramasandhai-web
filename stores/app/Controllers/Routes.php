<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('cart', 'Home::cart');
$routes->get('orderpage', 'Home::orderpage');
$routes->get('addAddress', 'Home::addAddress');
$routes->post('orderplaced/(:num)', 'Home::orderplaced/$1');
$routes->get('success', 'Home::success');
$routes->get('categories', 'Home::categories');
$routes->get('productShow/(:num)/(:num)', 'Home::productShow/$1/$2');
$routes->get('productShow/(:num)/(:num)/(:num)', 'Home::productShow/$1/$2/$3');
$routes->get('productShow', 'Home::productShow');
$routes->post('registaration', 'Home::registrationProcess');
$routes->post('regVerify', 'Home::regVerify');
$routes->get('orderHistoryPage/(:num)', 'Home::orderHistoryPage/$1');
$routes->get('category/(:segment)', 'Home::categoryFilter/$1');
$routes->get('offers', 'Home::offers');
$routes->get('offers/(:segment)', 'Home::offersFilter/$1');
$routes->match(['get', 'post'],'address', 'Home::saveAddress');
$routes->get('getaddress', 'Home::getCustomerAddress');
$routes->get('address/delete/(:num)', 'Home::deleteAddress/$1');
$routes->post('address/update', 'Home::updateAddress');
$routes->get('edit/getaddress/(:num)', 'Home::getaddress/$1');





