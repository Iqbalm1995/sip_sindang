<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Web Configuration</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Web Configuration</div>
    </div>
    </div>

    <div class="section-body">
    <h2 class="section-title">Information Web Build</h2>
    <p class="section-lead">This page cannot be modified, it contains data related to website activation.</p>
    <div class="card">
        <div class="card-header">
        <h4>Option Config</h4>
        </div>
        <div class="card-body">
            <?php
                $target = $get_load_config->serial_number;
                $count = strlen($target) - 7;
                $output_sn = substr_replace($target, str_repeat('*', $count), 4, $count);
            ?>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Serial Number</label>
                        <input type="text" class="form-control " value="<?= $output_sn; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>App Full Name</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->app_full_name; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>App Sort Name</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->app_sort_name; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>App Type</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->app_type; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>Version</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->version; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>Build Date</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->build_date; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>Server IP</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->server_ip; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>Server Name</label>
                        <input type="text" class="form-control " value="<?= $get_load_config->server_name; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    <div class="form-group">
                        <label>Current Server IP</label>
                        <input type="text" class="form-control " value="<?= $_SERVER['SERVER_ADDR']; ?>" disabled>
                        <div class="invalid-feedback" id="nama_user_inv"></div>
                    </div>
                    

                </div>
            </div>

        </div>
        <div class="card-footer bg-whitesmoke">
        This page cannot be modified.
        </div>
    </div>
    </div>
</section>
</div>