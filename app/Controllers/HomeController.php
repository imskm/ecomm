<?php

namespace App\Controllers;

use App\Middlewares\GuestMiddleware;
use Fantom\Controller;

/**
 * Home controller
 */
class HomeController extends Controller
{
	protected function index()
	{
		$this->view->render('welcome.php');
	}


	protected function before()
	{
		return (new GuestMiddleware)();
	}
}
