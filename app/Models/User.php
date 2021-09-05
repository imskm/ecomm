<?php

namespace App\Models;

use Fantom\Database\Model;

/**
 * User model
 */
class User extends Model
{
	protected $primary = 'id';
	protected $table   = 'users';
}

