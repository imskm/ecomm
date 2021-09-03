<?php $this->use('templates/main.php',['title'=>'Ecomm | Product','mainPage'=>'Product','page'=>'Product List'])?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include VIEW_PATH . '/partials/_newmessage.php' ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <h1>All Product List</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Product</li>
                  <li class="breadcrumb-item active">Product List</li>
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
        <div class="col-md-12">
           <a href="/admin/product/create" class="btn btn-primary float-right"> Create Product </a>
           <br />
           <br />
          </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product List Table</h3>

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
                      <th>code</th>
                      <th>Title</th>
                      <th>Description </th>
                      <th>Mark Price</th>
                      <th>Selling Price</th>
                      <th>Created At</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php foreach($products as $product): ?>
                    <tr>
                      <td><a href="/admin/product/<?= e($product->id) ?>/show"><?= $product->id ?></a></td>
                      <td><?= $product->code ?></td>
                      <td><?= $product->title ?></td>
                      <td><?= $product->description ?></td>
                      <td><?= $product->price_mp ?></td>
                      <td><?= $product->price_sp ?></td>
                      <td><?= $product->created_at ?></td>
                      <td>
                        <a href="/admin/product/<?= $product->id ?>/edit"><i class="far fa-edit"></i></a>
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