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
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 pr-0 inputFilterLeft">
                        <select name="filterRole" id="filterRole" class="form-control" >
                            <option value="">-Jenis Role-</option>
                            <?php if (!empty($data_role)) {
                                    foreach ($data_role as $rol) {
                                        echo '<option value="'.$rol->id.'">'.$rol->name.'</option>';
                                    }
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2 pl-1 pr-0 inputFilterCenter">
                        <input type="text" name="filterSearch" id="filterSearch" class="form-control" placeholder="Pencarian...">
                    </div>
                    <div class="col-md-1 pr-0 pl-1 inputFilterCenter">
                        <button class="btn btn-primary tombolfull" style="width:100%; height:42px;" id="filterBtn"><i class="fas fa-search"></i> Cari </button>
                    </div>
                    <div class="col-md-1 pl-1 inputFilterRight">
                        <button class="btn btn-light tombolfull" style="width:100%; height:42px;" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reset </button>
                    </div>
                </div>
                <div class="pt-3">
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

    var filterSearch = $("#filterSearch").val();
    var filterRole = $("#filterRole").val();

    $(document).ready(function() {
        
        filterSearch = $("#filterSearch").val();
        filterRole = $("#filterRole").val();

        table = datatable_users(filterSearch, filterRole);

        $('.select2').select2()

    });

    function datatable_users(search, role) {
        return $('#datatable_pengguna').DataTable({ 
            "responsive": {
                details: {
                    type: 'inline'
                }
            },
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": false,
            "order": [],

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('users/datatable_list_pengguna')?>",
                "type": "POST",
                "data":  {
                    "searchFilter": search,
                    "roleFilter": role,
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
    }

    $('#filterBtn').click(function()
    {
        filterSearch = $("#filterSearch").val();
        filterRole = $("#filterRole").val();

        table.destroy();
        table.ajax.reload();
        
        table = datatable_users(filterSearch, filterRole);
    });

    function reload_table()
    {
        $("#filterSearch").val('');
        $("#filterRole").val('');

        table.destroy();
        table.ajax.reload();
        table = datatable_users('', '');
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
                    title: 'Menghapus data',
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