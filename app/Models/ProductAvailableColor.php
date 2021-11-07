<?php

namespace App\Models;

use App\Models\Color;
use Fantom\Database\Model;

/**
 * ProductAvailableColor Tabl
 */
class ProductAvailableColor extends Model
{
	protected $table = "product_available_colors";
	protected $primary = "id";
}