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
                                <input type="hidden" name="keterangan" id="keterangan" value="<?= $keterangan; ?>">
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

                            </div>
                            <div class="col-md-6">
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
                                    <label>Tanggal Daftar (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_daftar" id="tgl_daftar" class="form-control datepicker" value="<?= $tgl_daftar; ?>" required>
                                    <div class="invalid-feedback" id="tgl_daftar_inv"></div>
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
                            text: 'Nomor KMS "'+ kms +'" sudah terdaftar di data Bayi!, Apakah anda yakin akan mendaftarkan data ini kembali?',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        }).then((ok) => {
                            if (ok) {
                                $("#kms").focus();
                            }else{
                                $("#kms").val("");
                                $("#kms").focus();
                                $("#kms").addClass('is-invalid');
                                $("#kms_inv").text('Nomor KMS sudah terdaftar di data Bayi');
                            }
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

    $('#status_meninggal_bayi').change(function() {
        if (this.checked) {
            $("#inpt_tgl_meninggal_bayi").css('display', 'block');
        } else {
            $("#inpt_tgl_meninggal_bayi").css('display', 'none');
        }
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

        if ($("#tgl_daftar").val() == "") {
            status = false;
            $("#tgl_daftar").addClass('is-invalid');
            $("#tgl_daftar_inv").text('Tanggal Daftar masih kosong');
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

    $("#tgl_daftar").keyup(function(){
        if ($("#tgl_daftar").val() != "") {
            $("#tgl_daftar").removeClass('is-invalid');
            $("#tgl_daftar_inv").text('');
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