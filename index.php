<?php
// error_reporting(E_ALL ^ E_WARNING); 
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>location.href='login.php';</script>";
  exit;
}
require 'config/+konfigurasi.php';
require 'config/koneksi.php'; 
require 'pages/functions/functions.php';
require 'pages/functions/select.php';

?>
<!DOCTYPE html>
<html>

<head >
  <style type="text/css">
  </style>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Dashboard - Human Resources</title>
  <!-- Favicon-->
  <!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->

  <!-- Google Fonts -->
  <link href="assets/css/fontgogleapis.css" rel="stylesheet" type="text/css">
  <link href="assets/css/gicon.css" rel="stylesheet" type="text/css">
  <!-- online goole icon -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Bootstrap Core Css -->
  <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Waves Effect Css -->
  <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

  <!-- Animation Css -->
  <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

  <!-- Custom Css -->
  <link href="assets/css/admin.css" rel="stylesheet">

  <!-- JQuery DataTable Css -->
  <link href="assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

  <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
  <link href="assets/css/themes/all-themes.css" rel="stylesheet" />

  <!-- MENU JQUERY -->
  <script type="text/javascript" src="assets/plugins/jquery/jquery.js"></script>

  <!-- Jquery Barcode -->
  <script type="text/javascript" src="assets/js/jquery-barcode.js"></script>

  <!-- font awesome -->
  <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

  <!-- toggle switch -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-toggle.min.css">

  <style type="text/css">
    .h:hover{color: red }
  </style>
</head>
<body class="theme-blue-grey" onload="fungsikode(); focusMethod(); ">

  <!-- Search Bar -->
  <?php
  $pages = @$_GET['pages'];
  $aksianggota = @$_GET['aksianggota'];
  $aksiuser = @$_GET['aksiuser'];
  $aksikoleksi = @$_GET['aksikoleksi'];
  ?>

  
  <!-- Top Bar -->
  <nav class="navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand" href="/Human_Resources/">HUMAN RESOURCES </a>
      </div>
      <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right" >
          <!-- Call Search -->
          <li class="pull-right"><a href="?pages=logout" onclick="return confirm('Apakah Anda Yakin Akan Keluar dari Halaman ini??')" class="js-right-sidebar" data-close="true"><i class="h material-icons">power_settings_new</i></a></li>
          <!-- #END# Call Search -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- #Top Bar -->
  <!-- sidebare -->
  <?php require 'pages/parts-index/sidebar.php'; ?>
  <!-- sidebar -->
  <section class="content" >

    <div class="container-fluid">

      <!-- Widgets -->
      <div class="row clearfix">
        <?php

        if ($pages == 'pinjaman') 
        {
         include 'pages/transaksi/tambah_pinjaman.php';
       }elseif ($pages =='anggota') 
       {
        if ($aksianggota == 'tambah') 
        {
          include 'pages/tambah-anggota.php';
        }else{
         include 'pages/anggota.php';
       }
     }elseif ($pages =='kategori') 
     {
       include 'pages/kategori.php';
     }elseif ($pages =='koleksi') 
     {
      if ($aksikoleksi == 'tambah') 
      {
        include 'pages/koleksi/tambah_koleksi.php';
      }else{
       include 'pages/koleksi/data_koleksi.php';
      }
     }elseif ($pages == 'hapus') 
     {
       include 'pages/functions/hapus.php';
     }elseif ($pages == 'ubah') 
     {
       include 'pages/ubah-anggota.php';
     }elseif ($pages == 'ubahkat') 
     {
       include 'pages/ubahkategori.php';
     }elseif ($pages == 'kunjungan') 
     {
       include 'pages/kunjungan/datakunjungan.php';
     }
     elseif ($pages == 'userdata') 
     {
       include 'pages/user/datauser.php';
     }

     elseif($pages == 'about'){
      include 'pages/about.php';
     }

     elseif($pages == 'absensi'){
      include 'pages/absensi.php';
     }
    

     elseif ($pages == 'tambahuser') 
     {
       include 'pages/user/tambahdatauser.php';
     }elseif ($pages == 'ubahuser') 
     {
       include 'pages/user/ubahuser.php';
     }elseif ($pages == 'logout') 
     {
       require 'pages/functions/logout.php';
     }elseif ($pages == 'procode') {
       require 'proseskode.php';
     }elseif ($pages == 'ubahkoleksi') {
       require 'pages/koleksi/ubah_koleksi.php';
     }elseif ($pages == 'loaddata') {
       require 'pages/transaksi/loaddata.php';    
     }elseif($pages == 'batalkanTransaksi'){
        require 'pages/transaksi/unset_transaksi.php';
     }elseif ($pages == 'tambahtransaksi') {
       require 'pages/transaksi/inserttransaksi.php';
     }elseif ($pages == 'daftarTransaksi') {
       require 'pages/transaksi/daftarTransaksi.php';
     }elseif ($pages =="usulan") {
       include 'pages/kunjungan/usulankoleksi.php';
     }
     else
     {
      include 'pages/dashboard.php';
    }
    
    ?>
  </div>
  <!-- #END# Widgets -->
  <!-- modals -->
  <?php include 'pages/parts-index/modals/print_agt.php'; 
        include 'pages/parts-index/modals/modal_input_kode.php';
        include 'pages/parts-index/modals/print_koleksi.php';
        include 'pages/parts-index/modals/modalTransaksi.php';
        include 'pages/parts-index/modals/modal_kunjungan.php';
  ?>
  <!-- end modals -->
</div>
</section>
<?php include 'pages/print/printkartu.php'; ?>

    <!--#END# card -->




<!-- Bootstrap Core Js -->
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Select Plugin Js -->
<!-- <script src="assets/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->

<!-- Slimscroll Plugin Js -->
<script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

<!-- Waves Effect Plugin Js -->
<script src="assets/plugins/node-waves/waves.js"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="assets/plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<!-- <script src="assets/js/pages/tables/jquery-datatable.js"></script> -->

<!-- swicth toggle -->
<script src="assets/js/bootstrap-toggle.min.js"></script>

<!-- Custom Js -->
<script src="assets/js/admin.js"></script>
<script src="assets/js/demo.js"></script>
<script src="assets/js/script.js"></script>

  <!-- these js files are used for making PDF -->
  <script src="assets/js/jspdf.js"></script>
  <script src="assets/js/pdfFromHTML.js"></script>

</body>

</html>