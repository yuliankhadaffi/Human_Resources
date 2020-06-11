<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>location.href='../login.php';</script>";
  exit;
}
require '../config/+konfigurasi.php';
require '../config/koneksi.php'; 
require '../pages/functions/functions.php';
require '../pages/functions/select.php';

//ambil data dari URL
$id = $_GET["id"];
// query data anggota bedasarkan id
$agt = query("SELECT * FROM tbanggota WHERE idanggota = '$id'")[0];

?>
<!DOCTYPE html>
<html>

<head >
	<style type="text/css">
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Human Resources - Kartu Anggota</title>
	<!-- Favicon-->
	<!-- <link rel="icon" href="favicon.ico" type="image/x-icon"> -->

	<!-- Google Fonts -->
	<link href="../assets/css/fontgogleapis.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/gicon.css" rel="stylesheet" type="text/css">
	<!-- online goole icon -->
	<link href="../https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Bootstrap Core Css -->
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- Waves Effect Css -->
	<link href="../assets/plugins/node-waves/waves.css" rel="stylesheet" />

	<!-- Animation Css -->
	<link href="../assets/plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- Custom Css -->
	<link href="../assets/css/admin.css" rel="stylesheet">

	<!-- JQuery DataTable Css -->
	<link href="../assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

	<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="../assets/css/themes/all-themes.css" rel="stylesheet" />

	<!-- MENU JQUERY -->
	<script type="text/javascript" src="../assets/plugins/jquery/jquery.js"></script>

	<!-- Jquery Barcode -->
	<script type="text/javascript" src="../assets/js/jquery-barcode.js"></script>

	<!-- font awesome -->
	<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<!-- toggle switch -->
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap-toggle.min.css">
	<style type="text/css">
		@page { size: 21.0cm 29.7cm;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;  margin-top:0;}
		@media print { body {size: 21.0cm 29.7cm;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;} }
		body { font-size: 50% }
		tr {padding: 5px}
		div .header {padding: 0px;}
	</style>

			<!-- scrip barcode -->
			<script type="text/javascript">
				function fungsinimp() {
					var settings = {
						barWidth: 1,
						barHeight: 50,
						moduleSize: 1,
						showHRI: false,
						addQuietZone: true,
						marginHRI: 5,
						bgColor: "#FFFFFF",
						color: "#000000",
						fontSize: 10,
						output: "css",
						posX: 0,
						posY: 0
					};
// barcode generate
var barr = $("#nimp").val();
$("#valbar").html("").show().barcode( barr, "code128", settings);
};
</script>
<style type="text/css">
/*	th, td, tr {
		border: 1px solid black;
	}*/
	.tengah td {padding-left: 10px; margin-right: 0px; padding-right: 0px; font-weight: normal;}
	.ttd td {font-weight: bold;}
	.tengah {width: 70%; margin-left: 60px}
	.tbatas {width: 100%}
	.body {padding: 0px; margin: 0px}
	.card { width: 350px; height: 220px }
</style>
</head>
<body>
	<table align="center" style="margin-top: 20px;">
		<tr style=" height: 50px">
			<th width="48%">
			<input type="hidden" name="" value="<?= $agt['noidentitas']?>" id="nimp">	
			<!-- kartu member tampak dari depan -->
			<div class="card" style="border-radius: 10px; border: 2px solid grey;">
				<div class="header" align="center" style=" padding: 0px; margin:0;border-bottom: 1px solid grey">
					<table align="center" class="tbatas">
						<th style="padding: 5px;" class="logos">
							<img src="../gambar/tekno.png" class="img-circle" alt="logo" width="" height="30" style=" z-index: 1; margin: 0px 0px 0px 25px"></th> 
						</th>
						<th style="font-size: 50%">
							<h2>Kartu Anggota Kepegawaian<br><small style="margin-left: 40px">Universitas Teknokrat Indonesia</small></h2>
						</th>                        
					</table>
				
				</div>
				<div class="body">
					<img style="position: absolute;" id="viewfoto" src="../gambar/<?= $agt['foto'];?>" class="img-responsive img-thumbnail" alt="Foto Anggota" width="60" height="70">
					<table class="tengah responsive" style="font-size: 70%">

						<tr valign="top">
							<th rowspan="5" style="padding: 0px; padding-right:5px" valign="top">
								
							</th>
							<th valign="top">Nama</th>
							<th width="2%">:</th>
							<td align="left" id="hasilnama"><?= $agt["nama"];?></td>
						</tr>
						<tr>
							<th width="25%">NIM/NIP</th>
							<th width="2%">:</th>
							<td align="left" id="hasilnimp"><?= $agt["noidentitas"];?></td>
						</tr>
						<tr valign="top">
							<th>Instansi</th>
							<th width="2%">:</th>
							<td align="left" id="hasilinstansi"><?= $agt["Instansi"];?></td>
						</tr>
						<tr valign="top">
							<th>Alamat</th>
							<th width="2%">:</th>
							<td style="position: absolute; width: 50%" align="left" id="hasilalamat"><?= $agt["alamat"];?></td>
						</tr>
						<tr>
							<th></th>
							<th></th>
							<td style="font-weight: bold;"><br>
								<br>
								<div class="ttd responsive pull-right" align="center" style="margin-top: -10px; position: static;">
									<?php echo "Bandarlampung, <small>". date("d-m-Y")."</samll><small><br>Kepala HRD</small><br>"?>
									<img src="../gambar/stamplebaru.jpg" width="50" height="30" style="z-index: -1" ><br>

									<small><u>Administrator</u></small>
								</div>
							</td>
						</tr>
					</table>

				</div>

			</div>
			</th>
			<div style="padding: 3px"></div>
				<th align="right" class="pull-right">
			<!-- kartu member tampak dari belakang -->
				<div class="card" style="border-radius: 10px; padding: 0px; border: 2px solid grey;  height: 219px">
					<div class="body" style=" padding: 0px; margin: 5px;">
						<h3 style="margin-top: -2px"><u>Catatan</u></h3>
						<br>
						<div style="font-size: 70%; margin-top: -15px; left: 150px; text-align: justify; padding-right: 5px" >
							<ol>
								<li>Kartu Anggota ini harus dibawa setiap pergi ke kantor.</li>
								<li>Tanpa kartu anggota anda tidak diperbolehkan memasuki area kantor dan tidak dapat menggunakan fasilitas.</li>
								<li>Apabila ditemukan terjadinya kecurangan, maka akan dikenakan sanksi denda.</li>
								
							</ol>
						</div>
						<br>
						
			
						<table style="padding: 0px; margin-top:-20px; width: 100%" >
							<th class="pull-right">
								<div class="pull-right" id="valbar">

									<script type="text/javascript">
										fungsinimp();
									</script>

								</div>
							</th>
						</table>
					</div>
					

				</div>
			</div>
		</div>
</div>
</th>
</tr>
</table>
</body>
</html>