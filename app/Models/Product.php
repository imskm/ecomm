<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductAvailableSize;
use App\Models\ProductSize;
use App\Models\ProductStock;
use Fantom\Database\Model;

class Product extends Model
{
	protected $table = "products";
	protected $primary = "id";

	public static function recent($page = 1, $items = 20)
	{
		$offset = calc_page_offset($page, $items);
		$sql = "
			SELECT *
			FROM products
			ORDER BY id DESC
			LIMIT {$items} OFFSET {$offset}
		";

		return static::raw($sql);
	}

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
			$product_sizes[] = ProductSize::make($ps_data);
		}

		return $product_sizes;
	}

	public function productSizes()
	{
		return ProductAvailableSize::byProductId($this->id);
	}

	public function productColors()
	{
		return ProductAvailableColor::byProductId($this->id);
	}

	public function category()
	{
		return Category::find($this->category_id)->first();
	}


	public function productStocks()
	{
		return ProductStock::byProductId($this->id);
	}
}