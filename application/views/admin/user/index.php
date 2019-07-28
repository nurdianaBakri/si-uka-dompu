
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
        <li><a href="#">Examples</a></li>
        <li class="active">Pace page</li>
      </ol>
    </section>

    <!-- Main content --> 
    <section class="content"> 
      <div class="box box-primary">
        <div class="box-header with-border"> 
            <button class="btn btn-primary" type="button" id="cariuser" >
              <i class="fa fa-search"></i> Cari User
            </button>
            <button class="btn btn-primary" type="button" id="kembali" >
              <i class="fa fa-arrow-left"></i> Kembali
            </button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12  tabel_data"> 
                 
            </div> 
            <div class="col-xs-12  loading"> 
                <center>
                  <img src="<?php echo base_url()."assets/loading.gif" ?>" width="80px" height="auto" id="loading-image">
                </center> 
            </div>
          </div>
          <div class="ajax-content">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer"> 
        </div> 
      </div>

      <!-- /.box --> 
    </section> 
  

    <script type="text/javascript">

      $(document).ready(function(){ 
            get_data();    
      });  
  

      ///get data pegawai
       function get_data() { 
          $('.tabel_data').hide(); 
          $('.loading').show();
          var url = "<?php echo base_url() ?>"+"admin/User/get_data";
          $.ajax( {
              type: "POST",
              url: url,
              data: {  },
              dataType: "html",
              success: function( response ) { 
                  try{     
                       $('.tabel_data').show();  
                      $('.tabel_data').html(response); 
                      $('.loading').hide();  
                      $('#kembali').hide();  
                      $('#cariuser').show();  
                  }catch(e) {  
                      alert('Exception while request..');
                  }  
              }
          } );  
      }     

       //form cari
      $("#cariuser").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()."admin/User/formCari" ?>",
            data: { },
            success: function(result) { 
              //hide butoon cari 
              $('#cariuser').hide();
              $('#kembali').show(); 
              $('.tabel_data').html(result);
            },
            error: function(result) {
                alert('error');
            }
        });
    });   
        

      $("#kembali").click(function(e) {
        e.preventDefault();
        get_data(); 
     });  
  
           
       
    </script>
