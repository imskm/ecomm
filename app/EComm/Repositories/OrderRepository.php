<?php

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\Order;
use App\Support\OrderBooker\Interfaces\OrderInterface;
use App\Support\OrderBooker\Traits\OrderTrait;

/**
 * Order repository
 */
class OrderRepository extends Order implements OrderInterface
{
	protected static $_table = "orders";

	use ModelOperationTrait, OrderTrait;
}