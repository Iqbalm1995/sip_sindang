<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Ibu Hamil</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item"><a href="#">Ibu Hamil</a></div>
        <div class="breadcrumb-item">Tambah</div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('bumil'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                            <div class="form-group" id='input_pos'>
                                <label>Posisi Posyandu Bumil <span class="text-danger">*</span></label>
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
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input type="text" name="nik" id="nik" class="form-control " maxlength="20" placeholder="Isi nik..." value="<?= $nik; ?>" <?= ( $aksi == 'Ubah' ? 'readonly' : '' ); ?> onkeypress='numberOnly(event)'>
                            <div class="invalid-feedback" id="nik_inv"></div>
                            <div class="valid-feedback" id="nik_valid"></div>
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
                            <select name="jk_bayi" id="jk_bayi" class="form-control">
                                <option value="">-Pilih Jenis Kelamin-</option>
                                <option value="L" <?= ( $jk_bayi == "L" ? "selected" : "" ) ?>>Laki-laki</option>
                                <option value="P" <?= ( $jk_bayi == "P" ? "selected" : "" ) ?>>Perempuan</option>
                            </select>
                            <div class="invalid-feedback" id="jk_bayi_inv"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                            <div class="control-label">Status Meninggal Ibu</div>
                            <label class="custom-switch mt-2">
                            <input type="checkbox" name="status_meninggal_ibu" id="status_meninggal_ibu" <?= ( !empty($tgl_meninggal_ibu) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                            <span class="custom-switch-indicator mt-3"></span>
                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                            </label>
                        </div>
                        <div class="form-group" style="display: none;" id="inpt_tgl_meninggal_ibu">
                            <label>Tanggal Meninggal Ibu (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                            <input type="text" name="tgl_meninggal_ibu" id="tgl_meninggal_ibu" class="form-control datepicker" value="<?= $tgl_meninggal_ibu; ?>">
                            <div class="invalid-feedback" id="tgl_meninggal_ibu_inv"></div>
                        </div>
                        <div class="form-group">
                        <label>Keterangan</label>
                            <textarea name="keterangan" id="keterangan" class="form-control" style="height: 150px;" placeholder="Isi Keterangan (Opsional)..."><?= ( !empty($keterangan) ? $keterangan : '' ); ?></textarea>
                            <div class="invalid-feedback" id="keterangan_inv"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-whitesmoke text-right">
                <button class="btn btn-light btn-lg tombolfull" type="reset">
                    <i class="fas fa-sync"></i> Reset</button>
                <button class="btn btn-primary btn-lg tombolfull" type="button" id="btnSave" onclick="save()">
                    <i class="far fa-save"></i> Simpan</button>
            </div>
        </form>
    </div>
    </div>
</section>
<script type="text/javascript">

    var base_url = '<?= base_url(); ?>';
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

        if ($('#status_meninggal_ibu').is(':checked')) {
            $("#inpt_tgl_meninggal_ibu").css('display', 'block');
        }else{
            $("#inpt_tgl_meninggal_ibu").css('display', 'none');
        }

    }); 

    $('#nik').change(function() {
        if (save_method == 'Tambah') {
            if (this.value != "") {
                cek_nik_bumil(this.value);
            }
        }
    });
    
    function cek_nik_bumil(nik)
    {
        $.ajax({
            url : "<?= base_url('bumil/cek_data_bumil_json')?>/" + nik,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                if (readData == null) {
                    // some true condition
                }else{
                    swal({
                            title: 'Cek data NIK',
                            text: 'NIK "'+ nik +'" sudah terdaftar di data ibu hamil!',
                            icon: 'warning',
                            dangerMode: true,
                        }).then((ok) => {
                            $("#nik").val("");
                            $("#nik").focus();
                            $("#nik").addClass('is-invalid');
                            $("#nik_inv").text('NIK sudah terdaftar di data ibu hamil');
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mencari nik!', 'error');
                $("#nik").focus();
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

    $('#status_meninggal_ibu').change(function() {
        if (this.checked) {
            $("#inpt_tgl_meninggal_ibu").css('display', 'block');
        } else {
            $("#inpt_tgl_meninggal_ibu").css('display', 'none');
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
            url : "<?= base_url('bumil/action_process')?>",
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
                    swal('Berhasil', 'Data bumil berhasil disimpan!', 'success').then((data) => {
                        document.location = "<?php echo base_url('bumil')?>";
                    });
                }else{
                    swal('Gagal', 'Data bumil gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data bumil gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
    }

    function _validation() {
        var status = true;

        if ($("#nik").val() == "") {
            status = false;
            $("#nik").addClass('is-invalid');
            $("#nik_inv").text('NIK masih kosong');
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

        if ($("#jk_bayi").val() == "") {
            status = false;
            $("#jk_bayi").addClass('is-invalid');
            $("#jk_bayi_inv").text('Jenis kelamin bayi masih belum dipilih');
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

        if ($('#status_meninggal_ibu').is(':checked')) {
            if ($("#tgl_meninggal_ibu").val() == "") {
                status = false;
                $("#tgl_meninggal_ibu").addClass('is-invalid');
                $("#tgl_meninggal_ibu_inv").text('Tanggal meninggal ibu masih kosong');
            }else{
                $("#tgl_meninggal_ibu").removeClass('is-invalid');
                $("#tgl_meninggal_ibu_inv").text('');
            }
        }

        return status
    }

    $("#nik").keyup(function(){
        if ($("#nik").val() != "") {
            $("#nik").removeClass('is-invalid');
            $("#nik_inv").text('');
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

    $("#jk_bayi").change(function(){
        if ($("#jk_bayi").val() != "") {
            $("#jk_bayi").removeClass('is-invalid');
            $("#jk_bayi_inv").text('');
        }
    });

    $("#tgl_meninggal_bayi").keyup(function(){
        if ($("#tgl_meninggal_bayi").val() != "") {
            $("#tgl_meninggal_bayi").removeClass('is-invalid');
            $("#tgl_meninggal_bayi_inv").text('');
        }
    });

    $("#tgl_meninggal_ibu").keyup(function(){
        if ($("#tgl_meninggal_ibu").val() != "") {
            $("#tgl_meninggal_ibu").removeClass('is-invalid');
            $("#tgl_meninggal_ibu_inv").text('');
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