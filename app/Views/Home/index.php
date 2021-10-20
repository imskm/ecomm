<?php $this->use('templates/base.php', ['title' => 'Welcome']) ?>

<section class="section">
	  <div class="container">
	  	<div class="columns is-multiline">
	  		<?php foreach ($products as $p): ?>
		  		<div class="column is-3">
					<div class="card">
						<div class="card-image">
							<figure class="image is-4by3">
								<img src="/uploads/default-product-image.jpg" alt="Placeholder image">
							</figure>
						</div>
						<div class="card-content">
							<div class="content">
								<?= e($p->title) ?>
							</div>
						</div>
						 <footer class="card-footer">
							<a href="#" class="card-footer-item">&#x20B9; <?= e($p->price_sp) ?></a>
						    <a href="/product/<?= e($p->id) ?>/show" class="card-footer-item">View Details</a>
						 </footer>
					</div>
		  		</div>
	  		<?php endforeach; ?>
	  	</div>
	</div>
</section>
