<?php $this->use('templates/main.php',['title'=>'Ecomm | Size','mainPage'=>'Size','page'=>'Edit Size']) ?>


<div class="content-wrapper">
    <?php include VIEW_PATH . '/partials/_newmessage.php' ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Size Edit</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Sizes</li>
		              <li class="breadcrumb-item active">Size Edit</li>
		            </ol>
		          </div>
        		</div>
        	</div>
       </div>
      </div><!-- /.container-fluid -->
    </section>

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
              	<a href="/admin/size/index" class="btn btn-secondary float-right">View All Sizes</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/size/<?= e($size->id) ?>/update" method="POST">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Size<span style="color:red;">*</span></label>
			                <input type="hidden" name="id" value="<?= e($size->id); ?>">
                      <input type="text" class="form-control" placeholder="Enter Size" name="size" value="<?= e($size->size); ?>">
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
