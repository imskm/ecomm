<?php

namespace App\Models;

use Fantom\Database\Model;

class Product extends Model
{
	protected $table = "products";
	protected $primary = "id";
}