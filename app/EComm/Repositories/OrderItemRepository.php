<?php

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\OrderItem;
use App\Support\OrderBooker\Interfaces\OrderItemInterface;
use App\Support\OrderBooker\Traits\OrderItemTrait;

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
		$oi->pice_mp 		= $data['pice_mp'];
		$oi->pice_sp 		= $data['pice_sp'];
		$oi->qty 			= $data['qty'];
		$oi->status 		= self::STATUS_CREATED;

		return $oi;
	}
}