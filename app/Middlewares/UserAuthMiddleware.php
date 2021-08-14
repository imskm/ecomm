<?php

namespace App\Middlewares;

use App\Support\Authentication\Auth;

class UserAuthMiddleware
{
	public function __invoke(){

		if (!Auth::check()) {
			redirect('auth/login');
		}
		$user = Auth::user();

		// Role = 2 -> user
		if ((int) $user->role === 2) {
			return true;
		}

		redirect('/auth/login');
	}

}


?>