<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * ProductSize
 */
class ProductSize extends Model
{
	protected $table = "product_available_sizes";
	protected $primary = "id";

	public static function make(array $data)
	{
		$ps = new self;

		$ps->product_id = (int) $data['product_id'];
		$ps->size_id	= (int) $data['size_id'];

		return $ps;
	}
}