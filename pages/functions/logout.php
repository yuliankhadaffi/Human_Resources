<?php 
// ob_clean();
// session_start();
$_SESSION = [];
session_unset();
session_destroy();

// setcookie('patokan', '', time() - 3600);
// setcookie('dipatok', '', time() - 3600);


// unset($_COOKIE['patokan']);
// unset($_COOKIE['dipatok']);
// header("location:login.php");
echo "<script>document.cookie = 'patokan=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/sisiput;'</script>";
echo "<script>document.cookie = 'dipatok=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/sisiput;'</script>";
echo "<script>location.href='login.php';</script>";
exit; 
?>

