<?php

namespace App\Controllers\Admin;

use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Product;
use Fantom\Controller;
use Fantom\Session;


/**
 * ProductController
 */
class ProductController extends Controller
{
	protected function index()
	{
		$products = Product::recent(get_page())->get();

		// View
		// foreach ($products as $p) {
		// 	$available_sizes = $p->productSizes()->get();
		// 	$available_colors = $p->productColors()->get();
		// 	$product_stocks = $p->productStocks()->get();
		// }

		 $this->view->render("Admin/Product/index.php", [
		 	"products" => $products,
		 ]);
	}

	protected function create()
	{
		$this->view->render("Admin/Product/create.php");
	}

	protected function store()
	{
		// 1. Validate
		$v = new ProductValidtor();
		$v->validateCreate();
		if ($v->hasError()) {
			redirect("admin/product/index");
		}

		// 2. Make product model
		$product = Product::make($_POST);

		// 3. Save product
		if ($product->save() === false) {
			Session::flash("error", "Failed to create product");
			redirect("admin/product/index");
		}

		// 4. Success messsage and redirect to index
		Session::flash("success", "Product created successfully!");
		redirect("admin/product/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}