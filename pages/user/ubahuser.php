<?php 
// cekk apakah tombol sudah ditkekan
if (isset($_POST['submit'])){

   $password = $_POST['password'];   

   $result = mysqli_query($conn, "SELECT * FROM tbuser WHERE iduser= '".@$_GET['id']."'");

                // cek username
   if (mysqli_num_rows($result) === 1) 
   {
                    // cek password
    $row = mysqli_fetch_assoc($result);
    if (password_verify($_POST['passwordlama'], $row["password"]))
    {
            // Password Enkripsi
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE tbuser SET password = '$password', email = '".$_POST['email']."' WHERE iduser= '".@$_GET['id']."'");
        if ($_SESSION['level']=="Web Master") {
            echo "<script>alert('data berhasil di diubah');</script>";
            echo "<script>location.href='?pages=userdata';</script>";
        }else{
            echo "<script>alert('data berhasil di diubah');</script>";
            echo "<script>location.href='?pages=logout';</script>";
        }
        

    }

    $error = true;
}
}
?>
<?php 
//ambil data dari URL
$id = $_GET["id"];
// query data anggota bedasarkan id
$datauser = query("SELECT * FROM tbuser WHERE iduser = $id")[0];

?>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">

        <div class="header">
            <h2>Form Tambah Data User Administrator</h2>
            <ul class="header-dropdown m-r--5">
                <a href="?pages=userdata" class="col-cyan waves-effect pull-right">Lihat Data</a>
            </ul>
        </div>
        <?php if (isset($error)): ?>
           <div class="animated zoomInDown alert alert-danger alert-dismissible" role="alert" style="border-radius: 10px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            Password Tidak Sesuai!!!
        </div>
    <?php endif ?>
    <div class="body">
        <form id="form_validation" method="POST" autocomplete="on">
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="username" readonly value="<?= $datauser['username']?>" pattern=".{0}|.{3,}"> 
                    <label class="form-label">Username...</label>
                </div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="password" class="form-control" name="passwordlama"  value="" required pattern=".{0}|.{6,}">
                    <label class="form-label">Password Lama...</label>
                </div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="password" class="form-control" name="password"  value="" required pattern=".{0}|.{6,}">
                    <label class="form-label">Password Baru...</label>
                </div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="password" class="form-control" name="password2" required>
                    <label class="form-label">Ulangi Password...</label>
                </div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                    <input type="email" class="form-control" name="email" value="<?= $datauser['email']?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                    <label class="form-label">Email...</label>
                </div>
            </div>


            <br>

            <button class="btn btn-primary btn-block waves-effect" type="submit" name="submit">Ubah Data</button>
        </form>
    </div>