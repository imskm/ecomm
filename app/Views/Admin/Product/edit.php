<?php $this->use('templates/main.php',['title'=>'Ecomm | Product','mainPage'=>'Product','page'=>'Edit Product']) ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Edit Product</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Products</li>
		              <li class="breadcrumb-item active">Product Edit</li>
		            </ol>
		          </div>
        		</div>
        	</div>
       </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <?php include VIEW_PATH . '/partials/_message.php' ?>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              	<a href="/admin/product/index" class="btn btn-secondary float-right">View All Products</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/product/<?= $product->id ?>/update" method="post">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Product Name<span style="color:red;">*</span></label>
			                <input type="text" class="form-control" placeholder="Enter Product Name" name="title" value="<?= e($product->title) ?>">
                      <input type="hidden" name="id" value="<?= e($product->id) ?>">
                  		</div>
                  		<div class="form-group">
			                <label>Marked Price<span style="color:red;">*</span></label>
			                <input type="number" class="form-control" placeholder="Enter Marked Price" name="price_mp" value="<?= e($product->price_mp) ?>">
                  		</div>
                  		<div class="form-group">
			                <label>Selling Price<span style="color:red;">*</span></label>
			                <input type="number" class="form-control" placeholder="Enter Selling Price" name="price_sp" value="<?= e($product->price_sp) ?>">
                  		</div>
                  		<div class="form-group">
                  			<label>Category<span style="color:red;">*</span></label>
                  		

                        <select class="form-control" name="category_id">
                  				<option disabled="">Select Category</option>
                  				<?php foreach ($categories as $c): ?>
                  					<option
                              value="<?= e($c->id) ?>"
                              <?= $product->category_id == $c->id ? "selected" : "" ?>>
                                <?= e($c->category) ?>
                            </option>
                  				<?php endforeach; ?>
			                  </select>
                  		


                      </div>
                  	</div>
                  	<div class="col-md-6">
                  		<div class="form-group">
                    		<label>Product Code<span style="color:red;">*</span></label>
                    		<input type="text" class="form-control" placeholder="Enter Title" name="code" value="<?= e($product->code) ?>">
                  		</div>
                  		<div class="form-group">
                    		<label>Description<span style="color:red;">*</span></label>
                    		<textarea class="form-control" name="description" rows="4"><?= e($product->description) ?></textarea>
                  		</div>
                  		<div class="form-group">
                  			<label>Material<span style="color:red;">*</span></label>


                  			<select class="form-control" name="material_id">
                  				<option disabled="" selected="">Select Material</option>
                  				<?php foreach ($materials as $m): ?>
				                    <option
                              <?= $product->material_id == $m->id ? "selected" : "" ?>
                              value="<?= e($m->id) ?>">
                              <?= e($m->material) ?>
                            </option>
                  				<?php endforeach; ?>
			                  </select>
                  		

                      </div>
                  	</div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
         </div>
       	</div>
      </div>
  	</section>
</div>
