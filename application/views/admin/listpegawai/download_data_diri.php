  <!DOCTYPE html>
  <html>
  <head>
    <title>Print</title>
  </head>
  <body onload="window.print()">
    <div class="row">

        <div class="col-md-12"> 
              <style type="text/css">
                  hr {    
                    height: 30px; 
                    border-top: 10px solid #8c8b8b;   
                } 
              </style>

              <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
              <!-- Font Awesome -->
              <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/bower_components/font-awesome/css/font-awesome.min.css">
            <link rel="stylesheet" href="<?php echo base_url()."assets"; ?>/dist/css/AdminLTE.min.css">
             <script src="<?php echo base_url()."assets"; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

             <center>
               <table >
                 <tr>
                   <td>
                     <img src="<?= base_url()."assets/logo.PNG" ?>"  height="100" width="100">
                   </td>
                   <td  style="text-align: center;">
                      <H2>PEMERINTAH KABUPATEN DOMPU <br> 
                     BKD DAN PENGEMBANGAN SDM</H2>

                     <H4>Jl. Sanokling No. 1 Dompu. Telp (0372) 22141. Dompu-NTB</H4>
                   </td>
                 </tr>
               </table> 
             </center>               
             <hr>

             <center>
              <h3>
                <u>Pengajuan Kenaikan Pangkat</u>
              </h3>
             </center>

             <table class="table table-striped">
               <tr>
                 <td>NIP</td>
                 <td>: <?= $data['data']['NIP_BARU'] ?></td>
               </tr>

               <tr>
                 <td>Gelar Depan</td>
                 <td>: <?= $data['data_pengguna']['GLRDPN'] ?></td>
               </tr>

               <tr>
                 <td>Nama</td>
                 <td>: <?= $data['data_pengguna']['NAMA'] ?></td>
               </tr>

               <tr>
                 <td>Gelar Belakang</td>
                 <td>: <?= $data['data_pengguna']['GLRBLKG'] ?></td>
               </tr>

               <tr>
                 <td>Pangkat</td>
                 <td>: <?= $data['data_golru']['NM_GOLRU'] ?></td>
               </tr>

               <tr>
                 <td>Jabatan</td>
                 <td>: <?= $data['data']['JABATAN'] ?></td>
               </tr>

               <tr>
                 <td>Ket Jabatan</td>
                 <td>: <?php
                  foreach ($data['data_ket_jabatan'] as $key){
                    if($key['KD_JABATAN']==$data['data']['KET_JABATAN']) {
                      echo $key['NM_JABATAN'];
                    } } ?>
                  </td>
               </tr>

                <tr>
                 <td>Nama Unit Kerja</td>
                 <td>: <?php
                  foreach ($data['data_kd_unker'] as $key){
                    if($key['KD_UNKER']==$data['data']['KD_UNKER']) {
                      echo $key['NM_UNKER'];
                    } } ?>
                  </td>
               </tr> 
             </table>   

                <br>
                <br>
                <br>
                <br>

            <div class="row">
              <div class="col-xs-8"></div>
              <div class="col-xs-4">
                 <div style="text-align: center;">
                  <p>Dompu, <?php
                  setlocale(LC_ALL, 'IND');
                  echo strftime('%d %B %Y');

                  // echo date('d F Y'); ?></p>
                  <p>Yang Bersangkutan,</p>

                  <br>
                  <br>
                  <br>
                  <u><?=  $data['data_pengguna']['GLRDPN']." ".$data['data_pengguna']['NAMA'].$data['data_pengguna']['GLRBLKG'] ?></u>
                  <p><?= $data['data']['NIP_BARU'] ?><br><?= $data['data_golru']['NM_GOLRU'] ?></p>
                </div>
              </div>
            </div> 
 
          </div>   
        
      </div> 

    <script type="text/javascript">
      
    </script>

  </body>
  </html>    <!-- Default box -->
      