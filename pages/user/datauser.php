
<style type="text/css">
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

	.panel-title:hover{
		opacity: 0.5;
	}
	.btn-tamkat:hover{
		transform: scale(1.3); transition: 0.8s;
	}
	.table-responsive{
		overflow-x:hidden;	 
	}

</style>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="card">
		<div class="header">
			<?php if ($_SESSION['level']=="Web Master"): ?>
				<a href="?pages=tambahuser" class="btn btn-primary waves-effect">Tambah Data User</a>
			<?php else: ?>
				<h2>Data Admin</h2>
			<?php endif ?>
			
		</div>
		<div class="body">
			<div class="table-responsive">

				<table id="tabeluser" class="table display table-striped table-hover dataTable">

					<thead style="background: #f5f5f0; font-size: 100%">
						<tr>
							<th style="background: #DCDCDC;">Aksi</th>
							<th>No</th>
							<th>Username</th>
							<th>Password</th>
							<th>Email</th>
							<th>Level</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$no = 1;
						foreach ($user as $row) :
							?>
							<tr>
								<td style="background: #DCDCDC;" width="10" height="10">
									<!-- edit action -->
									<div id="edit" class="aksi btn-group btn-group-justified" role="group" aria-label="Justified button group">
										<!-- AKSI EDIT -->
										<a href="?pages=ubahuser&id=<?= $row["iduser"]?>" class="expan btn btn-xs bg-cyan waves-effect">
											<li class="fa fa-edit"></li>    
										</a>


										<?php if ($_SESSION['level']=="Web Master"): ?>
											
											<?php if ($row['level']!= "Web Master"): ?>
												<!-- AKSI HAPUS -->
												<a href="?pages=hapus&iduser=<?= $row["iduser"]?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini???');" class="btn btn-xs bg-red waves-effect"><li class="fa fa-trash-o"></li></a>

											<?php endif ?>											

										<?php endif ?>
									</div>
									<!-- END AKSI EDIT -->
								</td>
								<td><?= $no; ?></td>
								<td><?= $row["username"]; ?></td>
								<td>********</td>
								<td><?= $row["email"]; ?></td>
								<td><?= $row["level"]; ?></td>
								<?php $no++; ?>
							<?php endforeach; ?>
						</tr>							
					</tbody>
				</table>
			</div>
		</div>
	</div>