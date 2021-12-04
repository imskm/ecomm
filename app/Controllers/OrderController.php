<?php

namespace App\Controllers;

use App\Config;
use Fantom\Log\Log;
use Fantom\Session;
use Razorpay\Api\Api;
use Fantom\Controller;
use App\Support\Authentication\Auth;
use App\Middlewares\UserAuthMiddleware;
use App\EComm\Validators\OrderValidator;
use App\EComm\Repositories\CartRepository;
use App\EComm\Repositories\SizeRepository;
use App\EComm\Repositories\ColorRepository;
use App\EComm\Repositories\OrderRepository;
use App\EComm\Repositories\ProductRepository;
use App\EComm\Repositories\OrderItemRepository;

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

		// @TODO Move the order building using cart object in OrderRepository
		// DO NOT do so much work in controller.
		// Order creation logic should be moved to OrderRepository
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

		$created_order = $order->forUser(Auth::user())->create();

		if ($created_order === false) {
			Log::error("failed to save order");
			Session::flash("error", "Failed to create order");
			redirect("/cart/checkout");
		}

		// Create order in razorpay server
		$this->createOrderInRazorpay($created_order);

		Session::flash("success", "Congrats! Order created.");
		redirect("/payment/create?order_id=" . $created_order->thisId());
	}

	private function createOrderInRazorpay(& $created_order)
	{
		$rzp_api = Config::get('rzp_key');
		$rzp_secret = Config::get('rzp_secret');
		$api = new Api($rzp_api, $rzp_secret);

		$rzp_order = $api->order->create([
			'receipt' => $created_order->thisId(),
			'amount' => $created_order->amount * 100,
			'currency' => 'INR',
		]);

		$new_order = OrderRepository::find($created_order->thisId());
		$new_order->rzp_order_id = $rzp_order['id'];
		$new_order->save();
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}