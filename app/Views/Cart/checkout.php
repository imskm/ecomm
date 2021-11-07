<?php $this->use('templates/base.php',['title' => 'Checkout']); ?>

<section class="section">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-10">
		<?php include VIEW_PATH.'/partials/_message.php'; ?>
      	<h1 class="title">Checkout Page</h1>
        <div class="columns">
        	<div class="column is-7">
        		<?php foreach ($order->getOrderItems() as $i => $oi): ?>
	          	<div class="box">
							  <p class="subtitle"><?= e($oi->getProduct()->title) ?></p>
							  <p><?= e($oi->getVariation('color')->color) ?> &middot; <?= e($oi->getVariation('size')->size) ?></p>
							  <p>&#x20B9; <?= e($oi->getProduct()->price_sp) ?></p>
                <form action="/cart/update-quantity" method="post">
                  <input name="cart_item_id" type="hidden" value="<?= e($items[$i]->cart_item->id) ?>">
  							  <input name="qty" class="input" type="number"  value="<?= e($oi->quantity()) ?>">
                  <button type="submit" class="button">Update</button>
                </form>
                <p><a href="/cart/<?= e($items[$i]->cart_item->id) ?>/remove-product" class="button is-danger">Remove</a></p>
							</div>
        		<?php endforeach; ?>
          </div>
          <div class="column is-5">
            <div class="box">
            	<p>Gross total: &#x20B9; <?= $order->grossTotal() ?></p>
            	<p>Discount: &#x20B9; <?= $order->discount() ?></p>
            	<p>Subtotal: &#x20B9; <?= $order->subTotal() ?></p>
            	<p>Delivery Fee: &#x20B9; 0</p>
            	<p>Tax: &#x20B9; 0</p>
            	<p>Coupon: &#x20B9; 0</p>
            	<p>Total: &#x20B9; <?= $order->orderTotal() ?></p>
    	        <div class="field is-grouped">
    					  <p class="control is-expanded">
    					    <input class="input is-small" type="text" placeholder="Copon Code">
    					  </p>
    					  <p class="control">
    					    <a class="button is-small is-info">
    					      Apply
    					    </a>
    					  </p>
    					</div>
            </div>
          	<form action="/order/create">
          		<button type="submit" class="button is-primary is-fullwidth">PLACE ORDER</button>
          	</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>