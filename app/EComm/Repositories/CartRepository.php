<?php

namespace App\EComm\Repositories;

use App\EComm\Repositories\CartItemRepository;
use App\EComm\Repositories\CartRepository;
use App\EComm\Traits\ModelOperationTrait;
use App\Models\Cart;

/**
 * CartRepository
 */
class CartRepository extends Cart
{
	protected static $_table = "carts";

	use ModelOperationTrait;

	public static function make(array $data)
	{
		$cart = new self;

		$cart->user_id = (int) $data['user_id'];
		$cart->created_at = date("Y-m-d H:i:s");

		return $cart;
	}

	public function addItem($qty, $product_id, $size_id, $color_id)
	{
		$cart_item = CartItemRepository::make([
			"cart_id" 		=> $this->thisId(),
			"qty"	  		=> $qty,
			"product_id"	=> $product_id,
			"size_id"	  	=> $size_id,
			"color_id"	  	=> $color_id,
		]);

		return $cart_item;
	}

	public function removeItem($cart_id)
	{
		$cart_item = CartItemRepository::delete([
			"cart_id" => $this->thisId(),
		]);
		return $cart_item;
	}

	public static function byUserId($user_id)
	{
		return CartRepository::where("user_id", $user_id);
	}

	public function items()
	{
		return CartItemRepository::where('cart_id', $this->id)->get();
	}

	public function item($cart_item_id)
	{
		return CartItemRepository::where('cart_id', (int) $this->id)
			->andWhere('id', (int) $cart_item_id)
			->first();
	}
}