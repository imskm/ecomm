<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Cart Model
 */
class Cart extends Model
{
	protected $table = "carts";
	protected $primary = "id";
}