<?php

namespace App\EComm\Repositories;

use App\Models\OrderItem;
use App\EComm\Traits\ModelOperationTrait;
use App\EComm\Repositories\SizeRepository;
use App\EComm\Repositories\ColorRepository;
use App\EComm\Repositories\ProductRepository;
use App\Support\OrderBooker\Traits\OrderItemTrait;
use App\Support\OrderBooker\Interfaces\OrderItemInterface;

/**
 * OrderItem repository
 */
class OrderItemRepository extends OrderItem implements OrderItemInterface
{
	const STATUS_CREATED = 0;
	protected static $_table = "order_items";

	use ModelOperationTrait, OrderItemTrait;

	public static function make(array $data)
	{
		$oi = new self;

		$oi->order_id 		= (int) $data['order_id'];
		$oi->product_id 	= (int) $data['product_id'];
		$oi->user_id 		= (int) $data['user_id'];
		$oi->color_id 		= (int) $data['color_id'];
		$oi->size_id 		= (int) $data['size_id'];
		$oi->price_mp 		= $data['price_mp'];
		$oi->price_sp 		= $data['price_sp'];
		$oi->qty 			= $data['qty'];
		$oi->status 		= self::STATUS_CREATED;

		return $oi;
	}

	public static function byOrderId($order_id)
	{
		return static::where("order_id", $order_id);
	}

	public function product()
	{
		return ProductRepository::find($this->product_id);
	}

	public function color()
	{
		return ColorRepository::find($this->color_id);
	}

	public function size()
	{
		return SizeRepository::find($this->size_id);
	}
}