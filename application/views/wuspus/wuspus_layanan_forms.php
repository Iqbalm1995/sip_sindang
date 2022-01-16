<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Layanan Posyandu Wus Pus Tahun <?= $year_assign; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Wus Pus</a></div>
        <div class="breadcrumb-item"><a href="#">Wus Pus</a></div>
        <div class="breadcrumb-item">Update Layanan <?= $year_assign; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('wuspus/layanan'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills pt-3" id="myTab3" role="tablist">
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link active" id="wuspus-tab1" data-toggle="tab" href="#wuspus1" role="tab" aria-controls="wuspus" aria-selected="true">Data Wus Pus</a>
                            </li>
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link" id="wuspus-tab2" data-toggle="tab" href="#wuspus2" role="tab" aria-controls="pelayanan" aria-selected="false">Layanan</a>
                            </li>
                            <li class="nav-item tombolfull">
                                <a class="nav-link" id="wuspus-tab3" data-toggle="tab" href="#wuspus3" role="tab" aria-controls="kunjungan" aria-selected="false">Kunjungan</a>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="wuspus1" role="tabpanel" aria-labelledby="wuspus-tab1">
                                <!-- Input data Wus Pus -->
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                                            <div class="form-group" id='input_pos'>
                                                <div class="form-group">
                                                    <label>Posisi Posyandu Wus Pus <span class="text-danger">*</span></label>
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
                                            <label>Nama <span class="text-danger">*</span></label>
                                            <input type="text" name="nama" id="nama" class="form-control " placeholder="Isi nama..." value="<?= $nama; ?>" disabled>
                                            <div class="invalid-feedback" id="nama_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Umur <span class="text-danger">*</span></label>
                                            <input type="number" name="umur" id="umur" class="form-control " placeholder="Isi umur..." value="<?= $umur; ?>" disabled>
                                            <div class="invalid-feedback" id="umur_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Suami Pus</label>
                                            <input type="text" name="suami_pus" id="suami_pus" class="form-control " placeholder="-" value="<?= $suami_pus; ?>" disabled>
                                            <div class="invalid-feedback" id="suami_pus_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Taha HK KS</label>
                                            <input type="text" name="taha_kan_ks" id="taha_kan_ks" class="form-control " placeholder="-" value="<?= $taha_kan_ks; ?>" disabled>
                                            <div class="invalid-feedback" id="taha_kan_ks_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Kel Dawis</label>
                                            <input type="number" name="kel_dawis" id="kel_dawis" class="form-control " placeholder="-" maxlength='3' value="<?= $kel_dawis; ?>" disabled>
                                            <div class="invalid-feedback" id="kel_dawis_inv"></div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="wuspus2" role="tabpanel" aria-labelledby="wuspus-tab2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah Anak Hidup</label>
                                            <input type="number" name="jml_anak_hidup" id="jml_anak_hidup" class="form-control " maxlength='2' placeholder="0" value="<?= $jml_anak_hidup; ?>" >
                                            <div class="invalid-feedback" id="jml_anak_hidup_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Anak Meninggal</label>
                                            <input type="number" name="jml_anak_meninggal" id="jml_anak_meninggal" class="form-control " maxlength='2' placeholder="0" value="<?= $jml_anak_meninggal; ?>" >
                                            <div class="invalid-feedback" id="jml_anak_meninggal_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Umur Anak Meninggal</label>
                                            <input type="number" name="umur_anak_meninggal" id="umur_anak_meninggal" class="form-control " maxlength='2' placeholder="0" value="<?= $umur_anak_meninggal; ?>" >
                                            <div class="invalid-feedback" id="umur_anak_meninggal_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Lila</label>
                                            <input type="text" name="lila" id="lila" class="form-control " placeholder="Isi Lila..." value="<?= $lila; ?>">
                                            <div class="invalid-feedback" id="lila_inv"></div>
                                        </div>
                                    
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="control-label">Imunisasi TT 1</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_pyd_imsi1" id="status_pyd_imsi1" <?= ( !empty($pyd_imsi1) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <div class="form-group" style="display: none;" id="inpt_pyd_imsi1">
                                            <label>Tanggal Imunisasi TT 1 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="pyd_imsi1" id="pyd_imsi1" class="form-control datepicker" value="<?= $pyd_imsi1; ?>">
                                            <div class="invalid-feedback" id="pyd_imsi1_inv"></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="control-label">Imunisasi TT 2</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_pyd_imsi2" id="status_pyd_imsi2" <?= ( !empty($pyd_imsi2) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <div class="form-group" style="display: none;" id="inpt_pyd_imsi2">
                                            <label>Tanggal Imunisasi TT 2 (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="pyd_imsi2" id="pyd_imsi2" class="form-control datepicker" value="<?= $pyd_imsi2; ?>">
                                            <div class="invalid-feedback" id="pyd_imsi2_inv"></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="control-label">Imunisasi TT Lengkap</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_pyd_imsi_lengkap" id="status_pyd_imsi_lengkap" <?= ( !empty($pyd_imsi_lengkap) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <div class="form-group" style="display: none;" id="inpt_pyd_imsi_lengkap">
                                            <label>Tanggal Imunisasi TT Lengkap (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="pyd_imsi_lengkap" id="pyd_imsi_lengkap" class="form-control datepicker" value="<?= $pyd_imsi_lengkap; ?>">
                                            <div class="invalid-feedback" id="pyd_imsi_lengkap_inv"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Jenis Kontrasepsi</label>
                                            <input type="text" name="kb_kontrasepsi" id="kb_kontrasepsi" class="form-control " placeholder="Isi Jenis Kontrasepsi..." value="<?= $kb_kontrasepsi; ?>">
                                            <div class="invalid-feedback" id="kb_kontrasepsi_inv"></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="control-label">Pemberian Kontrasepsi</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_kb_pgn_tgl" id="status_kb_pgn_tgl" <?= ( !empty($kb_pgn_tgl) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <div class="form-group" style="display: none;" id="inpt_kb_pgn_tgl">
                                            <label>Tanggal Pemberian Kontrasepsi (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="kb_pgn_tgl" id="kb_pgn_tgl" class="form-control datepicker" value="<?= $kb_pgn_tgl; ?>">
                                            <div class="invalid-feedback" id="kb_pgn_tgl_inv"></div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Penggantain Jenis Kontrasepsi</label>
                                            <input type="text" name="kb_pgn_jenis" id="kb_pgn_jenis" class="form-control " placeholder="Isi Jenis Kontrasepsi..." value="<?= $kb_pgn_jenis; ?>">
                                            <div class="invalid-feedback" id="kb_pgn_jenis_inv"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="wuspus3" role="tabpanel" aria-labelledby="wuspus-tab3">
                                
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                <h5>Data Kunjungan Wus Pus tahun <?= $year_assign; ?>.</h5>
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
                                                                        <input type="hidden" name="kunjungan_wuspus_bln[]" id="kunjungan_wuspus_bln<?= $arrayNum; ?>" value="<?= $value->bulan; ?>">
                                                                        <input type="hidden" name="kunjungan_wuspus_thn[]" id="kunjungan_wuspus_thn<?= $arrayNum; ?>" value="<?= $value->tahun; ?>">
                                                                        <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_wuspus[]" id="kunjungan_wuspus<?= $arrayNum; ?>" <?= ( $value->is_kunjungan == 1 ? 'checked="true"' : '' ) ?>  onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" class="custom-switch-input">
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
                                                                        <input type="hidden" name="kunjungan_wuspus_bln[]" id="kunjungan_wuspus_bln<?= $arrayNum; ?>" value="<?= $key; ?>">
                                                                        <input type="hidden" name="kunjungan_wuspus_thn[]" id="kunjungan_wuspus_thn<?= $arrayNum; ?>" value="<?= $year_assign; ?>">
                                                                        <th scope="row"><?= $value; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_wuspus[]" id="kunjungan_wuspus<?= $arrayNum; ?>" class="custom-switch-input" onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" >
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

        if ($('#status_pyd_kapsul_yodium').is(':checked')) {
            $("#inpt_pyd_kapsul_yodium").css('display', 'block');
        }else{
            $("#inpt_pyd_kapsul_yodium").css('display', 'none');
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

        if ($('#status_pyd_imsi_lengkap').is(':checked')) {
            $("#inpt_pyd_imsi_lengkap").css('display', 'block');
        }else{
            $("#inpt_pyd_imsi_lengkap").css('display', 'none');
        }

        if ($('#status_kb_pgn_tgl').is(':checked')) {
            $("#inpt_kb_pgn_tgl").css('display', 'block');
        }else{
            $("#inpt_kb_pgn_tgl").css('display', 'none');
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

    $('#status_pyd_kapsul_yodium').change(function() {
        if (this.checked) {
            $("#inpt_pyd_kapsul_yodium").css('display', 'block');
        } else {
            $("#inpt_pyd_kapsul_yodium").css('display', 'none');
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

    $('#status_pyd_imsi_lengkap').change(function() {
        if (this.checked) {
            $("#inpt_pyd_imsi_lengkap").css('display', 'block');
        } else {
            $("#inpt_pyd_imsi_lengkap").css('display', 'none');
        }
    });

    $('#status_kb_pgn_tgl').change(function() {
        if (this.checked) {
            $("#inpt_kb_pgn_tgl").css('display', 'block');
        } else {
            $("#inpt_kb_pgn_tgl").css('display', 'none');
        }
    });

    $('#wuspus-tab1').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#wuspus-tab2').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#wuspus-tab3').click(function(){
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
        if ($("#kunjungan_wuspus"+idx).is(":checked")) {
            $("#kunjungan_val"+idx).val("1");
        }else{
            $("#kunjungan_val"+idx).val("0");
        }
        
    }

    function save()
    {
        var validation = _validation();
        
        if (validation == false) {
            swal('Perhatian', 'Isi form dengan lengkap!', 'warning');
            $('#wuspus-tab2').trigger('click')
            return
        }
        
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled',true);

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?= base_url('wuspus/action_process_services')?>",
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
                    swal('Berhasil', 'Data Wus Pus berhasil disimpan!', 'success');
                }else{
                    swal('Gagal', 'Data Wus Pus gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data Wus Pus gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
        
    }

    function _validation() {
        var status = true;

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

        if ($('#status_pyd_imsi_lengkap').is(':checked')) {
            if ($("#pyd_imsi_lengkap").val() == "") {
                status = false;
                $("#pyd_imsi_lengkap").addClass('is-invalid');
                $("#pyd_imsi_lengkap_inv").text('Tanggal imunisasi TT Lengkap masih kosong');
            }else{
                $("#pyd_imsi_lengkap").removeClass('is-invalid');
                $("#pyd_imsi_lengkap_inv").text('');
            }
        }

        if ($('#status_kb_pgn_tgl').is(':checked')) {
            if ($("#kb_pgn_tgl").val() == "") {
                status = false;
                $("#kb_pgn_tgl").addClass('is-invalid');
                $("#kb_pgn_tgl_inv").text('Tanggal penggantaian tgl imunisasi masih kosong');
            }else{
                $("#kb_pgn_tgl").removeClass('is-invalid');
                $("#kb_pgn_tgl_inv").text('');
            }
        }

        if ($("#pos_id").val() == "") {
            status = false;
            $("#pos_id").addClass('is-invalid');
            $("#pos_id_inv").text('Posyandu masih belum dipilih');
        }

        return status
    }

    $("#pyd_kapsul_yodium").keyup(function(){
        if ($("#pyd_kapsul_yodium").val() != "") {
            $("#pyd_kapsul_yodium").removeClass('is-invalid');
            $("#pyd_kapsul_yodium_inv").text('');
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

    $("#pyd_imsi_lengkap").change(function(){
        if ($("#pyd_imsi_lengkap").val() != "") {
            $("#pyd_imsi_lengkap").removeClass('is-invalid');
            $("#pyd_imsi_lengkap_inv").text('');
        }
    });

    $("#kb_pgn_tgl").keyup(function(){
        if ($("#kb_pgn_tgl").val() != "") {
            $("#kb_pgn_tgl").removeClass('is-invalid');
            $("#kb_pgn_tgl_inv").text('');
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