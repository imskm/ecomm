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
	protected static $_table = "order_items";

	use ModelOperationTrait, OrderItemTrait;
}