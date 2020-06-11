

<?php 
// cekk apakah tombol sudah ditkekan
if (isset($_POST['submit'])){



    if ( tambah($_POST) > 0 ) 
    {
        echo "<script>alert('data berhasil di tambahkan');</script>";
        echo "<script>location.href='?pages=anggota';</script>";
    }else
    {
        echo "<script>alert('data gagal di tambahkan');</script>";
        echo "<script>location.href='?pages=anggota';</script>";
    }
}
?>
<script>

    function preview_foto(event) 
    { 

       var reader = new FileReader();
       reader.onload = function()
       {
        var output = document.getElementById('viewfoto');
        output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
// fungsi type string dan barcode
function fungsinama() {
    var x = document.getElementById("nama").value;
    document.getElementById("hasilnama").innerHTML = x;
}

function fungsinimp() {
    var settings = {
        barWidth: 1,
        barHeight: 50,
        moduleSize: 1,
        showHRI: false,
        addQuietZone: true,
        marginHRI: 5,
        bgColor: "#FFFFFF",
        color: "#000000",
        fontSize: 10,
        output: "css",
        posX: 0,
        posY: 0
    };
// barcode generate
var barr = $("#nimp").val() ;
document.getElementById("hasilnimp").innerHTML = barr;
$("#valbar").html("").show().barcode( barr, "code128", settings);
};

function fungsiinstansi() {
    var x = document.getElementById("instansi").value;
    document.getElementById("hasilinstansi").innerHTML = x;
}

function fungsialamat() {
    var x = document.getElementById("alamat").value;
    document.getElementById("hasilalamat").innerHTML = x;
}
</script>
<!-- Style css -->
<style>
    .atas tr th
    {
        padding:4px;
    }
    .tengah tr th, td {
        padding: 5px;
        text-align: left;
        font-size: 65%;

    }
    .tengah tr th img {
        margin-top: 0px;
    }
    .tengah tr th
    {
        text-align: top;
    }
    .fview 
    {
        background-image: url('gambar/no-photo.jpg');
        height: 100px;
        width: 80px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: 70px;
    }
    @media screen and (max-width: 520px) 
    {
        .fview 
        {
            width: 50px; height: 50px; transition: 0.5s;
            background-size: 20px;
        }

    }
    /*.fview:hover { width: 50px; height: 40px; transition: 0.5s; }*/
    .ttd 
    {
        text-align: center;
    }
    .isicatatan ol li 
    {
        font-size: 90%;
    }
    .barcode 
    {
        border: 1px solid lightgreen;
    }
    .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
    .toggle.ios .toggle-handle { border-radius: 40px; }
</style>
<!-- ENd CSS -->
<!-- FORM INPUT -->
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="header">
            <h2>Form Anggota</h2>
            <ul class="header-dropdown m-r--5">
                <a href="?pages=anggota" class="col-cyan waves-effect pull-right">Lihat Data</a>
            </ul>
        </div>
        <div class="body">
            <form id="form_validation" method="POST" enctype="multipart/form-data">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" id="nama" class="form-control" name="nama" oninput="fungsinama()" required>
                        <label class="form-label">Nama Lengkap...</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="number" class="form-control" name="noidentitas" id="nimp" oninput="fungsinimp()" min="0" required>
                        <label class="form-label">Nomor Identitas KTP/NIP...</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" oninput="numberOnly(this.id);" id="tlf" min="0" class="form-control" name="notlf"  required maxlength="12">
                        <label class="form-label">Nomor Telpon Aktif...</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="Instansi" id="instansi" oninput="fungsiinstansi()"  required>
                        <label class="form-label">Instansi...</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" required>
                        <label class="form-label">Pekerjaan...</label>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <p class="col-grey" style="padding-bottom: 2px;"">Jenis Kelamin</p>
                        <label class="tempat_radio col-grey">Laki-Laki
                          <input type="radio" name="jk" value="Laki-Laki">
                          <span class="checkmark"></span>
                      </label>

                      <label class="tempat_radio col-grey">Perempuan
                          <input type="radio" name="jk" value="Perempuan">
                          <span class="checkmark"></span>
                      </label>
                  </div>    

                  <div class="col-sm-6">            
                    <div class="pull-right" style="margin:0px">
                        <p class="col-grey">Status</p>
                        <input align="right" name="status" data-toggle="toggle" data-size="mini" data-on="Aktif" data-off="Tidak Aktif" data-onstyle="info" data-offstyle="danger" type="checkbox" value="Aktif"  checked>
                    </div>
                </div>
            </div>

            <div class="form-group form-float">
                <div class="form-line">
                    <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control no-resize" oninput="fungsialamat()" required></textarea>
                    <label class="form-label">Alamat...</label>
                </div>
            </div>
            <div class="form-group">
                <p for="foto" class="col-grey">Upload Foto Disini...</p>
                <input type="file" id="foto" name="foto" accept="image/*" onchange="preview_foto(event)" required>                                    
            </div>
            <button class="btn btn-primary btn-block waves-effect" type="submit" name="submit">Tambah Data</button>
        </form>
    </div>
    

</div>
</div>
<!-- #END# FORM INPUT-->

<!-- Kartu anggota -->
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">
        <div class="header">
            <h2 align="center">Desain Kartu Anggota</h2>
            <hr>
            <div class="body" style="padding: 0px;">
                <!-- kartu member tampak dari depan -->
                <div class="card" style="border-radius: 10px;">
                    <div class="header" align="center">
                        <table align="center" class="atas">
                            <th>
                                <img src="gambar/tekno.png" class="img-circle" alt="Logo STIE" width="50" height="45"></th> 
                            </th>
                            <th>
                              <h2 align="center">Kartu Anggota Kepegawaian<br><small align="center">Universitas Teknokrat Indonesia</small></h2>
                          </th>                        
                      </table>
                      <ul class="header-dropdown m-r--5"></ul>
                  </div>
                  <div class="body responsive">
                    <table widht ="100%" class="tengah responsive">
                      <tr valign="top">
                        <th rowspan="5" width="20%" style="padding:0px;" valign="top">
                            <img id="viewfoto" class="img-thumbnail fview" alt="Foto Anggota">
                        </th>
                        <th valign="top">Nama</th>
                        <th width="2%">:</th>
                        <td align="left" id="hasilnama"></td>
                    </tr>
                    <tr>
                        <th width="25%">KTP/NIP</th>
                        <th width="2%">:</th>
                        <td align="left" id="hasilnimp"></td>
                    </tr>
                    <tr valign="top">
                        <th>Instansi</th>
                        <th width="2%">:</th>
                        <td align="left" id="hasilinstansi"></td>
                    </tr>
                    <tr valign="top">
                        <th>Alamat</th>
                        <th width="2%">:</th>
                        <td align="left" id="hasilalamat"></td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <td>
                            <div class="ttd responsive pull-right">
                                <?php echo "Bandarlampung, ". date("d-m-Y")."<br><small>Kepada HRD</small><br>"?>
                               <img src="../gambar/stamplebaru.jpg" width="50" height="30" style="z-index: -1" ><br>

                                <small><u>Administrator</u></small>
                            </div>
                        </td>
                    </tr>
                </table>

            </div>

        </div>
        <!-- akhir kartu member tampak dari depan -->

        <!-- kartu member tampak dari belakang -->
        <div class="card" style="border-radius: 10px">
            <div class="body">
                <h2><u>Catatan</u></h2>
                <br>
                <div class="isicatatan">
                    <ol>
                       <li>Kartu Anggota ini harus dibawa setiap pergi ke kantor.</li>
                       <li>Tanpa kartu anggota anda tidak diperbolehkan memasuki area kantor dan tidak dapat menggunakan fasilitas.</li>
                        <li>Apabila ditemukan terjadinya kecurangan, maka akan dikenakan sanksi denda.</li>
                    </ol>
                </div>
                <br>
                <table width="100%">
                    <th><div class="pull-right" id="valbar" ></div></th>
                </table>
            </div>

        </div>
        <!-- akhir kartu member tampak dari belakang -->
    </div>
</div>

                <!--#END# card -->