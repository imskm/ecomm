<?php

namespace App\Controllers;

use App\Config;
use Fantom\Controller;
use App\Middlewares\UserAuthMiddleware;
use App\EComm\Repositories\OrderRepository;

/**
 * PaymentController
 */
class PaymentController extends Controller
{
	protected function create()
	{
		$order_id = (int) get_or_empty('order_id');
		$order = OrderRepository::find($order_id);
		$user  = $order->user();
		$data = [
			'key' 			=> Config::get('rzp_key'),
			'amount' 		=> $order->amount * 100,
			'currency' 		=> 'INR',
			'name' 			=> Config::get('site_name'),
			'order_id' 		=> $order->rzp_order_id,
			'prefill' 		=> [
				'name' 		=> $user->fullName(),
				'email' 	=> $user->email,
				'contact' 	=> $user->phone ?: "",
			],
		];

		$this->view->render("Payment/create.php", [
			'rzp_data' => $data,
		]);
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}