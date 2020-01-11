<!-- Horizontal Form -->


 <div class="box box-success">
    <div class="box-header with-border"> Silahkan pilih jenis pengajuan yang di inginkan</div>
    
    <div class="box-body">
      <div id="checkboxes">
        <input id="reguler" type="checkbox" name="reguler" />Reguler 
        <input id="fungsional" type="checkbox" name="fungsional" />Fungsional 
        <input id="struktural" type="checkbox" name="struktural" />Struktural 
      </div>
    </div>
  </div>         

        <form class="form-horizontal" action="<?php echo base_url().'Pengajuan/do_pengajuan'; ?>" method="post" enctype="multipart/form-data">

           <input type="hidden" name="nik" value="<?= $this->session->userdata('NIK') ?>" >

          <div class="box box-success reguler">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Reguler </div>

            <div class="box-body">              
              <!-- <input type="text" name="jenis_kp" value="reguler" > -->

              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">SK CPNS</label>
                <div class="col-sm-10">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf"  name="UserFile[]" class="form-control" >
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">SK PNS</label>
                <div class="col-sm-10">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf"  name="UserFile[]" class="form-control"  >
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">SK KP Terakhir</label>
                <div class="col-sm-10">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" accept="application/pdf"  name="UserFile[]" class="form-control" >
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">PPK 1 tahun Terakhir</label>
                <div class="col-sm-10">
                  <div id="UserFile" style="color: red"></div>
                  <input type="file" id="ppk_1_tahunterakhir1" accept="application/pdf"  name="UserFile[]" class="form-control" >
                </div>
              </div> 
          </div>
           <div class="box-footer"> </div>
         </div>


          <div class="box box-success fungsional">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Fungsional  
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body"> 
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Foto Copy sah PAK (Penetapan Angka Kredit)</label>
                <div class="col-sm-10">
                  <div id="UserFile2" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" id="fc_sah_pak" >
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">SK Pangkat Terakhir</label>
                <div class="col-sm-10">
                  <div id="UserFile2" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" id="sk_pangkat_terakhir" >
                </div>
              </div>

               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">PPK 1 tahun Terakhir</label>
                <div class="col-sm-10">
                  <div id="UserFile2" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control" id="ppk_1_tahunterakhir2" >
                </div>
              </div>


               <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Foto copy sah pendidikan Baru</label>
                <div class="col-sm-10">
                  <div id="UserFile2" style="color: red"></div>
                  <input type="file" accept="application/pdf" name="UserFile2[]" class="form-control"  >
                </div>
              </div> 
          </div>

          <div class="box-footer"> </div>
        </div>


        <!-- Horizontal Form -->
          <div class="box box-success struktural">
            <div class="box-header with-border"> Pengajuan Kenaikan Pangkat Struktural
            </div>
            <!-- /.box-header --> 

            <div class="box-body">                 

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">SK Pangkat Terakhir</label>
                  <div class="col-sm-10">
                    <div id="UserFile3" style="color: red"></div>
                    <input type="file" accept="application/pdf" name="UserFile3[]" class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">SK Jabatan Lama</label>
                  <div class="col-sm-10">
                    <div id="UserFile3" style="color: red"></div>
                    <input type="file" accept="application/pdf" name="UserFile3[]" class="form-control" >
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">SK Jabatan Baru</label>
                  <div class="col-sm-10">
                    <div id="UserFile3" style="color: red"></div>
                    <input type="file" accept="application/pdf" name="UserFile3[]" class="form-control">
                  </div>
                </div> 

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">PPK 1 tahun Terakhir</label>
                  <div class="col-sm-10">
                    <div id="UserFile3" style="color: red"></div>
                    <input type="file" accept="application/pdf" name="UserFile3[]" class="form-control" >
                  </div>
                </div> 
              </div>
          <div class="box-footer"> </div>
        </div>

          <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit">Ajukan </button>
 
      </form>

      <div class="box-footer">
          <a style="text-align: right;" class="btn btn-primary" href="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Kembali</a> 
      </div>

<script type="text/javascript"> 

  $( document ).ready(function() {
      $('.reguler').hide();
      $('.struktural').hide();
      $('.fungsional').hide();
      $('#submit').hide();
  });

  $("#submit").click( function(){
     
     if( $("#reguler").is(':checked') ){

      var ppk_1_tahunterakhir1 = $('#ppk_1_tahunterakhir1').val();

      if (ppk_1_tahunterakhir1=="" || ppk_1_tahunterakhir1==null) {
        alert('PPK 1 Tahun Terakhir wajib di isi');
        return false;
      }
     } 
     else{
      console.log("reguler is not checked");
     }

     ////

     if( $("#fungsional").is(':checked') ){

      var ppk_1_tahunterakhir2 = $('#ppk_1_tahunterakhir2').val();
      var fc_sah_pak = $('#fc_sah_pak').val();
      var sk_pangkat_terakhir = $('#sk_pangkat_terakhir').val();

      if (ppk_1_tahunterakhir2=="" || ppk_1_tahunterakhir2==null) {
        alert('PPK 1 Tahun Terakhir wajib di isi');
        return false;
      }

      if (fc_sah_pak=="" || fc_sah_pak==null) {
        alert('Foto coppy sak PAK wajib di isi');
        return false;
      }

      if (sk_pangkat_terakhir=="" || sk_pangkat_terakhir==null) {
        alert('SK Pangkat Terakhir wajib di isi');
        return false;
      }
     } 
     else{
      console.log("reguler is not checked");
     }

  });

  $("#reguler").click( function(){
     if( $(this).is(':checked') ){ 
      $('.reguler').show();
      $('#submit').show();
     } 
     else{
      $('.reguler').hide(); 
     }
  });

  $("#struktural").click( function(){
     if( $(this).is(':checked') ){ 
      $('.struktural').show();
      $('#submit').show(); 
     } 
     else{
      $('.struktural').hide(); 
     }
  });

  $("#fungsional").click( function(){
     if( $(this).is(':checked') ){ 
      $('.fungsional').show();
      $('#submit').show(); 
     } 
     else{
      $('.fungsional').hide(); 
     }
  });
</script>