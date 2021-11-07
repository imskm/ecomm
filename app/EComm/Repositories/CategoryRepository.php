<?php 

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\Category;

/**
 * 
 */
class CategoryRepository extends Category
{
	protected static $_table = "product_categories";
	use ModelOperationTrait;
	public static function make(array $data)
	{
		$category = new self;

		self::populateCategory($category, $data);
		$category->created_at = $category->updated_at = date("Y-m-d H:i:s");

		return $category;
	}

	public static function change(Category &$category, array $data)
	{
		self::populateCategory($category, $data);
		$category->updated_at = date("Y-m-d H:i:s");
	}

	private static function populateCategory(Category &$category, array $data)
	{
		$category->category = title_case($data['category']);
	}

}