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
        <a class="btn btn-primary tombolfull" href="<?= base_url('desa'); ?>">
            <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <form id="form" action="#" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id; ?>">
            <input type="hidden" name="save_method" value="<?= $aksi; ?>">
            <div class="card-body">
                <div class="form-group">
                      <label>Nama Desa <span class="text-danger">*</span></label>
                      <input type="text" name="nama_desa" id="nama_desa" class="form-control col-md-6" placeholder="Isi nama desa..." value="<?= $nama_desa; ?>" required>
                      <div class="invalid-feedback" id="nama_desa_inv"></div>
                </div>
                <div class="form-group">
                    <div class="control-label">Status <span class="text-danger">*</span></div>
                    <label class="custom-switch mt-2">
                    <input type="checkbox" name="status_desa" <?= ( $status_desa == 1 ? 'checked="true"' : '' ) ?> class="custom-switch-input">
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
            url : "<?= base_url('desa/action_process')?>",
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
                    swal('Berhasil', 'Data desa berhasil disimpan!', 'success').then((data) => {
                        document.location = "<?php echo base_url('desa')?>";
                    });
                }else{
                    swal('Gagal', 'Data desa gagal disimpan!', 'error');
                }
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false); 

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Data desa gagal disimpan!', 'error');
                $('#btnSave').text('Simpan'); 
                $('#btnSave').attr('disabled',false);

            }
        });
        
    }

    function _validation() {
        var status = true;

        if ($("#nama_desa").val() == "") {
            status = false;
            $("#nama_desa").addClass('is-invalid');
            $("#nama_desa_inv").text('Nama desa masih kosong');
        }

        return status
    }

    $("#nama_desa").keyup(function(){
        if ($("#nama_desa").val() != "") {
            $("#nama_desa").removeClass('is-invalid');
            $("#nama_desa_inv").text('');
        }
    });


</script>