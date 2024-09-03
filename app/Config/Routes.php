<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes) {
    
    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->get("users", "User::index", ['filter' => 'authFilter']);
    $routes->post("users/(:num)", "User::update/$1", ['filter' => 'authFilter']);  // pasar parametro por url 
    $routes->post("users", "User::updatejson", ['filter' => 'authFilter']);  // pasar parametro por url 
    /*
    $routes->get('client', 'Client::index');
    $routes->post('client', 'Client::store');
    $routes->get('client/(:num)', 'Client::show/$1');
    $routes->post('client/(:num)', 'Client::update/$1');
    $routes->delete('client/(:num)', 'Client::destroy/$1');
    */
});
