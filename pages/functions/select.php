<?php 
global $conn;

// select kategoru
$kategori = query("SELECT * FROM tbkategori");
// select user
if (@$_SESSION['level']=="Web Master") {
	$user = query("SELECT * FROM tbuser ORDER BY level DESC");
}else{
	$user = query("SELECT * FROM tbuser WHERE username = '".$_SESSION['username']."'");
}


if (isset($_POST['okjk'])) {

	if ($_POST['filjk']=="semua") {
		$anggota = query("SELECT * FROM tbanggota ORDER BY tgl_daftar DESC");
	}else{
	
            // select anggota
	$anggota = query("SELECT * FROM tbanggota WHERE jk = '".$_POST['filjk']."'");
}

}else{

	$anggota = query("SELECT * FROM tbanggota ORDER BY tgl_daftar DESC");
}


// koleksi
if (isset($_POST['okkoleks'])) {

	if ($_POST['filkoleks']=="all") {
		$koleksi = query("SELECT * FROM tbkoleksi ORDER BY copies DESC");
	}else{
	$koleksi = query("SELECT * FROM tbkoleksi WHERE kategori = '".$_POST['filkoleks']."'");
	}
}else{
$koleksi = query("SELECT * FROM tbkoleksi ORDER BY copies DESC");
}

$jenis_koleksi = query("SELECT DISTINCT jenis_buku FROM tbkoleksi");

?>