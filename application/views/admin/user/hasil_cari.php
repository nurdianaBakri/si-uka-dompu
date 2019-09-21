             

               <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
                <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

               <!-- Custom Js -->
                <script src="<?php echo base_url()."assets/" ?>js/pages/tables/jquery-datatable.js"></script>  <table id="example1" class="table table-bordered table-striped">

    
                <thead>
                <tr>
                  <th>NIP/Username</th>
                  <th>Nama User</th>
                  <th>TTL</th>
                  <th>Jenis Kelamin</th>
                  <th>Pendidikan</th>
                  <th>Level</th>
                  <?php if ($this->session->userdata('Level')!='Admin') { ?>
                  <th>Aksi</th>
                  <?php } ?>
                </tr>
                </thead>
                <tbody>
    
                <?php
                foreach ($data as $key) 
                {
                  ?>
                    <tr>
                      <td><?php echo $key['data_diri']['NIK']?></td>
                      <td><?php echo $key['data_diri']['GLRDPN']." ".$key['data_diri']['NAMA'].", ".$key['data_diri']['GLRBLKG']?></td>
                      <td><?php echo $key['data_diri']['TPT_LAHIR'].", ".date('d-M-Y', strtotime($key['data_diri']['TGL_LAHIR']))?></td>
                      <td><?php echo $key['jenis_kelamin']?></td>
                      <td><?php echo $key['nama_pendidikan']?></td>
                      <td><?php echo $key['data_diri']['level']; ?></td>

                      <?php if ($this->session->userdata('Level')!='Admin') { ?>
                        <td>
                          <a href="<?php echo base_url()."admin/User/detail/".$key['data_diri']['NIK']; ?>">
                            <button type="button" class="btn btn-sm btn-primary">
                              <i class="fa fa-pencil"></i> Edit
                            </button>
                          </a>  
                          <a href="<?php echo base_url()."admin/User/hapus/".$key['data_diri']['NIK']; ?>"  onclick="return confirm('Are you sure?')">
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
                  <th>NIP/Username</th>
                  <th>Nama User</th>
                  <th>TTL</th>
                  <th>Jenis Kelamin</th>
                  <th>Pendidikan</th>
                  <th>Level</th>

                   <?php if ($this->session->userdata('Level')!='Admin') { ?>
                  <th>Aksi</th>
                  <?php } ?>

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
