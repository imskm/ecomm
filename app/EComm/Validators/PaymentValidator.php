<?php

namespace App\EComm\Validators;
use Fantom\Validation\Validator;

class PaymentValidator extends Validator
{
	public function validatePaymentCreate()
	{
		$this->validate("POST", [
			"razorpay_order_id" 	=> "required|max:64",
			"razorpay_payment_id" 	=> "required|max:64",
			"razorpay_signature" 	=> "required|max:256",
		]);
	}
}