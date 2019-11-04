<!-- Horizontal Form -->
          <div class="box box-success">
            <div class="box-header with-border"> <?= $title; ?> 
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form class="form-horizontal" action="<?php echo base_url().'Pengajuan/do_pengajuan/'; ?>" method="post" name="myForm">
                  <div class="box-body">

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">SK Pangkat Terakhir</label>
                      <div class="col-sm-10">
                        <div id="sk_pangkat_terakhir" style="color: red"></div>
                        <input type="file" name="sk_pangkat_terakhir" class="form-control" required >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">SK Jabatan Lama</label>
                      <div class="col-sm-10">
                        <div id="sk_jabatan_lama" style="color: red"></div>
                        <input type="file" name="sk_jabatan_lama" class="form-control" required >
                      </div>
                    </div>

                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">SK Jabatan Baru</label>
                      <div class="col-sm-10">
                        <div id="sk_jabatan_baru" style="color: red"></div>
                        <input type="file" name="sk_jabatan_baru" class="form-control" required>
                      </div>
                    </div> 

                     <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">PPK 1 tahun Terakhir</label>
                      <div class="col-sm-10">
                        <div id="ppk_1tahun_terakhir" style="color: red"></div>
                        <input type="file" name="ppk_1tahun_terakhir" class="form-control" required >
                      </div>
                    </div>

                    
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Ajukan </button>
                  </div>

                  <!-- /.box-footer -->
                </form>
          </div>