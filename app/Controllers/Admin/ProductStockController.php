<?php 

namespace App\Controllers\Admin;

use App\EComm\Repositories\ProductRepository;
use App\EComm\Repositories\ProductStockRepository;
use App\EComm\Validators\ProductValidtor;
use App\Middlewares\AdminAuthMiddleware;
use App\Models\Product;
use App\Models\ProductStock;
use Fantom\Controller;
use Fantom\Session;

/**
 * 
 */
class ProductStockController extends Controller
{
	protected function index()
	{

	}
	protected function create()
	{
		$product_id = get_or_empty("product_id");

		if(empty($product_id))
		{
			Session::flash("error","Product Id is not Available ");
			redirect("admin/product-stock/index");
		}

		$product = ProductRepository::find($product_id);
		$product_sizes = $product->productSizes()->get();

		$this->view->render("Admin/ProductStock/create.php",[
			"product" 	=> $product,
			"product_sizes" => $product_sizes,
		]);
	}

	protected function store()
	{

		// Validation
		$v = new ProductValidtor();
		$v->validateStockCreate();
		$product_id = (int) $_POST['product_id'];
		if($v->hasError())
		{
			redirect("admin/product-stock/create?product_id={$product_id}");
		}

		$size_ids = $_POST['size_ids'];
		$stocks = $_POST['stock'];

		foreach ($size_ids as $i => $size_id) 
		{
			$stock = $stocks[$i];
			$product_stock = ProductStockRepository::make([
				"product_id" => $product_id,
				"size_id" => $size_id,
				"stock" => $stock,
			]);
			if($product_stock->save() === false)
			{
				Session::flash("error","failed to add Stock");
				redirect("admin/product-stock/create");
			}
		}

		Session::flash("success","Stock Added Successfull");
		//redirect("admin/product/{$product_id}/show");
		redirect("admin/product-image/{$product_id}/index");
		


	}
	protected function before()
	{
		return (new AdminAuthMiddleware)();
		
	}
}