<div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Reguler </div>

            <div class="box-body">              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK CPNS 
                  <?php 
                    if ($pengajuan_reg['sk_cpns']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_reg['sk_cpns']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_reguler/".$pengajuan_reg['sk_cpns'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK PNS <?php 
                    if ($pengajuan_reg['sk_pns']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_reg['sk_pns']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_reguler/".$pengajuan_reg['sk_pns'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK KP Terakhir 
                  <?php 
                    if ($pengajuan_reg['sk_kp_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_reg['sk_kp_terakhir']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_reguler/".$pengajuan_reg['sk_kp_terakhir'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir <?php 
                    if ($pengajuan_reg['ppk_1thn_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_reg['ppk_1thn_terakhir']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_reguler/".$pengajuan_reg['ppk_1thn_terakhir'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div> 
          </div>
           <div class="box-footer">
            keterangan :
            <i class="fa fa-check-circle" style="color: green;"></i> Berhasil di Upload oleh Pegawai
            </div>
         </div> 