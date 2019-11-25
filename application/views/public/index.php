<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="<?= base_url()."assets/favicon.ico" ?>" type="image/x-icon" />
  <link rel="shortcut icon" href="<?= base_url()."assets/favicon.ico" ?>" type="image/x-icon" />

    <title>SI-UKA Kab. Dompu</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()."assets_public/" ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()."assets_public/" ?>css/half-slider.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">SI-UKA Kab. Dompu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Beranda
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pengumuman</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url()."Login" ?>">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url(<?php echo  base_url()."assets/slider/1.jpeg" ?>)">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

           <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(<?php echo  base_url()."assets/slider/2.jpeg" ?>)">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

           <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(<?php echo  base_url()."assets/slider/3.jpeg" ?>)">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

           <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(<?php echo  base_url()."assets/slider/4.jpeg" ?>)">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>

           <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url(<?php echo  base_url()."assets/slider/5.jpeg" ?>)">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
         
         
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <section class="py-5">
      <div class="container">
        <div class="row">
          
          <div class="col-xs-12">

            <div class="jumbotron">
            <h3 class="display-4">SELAMAT DATANG DI SISTEM INFORMASI USULAN KENAIKAN PANGKAT KABUPATEN DOMPU !</h3>
            <p class="lead">Sistem informasi yang memudahkan pengajuan kenaikan pangkat berbasis website, PNS dapat mengajukan pengangkatan pangkat secara online</p>
            <hr class="my-4">
           <p style="text-align: justify;">
               Bahan yang diunggah :
               <li>foto copy sk pangkat terakhir</li>
               <li>Foto sk cpns untuk KP Pertamakali *)</li>
               <li>PPK 2 Tahun terakhir</li> 
             </p>
          </div>

 
          </div>
          <div class="col">
             
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-primary">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; BKD Dompu <?php echo date('Y'); ?></p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url()."assets_public/" ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url()."assets_public/" ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
