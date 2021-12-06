<?php 

namespace App\Controllers\Admin;

use Fantom\Controller;
use App\Middlewares\AdminAuthMiddleware;

class CouponController extends Controller
{
	protected function create()
	{
		$this->view->render('Admin/Coupon/create.php');
	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}