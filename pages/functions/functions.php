<?php 
function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	@$rows = [];
	while (@$row = mysqli_fetch_assoc($result) )
	{
		@$rows[] = @$row; 
	}
	return @$rows;
}

// cek username

// fungsi tambah katgeori
function tambah_user($datauser)
{
	global $conn;
	$username = strtolower(stripcslashes(htmlspecialchars($datauser["username"])));
	$password = mysqli_real_escape_string($conn, $datauser["password"]);


	// cek username
	$cek_user = mysqli_query($conn, "SELECT username FROM tbuser WHERE username = '$username'");
	if (mysqli_num_rows($cek_user) > 0) 
	{
		echo "<script>alert('Gagal Registrasi Username Sudah Terdaftar!!');</script>";
		return false;
	}


	// Password Enkripsi
	$password = password_hash($password, PASSWORD_DEFAULT);

	$password2 = mysqli_real_escape_string($conn, $datauser["password2"]);
	$email = strtolower(htmlspecialchars($datauser["email"]));

	if ($username == "" || $password =="" || $email=="")
	{
		echo "<script>alert('Textbox Belum Terisi!');</script>";
		return false;
	}

	$query = "INSERT INTO tbuser VALUES 
	('', '$username',
	'$password',
	'$email',
	'Pegawai'
)";
mysqli_query($conn, $query);
return mysqli_affected_rows($conn);
}

// hapus data user
function hapus_user($iduser)
{
	global $conn;
	$del = mysqli_query($conn, "DELETE FROM tbuser WHERE iduser = $iduser");
	return mysqli_affected_rows($conn);
}

// fungsi tambah katgeori
function tambah_kategori($datakat)
{
	global $conn;
	
	$nama_kat = htmlspecialchars($datakat["nama"]);
	$kategori = htmlspecialchars($datakat["kategori"]);

	$ceknamkat = mysqli_query($conn, "SELECT nama FROM tbkategori WHERE nama = '$nama_kat'");
	if (mysqli_num_rows($ceknamkat) > 0) 
	{
		echo "<script>alert('Nama Sudah Ada!!');</script>";
		return false;
	}
	$query = "INSERT INTO tbkategori VALUES ('','$nama_kat','$kategori')";
	 
	 //$query = $db->query("INSERT into kategori values('$no','$kode_mk','$npm','$nilai_latihan','$nilai_kuis','$nilai_uts','$nilai_uas')");

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// fungsi tambah katgeori
function tambah_absensi($datakat)
{
	global $conn;
	
	$nama_kat  = htmlspecialchars($datakat["idanggota"]);
	$nama      = htmlspecialchars($datakat["nama"]);
	$instansi  = htmlspecialchars($datakat["instansi"]);
	$pekerjaan = htmlspecialchars($datakat["pekerjaan"]);

	$ceknamkat = mysqli_query($conn, "SELECT nama FROM absensi WHERE nama = '$nama_kat'");
	if (mysqli_num_rows($ceknamkat) > 0) 
	{
		echo "<script>alert('Nama Sudah Ada!!');</script>";
		return false;
	}
	$query = "INSERT INTO absensi VALUES ('','$nama_kat','$nama','$instansi','$pekerjaan')";
	
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// fungsi ubah katgeori
function ubah_kategori($datakat)
{
	global $conn;
	$id = $_GET["id"];
	$nama_kat = htmlspecialchars($datakat["nama"]);
	$kategori = htmlspecialchars($datakat["kategori"]);

	$query = "UPDATE tbkategori SET 
	nama = '$nama_kat', kategori ='$kategori' 
	WHERE idkategori = $id";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

// hapus data kategori
function hapus_kategori($idkat)
{
	global $conn;
	$del = mysqli_query($conn, "DELETE FROM tbkategori WHERE idkategori = $idkat");
	return mysqli_affected_rows($conn);
}

// hapus data koleksi
function hapus_koleksi($idkoleksi)
{
	global $conn;
	$del = mysqli_query($conn, "DELETE FROM tbkoleksi WHERE id = $idkoleksi");
	if ($_GET['fotoKoleksi']!= 1) 
	{

		unlink('gambar/'.$_GET['fotoKoleksi']);
	}
	return mysqli_affected_rows($conn);
}

// functian anggota
function tambah($data)
{
	global $conn;
	$nama = htmlspecialchars($data["nama"]);
	$noidentitas = htmlspecialchars($data["noidentitas"]);
	$instansi = htmlspecialchars($data["Instansi"]);
	$pekerjaan = htmlspecialchars($data["pekerjaan"]);
	$jk = htmlspecialchars($data["jk"]);
	$notlf = htmlspecialchars($data["notlf"]);
	$status = htmlspecialchars($data["status"]);
	$alamat = htmlspecialchars($data["alamat"]);

	// cek nim
	$ceknim = mysqli_query($conn, "SELECT noidentitas FROM tbanggota WHERE noidentitas = '$noidentitas'");
	if (mysqli_num_rows($ceknim) > 0) 
	{
		echo "<script>alert('Gagal Registrasi Nomor Identitas Sudah Terdaftar!!');</script>";
		return false;
	}

	// upload gambar
	$foto = upload();
	if (!$foto) 
	{
		return false;
	}


	if (($status == "")) 
	{
		$query = "INSERT INTO tbanggota 
		VALUES ('', '$nama', '$jk', '$noidentitas', '$instansi', '$alamat', '$notlf', '$pekerjaan', '$foto', 'Tidak Aktif', now())";

	}else
	{
		$query = "INSERT INTO tbanggota 
		VALUES ('', '$nama', '$jk', '$noidentitas', '$instansi', '$alamat', '$notlf', '$pekerjaan', '$foto', '$status', now())";
	}
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function upload()
{
	$namafile = $_FILES['foto']['name'];
	$ukuranfile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];//array error kode 4
	$tmpname = $_FILES['foto']['tmp_name'];

	// apakah yang di upload adalah gambar
	$fotovalid = ['jpg', 'jpeg', 'png'];
	$ekstensifoto = explode('.', $namafile);
	$ekstensifoto = strtolower(end($ekstensifoto));
	if ($ekstensifoto =='' || $fotovalid == '')
	{
		return true;
		
	}elseif (!in_array($ekstensifoto, $fotovalid)) {
		echo "<script>alert('Pastikan yang Anda Upload adalah Gambar, Foto Akan di Kosongkan!');</script>";
		return false;
	}

	// cek ukuran gambar terlalu besar
	if ($ukuranfile > 3000000) 
	{
		echo "<script>alert('Ukuran Gambar Terlalu Besar');</script>";
		return false;
	}

	// lolos seleksi upload
	// genarate nama foto baru biar beda
	$namafilebaru = uniqid();
	$namafilebaru .= '.';
	$namafilebaru .=$ekstensifoto;
	move_uploaded_file($tmpname, 'gambar/'.$namafilebaru);
	return $namafilebaru;
	
}

// hapus anggota
function hapus ($idanggota)
{
	global $conn;
	$del = mysqli_query($conn, "DELETE FROM tbanggota WHERE idanggota = $idanggota");
	if ($del) 
	{
		unlink('gambar/'.$_GET['potoname']);
	}
	return mysqli_affected_rows($conn);
}

function ubah($data)
{
	global $conn;
	$id = $_GET["id"];
	$nama = htmlspecialchars($data["nama"]);
	$noidentitas = htmlspecialchars($data["noidentitas"]);
	$instansi = htmlspecialchars($data["Instansi"]);
	$pekerjaan = htmlspecialchars($data["pekerjaan"]);
	$jk = htmlspecialchars($data["jk"]);
	$notlf = htmlspecialchars($data["notlf"]);
	@$status = htmlspecialchars($data["status"]);
	$alamat = htmlspecialchars($data["alamat"]);
	$fotolama = htmlspecialchars($data["fotolama"]);


	$namafile = $_FILES['foto']['name'];
	$ukuranfile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];//array error kode 4
	$tmpname = $_FILES['foto']['tmp_name'];

	// apakah yang di upload adalah gambar
	$fotovalid = ['jpg', 'jpeg', 'png'];
	$ekstensifoto = explode('.', $namafile);
	$ekstensifoto = strtolower(end($ekstensifoto));

	// cek apakah user mengisi file upload atau tidak 
	if ($namafile === 4 || $ukuranfile > 1000000 || !in_array($ekstensifoto, $fotovalid)) //4 artinya tidak ada file gambar di input
	{
		$foto = $fotolama;
	}else
	{
		unlink('gambar/'.$fotolama);
		$foto = upload();
	}

	if (empty($status)) 
	{
		$query = "UPDATE tbanggota SET 
		nama = '$nama',
		noidentitas = '$noidentitas',
		Instansi = '$instansi',
		pekerjaan = '$pekerjaan',
		jk = '$jk',
		notlf = '$notlf',
		status = 'Tidak Aktif',
		alamat = '$alamat',
		foto = '$foto'
		WHERE idanggota = $id";

		mysqli_query($conn, "UPDATE tb_temp SET id_sesion = '$noidentitas' WHERE id_anggota = '$id'");
	}else
	{
		$query = "UPDATE tbanggota SET 
		nama = '$nama',
		noidentitas = '$noidentitas',
		Instansi = '$instansi',
		pekerjaan = '$pekerjaan',
		jk = '$jk',
		notlf = '$notlf',
		status = '$status',
		alamat = '$alamat',
		foto = '$foto'
		WHERE idanggota = $id";

		mysqli_query($conn, "UPDATE tb_temp SET id_sesion = '$noidentitas' WHERE id_anggota = '$id'");
	}
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
// end finctian crud anggota

// tambah koleksi
function tambah_koleksi($data){
	global $conn;
	$id = ($data["id_text"]);
	$judul = htmlspecialchars(strtoupper(($data["judul"])));
	$kode = htmlspecialchars($data["kode"]);
	$kategori = htmlspecialchars($data["kategori"]);
	$penerbit = htmlspecialchars($data["penerbit"]);
	$koter = htmlspecialchars($data["koter"]);
	$edisi = htmlspecialchars($data["edisi"]);
	$cetakan = htmlspecialchars($data["cetakan"]);
	$penerjemah = htmlspecialchars($data["penerjemah"]);
	$pengarang1 = htmlspecialchars($data["pengarang1"]);
	$tahun = htmlspecialchars($data["tahun"]);
	$pengarang2 = htmlspecialchars($data["pengarang2"]);
	$isbn = htmlspecialchars($data["isbn"]);
	$editor = htmlspecialchars($data["editor"]);
	$jenis = htmlspecialchars($data["jenis"]);
	$deskripsi = htmlspecialchars($data["deskripsi"]);
	$jumlah = htmlspecialchars($data["jumlah"]);
	// $waktu = date("d-m-Y");

	// upload gambar
	$foto = upload();

	$query = "INSERT INTO tbkoleksi 
	VALUES ('', '$id', '$kode', '$isbn', '$judul', '$pengarang1', '$pengarang2', '$editor', '$penerjemah', '$koter', '$penerbit', '$tahun', '$foto', '$jumlah','$jumlah', '$deskripsi', '$jenis', '$kategori', '$cetakan', '$edisi', 'Tersedia', CURDATE())";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubah_koleksi($datakoleks)
{
	global $conn;
	$id = @$_GET["id"];
	$kode = ($datakoleks["kode"]);
	$judul = htmlspecialchars($datakoleks["judul"]);
	$kategori = ($datakoleks["kategori"]);
	$pengarang1 = htmlspecialchars($datakoleks["pengarang1"]);
	$pengarang2 = htmlspecialchars($datakoleks["pengarang2"]);
	$editor = htmlspecialchars($datakoleks["editor"]);
	$penerjemah = htmlspecialchars($datakoleks["penerjemah"]);
	$koter = htmlspecialchars($datakoleks["koter"]);
	$penerbit = htmlspecialchars($datakoleks["penerbit"]);
	$tahun = ($datakoleks["tahun"]);
	$jenis = htmlspecialchars($datakoleks["jenis"]);
	$cetakan = htmlspecialchars($datakoleks["cetakan"]);
	$edisi = htmlspecialchars($datakoleks["edisi"]);
	$deskripsi = htmlspecialchars($datakoleks["deskripsi"]);
	$jumlah = htmlspecialchars($datakoleks["jumlah"]);
	$fotolama = ($datakoleks["fotolama"]);


	$namafile = $_FILES['foto']['name'];
	$ukuranfile = $_FILES['foto']['size'];
	$error = $_FILES['foto']['error'];//array error kode 4
	$tmpname = $_FILES['foto']['tmp_name'];

	// apakah yang di upload adalah gambar
	$fotovalid = ['jpg', 'jpeg', 'png'];
	$ekstensifoto = explode('.', $namafile);
	$ekstensifoto = strtolower(end($ekstensifoto));

	// cek apakah user mengisi file upload atau tidak 
	if ($namafile === 4 || $ukuranfile > 3000000 || !in_array($ekstensifoto, $fotovalid)) //4 artinya tidak ada file gambar di input
	{
		$foto = $fotolama;
	}else
	{
		if ($namafile === 4) {
			return true;
		}
		unlink('gambar/'.$fotolama);
		$foto = upload();
	}

	
	$query = "UPDATE tbkoleksi SET 
	judul = '$judul',
	kategori = '$kategori',
	penerbit = '$penerbit',
	pengarang1 = '$pengarang1',
	pengarang2 = '$pengarang2',
	tahun_terbit = '$tahun',
	jenis_buku = '$jenis',
	penerjemah = '$penerjemah',
	kota_terbit = '$koter',
	cetakan = '$cetakan',
	edisi = '$edisi',
	editor = '$editor',
	deskripsi = '$deskripsi',
	copies = '$jumlah',
	sisa_copies = '$jumlah',
	foto = '$foto'
	WHERE id_koleksi = '".$id."'";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


?>
	