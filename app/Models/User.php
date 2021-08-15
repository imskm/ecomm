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

	public static function make(array $data)
	{
		$user = new self;

		self::populateUser($user, $data);
		$user->created_at = $user->updated_at = date("Y-m-d H:i:s");

		return $user;
	}

	public static function change(User &$user, array $data)
	{
		self::populateUser($user, $data);
		$user->updated_at = date("Y-m-d H:i:s");
	}

	private static function populateUser(User &$user, array $data)
	{
		$user->first_name 	= title_case(trim($data['first_name']));
		$user->last_name 	= title_case(trim($data['last_name']));
		$user->gender 		= (int) $_POST['gender'];
		$user->email 		= strtolower(trim($data['email']));
		$user->phone 		= $_POST['phone'];
		$user->password 	= password_hash(trim($data['password']), PASSWORD_DEFAULT);
		$user->role 		= 2;
	}
}

