<?php

namespace App\Controllers\Admin;

use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Product;
use App\Support\ImageUploader;
use Fantom\Controller;
use Fantom\Log\Log;
use Fantom\Session;

/**
 * 
 */
class ProductImageController extends Controller
{
	protected function index()
	{
		$this->view->render('Admin/ProductImage/index.php');	
	}

	protected function store()
	{
		// 1. Validation
		$v = new ProductValidtor();
		$v->validateImageCreate();
		if ($v->hasError()) {
			redirect("admin/product-image/create");
		}

		// 2. Upload image
		$destination = ROOT . '/public/uploads';
		$image = new ImageUploader($destination);
		if ($image->save('photo') === false) {
			Session::flash("error", "Failed to upload image");
			redirect("admin/product-image/create");
		}
		$image_name = $image->getSavedFileNames()[0];

		// 3. Make Model
		$product_image = ProductImage::make($_POST, $image_name);

		// 4. Save
		if ($product_image->save() === false) {
			Session::flash("error", "Failed to save product image record in db");
			redirect("admin/product-image/create");
		}

		// 5. Success message and redirect to index
		Session::flash("success", "Product image saved successfully");
		redirect("admin/product/index");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}