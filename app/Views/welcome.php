<?php $this->use('templates/base.php', ['title' => 'Welcome']) ?>

<!-- <section class="section">
	<div class="container">
		<div class="columns is-centered">
			<div class="column is-6">
				<div class="box">
					<h1 class="title">Welcome to Fantom eCommerce Website</h1>
					<p>Create your own web application using this light and fast easy to use Web Framework.</p>
				</div>
			</div>
		</div>
	</div>
</section> -->
<section class="section">
	  <div class="container">
	  	<div class="columns is-multiline">
	  		<div class="column is-3">
		  		<?php foreach ($products as $p): ?>
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
						    <a href="/home/<?= e($p->id) ?>/show" class="card-footer-item">View Details</a>
						 </footer>
					</div>
		  		<?php endforeach; ?>
	  		</div>
	  	</div>
	</div>
</section>
