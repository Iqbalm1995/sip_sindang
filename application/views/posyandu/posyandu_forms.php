<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1><?= $pages_caption; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item"><a href="#">Desa</a></div>
        <div class="breadcrumb-item"><?= $aksi; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('posyandu'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="form-group">
                      <label>Nama Posyandu <span class="text-danger">*</span></label>
                      <input type="text" name="nama_pos" id="nama_pos" class="form-control col-md-6" placeholder="Isi nama posyandu..." value="<?= $nama_pos; ?>" required>
                      <div class="invalid-feedback" id="nama_pos_inv"></div>
                </div>
                <div class="form-group">
                      <label>Desa <span class="text-danger">*</span></label>
                      <div class="form-group">
                            <div class="col-md-6 pl-0 pr-0">
                                <select name="desa_pos" id="desa_pos" class="form-control is-invalid select2" required>
                                    <option value="">-Pilih Desa-</option>
                                    <?php if (!empty($data_desa)) {
                                            foreach ($data_desa as $d) {
                                                echo '<option value="'.$d->id.'" '.( $desa_id == $d->id ? "selected" : "" ).' >'.$d->nama.'</option>';
                                            }
                                        } ?>
                                </select>
                                <div class="invalid-feedback" id="desa_pos_inv"></div>
                            </div>
                      </div>
                </div>
                <div class="form-group">
                    <div class="control-label">Status <span class="text-danger">*</span></div>
                    <label class="custom-switch mt-2">
                    <input type="checkbox" name="status_pos" <?= ( $status_pos == 1 ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">Non Aktif / Aktif</span>
                    </label>
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

    var base_url = '<?= base_url();?>';

    // Select2
    $(document).ready(function() {
        $(".select2").select2();

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
            url : "<?= base_url('posyandu/action_process')?>",
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
                    swal('Berhasil', 'Data posyandu berhasil disimpan!', 'success').then((data) => {
                        document.location = "<?php echo base_url('posyandu')?>";
                    });
                }else{
                    swal('Gagal', 'Data posyandu gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data posyandu gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
        
    }

    function _validation() 
    {
        var status = true;

        if ($("#nama_pos").val() == "") {
            status = false;
            $("#nama_pos").addClass('is-invalid');
            $("#nama_pos_inv").text('Nama posyandu masih kosong');
        }

        if ($("#desa_pos").val() == "") {
            status = false;
            $("#desa_pos").addClass('is-invalid');
            $("#desa_pos_inv").text('Desa Belum dipilih');
        }

        return status
    }

    $("#nama_pos").keyup(function(){
        if ($("#nama_pos").val() != "") {
            $("#nama_pos").removeClass('is-invalid');
            $("#nama_pos_inv").text('');
        }
    });

    $("#desa_pos").change(function(){
        if ($("#desa_pos").val() != "") {
            $("#desa_pos").removeClass('is-invalid');
            $("#desa_pos_inv").text('');
        }
    });

</script>