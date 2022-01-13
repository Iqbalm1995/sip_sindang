<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Layanan Posyandu Bumil Tahun <?= $year_assign; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Bumil</a></div>
        <div class="breadcrumb-item"><a href="#">Bumil</a></div>
        <div class="breadcrumb-item">Update Layanan <?= $year_assign; ?></div>
    </div>
    </div>

    <div class="section-body">
    <div class="text-left pb-4">
        <a class="btn btn-primary tombolfull" href="<?= base_url('bumil/layanan'); ?>">
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
                                <a class="nav-link active" id="bumil-tab1" data-toggle="tab" href="#bumil1" role="tab" aria-controls="bumil" aria-selected="true">Data Bumil</a>
                            </li>
                            <li class="nav-item tombolfull pr-2">
                                <a class="nav-link" id="bumil-tab2" data-toggle="tab" href="#bumil2" role="tab" aria-controls="pelayanan" aria-selected="false">Layanan</a>
                            </li>
                            <li class="nav-item tombolfull">
                                <a class="nav-link" id="bumil-tab3" data-toggle="tab" href="#bumil3" role="tab" aria-controls="kunjungan" aria-selected="false">Kunjungan</a>
                            </li>
                        </ul>
                        <hr>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="bumil1" role="tabpanel" aria-labelledby="bumil-tab1">
                                <!-- Input data bayi -->
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                                            <div class="form-group" id='input_pos'>
                                                <div class="form-group">
                                                    <label>Posisi Posyandu Bayi <span class="text-danger">*</span></label>
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
                                            <input type="text" name="nik" id="nik" class="form-control " maxlength="20" placeholder="Isi Nomor KMS..." value="<?= $nik; ?>" disabled onkeypress='numberOnly(event)'>
                                            <div class="invalid-feedback" id="nik_inv"></div>
                                            <div class="valid-feedback" id="nik_valid"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Ibu <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control " placeholder="Isi nama ibu..." value="<?= $nama_ibu; ?>" disabled>
                                            <div class="invalid-feedback" id="nama_ibu_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Bapak <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_bapak" id="nama_bapak" class="form-control " placeholder="Isi nama bapak..." value="<?= $nama_bapak; ?>" disabled>
                                            <div class="invalid-feedback" id="nama_bapak_inv"></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bumil2" role="tabpanel" aria-labelledby="bumil-tab2">
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <div class="form-group">
                                            <div class="control-label">Ibu Sudah Melahirkan?</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_melahirkan" id="status_melahirkan" <?= ( !empty($tgl_lahir_bayi) ? 'checked="true"' : '' ) ?> class="custom-switch-input">
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <label>Nama Bayi <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_bayi" id="nama_bayi" class="form-control " placeholder="Isi nama bayi..." value="<?= $nama_bayi; ?>" disabled>
                                            <div class="invalid-feedback" id="nama_bayi_inv"></div>
                                        </div>
                                        <div class="form-group">
                                        <label>Tanggal Lahir Bayi (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_lahir_bayi" id="tgl_lahir_bayi" class="form-control datepicker" value="<?= $tgl_lahir_bayi; ?>" disabled>
                                            <div class="invalid-feedback" id="tgl_lahir_bayi_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kelamin Bayi (L/P) <span class="text-danger">*</span></label>
                                            <div class="pl-3 pt-2 pb-2 row">
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="jkL" name="jk_bayi" class="custom-control-input" value="L" <?= ( $jk_bayi == "L" ? "checked" : "" ) ?> disabled>
                                                    <label class="custom-control-label" for="jkL">Laki-laki</label>
                                                </div>
                                                <div class="custom-control custom-radio col-md-3 col-sm-12">
                                                    <input type="radio" id="jkP" name="jk_bayi" class="custom-control-input" value="P" <?= ( $jk_bayi == "P" ? "checked" : "" ) ?> disabled>
                                                    <label class="custom-control-label" for="jkP">Perempuan</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label">Status Meninggal Bayi</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_meninggal_bayi" id="status_meninggal_bayi" <?= ( !empty($tgl_meninggal_bayi) ? 'checked="true"' : '' ) ?> class="custom-switch-input" disabled>
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <div class="form-group" style="display: none;" id="inpt_tgl_meninggal_bayi">
                                            <label>Tanggal Meninggal Bayi (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_meninggal_bayi" id="tgl_meninggal_bayi" class="form-control datepicker" value="<?= $tgl_meninggal_bayi; ?>" disabled>
                                            <div class="invalid-feedback" id="tgl_meninggal_bayi_inv"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="control-label">Status Meninggal Ibu</div>
                                            <label class="custom-switch mt-2">
                                            <input type="checkbox" name="status_meninggal_ibu" id="status_meninggal_ibu" <?= ( !empty($tgl_meninggal_ibu) ? 'checked="true"' : '' ) ?> class="custom-switch-input" disabled>
                                            <span class="custom-switch-indicator mt-3"></span>
                                            <span class="custom-switch-description mt-3"> Belum / Sudah</span>
                                            </label>
                                        </div>
                                        <div class="form-group" style="display: none;" id="inpt_tgl_meninggal_ibu">
                                            <label>Tanggal Meninggal Ibu (Tahun-Bulan-Tanggal) <span class="text-danger">*</span></label>
                                            <input type="text" name="tgl_meninggal_ibu" id="tgl_meninggal_ibu" class="form-control datepicker" value="<?= $tgl_meninggal_ibu; ?>" disabled>
                                            <div class="invalid-feedback" id="tgl_meninggal_ibu_inv"></div>
                                        </div>


                                    </div>
                                </div>
                                
                                <div class="text-right mt-4">
                                    <button class="btn btn-primary btn-lg tombolfull prevtab" type="button"><i class="fas fa-chevron-left"></i>&nbsp; Sebelumnya</button>
                                    <button class="btn btn-primary btn-lg tombolfull nexttab" type="button">Selanjutnya &nbsp;<i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="bumil3" role="tabpanel" aria-labelledby="bumil-tab3">
                                
                                <div class="row">
                                    <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">
                                        <div class="card" style="border-radius:10px;">
                                            <div class="card-header">
                                                <h5>Data Kunjungan Ibu Hamil tahun <?= $year_assign; ?>.</h5>
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
                                                                        <input type="hidden" name="kunjungan_bumil_bln[]" id="kunjungan_bumil_bln<?= $arrayNum; ?>" value="<?= $value->bulan; ?>">
                                                                        <input type="hidden" name="kunjungan_bumil_thn[]" id="kunjungan_bumil_thn<?= $arrayNum; ?>" value="<?= $value->tahun; ?>">
                                                                        <th scope="row"><?= ARRAY_BULAN[$value->bulan]; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_bumil[]" id="kunjungan_bumil<?= $arrayNum; ?>" <?= ( $value->is_kunjungan == 1 ? 'checked="true"' : '' ) ?>  onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" class="custom-switch-input">
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
                                                                        <input type="hidden" name="kunjungan_bumil_bln[]" id="kunjungan_bumil_bln<?= $arrayNum; ?>" value="<?= $key; ?>">
                                                                        <input type="hidden" name="kunjungan_bumil_thn[]" id="kunjungan_bumil_thn<?= $arrayNum; ?>" value="<?= $year_assign; ?>">
                                                                        <th scope="row"><?= $value; ?></th>
                                                                        <td>
                                                                            <label class="custom-switch mt-2">
                                                                            <input type="checkbox" name="kunjungan_bumil[]" id="kunjungan_bumil<?= $arrayNum; ?>" class="custom-switch-input" onchange="is_kunjungan(<?= $arrayNum; ?>)" value="1" >
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

        if ($('#status_melahirkan').is(':checked')) {
            $("#nama_bayi").removeAttr('disabled');
            $("#tgl_lahir_bayi").removeAttr('disabled');
            $("#jkL").removeAttr('disabled');
            $("#jkP").removeAttr('disabled');
            $("#status_meninggal_bayi").removeAttr('disabled');
            $("#tgl_meninggal_bayi").removeAttr('disabled');
            $("#status_meninggal_ibu").removeAttr('disabled');
            $("#tgl_meninggal_ibu").removeAttr('disabled');
        }else{
            $("#nama_bayi").attr('disabled', 'true');
            $("#tgl_lahir_bayi").attr('disabled', 'true');
            $("#jkL").attr('disabled', 'true');
            $("#jkP").attr('disabled', 'true');
            $("#status_meninggal_bayi").attr('disabled', 'true');
            $("#tgl_meninggal_bayi").attr('disabled', 'true');
            $("#status_meninggal_ibu").attr('disabled', 'true');
            $("#tgl_meninggal_ibu").attr('disabled', 'true');
        }

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

    $('#status_melahirkan').change(function() {
        if (this.checked) {
                $("#nama_bayi").removeAttr('disabled');
                $("#tgl_lahir_bayi").removeAttr('disabled');
                $("#jkL").removeAttr('disabled');
                $("#jkP").removeAttr('disabled');
                $("#status_meninggal_bayi").removeAttr('disabled');
                $("#tgl_meninggal_bayi").removeAttr('disabled');
                $("#status_meninggal_ibu").removeAttr('disabled');
                $("#tgl_meninggal_ibu").removeAttr('disabled');
        } else {
                $("#nama_bayi").attr('disabled', 'true');
                $("#tgl_lahir_bayi").attr('disabled', 'true');
                $("#jkL").attr('disabled', 'true');
                $("#jkP").attr('disabled', 'true');
                $("#status_meninggal_bayi").attr('disabled', 'true');
                $("#tgl_meninggal_bayi").attr('disabled', 'true');
                $("#status_meninggal_ibu").attr('disabled', 'true');
                $("#tgl_meninggal_ibu").attr('disabled', 'true');
        }
    });

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

    $('#bumil-tab1').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#bumil-tab2').click(function(){
        $('#submit-state').css('display', 'none');
    });
    $('#bumil-tab3').click(function(){
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
        if ($("#kunjungan_bumil"+idx).is(":checked")) {
            $("#kunjungan_val"+idx).val("1");
        }else{
            $("#kunjungan_val"+idx).val("0");
        }
        
    }

    function save()
    {
        var validation = _validation();
        var value_nama_bayi =  $("#nama_bayi").val();
        var value_status_melahirkan =  $('#status_melahirkan').is(':checked');
        
        if (validation == false) {
            swal('Perhatian', 'Isi form dengan lengkap!', 'warning');
            $('#bumil-tab2').trigger('click')
            return
        }
        
        if (value_nama_bayi.length > 0 && value_status_melahirkan == false) {
            
            swal({
                title: 'Mengubah status melahirkan',
                text: 'Apakah anda yakin akan menghapus data bayi melahirkan ?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {

                    save_submit()

                } else {
                    swal('Data tidak jadi ubah!');
                }
            });

        }else{
            save_submit()
        }
        
    }

    function save_submit()
    {
        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled',true);

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : "<?= base_url('bumil/action_process_services')?>",
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
                    swal('Berhasil', 'Data bumil berhasil disimpan!', 'success');
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

        if ($('#status_melahirkan').is(':checked')) {

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

        }

        if ($("#pos_id").val() == "") {
            status = false;
            $("#pos_id").addClass('is-invalid');
            $("#pos_id_inv").text('Posyandu masih belum dipilih');
        }

        return status
    }

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