<?php 

namespace App\EComm\Repositories;

use App\Models\Color;
use App\EComm\Traits\ModelOperationTrait;

/**
 * 
 */
class ColorRepository extends Color
{
	protected static $_table = "colors";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$color = new self;

		self::populateColor($color, $data);

		return $color;
	}

	public static function change(Color &$color, array $data)
	{
		self::populateColor($color, $data);
	}

	private static function populateColor(Color &$color, array $data)
	{
		$color->color = title_case($data['color']);
		$color->code = $data['code'];
	}
}
