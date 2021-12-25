<?php

namespace App\Support\OrderBooker\Coupons;

use App\Support\OrderBooker\Interfaces\OrderInterface;
use App\Support\OrderBooker\Interfaces\CouponInterface;

/**
 * 
 */
class NullCoupon implements CouponInterface
{
	private $value;
	
	public function __construct()
	{
		$this->value = 0;
	}

	public function amount()
	{
		return $this->value;
	}
}