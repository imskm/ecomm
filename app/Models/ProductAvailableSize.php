<?php

namespace App\Models;

use App\Models\Size;
use Fantom\Database\Model;

/**
 * ProductAvailableSize
 */
class ProductAvailableSize extends Model
{
	protected $table = "product_available_sizes";
	protected $primary = "id";

}