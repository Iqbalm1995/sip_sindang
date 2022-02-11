<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Layanan Posyandu Balita Tahun <?= $year_assign; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item"><a href="#">Balita</a></div>
        <div class="breadcrumb-item">Update Layanan <?= $year_assign; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('balita/layanan'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <?php if ($is_risk == 1) { ?>
                    <div class="alert alert-warning alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                        <div class="alert-title">Perhatian!</div>
                        Ibu Hamil <strong><?= $nama_ibu; ?></strong> sedang ditandai sebagai ibu hamil <strong>Beresiko</strong>.
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills pt-3" id="myTab3" role="tablist">
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link active" id="balita-tab1" data-toggle="tab" href="#balita1" role="tab" aria-controls="balita" aria-selected="true">Data Balita</a>
                            </li>
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link" id="balita-tab2" data-toggle="tab" href="#balita2" role="tab" aria-controls="penimbangan" aria-selected="false">Timbangan</a>
                            </li>
                            <li class="nav-item tombolfull">
                                <a class="nav-link" id="balita-tab3" data-toggle="tab" href="#balita3" role="tab" aria-controls="pelayanan" aria-selected="false">Layanan</a>
                            </li>
                            <li class="nav-item tombolfull">
                                <a class="nav-link" id="balita-tab4" data-toggle="tab" href="#balita4" role="tab" aria-controls="kunjungan" aria-selected="false">Kunjungan</a>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="balita1" role="tabpanel" aria-labelledby="balita-tab1">
                                <!-- Input data bayi -->
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                                            <div class="form-group" id='input_pos'>
                                                <div class="form-group">
                                                    <label>Posisi Posyandu Bayi <span class="text-danger">*</span></label>
                                                    <input type="text" name="pos_name_label" id="pos_name_label" class="form-control" value="<?= $pos_name; ?>" disabled>
                                                    <div class="invalid-feedback" id="pos_id_inv"></div>
                                                    <div class="valid-feedback" id="pos_id_valid"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="pos_id" id="pos_id" value="<?= $pos_name; ?>">
                                        <?php }else{ ?>
                                            <input type="hidden" name="pos_id" id="pos_id" value="<?= $this->session->userdata('pos_id'); ?>"> 
                                        <?php } ?>
                                        <input type="hidden" name="pos_name" id="pos_name" value="<?= $pos_name; ?>">
                                        <input type="hidden" name="desa_id" id="desa_id" value="<?= $desa_id; ?>">
                                        <input type="hidden" name="desa_name" id="desa_name" value="<?= $desa_name; ?>">
                                        <input type="hidden" name="year_assign" id="year_assign" value="<?= $year_assign; ?>">
                                        <div class="form-group">
                                            <label>Nomor KMS <span class="text-danger">*</span></label>
                                            <input type="text" name="kms" id="kms" class="form-control " maxlength="20" placeholder="Isi nomor kms..." value="<?= $kms; ?>" disabled onkeypress='numberOnly(event)'>
                                            <div class="invalid-feedback" id="kms_inv"></div>
                                            <div class="valid-feedback" id="kms_valid"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Anak <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_anak" id="nama_anak" class="form-control " placeholder="Isi nama anak..." value="<?= $nama_anak; ?>" required disabled>
                                            <div class="invalid-feedback" id="nama_anak_inv"></div>
                                        </div>
                                        <div class="form-group">
                                        <label>Tanggal Lahir Anak (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_lahir_anak" id="tgl_lahir_anak" class="form-control datepicker" value="<?= $tgl_lahir_anak; ?>" disabled>
                                            <div class="invalid-feedback" id="tgl_lahir_anak_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin Anak (L/P) <span class="text-danger">*</span></label>
                                            <div class="pl-3 pt-2 pb-2 row">
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="jkL" name="jk_anak" class="custom-control-input" value="L" <?= ( $jk_anak == "L" ? "checked" : "" ) ?> disabled> 
                                                    <label class="custom-control-label" for="jkL">Laki-laki</label>
                                                </div>
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="jkP" name="jk_anak" class="custom-control-input" value="P" <?= ( $jk_anak == "P" ? "checked" : "" ) ?> disabled>
                                                    <label class="custom-control-label" for="jkP">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control " placeholder="Isi nama ibu..." value="<?= $nama_ibu; ?>" required disabled>
                                            <div class="invalid-feedback" id="nama_ibu_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bapak <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_bapak" id="nama_bapak" class="form-control " placeholder="Isi nama bapak..." value="<?= $nama_bapak; ?>" required disabled>
                                            <div class="invalid-feedback" id="nama_bapak_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kel. Dawis</label>
                                            <input type="number" name="kel_dawis" id="kel_dawis" class="form-control" maxlength='3' value="<?= $kel_dawis; ?>" disabled>
                                            <div class="invalid-feedback" id="kel_dawis_inv"></div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="balita2" role="tabpanel" aria-labelledby="balita-tab2">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                <h5>Data penimbangan balita tahun <?= $year_assign; ?>.</h5>
                                            </div>
                                            <div class="card-body">
                                                <table border="0" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col"><strong>Bulan</strong></th>
                                                            <th scope="col"><strong>Tinggi (cm)</strong></th>
                                                            <th scope="col"><strong>Berat (kg)</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            if ($aksi == 'Ubah' && count($data_penimbangan) > 0) {
                                                                foreach ($data_penimbangan as $key => $value) { 
                                                                    $no=1;
                                                                    $arrayNum=0; ?>
                                                                <!-- Ubah Data -->
                                                                <tr>
                                                                    <input type="hidden" name="timbangan_balita_bln[]" id="timbangan_balita_bln<?= $arrayNum++; ?>" value="<?= $value->bulan; ?>">
                                                                    <input type="hidden" name="timbangan_balita_thn[]" id="timbangan_balita_thn<?= $arrayNum++; ?>" value="<?= $value->tahun; ?>">
                                                                    <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                                    <td><input type="number" class="form-control" name="tinggi_balita[]" value="<?= $value->tinggi_sekarang; ?>" min="0" step="0.1" pattern="^\d+(?:\.\d{1,1})?$"></td>
                                                                    <td><input type="number" class="form-control" name="berat_balita[]" value="<?= $value->berat_sekarang; ?>" min="0" step="0.1" pattern="^\d+(?:\.\d{1,1})?$"></td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php }else{ ?>
                                                            <!-- Tambah baru -->
                                                            <?php foreach (ARRAY_BULAN as $key => $value) { 
                                                                $no=1;
                                                                $arrayNum=0;
                                                            ?>
                                                                <tr>
                                                                    <input type="hidden" name="timbangan_balita_bln[]" id="timbangan_balita_bln<?= $arrayNum++; ?>" value="<?= $key; ?>">
                                                                    <input type="hidden" name="timbangan_balita_thn[]" id="timbangan_balita_thn<?= $arrayNum++; ?>" value="<?= $year_assign; ?>">
                                                                    <th scope="row"><?= $value; ?></th>
                                                                    <td><input type="number" class="form-control" name="tinggi_balita[]" value="0" min="0" step="0.1" pattern="^\d+(?:\.\d{1,1})?$"></td>
                                                                    <td><input type="number" class="form-control" name="berat_balita[]" value="0" min="0" step="0.1" pattern="^\d+(?:\.\d{1,1})?$"></td>
                                                                </tr>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                Data Timbangan balita Per Tahun
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($arsip_penimbangan)) { ?>
                                                    <ul>
                                                        <?php
                                                            foreach ($arsip_penimbangan as $r) {
                                                                echo '<li><a href="'.base_url('balita/update_layanan').'/'.$r->balita_id.'/'.$r->tahun.'" title="Arsip timbangan tahun '.$r->tahun.'">'.$r->tahun.'</a></li>';
                                                            }
                                                        ?>
                                                    </ul>
                                                <?php }else{ ?>
                                                    <div class="text-center">Belum ada data timbangan</div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="balita3" role="tabpanel" aria-labelledby="balita-tab3">
                                
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <div class="row">
                                                    
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <div class="control-label">Sirup Besi FE I</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status_pyd_syrp_besi_fe1" id="status_pyd_syrp_besi_fe1" <?= ( !empty($pyd_syrp_besi_fe1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group" style="display: none;" id="inpt_pyd_syrp_besi_fe1">
                                                            <label>Tanggal Sirup Besi FE 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                            <input type="text" name="pyd_syrp_besi_fe1" id="pyd_syrp_besi_fe1" class="form-control datepicker" value="<?= $pyd_syrp_besi_fe1; ?>">
                                                            <div class="invalid-feedback" id="pyd_syrp_besi_fe1_inv"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="control-label">Sirup Besi FE II</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status_pyd_syrp_besi_fe2" id="status_pyd_syrp_besi_fe2" <?= ( !empty($pyd_syrp_besi_fe2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group" style="display: none;" id="inpt_pyd_syrp_besi_fe2">
                                                            <label>Tanggal Sirup Besi FE 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                            <input type="text" name="pyd_syrp_besi_fe2" id="pyd_syrp_besi_fe2" class="form-control datepicker" value="<?= $pyd_syrp_besi_fe2; ?>">
                                                            <div class="invalid-feedback" id="pyd_syrp_besi_fe2_inv"></div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <div class="control-label">Vitamin A BLN I</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status_pyd_vit_a_bln1" id="status_pyd_vit_a_bln1" <?= ( !empty($pyd_vit_a_bln1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group" style="display: none;" id="inpt_pyd_vit_a_bln1">
                                                            <label>Tanggal Vitamin A BLN 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                            <input type="text" name="pyd_vit_a_bln1" id="pyd_vit_a_bln1" class="form-control datepicker" value="<?= $pyd_vit_a_bln1; ?>">
                                                            <div class="invalid-feedback" id="pyd_vit_a_bln1_inv"></div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="control-label">Vitamin A BLN II</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status_pyd_vit_a_bln2" id="status_pyd_vit_a_bln2" <?= ( !empty($pyd_vit_a_bln2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group" style="display: none;" id="inpt_pyd_vit_a_bln2">
                                                            <label>Tanggal Vitamin A BLN 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                            <input type="text" name="pyd_vit_a_bln2" id="pyd_vit_a_bln2" class="form-control datepicker" value="<?= $pyd_vit_a_bln2; ?>">
                                                            <div class="invalid-feedback" id="pyd_vit_a_bln2_inv"></div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                <div class="card">
                                                    <div class="card-body">
                                                        
                                                        <div class="form-group">
                                                            <div class="control-label">Oralit</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status_pyd_oralit" id="status_pyd_oralit" <?= ( !empty($pyd_oralit) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group" style="display: none;" id="inpt_pyd_oralit">
                                                            <label>Tanggal Pemberian Oralit (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                            <input type="text" name="pyd_oralit" id="pyd_oralit" class="form-control datepicker" value="<?= $pyd_oralit; ?>">
                                                            <div class="invalid-feedback" id="pyd_oralit_inv"></div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body">
                                                        
                                                        <div class="form-group">
                                                            <div class="control-label">PMT Pemulihan</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status_pyd_pmt_pemulihan" id="status_pyd_pmt_pemulihan" <?= ( !empty($pyd_pmt_pemulihan) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                            </label>
                                                        </div>
                                                        <div class="form-group" style="display: none;" id="inpt_pyd_pmt_pemulihan">
                                                            <label>Tanggal PMT Pemulihan (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                            <input type="text" name="pyd_pmt_pemulihan" id="pyd_pmt_pemulihan" class="form-control datepicker" value="<?= $pyd_pmt_pemulihan; ?>">
                                                            <div class="invalid-feedback" id="pyd_pmt_pemulihan_inv"></div>
                                                        </div>

                                                    </div>
                                                </div>

                                                
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <div class="control-label">Status Resiko Balita</div>
                                                            <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="is_risk" id="is_risk" <?= ( $is_risk == 1 ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                            <span class="custom-switch-indicator mt-3"></span>
                                                            <span class="custom-switch-description mt-3"> Non-Aktif / Aktif</span>
                                                            </label>
                                                            <br>
                                                            <small><em>*Mengaktifkan Status resiko akan menampilkan tanda perigatan resiko balita pada data ini.</em></small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="balita4" role="tabpanel" aria-labelledby="bayi-tab4">
                                <div class="row">
                                    
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                <h5>Data Kunjungan Layanan Balita tahun <?= $year_assign; ?>.</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><strong>Bulan</strong></th>
                                                                <th scope="col"><strong>Kunjungan</strong></th>
                                                                <th scope="col"><strong>Keterangan</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if (count($data_kunjugan) > 0) {
                                                                    $arrayNum=0;
                                                                    foreach ($data_kunjugan as $key => $value) { 
                                                                        $no=1; ?>
                                                                    <!-- Ubah Data -->
                                                                    <tr>
                                                                        <input type="hidden" name="kunjungan_balita_bln[]" id="kunjungan_balita_bln<?= $arrayNum; ?>" value="<?= $value->bulan; ?>">
                                                                        <input type="hidden" name="kunjungan_balita_thn[]" id="kunjungan_balita_thn<?= $arrayNum; ?>" value="<?= $value->tahun; ?>">
                                                                        <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_balita[]" id="kunjungan_balita<?= $arrayNum; ?>" <?= ( $value->is_kunjungan == 1 ? 'checked="true"' : '' ) ?>  onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" class="custom-switch-input">
                                                                            <span class="custom-switch-indicator mt-3"></span>
                                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span> 
                                                                            <input type="hidden" name="kunjungan_val[]" id="kunjungan_val<?= $arrayNum++; ?>" value="<?= $value->is_kunjungan; ?>">  
                                                                        </td>
                                                                        <td><input type="text" class="form-control" name="keterangan[]" value="<?= $value->keterangan; ?>"></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php }else{ ?>
                                                                <!-- Tambah baru -->
                                                                <?php 
                                                                    $arrayNum=0;
                                                                    foreach (ARRAY_BULAN as $key => $value) { 
                                                                    $no=1;
                                                                ?>
                                                                    <tr>
                                                                        <input type="hidden" name="kunjungan_balita_bln[]" id="kunjungan_balita_bln<?= $arrayNum; ?>" value="<?= $key; ?>">
                                                                        <input type="hidden" name="kunjungan_balita_thn[]" id="kunjungan_balita_thn<?= $arrayNum; ?>" value="<?= $year_assign; ?>">
                                                                        <th scope="row"><?= $value; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_balita[]" id="kunjungan_balita<?= $arrayNum; ?>" class="custom-switch-input" onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" >
                                                                            <span class="custom-switch-indicator mt-3"></span>
                                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>   
                                                                            <input type="hidden" name="kunjungan_val[]" id="kunjungan_val<?= $arrayNum++; ?>" value="0">   
                                                                        </td>
                                                                        <td><input type="text" class="form-control" name="keterangan[]" value=""></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke text-right">
                <div id="submit-state">
                    <button class="btn btn-light btn-lg tombolfull" type="reset">
                        <i class="fas fa-sync"></i> Reset</button>
                    <button class="btn btn-primary btn-lg tombolfull" type="button" id="btnSave" onclick="save()">
                        <i class="far fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</section>
</div>
<script type="text/javascript">

    var base_url = '<?= base_url(); ?>';
    var table;
    var save_method = '<?= $aksi; ?>';

    // Select2
    $(document).ready(function() {

        $("#pos_id").change(function(){ 
            var element = $(this).find('option:selected'); 
            var posName = element.attr("posName"); 
            var desaId = element.attr("desaId"); 
            var desaName = element.attr("desaName"); 

            $('#pos_name').val(posName); 
            $('#desa_id').val(desaId); 
            $('#desa_name').val(desaName); 

        });

        $('#submit-state').css('display', 'none');

        table = $('#tabel_timbangan').DataTable({ 
            "responsive": {
                details: {
                    type: 'inline'
                }
            },
            // "paging":   false,
            "ordering": false,
            // "info":     false,
            "pageLength": 6,
            "searching": false,
            "lengthChange": false
        });

        if ($('#status_pyd_syrp_besi_fe1').is(':checked')) {
            $("#inpt_pyd_syrp_besi_fe1").css('display', 'block');
        }else{
            $("#inpt_pyd_syrp_besi_fe1").css('display', 'none');
        }

        if ($('#status_pyd_syrp_besi_fe2').is(':checked')) {
            $("#inpt_pyd_syrp_besi_fe2").css('display', 'block');
        }else{
            $("#inpt_pyd_syrp_besi_fe2").css('display', 'none');
        }

        if ($('#status_pyd_vit_a_bln1').is(':checked')) {
            $("#inpt_pyd_vit_a_bln1").css('display', 'block');
        }else{
            $("#inpt_pyd_vit_a_bln1").css('display', 'none');
        }

        if ($('#status_pyd_vit_a_bln2').is(':checked')) {
            $("#inpt_pyd_vit_a_bln2").css('display', 'block');
        }else{
            $("#inpt_pyd_vit_a_bln2").css('display', 'none');
        }

        if ($('#status_pyd_pmt_pemulihan').is(':checked')) {
            $("#inpt_pyd_pmt_pemulihan").css('display', 'block');
        }else{
            $("#inpt_pyd_pmt_pemulihan").css('display', 'none');
        }

        if ($('#status_pyd_oralit').is(':checked')) {
            $("#inpt_pyd_oralit").css('display', 'block');
        }else{
            $("#inpt_pyd_oralit").css('display', 'none');
        }
        
    });

    function save()
    {
        var validation = _validation();
        if (validation == false) {
            swal('Perhatian', 'Isi form dengan lengkap!', 'warning');
            $('#balita-tab1').trigger('click')
            return
        }
        
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled',true);

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?= base_url('balita/action_process_services')?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);
                if(data.status_save)
                {
                    swal('Berhasil', 'Data balita berhasil disimpan!', 'success');
                }else{
                    swal('Gagal', 'Data balita gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data balita gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
    }

    function is_kunjungan(idx)
    {
        if ($("#kunjungan_balita"+idx).is(":checked")) {
            $("#kunjungan_val"+idx).val("1");
        }else{
            $("#kunjungan_val"+idx).val("0");
        }
        
    }

    $('#status_pyd_syrp_besi_fe1').change(function() {
        if (this.checked) {
            $("#inpt_pyd_syrp_besi_fe1").css('display', 'block');
        } else {
            $("#inpt_pyd_syrp_besi_fe1").css('display', 'none');
        }
    });

    $('#status_pyd_syrp_besi_fe2').change(function() {
        if (this.checked) {
            $("#inpt_pyd_syrp_besi_fe2").css('display', 'block');
        } else {
            $("#inpt_pyd_syrp_besi_fe2").css('display', 'none');
        }
    });

    $('#status_pyd_vit_a_bln1').change(function() {
        if (this.checked) {
            $("#inpt_pyd_vit_a_bln1").css('display', 'block');
        } else {
            $("#inpt_pyd_vit_a_bln1").css('display', 'none');
        }
    });

    $('#status_pyd_vit_a_bln2').change(function() {
        if (this.checked) {
            $("#inpt_pyd_vit_a_bln2").css('display', 'block');
        } else {
            $("#inpt_pyd_vit_a_bln2").css('display', 'none');
        }
    });

    $('#status_pyd_pmt_pemulihan').change(function() {
        if (this.checked) {
            $("#inpt_pyd_pmt_pemulihan").css('display', 'block');
        } else {
            $("#inpt_pyd_pmt_pemulihan").css('display', 'none');
        }
    });

    $('#status_pyd_oralit').change(function() {
        if (this.checked) {
            $("#inpt_pyd_oralit").css('display', 'block');
        } else {
            $("#inpt_pyd_oralit").css('display', 'none');
        }
    });

    $('#balita-tab1').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#balita-tab2').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#balita-tab3').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#balita-tab4').click(function(){
        $('#submit-state').css('display', 'block');
    });

    $('.nexttab').click(function(){
        $('.nav-pills > .nav-item > .active').parent().next().find("a").trigger('click');
    });
    $('.prevtab').click(function(){
        $('.nav-pills > .nav-item > .active').parent().prev().find("a").trigger('click');
    });

    function _validation() {
        var status = true;

        if ($("#pos_id").val() == "") {
            status = false;
            $("#pos_id").addClass('is-invalid');
            $("#pos_id_inv").text('Posyandu masih belum dipilih');
        }

        if ($('#status_pyd_syrp_besi_fe1').is(':checked')) {
            if ($("#pyd_syrp_besi_fe1").val() == "") {
                status = false;
                $("#pyd_syrp_besi_fe1").addClass('is-invalid');
                $("#pyd_syrp_besi_fe1_inv").text('Tanggal Sirup besi 1 masih kosong');
            }else{
                $("#pyd_syrp_besi_fe1").removeClass('is-invalid');
                $("#pyd_syrp_besi_fe1_inv").text('');
            }
        }

        if ($('#status_pyd_syrp_besi_fe2').is(':checked')) {
            if ($("#pyd_syrp_besi_fe2").val() == "") {
                status = false;
                $("#pyd_syrp_besi_fe2").addClass('is-invalid');
                $("#pyd_syrp_besi_fe2_inv").text('Tanggal Sirup besi 2 masih kosong');
            }else{
                $("#pyd_syrp_besi_fe2").removeClass('is-invalid');
                $("#pyd_syrp_besi_fe2_inv").text('');
            }
        }

        if ($('#status_pyd_vit_a_bln1').is(':checked')) {
            if ($("#pyd_vit_a_bln1").val() == "") {
                status = false;
                $("#pyd_vit_a_bln1").addClass('is-invalid');
                $("#pyd_vit_a_bln1_inv").text('Tanggal Vitamin Bln 1 masih kosong');
            }else{
                $("#pyd_vit_a_bln1").removeClass('is-invalid');
                $("#pyd_vit_a_bln1_inv").text('');
            }
        }

        if ($('#status_pyd_vit_a_bln2').is(':checked')) {
            if ($("#pyd_vit_a_bln2").val() == "") {
                status = false;
                $("#pyd_vit_a_bln2").addClass('is-invalid');
                $("#pyd_vit_a_bln2_inv").text('Tanggal Vitamin Bln 2 masih kosong');
            }else{
                $("#pyd_vit_a_bln2").removeClass('is-invalid');
                $("#pyd_vit_a_bln2_inv").text('');
            }
        }

        if ($('#status_pyd_pmt_pemulihan').is(':checked')) {
            if ($("#pyd_pmt_pemulihan").val() == "") {
                status = false;
                $("#pyd_pmt_pemulihan").addClass('is-invalid');
                $("#pyd_pmt_pemulihan_inv").text('Tanggal PMT Pemulihan masih kosong');
            }else{
                $("#pyd_pmt_pemulihan").removeClass('is-invalid');
                $("#pyd_pmt_pemulihan_inv").text('');
            }
        }

        if ($('#status_pyd_oralit').is(':checked')) {
            if ($("#pyd_oralit").val() == "") {
                status = false;
                $("#pyd_oralit").addClass('is-invalid');
                $("#pyd_oralit_inv").text('Tanggal Oralit masih kosong');
            }else{
                $("#pyd_oralit").removeClass('is-invalid');
                $("#pyd_oralit_inv").text('');
            }
        }

        return status
    }

    $("#pos_id").change(function(){
        if ($("#pos_id").val() != "") {
            $("#pos_id").removeClass('is-invalid');
            $("#pos_id_inv").text('');
        }
    });

    function numberOnly(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }

</script>