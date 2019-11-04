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
        <li><a href="#">Data Diri</a></li>
      </ol>
    </section>  

    <section class="content">  
      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">

          <form class="form-horizontal" method="post" action="<?= base_url()."kpRegular/updatePns" ?>">

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

                  <input type="hidden" name="NIK" value="<?= $data['data_pengguna']['NIK']; ?>">  
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="NIP" id="inputEmail3" value="<?php echo $data['data']['NIP_BARU'] ?>" readonly required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Depan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="GLRDPN" value="<?php echo $data['data_pengguna']['GLRDPN']?>">
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
                      <input type="text" class="form-control" name="GLRBLKG" value="<?php echo $data['data_pengguna']['GLRBLKG']?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Pangkat </label>
                    <div class="col-sm-10">

                      <select class="form-control" name="KD_GOLRU"> 
                      <?php foreach ($gol_ru as $key): ?>
                        <option value="<?php echo $key['KD_GOLRU'] ?>" <?php if($key['KD_GOLRU']==$data['data_golru']['KD_GOLRU']){ echo "selected"; } ?>  ><?php echo $key['NM_GOLRU'] ?></option> 
                      <?php endforeach ?>  
                      </select>   
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
              <button type="submit" class="btn btn-primary btn-block">Update</button>
            </div>
          </div>
        </form>
 
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

