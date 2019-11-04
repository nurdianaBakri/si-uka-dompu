 
               <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
                <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

               <!-- Custom Js -->
                <script src="<?php echo base_url()."assets/" ?>js/pages/tables/jquery-datatable.js"></script>  

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
                      <td>
                         <a href="<?php echo base_url()."Listpegawai/detail/".$key['data_diri']['NIK']; ?>">
                            <?php echo $key['data_diri']['NIP_BARU']?>
                          </a>                        
                          
                        </td>
                      <td><?php echo $key['data_diri']['GLRDPN']." ".$key['data_diri']['NAMA'].", ".$key['data_diri']['GLRBLKG']?></td>
                      <td><?php echo $key['data_diri']['TPT_LAHIR'].", ".date('d-M-Y', strtotime($key['data_diri']['TGL_LAHIR']))?> <br>
                        <?php echo $key['nama_pendidikan']?></td>
                      <td> 
                        <i class="fa fa-eercast" aria-hidden="true" style="color: green;"></i>
                      </td>


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

              <div class="row">
                <div class="col-md-12">
                  <ul>
                    Status : 
                    <li>
                        <i class="fa fa-eercast" aria-hidden="true" style="color: green;"></i> Diterima
                    </li>
                    <li>
                        <i class="fa fa-eercast" aria-hidden="true" style="color: red;"></i> Ditolak
                    </li>
                    <li>
                        <i class="fa fa-eercast" aria-hidden="true" style="color: blue;"></i> Idle (Belum Di Proses)
                    </li> 
                  </ul>
                    
                </div>
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
                "scrollX": true
              })
            })
          </script>
