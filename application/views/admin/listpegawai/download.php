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
        <li><a href="#">List Pegawai</a></li>
        <li class="active">Download</li>
      </ol>
    </section>  

    <section class="content">  
      <!-- Default box -->
      <div class="row">
        <form class="form-horizontal" action="#" method="post" >

        <div class="col-md-12">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"> </h3>
            </div>
            <div class="box-body" id="DivIdToPrint">          
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
            <div class="box-footer"> 
              <a href="<?= base_url()."Listpegawai/download_data_diri/".$data['data']['NIK'] ?>" class="btn btn-success btn-block" target="_blank"> Download</a>
            </div>
          </div> 

          <input type="hidden" name="nik" value="<?= $data['data']['NIK']; ?>" > 

          <?php 
            if ($pengajuan_reg->num_rows()>0)
            {
              $pengajuan_reg2 = $pengajuan_reg->row_array();
              $data2['pengajuan_reg'] = $pengajuan_reg2;

              $this->load->view('admin/listpegawai/form_detail_kp_reguler',$data2);
            }

            if ($pengajuan_fungs->num_rows()>0)
            {
              $pengajuan_fungs = $pengajuan_fungs->row_array();
              $data2['pengajuan_fungs'] = $pengajuan_fungs;

              $this->load->view('admin/listpegawai/form_detail_kp_fungsional',$data2);
            }

            if ($pengajuan_struktural->num_rows()>0)
            {
              $pengajuan_struktural2 = $pengajuan_struktural->row_array();
              $data2['pengajuan_struktural2'] = $pengajuan_struktural2;

              $this->load->view('admin/listpegawai/form_detail_kp_struktural',$data2);
            }
     
          ?>
          </div>    
       </form>   
        
      </div>

      <a href="javascript:history.go(-1)" class="btn btn-primary btn-flat" id="submit"> <i class="fa fa-arrow-left"></i> Kembali </a>

    </section> 
</div>


<script type="text/javascript">
  function printDiv() 
{
  var divToPrint=document.getElementById('DivIdToPrint');
  var newWin=window.open('','Print-Window');
  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
}
</script>


