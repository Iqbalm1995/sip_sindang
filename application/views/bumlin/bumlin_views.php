<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Bumil Dan Bulin</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item">Bumil Dan Bulin</div>
    </div>
    </div>

    <div class="section-body">
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('bumlin/add'); ?>">
                <i class="fas fa-plus"></i> Tambah Data Bumil Dan Bulin</a>
        </div>
        <div class="card">
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
                    <table id="datatable_bumlin" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:2%;" class="text-center">No</th>
                                <th style="width:15%;" >No. KMS</th>
                                <th style="width:14%;">Tgl. Pendaftaran</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Kel Dawis</th>
                                <th style="width:15%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>No. KMS</th>
                                <th>Tgl. Pendaftaran</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Kel Dawis</th>
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

    var filterSearch = $("#filterSearch").val();

    $(document).ready(function() {
        
        filterSearch = $("#filterSearch").val();
        table = datatable_bumlin(filterSearch);

        $('.select2').select2()

    });

    $('#filterBtn').click(function(){
        filterSearch = $("#filterSearch").val();
        table.destroy();
        table.ajax.reload();
        table = datatable_bumlin(filterSearch);
    });

    function datatable_bumlin(search) 
    {
        return $('#datatable_bumlin').DataTable({ 
            "responsive": {
                details: {
                    type: 'inline'
                }
            },
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": false,
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo base_url('bumlin/datatable_list_bumlin')?>",
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

    function reload_table()
    {
        $("#filterSearch").val('');
        table.destroy();
        table.ajax.reload();
        table = datatable_bumlin('');
    }

    function delete_bumlin(id)
    {

        $.ajax({
            url : "<?= base_url('bumlin/get_data_bumlin_json')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                swal({
                    title: 'Menghapus data',
                    text: 'Apakah anda yakin akan menghapus data Bumil Dan Bulin "'+ readData.kms +' - '+ readData.nama_bumil +'" ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url : "<?= base_url('bumlin/delete')?>/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                swal('Data Bumil Dan Bulin "'+ readData.kms +' - '+ readData.nama_bumil +'" berhasil dihapus!', {
                                    icon: 'success',
                                });
                                reload_table()
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal('Gagal', 'Terjadi kesalahan pada saat manghapus data Bumil Dan Bulin!', 'error');
                            }
                        });

                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mengambil data Bumil Dan Bulin!', 'error');
            }
        });
    }


</script>