<?php 

namespace App\EComm\Validators;

use Fantom\Validation\Validator;

/**
 * 
 */
class CouponValidator extends Validator
{
	
	public function validateCreate()
	{
		$this->validate("POST",[
			"coupon" 	=> "required|alpha_num|max:10|unique:coupons,coupon",
			"value" 	=> "required|alpha_num|max:10|unique:coupons,coupon",
			"active_at" 	=> "required",
			"expired_at" 	=> "required"
		]);
	}
}