<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <!-- <div class="sidebar-brand sidebar-gone-show"><a href="<?= base_url(); ?>">SIP SINDANG</a></div> -->
        
        <div class="sidebar-brand">
            <a href="<?= base_url(); ?>">SIP SINDANG</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url(); ?>">SIP</a>
        </div>
        <!-- active menu dynamic -->
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li <?=( $menu_active == 'dashboard' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('dashboard'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <!-- <li class="nav-item dropdown">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            <ul class="dropdown-menu">
                <li><a class="nav-link" href="index-0.html">General Dashboard</a></li>
                <li><a class="nav-link" href="index.html">Ecommerce Dashboard</a></li>
            </ul> 
            </li> -->
            <?php if (in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_SUBLV1)) { ?>
                <li class="menu-header">Data Posyandu</li>
                <li class="dropdown <?=( $menu_active == 'bumil' ? 'active' : '' );?>">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-female"></i> <span>Ibu Hamil</span></a>
                    <ul class="dropdown-menu">
                        <li <?=( $subMenu_active == 'bumil_data' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('bumil'); ?>">Data Ibu Hamil</a></li>
                        <li <?=( $subMenu_active == 'bumil_layanan' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('bumil/layanan'); ?>">Layanan Ibu Hamil</a></li>
                    </ul>
                </li>
                <li class="dropdown <?=( $menu_active == 'bayi' ? 'active' : '' );?>">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-baby"></i> <span>Bayi</span></a>
                    <ul class="dropdown-menu">
                        <li <?=( $subMenu_active == 'bayi_data' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('bayi'); ?>">Data Bayi</a></li>
                        <li <?=( $subMenu_active == 'bayi_layanan' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('bayi/layanan'); ?>">Layanan Bayi</a></li>
                    </ul>
                </li>
                <li class="dropdown <?=( $menu_active == 'balita' ? 'active' : '' );?>">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-child"></i> <span>Balita</span></a>
                    <ul class="dropdown-menu">
                        <li <?=( $subMenu_active == 'balita_data' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('balita'); ?>">Data Balita</a></li>
                        <li <?=( $subMenu_active == 'balita_layanan' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('balita/layanan'); ?>">Layanan Balita</a></li>
                    </ul>
                </li>
                <li class="dropdown <?=( $menu_active == 'wuspus' ? 'active' : '' );?>">
                    <a class="nav-link has-dropdown" href="#"><i class="fas fa-heart"></i> <span>Wus Pus</span></a>
                    <ul class="dropdown-menu">
                        <li <?=( $subMenu_active == 'wuspus_data' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('wuspus'); ?>">Data Wus Pus</a></li>
                        <li <?=( $subMenu_active == 'wuspus_layanan' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('wuspus/layanan'); ?>">Layanan Wus Pus</a></li>
                    </ul>
                </li>
            <?php } ?>
            
            <?php if (in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_LV2)) { ?>
                <li class="menu-header">Data Master</li>
                <li <?=( $menu_active == 'desa' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('desa'); ?>"><i class="fas fa-map-marked-alt"></i> <span>Desa</span></a></li>
                <li <?=( $menu_active == 'posyandu' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('posyandu'); ?>"><i class="fas fa-clinic-medical"></i> <span>Posyandu</span></a></li>

                <li class="menu-header">Data Pengguna</li>
                <li <?=( $menu_active == 'pengguna' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('users'); ?>"><i class="fas fa-user"></i> <span>Pengguna</span></a></li>
                <?php if (in_array($this->session->userdata('role_name'), ROLE_ADMIN_CONTROL_NAME_LV1)) { ?>
                    <li <?=( $menu_active == 'configuration' ? 'class="active"' : '' );?>><a class="nav-link" href="<?= base_url('configuration'); ?>"><i class="fas fa-cogs"></i> <span>Web Configuration</span></a></li>
                <?php } ?>
            <?php } ?>

            

        </ul>

    </aside>
</div>