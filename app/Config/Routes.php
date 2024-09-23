<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 //$routes->get('/', 'Home::index');


// $routes->group("api", function ($routes) {
    
//     $routes->post("register", "Register::index");
//     $routes->post("login", "Login::index");
//     $routes->get("users", "User::index", ['filter' => 'authFilter']);
//     $routes->post("users", "User::updatejson", ['filter' => 'authFilter']);  // pasar parametro por url 
//     /*
//     $routes->get('client', 'Client::index');
//     $routes->post('client', 'Client::store');
//     $routes->get('client/(:num)', 'Client::show/$1');
//     $routes->post('client/(:num)', 'Client::update/$1');
//     $routes->delete('client/(:num)', 'Client::destroy/$1');
//     */
// });

$routes->group("api", function ($routes) {
    
    $routes->get("services", "Services::index"); // read all
    $routes->get("services/([0-9a-fA-F\-]{36})", "Services::find/$1"); // read one
    $routes->post('services', 'Services::create'); // create
    $routes->put('services/([0-9a-fA-F\-]{36})', 'Services::updateRestful/$1'); // update restful
    $routes->put('services', 'Services::update'); // update body
  
});

/*
$routes->set404Override(function(){
    // Send a JSON response for undefined routes or methods
    return \Config\Services::response()->setJSON([
        'status' => 'error',
        'descripcion' => 'método no encontrado'
    ])->setStatusCode(404);
});
*/

/*
$routes->set404Override(function()
{
    echo json_encode(array(
        "status"=>false,
        "err_code"=>404,
        "err_message"=>"Route not found"
    ));
});
*/

// In app/Config/Routes.php
// Would execute the show404 method of the App\Errors class
//$routes->set404Override('App\Errors::show404');

// Will display a custom view.
/*
$routes->set404Override(static function () {
    // If you want to get the URI segments.
    //$segments = request()->getUri()->getSegments();

    //return view('my_errors/not_found.html');

    echo json_encode(array(
        "status"=>false,
        "err_code"=>404,
        "err_message"=>"Route not found"
    ));

});
*/