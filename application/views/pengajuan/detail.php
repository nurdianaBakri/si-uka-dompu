  
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
                <div class="alert alert-info"> 
                    <h5><i class="icon fa fa-check"></i>Info ! </h5>
                    <p>Pengajuan Kenaikan Pangkat Anda sedang dalam proses</p>
                </div>   
              <?php
            }
            else if ($data['status_pengajuan']=="Terima")
            { ?> 
               <div class="alert alert-success"> 
                    <h5><i class="icon fa fa-check"></i>Info ! </h5>
                    <p>Pengajuan Kenaikan Pangkat telah di terima </p>
                </div>  
            <?php }
            else
            {
              ?>  
                <div class="alert alert-warning"> 
                  <h5><i class="icon fa fa-check"></i>Info ! </h5>
                  <p>Pengajuan Kenaikan Pangkat tertolak </p>
                  <li> Alasan : <?= $data['alasan']; ?></li>
                </div>  
 

                <center>
                  <a href="<?= base_url()."Pengajuan/form" ?>" class="btn btn-primary">Ajukan Kembali</a>
                </center> 
              <?php
            }  
            ?>    
            </div>

            <div class="box-footer">
              <a href="<?= base_url()."Pengajuan/index/".$this->session->userdata('NIK') ?>" class="btn btn-primary btn-flat" id="submit">Kembali </a>
            </div> 
          
            <br>
          </div> 
          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 
 

