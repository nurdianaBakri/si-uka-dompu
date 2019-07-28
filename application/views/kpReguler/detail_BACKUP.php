     

     
               <!-- Default box -->
      <div class="row">
        <div class="col-md-9">
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

                <form class="form-horizontal" method="post" action="#">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="NIP" id="inputEmail3" value="<?php echo $data['data']['NIP_BARU'] ?>" readonly required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Depan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data']['GLRDPN']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data']['NAMA']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data']['GLRBLKG']?>" required="required">
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
                    <label for="inputEmail3" class="col-sm-2 control-label">Unit Kerja</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="unitKerja" value="<?php echo $data['data_unker']['NM_UNKER']?>" required="required">
                    </div>
                  </div>

                </form>
            </div>
            <div class="box-footer"> </div>
          </div>
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
              <a href="<?php echo base_url()."kpRegular/formUpload/edit/sk_cpns/".$data['NO_SK_CPNS'] ?>" class="btn btn-primary"> Edit</a>
              <a href="<?php echo base_url()."kpRegular/hapus/".$data['NO_SK_CPNS'] ?>" class="btn btn-danger"> Hapus</a>
            </div>
          </div>

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SK PNS</h3>
            </div>
            <div class="box-body">
              <img  src="<?php if ($data['data_sk_pns']==NULL || $data['data_sk_pns']=='') { echo base_url().'assets/files/no.jpg'; } else { echo base_url().'assets/files/sk_pns/'.$data['data_sk_pns']->NAMA_FILE; }?>" class="img-thumbnail"  width="200" height="200">
            </div>
            <div class="box-footer">
              <a href="<?php echo base_url()."kpRegular/formUpload/edit/sk_pns/".$data['data']['NIP_BARU'] ?>" class="btn btn-primary"> Edit</a>
              <!-- <a href="<?php echo base_url()."kpRegular/hapus/" ?>" class="btn btn-danger"> Hapus</a> -->
            </div>
          </div>

          <!-- <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SK PANGKAT TERAKHIR</h3>
            </div>
            <div class="box-body">
            <?php
                if ($data['NO_SK_PANGKAT_TERAKHIR']==0)
                { ?>
                  <img  src="<?php echo base_url()."assets/files/no.jpg" ?>" class="img-thumbnail"  width="200" height="200">
                <?php }
                else { ?>
                  <img  src="<?php echo base_url()."assets/files/sk_pangkat_terakhir/".$data['NIP_BARU']?>" class="img-thumbnail"  width="200" height="200">
                <?php }
              ?>
            </div>
            <div class="box-footer">
              <a href="<?php echo base_url()."index.php/kpReguler/edit/" ?>" class="btn btn-primary"> Edit</a>
              <a href="<?php echo base_url()."index.php/kpReguler/edit/" ?>" class="btn btn-danger"> Hapus</a>
            </div>
          </div> -->

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">PPK 1 TAHUN TERAKHIR</h3>
            </div>
            <div class="box-body">
                <img  src="<?php echo base_url()."assets/files/no.jpg" ?>" class="img-thumbnail"  width="200" height="200">
            </div>
            <div class="box-footer">
              <a href="<?php echo base_url()."index.php/kpReguler/edit/" ?>" class="btn btn-primary"> Edit</a>
              <a href="<?php echo base_url()."index.php/kpReguler/edit/" ?>" class="btn btn-danger"> Hapus</a>
            </div>
          </div>
        </div> 
      </div>
 