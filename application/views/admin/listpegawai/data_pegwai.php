 
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
                        <?php

                          $this->db->where('NIK',$key['data_diri']['NIK']);
                          $this->db->select('jenis_kp');
                          $this->db->select('status_pengajuan');
                          $cek_pengajuan = $this->db->get('pengajuan');
                          if ($cek_pengajuan->num_rows()>0)
                          {
                            // var_dump($cek_pengajuan)
                            echo "<ul style='list-style-type:none;'>";
                            foreach ($cek_pengajuan->result_array() as $key3)
                            {
                              echo "<li>".$key3['jenis_kp'];

                              if ($key3['status_pengajuan']=="Terima") {
                                echo " <i class='fa fa-eercast' aria-hidden='true' style='color: green;'></i>";
                              }
                              else if ($key3['status_pengajuan']=="Tolak") {
                                echo " <i class='fa fa-eercast' aria-hidden='true' style='color: red;'></i>";
                              }
                              else
                              {
                                 echo " <i class='fa fa-eercast' aria-hidden='true' style='color: blue;'></i>";
                              }
                              echo "</li>";
                            }
                            echo "</ul>";
                          }
                          else
                          { ?>
                            <i class="fa fa-eercast" aria-hidden="true" style="color: magenta;"></i>
                          <?php }
                        ?>
                        <!-- <i class="fa fa-eercast" aria-hidden="true" style="color: green;"></i> -->
                      </td> 

                        <td>
                          <a href="<?php echo base_url()."Listpegawai/download/".$key['data_diri']['NIK']; ?>">
                            <button type="button" class="btn btn-sm btn-primary">
                              <i class="fa fa-download"></i> Download
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
                    <li>
                        <i class="fa fa-eercast" aria-hidden="true" style="color: magenta;"></i> Belum di ajukan
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
