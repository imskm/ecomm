<?php $this->use('templates/main.php',['title'=>'Product Color','mainPage'=>'Color','page'=>'Product Color']) ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Product Color List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product Color</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
           <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-default">
                  Create Product Color
                </button>
                <br />
                <br />
          </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Color Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Product Id</th>
                      <th>Color Id</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  	
                    <tr>
                      <td>1</td>
                      <td>1</td>
                      <td>1</td>
                      <td>
                      	<button type="submit" class="btn btn-primary">Edit</button>
                      </td>
                      <td>
                      	<button type="submit" class="btn btn-info">Delete</button>
                      </td>

                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create Product Color</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/admin/product-color/store" method="POST">
                  <div class="form-group">
                    <label>Color</label>
                    <input type="text" class="form-control"  placeholder="Enter Color" name="color_name">
                  </div>
                  <div class="form-group">
                    <label>Color Code</label>
                    <input type="text" class="form-control" placeholder="Enter Color Code" name="color_code">
                  </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    </section>
    <!-- /.content -->
  </div>