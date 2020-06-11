<?php
// require 'config/+konfigurasi.php';
// require 'config/koneksi.php'; 
// require 'pages/functions/functions.php';


// // membuat query max
// $carikode = mysqli_query($conn, "SELECT max(id_ddc) from tbddc_2") or die (mysql_error());
//   // menjadikannya array
// $datakode = mysqli_fetch_array($carikode);
//   // jika $datakode
// if ($datakode) {
//  $nilaikode = substr($datakode[0], 3);
//    // menjadikan $nilaikode ( int )
//  $kode = (int) $nilaikode;
//    // setiap $kode di tambah 1
//  $kode = $kode + 1;
//  $kode_otomatis = "SM.".str_pad($kode, 4, "0", STR_PAD_LEFT);
// } else {
//  $kode_otomatis = "SM.0001";
// }
// if (isset($_POST['submit'])) {
//   $kode = $_POST['kode'];
//   $query = "INSERT INTO tbddc_2 ('id_ddc') VALUES ('$kode')";
//   $q =  mysqli_query($conn, $query);
//   return mysqli_affected_rows($conn);
//   echo "<script>location.href='koco.php';</script>";
//   }


?>


<!DOCTYPE html>
<html lang="ID">
<head>
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
</head>
<body>
  <h1 class="text-xs-center">Menampilkan Kode Otomatis</h1>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <form method="POST">

          <div class="form-group">
            <label for="">No Penjualan</label>
            <input type="text" class="form-control" name="kode" value="<?php echo $kode_otomatis; ?>">
          </div>
          <div class="form-group">
            <label for="">Nama Barang</label>
            <input type="text" class="form-control">
          </div>

          <div class="form-group">
            <label for="">Jumlah</label>
            <input type="text" class="form-control">
          </div>


          <button type="submit" name="s" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <?php 
    if (isset($_POST['submit'])) {
      $_POST['tes'];

    }
   ?>
  <form method="POST">
    <input type="text" name="tes" placeholder="test">
    <button type="submit" name="submit">submit</button>
  </form>
  <form>
    <input type="text" name="" value="<?php echo $_POST['tes']; ?>">

    
  </form>
</body>
<style>
  body {padding:30px;}
</style>
</html>