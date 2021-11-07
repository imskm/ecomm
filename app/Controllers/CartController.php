<?php 

namespace App\Controllers;

use App\EComm\Repositories\CartItemRepository;
use App\EComm\Repositories\CartRepository;
use App\EComm\Repositories\ColorRepository;
use App\EComm\Repositories\OrderItemRepository;
use App\EComm\Repositories\OrderRepository;
use App\EComm\Repositories\ProductRepository;
use App\EComm\Repositories\SizeRepository;
use App\Middlewares\UserAuthMiddleware;
use App\Support\Authentication\Auth;
use Fantom\Controller;
use Fantom\Session;

/**
 * 
 */
class CartController extends Controller
{
	
	protected function addItem()
	{
		$product_id = $_POST['product_id'];
		$qty = $_POST['qty'];
		$color_id = $_POST['color_id'];
		$size_id = $_POST['size_id'];
		$qty = (int) $_POST['qty'];
		$product_id = (int) $_POST['product_id'];
		$size_id = (int) $_POST['size_id'];
		$color_id = (int) $_POST['color_id'];
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
		Session::flash("success", "Your Product is added to cart successfully ");
		redirect('cart/checkout');
	}

	protected function checkout()
	{
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

		return $this->view->render("Cart/checkout.php", [
			'items' => $result,
			'order' => $order,
		]);
	}

	protected function removeProduct()
	{
		$cartItem_id= $this->route_params['id'];
		$product_remove = CartItemRepository::find($cartItem_id);
		$product_remove->delete();
		Session::flash('success','Product Removed Successfully');
		redirect('/cart/checkout');
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}

?>