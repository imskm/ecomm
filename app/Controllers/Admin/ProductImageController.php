<?php

namespace App\Controllers\Admin;

use App\EComm\Repositories\ProductImageRepository;
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
		$product_id = (int) $this->route_params['id'];
		$product_images = ProductImageRepository::byProductId($product_id)->get();
		// @TODO

		$this->view->render('Admin/ProductImage/index.php', [
			"product_images" => $product_images,
		]);	
	}

	protected function update()
	{
		// 1. Validation
		$v = new ProductValidtor();
		$v->validateImageUpdate();
		if ($v->hasError()) {
			// 
			echo "failed";
			return;
		}

		// 2. Upload image
		$destination = ROOT . '/public/uploads';
		$image = new ImageUploader($destination);
		if ($image->save('photo') === false) {
			Session::flash("error", "Failed to upload image");
			// 
			redirect("admin/product-image/create");
		}
		$image_name = $image->getSavedFileNames()[0];

		// 3. Make Model
		$id = (int) $_POST['id'];
		$product_image = ProductImageRepository::find($id);
		ProductImageRepository::change($product_image, [
			"product_id" => $product_image->product_id,
			"color_id" => $product_image->color_id,
			"image" => $image_name,
		]);

		// 4. Save
		if ($product_image->save() === false) {
			Session::flash("error", "Failed to save product image record in db");
			redirect("admin/product-image/create");
		}

		// @TODO Delete the old image from Disk

		// 5. Success message and redirect to index
		Session::flash("success", "Product image saved successfully");
		redirect("admin/product/index");
		echo "success";
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