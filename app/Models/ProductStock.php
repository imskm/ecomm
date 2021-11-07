<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * ProductStock Tabl
 */
class ProductStock extends Model
{
	protected $table = "product_stocks";
	protected $primary = "id";
}