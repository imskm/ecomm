<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * ProductAvailableSize
 */
class ProductAvailableSize extends Model
{
	protected $table = "product_available_sizes";
	protected $primary = "id";

	public static function make(array $data)
	{
		$ps = new self;

		self::populateProductAvailableSize($ps, $data);

		return $ps;
	}

	public static function change(ProductAvailableSize &$product_size, array $data)
	{
		self::populateProductAvailableSize($product_size, $data);
	}

	private static function populateProductAvailableSize(ProductAvailableSize &$product_size, array $data)
	{
		$product_size->product_id = (int) $data['product_id'];
		$product_size->size_id	= (int) $data['size_id'];
	}

	public static function byProductId($product_id)
	{
		return static::where("product_id", $product_id);
	}
}