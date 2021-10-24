<?php $this->use('templates/base.php',['title' => 'Checkout']); ?>

<section class="section">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-10">
		<?php include VIEW_PATH.'/partials/_message.php'; ?>
      	<h1 class="title">Checkout Page</h1>
        <div class="columns">
        	<div class="column is-7">
        		<?php foreach ($items as $i): ?>
	          	<div class="box">
							  <p class="subtitle"><?= e($i->product->title) ?></p>
							  <p><?= e($i->color->color) ?> &middot; <?= e($i->size->size) ?></p>
							  <p>&#x20B9; <?= e($i->product->price_sp) ?></p>
							  <input class="input" type="number"  value="<?= e($i->qty) ?>">
                <p><a href="/cart/<?= e($i->cart_item->id) ?>/remove-product" class="button is-danger">Remove</a></p>
							</div>
        		<?php endforeach; ?>
          </div>
          <div class="column is-5">
            <div class="box">
            	<p>Gross total: &#x20B9; 1000</p>
            	<p>Discount: &#x20B9; 0</p>
            	<p>Subtotal: &#x20B9; 1000</p>
            	<p>Delivery Fee: &#x20B9; 0</p>
            	<p>Tax: &#x20B9; 0</p>
            	<p>Coupon: &#x20B9; 0</p>
            	<p>Total: &#x20B9; 1000</p>
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
          	<form action="/order/store">
          		<button type="submit" class="button is-primary is-fullwidth">PLACE ORDER</button>
          	</form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>