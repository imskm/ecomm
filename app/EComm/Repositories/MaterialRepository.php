<?php 

namespace App\EComm\Repositories;

use App\Models\Material;
use App\EComm\Traits\ModelOperationTrait;

/**
 * 
 */
class MaterialRepository extends Material
{
	
	protected static $_table = "materials";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$material = new self;

		self::populateMaterial($material, $data);

		return $material;
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
