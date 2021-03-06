<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Bayi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item"><a href="#">Bayi</a></div>
        <div class="breadcrumb-item"><?= $aksi; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('bayi'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="<?= $acton_form; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills pt-3" id="myTab3" role="tablist">
                            <li class="nav-item pr-2">
                                <a class="nav-link active" id="bayi-tab1" data-toggle="tab" href="#bayi1" role="tab" aria-controls="bayi" aria-selected="true">Data Bayi</a>
                            </li>
                            <li class="nav-item pr-2">
                                <a class="nav-link" id="bayi-tab2" data-toggle="tab" href="#bayi2" role="tab" aria-controls="penimbangan" aria-selected="false">Timbangan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="bayi-tab3" data-toggle="tab" href="#bayi3" role="tab" aria-controls="pelayanan" aria-selected="false">Layanan</a>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="bayi1" role="tabpanel" aria-labelledby="bayi-tab1">
                                <!-- Input data bayi -->
                                <div class="row">
                                    <div class="col-md-6">
                                        
                                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                                            <div class="form-group" id='input_pos'>
                                                <label>Posisi Posyandu Bayi <span class="text-danger">*</span></label>
                                                <div class="form-group">
                                                    <div class=" pl-0 pr-0">
                                                        <select name="pos_id" id="pos_id" class="form-control select2">
                                                            <option value="">-Pilih Posyandu-</option>
                                                            <?php if (!empty($data_pos)) {
                                                                    foreach ($data_pos as $pos) {
                                                                        echo '<option value="'.$pos->id.'" posName="'.$pos->nama.'" desaId="'.$pos->desa_id.'" desaName="'.$pos->desa.'" '.( $pos_id == $pos->id ? "selected" : "" ).' >'.$pos->nama.'</option>';
                                                                    }
                                                                } ?>
                                                        </select>
                                                        <div class="invalid-feedback" id="pos_id_inv"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                            <input type="hidden" name="pos_id" id="pos_id" value="<?= $this->session->userdata('pos_id'); ?>"> 
                                        <?php } ?>
                                        <input type="hidden" name="pos_name" id="pos_name" value="<?= $pos_name; ?>">
                                        <input type="hidden" name="desa_id" id="desa_id" value="<?= $desa_id; ?>">
                                        <input type="hidden" name="desa_name" id="desa_name" value="<?= $desa_name; ?>">
                                        <input type="hidden" name="year_assign" id="year_assign" value="<?= $year_assign; ?>">
                                        <div class="form-group">
                                            <label>Nomor KMS <span class="text-danger">*</span></label>
                                            <input type="text" name="kms" id="kms" class="form-control " maxlength="20" placeholder="Isi nomor kms..." value="<?= $kms; ?>" <?= ( $aksi == 'Ubah' ? 'readonly' : '' ); ?> onkeypress='numberOnly(event)'>
                                            <div class="invalid-feedback" id="kms_inv"></div>
                                            <div class="valid-feedback" id="kms_valid"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bayi <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_bayi" id="nama_bayi" class="form-control " placeholder="Isi nama bayi..." value="<?= $nama_bayi; ?>" required>
                                            <div class="invalid-feedback" id="nama_bayi_inv"></div>
                                        </div>
                                        <div class="form-group">
                                        <label>Tanggal Lahir Bayi (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_lahir_bayi" id="tgl_lahir_bayi" class="form-control datepicker" value="<?= $tgl_lahir_bayi; ?>">
                                            <div class="invalid-feedback" id="tgl_lahir_bayi_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin Bayi (L/P) <span class="text-danger">*</span></label>
                                            <div class="pl-3 pt-2 pb-2 row">
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="jkL" name="jk_bayi" class="custom-control-input" value="L" <?= ( $jk_bayi == "L" ? "checked" : "" ) ?>>
                                                    <label class="custom-control-label" for="jkL">Laki-laki</label>
                                                </div>
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="jkP" name="jk_bayi" class="custom-control-input" value="P" <?= ( $jk_bayi == "P" ? "checked" : "" ) ?>>
                                                    <label class="custom-control-label" for="jkP">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bayi Baru Lahir (?) <span class="text-danger">*</span></label>
                                            <div class="pl-3 pt-2 pb-2 row">
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="bblT" name="bbl" class="custom-control-input" value="0" <?= ( $bbl == "0" ? "checked" : "" ) ?>>
                                                    <label class="custom-control-label" for="bblT">Tidak</label>
                                                </div>
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="bblY" name="bbl" class="custom-control-input" value="1" <?= ( $bbl == "1" ? "checked" : "" ) ?>>
                                                    <label class="custom-control-label" for="bblY">Ya</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control " placeholder="Isi nama ibu..." value="<?= $nama_ibu; ?>" required>
                                            <div class="invalid-feedback" id="nama_ibu_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bapak <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_bapak" id="nama_bapak" class="form-control " placeholder="Isi nama bapak..." value="<?= $nama_bapak; ?>" required>
                                            <div class="invalid-feedback" id="nama_bapak_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kel. Dawis</label>
                                            <input type="number" name="kel_dawis" id="kel_dawis" class="form-control" maxlength='3' value="<?= $kel_dawis; ?>">
                                            <div class="invalid-feedback" id="kel_dawis_inv"></div>
                                        </div>

                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bayi2" role="tabpanel" aria-labelledby="bayi-tab2">
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <h5>Data penimbangan bayi tahun <?= $year_assign; ?>.</h5>
                                        <hr>
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
                                                            <input type="hidden" name="timbangan_bayi_bln[]" id="timbangan_bayi_bln<?= $arrayNum++; ?>" value="<?= $value->bulan; ?>">
                                                            <input type="hidden" name="timbangan_bayi_thn[]" id="timbangan_bayi_thn<?= $arrayNum++; ?>" value="<?= $value->tahun; ?>">
                                                            <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                            <td><input type="number" class="form-control" name="tinggi_bayi[]" value="<?= $value->tinggi_sekarang; ?>"></td>
                                                            <td><input type="number" class="form-control" name="berat_bayi[]" value="<?= $value->berat_sekarang; ?>"></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php }else{ ?>
                                                    <!-- Tambah baru -->
                                                    <?php foreach (ARRAY_BULAN as $key => $value) { 
                                                        $no=1;
                                                        $arrayNum=0;
                                                    ?>
                                                        <tr>
                                                            <input type="hidden" name="timbangan_bayi_bln[]" id="timbangan_bayi_bln<?= $arrayNum++; ?>" value="<?= $key; ?>">
                                                            <input type="hidden" name="timbangan_bayi_thn[]" id="timbangan_bayi_thn<?= $arrayNum++; ?>" value="<?= $year_assign; ?>">
                                                            <th scope="row"><?= $value; ?></th>
                                                            <td><input type="number" class="form-control" name="tinggi_bayi[]" value="0"></td>
                                                            <td><input type="number" class="form-control" name="berat_bayi[]" value="0"></td>
                                                        </tr>
                                                    <?php } ?>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
                                    <button class="btn btn-primary btn-lg nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bayi3" role="tabpanel" aria-labelledby="bayi-tab3">
                                
                                <div class="row">
                                    <div class="col-md-4">
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

                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="form-group">
                                                    <div class="control-label">Oralit</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_oralit" id="pyd_oralit" <?= ( !empty($pyd_oralit) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="form-group">
                                                    <div class="control-label">BCG</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_bcg" id="pyd_bcg" <?= ( !empty($pyd_bcg) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="form-group">
                                                    <div class="control-label">DPT I</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_dpt1" id="pyd_dpt1" <?= ( !empty($pyd_dpt1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">DPT II</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_dpt2" id="pyd_dpt2" <?= ( !empty($pyd_dpt2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">DPT III</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_dpt3" id="pyd_dpt3" <?= ( !empty($pyd_dpt3) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="form-group">
                                                    <div class="control-label">POLIO I</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_polio1" id="pyd_polio1" <?= ( !empty($pyd_polio1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">POLIO II</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_polio2" id="pyd_polio2" <?= ( !empty($pyd_polio2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">POLIO III</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_polio3" id="pyd_polio3" <?= ( !empty($pyd_polio3) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">POLIO IV</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_polio4" id="pyd_polio4" <?= ( !empty($pyd_polio4) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="form-group">
                                                    <div class="control-label">Campak</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_campak" id="pyd_campak" <?= ( !empty($pyd_campak) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="form-group">
                                                    <div class="control-label">HEPATITIS I</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_hepatitis1" id="pyd_hepatitis1" <?= ( !empty($pyd_hepatitis1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">HEPATITIS II</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_hepatitis2" id="pyd_hepatitis2" <?= ( !empty($pyd_hepatitis2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="control-label">HEPATITIS III</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_hepatitis3" id="pyd_hepatitis3" <?= ( !empty($pyd_hepatitis3) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card">
                                            <div class="card-body">

                                                <div class="form-group">
                                                    <div class="control-label">Status Meninggal Bayi</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_meninggal_bayi" id="status_meninggal_bayi" <?= ( !empty($tgl_meninggal_bayi) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_tgl_meninggal_bayi">
                                                    <label>Tanggal Meninggal Bayi (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="tgl_meninggal_bayi" id="tgl_meninggal_bayi" class="form-control datepicker" value="<?= $tgl_meninggal_bayi; ?>">
                                                    <div class="invalid-feedback" id="tgl_meninggal_bayi_inv"></div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea name="keterangan" id="keterangan" class="form-control" style="height: 150px;" placeholder="Isi Keterangan (Opsional)..."><?= ( !empty($keterangan) ? $keterangan : '' ); ?></textarea>
                                                    <div class="invalid-feedback" id="keterangan_inv"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
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

        if ($('#status_meninggal_bayi').is(':checked')) {
            $("#inpt_tgl_meninggal_bayi").css('display', 'block');
        }else{
            $("#inpt_tgl_meninggal_bayi").css('display', 'none');
        }
        
    }); 

    $('#kms').change(function() {
        if (save_method == 'Tambah') {
            if (this.value != "") {
                cek_kms(this.value);
            }
        }
    });

    function cek_kms(kms)
    {
        $.ajax({
            url : "<?= base_url('bayi/cek_data_bayi_json')?>/" + kms,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                if (readData == null) {
                    // some true condition
                }else{
                    swal({
                            title: 'Cek data Nomor KMS',
                            text: 'Nomor KMS "'+ kms +'" sudah terdaftar di data bayi!',
                            icon: 'warning',
                            dangerMode: true,
                        }).then((ok) => {
                            $("#kms").val("");
                            $("#kms").focus();
                            $("#kms").addClass('is-invalid');
                            $("#kms_inv").text('Nomor KMS sudah terdaftar di data bayi');
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mencari nomor KMS!', 'error');
                $("#kms").focus();
            }
        });
    }

    $('#status_meninggal_bayi').change(function() {
        if (this.checked) {
            $("#inpt_tgl_meninggal_bayi").css('display', 'block');
        } else {
            $("#inpt_tgl_meninggal_bayi").css('display', 'none');
        }
    });

    function save()
    {
        var validation = _validation();
        if (validation == false) {
            swal('Perhatian', 'Isi form dengan lengkap!', 'warning');
            $('#bayi-tab1').trigger('click')
            return
        }
        
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled',true);

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?= base_url('bayi/action_process')?>",
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
                    swal('Berhasil', 'Data bayi berhasil disimpan!', 'success').then((data) => {
                        document.location = "<?php echo base_url('bayi')?>";
                    });
                }else{
                    swal('Gagal', 'Data bayi gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data bayi gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
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

    $('#status_meninggal_bayi').change(function() {
        if (this.checked) {
            $("#inpt_tgl_meninggal_bayi").css('display', 'block');
        } else {
            $("#inpt_tgl_meninggal_bayi").css('display', 'none');
        }
    });

    $('#bayi-tab1').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#bayi-tab2').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#bayi-tab3').click(function(){
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

        if ($("#kms").val() == "") {
            status = false;
            $("#kms").addClass('is-invalid');
            $("#kms_inv").text('Nomor KMS masih kosong');
        }

        if ($("#nama_ibu").val() == "") {
            status = false;
            $("#nama_ibu").addClass('is-invalid');
            $("#nama_ibu_inv").text('Nama ibu masih kosong');
        }

        if ($("#nama_bapak").val() == "") {
            status = false;
            $("#nama_bapak").addClass('is-invalid');
            $("#nama_bapak_inv").text('Nama bapak masih kosong');
        }

        if ($("#nama_bayi").val() == "") {
            status = false;
            $("#nama_bayi").addClass('is-invalid');
            $("#nama_bayi_inv").text('Nama bayi masih kosong');
        }

        if ($("#tgl_lahir_bayi").val() == "") {
            status = false;
            $("#tgl_lahir_bayi").addClass('is-invalid');
            $("#tgl_lahir_bayi_inv").text('Tanggal lahir bayi masih kosong');
        }

        if ($('#status_meninggal_bayi').is(':checked')) {
            if ($("#tgl_meninggal_bayi").val() == "") {
                status = false;
                $("#tgl_meninggal_bayi").addClass('is-invalid');
                $("#tgl_meninggal_bayi_inv").text('Tanggal meninggal bayi masih kosong');
            }else{
                $("#tgl_meninggal_bayi").removeClass('is-invalid');
                $("#tgl_meninggal_bayi_inv").text('');
            }
        }

        if ($("#role_id").val() != 'eccdbd9e-4c84-11ec-802e-089798e691ce' && $("#role_id").val() != 'f104827c-4c84-11ec-802e-089798e691ce') {
            if ($("#pos_id").val() == "") {
                status = false;
                $("#pos_id").addClass('is-invalid');
                $("#pos_id_inv").text('Role masih belum dipilih');
            }
        }

        if ($("#pos_id").val() == "") {
            status = false;
            $("#pos_id").addClass('is-invalid');
            $("#pos_id_inv").text('Posyandu masih belum dipilih');
        }

        return status
    }

    $("#kms").keyup(function(){
        if ($("#kms").val() != "") {
            $("#kms").removeClass('is-invalid');
            $("#kms_inv").text('');
        }
    });

    $("#nama_ibu").keyup(function(){
        if ($("#nama_ibu").val() != "") {
            $("#nama_ibu").removeClass('is-invalid');
            $("#nama_ibu_inv").text('');
        }
    });

    $("#nama_bapak").keyup(function(){
        if ($("#nama_bapak").val() != "") {
            $("#nama_bapak").removeClass('is-invalid');
            $("#nama_bapak_inv").text('');
        }
    });

    $("#nama_bayi").keyup(function(){
        if ($("#nama_bayi").val() != "") {
            $("#nama_bayi").removeClass('is-invalid');
            $("#nama_bayi_inv").text('');
        }
    });

    $("#tgl_lahir_bayi").keyup(function(){
        if ($("#tgl_lahir_bayi").val() != "") {
            $("#tgl_lahir_bayi").removeClass('is-invalid');
            $("#tgl_lahir_bayi_inv").text('');
        }
    });

    $("#tgl_lahir_bayi").change(function(){
        if ($("#tgl_lahir_bayi").val() != "") {
            $("#tgl_lahir_bayi").removeClass('is-invalid');
            $("#tgl_lahir_bayi_inv").text('');
        }
    });

    $("#tgl_meninggal_bayi").keyup(function(){
        if ($("#tgl_meninggal_bayi").val() != "") {
            $("#tgl_meninggal_bayi").removeClass('is-invalid');
            $("#tgl_meninggal_bayi_inv").text('');
        }
    });

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