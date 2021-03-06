
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

  <style type="text/css">
    .navbar-default .navbar-nav>li>a  {
          padding: 20px 15px 20px 15px;
      }
      .navbar-default .navbar-brand {
          padding-top: 0px;
      }
  </style>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">

          <a class="navbar-brand" href="#">
            <img src="<?= base_url()."assets/logo1.png"?>" width="30" height="30" alt="">
          </a>
 
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">

            <?php 
              $level = $this->session->userdata('level'); 
              if ($level=='Admin') { ?>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">List Pengajuan <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url()."PengajuanBaru" ?>">Pengajuan Baru</a></li>
                    <li><a href="<?php echo base_url()."PengajuanTolak" ?>">Pengajuan Ditolak</a></li>
                  </ul>
                </li>
                <li class=""><a href="<?php echo base_url()."Listpegawai" ?>">List Pegawai <span class="sr-only">(current)</span></a></li> 

              <?php } 

              $NIK = $this->session->userdata('NIK');

               if ($level!='Admin') { ?>
                <li class=""><a href="<?php echo base_url()."DataDiri/index/".$NIK ?>">Data Diri</a></li> 

                 <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pengajuan Kenaikan Pangkat <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?php echo base_url()."Pengajuan/index/".$this->session->userdata('NIK'); ?>">Data Pengajuan</a></li>
                    <li><a href="<?php echo base_url()."Pengajuan/form" ?>">Form Pengajuan</a></li>
                  </ul>
                </li> 
              <?php } ?>
          </ul> 
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
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
                  <a href="<?php echo base_url()."Login/logout"; ?>" class="btn btn-default btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
      </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
 