<div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Fungsional </div>

            <div class="box-body">              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Foto Copy sah PAK (Penetapan Angka Kredit) <?php if ($pengajuan_fungs['copy_pak']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK Pangkat Terakhir <?php if ($pengajuan_fungs['sk_pangkat_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir <?php if ($pengajuan_fungs['ppk_1thn_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >

                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">Foto copy sah pendidikan Baru<?php if ($pengajuan_fungs['copy_pendidikan_baru']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
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