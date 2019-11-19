<div class="box box-success struktural">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Struktural
            </div>
            <!-- /.box-header --> 

            <div class="box-body"> 

             <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK pangkat terakhir<?php 
                    if ($pengajuan[1]['sk_pangkat_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan[1]['sk_pangkat_terakhir']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_struktural/".$pengajuan[1]['sk_pangkat_terakhir'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK Jabatan Lama<?php 
                    if ($pengajuan[1]['sk_jabatan_lama']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan[1]['sk_jabatan_lama']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_struktural/".$pengajuan[1]['sk_jabatan_lama'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">SK Jabatan Baru <?php 
                    if ($pengajuan[1]['sk_jabatan_baru']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan[1]['sk_jabatan_baru']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_struktural/".$pengajuan[1]['sk_jabatan_baru'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
                </div> 

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir<?php 
                    if ($pengajuan[1]['ppk_1thn_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?>
                </label>
                <div class="col-sm-9">
                  <?php 
                    if ($pengajuan[1]['ppk_1thn_terakhir']!=""){ ?>
                      <a href="<?= base_url()."assets/files/pengajuan_struktural/".$pengajuan[1]['ppk_1thn_terakhir'] ?>" target="_blank" class="btn btn-success">Download</a>
                    <?php } else { ?>
                      <button class="btn btn-success" disabled>Download</button>
                   <?php } ?>
                </div>
              </div>  
 
              </div>
          <div class="box-footer"> </div>
        </div>