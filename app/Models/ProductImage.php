<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * ProductImage
 */
class ProductImage extends Model
{
	protected $table = "product_images";
	protected $primary = "id"

	public static function make(array $data, $image_name)
	{
		$pi = new self;

		$pi->product_id = (int) $data['product_id'];
		$pi->image = $image_name;

		return $pi;
	}
}