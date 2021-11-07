<?php 

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\Size;

/**
 * 
 */
class SizeRepository extends Size
{
	protected static $_table = "sizes";
	use ModelOperationTrait;
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
		$size->size = strtoupper($data['size']);
	}
}