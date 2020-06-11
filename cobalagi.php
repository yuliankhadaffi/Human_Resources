<?php 
$conn = mysqli_connect("localhost", "root", "mademadot@", "joooo");

$sel = mysqli_query($conn, "SELECT * FROM tbkoleksi");
$row = mysqli_fetch_assoc($sel);

$cari_kd=mysqli_query($conn, "SELECT max(id_koleksi)as id from tbkoleksi"); //mencari kode yang paling besar atau kode yang baru masuk


    $tm_cari=mysqli_fetch_array($cari_kd);

$kode=substr($tm_cari['id'],2,4); //mengambil string mulai dari karakter pertama 'A' dan mengambil 4 karakter setelahnya. 

$tambah=$kode+1; //kode yang sudah di pecah di tambah 1

    if($tambah<10){ //jika kode lebih kecil dari 10 (9,8,7,6 dst) maka

    $id="K-000".$tambah;

    }else{

    $id="K-00".$tambah;

    }

    foreach ($id as $ide => $id) {
    	mysqli_query($conn, "UPDATE tbkoleksi SET id_koleksi = '$ide' ");
    }
	

 ?>