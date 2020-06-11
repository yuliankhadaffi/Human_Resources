
<?php 
// membuat query max
$carikode = mysqli_query($conn, 
	"SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(kode_koleksi, '.', 1), '.', -1) AS inisial_kode, 
	MAX(SUBSTRING_INDEX(SUBSTRING_INDEX(kode_koleksi, '.', -2), '.', -1)) AS kode   
	from tbkoleksi WHERE SUBSTRING_INDEX(SUBSTRING_INDEX(kode_koleksi, '.', 1), '.', -1) = '".@$_POST['buat_kode']."'") 
or die (mysql_error());
  // menjadikannya array
$datakode = mysqli_fetch_row($carikode);

// cekk apakah tombol sudah ditkekan
if (isset($_POST['submit'])){


	if ( ubah_koleksi($_POST) > 0 ) 
	{
		echo "<script>alert('data berhasil di ubah');</script>";
		echo "<script>location.href='?pages=koleksi';</script>";
	}else
	{
		echo "<script>alert('data gagal di ubah');</script>";
		echo "<script>location.href='?pages=koleksi&aksikoleksi=tambah';</script>";
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
function fungsijudul() {
	var x = document.getElementById("judul").value;
	document.getElementById("hasiljudul").innerHTML = x;
}

// fungsi type string dan barcode
function fungsitahun() {
	var x = document.getElementById("tahun").value;
	document.getElementById("hasiltahun").innerHTML = x;
}


function fungsifoto() {
	var x = document.getElementById("cfoto");
	var y = x.files.item(0).name;
	document.getElementById("namafoto").innerHTML = y;
}
function fungsidesk() {
	var x = document.getElementById("deskripsi").value;
	var str = x.substring(0, 512);
	document.getElementById("hasildesk").innerHTML = str;
}
function fungsikode() {
	var settings = {
		barWidth: 1,
		barHeight: 50,
		moduleSize: 1,
		showHRI: true,
		addQuietZone: true,
		marginHRI: 5,
		bgColor: "#FFFFFF",
		color: "#000000",
		fontSize: 10,
		output: "css",
		prefix:true,
		format:"ean",
		posX: 0,
		posY: 0
	};
// barcode generate
var barr = $("#kode").val() ;
$("#valbar").html("").show().barcode( barr, "code128", settings);
};

function fungsipengarang() {
	var x = document.getElementById("pengarang").value;
	document.getElementById("hasilpengarang").innerHTML = x;
}
function fungsijmlstatus() {
	var x = document.getElementById("jumlah").value;
	document.getElementById("hasilstatus").innerHTML = x;
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
		background-image: url('gambar/cover.png');
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
	.cupload p { display: inline;vertical-align: super;}
	select:hover{cursor: pointer;}
	#kode,#labkode:hover{cursor: pointer;}
</style>
<!-- ENd CSS -->
<!-- FORM INPUT -->
<?php 
//ambil data dari URL
$id = @$_GET["id"];
// query data kategori bedasarkan id
$kolek = query("SELECT * FROM tbkoleksi WHERE id_koleksi = '".$id."'")[0];

?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<div class="card">
		<div class="header">
			<h2>Form Ubah Koleksi</h2>
			<ul class="header-dropdown m-r--5">
				<a href="?pages=koleksi" class="col-cyan waves-effect pull-right">Lihat Data</a>
			</ul>
		</div>
		<div class="body">
			<form id="form_validation" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="fotolama" value="<?= $kolek['foto']; ?>">
				<div class="row clearfix">
					<div class="col-md-4">
						<div class="form-group form-float">
							<div class="form-line ">
								<input type="text"  class="form-control" data-toggle="modal" data-target="#kodeModal" name="kode" id="kode" value="<?= $kolek['kode_koleksi']?>" onkeyup="fungsikode()" readonly="true" required/>
								<label class="form-label" id="labkode" >Klik/Centang Custom Kode</label>
							</div>
						</div>
					</div>
					<div class="col-md-2" style="padding: 0; font-size: 10px; color: grey">
						<div class="form-group form-float">
							<div class="form-line " style="margin-top: 12.5px">

								<input type="checkbox" name="cekkode" > <p style="display: inline;">Custom Kode</p>

							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" id="jenis" class="form-control" name="jenis" value="<?= $kolek['jenis_buku'] ?>" required>
								<label class="form-label">Jenis Koleksi</label>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-float" style="margin-top: 13px">

							<select class="pull-right" name="kategori" required>
								<option value="">Pilih Kategori</option>
								<?php foreach ($kategori as $row) :  ?>
									<option value="<?= $row['kategori']; ?>"><?= $row['kategori'] ?></option>
								<?php endforeach; ?>
							</select>

						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="judul" value="<?= $kolek['judul'] ?>" required>
								<label class="form-label">Judul Koleksi</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="edisi" value="<?=$kolek['edisi']?>" required>
								<label class="form-label">Edisi</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="editor" value="<?=$kolek['editor']?>" required>
								<label class="form-label">Editor</label>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text" class="form-control" name="cetakan" value="<?=$kolek['cetakan']?>" required>
								<label class="form-label">Cetakan</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-3">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text"  class="form-control" value="<?=$kolek['penerbit']?>" name="penerbit">
								<label class="form-label">Penerbit</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text"  class="form-control" value="<?=$kolek['kota_terbit']?>" name="koter">
								<label class="form-label">Kota Terbit</label>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-float">
							<div class="form-line">
								<input type="text"  class="form-control" name="penerjemah" value="<?= $kolek['penerjemah']?>">
								<label class="form-label">Penerjemah</label>
							</div>
						</div>
					</div>
					<div class="col-md-3" >
						<div class="form-group form-float" style="margin-top: 13px; padding:0;">

							<select class="pull-right" name="tahun" id="tahun" onchange="fungsitahun()" required/>
							<option value="<?= $kolek['tahun'] ?>">Tahun Terbit</option>
						</select>

					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-4">
					<div class="form-group form-float">
						<div class="form-line">
							<input type="text" class="form-control" name="pengarang1" value="<?= $kolek['pengarang1'] ?>" required>
							<label class="form-label">Pengarang I</label>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group form-float">
						<div class="form-line">
							<input type="text" class="form-control" name="pengarang2" value="<?= $kolek['pengarang1'] ?>" required>
							<label class="form-label">Pengarang II</label>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group form-float">
						<div class="form-line">
							<input type="text" class="form-control" name="isbn" value="<?= $kolek['isbn'] ?>" required>
							<label class="form-label">ISBN/ISSN</label>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group form-float">
				<div class="form-line">
					<textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control no-resize" oninput="fungsidesk()" required><?= $kolek['deskripsi'] ?></textarea>
					<label class="form-label">Deskripsi/Abstract</label>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group form-float">

					<div style="margin-top: 4px">
						<label class="cupload btn btn-xs bg-blue-grey waves-effect" >
							<li class="material-icons">file_upload</li> <p id="namafoto">Upload Cover </p>
							<input style="display: none;" onchange="fungsifoto()" type="file" id="cfoto" name="foto" accept="image/*" oninput="preview_foto(event)">

						</label>				
					</div>

				</div>
			</div>
			<div class="row clearfix">
				<div class="col-md-4">
					<div class="form-group form-float">
						<div class="form-line">
							<input type="number" class="form-control" name="jumlah" id="jumlah" min="1" value="<?= $kolek['copies'] ?>">
							<label class="form-label">Jumlah Koleksi</label>
						</div>
					</div>
				</div>

			</div>

			<button type="submit" class="btn btn-primary btn-block waves-effect" type="submit" name="submit">Ubah Data</button>
		</form>
	</div>


</div>
<div class="card" style="border-radius: 10px">
	<div class="body" align="center">
		<h2>Barcode</h2>
		<div id="valbar" ></div>
	</div>

</div>
</div>
<!-- #END# FORM INPUT-->

<script>

	for (i = new Date().getFullYear(); i > 1900; i--) {
		$('#tahun').append($('<option />').val(i).html(i));
	}
</script>