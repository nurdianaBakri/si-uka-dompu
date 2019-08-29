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
        <div class="col-md-9">

          <form class="form-horizontal" method="post" action="#">

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
                      <input type="text" class="form-control" name="GLRDPN" value="<?php echo $data['data_pengguna']['GLRDPN']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="NAMA" value="<?php echo $data['data_pengguna']['NAMA']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="GLRBLKG" value="<?php echo $data['data_pengguna']['GLRBLKG']?>" required="required">
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
                      <input type="text" class="form-control" name="JABATAN" value="<?php echo $data['data']['JABATAN']?>" required="required">
                    </div>
                  </div>  

                  <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Ket Jabatan</label>
                  <div class="col-sm-10"> 
                     <select class="form-control" name="KD_JABATAN" disabled> 
                      <?php foreach ($data['data_ket_jabatan'] as $key): ?>
                        <option value="<?php echo $key['KD_JABATAN'] ?>" <?php if($key['KD_JABATAN']==$data['data']['KET_JABATAN']){ echo "selected"; } ?>  ><?php echo $key['NM_JABATAN'] ?></option> 
                      <?php endforeach ?>  
                      </select> 
                  </div>
                </div> 

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Nama Unit Kerja</label>
                  <div class="col-sm-10"> 
                     <select class="form-control"  name="KD_UNKER" disabled> 
                      <?php foreach ($data['data_kd_unker'] as $key): ?>
                        <option value="<?php echo $key['KD_UNKER'] ?>" <?php if($key['KD_UNKER']==$data['data']['KD_UNKER']){ echo "selected"; } ?>  ><?php echo $key['NM_UNKER'] ?></option> 
                      <?php endforeach ?>  
                      </select> 
                  </div>
                </div> 

            </div>
            <div class="box-footer">
              <a href="<?php echo base_url()."kpRegular/update_pns/".$data['data_pengguna']['NIK'] ?>" class="btn btn-primary btn-block">Update</a> 
            </div>
          </div>
        </form>
 
        </div>

        <div class="col-md-3" style="text-align :center;">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SK CPNS</h3>
            </div>
             <div class="box-body">
             
              <img  src="<?php if ($data['data_skCpns']==NULL || $data['data_skCpns']=='') { echo base_url().'assets/files/no.jpg'; } else { echo base_url().'assets/files/sk_cpns/'.$data['data_skCpns']['NAMA_FILE']; }?>" class="img-thumbnail"  width="200" height="200">
            </div>
            <div class="box-footer"> 
                <a href="<?php echo base_url()."kpRegular/formUpload/edit/sk_cpns/".$data['data_pengguna']['NIK'] ?>" class="btn btn-primary"> Edit</a> 

                <a href="<?php echo base_url()."kpRegular/hapus_sk/sk_cpns/".$data['data_pengguna']['NIK'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus SK ?');" class="btn btn-danger"> Hapus</a>    
            </div>
          </div>

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SK PNS</h3>
            </div>
            <div class="box-body">
              <img  src="<?php if ($data['data_sk_pns']==NULL || $data['data_sk_pns']=='') { echo base_url().'assets/files/no.jpg'; } else { echo base_url().'assets/files/sk_pns/'.$data['data_sk_pns']['NAMA_FILE']; }?>" class="img-thumbnail"  width="200" height="200">
            </div>
            <div class="box-footer">
               <a href="<?php echo base_url()."kpRegular/formUpload/edit/sk_pns/".$data['data_pengguna']['NIK'] ?>" class="btn btn-primary" > Edit</a>  

               <a href="<?php echo base_url()."kpRegular/hapus_sk/sk_pns/".$data['data_pengguna']['NIK'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus SK ?');" class="btn btn-danger"> Hapus</a>    

            </div>
          </div> 

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SK PANGKAT TERAKHIR</h3>
            </div>
            <div class="box-body">
                <img  src="<?php if ($data['data_skPangkatTerakhir']==NULL || $data['data_skPangkatTerakhir']=='') { echo base_url().'assets/files/no.jpg'; } else { echo base_url().'assets/files/sk_pangkat_terakhir/'.$data['data_skPangkatTerakhir']['NAMA_FILE']; }?>" class="img-thumbnail"  width="200" height="200">
            </div>
            <div class="box-footer">
              <a href="<?php echo base_url()."kpRegular/formUpload/edit/sk_pangkat_terakhir/".$data['data_pengguna']['NIK'] ?>" class="btn btn-primary" > Edit</a>

              <a href="<?php echo base_url()."kpRegular/hapus_sk/sk_pangkat_terakhir/".$data['data_pengguna']['NIK'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus SK Pangkat terakhir ? ?');" class="btn btn-danger"> Hapus</a>

            </div>
          </div>
        </div> 
      </div>

      <script type="text/javascript">
        function update_file(jenis_aksi, jenis_file, nip) { 

          //get form dari database 
          // formUpload/edit/sk_pns/195803211978032007
          var url = "<?php echo base_url() ?>"+'kpRegular/formUpload/'+jenis_aksi+"/"+jenis_file+"/"+nip;
          // console.log(url);

           $.ajax( {  
                type: "POST",
                url: url,
                data: {},
                dataType:"html",
                success: function( response ) {  
                  // console.log(response);
                    try{   
                        $('.modal-body').html(response); 
                        $("#exampleModalCenter").modal();    
                    }catch(e) {  
                        alert('Exception while request..');
                    }  
                }
            } );  

          // show_modal();
        }
 

      </script>

