<style type="text/css">
	#fomfiljk, .filter select {
		margin-top: -5px;
		margin-bottom: 5px;

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

</style>

<?php 
	if (isset($_POST['okk'])) {
		query("UPDATE tbusulan SET status_usulan = '".$_POST['statusUsulan']."' WHERE idusulan = '".$_POST['id']."'");
		echo "<script>window.alert('Data Usulan Berhasil diubah');
		window.location=('?pages=usulan')</script>";
	}
 ?>
<!-- Basic Examples -->
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">

				<th >
					<h2 style="font-weight: bold;"> Data Usulan Koleksi</h2>
					<hr>
					<div class="body">
						<?php 
						if (isset($_POST['okusulan'])) {
							if ($_POST['filusulan']=="all") {
								$usulan = query("SELECT * FROM tbusulan ORDER BY tgl_usulan DESC");   
							}else{
								$usulan =  query("SELECT * FROM tbusulan WHERE status_usulan ='".$_POST['filusulan']."' ORDER BY tgl_usulan DESC");
							}
						}else{
							$usulan = query("SELECT * FROM tbusulan ORDER BY tgl_usulan DESC");
						}
						?>
						<form method="post">
							<label class="filter">Urutkan Menurut </label><br>
							<select name="filusulan" style="margin-top: -5px">
								<option value="all">--Pilih--</option>
								<option value="Disetujui">Disetujui</option>
								<option value="Tidak dsetujui">Tidak dsetujui</option>
							</select>
							<button type="submit" name="okusulan" class="btn btn-primary btn-xs">ok</button>

						</form>
						<form method="POST" >

							<div class="table-responsive">

								<table style="font-size: 80%" id="tabelanggota" class="table display table-striped table-hover dataTable">
									<thead style="background: #f5f5f0; font-size: 100%">
										<tr>
											<th>No</th>
											<th>No. Anggota</th>
											<th>Judul</th>
											<th>Pengarang</th>
											<th>Keterangan</th>
											<th>Berkunjung</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1;
										foreach ($usulan as $row) :?>
										<tr>
											<td><?= $no; ?></td>
											<td><?= $row['noanggota']?></td>
											<td><?= $row['judul'] ?></td>
											<td><?= $row['pengarang'] ?></td>
											<td><?= $row['keterangan']?></td>
											<td><?= date("d/m/Y",strtotime($row['tgl_usulan'])) ?></td>
											<td>
												<?php 
												if ($row['status_usulan']=='-') {
													echo "<form method='POST'>
													<input type='hidden' value='$row[idusulan]' name='id'>
													<select name='statusUsulan'>
													<option value='Disetujui'>Disetujui</option>
													<option value='Tidak dsetujui'>Tidak dsetujui</option>
													</select>
													<button name='okk' class='btn btn-xs bg-cyan'>ok</button>
													</form>";
												}else{
													echo $row['status_usulan'];
												} 
												?>
												

											</td>
										</tr>
										<?php $no++; endforeach ?>
									</tbody>
								</table>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
<!-- #END# Basic Examples -->