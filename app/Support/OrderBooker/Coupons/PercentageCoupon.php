<?php

namespace App\Support\OrderBooker\Coupons;

use App\Support\OrderBooker\Interfaces\OrderInterface;
use App\Support\OrderBooker\Interfaces\CouponInterface;

/**
 * 
 */
class PercentageCoupon implements CouponInterface
{
	private $order;
	/**
	 * 
	 * value
	 *  i) 10     -> 10%
	 * ii)  0.10  -> 10%
	 * 
	 */
	private $value;
	
	public function __construct(OrderInterface &$order, $value)
	{
		$this->order = $order;
		$this->value = $value;

		if ($this->value < 0.0 || $this->value > 100.0) {
			throw new \Exception("Invalid coupon value, must be between 0 and 100");
		}
	}

	public function amount()
	{
		return $this->order->subTotal() * $this->value / 100;
	}
}