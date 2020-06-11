<?php
if ($_SESSION['level']!="Web Master") {
      echo "<script>location.href='?pages=userdata';</script>";
 } 

// cekk apakah tombol sudah ditkekan
if (isset($_POST['submit'])){


    if ( tambah_user($_POST) > 0 ) 
    {
        echo "<script>alert('data berhasil di tambahkan');</script>";
        echo "<script>location.href='?pages=userdata';</script>";
    }
    // else
    // {
    //     echo "<script>alert('data gagal di tambahkan');</script>";
    //     // echo "<script>location.href='?pages=anggota';</script>";
    // }
}

?>
<style>
    /*.popover{background:red; position: absolute; border-radius: 5px;}
    .popover-content{color: #FFFFFF;}
    .popover.bottom .arrow:after {
        border-bottom-color: red;
        
      }
    .popover.bottom .arrow{margin-left: -80px; border-bottom-color: red}  
*/
    .fa-check-circle{color: lightblue; margin-top: -18px; position: relative; display: none;}
</style>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
    <div class="card">

        <div class="header">
            <h2>Tambah Data User Admin</h2>
            <ul class="header-dropdown m-r--5">
                <a href="?pages=userdata" class="col-cyan waves-effect pull-right">Lihat Data</a>
            </ul>
        </div>
        <div class="body">
            <form id="fom" method="POST" autocomplete="on">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="username" pattern=".{0}|.{3,}" required id="username">
                        <label class="form-label">Username...</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" id="password" class="form-control" name="password" pattern=".{0}|.{6,}" required>
                        <label class="form-label">Password...</label>
                    </div>
                </div>
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="password" id="password2" class="form-control" name="password2" required>
                        <label class="form-label">Ulangi Password...</label>
                    </div>
                    <i id="good" class="fa fa-check-circle pull-right"></i>
                </div>

                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="email" class="form-control email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
                        <label class="form-label">Email ...</label>
                    </div>
                </div>
                <br>
                
                <button class="btn btn-primary btn-block waves-effect" type="submit" name="submit">Tambah User</button>
            </form>
        </div>