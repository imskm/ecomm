<?php $this->use('templates/main.php',['title'=>'Ecomm | Product','mainPage'=>'Product','page'=>'']) ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Product Details</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Products</li>
		              <li class="breadcrumb-item active">Product Details</li>
		            </ol>
		          </div>
        		</div>
        	</div>
       </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Product Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <th>Product Code</th>
                      <td><?= e($product->code) ?></td>
                    </tr>
                    <tr>
                      <th>Product Name</th>
                      <td><?= e($product->title) ?></td>
                    </tr>
                    
                    <tr>
                      <th>Marked Price</th>
                      <td><?= e($product->price_mp) ?></td>
                    </tr>
                    <tr>
                      <th>Selling Price</th>
                      <td><?= e($product->price_sp) ?></td>
                    </tr>
                    <tr>
                      <th>Price Description</th>
                      <td><?= e($product->description) ?></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Product Category</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <th>product Category</th>
                      <td><?= $product->category()->category ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Product Availabe Colors</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-borderless">
                  <tbody>
                    <tr>
                      <th>product Colors</th>
                      <td>
                        <ul>
                        <?php foreach($product_colors as $pcolor): ?>
                          <li><?= e($pcolor->color()->color) ?></li> 
                          <?php endforeach; ?>  
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary">
                <h3 class="card-title">Product Available Stock</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-borderless">
                  <tbody>
                    
                      <?php foreach ($product_stocks as $product_stock): ?>
                      <tr>
                      <th>Size (<?= e($product_stock->size()->size)?>)</th>
                      <td>
                          <?= e($product_stock->stock) ?>
                      </td>
                    </tr>
                      <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
</div>