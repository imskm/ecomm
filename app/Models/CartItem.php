<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * CartItem Model
 */
class CartItem extends Model
{
	protected $table = "cart_items";
	protected $primary = "id";
}