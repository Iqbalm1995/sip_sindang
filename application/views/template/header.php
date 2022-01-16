<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="shortcut icon" href="<?=base_url('/assets/img/');?>/fav-logo_32x32.png">
  <!-- <title>Admin &rsaquo; &mdash; Baymaks</title> -->
  <title>SIP SINDANG &mdash; <?= $title_page; ?></title>

  <!-- General CSS Files -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap-datepicker/bootstrap-datepicker.css">

  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/weather-icon/css/weather-icons.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/weather-icon/css/weather-icons-wind.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">


  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>css/stylev2.css">
  <link rel="stylesheet" href="<?=base_url('/assets/theme/stisla/');?>css/components.css">

  
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
  
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/jquery.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/datatables/datatables.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>modules/jquery-ui/jquery-ui.min.js"></script>
  <script src="<?=base_url('/assets/theme/stisla/');?>js/page/modules-datatables.js"></script>

  <script src="<?=base_url('/assets/theme/stisla/');?>modules/bootstrap-datepicker/bootstrap-datepicker.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
</head>

<body class="layout-1">
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      <!-- Navbar & Sidebar Include-->
      <?php 
          include('navbar.php');
          include('sidebar.php');
      ?>