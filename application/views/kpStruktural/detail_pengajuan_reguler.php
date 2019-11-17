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

        <form class="form-horizontal" action="<?php echo base_url().'Pengajuan/do_pengajuan_reguler'; ?>" method="post" enctype="multipart/form-data">

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
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_pengguna']['GLRDPN']?>">
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


          <input type="hidden" name="nik" value="<?= $data['data']['NIK']; ?>" > 
          <!-- <input type="hidden" name="nik" value="<?= $this->session->userdata('NIK') ?>" > -->

          <div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Reguler </div>

            <div class="box-body">              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK CPNS <i class="fa fa-check-circle" style="color: green;"></i></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK PNS <i class="fa fa-check-circle" style="color: green;"></i></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK KP Terakhir <i class="fa fa-check-circle" style="color: green;"></i></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >

                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir <i class="fa fa-check-circle" style="color: green;"></i></label>
                <div class="col-sm-9">
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div> 
          </div>
           <div class="box-footer">
            keterangan :
            <i class="fa fa-check-circle" style="color: green;"></i> Berhasil di Upload oleh Pegawai
            </div>
         </div> 

           <div class="row">
               <div class="col-sm-6">
                 <a href="<?= base_url()."PengajuanBaru" ?>" class="btn btn-warning btn-block btn-flat">Batal </a>
               </div>
               <div class="col-sm-6">
                 <button class="btn btn-success btn-block btn-flat">Update data </button>
               </div> 
           </div>            

          </div>    
       </form>   
        
      </div>
    </section>

    <section class="content"> 
      <div class="row"> 
         <div class="col-md-6">
           <a href="<?= base_url()."PengajuanBaru/terima/".$data['data']['NIK'] ?>" class="btn btn-success btn-block btn-flat">Terima </a>
         </div>
         <div class="col-md-6">
           <a href="<?= base_url()."PengajuanBaru/tolak/".$pengajuan['jenis_kp']."/".$data['data']['NIK'] ?>" class="btn btn-danger btn-block btn-flat">Tolak </a>
         </div>
       </div> 
    </section> 
 
      </div>



