<?php $this->use('templates/main.php',['title'=>'Ecomm | Coupons','mainPage'=>'Coupons','page'=>'Coupons Create']) ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <?php include VIEW_PATH . '/partials/_newmessage.php' ?>

    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Color Create</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Coupons</li>
		              <li class="breadcrumb-item active">Coupon Create</li>
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
              	<a href="/admin/color/index" class="btn btn-secondary float-right">View All Coupons</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/color/store" method="POST">
                <div class="card-body">
                  <div class="row">
                  	<div class="col-md-6">
                  		<div class="form-group">
			                <label>Coupon Name<span style="color:red;"> *</span></label>
			                <input type="text" class="form-control" placeholder="Enter Coupon Name" name="coupon_name">
                  		</div>
                  		<div class="form-group">
			                <label>Coupon Code<span style="color:red;"> *</span></label>
			                <input type="text" class="form-control" placeholder="Enter Coupon Code" name="coupon_code">
                  		</div>
                      <div class="form-group">
                      <label>Coupon Value<span style="color:red;"> *</span></label>
                      <input type="text" class="form-control" placeholder="Enter Coupon Value" name="coupon_value">
                      </div>
                      <div class="form-group">
                      <label>Activated At<span style="color:red;">*</span></label>
                      <input type="date" class="form-control"  name="activated_at">
                      </div>
                      <div class="form-group">
                      <label>Expiery at<span style="color:red;"> *</span></label>
                      <input type="date" class="form-control" name="expiered_at">
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
