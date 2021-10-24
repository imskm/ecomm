<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Order model
 */
class Order extends Model
{
	protected $table = "orders";
	protected $primary = "id";
}