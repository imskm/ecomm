<?php

/**
 * ------------------------------------------------------------------
 * Custom routes for the application
 * ------------------------------------------------------------------
 *
 * This page has user specif routes
 */



/**
 * ------------------------------------------------------------------
 * The default routes
 * ------------------------------------------------------------------
 * This are the default reoutes to get you started
 *
 * @Note: Don't suffix the word "Controller" in controller name
 *  as done below in ["controller" => "Home"]
 */
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('auth/{action}', ['controller' => 'Auth', 'namespace' => 'Auth']);


// // Product Routes

// $router->add('admin/product/index', ['controller' => 'Product', 'action' => 'index', 'namespace' => 'Admin']);
// $router->add('admin/product/create', ['controller' => 'Product', 'action' => 'create', 'namespace' => 'Admin']);
// $router->add('admin/product/store', ['controller' => 'Product', 'action' => 'store', 'namespace' => 'Admin']);


// // Product Size Routes

// $router->add('admin/product-size/store', ['controller' => 'ProductSize', 'action' => 'store', 'namespace' => 'Admin']);
// $router->add('admin/product-size/index', ['controller' => 'ProductSize', 'action' => 'index', 'namespace' => 'Admin']);


// // Product Image Routes

// $router->add('admin/product-image/store', ['controller' => 'ProductImage', 'action' => 'store', 'namespace' => 'Admin']);
// $router->add('admin/product-image/index', ['controller' => 'ProductImage', 'action' => 'index', 'namespace' => 'Admin']);


// // Color Routes

// $router->add('admin/color/index', ['controller' => 'Color', 'action' => 'index', 'namespace' => 'Admin']);
// $router->add('admin/color/create', ['controller' => 'Color', 'action' => 'create', 'namespace' => 'Admin']);
// $router->add('admin/color/store', ['controller' => 'Color', 'action' => 'store', 'namespace' => 'Admin']);


// // Sizes Routes

// $router->add('admin/size/index', ['controller' => 'Size', 'action' => 'index', 'namespace' => 'Admin']);
// $router->add('admin/size/create', ['controller' => 'Size', 'action' => 'create', 'namespace' => 'Admin']);
// $router->add('admin/size/store', ['controller' => 'Size', 'action' => 'store', 'namespace' => 'Admin']);

// // Category Routes

// $router->add('admin/category/index', ['controller' => 'Category', 'action'=>'index', 'namespace' => 'Admin']);
// $router->add('admin/category/create',['controller' => 'Category', 'action'=>'create', 'namespace' => 'Admin']);
// $router->add('admin/category/store',['controller' => 'Category', 'action'=>'store', 'namespace' => 'Admin']);



// $router->add('user/home/index', ['controller' => 'Home', 'action' => 'index', 'namespace' => 'User']);
// $router->add('admin/home/index', ['controller' => 'Home', 'action' => 'index', 'namespace' => 'Admin']);








$router->add('user', [
	'controller' 	=> 'Home',
	'action' 		=> 'index',
	'namespace' 	=> 'User'
]);
$router->add('user/{controller}', ['action' => 'index', 'namespace' => 'User']);
$router->add('user/{controller}/{action}', ['namespace' => 'User']);
$router->add('user/{controller}/{id:\d+}/{action}', ['namespace' => 'User']);

$router->add('admin', [
	'controller' 	=> 'Home',
	'action' 		=> 'index',
	'namespace' 	=> 'Admin'
]);
$router->add('admin/{controller}', ['action' => 'index', 'namespace' => 'Admin']);
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('admin/{controller}/{id:\d+}/{action}', ['namespace' => 'Admin']);

$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');
