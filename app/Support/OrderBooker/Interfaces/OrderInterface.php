<?php

namespace App\Support\OrderBooker\Interfaces;

use App\Support\OrderBooker\Interfaces\OrderItemInterface;

interface OrderInterface
{
	public function addOrderItem(OrderItemInterface $order_item);

	public function getOrderItems();

	public function grossTotal();

	public function subTotal();

	public function orderTotal();

	public function discount();

	public function tax();
}