<?php 
                // koleks
    $server = "localhost";
    $user = "root";
    $password = "";
    $nama_database = "human_resources";

    $db = mysqli_connect($server, $user, $password, $nama_database);


    // untuk jumlah karyawan
    $sql = "SELECT COUNT(nama) FROM `tbanggota`";
    $t_anggota = mysqli_query($db, $sql);

    // untuk cuti karyawan
    $sql1 = "SELECT COUNT(nama) FROM `tbkategori`";
    $t_cuti = mysqli_query($db, $sql1);

    // data users
    $sql2 = "SELECT COUNT(email) FROM `tbuser`";
    $t_users = mysqli_query($db, $sql2);

    // untuk absensi
    $sql3 = "SELECT COUNT(nama) FROM `absensi`";
    $t_absen = mysqli_query($db, $sql3);


?>

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-cyan hover-expand-effect">
        <div class="icon">
            <i class="material-icons">account_box</i>
        </div>
        <div class="content">
            <div class="text">TOTAL KARYAWAN</div>
            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"><?= mysqli_num_rows($t_anggota) ?></div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">

    <div class="info-box bg-red hover-expand-effect">
        <div class="icon">
            <i class="material-icons">assignment_ind</i>
        </div>
        <div class="content">
            <div class="text">CUTI KARYAWAN</div>
            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"><?= mysqli_num_rows($t_cuti) ?></div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-light-green hover-expand-effect">
        <div class="icon">
            <i class="material-icons">person_add</i>
        </div>
        <div class="content">
            <div class="text">DATA USERS</div>
            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"><?= mysqli_num_rows($t_users) ?></div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-orange hover-expand-effect">
        <div class="icon">
            <i class="material-icons">forum</i>
        </div>
        <div class="content">
            <div class="text">JUMLAH ABSENSI</div>
            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"><?= mysqli_num_rows($t_absen) ?></div>
        </div>
    </div>
</div>

