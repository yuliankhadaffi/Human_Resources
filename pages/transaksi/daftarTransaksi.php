<style type="text/css">
	#fomfiljk, .filter select {
		margin-left: 20px

	}
	.filter select{
		font-weight: normal;
	}
	.aksi a
	{
		height: 50px;
		-webkit-transition :1s;
	}
	.aksi:hover 
	{
		transform: scale(1.3);
	}
	.aksi a li:hover
	{
		color: black;
	}
	.foto {border-radius: 5px;}
	.foto
	{
		-webkit-transition :1s; 
	}
	.foto:hover
	{
		transform: scale(2);
	}


</style>
<!-- Basic Examples -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<table class="table table-responsive" >
					<tr>
						<th>
							<a href="?pages=pinjaman" class="btn btn-primary hover">Tambah Data</a>
						</th>
						<th >
							<h2 align="center" style="font-weight: bold;"> Daftar Data Transaksi</h2>
						</th>

						<th>
							<div class="btn-group pull-right">
								<button type="button" class="btn btn-info waves-effect">
									<li class="fa fa-flash"></li>
								</button>
								<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<span class="sr-only">Aksi </span>
									<span class="caret"></span>
								</button>
								<?php 
								$b_edit = @$_GET['aksianggota']=='b_edit';
								$b_cetak = @$_GET['aksianggota']=='b_cetak';
								?>
								<ul class="dropdown-menu">
									<li
									<?php if ($b_cetak): ?>
										class="active"
									<?php endif ?>
									<li><a href="javascript:void(0);" data-toggle="modal" data-target="#TModal" data-color="blue-grey">Cetak Laporan Anggota</a></li>
								</ul>
							</div>
						</div>
					</th>
				</tr>
			</table>

			

			<form method="post" id="fomfiltrans">
				<label class="filter">Status Transaksi</label><br>
				<select name="filtrans">
					<option value="semua">--Pilih Status--</option>
					<option value="Dipinjam">Dipinjam</option>
					<option value="Dikembalikan">Dikembalikan</option>
					<option value="Diperpanjang">Diperpanjang</option>
					<option value="Rusak">Rusak</option>
					<option value="Hilang">Hilang</option>
				</select>
				<button type="submit" name="oktrans" class="btn btn-primary btn-xs waves-effect">ok</button>


			</form>


			<div class="body">

				<div class="table-responsive">

					<table style="font-size: 80%" id="tabelanggota" class="table display table-striped table-hover dataTable">

						<thead style="background: #f5f5f0; font-size: 100%">
							<tr>
								<th style="background: #DCDCDC;">Aksi</th>
								<th>No</th>
								<th>No. Transaksi</th>
								<th>Kode</th>
								<th>Judul</th>
								<th>No. Anggota</th>
								<th>Jumlah</th>
								<th>Tgl Pinjam</th>
								<th>Tgl Kembali</th>
								<th>Keterlambatan</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php							
							

							
							if (isset($_POST['oktrans'])) {
								if ($_POST['filtrans']=="semua") {
									$lihat = query("SELECT tb_temp.*, tbkoleksi.judul  FROM tb_temp JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi ORDER BY tb_temp.tgl_pinjaman DESC"); 
								}else{
									$lihat = query("SELECT tb_temp.*, tbkoleksi.judul FROM tb_temp JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi WHERE tb_temp.status_trans = '".$_POST['filtrans']."'");
								}

							}else{
								$lihat = query("SELECT tb_temp.*, tbkoleksi.judul  FROM tb_temp JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi ORDER BY tb_temp.tgl_pinjaman DESC"); 
							}
							$no=1;
							foreach ($lihat as $row):

								?>
								<tr>
									<td style="background: #DCDCDC;">
										<!-- edit action -->
										<div id="edit" class="aksi btn-group btn-group-justified" role="group" aria-label="Justified button group">

											<a href="pages/transaksi/notatransaksipinjam.php?no=<?= $row['no_transaksi'] ?>" class="btn btn-xs bg-deep-orange waves-effect" target="_blank">
												<i class="material-icons">print</i>
											</a>

										</div>
									</td>
									<td width="5px"><?= $no.'.' ?></td>

									<td ><?= $row['no_transaksi'] ?></td>
									<td><?= $row['kode_koleksi'] ?></td>
									<td width="50%"><?= $row['judul'] ?></td>
									<td><?= $row['id_sesion'] ?></td>
									<td><?= $row['jumlah'] ?></td>
									<td><?= date("d/m/Y", strtotime($row['tgl_pinjaman'])) ?></td>
									<td><?= date("d/m/Y", strtotime($row['tgl_kembali'])) ?></td>
									<?php 
											// hitung Keterlambatan
									$hitunghari = 0;
									$tgl_tempo = $row['tgl_kembali'];
									$tgl_skrg = date('Y-m-d');
									if (abs(strtotime($tgl_skrg) < strtotime($tgl_tempo))) {
										$tgl_tempo = date('Y-m-d');
									}
									$hitunghari = abs(strtotime($tgl_skrg) - strtotime($tgl_tempo));
									$hari = $hitunghari/(60 * 60 * 24); 

									// denda
									@$totalPinjam = $row['jumlah'];
									$dendaPerkoleksi = @$totalPinjam * 2000;
									$dendaPerhari = $dendaPerkoleksi * $hari;
									$denda_rupiah = "Rp " . number_format($dendaPerhari,0,',','.');

									?>
									<td>
										<?php 
										if ($hari == 0 ||  empty($tgl_tempo)) {
											echo "Tidak Ada Keterlambatan";
										}else{
											echo $hari.' Hari | Denda : '. $denda_rupiah ;
										}
										?>
										
									</td>
									<td><?= $row['status_trans'] ?></td>

								</tr>



								<?php $no++; endforeach ?>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- #END# Basic Examples -->
	<!-- Exportable Table -->
