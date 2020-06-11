<?php


$carikode = mysqli_query($conn, "SELECT max(no_transaksi) from tb_temp") or die (mysql_error());
  // menjadikannya array
$datakode = mysqli_fetch_array($carikode);
  // jika $datakode
if ($datakode) {
 $nilaikode = substr($datakode[0], 1);
   // menjadikan $nilaikode ( int )
 $kode = (int) $nilaikode;
   // setiap $kode di tambah 1
 $kode = $kode + 1;
 $kode_otomatis = "P".str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
 $kode_otomatis = "P0001";
}


function isi_keranjang(){
    global $conn;
    $isikeranjang = array();
    $sid = @$_SESSION['no_iden'];
    $sql = mysqli_query($conn, "SELECT * FROM tb_temp WHERE id_sesion='$sid'");

    while ($r=mysqli_fetch_assoc($sql)) {
        $isikeranjang[] = $r;
    }
    return $isikeranjang;
}
$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);
for ($i = 0; $i < $jml; $i++){
    // print_r($isikeranjang[$i]['id_sesion'].$isikeranjang[$i]['status']);
}

$sid = @$_SESSION['no_iden'];
$sqld = mysqli_query($conn, "SELECT id_sesion,tgl_pinjaman ,CURRENT_DATE() AS tgl_sekarang, DATEDIFF(CURRENT_DATE(), tgl_pinjaman) AS selisih FROM tb_temp WHERE id_sesion = '$sid';");





while ($rd=mysqli_fetch_assoc($sqld)) {
    // $hasil = $rd['selisih'] - 7;
    // print_r($hasil.'<br>');
    $denda = 2000;
    $total = @$hasil * 2000;
    // print_r($total.'<br>');


}

$isikeranjang = isi_keranjang();
$jml = count($isikeranjang);
for ($i = 0; $i < $jml; $i++){
    // print_r($isikeranjang[$i]['id_sesion'].$isikeranjang[$i]['status']);
}




if (isset($_POST['subanggota'])) {

    $no_anggota = @$_POST['noanggota'];
    $view = mysqli_query($conn, "SELECT idanggota, noidentitas, nama FROM tbanggota 
        WHERE noidentitas = '$no_anggota'");

    $roww = mysqli_fetch_assoc($view);
    if ($no_anggota != $roww['noidentitas']) {
        echo "<script>window.alert('Maaf, Nomor Anggota Tidak Terdaftar');window.location=('?pages=pinjaman');</script>";
        return false;
    }else{
        $_SESSION['nama'] = $roww['nama'];
        $_SESSION['no_iden'] = $roww['noidentitas'];
        $_SESSION['idanggota'] = $roww['idanggota'];
        echo "<script>window.location=('?pages=pinjaman')</script>";
    }

    for ($i = 0; $i < $jml; $i++){
        if ($isikeranjang[$i]['id_sesion'] = @$_POST['noanggota'] && $isikeranjang[$i]['status_trans'] = 'Pinjam') {

        }
    }

}

// tanggalan pinjaman pengembalian
$pinjam            = date("Y-m-d");
$tujuh_hari        = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
$kembali        = date("Y-m-d", $tujuh_hari);

if (isset($_POST['update_total'])) {

    $count = count(@$_POST['id_temp']);
    for($i=0;$i<$count;$i++)
    {

        mysqli_query($conn, "UPDATE tb_temp SET jumlah='".$_POST['qty'][$i]."'
            WHERE id_temp ='".$_POST['id_temp'][$i]."'") or die (mysqli_error($conn));
    }
}

$q_tempp = mysqli_query($conn, "SELECT * FROM tb_temp WHERE id_sesion = '$sid' AND status_trans <> 'Dikembalikan' ");
$hasil_temp = mysqli_fetch_assoc($q_tempp);


if (isset($_POST['nanti'])) {
   unset($_SESSION['no_iden']);
   unset($_SESSION['nama']);
   echo "<script>window.location=('?pages=pinjaman');</script>";
}


if (isset($_POST['transaksi'])) {
    $count = count(@$_POST['id_temp']);
    for($i=0;$i<$count;$i++){
        if (@$_POST['status'][$i]=="Dikembalikan" && @$_POST['status'][$i]!="Diperpanjang") {
           $qkoleks = mysqli_query($conn, "UPDATE tbkoleksi SET sisa_copies = sisa_copies + 1 WHERE id_koleksi = '".$_POST['kode_kol'][$i]."'") or die (mysqli_error($conn));

       }
       
   }
   if (!empty($_POST['status'])) 
   {
    $count = count(@$_POST['id_temp']);
    for($i=0;$i<$count;$i++)
    {


        $qry =  mysqli_query($conn, "UPDATE tb_temp SET status_trans = '".$_POST['status'][$i]."' 
            WHERE id_temp ='".$_POST['id_temp'][$i]."'") or die (mysqli_error($conn));
            // if ($_POST['status']=="Dikembalikan") {
            //     mysqli_query($conn, "UPDATE tbkoleksi SET sisa_copies = sisa_copies + 1 WHERE kode_koleksi = '".$_POST['kode_kol'][$i]."'");
        if ($qry) {

            mysqli_query($conn, "UPDATE tb_temp SET tgl_pinjaman = '".$pinjam."', tgl_kembali = '".$kembali."', no_transaksi = '$kode_otomatis' 
                WHERE id_temp ='".$_POST['id_temp'][$i]."' AND status_trans = 'Diperpanjang'") or die (mysqli_error($conn));
        }


    }
    echo "<script>window.alert('Transaksi Berhasil disimpan');window.location=('?pages=pinjaman');</script>";
}else{

    $cekp = mysqli_query($conn, "SELECT COUNT(*) AS jml FROM tb_temp WHERE status_trans ='' AND id_sesion = '$sid'");
    $tada = mysqli_fetch_assoc($cekp);
    if ($tada['jml'] > 3) {
        echo "<script>window.alert('Transaksi Pijaman Tidak Boleh Lebih dari 3 Koleksi'); window.location=('?pages=pinjaman');</script>";
        return false;
    }
    $count = count(@$_POST['id_temp']);
    for($i=0;$i<$count;$i++)
    {



        $qry =  mysqli_query($conn, "UPDATE tb_temp SET status_trans = 'Dipinjam', tgl_transaksi = now(),
            tgl_pinjaman = '".$pinjam."', tgl_kembali = '".$kembali."', no_transaksi = '$kode_otomatis'
            WHERE id_temp ='".$_POST['id_temp'][$i]."'") or die (mysqli_error($conn));

    // if ($query) {
    //     query("UPDATE tbkoleksi SET sisa_copies = sisa_copies - 1 WHERE kode_koleksi = '".$_POST['kode_kol'][$i]."'");
    // }



    }

    if (@$qry) {

        echo "<script>window.alert('Transaksi Berhasil disimpan'); window.location=('?pages=pinjaman');</script>";
    }else{
      echo "<script>window.alert('Pastikan Anda Sudah Input Koleksi');window.location=('?pages=pinjaman');</script>";  
  }

}
unset($_SESSION['no_iden']);
unset($_SESSION['nama']);

}





?>
<style type="text/css">
    .aksi a
    {
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

<!-- FORM INPUT -->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="card">
        <div class="header">

            <h2>
                <?php if ($hasil_temp['status_trans']== 'Dipinjam'): ?>
                    Form <a href="?pages=daftarTransaksi">Transaksi</a> Pengembalian
                <?php else: ?>
                    Form <a href="?pages=daftarTransaksi">Transaksi</a> Pinjaman
                <?php endif ?>

            </h2>
            <?php 
            $q = mysqli_query($conn, "SELECT * FROM tb_temp WHERE status_trans <> 'Dikembalikan'");
            ?>
            <!-- PEMBATALAN TRANSAKSI -->
            <!-- <form method="POST" action="pages/transaksi/unset_transaksi.php">
                <ul class="header-dropdown m-r--5">
                    <?php if ($hasil_temp['status_trans']== '' || $hasil_temp['status_trans']== 'Dikembalikan'): ?>
                        <button type="submit" name="batalkan" class="btn btn-link col-red">Batalkan Transaksi</button>
                        <!-- <a href="?pages=batalkanTransaksi" onclick="return confirm('Apakah Anda Yakin Membatalkan Transaksii???');" class="col-red waves-red pull-right">Batalkan Transaksi</a>              -->   
                    <?php endif ?>

                </form>  
            </ul>
        </div>
        <div class="body">
            <?php if ($hasil_temp['status_trans']== '' || $hasil_temp['status_trans']== 'Dikembalikan'): ?>

                <form id="form_validation" method="POST" class="formku">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="noanggota" id="noanggota" min="0" required
                                    <?php if (!empty($_SESSION['no_iden'])): ?>
                                        disabled="true"
                                    <?php else: ?>
                                     autofocus="true"
                                 <?php endif ?>

                                 >
                                 <label class="form-label">Nomor Anggota</label>
                             </div>
                         </div>
                     </div>
                     <button type="submit" name="subanggota" hidden=""></button>
                 </form>
                <!-- <div class="col-sm-2">
                    <label style="font-weight: normal; margin-top: 17px">
                        <input type="checkbox" name="cektransaksi" id="cektransaksi" >
                    </label>Ubah Peminjam
                </div> -->
                <form id="form_validation" method="GET" class="formu" action="/sisiput/">
                    <div class="col-sm-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="hidden" name="pages" value="loaddata">
                                <input type="hidden" name="aksi" value="tambah">
                                <input type="text" id="kodekoleks" class="form-control" name="kode" required autofocus="true" >
                                <label class="form-label">Kode Koleksi</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <button style="margin-top: 5px" type="submit" id="tambah" class="btn btn-primary waves-effect">Tambah</button>
                    </div>
                </div>
            </form>
        <?php endif ?>
        <!-- TAMBAH  KE TRANSAKSI -->
        <form method="post">
            <table style="font-size: 97%" id="tabeltransaksi" class="table display table-striped table-hover dataTable">
                <thead style="background: #f5f5f0; font-size: 100%">
                    <tr style="border-bottom: 2px solid #66afe9">
                        <th colspan="6">Peminjam : <p style="display: inline; font-weight: normal;"><?= @$_SESSION['nama'].' ('.@$_SESSION['no_iden'].')' ?></p>
                            <input type="hidden" name="indentitas_anggota" value="<?= @$_SESSION['no_iden'];?>">
                            <input type="hidden" name="nama_anggota" value="<?= @$_SESSION['nama'];?>">
                            <div class="loaderr"></div>
                        </th>
                    </tr>
                    <?php 
                    $q_temp = query("SELECT * FROM tb_temp, tbkoleksi 
                        WHERE id_sesion='".@$_SESSION['no_iden']."' AND (status_trans <> 'Dikembalikan' AND tb_temp.id_koleksi=tbkoleksi.id_koleksi)");
                    $no = 1;
                    ?>

                    <tr>

                        <th style="background: #DCDCDE;">Aksi</th>                
                        <th>No</th>
                        <th>Kode Koleksi</th>
                        <th>Judul</th>
                        <th>Keterlambatan</th>
                    </tr>
                </thead>
                <tbody id="tbl">
                    <?php 
                    $hitunghari = 0;
                    $tgl_tempo = $hasil_temp['tgl_kembali'];
                    $tgl_skrg = date('Y-m-d');
                    if (abs(strtotime($tgl_skrg) < strtotime($tgl_tempo))) {
                        $tgl_tempo = date('Y-m-d');
                    }
                    $hitunghari = abs(strtotime($tgl_skrg) - strtotime($tgl_tempo));
                    $hari = $hitunghari/(60 * 60 * 24); 

                    ?>
                    <?php foreach ($q_temp as $row): ?>


                        <tr>
                            <?php if ($hasil_temp['status_trans']== '' ): ?>
                                <td align="center" width="10">
                                    <!-- AKSI HAPUS -->
                                    <div id="edit" class="aksi btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                        <a href="?pages=loaddata&aksi=hapus&id=<?= $row["id_temp"]?>&kode=<?= $row['id_koleksi'] ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini???');" class="btn bg-red waves-effect"><li class="fa fa-trash-o"></li>
                                        </a>
                                    </div>
                                </td>
                            <?php else: ?>
                                <td align="center" width="10">

                                    <select style="font-weight: normal;" name="status[]">
                                        <option value="Dikembalikan"
                                        <?php if ($row['status_trans'] == 'Dikembalikan'): ?>
                                            selected
                                        <?php endif ?>
                                        >Dikembalikan</option>
                                        <option value="Diperpanjang"
                                        <?php if ($row['status_trans'] == 'Diperpanjang'): ?>
                                            selected
                                        <?php endif ?>
                                        >Diperpanjang</option>
                                        <option value="Rusak"
                                        <?php if ($row['status_trans'] == 'Rusak'): ?>
                                            selected
                                        <?php endif ?>
                                        >Rusak</option>
                                        <option value="Hilang"
                                        <?php if ($row['status_trans'] == 'Hilang'): ?>
                                            selected
                                        <?php endif ?>
                                        >Hilang</option>
                                        
                                    </select>

                                </td>
                            <?php endif ?>
                            <input type="hidden" name="kode_kol[]" value="<?= $row['id_koleksi']; ?>">
                            <input type="hidden" name="id_temp[]" value="<?= $row['id_temp']?>">
                            <input type="hidden" name="tgl_tempo" value="<?= $row['tgl_kembali']?>">
                            <td><?= $no; ?></td>
                            <td><?= $row['kode_koleksi']; ?></td>
                            <td><?= $row['judul'] ?></td>
                            <td> 
                                <?php 
                                // denda
                                @$totalPinjam = $row['jumlah'];
                                $dendaPerkoleksi = @$totalPinjam * 2000;
                                $dendaPerhari = $dendaPerkoleksi * $hari;
                                $denda_rupiah = "Rp " . number_format($dendaPerhari,0,',','.');
                                if ($hari == 0 || empty($tgl_tempo) ) {
                                    echo "<b style= color:#66afe9;> | Tidak Ada Keterlambatan</b>";
                                }else{

                                    echo '<b style=color:red>'.$hari.'</b> Hari | Denda : '. $denda_rupiah;
                                }
                                ?>

                            </td>

                        </tr>
                        <?php $no++; endforeach ?>


                    </tbody>


                </table>

                <?php 
                $jml_pinjam = mysqli_query($conn, "SELECT SUM(jumlah) AS total FROM tb_temp WHERE id_sesion = '".$sid."' AND status_trans <> 'Dikembalikan'");

                $total_pinjam = mysqli_fetch_assoc($jml_pinjam);

                ?>

                <?php 
                // hitung denda
                $hitunghari = 0;
                $tgl_tempo = $hasil_temp['tgl_kembali'];
                $tgl_skrg = date('Y-m-d');
                if (abs(strtotime($tgl_skrg) < strtotime($tgl_tempo))) {
                    $tgl_tempo = date('Y-m-d');
                }
                $hitunghari = abs(strtotime($tgl_skrg) - strtotime($tgl_tempo));
                $hari = $hitunghari/(60 * 60 * 24);

                ?>
                <?php 

                // denda
                $totalPinjam = $total_pinjam['total'];
                $dendaPerkoleksi = $totalPinjam * 2000;
                $dendaPerhari = $dendaPerkoleksi * $hari;
                $denda_rupiah = "Rp " . number_format($dendaPerhari,0,',','.');


                ?>
                <?php if (!empty($_SESSION['no_iden'])): ?>


                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <label>Total Denda <span style="padding-right: 29px"></span> 
                                <input style="width: 108px; text-align: right; padding-right: 5px" type="text" max="0" readonly name="" 
                                <?php if (empty($tgl_tempo)): ?>
                                    value="0"
                                <?php endif ?>
                                value="<?= $denda_rupiah ?>">
                            </label>
                            <?php if ($hari == 0 || empty($tgl_tempo) ) {
                                echo "<b style= color:#66afe9;> | Tidak Ada Keterlambatan</b>";
                            }

                            ?>
                        </div>

                        <div class="col-sm-6">
                            <div class="pull-right" style="font-weight: bold;">
                                <button type="submit" name="update_total" class="btn btn-circle btn-xs waves-effect" style="width: 20px; height: 20px"><li class="fa fa-refresh"></li></button>
                                TOTAL : 
                                <input style="width: 123px; border: none;" id="totalan" name=""  readonly value="<?= ' '.$total_pinjam['total'].' Koleksi' ?>">
                            </div>
                        </div>
                    </div>


                    <br>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <button style="margin-top: 5px" type="submit" name="transaksi" id="tambah" class="btn btn-primary btn-block waves-effect">
                                <?php if ($hasil_temp['status_trans']== 'Dipinjam'): ?>
                                    Simpan Transaksi 
                                <?php else: ?>
                                    Simpan Transaksi Pinjaman
                                <?php endif ?>

                            </button>
                        </div>
                        <div class="col-sm-6">
                            <button style="margin-top: 5px" type="submit" 
                            onclick="return confirm('Apakah Anda Ingin Menyimpan dan Melanjukan Transaksi Nannti..?')" name="nanti" id="tambah" class="btn btn-warning btn-block waves-effect">
                            Simpan dan Gunakan Transaksi Nanti
                        </button>
                    </div>

                </div>
            <?php endif ?>
        </div>

    </div>
</form>
</div>


</div>
</div>
<script type="text/javascript">
    function total() {
        var valgoritma = 75000 * parseInt(document.getElementById('harga_algoritma').value);
        var vjavascript = 45000 * parseInt(document.getElementById('harga_javascript').value);
        var vphp = 90000 * parseInt(document.getElementById('harga_php').value);

        var jumlah_harga = valgoritma + vjavascript + vphp;

        document.getElementById('total').value = jumlah_harga;
    }

</script>


<!-- 
<script type="text/javascript">
    $(document).ready(function(e) {

        $(".formku").submit(function(e) {

            e.preventDefault();

            var form_data = $(this).serialize();
            var form_url = $(this).attr("action");
            var form_method = $(this).attr("method").toUpperCase();

            $(".loaderr").show();
        // $('#noanggota').focus();
        
        $.ajax({
            url: form_url, 
            type: form_method,      
            data: form_data,     
            cache: false,
            success: function(data){                          
               // var copy = $("#k").html(returnhtml); 
               $('#p_anggota').val($.trim(data));
               $(".loaderr").hide();
               $("#cektransaksi").prop("checked", true); 
               $('#noanggota').prop("readonly", true); 
               $('#kodekoleks').prop("disabled", false);
               $('#kodekoleks').focus();                  
           }           
       });    
        
    });

    });
</script>
<script type="text/javascript">
    $(document).ready(function(e) {
        count = 0;
        $(".formu").submit(function(e) {
            e.preventDefault();

            var form_data = $(this).serialize();
            var form_url = $(this).attr("action");
            var form_method = $(this).attr("method").toUpperCase();

            $(".loaderr").show();
            $('#kodekoleks').val('');

            $.ajax({
                url: form_url, 
                type: form_method,      
                data: form_data,     
                cache: false,
                success: function(data){                    
                    if ($("#tbl").append(data)) {
                        $("#data_kosong").hide();
                    }                
                    $(".loaderr").hide();             
                }           
            });

        });

    });
</script> -->