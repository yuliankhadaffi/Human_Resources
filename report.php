

<?php 
// require 'config/+konfigurasi.php';
// require 'config/koneksi.php'; 
// require 'pages/functions/functions.php';
// require 'pages/functions/select.php';

// //ambil data dari URL
// // $id = $_GET["id"];
// // query data anggota bedasarkan id
// $agt = query("SELECT * FROM tbanggota WHERE idanggota = '1'")[0];


// // Require composer autoload
// require_once __DIR__ . '/vendor/autoload.php';

// $html = '
// <body>
// 	<h1>sdfkld</h1>
// 	<img src="pages/function/barcode.php?text=testing" alt="testing" />
// </body>';


// // Create an instance of the class:
// $mpdf = new \Mpdf\Mpdf();

// $stylesheet = file_get_contents('pdf.css');

// $mpdf->WriteHTML($stylesheet,1);
// $mpdf->WriteHTML($html,2);


// // Output a PDF file directly to the browser
// $mpdf->Output();


// include autoloader
require_once 'dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();


$dompdf->loadHtml('pages/ubah-anggota.php');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("Laporan Anggota Perpustakan", array("Attachment" => 0));



?>

