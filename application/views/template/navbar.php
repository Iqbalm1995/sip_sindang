    <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <a href="<?=base_url();?>" class="navbar-brand sidebar-gone-hide"><?= $this->session->userdata('pos_name'); ?></a>
        <!-- <a href="<?=base_url();?>">
            <img alt="image" src="<?=base_url('/assets/img/');?>/logo-horizontal.png" class="sidebar-gone-hide mr-1">
        </a> -->
        <div class="nav-collapse">
        </div>
        <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle notification-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">Selamat Datang, <strong> <?= $this->session->userdata('nama') ?></strong> &nbsp;</div>
              <img alt="image" src="<?=base_url('/assets/theme/stisla/');?>img/avatar/avatar-1.png" class="rounded-circle mr-1">
            </a>
            <?php if (in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_LV1)) { ?>
              <div class="dropdown-menu dropdown-list dropdown-menu-right">
                <div class="dropdown-header">
                  <div class="text-center">
                    <img alt="image" src="<?=base_url('/assets/theme/stisla/');?>img/avatar/avatar-1.png" class="rounded-circle" style="width: 80px; margin-top: 30px;">
                    <div class="pt-3" style="font-size: 15px; margin: 0px; padding: 0px; ">
                      <?= $this->session->userdata('nama') ?></div>
                    <div style="font-size: 12px; margin: 0px; font-weight: normal;">
                      <?= $this->session->userdata('role_name') ?></div>
                    <div class="pb-2" style="font-size: 12px; margin: 0px; font-weight: normal; line-height: 0px;">
                      </div>
                  </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                  <?php 
                    if (in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_LV1)) { ?>
                      <a href="<?= base_url('users'); ?>/switch/pusat" class="dropdown-item">
                        <div class="dropdown-item-icon bg-primary text-white">
                          <i class="fas fa-clinic-medical"></i>
                        </div>
                        <div class="dropdown-item-desc">
                          Posyandu Data Pusat
                          <div class="time text-primary">Pusat</div>
                        </div>
                      </a>
                  <?php  } ?>
                  <?php  if (count($pos_session) > 0) {
                      foreach ($pos_session as $key => $value) { ?>
                      <a href="<?= base_url('users'); ?>/switch/<?= $value->id;?>" class="dropdown-item">
                        <div class="dropdown-item-icon bg-primary text-white">
                          <i class="fas fa-clinic-medical"></i>
                        </div>
                        <div class="dropdown-item-desc">
                          Pos <?= $value->nama; ?>
                          <div class="time text-primary">Desa <?= $value->desa; ?></div>
                        </div>
                      </a>
                  <?php } } ?>
                  
                </div>
                <div class="dropdown-footer text-center">
                  <a href="<?= base_url('login/do_logout');?>" class="btn btn-danger btn-sm" ><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
              </div>
            <?php }else{ ?>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('login/do_logout');?>" class="dropdown-item has-icon text-danger">
                  <i class="fas fa-sign-out-alt"></i> Logout
                </a>
              </div>
            <?php } ?>
          </li>
        </ul>
    </nav>