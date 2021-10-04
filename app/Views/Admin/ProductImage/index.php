<?php $this->use('templates/main.php',['title'=>'Ecomm | Product','mainPage'=>'Product','page'=>'Product Image']) ?>

<div id="app" class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include VIEW_PATH . '/partials/_newmessage.php' ?>
    <section class="content-header">
      <div class="container-fluid">
        <div class="card">
        	<div class="card-body">
        		<div class="row">
		          <div class="col-sm-6">
		            <h1>Product Image Create</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Products</li>
		              <li class="breadcrumb-item active">Product Image Create</li>
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
              	<a href="/admin/product/index"><button type="button" class="btn btn-secondary">View All Products</button></a>
                <a href="/admin/product/<?= e($product_id) ?>/show"><button type="button" class="btn btn-info">Product Details</button></a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
            </div>
         </div>
         <form action="/admin/product-image/update" method="post">
          <?php foreach($product_images as $pimages): ?>
          <div class="col-md-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title"><?= e($pimages["color"]->color) ?></h3>
              </div>
            <!-- /.card-header -->
            <!-- /.card-body -->
              <div class="card-footer bg-white">
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                  <?php foreach ($pimages["images"] as $pi): ?>

                  <li>
                    <span class="mailbox-attachment-icon has-img"><img src="/uploads/<?= $pi->image ?>" alt="Attachment"></span>
                    <div class="mailbox-attachment-info">
                          <span class="mailbox-attachment-size clearfix mt-1">
                            <span><input @change="fileSelected" type="file" name="photo[]" id=""></span>
                            <button type="button" class="btn btn-primary" @click="uploadImage(<?= $pi->id ?>)">Upload</button>
                          </span>
                    </div>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          <!-- /.card -->
          </div>
          <?php endforeach; ?>
         </form>
       	</div>
      </div>
  	</section>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
<script>
const app = new Vue({
  el: "#app",
  data: {
    file: null,
    errors: {},
  },

  methods: {
    uploadImage(product_id) {
      const url = "/admin/product-image/update";
      const form = new FormData();
      form.append("id", product_id);
      form.append("photo[]", this.file);

      axios.post(url, form)
      .then((response) => {
        const res = response.data;

        console.log(response.data);
        if (res.status == "error") {
          console.log(res.errors);
          this.errors = res.errors;
        }

      }).catch((error) => {
        console.log(error);
      });
    },

    fileSelected(e) {
      this.file = e.target.files[0];
    },
  },

});
</script>
