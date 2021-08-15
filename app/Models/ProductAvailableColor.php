<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * ProductAvailableColor Tabl
 */
class ProductAvailableColor extends Model
{
	protected $table = "product_available_colors";
	protected $primary = "id";

	public static function make(array $data)
	{
		$product_color = new self;

		self::populateProductAvailableColor($product_color, $data);
		$product_color->created_at = $product_color->updated_at = date("Y-m-d H:i:s");

		return $product_color;
	}

	public static function change(ProductAvailableColor &$product_color, array $data)
	{
		self::populateProductAvailableColor($product_color, $data);
		$product_color->updated_at = date("Y-m-d H:i:s");
	}

	private static function populateProductAvailableColor(ProductAvailableColor &$product_color, array $data)
	{
		$product_color->product_color = title_case($data['product_color']);
	}
	
}