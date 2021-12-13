<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Balita</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item"><a href="#">Balita</a></div>
        <div class="breadcrumb-item"><?= $aksi; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('balita'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="<?= $acton_form; ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Input data balita -->
                        <div class="row">
                            <div class="col-md-6">
                                
                                <?php if (empty($this->session->userdata('pos_id'))) { ?>
                                    <div class="form-group" id='input_pos'>
                                        <label>Posisi Posyandu Anak <span class="text-danger">*</span></label>
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
                                    <label>Nama Anak <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_anak" id="nama_anak" class="form-control " placeholder="Isi nama anak..." value="<?= $nama_anak; ?>" required>
                                    <div class="invalid-feedback" id="nama_anak_inv"></div>
                                </div>
                                <div class="form-group">
                                <label>Tanggal Lahir Anak (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                    <input type="text" name="tgl_lahir_anak" id="tgl_lahir_anak" class="form-control datepicker" value="<?= $tgl_lahir_anak; ?>">
                                    <div class="invalid-feedback" id="tgl_lahir_anak_inv"></div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin Anak (L/P) <span class="text-danger">*</span></label>
                                    <div class="pl-3 pt-2 pb-2 row">
                                        <div class="custom-control custom-radio col-md-3 col-sm-12">
                                            <input type="radio" id="jkL" name="jk_anak" class="custom-control-input" value="L" <?= ( $jk_anak == "L" ? "checked" : "" ) ?>>
                                            <label class="custom-control-label" for="jkL">Laki-laki</label>
                                        </div>
                                        <div class="custom-control custom-radio col-md-3 col-sm-12">
                                            <input type="radio" id="jkP" name="jk_anak" class="custom-control-input" value="P" <?= ( $jk_anak == "P" ? "checked" : "" ) ?>>
                                            <label class="custom-control-label" for="jkP">Perempuan</label>
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
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" class="form-control" style="height: 100px;" placeholder="Isi Keterangan (Opsional)..."><?= ( !empty($keterangan) ? $keterangan : '' ); ?></textarea>
                                    <div class="invalid-feedback" id="keterangan_inv"></div>
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
            url : "<?= base_url('balita/cek_data_balita_json')?>/" + kms,
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
                            text: 'Nomor KMS "'+ kms +'" sudah terdaftar di data balita!',
                            icon: 'warning',
                            dangerMode: true,
                        }).then((ok) => {
                            $("#kms").val("");
                            $("#kms").focus();
                            $("#kms").addClass('is-invalid');
                            $("#kms_inv").text('Nomor KMS sudah terdaftar di data balita');
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
            url : "<?= base_url('balita/action_process')?>",
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
                    swal('Berhasil', 'Data balita berhasil disimpan!', 'success').then((data) => {
                        document.location = "<?php echo base_url('balita')?>";
                    });
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

        if ($("#nama_anak").val() == "") {
            status = false;
            $("#nama_anak").addClass('is-invalid');
            $("#nama_anak_inv").text('Nama balita masih kosong');
        }

        if ($("#tgl_lahir_anak").val() == "") {
            status = false;
            $("#tgl_lahir_anak").addClass('is-invalid');
            $("#tgl_lahir_anak_inv").text('Tanggal lahir balita masih kosong');
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

    $("#nama_anak").keyup(function(){
        if ($("#nama_anak").val() != "") {
            $("#nama_anak").removeClass('is-invalid');
            $("#nama_anak_inv").text('');
        }
    });

    $("#tgl_lahir_anak").keyup(function(){
        if ($("#tgl_lahir_anak").val() != "") {
            $("#tgl_lahir_anak").removeClass('is-invalid');
            $("#tgl_lahir_anak_inv").text('');
        }
    });

    $("#tgl_lahir_anak").change(function(){
        if ($("#tgl_lahir_anak").val() != "") {
            $("#tgl_lahir_anak").removeClass('is-invalid');
            $("#tgl_lahir_anak_inv").text('');
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