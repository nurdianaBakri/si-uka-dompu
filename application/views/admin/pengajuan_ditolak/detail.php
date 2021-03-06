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
        <li><a href="#"><i class="fa fa-dashboard"></i> Pegawai</a></li>
        <li><a href="#">Detail</a></li>
      </ol>
    </section>  

    <section class="content">  
      <!-- Default box -->
      <div class="row">

            <form class="form-horizontal" action="#">

            <div class="col-md-12">

              <div class="box box-success">
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
              <input type="hidden" name="jenis_kp" value="<?= $pengajuan['jenis_kp']; ?>" >

              <?php  

              if ($pengajuan['jenis_kp']=="Reguler")
              {
                $data2['pengajuan_reg'] = $pengajuan;
                $this->load->view('admin/listpegawai/form_detail_kp_reguler',$data2);
                // $this->load->view('kpStruktural/form_file_penolakan_reguler',$data2);
              }
              else if ($pengajuan['jenis_kp']=="Struktural") {
                # code...
                $data2['pengajuan_struktural2'] = $pengajuan;
                $this->load->view('admin/listpegawai/form_detail_kp_struktural',$data2);
              }
              else
              {
                //jenis kp fungsional
                $data2['pengajuan_fungs'] = $pengajuan;
                $this->load->view('admin/listpegawai/form_detail_kp_fungsional',$data2);
              }
              ?>

             <div class="box box-success reguler">
                <div class="box-header with-border">Alasan Penolakan </div>

                <div class="box-body">              
                  
                  <div class="form-group">
                   
                    <div class="col-sm-12">
                      <div id="UserFile" style="color: red"></div>
                      
                      <textarea class="form-control" name="alasan" readonly>
                        <?=  $pengajuan['alasan']; ?>
                      </textarea>
                       
                    </div>
                  </div> 
     
              </div>
               <div class="box-footer">
                  <a href="<?= base_url()."PengajuanTolak" ?>" class="btn btn-primary btn-flat">Kembali </a>
               </div>
             </div>  

              </div>    
           </form>   
 
      </div>
