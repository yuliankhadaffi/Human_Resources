<?php
session_start();

require '../../config/+konfigurasi.php';
require '../../config/koneksi.php'; 
require '../../pages/functions/functions.php';
require '../../pages/functions/select.php';
$del = mysqli_query($conn, "DELETE FROM tb_temp WHERE id_sesion = '".@$_SESSION['no_iden']."' AND status_trans ='' AND (status_trans <> 'Dikembalikan')"); 

unset($_SESSION['no_iden']);
unset($_SESSION['nama']);
echo "<script>location.href='../../?pages=pinjaman';</script>";
?>