<?php
namespace App\Controllers;
use CodeIgniter\Controller;

class Authenticated extends BaseController
{
    protected $session;
    protected $router;
    public function __construct()
    {
        $this->session = session();
        $this->router = service('router');
        $controller = class_basename($this->router->controllerName());
        $method = $this->router->methodName();
        $currentRoute = $controller . '/' . $method;
        $excludedRoutes = [
            'AdminController/login',  
        ];
        $isLoggedIn = $this->session->get('loggedIn');
        if (empty($isLoggedIn) && !in_array($currentRoute, $excludedRoutes, true)) {
            //Inaconstructoryoucan't"return"aresponse;senditandexit
            echo '<script>window.location.href= "' . base_url() . '";</script>';
            die();
        }
    }
}
