<?php 

namespace App\Controllers\Admin;
use App\Config;
use App\EComm\Repositories\ProductAvailableColorRepository;
use App\EComm\Repositories\ProductImageRepository;
use App\EComm\Repositories\ProductRepository;
use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAvailableColor;
use Fantom\Controller;
use Fantom\Session;


class ProductColorController extends Controller
{
	protected function index()
	{
		$this->view->render('Admin/ProductColor/index.php');
	}

	protected function create()
	{
		$product_id = get_or_empty("product_id");
		if (empty($product_id)) {
			Session::flash("error", "Product id not found");
			redirect("admin/product-color/index");
		}

		$product = ProductRepository::find($product_id);
		$color = Color::all()->get();

		$this->view->render("Admin/ProductColor/create.php",[
			"product" => $product,
			"colors" => $color,
		]);
	}

	protected function store()
	{
		// @TODO validation
		$v = new ProductValidtor();
		$v->validateColorCreate();

		$product_id = get_or_empty("product_id");
		if($v->hasError())
		{
			redirect("admin/product-color/create?product_id={$product_id}");
		}
		
		$color_ids = $_POST['color_ids'];
		$product_id = $_POST['product_id'];
		
		foreach ($color_ids as $color_id) {
			$prod_color = ProductAvailableColorRepository::make([
				'product_id' => $product_id,
				'color_id' 	=> $color_id,
			]);
			if ($prod_color->save() === false) {
				Session::flash("error", "Failed to attach color");
				redirect("admin/product-color/create");
			}
		}

		// Create default create
		$default_image = Config::get("default_image");
		foreach ($color_ids as $color_id) {
			for ($i = 0; $i < 5; ++$i) {
				$pi = ProductImageRepository::make([
					"product_id" 	=> $product_id,
					"color_id" 		=> $color_id,
					"image" 		=> $default_image,
				]);
				$pi->save();
			}
		}

		Session::flash("success", "Product Color attached successfully");
		redirect("admin/product-size/create?product_id={$product_id}");
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}
