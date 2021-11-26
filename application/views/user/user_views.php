<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Pengguna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Pengguna</div>
    </div>
    </div>

    <div class="section-body">
        <!-- <h2 class="section-title">This is Example Page</h2>
        <p class="section-lead">This page is just an example for you to create your own page.</p> -->
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('users/add'); ?>">
                <i class="fas fa-plus"></i> Tambah Pengguna</a>
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
                            <label for="fil_role" class="col-sm-2 control-label">Role</label>
                            <div class="col-sm-6">
                                <select name="fil_role" id="fil_role" class="form-control" style="width: 100%;" >
                                    <option value="">-Pilih Role-</option>
                                    <?php if (!empty($data_role)) {
                                            foreach ($data_role as $rol) {
                                                echo '<option value="'.$rol->id.'">'.$rol->name.'</option>';
                                            }
                                    } ?>
                                </select>
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
                            <label for="fil_status_user" class="col-sm-2 control-label">Status Pengguna</label>
                            <div class="col-sm-6">
                                <select name="fil_status_user" id="fil_status_user" class="form-control">
                                    <option value="">-Pilih Status-</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="nonaktif">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="LastName" class="col-sm-2 control-label"></label>
                            <div class="col-sm-4">
                                <button type="button" id="btn-filter" class="btn btn-info">Filter</button>
                                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="">
                    <table id="datatable_pengguna" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:5%;" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Posyandu</th>
                                <th style="width:20%;">Status</th>
                                <th style="width:18%;">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Posyandu</th>
                                <th>Status</th>
                                <th>Opsi</th>
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
        
        table = $('#datatable_pengguna').DataTable({ 
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
                "url": "<?php echo site_url('users/datatable_list_pengguna')?>",
                "type": "POST",
                "data": function ( data ) {
                    data.role_id = $('#fil_role').val();
                    data.pos_id = $('#fil_pos').val();
                    data.status_user = $('#fil_status_user').val();
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

    function delete_pengguna(id)
    {

        $.ajax({
            url : "<?= base_url('users/get_data_user_json')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                swal({
                    title: 'Menhapus data',
                    text: 'Apakah anda yakin akan menghapus data pengguna "'+ readData.nama +'" ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url : "<?= base_url('users/delete')?>/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                swal('Data pengguna "'+ readData.nama +'" berhasil dihapus!', {
                                    icon: 'success',
                                });
                                reload_table()
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal('Gagal', 'Terjadi kesalahan pada saat manghapus data pengguna!', 'error');
                            }
                        });

                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mengambil data pengguna!', 'error');
            }
        });
    }

</script>