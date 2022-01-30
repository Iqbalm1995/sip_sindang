<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Layanan Posyandu Bumil Dan Bulin Tahun <?= $year_assign; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Bumil Dan Bulin</a></div>
        <div class="breadcrumb-item"><a href="#">Bumil Dan Bulin</a></div>
        <div class="breadcrumb-item">Update Layanan <?= $year_assign; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('bumlin/layanan'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <?php if ($pyd_resiko == 1) { ?>
                    <div class="alert alert-warning alert-has-icon">
                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                        <div class="alert-body">
                        <div class="alert-title">Perhatian!</div>
                        Ibu Hamil <strong><?= $nama_bumil; ?></strong> sedang ditandai sebagai ibu hamil <strong>Beresiko</strong>.
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills pt-3" id="myTab3" role="tablist">
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link active" id="bumlin-tab1" data-toggle="tab" href="#bumlin1" role="tab" aria-controls="bumlin" aria-selected="true">Data Bumil Dan Bulin</a>
                            </li>
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link" id="bumlin-tab2" data-toggle="tab" href="#bumlin2" role="tab" aria-controls="pelayanan" aria-selected="false">Layanan</a>
                            </li>
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link" id="bumlin-tab3" data-toggle="tab" href="#bumlin3" role="tab" aria-controls="pemeriksaan" aria-selected="false">Pemeriksaan</a>
                            </li>
                            <li class="nav-item tombolfull">
                                <a class="nav-link" id="bumlin-tab4" data-toggle="tab" href="#bumlin4" role="tab" aria-controls="kunjungan" aria-selected="false">Kunjungan</a>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="bumlin1" role="tabpanel" aria-labelledby="bumlin-tab1">
                                <!-- Input data Bumil Dan Bulin -->
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                                            <div class="form-group" id='input_pos'>
                                                <div class="form-group">
                                                    <label>Posisi Posyandu Bumil Dan Bulin <span class="text-danger">*</span></label>
                                                    <input type="text" name="pos_name_label" id="pos_name_label" class="form-control" value="<?= $pos_name; ?>" disabled>
                                                    <div class="invalid-feedback" id="pos_id_inv"></div>
                                                    <div class="valid-feedback" id="pos_id_valid"></div>
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                            <input type="hidden" name="pos_id" id="pos_id" value="<?= $this->session->userdata('pos_id'); ?>" disabled> 
                                        <?php } ?>
                                        <input type="hidden" name="pos_name" id="pos_name" value="<?= $pos_name; ?>">
                                        <input type="hidden" name="desa_id" id="desa_id" value="<?= $desa_id; ?>">
                                        <input type="hidden" name="desa_name" id="desa_name" value="<?= $desa_name; ?>">
                                        <input type="hidden" name="year_assign" id="year_assign" value="<?= $year_assign; ?>">
                                        <div class="form-group">
                                            <label>Nomor KMS <span class="text-danger">*</span></label>
                                            <input type="text" name="kms" id="kms" class="form-control " maxlength="20" placeholder="Isi Nomor KMS..." value="<?= $kms; ?>" disabled onkeypress='numberOnly(event)'>
                                            <div class="invalid-feedback" id="kms_inv"></div>
                                            <div class="valid-feedback" id="kms_valid"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Pendaftaran <span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_pendaftaran" id="tgl_pendaftaran" class="form-control datepicker" value="<?= $tgl_pendaftaran; ?>" disabled>
                                            <div class="invalid-feedback" id="tgl_pendaftaran_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Ibu Hamil <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_bumil" id="nama_bumil" class="form-control " placeholder="Isi Nama Ibu Hamil..." value="<?= $nama_bumil; ?>" disabled>
                                            <div class="invalid-feedback" id="nama_bumil_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Umur <span class="text-danger">*</span></label>
                                            <input type="number" name="umur" id="umur" class="form-control " placeholder="Isi umur..." value="<?= $umur; ?>" disabled>
                                            <div class="invalid-feedback" id="umur_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kel Dawis</label>
                                            <input type="number" name="kel_dawis" id="kel_dawis" class="form-control " maxlength='3' placeholder="Isi Kel dawis..." value="<?= $kel_dawis; ?>" disabled>
                                            <div class="invalid-feedback" id="kel_dawis_inv"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bumlin2" role="tabpanel" aria-labelledby="bumlin-tab2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Umur Kehamilan</label>
                                                    <input type="number" name="umur_kehamilan" id="umur_kehamilan" class="form-control " maxlength='3' placeholder="0" value="<?= $umur_kehamilan; ?>" >
                                                    <div class="invalid-feedback" id="umur_kehamilan_inv"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Hamil Ke ?</label>
                                                    <input type="number" name="hamil_ke" id="hamil_ke" class="form-control " maxlength='2' placeholder="1" value="<?= $hamil_ke; ?>" >
                                                    <div class="invalid-feedback" id="hamil_ke_inv"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <h5>Pil Tambah Darah Pada Kehamilan</h5>
                                                <div class="form-group">
                                                    <div class="control-label">FE BLN 1</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_pyd_ptdh_fe1" id="status_pyd_ptdh_fe1" <?= ( !empty($pyd_ptdh_fe1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_pyd_ptdh_fe1">
                                                    <label>Tanggal FE BLN 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="pyd_ptdh_fe1" id="pyd_ptdh_fe1" class="form-control datepicker" value="<?= $pyd_ptdh_fe1; ?>">
                                                    <div class="invalid-feedback" id="pyd_ptdh_fe1_inv"></div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="control-label">FE BLN 2</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_pyd_ptdh_fe2" id="status_pyd_ptdh_fe2" <?= ( !empty($pyd_ptdh_fe2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_pyd_ptdh_fe2">
                                                    <label>Tanggal FE BLN 2 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="pyd_ptdh_fe2" id="pyd_ptdh_fe2" class="form-control datepicker" value="<?= $pyd_ptdh_fe2; ?>">
                                                    <div class="invalid-feedback" id="pyd_ptdh_fe2_inv"></div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="control-label">FE BLN 3</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_pyd_ptdh_fe3" id="status_pyd_ptdh_fe3" <?= ( !empty($pyd_ptdh_fe3) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_pyd_ptdh_fe3">
                                                    <label>Tanggal FE BLN 3 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="pyd_ptdh_fe3" id="pyd_ptdh_fe3" class="form-control datepicker" value="<?= $pyd_ptdh_fe3; ?>">
                                                    <div class="invalid-feedback" id="pyd_ptdh_fe3_inv"></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <h5>Imunisasi TT</h5>
                                                <div class="form-group">
                                                    <div class="control-label">Imunisasi BLN 1</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_pyd_imsi1" id="status_pyd_imsi1" <?= ( !empty($pyd_imsi1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_pyd_imsi1">
                                                    <label>Tanggal Imunisasi BLN 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="pyd_imsi1" id="pyd_imsi1" class="form-control datepicker" value="<?= $pyd_imsi1; ?>">
                                                    <div class="invalid-feedback" id="pyd_imsi1_inv"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="control-label">Imunisasi BLN 2</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_pyd_imsi2" id="status_pyd_imsi2" <?= ( !empty($pyd_imsi2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_pyd_imsi2">
                                                    <label>Tanggal Imunisasi BLN 2 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="pyd_imsi2" id="pyd_imsi2" class="form-control datepicker" value="<?= $pyd_imsi2; ?>">
                                                    <div class="invalid-feedback" id="pyd_imsi2_inv"></div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="control-label">Pemberian Kapsul Yodium</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_pyd_kapsul_yodium" id="status_pyd_kapsul_yodium" <?= ( !empty($pyd_kapsul_yodium) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_pyd_kapsul_yodium">
                                                    <label>Tanggal Pemberian Kapsul Yodium (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="pyd_kapsul_yodium" id="pyd_kapsul_yodium" class="form-control datepicker" value="<?= $pyd_kapsul_yodium; ?>">
                                                    <div class="invalid-feedback" id="pyd_kapsul_yodium_inv"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <h5>Melahirkan Bayi</h5>
                                                <div class="form-group">
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_lahir_tanggal" id="status_lahir_tanggal" <?= ( !empty($lahir_tanggal) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_lahir_tanggal">
                                                    <label>Tanggal Melahirkan (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="lahir_tanggal" id="lahir_tanggal" class="form-control datepicker" value="<?= $lahir_tanggal; ?>">
                                                    <div class="invalid-feedback" id="lahir_tanggal_inv"></div>
                                                    <div class="form-group pt-2">
                                                        <label>Jenis Kelamin Bayi (L/P) <span class="text-danger">*</span></label>
                                                        <div class="pl-3 pt-2 pb-2 row">
                                                            <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                                <input type="radio" id="jkL" name="bayi_jk" class="custom-control-input" value="L" <?= ( $bayi_jk == "L" ? "checked" : "" ) ?>>
                                                                <label class="custom-control-label" for="jkL">Laki-laki</label>
                                                            </div>
                                                            <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                                <input type="radio" id="jkP" name="bayi_jk" class="custom-control-input" value="P" <?= ( $bayi_jk == "P" ? "checked" : "" ) ?>>
                                                                <label class="custom-control-label" for="jkP">Perempuan</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Ditolong Melahirkan Oleh</label>
                                                        <select name="lahir_pic" id="lahir_pic" class="form-control select2">
                                                            <option value="">-Pilih-</option>
                                                            <?php if (!empty($get_pic_melahirkan)) {
                                                                    foreach ($get_pic_melahirkan as $aks) {
                                                                        echo '<option value="'.$aks->enum_name.'" '.( $lahir_pic == $aks->enum_name ? "selected" : "" ).' >'.$aks->enum_name.'</option>';
                                                                    }
                                                                } ?>
                                                        </select>
                                                        <div class="invalid-feedback" id="lahir_pic_inv"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Berat (Dalam Gram)</label>
                                                        <input type="number" name="bayi_berat" id="bayi_berat" class="form-control " maxlength='8' placeholder="0" value="<?= $bayi_berat; ?>" >
                                                        <div class="invalid-feedback" id="bayi_berat_inv"></div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <div class="control-label">Bayi Meninggal</div>
                                                        <label class="custom-switch mt-2">
                                                        <input type="checkbox" name="status_bayi_meninggal" id="status_bayi_meninggal" <?= ( !empty($bayi_meninggal) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                        <span class="custom-switch-indicator mt-3"></span>
                                                        <span class="custom-switch-description mt-3"> Tidak / Ya</span>
                                                        </label>
                                                    </div>
                                                    <div class="form-group" style="display: none;" id="inpt_bayi_meninggal">
                                                        <label>Tanggal Bayi Meninggal (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                        <input type="text" name="bayi_meninggal" id="bayi_meninggal" class="form-control datepicker" value="<?= $bayi_meninggal; ?>">
                                                        <div class="invalid-feedback" id="bayi_meninggal_inv"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <h5>Ibu</h5>
                                                <div class="form-group">
                                                    <div class="control-label">Ibu Meninggal</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="status_ibu_meninggal" id="status_ibu_meninggal" <?= ( !empty($ibu_meninggal) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Tidak / Ya</span>
                                                    </label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="inpt_ibu_meninggal">
                                                    <label>Tanggal Ibu Meninggal (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                                    <input type="text" name="ibu_meninggal" id="ibu_meninggal" class="form-control datepicker" value="<?= $ibu_meninggal; ?>">
                                                    <div class="invalid-feedback" id="ibu_meninggal_inv"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ibu Menyisui</label>
                                                    <select name="ibu_menyusui" id="ibu_menyusui" class="form-control select2">
                                                        <option value="">-Pilih-</option>
                                                        <option value="1" <?= ( $ibu_menyusui == 1 ? "selected" : "") ?>>Ya</option>
                                                        <option value="0" <?= ( $ibu_menyusui == 0 ? "selected" : "") ?>>Tidak</option>
                                                    </select>
                                                    <div class="invalid-feedback" id="ibu_menyusui_inv"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="control-label">Status Resiko Ibu Hamil</div>
                                                    <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="pyd_resiko" id="pyd_resiko" <?= ( $pyd_resiko == 1 ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                                    <span class="custom-switch-indicator mt-3"></span>
                                                    <span class="custom-switch-description mt-3"> Non-Aktif / Aktif</span>
                                                    </label>
                                                    <br>
                                                    <small><em>*Mengaktifkan Status resiko akan menampilkan tanda perigatan resiko ibu hamil pada data ini.</em></small>
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
                            <div class="tab-pane fade" id="bumlin3" role="tabpanel" aria-labelledby="bumlin-tab3">
                                <div class="row">
                                    <div class="offset-md-1 col-md-10 offset-md-1 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                <h5>Data Pemeriksaan Bumil Dan Bulin tahun <?= $year_assign; ?>.</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col"><strong>Bulan</strong></th>
                                                                <th scope="col"><strong>Tekanan Darah</strong></th>
                                                                <th scope="col"><strong>Berat Badan</strong></th>
                                                                <th scope="col"><strong>Resiko?</strong></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                if (count($data_pemeriksaan) > 0) {
                                                                    $arrayNum=0;
                                                                    foreach ($data_pemeriksaan as $key => $value) { 
                                                                        $no=1; ?>
                                                                    <!-- Ubah Data -->
                                                                    <tr>
                                                                        <input type="hidden" name="pmk_bumlin_bln[]" id="pmk_bumlin_bln<?= $arrayNum; ?>" value="<?= $value->bulan; ?>">
                                                                        <input type="hidden" name="pmk_bumlin_thn[]" id="pmk_bumlin_thn<?= $arrayNum; ?>" value="<?= $value->tahun; ?>">
                                                                        <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                                        <td><input type="text" class="form-control" name="pmk_bumlin_tkn_darah[]" value="<?= $value->tekanan_darah; ?>"></td>
                                                                        <td><input type="text" class="form-control" name="pmk_bumlin_berat_badan[]" value="<?= $value->berat_badan; ?>"></td>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="pmk_bumlin_risk[]" id="pmk_bumlin_risk<?= $arrayNum; ?>" <?= ( $value->is_risk == 1 ? 'checked="true"' : '' ) ?>  onchange="is_risk(<?= $arrayNum; ?>)" value="1" class="custom-switch-input">
                                                                            <span class="custom-switch-indicator mt-3"></span>
                                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span> 
                                                                            <input type="hidden" name="pmk_bumlin_risk_val[]" id="pmk_bumlin_risk_val<?= $arrayNum++; ?>" value="<?= $value->is_risk; ?>">   
                                                                        </td>
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
                                                                        <input type="hidden" name="pmk_bumlin_bln[]" id="pmk_bumlin_bln<?= $arrayNum; ?>" value="<?= $key; ?>">
                                                                        <input type="hidden" name="pmk_bumlin_thn[]" id="pmk_bumlin_thn<?= $arrayNum; ?>" value="<?= $year_assign; ?>">
                                                                        <th scope="row"><?= $value; ?></th>
                                                                        <td><input type="text" class="form-control" name="pmk_bumlin_tkn_darah[]" value="0/0"></td>
                                                                        <td><input type="text" class="form-control" name="pmk_bumlin_berat_badan[]" value="0"></td>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="pmk_bumlin_risk[]" id="pmk_bumlin_risk<?= $arrayNum; ?>" onchange="is_risk(<?= $arrayNum; ?>)" value="1" class="custom-switch-input">
                                                                            <span class="custom-switch-indicator mt-3"></span>
                                                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span> 
                                                                            <input type="hidden" name="pmk_bumlin_risk_val[]" id="pmk_bumlin_risk_val<?= $arrayNum++; ?>">   
                                                                        </td>
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
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bumlin4" role="tabpanel" aria-labelledby="bumlin-tab4">
                                
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                <h5>Data Kunjungan Bumil Dan Bulin tahun <?= $year_assign; ?>.</h5>
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
                                                                        <input type="hidden" name="kunjungan_bumlin_bln[]" id="kunjungan_bumlin_bln<?= $arrayNum; ?>" value="<?= $value->bulan; ?>">
                                                                        <input type="hidden" name="kunjungan_bumlin_thn[]" id="kunjungan_bumlin_thn<?= $arrayNum; ?>" value="<?= $value->tahun; ?>">
                                                                        <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_bumlin[]" id="kunjungan_bumlin<?= $arrayNum; ?>" <?= ( $value->is_kunjungan == 1 ? 'checked="true"' : '' ) ?>  onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" class="custom-switch-input">
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
                                                                        <input type="hidden" name="kunjungan_bumlin_bln[]" id="kunjungan_bumlin_bln<?= $arrayNum; ?>" value="<?= $key; ?>">
                                                                        <input type="hidden" name="kunjungan_bumlin_thn[]" id="kunjungan_bumlin_thn<?= $arrayNum; ?>" value="<?= $year_assign; ?>">
                                                                        <th scope="row"><?= $value; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_bumlin[]" id="kunjungan_bumlin<?= $arrayNum; ?>" class="custom-switch-input" onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" >
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
    // removeAttr
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

        if ($('#status_pyd_ptdh_fe1').is(':checked')) {
            $("#inpt_pyd_ptdh_fe1").css('display', 'block');
        }else{
            $("#inpt_pyd_ptdh_fe1").css('display', 'none');
        }

        if ($('#status_pyd_ptdh_fe2').is(':checked')) {
            $("#inpt_pyd_ptdh_fe2").css('display', 'block');
        }else{
            $("#inpt_pyd_ptdh_fe2").css('display', 'none');
        }

        if ($('#status_pyd_ptdh_fe3').is(':checked')) {
            $("#inpt_pyd_ptdh_fe3").css('display', 'block');
        }else{
            $("#inpt_pyd_ptdh_fe3").css('display', 'none');
        }

        if ($('#status_pyd_imsi1').is(':checked')) {
            $("#inpt_pyd_imsi1").css('display', 'block');
        }else{
            $("#inpt_pyd_imsi1").css('display', 'none');
        }

        if ($('#status_pyd_imsi2').is(':checked')) {
            $("#inpt_pyd_imsi2").css('display', 'block');
        }else{
            $("#inpt_pyd_imsi2").css('display', 'none');
        }

        if ($('#status_lahir_tanggal').is(':checked')) {
            $("#inpt_lahir_tanggal").css('display', 'block');
        }else{
            $("#inpt_lahir_tanggal").css('display', 'none');
        }

        if ($('#status_pyd_kapsul_yodium').is(':checked')) {
            $("#inpt_pyd_kapsul_yodium").css('display', 'block');
        }else{
            $("#inpt_pyd_kapsul_yodium").css('display', 'none');
        }

        if ($('#status_bayi_meninggal').is(':checked')) {
            $("#inpt_bayi_meninggal").css('display', 'block');
        }else{
            $("#inpt_bayi_meninggal").css('display', 'none');
        }

        if ($('#status_ibu_meninggal').is(':checked')) {
            $("#inpt_ibu_meninggal").css('display', 'block');
        }else{
            $("#inpt_ibu_meninggal").css('display', 'none');
        }

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
        
    });

    $('#status_pyd_ptdh_fe1').change(function() {
        if (this.checked) {
            $("#inpt_pyd_ptdh_fe1").css('display', 'block');
        } else {
            $("#inpt_pyd_ptdh_fe1").css('display', 'none');
        }
    });

    $('#status_pyd_ptdh_fe2').change(function() {
        if (this.checked) {
            $("#inpt_pyd_ptdh_fe2").css('display', 'block');
        } else {
            $("#inpt_pyd_ptdh_fe2").css('display', 'none');
        }
    });

    $('#status_pyd_ptdh_fe3').change(function() {
        if (this.checked) {
            $("#inpt_pyd_ptdh_fe3").css('display', 'block');
        } else {
            $("#inpt_pyd_ptdh_fe3").css('display', 'none');
        }
    });

    $('#status_pyd_imsi1').change(function() {
        if (this.checked) {
            $("#inpt_pyd_imsi1").css('display', 'block');
        } else {
            $("#inpt_pyd_imsi1").css('display', 'none');
        }
    });

    $('#status_pyd_imsi2').change(function() {
        if (this.checked) {
            $("#inpt_pyd_imsi2").css('display', 'block');
        } else {
            $("#inpt_pyd_imsi2").css('display', 'none');
        }
    });

    $('#status_lahir_tanggal').change(function() {
        if (this.checked) {
            $("#inpt_lahir_tanggal").css('display', 'block');
        } else {
            $("#inpt_lahir_tanggal").css('display', 'none');
        }
    });

    $('#status_pyd_kapsul_yodium').change(function() {
        if (this.checked) {
            $("#inpt_pyd_kapsul_yodium").css('display', 'block');
        } else {
            $("#inpt_pyd_kapsul_yodium").css('display', 'none');
        }
    });

    $('#status_bayi_meninggal').change(function() {
        if (this.checked) {
            $("#inpt_bayi_meninggal").css('display', 'block');
        } else {
            $("#inpt_bayi_meninggal").css('display', 'none');
        }
    });

    $('#status_ibu_meninggal').change(function() {
        if (this.checked) {
            $("#inpt_ibu_meninggal").css('display', 'block');
        } else {
            $("#inpt_ibu_meninggal").css('display', 'none');
        }
    });

    $('#bumlin-tab1').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#bumlin-tab2').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#bumlin-tab3').click(function(){
        $('#submit-state').css('display', 'block');
    });
    $('#bumlin-tab4').click(function(){
        $('#submit-state').css('display', 'block');
    });

    $('.nexttab').click(function(){
        $('.nav-pills > .nav-item > .active').parent().next().find("a").trigger('click');
    });
    $('.prevtab').click(function(){
        $('.nav-pills > .nav-item > .active').parent().prev().find("a").trigger('click');
    });

    function is_kunjungan(idx)
    {
        if ($("#kunjungan_bumlin"+idx).is(":checked")) {
            $("#kunjungan_val"+idx).val("1");
        }else{
            $("#kunjungan_val"+idx).val("0");
        }
        
    }
    
    function is_risk(idx)
    {
        if ($("#pmk_bumlin_risk"+idx).is(":checked")) {
            $("#pmk_bumlin_risk_val"+idx).val("1");
        }else{
            $("#pmk_bumlin_risk_val"+idx).val("0");
        }
        
    }

    function save()
    {
        var validation = _validation();
        
        if (validation == false) {
            swal('Perhatian', 'Isi form dengan lengkap!', 'warning');
            $('#bumlin-tab2').trigger('click')
            return
        }
        
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled',true);

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?= base_url('bumlin/action_process_services')?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                console.log(data)
                if(data.status_save)
                {
                    swal('Berhasil', 'Data Bumil Dan Bulin berhasil disimpan!', 'success');
                }else{
                    swal('Gagal', 'Data Bumil Dan Bulin gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data Bumil Dan Bulin gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
        
    }

    function _validation() {
        var status = true;

        if ($('#status_pyd_ptdh_fe1').is(':checked')) {
            if ($("#pyd_ptdh_fe1").val() == "") {
                status = false;
                $("#pyd_ptdh_fe1").addClass('is-invalid');
                $("#pyd_ptdh_fe1_inv").text('Tanggal pemberian FE1 masih kosong');
            }else{
                $("#pyd_ptdh_fe1").removeClass('is-invalid');
                $("#pyd_ptdh_fe1_inv").text('');
            }
        }

        if ($('#status_pyd_ptdh_fe2').is(':checked')) {
            if ($("#pyd_ptdh_fe2").val() == "") {
                status = false;
                $("#pyd_ptdh_fe2").addClass('is-invalid');
                $("#pyd_ptdh_fe2_inv").text('Tanggal pemberian FE2 masih kosong');
            }else{
                $("#pyd_ptdh_fe2").removeClass('is-invalid');
                $("#pyd_ptdh_fe2_inv").text('');
            }
        }

        if ($('#status_pyd_ptdh_fe3').is(':checked')) {
            if ($("#pyd_ptdh_fe3").val() == "") {
                status = false;
                $("#pyd_ptdh_fe3").addClass('is-invalid');
                $("#pyd_ptdh_fe3_inv").text('Tanggal pemberian FE3 masih kosong');
            }else{
                $("#pyd_ptdh_fe3").removeClass('is-invalid');
                $("#pyd_ptdh_fe3_inv").text('');
            }
        }

        if ($('#status_pyd_imsi1').is(':checked')) {
            if ($("#pyd_imsi1").val() == "") {
                status = false;
                $("#pyd_imsi1").addClass('is-invalid');
                $("#pyd_imsi1_inv").text('Tanggal imunisasi TT 1 masih kosong');
            }else{
                $("#pyd_imsi1").removeClass('is-invalid');
                $("#pyd_imsi1_inv").text('');
            }
        }

        if ($('#status_pyd_imsi2').is(':checked')) {
            if ($("#pyd_imsi2").val() == "") {
                status = false;
                $("#pyd_imsi2").addClass('is-invalid');
                $("#pyd_imsi2_inv").text('Tanggal imunisasi TT 2 masih kosong');
            }else{
                $("#pyd_imsi2").removeClass('is-invalid');
                $("#pyd_imsi2_inv").text('');
            }
        }

        if ($('#status_lahir_tanggal').is(':checked')) {
            if ($("#pyd_lahir_tanggal").val() == "") {
                status = false;
                $("#pyd_lahir_tanggal").addClass('is-invalid');
                $("#pyd_lahir_tanggal_inv").text('Tanggal Lahir Bayi masih kosong');
            }else{
                $("#pyd_lahir_tanggal").removeClass('is-invalid');
                $("#pyd_lahir_tanggal_inv").text('');
            }
        }

        if ($('#status_pyd_kapsul_yodium').is(':checked')) {
            if ($("#pyd_kapsul_yodium").val() == "") {
                status = false;
                $("#pyd_kapsul_yodium").addClass('is-invalid');
                $("#pyd_kapsul_yodium_inv").text('Tanggal pemberian kapsul yodium masih kosong');
            }else{
                $("#pyd_kapsul_yodium").removeClass('is-invalid');
                $("#pyd_kapsul_yodium_inv").text('');
            }
        }

        if ($('#status_bayi_meninggal').is(':checked')) {
            if ($("#bayi_meninggal").val() == "") {
                status = false;
                $("#bayi_meninggal").addClass('is-invalid');
                $("#bayi_meninggal_inv").text('Tanggal bayi meninggal masih kosong');
            }else{
                $("#bayi_meninggal").removeClass('is-invalid');
                $("#bayi_meninggal_inv").text('');
            }
        }

        if ($('#status_ibu_meninggal').is(':checked')) {
            if ($("#ibu_meninggal").val() == "") {
                status = false;
                $("#ibu_meninggal").addClass('is-invalid');
                $("#ibu_meninggal_inv").text('Tanggal ibu meninggal masih kosong');
            }else{
                $("#ibu_meninggal").removeClass('is-invalid');
                $("#ibu_meninggal_inv").text('');
            }
        }

        if ($("#pos_id").val() == "") {
            status = false;
            $("#pos_id").addClass('is-invalid');
            $("#pos_id_inv").text('Posyandu masih belum dipilih');
        }

        return status
    }

    $("#inpt_pyd_ptdh_fe1").keyup(function(){
        if ($("#inpt_pyd_ptdh_fe1").val() != "") {
            $("#inpt_pyd_ptdh_fe1").removeClass('is-invalid');
            $("#inpt_pyd_ptdh_fe1_inv").text('');
        }
    });

    $("#inpt_pyd_ptdh_fe2").keyup(function(){
        if ($("#inpt_pyd_ptdh_fe2").val() != "") {
            $("#inpt_pyd_ptdh_fe2").removeClass('is-invalid');
            $("#inpt_pyd_ptdh_fe2_inv").text('');
        }
    });

    $("#inpt_pyd_ptdh_fe3").keyup(function(){
        if ($("#inpt_pyd_ptdh_fe3").val() != "") {
            $("#inpt_pyd_ptdh_fe3").removeClass('is-invalid');
            $("#inpt_pyd_ptdh_fe3_inv").text('');
        }
    });

    $("#pyd_imsi1").keyup(function(){
        if ($("#pyd_imsi1").val() != "") {
            $("#pyd_imsi1").removeClass('is-invalid');
            $("#pyd_imsi1_inv").text('');
        }
    });

    $("#pyd_imsi2").change(function(){
        if ($("#pyd_imsi2").val() != "") {
            $("#pyd_imsi2").removeClass('is-invalid');
            $("#pyd_imsi2_inv").text('');
        }
    });

    $("#inpt_lahir_tanggal").change(function(){
        if ($("#inpt_lahir_tanggal").val() != "") {
            $("#inpt_lahir_tanggal").removeClass('is-invalid');
            $("#inpt_lahir_tanggal_inv").text('');
        }
    });

    $("#inpt_pyd_kapsul_yodium").change(function(){
        if ($("#inpt_pyd_kapsul_yodium").val() != "") {
            $("#inpt_pyd_kapsul_yodium").removeClass('is-invalid');
            $("#inpt_pyd_kapsul_yodium_inv").text('');
        }
    });

    $("#inpt_bayi_meninggal").keyup(function(){
        if ($("#inpt_bayi_meninggal").val() != "") {
            $("#inpt_bayi_meninggal").removeClass('is-invalid');
            $("#inpt_bayi_meninggal_inv").text('');
        }
    });

    $("#inpt_ibu_meninggal").keyup(function(){
        if ($("#inpt_ibu_meninggal").val() != "") {
            $("#inpt_ibu_meninggal").removeClass('is-invalid');
            $("#inpt_ibu_meninggal_inv").text('');
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