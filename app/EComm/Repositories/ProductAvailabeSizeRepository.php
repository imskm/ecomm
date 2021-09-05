<?php

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\ProductAvailableSize;
use App\Models\Size;

/**
 * 
 */
class ProductAvailableSizeRepository extends ProductAvailableSize
{
	protected static $_table = "product_available_sizes";
	use ModelOperationTrait;

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

	public function size()
	{
		return Size::find($this->size_id);
	}
}