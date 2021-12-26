<?php 

namespace App\Controllers\Admin;

use Fantom\Session;
use Fantom\Controller;
use App\Middlewares\AdminAuthMiddleware;
use App\EComm\Validators\CouponValidator;
use App\EComm\Repositories\CouponRepository;

class CouponController extends Controller
{
	protected function index()
	{
		$coupons = CouponRepository::recent(get_page())->get();
		$this->view->render('Admin/Coupon/index.php',[
			"coupons" =>$coupons,
		]);
	}


	protected function create()
	{
		$this->view->render('Admin/Coupon/create.php');
	}

	protected function store()
	{
		$v = new CouponValidator();
		$v->validateCreate();
		if($v->hasError())
		{
			redirect('admin/coupon/create');
		}
		$coupon = CouponRepository::make($_POST);
		if($coupon->save() === false)
		{
			Session::flash("error","Failed to Create Size");
			redirect("admin/coupon/index");
		} 
		Session::flash("success","Coupon Created Successfully");
		redirect("admin/coupon/index");

	}

	protected function before()
	{
		return (new AdminAuthMiddleware)();
	}
}