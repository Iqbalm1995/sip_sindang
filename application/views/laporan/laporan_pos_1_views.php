<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Laporan Posyandu Format 6</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Laporan</a></div>
        <div class="breadcrumb-item">Format 6</div>
    </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1 pt-2 pr-0 text-center inputFilterLeft">
                        Tahun :
                    </div>
                    <div class="col-md-2 pr-0 pl-1 inputFilterCenter">
                        <input type="text" name="filterYear" id="filterYear" class="form-control custom-select" value="<?= date('Y'); ?>">
                    </div>
                    <div class="col-md-1 pr-0 pl-1 inputFilterCenter">
                        <button class="btn btn-primary tombolfull" style="width:100%; height:42px;" id="filterBtn"><i class="fas fa-filter"></i> Filter</button>
                    </div>
                    <div class="col-md-1 pl-1 inputFilterRight">
                        <button class="btn btn-light tombolfull" style="width:100%; height:42px;" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reset </button>
                    </div>
                </div>

                <div class="pt-3">
                    <table id="datatable_laporan" class="table table-sm table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th rowspan="4" style="width:2%;" class="text-center">No</th>
                                <th rowspan="4">Bulan</th>
                                <th colspan="8" class="text-center">Jumlah Pengunjung Posyandu</th>
                                <th colspan="4" class="text-center">Jumlah Bayi</th>
                            </tr>
                            <tr>
                                <th colspan="4" class="text-center">Balita</th>
                                <th rowspan="3" class="text-center">Wus</th>
                                <th colspan="3" class="text-center">Ibu</th>
                                <th rowspan="2" colspan="2" class="text-center">Yang Lahir</th>
                                <th rowspan="2" colspan="2" class="text-center">Meninggal</th>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">0-12 Bulan</th>
                                <th colspan="2" class="text-center">1-5 Tahun</th>
                                <th rowspan="2" class="text-center">Pus</th>
                                <th rowspan="2" class="text-center">Hamil</th>
                                <th rowspan="2" class="text-center">Meunyusui</th>
                            </tr>
                            <tr>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                                <th class="text-center">L</th>
                                <th class="text-center">P</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="section-title mt-0">Export Data</div>
                <div class="row">
                    <div class="col-md-2 pt-0 pr-0 inputFilterLeft">
                        <button class="btn btn-primary tombolfull" style="width:100%; height:42px;" id="filterBtn"><i class="fas fa-file-export"></i> Export Data Bayi </button>
                    </div>
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
	var getMonth = d.getMonth() + 1;
    var strMonth = ('0'+getMonth).slice(-2);

    var filterYear = $("#filterYear").val();

    $(document).ready(function() {
        
        filterYear = $("#filterYear").val();
        table = datatable_laporan(filterYear);

        $('.select2').select2()

    });

    $("#filterYear").datepicker( {
        endDate: '+0y',
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        endDate : new Date(),
    });

    $('#filterBtn').click(function(){
        filterYear = $("#filterYear").val();
        table.destroy();
        table.ajax.reload();
        table = datatable_laporan(filterYear);
    });

    
    function datatable_laporan(filterYear) 
    {
        return $('#datatable_laporan').DataTable({ 
            "responsive": {
                details: {
                    type: 'inline'
                }
            },
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": false,
            "paging":   false,
            "ordering": false,
            "info":     false,

            "ajax": {
                "url": "<?php echo base_url('laporan/datatable_list_laporan6')?>",
                "type": "POST",
                "data": {
                    "filterTahun": filterYear,
                }
            },
            "footerCallback": function (row, data, start, end, display) {  
                var api = this.api(),
                data;
                
                var intVal = function(i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
                };

                var blt_L_0_12bln = 0;
                var blt_P_0_12bln = 0;

                var blt_L_1_5thn = 0;
                var blt_P_1_5thn = 0;

                var wus = 0;
                var pus = 0;
                var ibu_hamil = 0;
                var ibu_menyusui = 0;

                var bayi_lahir_L = 0;
                var bayi_lahir_P = 0;

                var bayi_meninggal_L = 0;
                var bayi_meninggal_P = 0;

                for (var i = 0; i < data.length; i++) {
                    blt_L_0_12bln += parseInt(data[i][2].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    blt_P_0_12bln += parseInt(data[i][3].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    blt_L_1_5thn += parseInt(data[i][4].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    blt_P_1_5thn += parseInt(data[i][5].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    wus += parseInt(data[i][6].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    pus += parseInt(data[i][7].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    ibu_hamil += parseInt(data[i][8].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    ibu_menyusui += parseInt(data[i][9].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    bayi_lahir_L += parseInt(data[i][10].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    bayi_lahir_P += parseInt(data[i][11].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    bayi_meninggal_L += parseInt(data[i][12].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    bayi_meninggal_P += parseInt(data[i][13].toString().replace(/,.*|[^0-9]/g, ''), 10);
                }

                $(api.column(1).footer()).html('Total');
                $(api.column(2).footer()).html('<div class="text-center">' + blt_L_0_12bln + '</div>');
                $(api.column(3).footer()).html('<div class="text-center">' + blt_P_0_12bln + '</div>');

                $(api.column(4).footer()).html('<div class="text-center">' + blt_L_1_5thn + '</div>');
                $(api.column(5).footer()).html('<div class="text-center">' + blt_P_1_5thn + '</div>');

                $(api.column(6).footer()).html('<div class="text-center">' + wus + '</div>');
                $(api.column(7).footer()).html('<div class="text-center">' + pus + '</div>');
                $(api.column(8).footer()).html('<div class="text-center">' + ibu_hamil + '</div>');
                $(api.column(9).footer()).html('<div class="text-center">' + ibu_menyusui + '</div>');

                $(api.column(10).footer()).html('<div class="text-center">' + bayi_lahir_L + '</div>');
                $(api.column(11).footer()).html('<div class="text-center">' + bayi_lahir_P + '</div>');

                $(api.column(12).footer()).html('<div class="text-center">' + bayi_meninggal_L + '</div>');
                $(api.column(13).footer()).html('<div class="text-center">' + bayi_meninggal_P + '</div>');
                
            }
        });

    }

    

    function reload_table()
    {
        $("#filterYear").val(strYear);
        table.destroy();
        table.ajax.reload();
        table = datatable_laporan(strYear);
    }


</script>