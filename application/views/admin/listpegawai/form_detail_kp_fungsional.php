<div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Fungsional </div>

            <div class="box-body">              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Foto Copy sah PAK (Penetapan Angka Kredit) <?php if ($pengajuan_fungs['copy_pak']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_fungs['copy_pak']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_fungsional/".$pengajuan_fungs['copy_pak'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK Pangkat Terakhir 
                  <?php if ($pengajuan_fungs['sk_pangkat_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_fungs['sk_pangkat_terakhir']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_fungsional/".$pengajuan_fungs['sk_pangkat_terakhir'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir <?php if ($pengajuan_fungs['ppk_1thn_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_fungs['ppk_1thn_terakhir']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_fungsional/".$pengajuan_fungs['ppk_1thn_terakhir'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Foto copy sah pendidikan Baru<?php if ($pengajuan_fungs['copy_pendidikan_baru']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan_fungs['copy_pendidikan_baru']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_fungsional/".$pengajuan_fungs['copy_pendidikan_baru'] ?>" target="_blank" class="btn btn-success">Download</a>
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