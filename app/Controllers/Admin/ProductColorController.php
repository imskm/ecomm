<?php 

namespace App\Controllers\Admin;
use App\Middlewares\AdminAuthMiddleware;
use Fantom\Controller;


class ProductColorController extends Controller
{
	protected function index()
	{
		$this->view->render('Admin/ProductColor/index.php');
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}