<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | <?= $title; ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="/assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="/assets/plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/assets/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

    
     
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="/assets/img/logo.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Ecomm Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/assets/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= App\Support\Authentication\Auth::user()->first_name; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/admin/home/index" class="nav-link <?php if($mainPage=='Dashboard'){ echo 'active'; } ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item <?php if($mainPage =='Product'){echo 'menu-open'; } ?> ">
            <a href="#" class="nav-link <?php if($mainPage =='Product'){echo 'active'; } ?>">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/product/create" class="nav-link <?php if($page =='Create Product'){echo 'active';} ?>">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Create Product </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/product/index" class="nav-link <?php if($page =='Product List'){echo 'active';} ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Product List </p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php if($mainPage =='Color'){echo 'menu-open'; } ?> ">
            <a href="#" class="nav-link <?php if($mainPage =='Color'){echo 'active';} ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Color
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/color/create" class="nav-link <?php if($page =='Create Color'){echo 'active';} ?>">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Create Color</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/admin/color/index" class="nav-link <?php if($page =='Color List'){echo 'active';} ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Color List</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item <?php if($mainPage =='Size'){echo 'menu-open'; } ?> ">
            <a href="#" class="nav-link <?php if($mainPage =='Size'){echo 'active';} ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Size
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/size/create" class="nav-link <?php if($page =='Create Size'){echo 'active';} ?>">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Create Size</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/admin/size/index" class="nav-link <?php if($page =='Size List'){echo 'active';} ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Size List</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item <?php if($mainPage =='Category'){echo 'menu-open'; } ?> ">
            <a href="#" class="nav-link <?php if($mainPage =='Category'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/category/create" class="nav-link <?php if($page =='Create Category'){echo 'active';} ?>">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Create Category</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/admin/category/index" class="nav-link <?php if($page =='Category List'){echo 'active';} ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Category List</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item <?php if($mainPage =='Material'){echo 'menu-open'; } ?> ">
            <a href="#" class="nav-link <?php if($mainPage =='Material'){echo 'active';} ?>">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Materials
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/material/create" class="nav-link <?php if($page =='Create Material'){echo 'active';} ?>">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Create Material</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="/admin/material/index" class="nav-link <?php if($page =='Material List'){echo 'active';} ?>">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Materials List</p>
                </a>
              </li> 
            </ul>
          </li>
          <li class="nav-item">
            <a href="/auth/logout" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <?php $this->content(); ?>
  <!-- /.content-wrapper -->


  <footer class="main-footer">
    <strong>Copyright &copy; 2021-2022 <a href="https://appzillians.com/">Appzillians</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/assets/js/pages/dashboard.js"></script>
</body>
</html>