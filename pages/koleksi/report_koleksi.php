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

$tgl1 = $_POST['tgl1'];
$tgl2 = $_POST['tgl2'];
$jenis = $_POST['jenis'];


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
        	font-size:85%
        	margin-top:2cm;
        }
        td {
        	font-size:55%;
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
                position:absolute;
                
                
                margin-bottom:-1.5cm;
                left: 0cm; 
                // right: 2cm;
                // height: -0.5cm;

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
                margin-bottom: 4cm;
            }

            /** Define the header rules **/
            header {
                margin-top:-3cm;
                top: 0cm;
                margin-bottom:1cm;
                left: 0cm;
                right: 0cm
                height: 2cm;

                /** Extra personal styles **/
    
                text-align: center;
                line-height: 1cm;
                repeat-on-break:none;
            }

           
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <table align="center" class="table-header" width="75%">
		<tr >
		<th  >
			<img src="../../gambar/logoper.png" width="80" height="80" align="right" style="margin-top:25px">
		</th>
			<th align="center">
		 <h2 align="center" style=" font-family: Arial, Helvetica, sans-serif; font-weight:bold;">Laporan Data Koleksi Perpustakaan STIE Satya Dharma Singaraja Berdasarkan Perperiode '.date("d-m-Y", strtotime($tgl1)).' s/d '.date("d-m-Y", strtotime($tgl2)).'</h2>
		 	</th>
	 	</tr>
	 </table>
	 <hr style="width:100%">
        </header>

        

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <h5>Jumlah Data Kategori Koleksi :</h5>
		<table class="table total">
			<tr>
		    <th colspan="3" style="background:#f0f0f0; padding 5px; font-weight:normal; ">Pertanggal '.date("d-m-Y", strtotime($tgl1)).' s/d '.date("d-m-Y", strtotime($tgl2)).'</th>

		    
		  </tr>
		  <tr>
		  	<th>Kategori</th>
		  	<th>Copies</th>
		  	<th>Tersisa</th>
		  </tr>
		  ';
		  
		  if (!empty($jenis)) {
		  	$katot = query("SELECT jenis_buku, SUM(copies) AS copies, SUM(sisa_copies) AS sisa FROM tbkoleksi WHERE jenis_buku = '".$jenis."' AND (tgl_update BETWEEN '".$tgl1."' AND '".$tgl2."') group by jenis_buku ");
		  }else{
		  $katot = query("SELECT kategori, SUM(copies) AS copies, SUM(sisa_copies) AS sisa FROM tbkoleksi WHERE tgl_update BETWEEN '$tgl1' AND '$tgl2' group by kategori ");
		  }

		  foreach ($katot as $rowot) {
			
		  $html .='
		  <tr>
		  	';

		  	if (!empty($jenis)) {
		  		$html .='<td>'.$rowot['jenis_buku'].'</td>';
		  	}else{
		  		$html .='<td>'.$rowot['ka'].'</td>';
		  	}

		  $html .='
		    <td>'.$rowot['copies'].'</td>
		    <td>'.$rowot['sisa'].'</td>
		  </tr>';
		}
		$totalan =  query("SELECT 'Total',SUM(copies) AS totalcop, SUM(sisa_copies) AS sisatot FROM tbkoleksi WHERE tgl_update BETWEEN '$tgl1' AND '$tgl2' ");

		foreach ($totalan as $total) {
		$html .='
		  <tr>
		  	<th>Total</th>
		    <td>'.$total['totalcop'].'</td>
		    <td>'.$total['sisatot'].'</td>
		  </tr>';
		}

	$html .='
	
		
		</table>
	<br>
	<h4>Data Koleksi Perperiode :</h4>
	<table class="table detail">
		<tr>
		<th>No</th>
		<th>kode</th>
		<th>Jenis</th>
		<th>Judul</th>
		<th>Pengarang I</th>
		<th>Pengarang II</th>
		<th>Penerjemah</th>
		<th>Editor</th>
		<th>Terbit</th>
		<th>Edisi</th>
		<th>Cet</th>
		<th>ISBN/SN</th>
		<th>Copies</th>
		<th>Tersisa</th>
	</tr>';
	if (!empty($jenis)) {
		$q = query("SELECT * FROM tbkoleksi WHERE jenis_buku = '".$jenis."' AND (tgl_update BETWEEN '".$tgl1."' AND '".$tgl2."')");
	}else{
		$q = query("SELECT * FROM tbkoleksi WHERE tgl_update BETWEEN '$tgl1' AND '$tgl2'");
	}
	$no = 1;
foreach ($q as $row){


	$html .='
	<tr>
		<td>'.$no.'</td>
		<td>'.$row['kode_koleksi'].'</td>
		<td>'.$row['jenis_buku'].'</td>
		<td>'.$row['judul'].'</td>
		<td>'.$row['pengarang1'].'</td>
		<td>'.$row['pengarang2'].'</td>
		<td>'.$row['penerjemah'].'</td>
		<td>'.$row['editor'].'</td>
		<td>'.$row['penerbit'].", ".$row['kota_terbit'].", ".$row['tahun_terbit'].'</td>
		<td>'.$row['edisi'].'</td>
		<td>'.$row['cetakan'].'</td>
		<td>'.$row['isbn'].'</td>
		<td>'.$row['copies'].'</td>
		<td>'.$row['sisa_copies'].'</td>
	</tr>';
	$no++;
}
	
	$html .= '</table>
        </main>
        <footer style="text-align:center; margin-right:-25cm"> 
		  <div >
			<p >Singaraja, '.date("d-m-Y").'<small><br>Kepala Perpustakaan</small></p><br>
			<br>
			<br>

		<small><u>Ni Komang Hermawati</u></small>
		</div>
        </footer>
    </body>
</html>';

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('legal', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Laporan Koleksi Perpustakan", array("Attachment" => 0));



?>
