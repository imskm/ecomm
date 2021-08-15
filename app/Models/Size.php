<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Size Tabl
 */
class Size extends Model
{
	protected $table = "sizes";
	protected $primary = "id";

	public static function make(array $data)
	{
		$size = new self;

		self::populateSize($size, $data);

		return $size;
	}

	public static function change(Size &$size, array $data)
	{
		self::populateSize($size, $data);
	}

	private static function populateSize(Size &$size, array $data)
	{
		$size->size = title_case($data['size']);
	}
	
}