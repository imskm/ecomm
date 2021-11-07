<?php
namespace App\Controllers\Admin;
use App\EComm\Repositories\ProductAvailableColorRepository;
use App\EComm\Repositories\ProductImageRepository;
use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Product;
use App\Support\ImageUploader;
use App\Support\Response;
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
		$available_colors = ProductAvailableColorRepository::byProductId($product_id)->get();

		/*echo "<pre>";
			print_r($available_colors);
			exit;*/
		$result = [];
		// [
		//		[color_id] => [
		// 			["images"] => [
		//				[product_image],
		//				[product_image],
		//				[product_image],
		//				[product_image],
		//				[product_image],
		// 			],
		// 			["color"] => [avail_color]
		//		]
		// ]
		// Iterate over $avialable_colors and fetch images of each color
		foreach ($available_colors as $avail_color) {

			/*echo "<pre>";
			print_r($avail_color);
			exit;*/
			$images = ProductImageRepository::byProductColorId($product_id, $avail_color->color_id)->get();
			/*echo "<pre>";
			print_r($images);
			exit;*/
			$result[$avail_color->color_id]["images"] = $images;
			$result[$avail_color->color_id]["color"] = $avail_color->color();

		}

		// echo "<pre>";
		// print_r($result);
		// exit;

		$this->view->render('Admin/ProductImage/index.php', [
			"product_id" => $product_id,
			"product_images" => $result,
		]);	
	}

	protected function update()
	{
		$res = new Response();

		// 1. Validation
		$v = new ProductValidtor();
		$v->validateImageUpdate();
		if ($v->hasError()) {
			$res->setErrors($v->validationErrors()->all());
			return $res->send();
		}

		// 2. Upload image
		$destination = ROOT . '/public/uploads';
		$image = new ImageUploader($destination);
		if ($image->save('photo') === false) {
			$res->setErrors(["photo" => "Failed to save image"]);
			return $res->send();
		}
		$image_name = $image->getSavedFileNames()[0];

		// 3. Make Model
		$id = (int) $_POST['id'];
		$product_image = ProductImageRepository::find($id);
		$old_product_image = $product_image->image;
		ProductImageRepository::change($product_image, [
			"product_id" => $product_image->product_id,
			"color_id" => $product_image->color_id,
			"image" => $image_name,
		]);

		// 4. Save
		if ($product_image->save() === false) {
			$res->setErrors(["photo" => "Failed to save product image record in db"]);
			return $res->send();
		}

		// @TODO Delete the old image from Disk
		$deletable_file = $destination . "/{$old_product_image}";
		if ($old_product_image) {
			unlink($deletable_file);
		}

		// 5. Success message and redirect to index
		return $res->send();
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