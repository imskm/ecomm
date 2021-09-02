<?php $this->use('templates/main.php',['title'=>'Ecomm | Product','mainPage'=>'Product','page'=>'Create Product']) ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Product Size Create</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Products</li>
		              <li class="breadcrumb-item active">Product Size Create</li>
		            </ol>
		          </div>
        		</div>
        	</div>
       </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <?php include VIEW_PATH . '/partials/_newmessage.php' ?>

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
              <form action="/admin/product-size/store" method="post">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Product Name <span style="color:red;">*</span></label>
			                <input type="text" class="form-control" value="<?= e($product->title) ?>" name="title" readonly>
			                <input type="hidden" class="form-control" value="<?= e($product->id) ?>" name="product_id">
                  		</div>
                  		<div class="form-group">
			                <label>Product Code <span style="color:red;">*</span></label>
			                <input type="text" class="form-control" value="<?= e($product->code) ?>" readonly>
                  		</div>
                      <div class="form-group">
                        <label>Select Size <span style="color:red;">*</span></label><br>
                        <?php foreach($sizes as $size): ?>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" name="size_ids[]" type="checkbox" id="inlineCheckbox" value="<?= e($size->id) ?>" />
                          <label class="form-check-label" for="inlineCheckbox"><?= e($size->size) ?></label>
                        </div>
                          <?php endforeach; ?>
                       
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