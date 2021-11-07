<?php

namespace App\Controllers;

use App\EComm\Repositories\CartRepository;
use App\EComm\Repositories\ColorRepository;
use App\EComm\Repositories\OrderItemRepository;
use App\EComm\Repositories\OrderRepository;
use App\EComm\Repositories\ProductRepository;
use App\EComm\Repositories\SizeRepository;
use App\EComm\Validators\OrderValidator;
use App\Middlewares\UserAuthMiddleware;
use App\Support\Authentication\Auth;
use Fantom\Controller;
use Fantom\Log\Log;
use Fantom\Session;

/**
 * OrderController
 */
class OrderController extends Controller
{
	protected function create()
	{
		// 1. Validate
		$v = new OrderValidator();
		$v->validateCreate();
		if ($v->hasError()) {
			redirect("/cart/checkout");
		}

		// 2. Store
		$cart = CartRepository::byUserId(Auth::userId())->first();
		$cart_items = $cart->items();
		$result = [];

		$order = new OrderRepository();

		foreach ($cart_items as $ci) {
			$product = ProductRepository::find($ci->product_id);
			$color = ColorRepository::find($ci->color_id);
			$size = SizeRepository::find($ci->size_id);
			$qty = $ci->qty;

			$result[] = (object) [
				'cart_item'	=> $ci,
				'product' 	=> $product,
				'color' 	=> $color,
				'size' 		=> $size,
				'qty' 		=> $qty,
			];

			$order_item = new OrderItemRepository();
			$order_item->addProduct($product);
			$order_item->setVariation('size', $size);
			$order_item->setVariation('color', $color);
			$order_item->quantity($qty);
			$order->addOrderItem($order_item);
		}

		if ($order->forUser(Auth::user())->create() === false) {
			Log::error("failed to save order");
			Session::flash("error", "Failed to create order");
			redirect("/cart/checkout");
		}

		Session::flash("success", "Congrats! Order created.");
		redirect("/cart/checkout");
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}