<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Bayi</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item">Bayi</div>
    </div>
    </div>

    <div class="section-body">
        <div class="text-left pb-4">
            <a class="btn btn-primary tombolfull" href="<?= base_url('bayi/add'); ?>">
                <i class="fas fa-plus"></i> Tambah Data Bayi</a>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1 pt-2 pr-0 text-center inputFilterLeft">
                        Filter :
                    </div>
                    <div class="col-md-2 pr-0 pl-1 inputFilterCenter">
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
                    <table id="datatable_bayi" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:2%;" class="text-center">No</th>
                                <th>No. KMS</th>
                                <th>Nama Bayi</th>
                                <th>Nama Ibu</th>
                                <th>Nama Bapak</th>
                                <th>Tgl Lahir Bayi</th>
                                <th>L/P</th>
                                <th>Tgl Meninggal Bayi</th>
                                <th>BBL</th>
                                <th>Keterangan</th>
                                <th style="width:12%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>No. KMS</th>
                                <th>Nama Bayi</th>
                                <th>Nama Ibu</th>
                                <th>Nama Bapak</th>
                                <th>Tgl Lahir Bayi</th>
                                <th>L/P</th>
                                <th>Tgl Meninggal Bayi</th>
                                <th>BBL</th>
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
    
	var d = new Date();
	var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
	var strYear = d.getFullYear();

    var filterSearch = $("#filterSearch").val();

    $(document).ready(function() {

        filterSearch = $("#filterSearch").val();
        table = datatables_bayi(filterSearch);

        $('.select2').select2()

    });

    $('#filterBtn').click(function(){
        filterSearch = $("#filterSearch").val();
        table.destroy();
        table.ajax.reload();
        table = datatables_bayi(filterSearch);
    });

    $("#filterYear").datepicker( {
        endDate: '+0y',
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        endDate : new Date(),
    });

    function datatables_bayi(search) {
        return $('#datatable_bayi').DataTable({ 
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
                "url": "<?php echo site_url('bayi/datatable_list_bayi')?>",
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
        table = datatables_bayi('');
    }

    

    function delete_bayi(id)
    {

        $.ajax({
            url : "<?= base_url('bayi/get_data_bayi_json')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(readData)
            {
                console.log(readData)
                swal({
                    title: 'Menghapus data',
                    text: 'Apakah anda yakin akan menghapus data bayi "'+ readData.kms +' - '+ readData.nama_bayi +'" ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url : "<?= base_url('bayi/delete')?>/" + id,
                            type: "POST",
                            dataType: "JSON",
                            success: function(data)
                            {
                                swal('Data bayi "'+ readData.kms +' - '+ readData.nama_bayi +'" berhasil dihapus!', {
                                    icon: 'success',
                                });
                                reload_table()
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal('Gagal', 'Terjadi kesalahan pada saat manghapus data bayi!', 'error');
                            }
                        });

                    } else {
                        swal('Data tidak jadi dihapus!');
                    }
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal('Gagal', 'Terjadi kesalahan pada saat mengambil data bayi!', 'error');
            }
        });
    }
</script>