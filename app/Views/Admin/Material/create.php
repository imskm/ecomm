<?php $this->use('templates/main.php',['title'=>'Ecomm | Material','mainPage'=>'Material','page'=>'Create Material']) ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Material Create</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Materials</li>
		              <li class="breadcrumb-item active">Material Create</li>
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
              	<a href="/admin/material/index" class="btn btn-secondary float-right">View All Materials</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/material/store" method="POST">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Material<span style="color:red;">*</span></label>
			                <input type="text" class="form-control" placeholder="Enter Material Name" name="material">
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
