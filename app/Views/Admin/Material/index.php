<?php $this->use('templates/main.php',['title'=>'Ecomm | Material','mainPage'=>'Material','page'=>'Material List'])?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="row ">
              <div class="col-sm-6">
                <h1>All Materials List</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Materials</li>
                  <li class="breadcrumb-item active">Materials List</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="col-md-12">
           <a href="/admin/material/create" class="btn btn-primary float-right"> Create Material </a>
           <br />
           <br />
          </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Material List Table</h3>

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
                      <th>Material</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($materials as $material): ?>
                  	
                    <tr>
                      <td> <?= $material->id; ?> </td>
                      <td> <?= $material->material; ?> </td>
                      <td>
                        <a href="index"><i class="far fa-edit"></i></a>
                        <a href="#"><i class="far fa-trash-alt"></i></a>
                      </td>

                    </tr>
                    <?php endforeach; ?>
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
    </section>
    <!-- /.content -->
  </div>