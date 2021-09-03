<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Material Tabl
 */
class Material extends Model
{
	protected $table = "materials";
	protected $primary = "id";

	public static function make(array $data)
	{
		$material = new self;

		self::populateMaterial($material, $data);

		return $material;
	}

	public static function recent( $page=1, $items = 20)
	{
		$offset = calc_page_offset($page , $items);
		$sql = "
				SELECT *
				FROM materials
				ORDER BY id DESC
				LIMIT {$items} OFFSET {$offset} 
		";
		return static::raw($sql);
	}

	public static function change(Material &$material, array $data)
	{
		self::populateMaterial($material, $data);
	}

	private static function populateMaterial(Material &$material ,array $data)
	{
		$material->material = title_case($data['material']);
	}
}