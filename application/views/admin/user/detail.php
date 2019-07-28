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

    <section class="content">  
      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">

          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $title_header2; ?></h3>
            </div>
            <div class="box-body">

              <?php
              if ($this->session->flashdata('pesan')!="") 
              { ?>
               <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                    <?php echo $this->session->flashdata('pesan'); ?>
                </div>
              <?php } ?> 

                <form class="form-horizontal" method="post" action="#">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">NIP</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="NIP" id="inputEmail3" value="<?php echo $data['data_diri']['NIP_BARU'] ?>" readonly required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Depan</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_diri']['GLRDPN']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_diri']['NAMA']?>" required="required">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Gelar Belakang</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" value="<?php echo $data['data_diri']['GLRBLKG']?>" required="required">
                    </div>
                  </div> 
 
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">level </label>
                    <div class="col-sm-10"> 
                      <select class="form-control" name="level"> 
                        <option value="Admin" <?php if($data['data_diri']['level']=="Admin"){ echo "selected"; } ?>  >Admin</option> 
                        <option value="User" <?php if($data['data_diri']['level']=="User"){ echo "selected"; } ?>  >User</option> 
                      </select>  
                    </div>
                  </div> 
                 

                </form>
            </div>
            <div class="box-footer"> </div>
          </div>
 
        </div>
 
      </div>
 