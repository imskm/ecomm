<?php

namespace App\Support\OrderBooker\Traits;

use App\Support\OrderBooker\Interfaces\CouponInterface;
use App\Support\OrderBooker\Interfaces\OrderItemInterface;

trait OrderTrait
{
	private $_order_items = [];
	private $_tax_rate = 0;
	private $coupon;

	public function addOrderItem(OrderItemInterface $order_item)
	{
		$this->_order_items[] = $order_item;
	}
	public function getOrderItems()
	{
		return $this->_order_items;
	}

	public function grossTotal()
	{
		$total = 0;
		foreach ($this->_order_items as $oi) {
			$total += $oi->markedPrice() * $oi->quantity();
		}

		return $total;
	}

	public function subTotal()
	{
		$total = 0;
		foreach ($this->_order_items as $oi) {
			$total += $oi->sellingPrice() * $oi->quantity();
		}

		return $total;
	}

	public function orderTotal()
	{
		// @TODO Delivery charge, Coupon discount
		$coupon_discount = $this->coupon->amount();
		$amount = $this->subTotal() - $coupon_discount + $this->tax();

		return $amount;
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
		return $this->subTotal() * $this->_tax_rate;
	}

	public function applyCoupon(CouponInterface $coupon)
	{
		$this->coupon = $coupon;
	}

	public function couponDiscount()
	{
		return $this->coupon->amount();
	}
}