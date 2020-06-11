<?php $s = query("SELECT level FROM tbuser WHERE username = '".$_SESSION['username']."'")[0]; 
    $_SESSION['level'] = $s['level'];
?>
<section class="tp">
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">

                <img src="user.png" width="48" height="48" alt="User"/>
                <b 
                style="
                margin-top: 15px;
                padding-left: 5px;
                position: absolute;
                "> <?= $_SESSION['username'];  ?>  <span style="color: lightgreen;">&#9679;</span></b>
            </div>

        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active" hidden="hidden"></li>
                <li <?php if (@$_GET['pages']==''): ?>
                    class="active"
                <?php endif ?>>
                <a href="/Human_Resources/">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>
            

        <!-- MENU DATA MASTER -->
        <li <?php if ($pages =='anggota' || $pages =='kategori' || $pages =='koleksi' || $pages =='ubah' || $pages=='ubahkat'): ?>
            class="active"
        <?php endif ?>>
        <a href="javascript:void(0);" class="menu-toggle">
            <i class="material-icons">widgets</i>
            <span>Master Data</span>
        </a>
        <ul class="ml-menu">
            <li <?php if ($pages =='anggota' || $pages =='ubah'): ?>
                class="active"
            <?php endif ?>>
            <a href="?pages=anggota">Anggota</a>
        </li>
        <li <?php if ($pages =='kategori' || $pages=='ubahkat'):  ?>
            class="active"
        <?php endif ?>>
        <a href="?pages=kategori">Cuti Pegawai</a>
    </li>
    
</ul>
</li>
<!-- END MENU DATA MASTER -->

<li <?php if ($pages == 'absensi'): ?>
    class="active"
<?php endif ?>>
<a href="?pages=absensi">
    <i class="material-icons">assignment</i>
    <span>Absensi</span>
</a>
</li>

<!-- Menu account sidebar user -->
<li <?php if ($pages == 'userdata'|| $pages == 'tambahuser' || $pages == 'ubahuser'): ?>
    class="active"
<?php endif ?>>
<a href="?pages=userdata">
    <i class="material-icons">account_box</i>
    <span>Data User</span>
</a>
</li>

<li <?php if ($pages == 'about'): ?>
    class="active"
<?php endif ?>>
<a href="?pages=about">
    <i class="material-icons">error_outline</i>
    <span>About Us</span>
</a>
</li>
<!-- END Menu account sidebar user -->
</ul>
</div>
<!-- #Menu -->
<!-- Footer -->
<div class="legal">
    <div class="copyright">
        Copyright &copy; <?= date('yy'); ?><a href="javascript:void(0);"> Human Resources</a>.
    </div>
    <div class="version">
        <b>All Right Reserved
    </div>
</div>
<!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->
</section>