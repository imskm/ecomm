<?php

namespace App\Support\OrderBooker\Traits;

use App\Support\OrderBooker\Interfaces\OrderItemInterface;

trait OrderTrait
{
	private $_order_items = [];

	public function addOrderItem(OrderItemInterface $order_item)
	{
		$this->_order_items[] = $order_item;
	}

	public function total()
	{
		$total = 0;
		foreach ($this->_order_items as $oi) {
			$total += $oi->sellingPrice() * $oi->quantity();
		}

		return $total;
	}

	public function discount()
	{
		$total = 0;
		foreach ($this->_order_items as $oi) {
			$total += $oi->discount() * $oi->quantity();
		}

		return $total;
	}

	public function tax()
	{
		$tax = $this->total() * 0.05;

		return $tax;
	}
}