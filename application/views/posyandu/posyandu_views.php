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
        <div class="card">
            <!-- <div class="card-header">
            <h4>Example Card</h4>
            </div> -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable_posyandu" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:5%;"><div class="text-center">#</div></th>
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
    var base_url = '<?php echo base_url();?>';

    $(document).ready(function() {

        //datatables
        table = $('#datatable_posyandu').DataTable({ 

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('posyandu/datatable_list_posyandu')?>",
                "type": "POST",
                "data": function ( data ) {
                    // data.nip = $('#fil_nip').val();
                    // data.nama = $('#fil_nama').val();
                    // data.unit = $('#fil_unit').val();
                    // data.tahun_masuk = $('#fil_thm').val();
                    // data.status_karyawan = $('#fil_status_karyawan').val();
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

</script>


