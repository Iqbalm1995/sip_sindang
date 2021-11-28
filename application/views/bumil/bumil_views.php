<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Ibu Hamil</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item">Ibu Hamil</div>
    </div>
    </div>

    <div class="section-body">
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('bumil/add'); ?>">
                <i class="fas fa-plus"></i> Tambah Data Bumil</a>
            <button class="btn btn-light tombolfull" onclick="reload_table()">
                <i class="fas fa-sync-alt"></i> Refresh</button>
            <a class="btn btn-info tombolfull" role="button" data-toggle="collapse" href="#filterdata" aria-expanded="false" aria-controls="filterdata">
                  <i class="fas fa-filter"></i> Filter Data
            </a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="collapse" id="filterdata">
                    <form id="form-filter" class="form-horizontal">
                        <div class="form-group">
                            <label for="fil_nik" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-6">
                                <input type="text" name="fil_nik" id="fil_nik" class="form-control" placeholder="Cari berdasarkan NIK...">
                            </div>
                        </div>
                        <?php if (empty($this->session->userdata('pos_id'))) { ?>
                            <div class="form-group">
                                <label for="fil_pos" class="col-sm-2 control-label">Posyandu</label>
                                <div class="col-sm-6">
                                    <select name="fil_pos" id="fil_pos" class="form-control" style="width: 100%;" >
                                        <option value="">-Pilih Posyandu-</option>
                                        <?php if (!empty($data_pos)) {
                                                foreach ($data_pos as $pos) {
                                                    echo '<option value="'.$pos->id.'">'.$pos->nama.'</option>';
                                                }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        <?php }else{ ?>
                            <input type="hidden" name="fil_pos" id="fil_pos" value="<?= $this->session->userdata('pos_id'); ?>"> 
                        <?php } ?>
                        <div class="form-group">
                            <label for="fil_jk_bayi" class="col-sm-2 control-label">Jenis Kelamin Bayi</label>
                            <div class="col-sm-6">
                                <select name="fil_jk_bayi" id="fil_jk_bayi" class="form-control">
                                    <option value="">-Pilih Jenis Kelamin-</option>
                                    <option value="L">Laki - laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4">
                                <button type="button" id="btn-filter" class="btn btn-info">Filter</button>
                                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="">
                    <table id="datatable_bumil" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:2%;" class="text-center">No</th>
                                <th>NIK</th>
                                <th>Nama Ibu</th>
                                <th>Nama Bapak</th>
                                <th>Nama Bayi</th>
                                <th>Tgl Lahir Bayi</th>
                                <th>L/P</th>
                                <th>Tgl Meninggal Bayi</th>
                                <th>Tgl Meninggal Ibu</th>
                                <th>Keterangan</th>
                                <th style="width:12%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>NIK</th>
                                <th>Nama Bapak</th>
                                <th>Nama Ibu</th>
                                <th>Nama Bayi</th>
                                <th>Tgl Lahir Bayi</th>
                                <th>L/P</th>
                                <th>Tgl Meninggal Bayi</th>
                                <th>Tgl Meninggal Ibu</th>
                                <th>Keterangan</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>
</div>
<!-- Script CRUD -->
<script type="text/javascript">

    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url();?>';

    $(document).ready(function() {
        
        table = $('#datatable_bumil').DataTable({ 
            "responsive": {
                details: {
                    type: 'inline'
                }
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('bumil/datatable_list_bumil')?>",
                "type": "POST",
                "data": function ( data ) {
                    data.nik = $('#fil_nik').val();
                    data.pos_id = $('#fil_pos').val();
                    data.jk_bayi = $('#fil_jk_bayi').val();
                }
            },

            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ 0 ], //first column
                    "orderable": false, //set not orderable
                },
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },

            ],

        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

        $('#btn-filter').click(function(){ //button filter event click
            table.ajax.reload();  //just reload table
        });

        $('#btn-reset').click(function(){ //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload();  //just reload table
        });

        $('.select2').select2()

    });

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    function delete_bumil(id)
    {

        $.ajax({
            url : "<?= base_url('bumil/get_data_bumil_json')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                swal({
                    title: 'Menhapus data',
                    text: 'Apakah anda yakin akan menghapus data ibu hamil "'+ readData.nik +' - '+ readData.nama_ibu +'" ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url : "<?= base_url('bumil/delete')?>/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                swal('Data ibu hamil "'+ readData.nik +' - '+ readData.nama_ibu +'" berhasil dihapus!', {
                                    icon: 'success',
                                });
                                reload_table()
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal('Gagal', 'Terjadi kesalahan pada saat manghapus data ibu hamil!', 'error');
                            }
                        });

                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mengambil data ibu hamil!', 'error');
            }
        });
    }


</script>