<?php 

namespace App\Controllers;

use App\EComm\Repositories\CartRepository;
use App\Middlewares\UserAuthMiddleware;
use App\Support\Authentication\Auth;
use Fantom\Controller;

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
	}

	protected function before()
	{
		return (new UserAuthMiddleware)();
	}
}

?>