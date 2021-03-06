<?php 

namespace App\EComm\Repositories;

use App\Models\ProductAvailableColor;
use App\EComm\Traits\ModelOperationTrait;
use App\EComm\Repositories\ColorRepository;

/**
 * 
 */
class ProductAvailableColorRepository extends ProductAvailableColor
{
	protected static $_table = "product_available_colors";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$product_color = new self;

		self::populateProductAvailableColor($product_color, $data);

		return $product_color;
	}

	public static function change(ProductAvailableColor &$product_color, array $data)
	{
		self::populateProductAvailableColor($product_color, $data);
	}

	private static function populateProductAvailableColor(ProductAvailableColor &$product_color, array $data)
	{
		$product_color->product_id = (int) $data['product_id'];
		$product_color->color_id = (int) $data['color_id'];
	}

	public static function byProductId($product_id)
	{
		return static::where("product_id", $product_id);
	}

	public function color()
	{
		return ColorRepository::find($this->color_id);
	}
}
