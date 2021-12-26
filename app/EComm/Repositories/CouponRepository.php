<?php

namespace App\EComm\Repositories;

use App\Models\Coupon;
use App\EComm\Traits\ModelOperationTrait;

/**
 * 
 */
class CouponRepository extends Coupon
{
	protected static $_table = 'coupons';

	use ModelOperationTrait;

	public  static function make(array $data)
	{
		$coupon = new self;

		self::populateCoupon($coupon, $data);
		$coupon->created_at = date("Y-m-d H:i:s");

		return $coupon;
	}

	public static function byCouponCode($code)
	{
		return static::where('coupon', $code)->first();
	}

	private static function populateCoupon(Coupon &$coupon, array $data)
	{
		$coupon->coupon 		= title_case(trim($data['coupon']));
		$coupon->value 			= title_case(trim($data['value']));
		$coupon->active_at 		= $_POST['active_at'];
		$coupon->expired_at 	= $_POST['expired_at'];
		
	}
}