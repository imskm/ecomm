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
		            <h1>Product Color Create</h1>
		          </div>
		          <div class="col-sm-6">
		            <ol class="breadcrumb float-sm-right">
		              <li class="breadcrumb-item"><a href="#">Home</a></li>
		              <li class="breadcrumb-item active">Products</li>
		              <li class="breadcrumb-item active">Product Color Create</li>
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
              	<a href="/admin/product/index" class="btn btn-secondary float-right">View All Products</a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/admin/product-image/update" method="post">
                <?php foreach($product_images as $pi): ?>
                  <input @change="fileSelected" type="file" name="photo[]" id="">
                  <button type="button" @click="uploadImage(<?= $pi->id ?>)">Upload</button>
                <?php endforeach; ?>
              </form>
            </div>
         </div>
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
  },

  methods: {
    uploadImage(product_id) {
      const url = "/admin/product-image/update";
      const form = new FormData();
      form.append("id", product_id);
      form.append("photo[]", this.file);

      axios.post(url, form)
      .then((response) => {
        console.log(response);
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