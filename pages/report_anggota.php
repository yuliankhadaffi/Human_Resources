<?php
session_start();
if (!isset($_SESSION["login"])) {
  echo "<script>location.href='../login.php';</script>";
  exit;
}
require '../config/+konfigurasi.php';
require '../config/koneksi.php'; 
require '../pages/functions/functions.php';
require '../pages/functions/select.php';

//ambil data dari URL

	// $agt = mysqli_query($conn, "SELECT * FROM tbanggota WHERE tgl_daftar BETWEEN '".$_POST['input_tgl']."' AND '".$_POST['input_tgl2']."' ");
	// $as = mysqli_fetch_assco($agt);	
// query data anggota bedasarkan id
$tgl1 = $_POST['input_tgl'];
$tgl2 = $_POST['input_tgl2'];


// include autoloader
require_once '../dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();



$html ='<html>
    <head>
        <style>
        table {
        	font-size:90%
        }
        td {
        	font-size:80%;
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
			<img src="../gambar/LGP.png" width="55" height="50" align="right" style="margin-top:20px">
		</th>
			<th align="center">
		 <h3 align="center">Laporan Anggota Perpustakan STIE Satya Dharma Singaraja Berdasarkan Perperiode '.date("d-m-Y", strtotime($tgl1)).' s/d '.date("d-m-Y", strtotime($tgl2)).'</h3>
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
            <h5>Jumlah Data Menurut Jenis Kelamin :</h5>
		<table class="table total">
			<tr>
		    <th colspan="2" style="background:#f0f0f0; padding 5px; font-weight:normal; ">Pertanggal '.date("d-m-Y", strtotime($tgl1)).' s/d '.date("d-m-Y", strtotime($tgl2)).'</th>
		    
		  </tr>';

		  $jml = query("SELECT jk,COUNT(*) as jumlah 
				FROM tbanggota
				WHERE tgl_daftar BETWEEN '$tgl1' AND '$tgl2' Group By jk

				UNION ALL

				SELECT 'Total' jk, COUNT(*)
				FROM tbanggota 
				WHERE tgl_daftar BETWEEN '$tgl1' AND '$tgl2' ");

		  foreach ($jml as $total) {
	
		  $html .='
		  <tr>
		    <th>'.$total['jk'].'</th>
		    <td>'.$total['jumlah'].'</td>
		  </tr>';
		}

	$html .='

		</table>
	<br>
	<table class="table detail">
		<tr>
		<th>No</th>
		<th>Nomor Anggota</th>
		<th>Nama</th>
		<th>Instansi</th>
		<th>Nomor tlp</th>
		<th>Jenis Kelamin</th>
		<th>Tgl Daftar</th>
	</tr>';
	
	$agt = query("SELECT * FROM tbanggota WHERE tgl_daftar BETWEEN '$tgl1' AND '$tgl2' ");
	$no = 1;
foreach ($agt as $row){


	$html .='
	<tr>
		<td>'.$no.'</td>
		<td>'.$row['noidentitas'].'</td>
		<td>'.$row['nama'].'</td>
		<td>'.$row['Instansi'].'</td>
		<td>'.$row['notlf'].'</td>
		<td>'.$row['jk'].'</td>
		<td>'.date("d/m/Y", strtotime($row['tgl_daftar'])).'</td>
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
<<!-- tr>
		    <th>Perempuan</th>
		    <td>500</td>
		  </tr>
		  <tr>
		    <th>Total</th>
		    <td>124</td>
		  </tr> -->