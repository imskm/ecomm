<?php

namespace App\EComm\Repositories;

use App\Models\Product;
use App\EComm\Traits\ModelOperationTrait;
use App\EComm\Repositories\CategoryRepository;
use App\EComm\Repositories\ProductSizeRepository;
use App\EComm\Repositories\ProductStockRepository;
use App\EComm\Repositories\ProductAvailableColorRepository;
use App\EComm\Repositories\ProductAvailableSizeRepository;

/**
 * Product Repository
 */
class ProductRepository extends Product
{
	protected static $_table = "products";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$product = new self;

		self::populateProduct($product, $data);
		$product->created_at = $product->updated_at = date("Y-m-d H:i:s");

		return $product;
	}

	public static function change(Product &$product, array $data)
	{
		self::populateProduct($product, $data);
		$product->updated_at = date("Y-m-d H:i:s");
	}

	private static function populateProduct(Product &$product, array $data)
	{
		$product->code 			= $data['code'];
		$product->title 		= title_case($data['title']);
		$product->description 	= $data['description'];
		$product->price_mp 		= $data['price_mp'];
		$product->price_sp 		= $data['price_sp'];
		$product->category_id 	= $data['category_id'];
		$product->material_id 	= $data['material_id'];

		if (isset($data['is_returnable'])) {
			$product->is_returnable = 1;
		} else {
			$product->is_returnable = 0;
		}
	}

	public static function makeSizes(array $data)
	{
		$product_sizes = [];

		$product_id = $data['product_id'];
		foreach ($data['size_ids'] as $size_id) {
			$ps_data = [
				'product_id' 	=> $product_id,
				'size_id' 		=> $size_id,
			];
			$product_sizes[] = ProductSizeRepository::make($ps_data);
		}

		return $product_sizes;
	}

	public function productSizes()
	{
		return ProductAvailableSizeRepository::byProductId($this->id);
	}

	public function productColors()
	{
		return ProductAvailableColorRepository::byProductId($this->id);
	}

	public function category()
	{
		return CategoryRepository::find($this->category_id);
	}


	public function productStocks()
	{
		return ProductStockRepository::byProductId($this->id);
	}
}
