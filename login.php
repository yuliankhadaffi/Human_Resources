<?php 
session_start();
require 'config/+konfigurasi.php';
require 'config/koneksi.php'; 
require 'pages/functions/functions.php';

// cek cookie
if (isset($_COOKIE['patokan']) && isset($_COOKIE['dipatok']))
{
    // nama cookie patokan = iduser dan nama cookie patokan = username
    $patokan = $_COOKIE['patokan'];
    $dipatok = $_COOKIE['dipatok'];

    // ambil username berdasarkan iduser 
    $result = mysqli_query($conn, "SELECT username FROM tbuser WHERE iduser = $patokan");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($dipatok === hash('sha256', $row['username'])) 
    {
        $_SESSION["login"] = true;
    }

}
if (isset($_SESSION["login"])) 
{
    header("location:/Human_Resources/");
    exit;
}
// login code
if (isset($_POST["login"])) 
{
    $username = $_POST["username"];
    $password = $_POST["password"];


    $result = mysqli_query($conn, "SELECT * FROM tbuser WHERE username = '$username'");

                // cek username
    if (mysqli_num_rows($result) === 1) 
    {
                    // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"]))
        {
                // set sessionnya
            $_SESSION["login"] = true;

            $_SESSION['username'] = $row['username'];

            // cek remember me
            if (isset($_POST['rememberme'])) 
            {
                // buat cookie ('namacookie', 'isicookie', 'expairednya')
                
                setcookie('patokan', $row["iduser"], time()+60);
                setcookie('dipatok', hash('sha256', $row["username"]), time()+60);

            }
            //jika password benar maka akan diarahkan ke halaman ini
            header("location:/Human_Resources/");
            exit;
        }

    }

    $error = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login Session - Human_Resources</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="assets/css/admin.css" rel="stylesheet">
</head> 
<?php if (isset($error)): ?>
    <body class="login-page">
        <div class="animated shake login-box">

        <?php else: ?>
           <body class="animated fadeInDown login-page">
            <div class="login-box">
            <?php endif ?>

            <div class="logo">
                <a href="javascript:void(0);">Admin<b> Login Form</b></a>
            </div>
            <div class="card" style="border-radius: 10px">
                <div class="body">
                    <form id="sign_in" method="POST">
                        <div class="msg">Anda Harus Login Untuk Akses Sistem</div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">person</i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">lock</i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-8 p-t-5">
                                <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                                <label for="rememberme">Remember Me</label>
                            </div>
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-cyan waves-effect" type="submit" name="login" style="border-radius: 5px">SIGN IN</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
        <?php if (isset($error)): ?>
            <div class="animated zoomInDown alert alert-danger alert-dismissible" role="alert" style="border-radius: 10px">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                Username Atau Password Anda Salah!!!
            </div>
        <?php endif ?>
        <!-- Jquery Core Js -->
        <script src="assets/plugins/jquery/jquery.min.js"></script>

        <script type="text/javascript">
            $('form input[type=text],input[type=password]').on('change invalid input', function() {
                var textfield = $(this).get(0);

    // hapus dulu pesan yang sudah ada
    textfield.setCustomValidity('');

    // PENGKONDISISAN VALIDASI
    if (this.value.trim() === '') {
        textfield.setCustomValidity('Wajib di Isi!');  
    }
    else{
        textfield.setCustomValidity('');
    }
});
</script>


</body>

</html>