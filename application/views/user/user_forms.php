<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1><?= $pages_caption; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Pengguna</a></div>
        <div class="breadcrumb-item"><?= $aksi; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('users'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" autocomplete="off" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input type="text" name="nama_user" id="nama_user" class="form-control " placeholder="Isi nama..." value="<?= $nama_user; ?>" required>
                            <div class="invalid-feedback" id="nama_user_inv"></div>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control " placeholder="Isi username..." value="<?= $username; ?>" required>
                            <div class="invalid-feedback" id="username_inv"></div>
                        </div>
                        <div class="form-group">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" autocomplete="false" name="email" id="email" class="form-control " placeholder="Isi email..." <?= ( $aksi == 'Ubah' ? 'readonly' : '' ); ?> value="<?= $email; ?>" required>
                            <div class="invalid-feedback" id="email_inv"></div>
                        </div>
                        <div class="form-group" id="switch-pass-input" style="display: none;">
                            <div class="control-label">Ubah Password</div>
                            <label class="custom-switch mt-2">
                                <input type="checkbox" name="edit_pass" id="edit_pass" class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description"><i>*Password akan diganti dengan yang baru</i></span>
                            </label>
                        </div>
                        <div id="pass-input" style="display: none;">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control " placeholder="Isi password baru..." value="<?= $password; ?>" required>
                                <div class="invalid-feedback" id="password_inv"></div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password <span class="text-danger">*</span></label>
                                <input type="password" name="password_confirm" id="password_confirm" class="form-control " placeholder="Isi ulang password..." value="<?= $password; ?>" required>
                                <div class="invalid-feedback" id="password_confirm_inv"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Posisi Role Akun Pengguna <span class="text-danger">*</span></label>
                            <div class="form-group">
                                    <div class=" pl-0 pr-0">
                                        <select name="role_id" id="role_id" class="form-control select2">
                                            <option value="">-Pilih Role-</option>
                                            <?php if (!empty($data_role)) {
                                                    foreach ($data_role as $rol) {
                                                        echo '<option value="'.$rol->id.'" '.( $role_id == $rol->id ? "selected" : "" ).' >'.$rol->name.'</option>';
                                                    }
                                                } ?>
                                        </select>
                                        <div class="invalid-feedback" id="role_id_inv"></div>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group" id='input_pos' style="display: none;">
                            <label>Posisi Posyandu Akun Pengguna <span class="text-danger">*</span></label>
                            <div class="form-group">
                                    <div class=" pl-0 pr-0">
                                        <select name="pos_id" id="pos_id" class="form-control select2">
                                            <option value="">-Pilih Posyandu-</option>
                                            <?php if (!empty($data_pos)) {
                                                    foreach ($data_pos as $pos) {
                                                        echo '<option value="'.$pos->id.'" '.( $pos_id == $pos->id ? "selected" : "" ).' >'.$pos->nama.'</option>';
                                                    }
                                                } ?>
                                        </select>
                                        <div class="invalid-feedback" id="pos_id_inv"></div>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="control-label">Status</div>
                            <label class="custom-switch mt-2">
                            <input type="checkbox" name="status_user" <?= ( $status_user == 1 ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                            <span class="custom-switch-indicator"></span>
                            <span class="custom-switch-description">Non Aktif / Aktif</span>
                            </label>
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
</div>
<script type="text/javascript">

    var base_url = '<?= base_url(); ?>';
    var save_method = '<?= $aksi; ?>';

    // Select2
    $(document).ready(function() {
        $(".select2").select2();
        // pass-input
        if (save_method == 'Ubah') {
            $("#pass-input").css('display', 'none');
            $("#switch-pass-input").css('display', 'block');
        }else{
            $("#pass-input").css('display', 'block');
            $("#switch-pass-input").css('display', 'none');
        }

        if ($("#role_id").val() != 'eccdbd9e-4c84-11ec-802e-089798e691ce' && $("#role_id").val() != 'f104827c-4c84-11ec-802e-089798e691ce') {
            $("#input_pos").css('display', 'block');
            $("#input_pos").prop('required', true);
            if ($("#role_id").val() == "") {
                $("#input_pos").css('display', 'none');
                $("#input_pos").prop('required', false);
            }
        }else{
            $("#input_pos").css('display', 'none');
            $("#input_pos").prop('required', false);
        }

    });

    $('#username').change(function() {
        if (save_method == 'Tambah') {
            if (this.value != "") {
                cek_username(this.value);
            }
        }
    });

    $('#email').change(function() {
        if (save_method == 'Tambah') {
            if (this.value != "") {
                cek_email(this.value);
            }
        }
    });

    function cek_username(username)
    {
        $.ajax({
            url : "<?= base_url('users/cek_data_username_json')?>/" + username,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                if (readData == null) {
                    // some true condition
                }else{
                    swal({
                            title: 'Cek data Username',
                            text: 'Username "'+ username +'" sudah terdaftar di data user!',
                            icon: 'warning',
                            dangerMode: true,
                        }).then((ok) => {
                            $("#username").val("");
                            $("#username").focus();
                            $("#username").addClass('is-invalid');
                            $("#username_inv").text('Username sudah terdaftar di data user');
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mencari Username!', 'error');
                $("#username").focus();
            }
        });
    }

    function cek_email(email)
    {
        $.ajax({
            url : "<?= base_url('users/cek_data_email_json')?>",
            type: "POST",
            data: {
                email,
            },
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                if (readData == null) {
                    // some true condition
                }else{
                    swal({
                            title: 'Cek data Email',
                            text: 'Email "'+ email +'" sudah terdaftar di data user!',
                            icon: 'warning',
                            dangerMode: true,
                        }).then((ok) => {
                            $("#email").val("");
                            $("#email").focus();
                            $("#email").addClass('is-invalid');
                            $("#email_inv").text('Email sudah terdaftar di data user');
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mencari Email!', 'error');
                $("#email").focus();
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
            url : "<?= base_url('users/action_process')?>",
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
                    swal('Berhasil', 'Data pengguna berhasil disimpan!', 'success').then((data) => {
                        document.location = "<?php echo base_url('users')?>";
                    });
                }else{
                    swal('Gagal', 'Data pengguna gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data pengguna gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
        
    }

    $('#edit_pass').change(function() {
        if (this.checked) {
            $("#pass-input").css('display', 'block');
        } else {
            $("#pass-input").css('display', 'none');
        }
    });

    $("#role_id").change(function(){
        var role_selected = $("#role_id").val();
        // console.log(role_selected)
        if (role_selected != 'eccdbd9e-4c84-11ec-802e-089798e691ce' && role_selected != 'f104827c-4c84-11ec-802e-089798e691ce') {
            $("#input_pos").css('display', 'block');
            $("#input_pos").prop('required', true);
            if (role_selected == "") {
                $("#input_pos").css('display', 'none');
                $("#input_pos").prop('required', false);
            }
        }else{
            $("#input_pos").css('display', 'none');
            $("#input_pos").prop('required', false);
        }
    });

    function validateEmail(email) 
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function countWords(str) {
        var matches = str.match(/[\w\d\’\'-]+/gi);
        return matches ? matches.length : 0;
    }

    function _validation() {
        var status = true;

        if ($("#nama_user").val() == "") {
            status = false;
            $("#nama_user").addClass('is-invalid');
            $("#nama_user_inv").text('Nama masih kosong');
        }

        if ($("#username").val() == "") {
            status = false;
            $("#username").addClass('is-invalid');
            $("#username_inv").text('Username masih kosong');
        }

        if ($("#email").val() == "") {
            status = false;
            $("#email").addClass('is-invalid');
            $("#email_inv").text('Email masih kosong');
        }

        if (validateEmail($("#email").val()) == false) {
            status = false;
            $("#email").addClass('is-invalid');
            $("#email_inv").text('Email tidak sesuai');
        }

        // pass validation
        if ((save_method == 'Ubah' && $("#edit_pass").prop("checked") == true) || (save_method == 'Tambah')) {
            if ($("#password").val() == "") {
                status = false;
                $("#password").addClass('is-invalid');
                $("#password_inv").text('Password masih kosong');
            }

            if ($("#password_confirm").val() == "") {
                status = false;
                $("#password_confirm").addClass('is-invalid');
                $("#password_confirm_inv").text('Konfirmasi password masih kosong');
            }
            
            if ($("#password_confirm").val() != $("#password").val()) {
                status = false;
                $("#password").addClass('is-invalid');
                $("#password_inv").text('Password masih tidak sama');
                $("#password_confirm").addClass('is-invalid');
                $("#password_confirm_inv").text('Konfirmasi password masih tidak sama');
            }

            var inpt_pass = $("#password").val();
            if (inpt_pass.length < 4) {
                status = false;
                $("#password").addClass('is-invalid');
                $("#password_inv").text('Password terlalu pendek');
            }
        }

        if ($("#role_id").val() == "") {
            status = false;
            $("#role_id").addClass('is-invalid');
            $("#role_id_inv").text('Role masih belum dipilih');
        }

        if ($("#role_id").val() != 'eccdbd9e-4c84-11ec-802e-089798e691ce' && $("#role_id").val() != 'f104827c-4c84-11ec-802e-089798e691ce') {
            if ($("#pos_id").val() == "") {
                status = false;
                $("#pos_id").addClass('is-invalid');
                $("#pos_id_inv").text('Posyandu masih belum dipilih');
            }
        }

        return status
    }

    $("#nama_user").keyup(function(){
        if ($("#nama_user").val() != "") {
            $("#nama_user").removeClass('is-invalid');
            $("#nama_user_inv").text('');
        }
    });

    $("#username").keyup(function(){
        if ($("#username").val() != "") {
            $("#username").removeClass('is-invalid');
            $("#username_inv").text('');
        }
    });

    $("#email").keyup(function(){
        if ($("#email").val() != "") {
            $("#email").removeClass('is-invalid');
            $("#email_inv").text('');
        }
    });

    $("#email").change(function(){
        if (validateEmail($("#email").val()) == false) {
            $("#email").addClass('is-invalid');
            $("#email_inv").text('Email tidak sesuai');
        }else{
            $("#email").removeClass('is-invalid');
            $("#email_inv").text('');
        }
    });

    $("#password").keyup(function(){
        if ($("#password").val() != "") {
            $("#password").removeClass('is-invalid');
            $("#password_inv").text('');
        }
    });

    $("#password_confirm").keyup(function(){
        if ($("#password_confirm").val() != "") {
            $("#password_confirm").removeClass('is-invalid');
            $("#password_confirm_inv").text('');
        }
    });

    $("#password").change(function(){
        var inpt_pass = $("#password").val();
        if (inpt_pass.length < 4) {
            $("#password").addClass('is-invalid');
            $("#password_inv").text('Password terlalu pendek');
        }
    });

    $("#password_confirm").change(function(){
        if ($("#password_confirm").val() != $("#password").val()) {
            $("#password").addClass('is-invalid');
            $("#password_inv").text('Password masih tidak sama');
            $("#password_confirm").addClass('is-invalid');
            $("#password_confirm_inv").text('Konfirmasi password masih tidak sama');
        }
    });

    $("#role_id").change(function(){
        if ($("#role_id").val() != "") {
            $("#role_id").removeClass('is-invalid');
            $("#role_id_inv").text('');
        }
    });

    $("#pos_id").change(function(){
        if ($("#pos_id").val() != "") {
            $("#pos_id").removeClass('is-invalid');
            $("#pos_id_inv").text('');
        }
    });

    
    


</script>