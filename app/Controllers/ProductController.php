<?php

namespace App\Controllers;

use App\EComm\Repositories\ProductImageRepository;
use App\EComm\Repositories\ProductRepository;
use Fantom\Controller;
use Fantom\Session;

/**
 * 
 */
class ProductController extends Controller
{
	public function show()
	{
		$product_id = (int) $this->route_params['id'];
		if(empty($product_id))
		{
			Session::flash("error", "Product is not found");
			redirect("home/index");
		}
		
		$product = ProductRepository::find($product_id);
		if(is_null($product))
		{
			redirect("home/index");
		}

		$product_sizes = $product->productSizes()->get();
		$product_colors = $product->productColors()->get();

		$result = [];
		foreach($product_colors as $product_color)
		{
			$images = ProductImageRepository::byProductColorId($product_id,$product_color->color_id)->get();
			$result[$product_color->color_id]["images"] = $images;
			$result[$product_color->color_id]["color"] = $product_color->color();
		}

		$color_id = isset($_GET['color_id']) ? (int) $_GET['color_id'] : null;
		
		$primary_images = $product->productImages($color_id)->get();
		
		$this->view->render("Product/show.php",[
			"product" 			=> $product,
			"product_sizes" 	=> $product_sizes,
			"product_colors" 	=> $product_colors,
			"product_images" 	=> $result,
			"primary_images"	=> $primary_images,
		]);
	}

}