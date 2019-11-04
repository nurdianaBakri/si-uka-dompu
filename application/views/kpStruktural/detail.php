<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php 
        echo $title_box; 
        ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Pace page</li>
      </ol>
    </section>  

    <section class="content">  
      <!-- Default box -->
      <div class="row">

        <form class="form-horizontal" action="<?php echo base_url().'Pengajuan/do_pengajuan'; ?>" method="post" enctype="multipart/form-data">

        <div class="col-md-12">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title_header2; ?></h3>
            </div>
            <div class="box-body">

              <?php
              if ($this->session->flashdata('pesan')!="") 
              { ?>
               <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $this->session->flashdata('pesan'); ?>
                </div>
              <?php } ?> 

                
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="NIP" id="inputEmail3" value="<?php echo $data['data']['NIP_BARU'] ?>" readonly required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Depan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_pengguna']['GLRDPN']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_pengguna']['NAMA']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_pengguna']['GLRBLKG']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pangkat </label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="NM_GOLRU" value="<?php echo $data['data_golru']['NM_GOLRU']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="jabatan" value="<?php echo $data['data']['JABATAN']?>" required="required">
                    </div>
                  </div>  

                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ket Jabatan</label>
                  <div class="col-sm-10"> 
                     <select class="form-control" disabled> 
                      <?php foreach ($data['data_ket_jabatan'] as $key): ?>
                        <option value="<?php echo $key['KD_JABATAN'] ?>" <?php if($key['KD_JABATAN']==$data['data']['KET_JABATAN']){ echo "selected"; } ?>  ><?php echo $key['NM_JABATAN'] ?></option> 
                      <?php endforeach ?>  
                      </select> 
                  </div>
                </div> 

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Unit Kerja</label>
                  <div class="col-sm-10"> 
                     <select class="form-control" disabled> 
                      <?php foreach ($data['data_kd_unker'] as $key): ?>
                        <option value="<?php echo $key['KD_UNKER'] ?>" <?php if($key['KD_UNKER']==$data['data']['KD_UNKER']){ echo "selected"; } ?>  ><?php echo $key['NM_UNKER'] ?></option> 
                      <?php endforeach ?>  
                      </select> 
                  </div>
                </div> 
 
            </div>
            <div class="box-footer"> </div>
          </div>
 

          <input type="hidden" name="nik" value="<?= $this->session->userdata('NIK') ?>" >

          <div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Reguler </div>

            <div class="box-body">              
              <!-- <input type="text" name="jenis_kp" value="reguler" > -->

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK CPNS</label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK PNS</label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK KP Terakhir</label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>                    
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir</label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                   
                </div>
              </div> 
          </div>
           <div class="box-footer"> </div>
         </div>


          <div class="box box-success fungsional">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Fungsional  
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body"> 
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Foto Copy sah PAK (Penetapan Angka Kredit)</label>
                <div class="col-sm-9">
                  <div id="UserFile2" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK Pangkat Terakhir</label>
                <div class="col-sm-9">
                  <div id="UserFile2" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir</label>
                <div class="col-sm-9">
                  <div id="UserFile2" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                   
                </div>
              </div>


               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Foto copy sah pendidikan Baru</label>
                <div class="col-sm-9">
                  <div id="UserFile2" style="color: red"></div>
                  <i class="fa fa-check-circle" style="color: green;"></i>
                </div>
              </div> 
          </div>

          <div class="box-footer"> </div>
        </div>


        <!-- Horizontal Form -->
          <div class="box box-success struktural">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Struktural
            </div>
            <!-- /.box-header --> 

            <div class="box-body">                 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">SK Pangkat Terakhir</label>
                  <div class="col-sm-9">
                    <div id="UserFile3" style="color: red"></div>
                    <i class="fa fa-check-circle" style="color: green;"></i>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">SK Jabatan Lama</label>
                  <div class="col-sm-9">
                    <div id="UserFile3" style="color: red"></div>
                    <i class="fa fa-check-circle" style="color: green;"></i>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">SK Jabatan Baru</label>
                  <div class="col-sm-9">
                    <div id="UserFile3" style="color: red"></div>
                    <i class="fa fa-check-circle" style="color: green;"></i>
                  </div>
                </div> 

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir</label>
                  <div class="col-sm-9">
                    <div id="UserFile3" style="color: red"></div>
                    <i class="fa fa-check-circle" style="color: green;"></i>
                  </div>
                </div> 
              </div>
          <div class="box-footer"> </div>
        </div>
       </form> 

       <div class="row">
         <div class="col-sm-4">
           <button class="btn btn-primary btn-block btn-flat" id="submit">Batal </button>
         </div>
         <div class="col-sm-4">
           <button class="btn btn-success btn-block btn-flat" id="submit">Terima </button>
         </div>
         <div class="col-sm-4">
           <button class="btn btn-danger  btn-block btn-flat" id="submit">Tolak </button>
         </div>
       </div>

          
 
      </div>
 
      </div>

