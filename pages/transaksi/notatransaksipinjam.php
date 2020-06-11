<?php 
session_start();
require '../../config/+konfigurasi.php';
require '../../config/koneksi.php'; 
require '../../pages/functions/functions.php';
require '../../pages/functions/select.php';
$lihat = mysqli_query($conn, "SELECT tb_temp.*, tbkoleksi.judul  FROM tb_temp 
	JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi WHERE no_transaksi = '".$_GET['no']."'"); 

$ass = mysqli_fetch_assoc($lihat);

// echo "string";

// echo $_SESSION['noiden'];

?>

<!DOCTYPE html>
<html>

<head >
	<style type="text/css">
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>SiSiPut | INVOICE PINJAMAN</title>
	<!-- Favicon-->
	<!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->

	<!-- Google Fonts -->
	<link href="../../assets/css/fontgogleapis.css" rel="stylesheet" type="text/css">
	<link href="../../assets/css/gicon.css" rel="stylesheet" type="text/css">
	<!-- online goole icon -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Bootstrap Core Css -->
	<link href="../../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Waves Effect Css -->
	<link href="../../assets/plugins/node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css -->
	<link href="../../assets/plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- Custom Css -->
	<link href="../../assets/css/admin.css" rel="stylesheet">

	<!-- JQuery DataTable Css -->
	<link href="../../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="../../assets/css/themes/all-themes.css" rel="stylesheet" />

	<!-- MENU JQUERY -->
	<script type="text/javascript" src="../../assets/plugins/jquery/jquery.js"></script>

	<!-- Jquery Barcode -->
	<script type="text/javascript" src="../../assets/js/jquery-barcode.js"></script>

	<!-- font awesome -->
	<link href="../../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<!-- toggle switch -->
	<link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-toggle.min.css">
	<style type="text/css">
		@page { size: 21.0cm 29.7cm;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;  margin-top:0; margin-left: 30px}
		@media print { body {size: 21.0cm 29.7cm;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px; } }
		body { font-size: 50% }
		tr {padding: 5px}
		div .header {padding: 0px;}

		.table th {
			padding: 0px;
			margin: 0px;

		}
		td, ol {font-weight: normal;}
	</style>

</head>
<body  style="width: 70%" onload="window.print()">
	<table align="center" style="margin-top: 20px;">
		<tr>
			<th width="48%">
				<!-- kartu member tampak dari depan -->
				<div class="card" style="border-radius: 10px; border: 2px solid grey;">
					<div class="header" align="center" style=" padding: 0px; margin:0;border-bottom: 1px solid black">
						<table align="center" style="">
							<th style="padding: 5px">
								<img src="../../gambar/LGP.png" class="img-circle" alt="Cinque Terre" width="" height="25"></th> 
							</th>
							<th style="font-size: 50%">
								<h2 align="center">Nota Transaksi Pinjaman Koleksi<br><small align="center">STIE Satya Dharma Singaraja</small></h2>
							</th>                        
						</table>

					</div>
					<div class="body">
						<div class="row" style="font-size: 80%">
							<div class="col-sm-6">
								<table>
									<tr>
										<th >No Pinjam :</th>
										<td> <?= $ass['no_transaksi']?></td>

									</tr>
									<tr>
										<th >No Anggota : </th>
										<td ><?= $ass['id_sesion'] ?></td>
									</tr>
									
								</table>
							</div>
							<!-- |||||||||||||||||||||||| -->
							<div class="col-sm-6">
								<table class="table">
									<tr>
										<th>No</th>
										<th>Kode</th>
										<th>Judul</th>
										<th>jumlah</th>
										<th>Status</th>
									</tr>
									<?php 
									$no = 1;
									$datas = mysqli_query($conn, "SELECT tb_temp.*, tbkoleksi.judul  FROM tb_temp 
										JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi WHERE no_transaksi = '".$_GET['no']."'"); 
										foreach ($datas as $row):?>
										<tr>
											<td><?= $no; ?></td>
											<td><?= $row['kode_koleksi'] ?></td>
											<td valign="top"><?= $row['judul'] ?></td>
											<td><?=  $row['jumlah'] ?></td>
											<td><?= $row['status_trans'] ?></td>
										</tr>
										<?php $no++; endforeach; ?>
										<tr>
											<!-- hitung total -->
											<?php $jml = mysqli_query($conn, "SELECT SUM(jumlah) AS jml FROM tb_temp WHERE no_transaksi = '".$_GET['no']."'"); 
											$total = mysqli_fetch_assoc($jml);
											?>
											<td></td>
											<td></td>
											<td align="right">Total :</td>
											<td ><?= $total['jml']; ?></td>
											<td></td>
										</tr>
										<tr>
											<?php 
											// hitung denda
											$lihat = mysqli_query($conn, "SELECT tb_temp.*, tbkoleksi.judul  FROM tb_temp 
												JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi WHERE no_transaksi = '".$_GET['no']."'"); 

											$ass = mysqli_fetch_assoc($lihat);
											 // hitung denda
											$hitunghari = 0;
											$tgl_tempo = $ass['tgl_kembali'];
											$tgl_skrg = date('Y-m-d');
											if (abs(strtotime($tgl_skrg) < strtotime($tgl_tempo))) {
												$tgl_tempo = date('Y-m-d');
											}
											$hitunghari = abs(strtotime($tgl_skrg) - strtotime($tgl_tempo));
											$hari = $hitunghari/(60 * 60 * 24);

											?>
											<?php 

                							// denda
											$totalPinjam = $total['jml'];
											$dendaPerkoleksi = $totalPinjam * 2000;
											$dendaPerhari = $dendaPerkoleksi * $hari;
											$denda_rupiah = number_format($dendaPerhari,0,',','.');

											?>
											<td></td>
											<td></td>
											<td align="right">Denda :</td>
											<td >Rp. </td>
											<td><?= $denda_rupiah ?></td>
										</tr>
									</table>
								</div>
								<table width="100%">
									<tr>
										<th>
											<div style="margin: 8px; border: 2px solid grey; border-radius: 10px; width: 50%; font-size: 70%">
												<u style="margin-left: 15px">Penting</u>
												<ol>
													<li>Apa bila Pengembalian tidak disertai nota akan dikenakan biaya tambahan Rp. 2000</li>
													<li>Keterlambatan Pengembalian akan dikenakan denda Sebeasar Rp. 2000 perkoleksi</li>
													<li>Keterlambatan Pengembalian dihitung perhari Rp.2000</li>
												</ol>
											</div>
										</th>
										<th style=" width: 30%">
											<div class="responsive pull-right" align="center" style="margin-right: 10px; font-weight: normal;">
												<?php echo "Singaraja, ". date("d/m/Y")."<small><br>Kepala Perpustakaan</small><br>"?>
												<img src="../../ttd.png" width="30" height="20" ><br>

												<small><u>Ni Komang Hermawati</u></small>
											</div>
										</th>
									</tr>
								</table>
							</div>

						</div>

					</body>
					</html>





