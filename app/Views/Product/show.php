<?php $this->use('templates/base.php', ['title' => $product->title]) ?>

<section class="section">
  <div class="container">
    <div class="columns is-centered">
      <div class="column is-8">
        <div class="columns">

          <div class="column is-6">
            <figure class="image is-3by4">
              <img src="/uploads/<?= e($primary_images[0]->image) ?>" alt="" style="height: 400px">
            </figure>
          </div>
          <div class="column is-6">
            <form action="/cart/add-item" method="post">
              <input type="hidden" name="color_id" value="<?= get_or_empty('color_id') ?>">
              <input type="hidden" name="product_id" value="<?= e($product->id) ?>">
              <input type="hidden" name="qty" value="1">
              <h1 class="title"><?= e($product->title) ?></h1>
              <p><?= e($product->description) ?></p>

              <div class="mt-4">
                <p class="subtitle">Available colors</p>
                <?php foreach($product_colors as $pcolor): ?>
                  <a href="/product/<?= $product->id ?>/show?color_id=<?= e(($c = $pcolor->color())->id); ?>">
                    <figure class="image is-64x64">
                      <img src="/uploads/<?= $product->productImages($c->id)->first()->image ?>" alt="" style="width: 64px; height: 64px">
                    </figure>
                  </a>
                  <?= e($c->color) ?>
                <?php endforeach; ?>
              </div>
              <div class="mt-4">
                <p class="subtitle">Available sizes</p>
                <?php foreach($product_sizes as $psize): ?>
                  <label class="label">
                    <input type="radio" name="size_id" value="<?= e($psize->size()->id); ?>"  >
                    <span class="text-xl"><?= e($psize->size()->size) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
              <p class="mt-4 subtitle">&#x20B9; <?= e($product->price_mp) ?></p>

              <div>
                <button class="button is-primary is-fullwidth" type="submit">Add to cart</button>
              </div>
              
            </form>

          </div>


        </div>
      </div>
    </div>
  </div>
</section>