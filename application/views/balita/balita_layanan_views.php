<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Layanan Posyandu Balita</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Data Posyandu</a></div>
        <div class="breadcrumb-item">Layanan Posyandu Balita</div>
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
                                    <div class="detail-value" id="txt_total_balita">0</div>
                                    <strong class="detail-name">Data Balita</strong>
                                </div>
                                <div class="statistic-details-item">
                                    <div class="detail-value" id="txt_total_penimbang_balita">0</div>
                                    <strong class="detail-name">Penimbang Balita</strong>
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
                    <div class="col-md-2 pr-0 inputFilterLeft">
                        <input type="text" name="filterYear" id="filterYear" class="form-control custom-select" value="<?= date('Y'); ?>">
                    </div>
                    <div class="col-md-2 pl-1 pr-0 inputFilterCenter">
                        <select name="filterJK" id="filterJK" class="form-control" >
                            <option value="">-Jenis Kelamin-</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
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
                    <table id="datatable_balita" class="table table-bordered table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th style="width:2%;" class="text-center">No</th>
                                <th style="width:15%;">No. KMS</th>
                                <th>Nama Anak</th>
                                <th style="width:6%;">L/P</th>
                                <th style="width:20%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                            <tr>
                                <th></th>
                                <th>No. KMS</th>
                                <th>Nama Anak</th>
                                <th>L/P</th>
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
    var filterJK = $("#filterJK").val();

    $(document).ready(function() {

        filterSearch = $("#filterSearch").val();
        filterYear = $("#filterYear").val();
        filterJK = $("#filterJK").val();
        chartTimbangan(filterYear)
        total_data(filterYear)
        table = datatable_balita(filterSearch, filterJK);

        $('.select2').select2()

    });

    function layanan_pos(id) {
        filterYear = $("#filterYear").val();
        document.location = "<?php echo base_url('balita/update_layanan/')?>" + id + "/" + filterYear;
    }

    function datatable_balita(search, jk) {
        return $('#datatable_balita').DataTable({ 
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
                "url": "<?php echo site_url('balita/datatable_layanan_balita')?>",
                "type": "POST",
                "data": {
                    "searchFilter": search,
                    "jkFilter": jk,
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
        filterJK = $("#filterJK").val();
        table.destroy();
        table.ajax.reload();
        chartTimbangan(filterYear)
        total_data(filterYear)
        table = datatable_balita(filterSearch, filterJK);
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
        $("#filterJK").val('');

        table.destroy();
        table.ajax.reload();
        chartTimbangan(strYear)
        total_data(strYear)
        table = datatable_balita('', '');
    }

    function total_data(year) {
        $.ajax({
            url : "<?= base_url('balita/get_total_data_json')?>",
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
                $("#txt_total_balita").text(response.total_balita);
                $("#txt_total_penimbang_balita").text(response.total_timbangan_balita);
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

    function chartTimbangan(year) {
        var labelsCht = [];
        var valuesCht = [];
        
        $.ajax({
            url : "<?= base_url('balita/get_statistik_timbangan_balita_json')?>",
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
                        label: 'Jumlah Penimbang Balita',
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
                        stepSize: 50
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