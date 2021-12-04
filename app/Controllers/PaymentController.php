<?php

namespace App\Controllers;

use App\Config;
use Razorpay\Api\Api;
use Fantom\Controller;
use App\Support\Response;
use App\Middlewares\UserAuthMiddleware;
use App\EComm\Validators\PaymentValidator;
use App\EComm\Repositories\OrderRepository;
use App\EComm\Repositories\PaymentRepository;
use Razorpay\Api\Errors\SignatureVerificationError;


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
		// @TODO Move the data building in OrderBooker lib like OrderTrait
		// So that it can be reused in other project.
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

	protected function store()
	{
		$res = new Response();
		// @TODO Validate
		$v = new PaymentValidator();
		$v->validatePaymentCreate();
		if ($v->hasError()) {
			$res->setErrors($v->validationErrors()->all());
			return $res->send();
		}

		// @TODO Move the payment handling logic in the OrderRepository too,
		// or may be in OrderBooker lib.
		// The method handling payment should throw correct exception with
		// correct error message but be extra careful, DO NOT leak the internal
		// error detail.
		$order = OrderRepository::byRazorypayOrderId($_POST['razorpay_order_id']);
		$_POST['order_id'] = $order->id;
		$_POST['user_id'] = $order->user_id;
		$payment = PaymentRepository::make($_POST);
		$razorpay = new Api(Config::get('rzp_key'), Config::get('rzp_secret'));
		$attributes = [
			'razorpay_order_id' 		=> $order->rzp_order_id,
			'razorpay_payment_id' 		=> $_POST['razorpay_payment_id'],
			'razorpay_signature' 		=> $_POST['razorpay_signature'],
		];
		try {
			$razorpay->utility->verifyPaymentSignature($attributes);
		} catch (SignatureVerificationError $e) {
			$res->setErrors(['payment' => 'Payment signature verification failed']);
			$payment->status = PaymentRepository::STATUS_FAILURE;
		}

		if ($payment->save() === false) {
			$res->setErrors(['payment' => 'Failed to save payment']);
			return $res->send();
		}

		return $res->send();
	}

	protected function failure()
	{
		$res = new Response();
		// @TODO Validate
		$v = new PaymentValidator();
		$v->validatePaymentCreate();
		if ($v->hasError()) {
			$res->setErrors($v->validationErrors()->all());
			return $res->send();
		}

		$order = OrderRepository::byRazorypayOrderId($_POST['razorpay_order_id']);
		$_POST['user_id'] = $order->user_id;
		$payment = PaymentRepository::make($_POST);
		$payment->status = PaymentRepository::STATUS_FAILURE;
		if ($payment->save() === false) {
			// 
			$res->setErrors(['payment' => 'Failed to save payment']);
			return $res->send();
		}

		return $res->send();
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}