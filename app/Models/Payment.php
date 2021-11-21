<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * Payment
 */
class Payment extends Model
{
	protected $table = "payments";
	protected $primary = "id";
}