<?php

namespace App\Controllers\Admin;

use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Product;
use App\Models\ProductAvailableSize;
use App\Models\Size;
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

	protected function create()
	{
		$product_id = get_or_empty("product_id");

		if(empty($product_id))
		{
			Session::flash("error", "Product Id is not found");
			redirect("admin/product-size/index");
		}
		$product = Product::find($product_id)->first();
		$sizes = Size::all()->get();

		$this->view->render("Admin/ProductSize/create.php",[
			"product" => $product,
			"sizes" => $sizes,
		]);
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
		$size_ids = $_POST['size_ids'];
		$product_id = $_POST['product_id'];

		foreach ($size_ids as $size_id) 
		{
			$prod_size = ProductAvailableSize::make([
				'product_id' => $product_id,
				'size_id' 	=> $size_id,
			]);

		// 3. Save
			if ($prod_size->save() === false) 
			{
					Session::flash("error", "Failed to attach size");
					redirect("admin/product-size/create");
			}
			
		}

		// 4. Success message and redirect to index
		Session::flash("success", "Size attched to product successfully");
		redirect("admin/product-stock/create?product_id={$product_id}");
	

}
protected function before()
	{
		return (new AdminAuthMiddleware)();
		
	}
}