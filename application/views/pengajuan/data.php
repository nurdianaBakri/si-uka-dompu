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
                    <th>Jenis</th>
                    <th>Status</th> 
                    <th>Aksi</th> 
                  </tr>
                  </thead>
                <tbody>
    
                <?php
                foreach ($data->result_array() as $key) 
                {
                  ?>
                    <tr>
                      <td><?php echo "Kenaikan Pangkat ".$key['jenis_kp']?></td>
                      <td><?php echo $key['status_pengajuan']?></td> 
                      <td>
                        <a href="<?php echo base_url()."Pengajuan/detail/".$key['id_pengajuan']; ?>">
                          <button type="button" class="btn btn-sm btn-primary"  >
                            <i class="fa fa-list"></i> Lihat
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
    })
  });
</script>


