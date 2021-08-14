<?php

namespace App\Controllers\Admin;

use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Product;
use Fantom\Controller;
use Fantom\Log\Log;
use Fantom\Session;

/**
 * 
 */
class ProductSizeController extends Controller
{
	protected function index()
	{
		$this->view->render('Admin/ProductSize/index.php');
	}


	protected function store()
	{
		// 1. Validation
		$v = new ProductValidtor();
		$v->validateSizeCreate();
		if ($v->hasError()) {
			redirect("admin/product-size/create");
		}

		// 2. Make Model
		$product_sizes = Product::makeSizes($_POST);

		// 3. Save
		foreach ($product_sizes as $ps) {
			if ($ps->save() === false) {
				Session::flash("error", "Failed to save product size");
				Log::error("failed to create product size '{$ps->size_id}'");
				redirect("admin/product/index");
			}
		}

		// 4. Success message and redirect to index
		Session::flash("success", "Size attched to product successfully");
		redirect("admin/product/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
		
	}
}