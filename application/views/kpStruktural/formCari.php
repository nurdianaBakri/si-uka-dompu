

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

            <button class="btn btn-primary" type="button" id="cari_pegawai" >
              <i class="fa fa-search"></i> Cari pegawai
            </button>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12">
              <?php $this->load->view('admin/user/tabel_user'); ?>
            </div>
          </div>
          <div class="ajax-content">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer"></div>
        <!-- /.box-footer-->
      </div>

      <!-- /.box -->

    </section>


    <div id="GSCCModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;  </button>
            <h4 class="modal-title" id="myModalLabel">Cari Pegawai</h4>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $("#cari_pegawai").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url()."kpRegular/formCariPegawai" ?>",
            data: { },
            success: function(result) {

              $('.modal-body').html(result);
              $('#GSCCModal').modal('show');
              // $('#myModal').modal('hide');

            },
            error: function(result) {
                alert('error');
            }
        });
    });
    </script>
    