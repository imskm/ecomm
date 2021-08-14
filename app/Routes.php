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

$router->add('admin/product/index', ['controller' => 'Product', 'action' => 'index', 'namespace' => 'Admin']);
$router->add('admin/product/create', ['controller' => 'Product', 'action' => 'create', 'namespace' => 'Admin']);
$router->add('admin/product/store', ['controller' => 'Product', 'action' => 'store', 'namespace' => 'Admin']);

$router->add('admin/product-size/store', ['controller' => 'ProductSize', 'action' => 'store', 'namespace' => 'Admin']);
$router->add('admin/product-size/index', ['controller' => 'ProductSize', 'action' => 'index', 'namespace' => 'Admin']);


$router->add('admin/product-image/store', ['controller' => 'ProductImage', 'action' => 'store', 'namespace' => 'Admin']);
$router->add('admin/product-image/index', ['controller' => 'ProductImage', 'action' => 'index', 'namespace' => 'Admin']);

$router->add('admin/product-color/index', ['controller' => 'ProductColor', 'action' => 'index', 'namespace' => 'Admin']);
$router->add('admin/product-color/store', ['controller' => 'ProductColor', 'action' => 'store', 'namespace' => 'Admin']);


$router->add('user/home/index', ['controller' => 'Home', 'action' => 'index', 'namespace' => 'User']);
$router->add('admin/home/index', ['controller' => 'Home', 'action' => 'index', 'namespace' => 'Admin']);








/*
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
*/