<?php 
	
	global $conn;
	if (isset($_POST['transaksi'])) {
		$s_data = mysqli_query($conn, "SELECT * FROM tb_temp, tbkoleksi WHERE id_sesion='".@$_SESSION['no_iden']."' AND tb_temp.kode_koleksi=tbkoleksi.kode_koleksi");
		$row = mysqli_fetch_assoc($s_data);

		

	}

 ?>