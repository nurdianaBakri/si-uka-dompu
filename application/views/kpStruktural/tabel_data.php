
  <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
  <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

 <!-- Custom Js -->
  <script src="<?php echo base_url()."assets/" ?>js/pages/tables/jquery-datatable.js"></script>  

         <table id="example1" class="table table-bordered table-striped"> 
                <thead>
                  <tr>
                    <th>NIP</th>
                    <th>NIK</th>
                    <th>Nama Pegawai</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Pendidikan</th> 
                    <th>Aksi</th> 
                  </tr>
                  </thead>
                <tbody>
    
                <?php
                foreach ($data as $key) 
                {
                  ?>
                    <tr>
                      <td><?php echo $key['NIP_BARU']?></td>
                      <td><?php echo $key['NIK']?></td>
                      <td><?php 
                        $nama = "";
                          $nama = $key['data_pengguna']['NAMA'];

                        if ($key['data_pengguna']['GLRBLKG']==null)
                        {
                          $nama = $key['data_pengguna']['NAMA'];
                        }
                        else
                        {
                          $nama = $key['data_pengguna']['NAMA'].", ".$key['data_pengguna']['GLRBLKG'];
                        }

                        if ($key['data_pengguna']['GLRDPN']==null)
                        {
                          $nama = $nama;
                        }
                        else
                        {
                          $nama = $key['data_pengguna']['GLRDPN'].". ".$nama;
                        } 
                        echo $nama;?>
                          
                        </td>
                      <td><?php echo $key['data_pengguna']['TPT_LAHIR'].", ".date('d-M-Y', strtotime($key['data_pengguna']['TGL_LAHIR']))?></td>
                      <td><?php echo $key['KD_PDDKN']?></td>

                      <?php if ($this->session->userdata('Level')!='Admin') { ?>
                        <td>
                          <a href="<?php echo base_url()."kpRegular/detail/".$key['NIK']; ?>">
                            <button type="button" class="btn btn-sm btn-primary"  >
                              <i class="fa fa-pencil"></i> Edit
                            </button>
                          </a>  
                          <a href="<?php echo base_url()."kpRegular/hapus/".$key['NIK']; ?>"  onclick="return confirm('Are you sure?')">
                            <button type="button" class="btn btn-sm btn-danger">
                              <i class="fa fa-trash"></i> Hapus
                            </button>
                          </a>  
                        </td>
                      <?php } ?>
                        
                    </tr>
                  <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>NIP</th>
                    <th>NIK</th> 
                    <th>Nama Pegawai</th>
                    <th>Tempat Tanggal Lahir</th>
                    <th>Pendidikan</th> 
                    <th>Aksi</th> 
                </tr>
                </tfoot>
              </table>

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
