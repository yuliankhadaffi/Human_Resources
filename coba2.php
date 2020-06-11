<!-- <!-- <!-- <!-- <?php 
    // setcookie('jos', '', time() -3600);
 ?>
<!DOCTYPE html>
<html>
<style>
#myDIV {
    width: 100%;
    padding: 50px 0;
    text-align: center;
    background-color: lightblue;
    margin-top: 20px;
    display:none;
}
/*.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 110%;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 100%;
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent black transparent transparent;
}*/

</style>
<body>

<p>A function is triggered when the user releases a key in the input field. The function transforms the character to upper case.</p>
<form method="post" onsubmit="return myFunction()" action="tes.php">
Enter your name: <input type="text" id="fname">
RE-Enter your name: <div>
<input type="text" id="fname2" onkeyup="myFunction()">
<span class="tooltiptext">Tooltip text</span>
</div>
<button type="submit">klik</button>
<div id="myDIV">
password tidak sama
</div>
</form>

<script>
function myFunction() {
	var s = document.getElementById("myDIV");
    var x = document.getElementById("fname").value;
    var y = document.getElementById("fname2").value;
    if (y !== x) {
        s.style.display = "block";
        return false;
    }else{
    s.style.display = "none";
    }
}
</script>

</body>
</html> -->
<?php
//index.php
//include autoloader

// require_once 'dompdf/autoload.inc.php';

// // reference the Dompdf namespace

// use Dompdf\Dompdf;

// //initialize dompdf class

// $dompdf = new Dompdf();

// $html = '
//  <style>
// table {
//     font-family: arial, sans-serif;
//     border-collapse: collapse;
//     width: 100%;
// }

// td, th {
//     border: 1px solid #dddddd;
//     text-align: left;
//     padding: 8px;
// }

// tr:nth-child(even) {
//     background-color: #dddddd;
// }
// </style>
// <table>
//   <tr>
//     <th>Company</th>
//     <th>Contact</th>
//     <th>Country</th>
//   </tr>
//   <tr>
//     <td>Alfreds Futterkiste</td>
//     <td>Maria Anders</td>
//     <td>Germany</td>
//   </tr>
//   <tr>
//     <td>Centro comercial Moctezuma</td>
//     <td>Francisco Chang</td>
//     <td>Mexico</td>
//   </tr>
//   <tr>
//     <td>Ernst Handel</td>
//     <td>Roland Mendel</td>
//     <td>Austria</td>
//   </tr>
//   <tr>
//     <td>Island Trading</td>
//     <td>Helen Bennett</td>
//     <td>UK</td>
//   </tr>
//   <tr>
//     <td>Laughing Bacchus Winecellars</td>
//     <td>Yoshi Tannamuri</td>
//     <td>Canada</td>
//   </tr>
//   <tr>
//     <td>Magazzini Alimentari Riuniti</td>
//     <td>Giovanni Rovelli</td>
//     <td>Italy</td>
//   </tr>
// </table>
// ';

// $document->loadHtml($html);
// $page = file_get_contents("cat.html");

//$document->loadHtml($page);

// $connect = mysqli_connect("localhost", "root", "", "testing1");

// $query = "
//  SELECT category.category_name, product.product_name, product.product_price
//  FROM product 
//  INNER JOIN category 
//  ON category.category_id = product.category_id
// ";
// $result = mysqli_query($connect, $query);

// $output = "
//  <style>
// table {
//     font-family: arial, sans-serif;
//     border-collapse: collapse;
//     width: 100%;
// }

// td, th {
//     border: 1px solid #dddddd;
//     text-align: left;
//     padding: 8px;
// }

// tr:nth-child(even) {
//     background-color: #dddddd;
// }
// </style>
// <table>
//  <tr>
//   <th>Category</th>
//   <th>Product Name</th>
//   <th>Price</th>
//  </tr>
// ";

// while($row = mysqli_fetch_array($result))
// {
//  $output .= '
//   <tr>
//    <td>'.$row["category_name"].'</td>
//    <td>'.$row["product_name"].'</td>
//    <td>$'.$row["product_price"].'</td>
//   </tr>
//  ';
// }

// $output .= '</table>';

//echo $output;

// $dompdf->loadHtml($html);

// //set page size and orientation

// $dompdf->setPaper('A4', 'landscape');

// //Render the HTML as PDF

// $dompdf->render();

// //Get output of generated pdf in Browser

// $dompdf->stream("Webslesson", array("Attachment"=>0));
// //1  = Download
//0 = Preview

?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>ok</title>



    
</head>
<body onload='fungsinimp()''>
    <div class='frame'>
        <table class='header' align='center'>

            <th>
                <img src='gambar/LGP.png' class='img-circle' alt='Logo STIE' width='40' height='35'></th> 
            </th>
            <th>
                <h2 align='center'>Kartu Anggota Perpustakaan<br><small align='center'>STIE Satya Dharma Singaraja</small></h2>
            </th>  
        </table>
        <hr>
        <table style='padding: 10px; font-size:60%; text-align:left;'>

            <tr>
                <th rowspan='5' width='20%' style='padding:0px; text-align:center;' valign='top' >
                    <img style='border-radius:2px' src='gambar/".$agt['foto']."' alt='Foto Anggota' width='60' height='63'>
                </th>
                <th valign='top'>Nama</th>
                <th width='2%' valign='top'>:</th>
                <td align='left'>".$agt['nama']."</td>
            </tr>
            <tr>`
                <th width='25%'>NIM/NIP</th>
                <th width='2%'>:</th>
                <td align='left'>".$agt['noidentitas']."</td>
            </tr>
            <tr valign='top'>
                <th>Instansi</th>
                <th width='2%'>:</th>
                <td align='left'>".$agt['Instansi']."</td>
            </tr>
            <tr valign='top'>
                <th>Alamat</th>
                <th width='2%'>:</th>
                <td align='left'>".$agt["alamat"]."</td>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <td>
                
                    <div style='float:right;'>
                        Singaraja, ". date("d-m-Y")."<br>

                        <img style='margin-left:30px;' src='ttd.png' width='25' height='20' ><br>

                        <small><u>Ni Komang Hermawati</u></small>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class='frame' style='font-size:60%; '>
                    <div class='body'>
                        <h2><u>Catatan</u></h2>
                        <br>
                        <div style='text-align:left;'>
                            <ol>
                                <li>Kartu Anggota ini harus dibawa setiap kunjungan, pinjaman, pengembalian keperpustakaan.</li>
                                <li>Tanpa kartu anggota, kunjungan, pinjaman, pengembalian tidak dilayani.</li>
                                <li>Pengembalian lewat dari batas waktunya akan dikenakan denda.</li>
                                <li>Waktu pinjaman lamanya 7 hari dan dapat diperpanjang 7 hari lagi bila tidak ada yang memesannya.</li>
                            </ol>
                        </div>
                        <br>
                        <table width='100%'>
                            <th>
                            
                            </th>
                        </table>
                    </div>
    </div>
                            <center><div style='height: 30%; width: 50%;'>;
                            <p><img src="ttd.png"/></p>
                            <img src="pages/function/barcode.php?text=testing" alt="testing" />
                            </div></center>
</body>
</html>