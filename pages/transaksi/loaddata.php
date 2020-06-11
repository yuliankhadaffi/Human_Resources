<?php 
$pages=$_GET['pages'];
$aksi =$_GET['aksi'];

if ($pages == 'loaddata' && $aksi == 'tambah') {
	if (empty($_SESSION['no_iden'])) {
		echo "<script>window.alert('Pastikan Nomor Peminjam/Anggota Sudah diinput');
		window.location=('?pages=pinjaman')</script>";
		return false;
		
	}
	$id_S = $_SESSION['no_iden'];
	$id_anggota = $_SESSION['idanggota'];
	global $conn;
	$s_query = mysqli_query($conn, "SELECT sisa_copies, kode_koleksi FROM tbkoleksi WHERE id_koleksi = '".@$_GET['kode']."' AND kategori = 'Buku'");
	$s_row = mysqli_fetch_assoc($s_query);
	$s_query_temp = mysqli_query($conn, "SELECT jumlah FROM tb_temp WHERE kode_koleksi = '".@$_GET['kode']."' AND status_trans <> 'Dikembalikan' ");
	$s_row_temp = mysqli_fetch_assoc($s_query_temp);

	// $tStok = $s_row_temp['jumlah'] + 2;

	if ($s_row['sisa_copies'] == 1){
		echo "<script>window.alert('Stok Koleksi Hanya 1 Tidak Dapat di Pinjam');
		window.location=('?pages=pinjaman')</script>";
	}elseif ($s_row['sisa_copies']==""){
		echo "<script>window.alert('Pastikan Kode Koleksi Dapat dipinjam/Stok Koleksi Tidak tersedia');
		window.location=('?pages=pinjaman')</script>";
	}else{
		// check if the product is already
	// in cart table for this session
		$sql = mysqli_query($conn, "SELECT kode_koleksi FROM tb_temp
			WHERE kode_koleksi='".$_GET['kode']."' AND (id_sesion='".$id_S."' AND status_trans <> 'Dikembalikan')");
		$ketemu = mysqli_num_rows($sql);
		if ($ketemu == 0){

		// put the product in cart table
			mysqli_query($conn, "INSERT INTO tb_temp (id_koleksi,kode_koleksi, jumlah, id_anggota, id_sesion, tgl_pinjaman,status_trans)
				VALUES ('".$_GET['kode']."','".$s_row['kode_koleksi']."', 1, '$id_anggota', '$id_S', CURDATE(),'')");

			mysqli_query($conn,"UPDATE tbkoleksi SET sisa_copies = sisa_copies - 1 WHERE id_koleksi = '".@$_GET['kode']."'");

			
			// // update stok ditable
			// mysqli_query($conn, "UPDATE tbkoleksi SET jumlah = jumlah - 1 WHERE kode_koleksi = '".$_GET['kode']."'");
		} else {
		// update product quantity in cart table
			mysqli_query($conn, "UPDATE tb_temp 
				SET jumlah = 1
				WHERE id_sesion ='".$id_S."' AND (id_koleksi='".$_GET['kode']."' AND status_trans = '')");
				echo "<script>window.alert('Peminjaman Tidak Boleh lebih dari 1 Koleksi yang Sama');
		window.location=('?pages=pinjaman')</script>";		
		}
		echo "<script>location.href='?pages=pinjaman';</script>";
	}				
}elseif ($pages=='loaddata' && $aksi=='hapus'){
	mysqli_query($conn,"UPDATE tbkoleksi SET sisa_copies = sisa_copies + 1 WHERE id_koleksi = '".@$_GET['kode']."'");
	mysqli_query($conn, "DELETE FROM tb_temp WHERE id_temp = '".$_GET['id']."'");
	echo "<script>location.href='?pages=pinjaman';</script>";
	
}
// elseif ($module=='loaddata' AND $aksi=='update'){
//   $id       = $_POST[id];
//   $jml_data = count($id);
//   $stok   = $_POST[stok]; 
//   $jumlah   = $_POST[jml]; // quantity
//   for ($i=1; $i <= $jml_data; $i++){
// 	if ($jumlah[$i] > $stok[$i]){
// 		echo "<script>window.alert('Maaf, Stok Produk Tidak Mencukupi..');
// 			window.location=('keranjang-belanja.html')</script>";
// 	}else{
//     mysql_query("UPDATE orders_temp SET jumlah = '".$jumlah[$i]."'
//                                       WHERE id_orders_temp = '".$id[$i]."'");
// }
// }
// 	header('Location:keranjang-belanja.html');				
// }


// 	print_r($s_query[0]['jumlah']);
?>

