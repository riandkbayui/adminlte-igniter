<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <img src="<?php echo base_url('assets/') ?>dist/img/user1-128x128.jpg" alt="User Avatar" style="width: 33px; margin-top: -5px;" class=" mr-2 img-circle">
        <label class="d-none d-sm-inline-block"><?php echo $this->adminlte->userlogin('user_firstname').' '.$this->adminlte->userlogin('user_lastname') ?></label>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="#" class="dropdown-item">
          <!-- Message Start -->
          <div class="media">
            <div>
              <img src="<?php echo base_url('assets/') ?>dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            </div>
            <div class="media-body">
              <h3 class="dropdown-item-title">
                <?php echo $this->adminlte->userlogin('user_firstname').' '.$this->adminlte->userlogin('user_lastname') ?>
              </h3>
              <p class="text-sm"><?php echo $this->adminlte->userlogin('group_label') ?></p>
              <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> <?php echo date('d-m-Y H:i') ?></p>
            </div>
          </div>
          <!-- Message End -->
        </a>
        <div class="dropdown-divider"></div>
        <div class="dropdown-footer">
          <a href="<?php echo base_url('systems/me') ?>" class="btn btn-default btn-sm float-left"><i class="fa fa-edit"></i> Edit Profil</a>
          <a href="<?php echo base_url('logout') ?>" class="btn btn-default btn-sm float-right">Keluar <i class="fa fa-sign-out-alt"></i></a>
          <div class="clearfix"></div>
        </div>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
  </ul>
</nav>
<!-- /.navbar -->