<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * OrderItem model
 */
class OrderItem extends Model
{
	protected $table = "order_items";
	protected $primary = "id";
}