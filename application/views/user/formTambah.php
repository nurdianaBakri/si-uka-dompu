  
  <?php $level_user= $this->session->userdata('level'); ?>
  <?php $id_user= $this->session->userdata('id'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tambah User
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url()."index.php/web/User/getAll/".$id_user; ?>"><i class="fa fa-dashboard"></i>Data Pengguna</a></li>
        <li><a href="#">Tambhah User</a></li>
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
          <?php }
          ?>

          <!-- Horizontal Form -->
          <div class="box box-success">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url().'index.php/web/User/tambah/'; ?>" method="post" name="myForm">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                      <div class="col-sm-10">
                        <div id="nama" style="color: red"></div>
                        <input type="text" name="nama" class="form-control" required >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Nama Panggilan</label>
                      <div class="col-sm-10">
                        <div id="nama_panggilan" style="color: red"></div>
                        <input type="text" name="nama_panggilan" class="form-control" required>
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Username</label>
                      <div class="col-sm-10">
                        <div id="username" style="color: red"></div>
                        <input type="text" name="username" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">Jabatan</label>
                      <div class="col-sm-10">
                        <select class="form-control select2" name="level" style="width: 100%;" required>
                        	<?php 
				                if ($data['id_fak']==0 && $data['id_jur']==0 && $data['bagian']!=0 && $data['subagian']!=0) //sub bagian rektorat
				                {
				                    ?>
				                        <option  value="kasubag">Kepala Sub Bagian</option>
				                        <option  value="protokol">Protokol</option>
				                        <option  value="staff">Staff</option>
				                    <?php
				                }
				                else if ($data['id_fak']==0 && $data['id_jur']==0 && $data['bagian']!=0 && $data['subagian']==0) //bagian rektorat
				                {
				                    ?>
                                <option  value="rektor">Rektor</option>
				                        <option  value="wr1">Wakil Rektor 1</option>
				                        <option  value="wr2">Wakil Rektor 2</option>
				                        <option  value="wr3">Wakil Rektor 3</option>
				                        <option  value="wr4">Wakil Rektor 4</option>
	                        			<option  value="kabag">Kepala Bagian</option>
				                    	<option  value="kasubag">Kepala Sub Bagian</option>
				                        <option  value="protokol">Protokol</option>
				                        <option  value="staff">Staff</option>
				                    <?php
				                }
				                else if ($data['id_fak']!=0 && $data['id_jur']==0 && $data['bagian']==0 && $data['subagian']==0) //fakultas
				                {
				                    ?>
				                    	<option  value="dekan">Dekan</option>
				                    	<option  value="kabag">Kepala Bagian</option>
				                    	<option  value="kasubag">Kepala Sub Bagian</option>
				                        <option  value="protokol">Protokol</option>
				                        <option  value="staff">Staff</option>
				                    <?php
				                }
				                else if ($data['id_fak']==0 && $data['id_jur']!=0 && $data['bagian']==0 && $data['subagian']==0) //jurusan
				                {
				                    ?>
				                    	<option  value="kajur">Kepala Jurusan</option>
				                        <option  value="dosen">Dosen</option>
				                        <option  value="protokol">Protokol</option>
				                        <option  value="staff">Staff</option>
				                    <?php
				                }
                         else if ($data['id_fak']!=0 && $data['id_jur']!=0 && $data['bagian']==0 && $data['subagian']==0) //jurusan
                        {
                            ?>
                              <option  value="kajur">Kepala Jurusan</option>
                                <option  value="dosen">Dosen</option>
                                <option  value="protokol">Protokol</option>
                                <option  value="staff">Staff</option>
                            <?php
                        }
                        	?>
	                      </select>
                      </div>
                    </div>

                      <input type="hidden" name="fakultas" value="<?php echo $data['id_fak']; ?>">
                      <input type="hidden" name="jurusan" value="<?php echo $data['id_jur']; ?>">
                      <input type="hidden" name="bagian" value="<?php echo $data['bagian']; ?>">
                      <input type="hidden" name="subagian" value="<?php echo $data['subagian']; ?>">
                      <input type="hidden" name="level_user" value="<?php echo $level_user; ?>">
                      <input type="hidden" name="admin" value="<?php echo $id_user; ?>">
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-success btn-block btn-flat" id="submit">Simpan</button>
                  </div>
                  <!-- /.box-footer -->
                </form>

          </div>
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


  <script type="text/javascript">

    $('#submit').click(function(){

       if( document.myForm.nama.value == "" )
       {
          $('#nama').html("silahkan masukkan nama");
          document.myForm.nama.focus() ;
       }
       if( document.myForm.nama_panggilan.value == "" )
       {
          $('#nama_panggilan').html("silahkan masukkan nama panggilan");
          document.myForm.nama_panggilan.focus() ;
       }
       if( document.myForm.username.value == "" )
       {
          $('#username').html("silahkan masukkan username");
          document.myForm.username.focus() ;
       }
  }); 
    
  </script>

