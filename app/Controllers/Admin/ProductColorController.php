<?php 

namespace App\Controllers\Admin;

use App\Middlewares\AdminAuthMiddleware;
use App\Models\Color;
use App\Models\Product;
use Fantom\Controller;
use Fantom\Session;


class ProductColorController extends Controller
{
	protected function index()
	{
		$this->view->render('Admin/ProductColor/index.php');
	}

	protected function store()
	{
		// @TODO validation

		$color = Color::make($_POST);
		if ($color->save() === false) {
			Session::flash("error", "Failed to create color");
			redirect("admin/product-color/create");
		}

		Session::flash("success", "Color created successfully");
		redirect("admin/product-color/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}