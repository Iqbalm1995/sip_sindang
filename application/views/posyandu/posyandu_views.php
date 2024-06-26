<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Master Posyandu</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Master</a></div>
        <div class="breadcrumb-item">Posyandu</div>
    </div>
    </div>

    <div class="section-body">
        <!-- <h2 class="section-title">This is Example Page</h2>
        <p class="section-lead">This page is just an example for you to create your own page.</p> -->
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('posyandu/add'); ?>">
                <i class="fas fa-plus"></i> Tambah Posyandu</a>
        </div>
        <div class="card">
            <!-- <div class="card-header">
            <h4>Example Card</h4>
            </div> -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 pr-0 inputFilterLeft">
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
                    <table id="datatable_posyandu" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:5%;" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Desa</th>
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
                                <th>Desa</th>
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
    var base_url = '<?=base_url();?>';

    var filterSearch = $("#filterSearch").val();

    $(document).ready(function() {

        filterSearch = $("#filterSearch").val();
        table = datatable_pos(filterSearch);

        $('.select2').select2()

    });

    $('#filterBtn').click(function(){
        filterSearch = $("#filterSearch").val();
        table.destroy();
        table.ajax.reload();
        table = datatable_pos(filterSearch);
    });

    function reload_table()
    {
        $("#filterSearch").val('');
        table.destroy();
        table.ajax.reload();
        table = datatable_pos('');
    }

    function datatable_pos(search) {
        return $('#datatable_posyandu').DataTable({ 
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
                "url": "<?php echo site_url('posyandu/datatable_list_posyandu')?>",
                "type": "POST",
                "data": {
                    "searchFilter": search,
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

    function delete_posyandu(id)
    {

        $.ajax({
            url : "<?= base_url('posyandu/get_data_posyandu_json')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                swal({
                    title: 'Menghapus data',
                    text: 'Apakah anda yakin akan menghapus data Posyandu "'+ readData.nama +'" ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url : "<?= base_url('posyandu/delete')?>/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                swal('Data Posyandu "'+ readData.nama +'" berhasil dihapus!', {
                                    icon: 'success',
                                });
                                reload_table()
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal('Gagal', 'Terjadi kesalahan pada saat manghapus data Posyandu!', 'error');
                            }
                        });

                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mengambil data Posyandu!', 'error');
            }
        });
    }

</script>


