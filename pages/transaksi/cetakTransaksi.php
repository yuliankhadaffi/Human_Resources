<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>location.href='../login.php';</script>";
  exit;
}
require '../../config/+konfigurasi.php';
require '../../config/koneksi.php'; 
require '../../pages/functions/functions.php';
require '../../pages/functions/select.php';

$tgl1 = $_POST['input_tgl1'];
$tgl2 = $_POST['input_tgl2'];


// include autoloader
require_once '../../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();



$html ='<html>
    <head>
        <style>
        table {
        	font-size:80%
        }
        td {
        	font-size:70%;
        }
        table td, th { }
        th h3 {
			padding: 0px;
			margin:0px;
			margin-right:100px
		}
		.table-header th, td{
			border:none
		}
		h5 {
			padding: 0px;	
		}

		.table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			padding: 3px;
    		text-align: left;	
		}
		.table .detail {
			width:100%;
		}
		.detail th { background:#f0f0f0 }

		footer {
                position: absolute;
                z-index:-1; 
                bottom: 0cm; 
                left: 0cm; 
                right: 2cm;
                height: -0.5cm;

                /** Extra personal styles **/
                text-align: right;
                
            }
            /** 
                Set the margins of the page to 0, so the footer and the header
                can be of the full height and width !
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 6cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
    
                text-align: center;
                line-height: 1cm;
            }

           
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table align="center" class="table-header" width="80%" style="border-bottom:2px solid black;">
		<tr style="border:none">
		<th >
			<img src="../../gambar/LGP.png" width="55" height="50" align="right" style="margin-top:20px">
		</th>
			<th align="center">
		 <h3 align="center">Laporan Data Transaksi Perpustakan STIE Satya Dharma Singaraja Berdasarkan Perperiode '.date("d-m-Y", strtotime($tgl1)).' s/d '.date("d-m-Y", strtotime($tgl2)).'</h3>
		 	</th>
	 	</tr>
	 </table>
        </header>

        <footer style="text-align:center; margin-right:-13cm"> 
		  <div >
			<p >Singaraja, '.date("d-m-Y").'<small><br>Kepala Perpustakaan</small></p><br>
			<br>
			<br>

		<small><u>Ni Komang Hermawati</u></small>
		</div>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <h5>Jumlah Data Transaksi :</h5>
		<table class="table total">
			<tr>
		    <th colspan="5" style="background:#f0f0f0; padding 5px; font-weight:normal; ">Pertanggal '.date("d-m-Y", strtotime($tgl1)).' s/d '.date("d-m-Y", strtotime($tgl2)).'</th>

		    
		  </tr>
		  <tr>
		  	<th>Dipinjam</th>
		  	<th>Dikembalikan</th>
		  	<th>Rusak</th>
		  	<th>Hilang</th>
		  	<th>Total Data</th>
		  </tr>
		  ';

		  $dipinjam = query("SELECT COUNT(status_trans) as total_dipinjam FROM tb_temp
		  	WHERE status_trans = 'Dipinjam' OR status_trans = 'Diperpanjang' AND tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'")[0];

		  $dikembalikan = query("SELECT COUNT(status_trans) as total_kembali FROM tb_temp
		  	WHERE status_trans = 'Dikembalikan' AND tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'")[0];

		   $rusak = query("SELECT COUNT(status_trans) as total_rusak FROM tb_temp
		  	WHERE status_trans = 'Rusak' AND tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'")[0];

		    $Hilang = query("SELECT COUNT(status_trans) as total_hilang FROM tb_temp
		  	WHERE status_trans = 'Hilang' AND tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'")[0];

		  	$totaldata= query("SELECT COUNT(*) as total_data FROM tb_temp
		  	WHERE tgl_transaksi BETWEEN '$tgl1' AND '$tgl2'")[0];

		  // foreach ($transaksi as $rowot) {
			
		  $html .='
		  <tr>
		  	<th>'.$dipinjam['total_dipinjam'].'</th>
		    <th>'.$dikembalikan['total_kembali'].'</th>
		    <th>'.$rusak['total_rusak'].'</th>
		    <th>'.$Hilang['total_hilang'].'</th>
		    <th>'.$totaldata['total_data'].'</th>
		  </tr>';
		// }
		// $totalan =  query("");

		// foreach ($totalan as $total) {
		// $html .='
		//   <tr>
		//   	<th>Total</th>
		//     <td></td>
		//     <td></td>
		//   </tr>';
		// }

	$html .='
	
		
		</table>
	<br>
	<h4>Data Transaksi Perperiode :</h4>
	<table class="table detail">
		<tr>
		<th>No</th>
		<th>No Transaksi</th>
		<th>Kode</th>
		<th>Judul</th>
		<th>No Anggota</th>
		<th>Qty</th>
		<th>Tgl Pinjam</th>
		<th>Tgl Kembali</th>
		<th>Keterlambatan</th>
		<th>Status</th>
	</tr>';
	
	$q = query("SELECT tb_temp.*, tbkoleksi.judul  FROM tb_temp JOIN tbkoleksi ON tb_temp.kode_koleksi = tbkoleksi.kode_koleksi WHERE tb_temp.tgl_transaksi 
		BETWEEN '$tgl1' AND '$tgl2' ORDER BY status_trans = 'Dipinjam' DESC");
	$no = 1;
foreach ($q as $row){
			// hitung Keterlambatan
		$hitunghari = 0;
		$tgl_tempo = $row['tgl_kembali'];
		$tgl_skrg = date('Y-m-d');
		if (abs(strtotime($tgl_skrg) < strtotime($tgl_tempo))) {
			$tgl_tempo = date('Y-m-d');
		}
		$hitunghari = abs(strtotime($tgl_skrg) - strtotime($tgl_tempo));
		$hari = $hitunghari/(60 * 60 * 24); 

		// denda
		@$totalPinjam = $row['jumlah'];
		$dendaPerkoleksi = @$totalPinjam * 2000;
		$dendaPerhari = $dendaPerkoleksi * $hari;
		$denda_rupiah = "Rp " . number_format($dendaPerhari,0,',','.');


	$html .='
	<tr>
		<td>'.$no.'</td>
		<td>'.$row['no_transaksi'].'</td>
		<td>'.$row['kode_koleksi'].'</td>
		<td>'.$row['judul'].'</td>
		<td>'.$row['id_sesion'].'</td>
		<td>'.$row['jumlah'].'</td>
		<td>'.date("d/m/Y", strtotime($row['tgl_pinjaman'])).'</td>
		<td>'.date("d/m/Y", strtotime($row['tgl_kembali'])).'</td>
		<td>';

			if ($hari == 0 ||  empty($tgl_tempo)) {
				$html .='Tidak Ada Keterlambatan';
			}else{
				$html .=  $hari.' Hari | Denda : '. $denda_rupiah;
			}
								

		$html .='</td>
		<td>'.$row['status_trans'].'</td>
	</tr>';
	$no++;
}
	
	$html .= '</table>
        </main>
    </body>
</html>';

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Laporan Anggota Perpustakan", array("Attachment" => 0));



?>