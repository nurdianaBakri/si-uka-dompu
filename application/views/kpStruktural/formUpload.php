

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
  <?php $id_user= $this->session->userdata('id'); ?>

<!-- Content Wrapper. Contains page content -->
<section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"><?php echo $title_box; ?></h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-12 text-center">
                <?php
                echo form_open_multipart("kpRegular/upload/");?>

                <input type="file"  class="btn btn-primary btn-block btn-flat" name="userfile" size="20" />
                <input type="hidden" name="jenis_sk" value="<?php echo $jenis_sk; ?>" >
                <input type="hidden" name="jenis_aksi" value="<?php echo $jenis_aksi; ?>" >
                <input type="hidden" name="NIK" value="<?php echo $NIK; ?>" >  
                <br /><br />

                <button type="submit" class="btn btn-primary btn-block btn-flat">Upload</button>

                </form>

            </div>
          </div>
          <div class="ajax-content">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</section>
