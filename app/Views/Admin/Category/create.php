<?php $this->use('templates/main.php',['title'=>'Ecomm | Category','mainPage'=>'Category','page'=>'Create Category'])?>

<div class="content-wrapper">
  
      <?php include VIEW_PATH . '/partials/_newmessage.php' ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Category Create</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Category</li>
		              <li class="breadcrumb-item active">Category Create</li>
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
              	<a href="/admin/category/index" class="btn btn-secondary float-right">View All Categories</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/category/store" method="POST">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Category Name<span style="color:red;">*</span></label>
			                <input type="text" class="form-control" placeholder="Enter Category Name" name="category">
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