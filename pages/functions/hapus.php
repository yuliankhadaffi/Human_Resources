<!-- hapus anggota -->
<?php 
if (!isset($_SESSION["login"])) {
	echo "<script>location.href='login.php';</script>";
	exit;
}
$idanggota = @$_GET["idanggota"];
$idkat = @$_GET["idkat"];
$iduser = @$_GET["iduser"];
$foto = @$_GET["potoname"];
$fotokoleksi = @$_GET['fotoKoleksi'];
$idkoleksi  = @$_GET['idkoleksi'];

if ( hapus($idanggota) > 0 ) 
{
	// echo "<script>alert('data berhasil dihapus');</script>";
	echo "<script>location.href='?pages=anggota';</script>";
// }else
// {
// 	echo "<script>alert('data gagal dihapus');</script>";
// 	echo "<script>location.href='?pages=anggota';</script>";
}
// kategori hapus
if ( hapus_kategori($idkat) > 0 ) 
{
	// echo "<script>alert('Data Berhasil dihapus');</script>";
	echo "<script>location.href='?pages=kategori';</script>";
// }else
// {
// 	echo "<script>alert('Data Gagal dihapus');</script>";
// 	echo "<script>location.href='?pages=kategori';</script>";
}
if ($_SESSION['level']!="Web Master") {
	echo "<script>location.href='?pages=userdata';</script>";
}else{
// hapus user
	if (hapus_user($iduser)> 0) 
	{
		echo "<script>location.href='?pages=userdata';</script>";
	}
}
// hapus koleksi
if (hapus_koleksi($idkoleksi) > 0) 
{
	echo "<script>location.href='?pages=koleksi';</script>";
}
?>
