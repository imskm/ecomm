<?php

namespace App\Controllers;

use App\EComm\Repositories\ProductImageRepository;
use App\EComm\Repositories\ProductRepository;
use App\Middlewares\GuestMiddleware;
use Fantom\Controller;

/**
 * Home controller
 */
class HomeController extends Controller
{
	public function index()
	{
		$products = ProductRepository::recent(get_page())->get();
		$this->view->render('Home/index.php',[
		 	"products" => $products,
		 ]);
	}
}