<?php
use Bramus\Router\Router;

$router=new Router;
//users
$router->mount('/profile',function() use($router){
    $router->get('/',App\Controllers\Client\UserController::class.'@index');
    $router->get('{id}/edit',App\Controllers\Client\UserController::class.'@edit');
    $router->post('/update',App\Controllers\Client\UserController::class.'@update');
    $router->get('/editmk',App\Controllers\Client\UserController::class.'@changePasswordForm');
    $router->post('/updatemk',App\Controllers\Client\UserController::class.'@updatePassword');

 
});

$router->get('/',App\Controllers\Client\HomeController::class.'@index');

$router->get('{id}/probytype',App\Controllers\Client\HomeController::class.'@probytype');
$router->get('{id}/prodetail',App\Controllers\Client\HomeController::class.'@prodetail');
$router->get('shop',App\Controllers\Client\HomeController::class.'@shop');
$router->post('seach',App\Controllers\Client\HomeController::class.'@search');

//client

$router->get('/home',App\Controllers\Client\HomeController::class.'@index');
//custommer
$router->mount('/custommer',function() use($router){
    $router->get('/',App\Controllers\Client\CustommerController::class.'@index');
    $router->get('/store',App\Controllers\Client\CustommerController::class.'@store');
    $router->get('/create',App\Controllers\Client\CustommerController::class.'@create');
    $router->get('/edit',App\Controllers\Client\UserController::class.'@edit');
    $router->get('/update',App\Controllers\Client\CustommerController::class.'@update');
    $router->get('/delete',App\Controllers\Client\CustommerController::class.'@delete');
 
});
//cart
$router->get('/cart',App\Controllers\Client\CartController::class.'@listCart');
$router->post('/addcart',App\Controllers\Client\CartController::class.'@addCart');
$router->get('/cart/remove/{id}',App\Controllers\Client\CartController::class.'@removeCart');
$router->get('cart/update/{id}/{so_luong_dat}',App\Controllers\Client\CartController::class.'@updateCart');
//oder

$router->post('/order',App\Controllers\Client\OrderController::class.'@order');
$router->post('/order/add',App\Controllers\Client\OrderController::class.'@store');
$router->get('/order/list',App\Controllers\Client\OrderController::class.'@list');
$router->get('/{id}/order/detail',App\Controllers\Client\OrderController::class.'@detail');
$router->get('/{id}/order/huy',App\Controllers\Client\OrderController::class.'@huy');



//authenication
$router->get('/login',App\Controllers\Auth\AuthController::class.'@loginForm');
$router->get('/register',App\Controllers\Auth\AuthController::class.'@registerForm');
$router->post('/loginPost',App\Controllers\Auth\AuthController::class.'@login');
$router->post('/registerPost',App\Controllers\Auth\AuthController::class.'@register');
$router->post('/logout',App\Controllers\Auth\AuthController::class.'@logout');


//admin
$router->mount('/admins',function() use($router){
    $router->get('{id}/setrole',App\Controllers\Auth\AuthController::class.'@setrole');

    $router->get('/',App\Controllers\Admin\DashboardController::class.'@index');
    $router->get('/listUser',App\Controllers\Admin\UserController::class.'@index');

    //đơn hàng

    $router->mount('/order',function() use($router){
        $router->get('/',App\Controllers\Admin\OrderAdminController::class.'@index');
        $router->get('/{id}/detail',App\Controllers\Admin\OrderAdminController::class.'@detail');
        $router->get('/{id}/confirm',App\Controllers\Admin\OrderAdminController::class.'@confirm');

        $router->get('/ship',App\Controllers\Admin\OrderAdminController::class.'@ship');
        $router->get('/{id}/confirm/ship',App\Controllers\Admin\OrderAdminController::class.'@confirmShip');

        $router->get('/complate',App\Controllers\Admin\OrderAdminController::class.'@complate');
        $router->get('/fail',App\Controllers\Admin\OrderAdminController::class.'@fail');
        $router->get('/shipnow',App\Controllers\Admin\OrderAdminController::class.'@shipnow');
        $router->get('/{id}/confirm/complate',App\Controllers\Admin\OrderAdminController::class.'@confirmComplate');
        $router->get('/{id}/confirm/shipnow',App\Controllers\Admin\OrderAdminController::class.'@confirmShipNow');

    });
  

    

    
    //danh muc
    $router->mount('/categories',function() use($router){

    $router->get('/',App\Controllers\Admin\CategoriesController::class.'@index');
    $router->get('/create',App\Controllers\Admin\CategoriesController::class.'@create');
    $router->post('/store',App\Controllers\Admin\CategoriesController::class.'@store');
    $router->get('/{id}/edit',App\Controllers\Admin\CategoriesController::class.'@edit');
    $router->post('/{id}/update',App\Controllers\Admin\CategoriesController::class.'@update');
    $router->get('/{id}/delete',App\Controllers\Admin\CategoriesController::class.'@delete');
    });

    //san pham
    $router->mount('/products',function() use($router){

        $router->get('/',App\Controllers\Admin\ProductController::class.'@index');
        $router->get('/create',App\Controllers\Admin\ProductController::class.'@create');
        $router->post('/store',App\Controllers\Admin\ProductController::class.'@store');
        $router->get('/{id}/edit',App\Controllers\Admin\ProductController::class.'@edit');
        $router->post('/{id}/update',App\Controllers\Admin\ProductController::class.'@update');
        $router->post('/delete',App\Controllers\Admin\ProductController::class.'@delete');
        });
});




$router->run();