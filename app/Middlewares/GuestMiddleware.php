<?php

namespace App\Middlewares;

use App\Support\Authentication\Auth;

/**
* Guest Middleware
*/
class GuestMiddleware
{
	protected $redirect_to = 'user/home/index';

    public function __invoke()
    {
         if (Auth::check()) {
            $user = Auth::user();
            if ((int) $user->role === 1) {
                redirect('admin/home/index');
            } else if ((int) $user->role === 2) {
                redirect('user/home/index');
            }
        }

        return true;
    }
}
