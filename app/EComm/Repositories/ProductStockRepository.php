<?php 

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\ProductStock;
use App\Models\Size;

/**
 * 
 */
class ProductStockRepository extends ProductStock
{
	protected static $_table = "product_stocks";
	use ModelOperationTrait;
	public static function make(array $data)
	{
		$ps = new self;

		self::populateProductStock($ps, $data);

		return $ps;
	}

	public static function change(ProductStock &$product_stock, array $data)
	{
		self::populateProductStock($product_stock, $data);
	}

	private static function populateProductStock(ProductStock &$product_stock, array $data)
	{
		$product_stock->product_id 	= (int) $data['product_id'];
		$product_stock->size_id		= (int) $data['size_id'];
		$product_stock->stock		= (int) $data['stock'];
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