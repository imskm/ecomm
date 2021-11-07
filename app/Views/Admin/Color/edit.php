<?php $this->use('templates/main.php',['title'=>'Ecomm | Color','mainPage'=>'Color','page'=>'Edit Color']) ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php include VIEW_PATH . '/partials/_newmessage.php' ?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Color Edit</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Colors</li>
		              <li class="breadcrumb-item active">Color Edit</li>
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
              	<a href="/admin/color/index" class="btn btn-secondary float-right">View All Colors</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/color/<?= e($color->id) ?>/update" method="POST">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Color Name<span style="color:red;">*</span></label>
			                <input type="hidden" name="id" value="<?= e($color->id) ?>">
                      <input type="text" class="form-control" name="color" value="<?= e($color->color) ?>">
                  		</div>
                  		<div class="form-group">
			                <label>Color Code<span style="color:red;">*</span></label>
			                <input type="text" class="form-control" name="code" value="<?= e($color->code) ?>">
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
