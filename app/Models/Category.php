<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Category Tabl
 */
class Category extends Model
{
	protected $table = "product_categories";
	protected $primary = "id";
}