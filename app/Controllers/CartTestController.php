<?php

namespace App\Controllers;

use App\EComm\Repositories\CartItemRepository;
use App\EComm\Repositories\CartRepository;
use App\Middlewares\UserAuthMiddleware;
use App\Support\Authentication\Auth;
use Fantom\Controller;

/**
 * CartTestController
 */
class CartTestController extends Controller
{
	protected function addItem()
	{
		$qty = (int) $_GET['qty'];
		$product_id = (int) $_GET['product_id'];
		$size_id = (int) $_GET['size_id'];
		$color_id = (int) $_GET['color_id'];

		$user_id = Auth::userId();
		$cart = CartRepository::byUserId($user_id)->first();
		if (is_null($cart)) {
			$cart = CartRepository::make([
				"user_id" => $user_id,
			]);
			$cart->save();
		}

		$cart_item = $cart->addItem($qty, $product_id, $size_id, $color_id);

		$cart_item->save();
	}

	protected function removeItem()
	{
		$cart_item_id = $_GET['id'];
		$cart = CartItemRepository::find($cart_item_id);

		$cart->delete();


	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}