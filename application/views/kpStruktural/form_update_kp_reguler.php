      <div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Reguler </div>

            <?php

            // var_dump($pengajuan_reg);

            ?>

            <div class="box-body">              
              
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK CPNS <?php if ($pengajuan_reg['sk_cpns']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK PNS <?php if ($pengajuan_reg['sk_cpns']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >
                   
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">SK KP Terakhir <?php if ($pengajuan_reg['sk_kp_terakhir']!=""){ ?>
                      <i class="fa fa-check-circle" style="color: green;"></i>
                    <?php } ?></label>
                <div class="col-sm-9">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" >

                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label">PPK 1 tahun Terakhir <?php if ($pengajuan_reg['ppk_1thn_terakhir']!=""){ ?>
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