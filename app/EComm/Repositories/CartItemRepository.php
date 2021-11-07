<?php

namespace App\EComm\Repositories;

use App\EComm\Traits\ModelOperationTrait;
use App\Models\CartItem;

/**
 * CartItemRepository
 */
class CartItemRepository extends CartItem
{
	protected static $_table = "cart_items";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$cart_item = new self;

		$cart_item->cart_id 	= $data['cart_id'];
		$cart_item->qty	  		= $data['qty'];
		$cart_item->product_id	= $data['product_id'];
		$cart_item->size_id	  	= $data['size_id'];
		$cart_item->color_id	= $data['color_id'];

		return $cart_item;
	}

	
}