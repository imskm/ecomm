<?php

namespace App\Controllers\User;

use App\Middlewares\UserAuthMiddleware;
use App\Support\Authentication\Auth;
use Fantom\Controller;

/**
 * HomeController class
 */
class HomeController extends Controller
{
	protected function index()
	{
		$this->view->render('User/Home/index.php');
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}