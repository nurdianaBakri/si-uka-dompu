  

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

          <?php
          if ($this->session->flashdata('pesan')!="") 
          { ?>
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('pesan'); ?>
            </div>
          <?php } ?>

          <div class="box box-success struktural">
            <div class="box-header with-border"> </div>
            <div class="box-body">   
              <table id="example1" class="table table-bordered table-striped"> 
                <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Janis Pengajuan</th>
                    <th>Status</th> 
                    <th>Aksi</th> 
                  </tr>
                  </thead>
                <tbody>
    
                <?php

                foreach ($data as $key) 
                {                    
                      $jkp = "";
                      if ($key['jenis_kp']=='Reguler') {
                        $jkp = 'r';
                      }
                      elseif ($key['jenis_kp']=='Struktural') {
                        $jkp = 's';
                      }
                      else
                      {
                        $jkp='f';
                      }
                  ?>
                    <tr>
                      <td>
                        <a href="<?php echo base_url()."PengajuanBaru/detail/".$jkp."/".$key['NIK'];?>"> <?= $key['nip_baru'] ?></a>
                      </td>
                      <td><?php echo $key['nama']?></td>
                      <td><?php echo $key['jenis_kp']?></td>
                      <td><?php echo $key['status']?></td> 
                      <td>
                        <a href="<?php echo base_url()."PengajuanBaru/detail/".$jkp."/".$key['NIK']; ?>">
                          <button type="button" class="btn btn-sm btn-primary"  >
                            <i class="fa fa-list"></i> Detail
                          </button>
                        </a> 
                      </td>  
                        
                    </tr>
                  <?php
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>

          
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 

 <script>
  $(function () {
    $('#example1').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : false,
      'info'        : true,
      'autoWidth'   : false,
      "scrollX"     : true,
       'columnDefs': [
        {
            "targets": [0,1,2,3,4], // your case first column
            "className": "text-center",
       } ],
    })
  });
</script>
