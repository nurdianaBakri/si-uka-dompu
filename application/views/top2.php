<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo $title; ?> | SI-UKA</title>
 <link rel="icon" href="<?= base_url()."assets/favicon.ico" ?>" type="image/x-icon" />
  <link rel="shortcut icon" href="<?= base_url()."assets/favicon.ico" ?>" type="image/x-icon" />

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> 
 
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/skins/_all-skins.min.css">
  
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="<?php echo base_url()."assets"; ?>/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    
  
  <!-- SlimScroll -->
  <script src="<?php echo base_url()."assets"; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <!-- <script src="<?php echo base_url()."assets"; ?>/bower_components/fastclick/lib/fastclick.js"></script> -->
  <!-- AdminLTE App -->
  <script src="<?php echo base_url()."assets"; ?>/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url()."assets"; ?>/dist/js/demo.js"></script>
  <!-- page script --> 


</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

<!-- //header -->
<!-- ============================================================================================== -->
  <header class="main-header">
   <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>-UKA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI</b>-UKA</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url()."assets"; ?>/dist/img/avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->session->userdata('NAMA'); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url()."assets"; ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">

                <p>
                  <?php 
                  $NIK =$this->session->userdata('NIK');
                  echo $this->session->userdata('NAMA'); ?>
                  <small><?php echo $this->session->userdata('level'); ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url()."DataUser/profile/".$NIK; ?>" class="btn btn-default btn-flat">Profile</a>
                </div>
              </li>
            </ul>
          </li>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
   <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()."assets"; ?>/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('NAMA'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li> 
          <?php 
          $level = $this->session->userdata('level'); 

          if ($level=='Admin') { ?>
            <a href="<?php echo base_url()."kpRegular/index"; ?>">
          <?php } else {?>
            <a href="<?php echo base_url()."kpRegular/detail/".$NIK; ?>"> 
          <?php } ?>
            <i class="fa fa-fw fa-object-group"></i> <span>KP REGULER</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        <?php if ($level=='Admin') { ?>
         <li>
          <a href="<?php echo base_url()."admin/User"; ?>">
            <i class="fa fa-fw fa-object-group"></i> <span>User</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      <?php } ?>
        <li> 
           <?php if ($level=='Admin') { ?>
            <a href="<?php echo base_url()."kpStruktural/index"; ?>">
          <?php } else {?>
            <a href="<?php echo base_url()."kpStruktural/detail/".$NIK; ?>"> 
          <?php } ?> 
            <i class="fa fa-fw fa-object-group"></i> <span>KP STUKTURAL</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

 