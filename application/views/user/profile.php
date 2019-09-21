  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-user"></i> User</a></li>
        <li class="active">Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <br>
      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username"><?php echo $data['NAMA']; ?></h3>
              <h5 class="widget-user-desc"><?php echo $data['level']; ?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo base_url()."assets/"; ?>/dist/img/user1-128x128.jpg" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">NIP</h5>
                    <span class="description-text"><?php echo $data['NIK']; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-6 border-right">
                  <div class="description-block">
                    <h5 class="description-header">Nama</h5>
                    <span class="description-text"><?php echo $data['NAMA']; ?></span>
                  </div>
                  <!-- /.description-block -->
                </div>
              
              
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <a href="<?php echo base_url()."index.php/Login/logout" ?>" class="btn btn-primary btn-block"><b>Logout</b></a>

            </div>
          </div>
          <!-- /.widget-user -->
        </div>
      </div>
      <!-- /.row -->
    </section>
  </div>
    <!-- /.content -->
