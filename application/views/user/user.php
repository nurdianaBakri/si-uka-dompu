  
 

 


   <?php $id_user= $this->session->userdata('id'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Pengguna
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user active"></i> Data Pengguna</a></li> 
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
           <?php
          if ($this->session->flashdata('pesan')!="") 
          { ?>
           <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                <?php echo $this->session->flashdata('pesan'); ?>
            </div>
          <?php }
          ?>
          <div class="box">
            <div class="box-header">
              
              <h3 class="box-title"><a  href="<?php echo base_url()."index.php/web/User/formTambahUser/".$id_user; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> User</a></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <li>
                User yang bertanda   <small class="label bg-red">[nama]</small> merupakan user yang tidak aktif, tekan tombol <button class="btn btn-warning btn-xs"><i class="fa fa-key"></i></button> untuk mengaktifkan/menonaktifkan user kembali
              </li>
              <li>
                Tekan tombol <button class="btn btn-success btn-xs"><i class="fa fa-unlock"></i></button> untuk mereset password user
              </li>
               <li>
                Tekan tombol <button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button> untuk menghapus user
              </li>
               <li>
                Tekan tombol <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button> untuk meng-edit user
              </li>
              <br>
              

              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Fakultas</th>
                    <th>Jurusan</th>
                    <th>Bagian</th>
                    <th>Sub Bagian</th>
                    <th>Level</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>


                   <?php
                    foreach ($data as $key ) 
                    { 
                      ?>
                        <tr>
                          <td><?php 

                            if ($key['active']=="Tidak Active") 
                            {
                              ?>
                                <small class="label bg-red"><?php echo "  ".$key['nama'];  ?></small>
                              <?php
                            }
                            else
                            {
                              echo "  ".$key['nama']; 
                            } ?></td>
                          <td><?php echo "  ".$key['nama_fakultas']; ?></td>
                          <td><?php echo "  ".$key['nama_jurusan']; ?></td>
                          <td><?php echo "  ".$key['nama_bagian']; ?></td>
                          <td><?php echo "  ".$key['nama_subagian']; ?></td>
                          <td><?php echo "  ".$key['level']; ?></td>
                          <td>
                            <a href="<?php echo base_url()."index.php/web/User/detailUser/".$key['id'] ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>

                            <a href="<?php echo base_url()."index.php/web/User/hapus/".$key['id']."?lvl=admin&usr=".$id_user ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>

                            <a href="<?php echo base_url()."index.php/web/User/reset/".$key['id']."/".$id_user ?>" class="btn btn-success"><i class="fa fa-unlock"></i></a>


                            <a href="<?php echo base_url()."index.php/web/User/nonaktif/".$key['id']."/".$id_user ?>" class="btn btn-warning"><i class="fa fa-key"></i></a>
                          </td>
                        </tr>
                    <?php }  ?>
                  </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Fakultas</th>
                  <th>Jurusan</th>
                  <th>Bagian</th>
                  <th>Sub Bagian</th>
                  <th>Level</th>
                    <th>Aksi</th>

                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>


    </div>
    <!-- /.content -->
  </div>

  <script>
    $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
    })
  </script>
