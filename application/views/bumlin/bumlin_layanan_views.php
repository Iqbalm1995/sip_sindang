<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Layanan Posyandu Bumil Dan Bulin</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item">Layanan Posyandu Bumil Dan Bulin</div>
    </div>
    </div>

    <div class="section-body">
        <!-- statistic -->
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="section-title mt-0">Jumlah Data</div>
                        <div class="text-center pt-1 mb-5" style="">
                            
                            <div class="statistic-details mt-3 mb-auto">
                                <div class="statistic-details-item">
                                    <div class="detail-value" id="txt_total_bumlin">0</div>
                                    <strong class="detail-name">Data Bumil Dan Bulin</strong>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" id="txt_total_melahirkan">0</div>
                                    <strong class="detail-name">Data Ibu Melahirkan</strong>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" id="txt_total_beresiko">0</div>
                                    <strong class="detail-name">Data Ibu Beresiko</strong>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" id="txt_total_ibu_meninggal">0</div>
                                    <strong class="detail-name">Data Bayi Meninggal</strong>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" id="txt_total_bayi_meninggal">0</div>
                                    <strong class="detail-name">Data Ibu Meninggal</strong>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card">
                    <div class="card-body mt-3">
                        <canvas height="150px" id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-1 pt-2 pr-0 text-center inputFilterLeft">
                        Filter :
                    </div>
                    <div class="col-md-2 pl-1 pr-0 inputFilterCenter">
                        <input type="text" name="filterYear" id="filterYear" class="form-control custom-select" value="<?= date('Y'); ?>">
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
                    <table id="datatable_bumlin" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:2%;" class="text-center">No</th>
                                <th style="width:15%;">No. KMS</th>
                                <th style="width:14%;">Tgl. Pendaftaran</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Beresiko(?)</th>
                                <th style="width:20%;"></th>
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
                                <th>Beresiko(?)</th>
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
                        <select name="ExfilterMonth" id="ExfilterMonth" class="form-control select2">
                            <?php  foreach (ARRAY_BULAN as $key => $value) {
                                    echo '<option value="'.$key.'" '.( $key == date('m') ? "selected" : "" ).' >'.$value.'</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-md-2 pr-0 pl-1 inputFilterCenter">
                        <input type="text" name="ExfilterYear" id="ExfilterYear" class="form-control custom-select" value="<?= date('Y'); ?>">
                    </div>
                    <div class="col-md-2 pr-0 pl-1 inputFilterCenter">
                        <button class="btn btn-primary tombolfull" style="width:100%; height:42px;" id="filterBtn" href="javascript:void(0)" title="Export" onclick="exportData()"><i class="fas fa-file-export"></i> Export Data Bayi </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
</div>
<!-- Script -->
<script type="text/javascript">

    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url();?>';
    
	var d = new Date();
	var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
	var strYear = d.getFullYear();

    var filterSearch = $("#filterSearch").val();
    var filterYear = $("#filterYear").val();

    $(document).ready(function() {

        filterSearch = $("#filterSearch").val();
        filterYear = $("#filterYear").val();
        chartKunjungan(filterYear)
        total_data(filterYear)
        table = datatable_bumlin(filterSearch);

        $('.select2').select2()

    });

    function layanan_pos(id) {
        filterYear = $("#filterYear").val();
        document.location = "<?php echo base_url('bumlin/update_layanan/')?>" + id + "/" + filterYear;
    }

    function exportData() {
        var ExfilterMonth = $("#ExfilterMonth").val();
        var ExfilterYear = $("#ExfilterYear").val();

        document.location = "<?php echo base_url('bumlin/export/')?>" + ExfilterYear + "/" + ExfilterMonth;
    }

    function datatable_bumlin(search) {
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
            "order": [],

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('bumlin/datatable_layanan_bumlin')?>",
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

    $('#filterBtn').click(function(){
        filterSearch = $("#filterSearch").val();
        filterYear = $("#filterYear").val();
        table.destroy();
        table.ajax.reload();
        chartKunjungan(filterYear)
        total_data(filterYear)
        table = datatable_bumlin(filterSearch);
    });

    $("#filterYear").datepicker( {
        endDate: '+0y',
        format: "yyyy",
        viewMode: "years", 
        minViewMode: "years",
        endDate : new Date(),
    });

    function reload_table()
    {
        $("#filterSearch").val('');
        $("#filterYear").val(strYear);

        table.destroy();
        table.ajax.reload();
        chartKunjungan(strYear)
        total_data(strYear)
        table = datatable_bumlin('');
    }

    
    function total_data(year) {
        $.ajax({
            url : "<?= base_url('bumlin/get_total_data_json')?>",
            type: "POST",
            data: {
                filterYear: year
            },
            beforeSend: function() {
                // $('#loading-sales').show(200)
            },
            dataType: "JSON",
            success: function(response) {
                console.log(response)
                $("#txt_total_bumlin").text(response.total_bumlin);
                $("#txt_total_melahirkan").text(response.total_melahirkan);
                $("#txt_total_beresiko").text(response.total_beresiko);
                $("#txt_total_ibu_meninggal").text(response.total_ibu_meninggal);
                $("#txt_total_bayi_meninggal").text(response.total_bayi_meninggal);
            },
            error: function (xhr, ajaxOptions, thrownError) {

            },
            complete: function() {
                // $('#loading-sales').hide(200)
            }
        })

    }
    

    // Chart
    "use strict";
    
    function chartKunjungan(year) {
        var labelsCht = [];
        var valuesCht = [];
        
        $.ajax({
            url : "<?= base_url('bumlin/get_statistik_bumlin_json')?>",
            type: "POST",
            data: {
                filterYear: year,
            },
            beforeSend: function() {
                // $('#loading-sales').show(200)
            },
            dataType: "JSON",
            success: function(response) {

                $.each(response, function(key, val){
                    labelsCht.push(val.bulan);
                    valuesCht.push(val.total);
                        // console.log(val.bulan)
                });

                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nop", "Des"],
                    datasets: [{
                        label: 'Jumlah Kunjungan Bumil Dan Bulin',
                        data: valuesCht,
                        borderWidth: 2,
                        backgroundColor: 'transparent',
                        borderColor: '#39d392',
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#39d392',
                        borderWidth: 2.5,
                        pointRadius: 4
                    }]
                },
                options: {
                    legend: {
                    display: false
                    },
                    scales: {
                    yAxes: [{
                        gridLines: {
                        drawBorder: false,
                        color: '#f2f2f2',
                        },
                        ticks: {
                        beginAtZero: true,
                        stepSize: 200
                        }
                    }],
                    xAxes: [{
                        ticks: {
                        display: true
                        },
                        gridLines: {
                        display: false
                        }
                    }]
                    },
                }
                });

            },
            error: function (xhr, ajaxOptions, thrownError) {

            },
            complete: function() {
                // $('#loading-sales').hide(200)
            }
        })

    }

    


</script>