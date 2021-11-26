    <nav class="navbar navbar-expand-lg main-navbar">
        <a href="<?=base_url();?>" class="navbar-brand sidebar-gone-hide">SIP SINDANG</a>
        <!-- <a href="<?=base_url();?>">
            <img alt="image" src="<?=base_url('/assets/img/');?>/logo-horizontal.png" class="sidebar-gone-hide mr-1">
        </a> -->
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <div class="nav-collapse">
        </div>
        <form class="form-inline ml-auto">
          <ul class="navbar-nav">
            <!-- <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li> -->
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <div class="d-sm-none d-lg-inline-block">Selamat Datang, <strong> <?= $this->session->userdata('nama') ?></strong> &nbsp;</div>
              <img alt="image" src="<?=base_url('/assets/theme/stisla/');?>img/avatar/avatar-1.png" class="rounded-circle mr-1">
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a href="features-settings.html" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Ganti Password
              </a> -->
              <!-- <div class="dropdown-divider"></div> -->
              <a href="<?= base_url('login/do_logout');?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
    </nav>