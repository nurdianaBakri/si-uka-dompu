 
               <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/jquery.dataTables.js"></script>
                <script src="<?php echo base_url()."assets/" ?>plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

               <!-- Custom Js -->
                <script src="<?php echo base_url()."assets/" ?>js/pages/tables/jquery-datatable.js"></script>  

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
                  ?>
                    <tr>
                      <td> <?= $key['nip_baru'] ?></td>
                      <td><?php echo $key['nama']?></td>
                      <td><?php echo $key['jenis_kp']?></td>
                      <td><?php echo $key['status']?></td> 
                      <td>
                        <a href="<?php echo base_url()."PengajuanTolak/detail/".$key['jenis_kp']."/".$key['NIK']; ?>">
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

            <script>
            $(function () {
              $('#example1').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : true,
                'ordering'    : false,
                'info'        : true,
                'autoWidth'   : false,
                "scrollX": true,
                  'columnDefs': [
                  {
                      "targets": [0,1,2,3,4], // your case first column
                      "className": "text-center",
                 } ],
              })
            })
          </script>
