<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Coupon Model
 */
class Coupon extends Model
{
	protected $table = "coupons";
	protected $primary = "id";
}