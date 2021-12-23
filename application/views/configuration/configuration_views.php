<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Web Configuration</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Web Configuration</div>
    </div>
    </div>
    
    <?php
        $target = $get_load_config->serial_number;
        $count = strlen($target) - 7;
        $output_sn = substr_replace($target, str_repeat('*', $count), 4, $count);
    ?>
    <div class="section-body">
    <h2 class="section-title">Information Web Build</h2>
    <p class="section-lead">This page cannot be modified, it contains data related to website activation.</p>

    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Info Config</h4>
                </div>
                <div class="card-body">
                    <table class="" cellspacing="0" width="100%">
                        <tr>
                           <td width="35%">Serial Number</td> 
                           <td width="2%">:</td> 
                           <td><?= $output_sn; ?></td> 
                        </tr>
                        <tr>
                           <td>App Full Name</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->app_full_name; ?></td> 
                        </tr>
                        <tr>
                           <td>App Sort Name</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->app_sort_name; ?></td> 
                        </tr>
                        <tr>
                           <td>App Type</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->app_type; ?></td> 
                        </tr>
                        <tr>
                           <td>Version</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->version; ?></td> 
                        </tr>
                        <tr>
                           <td>Build Date</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->build_date; ?></td> 
                        </tr>
                        <tr>
                           <td>Server IP</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->server_ip; ?></td> 
                        </tr>
                        <tr>
                           <td>Server Name</td> 
                           <td>:</td> 
                           <td><?= $get_load_config->server_name; ?></td> 
                        </tr>
                        <tr>
                           <td>Current Server IP</td> 
                           <td>:</td> 
                           <td><?= CURRENT_SERVER_IP; ?></td> 
                        </tr>
                        <tr>
                           <td>Website is Active</td> 
                           <td>:</td> 
                           <td><?= ($get_load_config->is_active == 1 ? "<strong class='text-success'>Active</strong>" : "<strong class='text-danger'>Non Active</strong>" ); ?></td> 
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                </div>
            </div>
        </div> -->
    </div>

    </div>
</section>
</div>