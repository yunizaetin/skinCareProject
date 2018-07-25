<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>OlShop</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url().'backend/'?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'backend/'?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url().'backend/'?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'backend/'?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?php echo base_url().'backend/'?>dist/css/skins/skin-red-light.min.css">
  <!-- load library -->
  <link rel="stylesheet" href="<?php echo base_url().'backend/'?>bower_components/select2/dist/css/select2.min.css">
  <!-- REQUIRED JS SCRIPTS -->
<link rel="stylesheet" href="<?php echo base_url().'backend/'?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- jQuery 3 -->
  <script src="<?php echo base_url().'backend/'?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url().'backend/'?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url().'backend/'?>dist/js/adminlte.min.js"></script>
  <!-- load library -->
  <script src="<?php echo base_url().'backend/'?>bower_components/select2/dist/js/select2.min.js"></script>
<!-- CHART JS  -->
  <script src="<?php echo base_url().'backend/'?>bower_components/Chart.js/Chart.js"></script>

  <script src="<?php echo base_url().'backend/'?>dist/js/demo.js"></script>

  <script src="<?php echo base_url().'backend/'?>dist/js/pages/dashboard2.js"></script>

  <script src="<?php echo base_url().'backend/'?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  
<script src="<?php echo base_url().'backend/'?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<script src="<?php echo base_url().'backend/'?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url().'backend/'?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url().'backend/'?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url().'backend/'?>bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url().'backend/'?>bower_components/fastclick/lib/fastclick.js"></script>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
    .control-label {
      text-align: left !important;
    }
  </style>
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>O</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Orvala</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="<?php echo base_url().'backend/'?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $this->session->userdata( 'staff' )['nama_lengkap']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="<?php echo base_url().'backend/'?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->session->userdata( 'staff' )['email']; ?>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('back/Logout')?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url().'backend/'?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata( 'staff' )['nama_lengkap']; ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <?php
          $link = explode("/", uri_string());
        ?>
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="<?php if(strtolower($link[1]) == "dashboard") echo 'active'; ?>"><a href="<?php echo site_url('back/dashboard')?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="<?php if(strtolower($link[1]) == "produk") echo 'active'; ?>"><a href="<?php echo site_url('back/produk')?>"><i class="fa fa-briefcase"></i> <span>Produk</span></a></li>
        <li class="<?php if(strtolower($link[1]) == "kategori") echo 'active'; ?>"><a href="<?php echo site_url('back/kategori')?>"><i class="fa fa-list"></i> <span>Kategori Produk</span></a></li>
        <li class="<?php if(strtolower($link[1]) == "pegguna") echo 'active'; ?>"><a href="<?php echo site_url('back/pengguna')?>"><i class="fa fa-users"></i> <span>Pengguna</span></a></li>
        
        <li class="treeview <?php if(strtolower($link[1]) == "transaksi") echo 'active'; ?>">
        <a href="#">
        <i class="fa fa-shopping-cart"></i>
            <span>Transaksi</span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($link[2]) && $link[2] == "aktif") echo 'active'; ?>">
            <a href="<?php echo site_url('back/transaksi')?>">
            <i class="fa fa-circle-o"></i> Semua Transaksi </a></li>
            <li class="<?php if(isset($link[2]) && $link[2] == "expaired ") echo 'active'; ?>">
            <a href="<?php echo site_url('back/transaksi')?>">
            <a href="<?php echo site_url('back/transaksi/expaired')?>">
            <i class="fa fa-circle-o"></i> Transaksi Expaired </a></li>
          </ul>
        </li>

        <li class="treeview <?php if(strtolower($link[1]) == "setting") echo 'active'; ?>">
          <a href="#">
            <i class="fa fa-gear"></i>
            <span>Pengaturan</span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php if(isset($link[3]) && $link[3] == "about") echo 'active'; ?>">
            <a href="<?php echo site_url('back/setting/about')?>">
            <i class="fa fa-circle-o"></i> Tentang Kami</a></li>
            <li class="<?php if(isset($link[3]) && $link[3] == "help") echo 'active'; ?>">
            <a href="<?php echo site_url('back/setting/about')?>">
            <a href="<?php echo site_url('back/setting/help')?>">
            <i class="fa fa-circle-o"></i> Bantuan</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>