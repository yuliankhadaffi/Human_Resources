<?php 
require '../../config/+konfigurasi.php';
require '../../config/koneksi.php'; 

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Cetak Barcode Koleksi</title>
	<link rel="stylesheet" href="../../report.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!-- MENU JQUERY -->
	<script type="text/javascript" src="../../assets/plugins/jquery/jquery.js"></script>

	<!-- Jquery Barcode -->
	<script type="text/javascript" src="../../assets/js/jquery-barcode.js"></script>

	<style type="text/css">
		@page { 
			margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;  margin-top:0; size: portrait;}
			@media print { 
				body {size: portrait;  margin: 0px 0px 0px 0px; padding: 0px 0px 0px 0px;}  
				html, body {
					
				}
				tr {padding: 5px}

				.tempat {
					margin: 2cm 2cm 2cm 2cm;
				}
				.body{
					width: 15cm;
					height: 3.5cm;


				}

				
			}

			table{
				padding: 10px;
				margin-top: 0.4cm;
				margin-bottom: 1cm;
				margin-left: 80px
				
			}
			th { text-align: center;}

			
			

		</style>

		<!-- scrip barcode -->
		<script type="text/javascript">
// 			function fungsinimp() {
// 				var settings = {
// 					barWidth: 1,
// 					barHeight: 80,
// 					moduleSize: 1,
// 					showHRI: true,
// 					addQuietZone: true,
// 					marginHRI: 5,
// 					bgColor: "#FFFFFF",
// 					color: "#000000",
// 					fontSize: 10,
// 					output: "css",
// 					posX: 0,
// 					posY: 0
// 				};
// // barcode generate
// var barr = $(".nimp").val();
// $(".valbar").html("").show().barcode( barr, "code128", settings);
// };
</script>
</head>
<body onload="fungsinimp(); window.print();  ">
	<div class="tempat">
		<div class="container">
			<div class="row" align="center">
				<?php if (!empty($_POST['cek'])): ?>
					<?php 
					$no = 1; ?>
					<?php foreach ($_POST['cek'] as $check): 
					$sql = mysqli_query($conn, "SELECT * FROM tbkoleksi WHERE id_koleksi = '$check'");
					$row = mysqli_fetch_assoc($sql);
					?>
						<input type="hidden" class="nimp" value="<?= $check ?>">
											<!-- scrip barcode -->
							<script type="text/javascript">
								function fungsinimp() {
									var settings = {
										barWidth: 1,
										barHeight: 80,
										moduleSize: 1,
										showHRI: true,
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
						var barr = $(".nimp").val();
						$(".valbar").html("").show().barcode( barr, "code128", settings);
						};
						</script>
						<div class="col-sm-12" style=" padding: 5px; margin: 2px; text-align: left; width: ">
							<div class="body" style="border: 2px solid grey; border-radius: 10px;">
								<table>
									<tr>
									<th>
										<h5><?php echo $row['kode_koleksi']; ?></h5>
									</th>
									<th rowspan="3" style="width: 410px; ">
										<div class="valbar" style="margin-left: 420px; top: 28px; left: 0px; position: absolute; z-index: -1 "></div>
									</th>
									</tr>

									<tr>
										<td><h4><?= substr(strtoupper( $row['pengarang1']), 0,1).substr(strtolower( $row['pengarang1']), 1,2) ?></h4></td>
									</tr>

									<tr>
										<td><h4><?= substr(strtolower( $row['judul']), 0,1) ?></h4></td>
									</tr>
								</table>
							</div>
							<!-- <span class="text" style="display: block;"></span>
								<span class="valbar" style="margin-left: 20px"></span> -->
							</div>
						<?php $no++; endforeach ?>
					<?php endif ?>

				</div>
			</div>
		</div>
	</body>
	</html>
