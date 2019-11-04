             

               <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
                <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

               <!-- Custom Js -->
                <script src="<?php echo base_url()."assets/" ?>js/pages/tables/jquery-datatable.js"></script>  <table id="example1" class="table table-bordered table-striped">

    
                <table id="example1" class="table table-bordered table-striped">    
                <thead>
                <tr>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Keterangan (data diri)</th>
                  <th>Status</th>
                  <th>Download</th>

                </tr>
                </thead>
                <tbody>
    
                <?php
                foreach ($data as $key) 
                {
                  ?>
                    <tr>
                      <td><?php echo $key['data_diri']['NIP_BARU']?></td>
                      <td><?php echo $key['data_diri']['GLRDPN']." ".$key['data_diri']['NAMA'].", ".$key['data_diri']['GLRBLKG']?></td>
                      <td><?php echo $key['data_diri']['TPT_LAHIR'].", ".date('d-M-Y', strtotime($key['data_diri']['TGL_LAHIR']))?> <br>
                        <?php echo $key['nama_pendidikan']?></td>
                      <td>-</td>


                        <td>
                          <a href="<?php echo base_url()."Listpegawai/download/".$key['data_diri']['NIK']; ?>">
                            <button type="button" class="btn btn-sm btn-primary">
                              <i class="fa fa-download"></i> Donload
                            </button>
                          </a>  
                        
                    </tr>
                  <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Keterangan (data diri)</th>
                  <th>Status</th>                  
                  <th>Download</th>                  
                </tr>
                </tfoot>
              </table>

            <script>
            $(function () {
              $('#example1').DataTable({
                'paging'      : false, 
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                "scrollX"      : true
              })
            })
          </script>
