  
  <?php $level_user= $this->session->userdata('level'); ?>
  <?php $id_user= $this->session->userdata('id'); ?>


  <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

 <!-- Custom Js -->
  <script src="<?php echo base_url()."assets/" ?>js/pages/tables/jquery-datatable.js"></script>  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Pengajuan</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- right column -->
        <div class="col-md-12"> 

          <div class="box box-success struktural">
            <div class="box-header with-border"> Detail Pengajuan <?= $data['jenis_kp'] ?> </div>
            <div class="box-body"> 

            <?php
            if ($data['status_pengajuan']=="Dalam Proses")
            {
              ?> 
              <div class="jumbotron">
                <h1 class="display-4"><?= $data['status_pengajuan']; ?> </h1>
                <p class="lead">Status Pengajuan</p> 
              </div> 
              <?php
            }
            else
            {
              ?> 
              <div class="jumbotron">
                <h1 class="display-4">Alasan Penolakan</h1>
                <p class="lead"><?= $data['status_pengajuan']; ?></p> 
              </div> 
              <?php
            }  
            ?>   
               
            </div>
          </div> 
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
 

