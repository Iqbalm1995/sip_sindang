<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Data Laporan Posyandu Format 7</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Laporan</a></div>
        <div class="breadcrumb-item">Format 7</div>
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
                    <div class="table-responsive">
                        <table id="datatable_laporan" class="table table-sm table-bordered table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th rowspan="4" style="width:2%;" class="text-center">No</th>
                                    <th rowspan="4">Bulan</th>
                                    <th rowspan="4" class="text-center">Jumlah<br>Ibu Hamil</th>
                                    <th rowspan="4" class="text-center">Diperiksa</th>
                                    <th rowspan="4" class="text-center">FE Tablet Besi</th>
                                    <th rowspan="4" class="text-center">Jumlah<br>Ibu Menyusui</th>
                                    <th colspan="8" class="text-center">Jumlah Akseptor KB</th>
                                    <th colspan="12" class="text-center">Penimbangan Balita</th>
                                    <th rowspan="3" colspan="2" class="text-center">Imunisasi<br>TT Ibu</th>
                                    <th rowspan="3" colspan="2" class="text-center">BCG</th>
                                    <th colspan="22" class="text-center">Jumlah Bayi Yang Diimunisasi</th>
                                    <th colspan="4" class="text-center">Balita Yang Menderita Diare</th>
                                </tr>
                                <tr>
                                    <th rowspan="3" class="text-center">Kon<br>dom</th>
                                    <th rowspan="3" class="text-center">PIL</th>
                                    <th rowspan="3" class="text-center">Im<br>Palnt</th>
                                    <th rowspan="3" class="text-center">MOP</th>
                                    <th rowspan="3" class="text-center">MOW</th>
                                    <th rowspan="3" class="text-center">IUD</th>
                                    <th rowspan="3" class="text-center">Sun<br>tik</th>
                                    <th rowspan="3" class="text-center">Lain<br>lain</th>

                                    <th rowspan="2" colspan="2" class="text-center">Jumlah<br>Balita</th>
                                    <th rowspan="2" colspan="2" class="text-center">Jumlah<br>Balita<br>Yang<br>Memiliki<br>KMS</th>
                                    <th rowspan="2" colspan="2" class="text-center">Jumlah<br>Yang<br>Ditimbang</th>
                                    <th rowspan="2" colspan="2" class="text-center">Jumlah<br>Yang<br>Naik</th>
                                    <th rowspan="2" colspan="2" class="text-center">Jumlah<br>Mendapat<br>VIT A</th>
                                    <th rowspan="2" colspan="2" class="text-center">Jumlah<br>Yang<br>Mendapat<br>PMT</th>

                                    <th colspan="6" class="text-center">DPT</th>
                                    <th colspan="8" class="text-center">POLIO</th>
                                    <th rowspan="2" colspan="2" class="text-center">Campak</th>
                                    <th colspan="6" class="text-center">Hepatitis</th>
                                    <th rowspan="2" colspan="2" class="text-center">Jumlah</th>
                                    <th rowspan="2" colspan="2" class="text-center">Yang<br>Mendapat<br>Oralit</th>
                                </tr>
                                <tr>
                                    <!-- DPT -->
                                    <th colspan="2" class="text-center">I</th>
                                    <th colspan="2" class="text-center">II</th>
                                    <th colspan="2" class="text-center">III</th>

                                    <!-- POLIO -->
                                    <th colspan="2" class="text-center">I</th>
                                    <th colspan="2" class="text-center">II</th>
                                    <th colspan="2" class="text-center">III</th>
                                    <th colspan="2" class="text-center">IV</th>

                                    <!-- Hepatitis -->
                                    <th colspan="2" class="text-center">I</th>
                                    <th colspan="2" class="text-center">II</th>
                                    <th colspan="2" class="text-center">III</th>
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
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>

                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>

                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    
                                    <!-- DPT -->
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>

                                    <!-- POLIO -->
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>

                                    <!-- Campak -->
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>

                                    <!-- Hepatitis -->
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>
                                    <th class="text-center">L</th>
                                    <th class="text-center">P</th>

                                    <!-- Diare -->
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
        </div>

        <div class="card">
            <div class="card-body">
                <div class="section-title mt-0">Export Data</div>
                <div class="row">
                    <div class="col-md-2 pt-0 pr-0 inputFilterLeft">
                        <button class="btn btn-primary tombolfull" style="width:100%; height:42px;" id="filterBtn" href="javascript:void(0)" title="Export" onclick="exportData()"><i class="fas fa-file-export"></i> Export Data </button>
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

    function exportData() {
        document.location = "<?php echo base_url('laporan/export_laporan7/')?>" + filterYear;
    }

    
    function datatable_laporan(filterYear) 
    {
        return $('#datatable_laporan').DataTable({ 
            // "responsive": {
            //     details: {
            //         type: 'inline'
            //     }
            // },
            "processing": true,
            "serverSide": true,
            "searching": false,
            "lengthChange": false,
            "paging":   false,
            "ordering": false,
            "info":     false,

            "ajax": {
                "url": "<?php echo base_url('laporan/datatable_list_laporan7')?>",
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

                // variable
                var Ibu_hamil = 0;
                var diperiksa = 0;
                var jml_FE_besi = 0;
                var menyusui = 0;
                
                var kb_kondom = 0;
                var kb_pil = 0;
                var kb_implant = 0;
                var kb_mop = 0;
                var kb_mow = 0;
                var kb_iud = 0;
                var kb_suntik = 0;
                var kb_lainlain = 0;

                var jml_balita_L = 0;
                var jml_balita_P = 0;

                var jml_punya_kms_L = 0;
                var jml_punya_kms_P = 0;

                var jml_balita_timbang_L = 0;
                var jml_balita_timbang_P = 0;

                var jml_balita_timbang_naik_L = 0;
                var jml_balita_timbang_naik_P = 0;

                var jml_vitA_L = 0;
                var jml_vitA_P = 0;

                var jml_dapat_pmt_L = 0;
                var jml_dapat_pmt_P = 0;

                var jml_imni_tt_1 = 0;
                var jml_imni_tt_2 = 0;

                var jml_bcg_L = 0;
                var jml_bcg_P = 0;

                var jml_dpt_1_L = 0;
                var jml_dpt_1_P = 0;
                var jml_dpt_2_L = 0;
                var jml_dpt_2_P = 0;
                var jml_dpt_3_L = 0;
                var jml_dpt_3_L = 0;

                var jml_polio_1_L = 0;
                var jml_polio_1_P = 0;
                var jml_polio_2_L = 0;
                var jml_polio_2_P = 0;
                var jml_polio_3_L = 0;
                var jml_polio_3_P = 0;
                var jml_polio_4_L = 0;
                var jml_polio_4_P = 0;

                var jml_campak_L = 0;
                var jml_campak_P = 0;

                var jml_hepatitis_1_L = 0;
                var jml_hepatitis_1_P = 0;
                var jml_hepatitis_2_L = 0;
                var jml_hepatitis_2_P = 0;
                var jml_hepatitis_3_L = 0;
                var jml_hepatitis_3_P = 0;

                var jml_diare_L = 0;
                var jml_diare_P = 0;


                // loop calc
                for (var i = 0; i < data.length; i++) {
                    Ibu_hamil       += parseInt(data[i][2].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    diperiksa       += parseInt(data[i][3].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_FE_besi     += parseInt(data[i][4].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    menyusui        += parseInt(data[i][5].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    
                    kb_kondom       += parseInt(data[i][6].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_pil          += parseInt(data[i][7].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_implant      += parseInt(data[i][8].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_mop          += parseInt(data[i][9].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_mow          += parseInt(data[i][10].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_iud          += parseInt(data[i][11].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_suntik       += parseInt(data[i][12].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    kb_lainlain     += parseInt(data[i][13].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_balita_L    += parseInt(data[i][14].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_balita_P    += parseInt(data[i][15].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_punya_kms_L += parseInt(data[i][16].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_punya_kms_P += parseInt(data[i][17].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_balita_timbang_L += parseInt(data[i][18].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_balita_timbang_P += parseInt(data[i][19].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_balita_timbang_naik_L += parseInt(data[i][20].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_balita_timbang_naik_P += parseInt(data[i][21].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_vitA_L += parseInt(data[i][22].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_vitA_P += parseInt(data[i][23].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_dapat_pmt_L += parseInt(data[i][24].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_dapat_pmt_P += parseInt(data[i][25].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_imni_tt_1 += parseInt(data[i][26].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_imni_tt_2 += parseInt(data[i][27].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_bcg_L += parseInt(data[i][28].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_bcg_P += parseInt(data[i][29].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_dpt_1_L += parseInt(data[i][30].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_dpt_1_P += parseInt(data[i][31].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_dpt_2_L += parseInt(data[i][32].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_dpt_2_P += parseInt(data[i][33].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_dpt_3_L += parseInt(data[i][34].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_dpt_3_L += parseInt(data[i][35].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_polio_1_L += parseInt(data[i][36].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_1_P += parseInt(data[i][37].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_2_L += parseInt(data[i][38].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_2_P += parseInt(data[i][39].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_3_L += parseInt(data[i][40].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_3_P += parseInt(data[i][41].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_4_L += parseInt(data[i][42].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_polio_4_P += parseInt(data[i][43].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_campak_L += parseInt(data[i][44].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_campak_P += parseInt(data[i][45].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_hepatitis_1_L += parseInt(data[i][46].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_hepatitis_1_P += parseInt(data[i][47].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_hepatitis_2_L += parseInt(data[i][48].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_hepatitis_2_P += parseInt(data[i][49].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_hepatitis_3_L += parseInt(data[i][50].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_hepatitis_3_P += parseInt(data[i][51].toString().replace(/,.*|[^0-9]/g, ''), 10);

                    jml_diare_L += parseInt(data[i][52].toString().replace(/,.*|[^0-9]/g, ''), 10);
                    jml_diare_P += parseInt(data[i][53].toString().replace(/,.*|[^0-9]/g, ''), 10);

                }

                $(api.column(1).footer()).html('Total');

                $(api.column(2).footer()).html('<div class="text-center">' + Ibu_hamil + '</div>');
                $(api.column(3).footer()).html('<div class="text-center">' + diperiksa + '</div>');
                $(api.column(4).footer()).html('<div class="text-center">' + jml_FE_besi + '</div>');
                $(api.column(5).footer()).html('<div class="text-center">' + menyusui + '</div>');

                $(api.column(6).footer()).html('<div class="text-center">' + kb_kondom + '</div>');
                $(api.column(7).footer()).html('<div class="text-center">' + kb_pil + '</div>');
                $(api.column(8).footer()).html('<div class="text-center">' + kb_implant + '</div>');
                $(api.column(9).footer()).html('<div class="text-center">' + kb_mop + '</div>');
                $(api.column(10).footer()).html('<div class="text-center">' + kb_mow + '</div>');
                $(api.column(11).footer()).html('<div class="text-center">' + kb_iud + '</div>');
                $(api.column(12).footer()).html('<div class="text-center">' + kb_suntik + '</div>');
                $(api.column(13).footer()).html('<div class="text-center">' + kb_lainlain + '</div>');

                $(api.column(14).footer()).html('<div class="text-center">' + jml_balita_L + '</div>');
                $(api.column(15).footer()).html('<div class="text-center">' + jml_balita_P + '</div>');

                $(api.column(16).footer()).html('<div class="text-center">' + jml_punya_kms_L + '</div>');
                $(api.column(17).footer()).html('<div class="text-center">' + jml_punya_kms_P + '</div>');

                $(api.column(18).footer()).html('<div class="text-center">' + jml_balita_timbang_L + '</div>');
                $(api.column(19).footer()).html('<div class="text-center">' + jml_balita_timbang_P + '</div>');

                $(api.column(20).footer()).html('<div class="text-center">' + jml_balita_timbang_naik_L + '</div>');
                $(api.column(21).footer()).html('<div class="text-center">' + jml_balita_timbang_naik_P + '</div>');

                $(api.column(22).footer()).html('<div class="text-center">' + jml_vitA_L + '</div>');
                $(api.column(23).footer()).html('<div class="text-center">' + jml_vitA_P + '</div>');

                $(api.column(24).footer()).html('<div class="text-center">' + jml_dapat_pmt_L + '</div>');
                $(api.column(25).footer()).html('<div class="text-center">' + jml_dapat_pmt_P + '</div>');

                $(api.column(26).footer()).html('<div class="text-center">' + jml_imni_tt_1 + '</div>');
                $(api.column(27).footer()).html('<div class="text-center">' + jml_imni_tt_2 + '</div>');

                $(api.column(28).footer()).html('<div class="text-center">' + jml_bcg_L + '</div>');
                $(api.column(29).footer()).html('<div class="text-center">' + jml_bcg_P + '</div>');

                $(api.column(30).footer()).html('<div class="text-center">' + jml_dpt_1_L + '</div>');
                $(api.column(31).footer()).html('<div class="text-center">' + jml_dpt_1_P + '</div>');
                $(api.column(32).footer()).html('<div class="text-center">' + jml_dpt_2_L + '</div>');
                $(api.column(33).footer()).html('<div class="text-center">' + jml_dpt_2_P + '</div>');
                $(api.column(34).footer()).html('<div class="text-center">' + jml_dpt_3_L + '</div>');
                $(api.column(35).footer()).html('<div class="text-center">' + jml_dpt_3_L + '</div>');

                $(api.column(36).footer()).html('<div class="text-center">' + jml_polio_1_L + '</div>');
                $(api.column(37).footer()).html('<div class="text-center">' + jml_polio_1_P + '</div>');
                $(api.column(38).footer()).html('<div class="text-center">' + jml_polio_2_L + '</div>');
                $(api.column(39).footer()).html('<div class="text-center">' + jml_polio_2_P + '</div>');
                $(api.column(40).footer()).html('<div class="text-center">' + jml_polio_3_L + '</div>');
                $(api.column(41).footer()).html('<div class="text-center">' + jml_polio_3_P + '</div>');
                $(api.column(42).footer()).html('<div class="text-center">' + jml_polio_4_L + '</div>');
                $(api.column(43).footer()).html('<div class="text-center">' + jml_polio_4_P + '</div>');

                $(api.column(44).footer()).html('<div class="text-center">' + jml_campak_L + '</div>');
                $(api.column(45).footer()).html('<div class="text-center">' + jml_campak_P + '</div>');

                $(api.column(46).footer()).html('<div class="text-center">' + jml_hepatitis_1_L + '</div>');
                $(api.column(47).footer()).html('<div class="text-center">' + jml_hepatitis_1_P + '</div>');
                $(api.column(48).footer()).html('<div class="text-center">' + jml_hepatitis_2_L + '</div>');
                $(api.column(49).footer()).html('<div class="text-center">' + jml_hepatitis_2_P + '</div>');
                $(api.column(50).footer()).html('<div class="text-center">' + jml_hepatitis_3_L + '</div>');
                $(api.column(51).footer()).html('<div class="text-center">' + jml_hepatitis_3_P + '</div>');
                
                $(api.column(52).footer()).html('<div class="text-center">' + jml_diare_L + '</div>');
                $(api.column(53).footer()).html('<div class="text-center">' + jml_diare_P + '</div>');
                $(api.column(54).footer()).html('<div class="text-center">' + jml_diare_L + '</div>');
                $(api.column(55).footer()).html('<div class="text-center">' + jml_diare_P + '</div>');

                
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