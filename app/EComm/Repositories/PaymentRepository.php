<?php

namespace App\EComm\Repositories;

use App\Models\Payment;
use App\EComm\Traits\ModelOperationTrait;

/**
 * 
 */
class PaymentRepository extends Payment
{
	protected static $_table = "payments";

	const STATUS_SUCCESS = 1;
	const STATUS_FAILURE = 2;
	
	use ModelOperationTrait;
	
	public static function make(array $data)
	{
		// 
		$payment= new self;

		$payment->order_id = $data['order_id'];
		$payment->rzp_payment_id = $data['razorpay_payment_id'];
		$payment->rzp_signature = $data['razorpay_signature'];
		$payment->status = self::STATUS_SUCCESS;
		$payment->user_id = $data['user_id'];
		$payment->created_at = $payment->updated_at = date("Y-m-d H:i:s");

		return $payment;
	}


}