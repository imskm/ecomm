<?php

namespace App\Support\OrderBooker\Interfaces;

use App\Support\OrderBooker\Interfaces\OrderInterface;

interface CouponInterface
{
	public function __construct(OrderInterface &$order, $value);

	public function amount();
}