<?php

namespace App\Support\OrderBooker\Interfaces;

use App\Support\OrderBooker\Interfaces\OrderItemInterface;

interface OrderInterface
{
	public function addOrderItem(OrderItemInterface $order_item);

	public function total();

	public function discount();

	public function tax();
}