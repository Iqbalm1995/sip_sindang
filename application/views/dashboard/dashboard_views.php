<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Dashboard SIP Sindang</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active">Dashboard</div>
    </div>
    </div>
    <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
    <div class="section-body">
        
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="border-radius:10px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-1 pt-2 pr-0 text-center inputFilterLeft">
                            Filter : 
                        </div>
                        <div class="col-md-2 pr-0 pl-1 inputFilterCenter">
                            <input type="text" name="filterYear" id="filterYear" class="form-control custom-select" value="<?= date('Y'); ?>">
                        </div>
                        <div class="col-md-1 pr-0 pl-1 inputFilterCenter">
                            <button class="btn btn-primary tombolfull" style="width:100%; height:42px;" id="filterBtn"><i class="fas fa-filter"></i> Filter </button>
                        </div>
                        <div class="col-md-1 pl-1 inputFilterRight">
                            <button class="btn btn-light tombolfull" style="width:100%; height:42px;" onclick="reload_table()"><i class="fas fa-sync-alt"></i> Reset </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="border-radius:10px;">
                <div class="card-icon bg-primary" style="border-radius:10px;">
                    <i class="fas fa-clinic-medical"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Jumlah Posyandu</h4>
                    </div>
                    <div class="card-body" id="jml_pos">
                    0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="border-radius:10px;">
                <div class="card-icon bg-danger" style="border-radius:10px;">
                    <i class="fas fa-female"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Jumlah Ibu Hamil</h4>
                    </div>
                    <div class="card-body" id="jml_bumil">
                    0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="border-radius:10px;">
                <div class="card-icon bg-warning" style="border-radius:10px;">
                    <i class="fas fa-baby"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Jumlah Bayi</h4>
                    </div>
                    <div class="card-body" id="jml_bayi">
                    0
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1" style="border-radius:10px;">
                <div class="card-icon bg-success" style="border-radius:10px;">
                    <i class="fas fa-child"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Jumlah Balita</h4>
                    </div>
                    <div class="card-body" id="jml_balita">
                    0
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-sm-12">
            <div class="card" style="border-radius:10px;">
                <div class="card-header">
                    <h4>Jumlah Penimbangan Posyandu Bayi Tahun <span id="tahunLabel1"></span></h4>
                </div>
                <div class="card-body">
                    <canvas id="chartTimbanganBayi"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card" style="border-radius:10px;">
                <div class="card-header">
                    <h4>Jumlah Pelayanan Posyandu Balita Tahun <span id="tahunLabel2"></span></h4>
                </div>
                <div class="card-body">
                    <canvas id="chartPelayananBayi"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="card" style="border-radius:10px;">
                <div class="card-header">
                    <h4>Jumlah Penimbangan Posyandu Balita Tahun <span id="tahunLabel3"></span></h4>
                </div>
                <div class="card-body">
                    <canvas id="chartTimbanganBalita"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="card" style="border-radius:10px;">
                <div class="card-header">
                    <h4>Jumlah Pelayanan Posyandu Balita Tahun <span id="tahunLabel4"></span></h4>
                </div>
                <div class="card-body">
                    <canvas id="chartPelayananBalita"></canvas>
                </div>
            </div>
        </div>


    </div>
</section>
</div>
<!-- Script -->
<script type="text/javascript">

    var table;
    var base_url = '<?php echo base_url();?>';
    
	var d = new Date();
	var strDate = d.getFullYear() + "-" + (d.getMonth() + 1) + "-" + d.getDate();
	var strYear = d.getFullYear();

    var filterYear = $("#filterYear").val();

    $(document).ready(function() {
        
        filterYear = $("#filterYear").val();
        $("#tahunLabel1").text(filterYear);
        $("#tahunLabel2").text(filterYear);
        $("#tahunLabel3").text(filterYear);
        $("#tahunLabel4").text(filterYear);

        chartTimbanganBayi(filterYear);
        chartTimbanganBalita(filterYear);
        chartPelayananBayi(filterYear);
        chartPelayananBalita(filterYear);
        topJumlahTotal()

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
        $("#tahunLabel1").text(filterYear);
        $("#tahunLabel2").text(filterYear);
        $("#tahunLabel3").text(filterYear);
        $("#tahunLabel4").text(filterYear);

        chartTimbanganBayi(filterYear);
        chartTimbanganBalita(filterYear);
        chartPelayananBayi(filterYear);
        chartPelayananBalita(filterYear);

    });

    function reload_table()
    {
        $("#filterYear").val(strYear);
        $("#tahunLabel").text(strYear);
        $("#tahunLabel1").text(strYear);
        $("#tahunLabel2").text(strYear);
        $("#tahunLabel3").text(strYear);
        $("#tahunLabel4").text(strYear);

        chartTimbanganBayi(strYear);
        chartTimbanganBalita(strYear);
        chartPelayananBayi(strYear);
        chartPelayananBalita(strYear);
    }

    function topJumlahTotal() {

        var labelsCht_L = [];
        var valuesCht_L = [];
        var labelsCht_P = [];
        var valuesCht_P = [];

        $.ajax({
            url : "<?= base_url('dashboard/get_top_jumlah_total')?>",
            type: "POST",
            data: {
                // filterYear: year,
            },
            beforeSend: function() {
                // $('#loading-sales').show(200)
            },
            dataType: "JSON",
            success: function(response) {

                $("#jml_pos").text(response.total_pos);
                $("#jml_bumil").text(response.total_bumil);
                $("#jml_bayi").text(response.total_bayi);
                $("#jml_balita").text(response.total_balita);

            },
            error: function (xhr, ajaxOptions, thrownError) {

            },
            complete: function() {
                // $('#loading-sales').hide(200)
            }
        })

    }

    // Chart Timbangan Bayi (chartTimbanganBayi)----------------------------------------------------------------------------------------------->>
        function chartTimbanganBayi(year) {

            var labelsCht_L = [];
            var valuesCht_L = [];
            var labelsCht_P = [];
            var valuesCht_P = [];

            $.ajax({
                url : "<?= base_url('dashboard/get_stat_timbangan_bayi')?>",
                type: "POST",
                data: {
                    filterYear: year,
                },
                beforeSend: function() {
                    // $('#loading-sales').show(200)
                },
                dataType: "JSON",
                success: function(response) {

                    if (response.stat_tbg_bayi_L.length > 0) {
                        $.each(response.stat_tbg_bayi_L, function(key, val){
                            labelsCht_L.push(val.bulan);
                            valuesCht_L.push(val.total);
                        });
                    }else{
                        for (let iL = 0; iL < 12; iL++) {
                            valuesCht_L.push(0);
                        }
                    }
                    
                    if (response.stat_tbg_bayi_P.length > 0) {
                        $.each(response.stat_tbg_bayi_P, function(key, val){
                            labelsCht_P.push(val.bulan);
                            valuesCht_P.push(val.total);
                        });
                    }else{
                        for (let iP = 0; iP < 12; iP++) {
                            valuesCht_L.push(0);
                        }
                    }

                    var ctxTimbanganBayi = document.getElementById("chartTimbanganBayi").getContext('2d');
                    var myChartTimbanganBayi = new Chart(ctxTimbanganBayi, {
                        type: 'line',
                        data: {
                                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nop", "Des"],
                                datasets: [{
                                label: 'Jumlah Penimbang Bayi Laki-laki',
                                data: valuesCht_L,
                                borderWidth: 2,
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(63,82,227,.8)',
                                borderWidth: 4,
                                pointRadius: 4,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: 'rgba(63,82,227,.8)',
                                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                            },
                            {
                                label: 'Jumlah Penimbang Bayi Perempuan',
                                data: valuesCht_P,
                                borderWidth: 2,
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(254,86,83,.7)',
                                borderWidth: 4,
                                pointRadius: 4,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: 'rgba(254,86,83,.7)',
                                pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                            }]
                        },
                        options: {
                            legend: {
                            display: true,
                            position : 'bottom'
                            },
                            scales: {
                            yAxes: [{
                                gridLines: {
                                // display: false,
                                drawBorder: false,
                                color: '#f2f2f2',
                                },
                                ticks: {
                                beginAtZero: true,
                                stepSize: 2,
                                callback: function(value, index, values) {
                                    return value;
                                }
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                display: false,
                                tickMarkLength: 15,
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

    // Chart Timbangan Bayi (chartTimbanganBayi)----------------------------------------------------------------------------------------------->>

    
    // Chart Timbangan Balita (chartTimbanganBalita)------------------------------------------------------------------------------------------->>
        function chartTimbanganBalita(year) {
            var labelsCht_L = [];
            var valuesCht_L = [];
            var labelsCht_P = [];
            var valuesCht_P = [];

            $.ajax({
                url : "<?= base_url('dashboard/get_stat_timbangan_balita')?>",
                type: "POST",
                data: {
                    filterYear: year,
                },
                beforeSend: function() {
                    // $('#loading-sales').show(200)
                },
                dataType: "JSON",
                success: function(response) {

                    if (response.stat_tbg_balita_L.length > 0) {
                        $.each(response.stat_tbg_balita_L, function(key, val){
                            labelsCht_L.push(val.bulan);
                            valuesCht_L.push(val.total);
                        });
                    }else{
                        for (let iL = 0; iL < 12; iL++) {
                            valuesCht_L.push(0);
                        }
                    }
                    
                    if (response.stat_tbg_balita_P.length > 0) {
                        $.each(response.stat_tbg_balita_P, function(key, val){
                            labelsCht_P.push(val.bulan);
                            valuesCht_P.push(val.total);
                        });
                    }else{
                        for (let iP = 0; iP < 12; iP++) {
                            valuesCht_L.push(0);
                        }
                    }
                    

                    var ctxTimbanganBalita = document.getElementById("chartTimbanganBalita").getContext('2d');
                    var mychartTimbanganBalita = new Chart(ctxTimbanganBalita, {
                        type: 'line',
                        data: {
                                labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nop", "Des"],
                                datasets: [{
                                label: 'Jumlah Penimbang Balita Laki-laki',
                                data: valuesCht_L,
                                borderWidth: 2,
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(63,82,227,.8)',
                                borderWidth: 4,
                                pointRadius: 4,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: 'rgba(63,82,227,.8)',
                                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
                            },
                            {
                                label: 'Jumlah Penimbang Balita Perempuan',
                                data: valuesCht_P,
                                borderWidth: 2,
                                backgroundColor: 'transparent',
                                borderColor: 'rgba(254,86,83,.7)',
                                borderWidth: 4,
                                pointRadius: 4,
                                pointBackgroundColor: '#fff',
                                pointBorderColor: 'rgba(254,86,83,.7)',
                                pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
                            }]
                        },
                        options: {
                            legend: {
                            display: true,
                            position : 'bottom'
                            },
                            scales: {
                            yAxes: [{
                                gridLines: {
                                // display: false,
                                drawBorder: false,
                                color: '#f2f2f2',
                                },
                                ticks: {
                                beginAtZero: true,
                                stepSize: 2,
                                callback: function(value, index, values) {
                                    return value;
                                }
                                }
                            }],
                            xAxes: [{
                                gridLines: {
                                display: false,
                                tickMarkLength: 15,
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
        

    // Chart Timbangan Balita (chartTimbanganBalita)------------------------------------------------------------------------------------------->>

    
    // Chart Pelayanan Bayi (chartPelayananBayi)----------------------------------------------------------------------------------------------->>
        // 17 data
        function chartPelayananBayi(year) {
            var labelsCht = [];
            var valuesCht = [];

            $.ajax({
                url : "<?= base_url('dashboard/get_stat_pelayanan_bayi')?>",
                type: "POST",
                data: {
                    filterYear: year,
                },
                beforeSend: function() {
                    // $('#loading-sales').show(200)
                },
                dataType: "JSON",
                success: function(response) {

                    var ctxPelayananBayi = document.getElementById("chartPelayananBayi").getContext('2d');
                    var myChartPelayananBayi = new Chart(ctxPelayananBayi, {
                        type: 'pie',
                        data: {
                            datasets: [{
                            data: [
                                response.total_pyd_syrp_besi_fe1,
                                response.total_pyd_syrp_besi_fe2,
                                response.total_pyd_vit_a_bln1,
                                response.total_pyd_vit_a_bln2,
                                response.total_pyd_oralit,
                                response.total_pyd_bcg,
                                response.total_pyd_dpt1,
                                response.total_pyd_dpt2,
                                response.total_pyd_dpt3,
                                response.total_pyd_polio1,
                                response.total_pyd_polio2,
                                response.total_pyd_polio3,
                                response.total_pyd_polio4,
                                response.total_pyd_campak,
                                response.total_pyd_hepatitis1,
                                response.total_pyd_hepatitis2,
                                response.total_pyd_hepatitis3,
                            ],
                            backgroundColor: [
                                '#D92424',
                                '#D96624',
                                '#D9CB24',
                                '#fc544b',
                                '#96D924',
                                '#24D959',
                                '#24D9AF',
                                '#24D5D9',
                                '#248AD9',
                                '#243FD9',
                                '#6524D9',
                                '#9F24D9',
                                '#D924D9',
                                '#377453',
                                '#374074',
                                '#743751',
                                '#181716',
                            ],
                            label: 'Jumlah Pelayanan Posyandu Bayi'
                            }],
                            labels: [
                                'Sirup Besi FE I',
                                'Sirup Besi FE II',
                                'Vitamin A BLN 1',
                                'Vitamin A BLN 2',
                                'BCG',
                                'Oralit',
                                'DPT I',
                                'DPT II',
                                'DPT III',
                                'Polio I',
                                'Polio II',
                                'Polio III',
                                'Polio IV',
                                'Campak',
                                'Hepatitis I',
                                'Hepatitis II',
                                'Hepatitis III'
                            ],
                        },
                        options: {
                            responsive: true,
                            legend: {
                            position: 'bottom',
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
    // Chart Pelayanan Bayi (chartPelayananBayi)----------------------------------------------------------------------------------------------->>

    // Chart Pelayanan Balita (chartPelayananBalita)------------------------------------------------------------------------------------------->>
        // 6 data
        function chartPelayananBalita(year) {
            var labelsCht = [];
            var valuesCht = [];

            $.ajax({
                url : "<?= base_url('dashboard/get_stat_pelayanan_balita')?>",
                type: "POST",
                data: {
                    filterYear: year,
                },
                beforeSend: function() {
                    // $('#loading-sales').show(200)
                },
                dataType: "JSON",
                success: function(response) {

                    var ctxPelayananBalita = document.getElementById("chartPelayananBalita").getContext('2d');
                    var myChartPelayananBalita = new Chart(ctxPelayananBalita, {
                        type: 'pie',
                        data: {
                            datasets: [{
                            data: [
                                response.total_pyd_syrp_besi_fe1,
                                response.total_pyd_syrp_besi_fe2,
                                response.total_pyd_vit_a_bln1,
                                response.total_pyd_vit_a_bln2,
                                response.total_pyd_pmt_pemulihan,
                                response.total_pyd_oralit,
                            ],
                            backgroundColor: [
                                '#191d21',
                                '#63ed7a',
                                '#ffa426',
                                '#fc544b',
                                '#6777ef',
                            ],
                            label: 'Jumlah Pelayanan Posyandu Balita'
                            }],
                            labels: [
                                'Sirup Besi FE I',
                                'Sirup Besi FE II',
                                'Vitamin A BLN 1',
                                'Vitamin A BLN 2',
                                'PMT Pemulihan',
                                'Oralit',
                            ],
                        },
                        options: {
                            responsive: true,
                            legend: {
                            position: 'bottom',
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
    // Chart Pelayanan Balita (chartPelayananBalita)------------------------------------------------------------------------------------------->>

</script>