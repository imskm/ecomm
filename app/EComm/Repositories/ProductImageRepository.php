<?php 

namespace App\EComm\Repositories;

use App\Models\ProductImage;
use App\EComm\Traits\ModelOperationTrait;

/**
 * 
 */
class ProductImageRepository extends ProductImage
{
	protected static $_table = "product_images";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$pi = new self;

		self::populateProductImage($pi, $data);

		return $pi;
	}

	public static function change(ProductImage &$pi, array $data)
	{
		self::populateProductImage($pi, $data);
	}

	private static function populateProductImage(ProductImage &$pi, array $data)
	{
		$pi->product_id = (int) $data['product_id'];
		$pi->color_id = (int) $data['color_id'];
		$pi->image = $data['image'];
	}

	public static function byProductColorId($product_id, $color_id = null)
	{
		$query = static::where("product_id", (int) $product_id);

		if ($color_id) {
			$query->andWhere("color_id",(int) $color_id);
		}

		return $query;
	}

	public static function byProductId($product_id)
	{
		return static::where("product_id", (int) $product_id);
	}

}