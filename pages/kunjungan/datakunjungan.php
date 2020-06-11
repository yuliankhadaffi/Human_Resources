<style type="text/css">
   #fomfiljk, .filter select {
    margin-top: -5px;
    margin-bottom: 5px;

}
.filter select{
    font-weight: normal;
}
.aksi a
{
    height: 50px;
    -webkit-transition :1s;
}
.aksi:hover 
{
    transform: scale(1.3);
}
.aksi a li:hover
{
    color: black;
}

</style>
<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <table class="table table-responsive" >
                   <th >
                    <h2 style="font-weight: bold;"> Data Kunjungan Perpustakaan</h2>
                </th>
                <th>
                    <div class="btn-group pull-right">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#kunjunganModal" data-color="blue-grey" class="btn btn-info waves-effect"><li class="fa fa-print"></li>Cetak Laporan Kunjungan</a>
                    </div>
                </div>
            </th>
        </table>
        <div class="body">
            <?php 
                if (isset($_POST['okkunjungan'])) {
                    if ($_POST['filkunjungan']=="all") {
                    $kunjungan = query("SELECT * FROM tbkunjungan ORDER BY waktu_kunjung DESC");   
                    }else{
                      $kunjungan =  query("SELECT * FROM tbkunjungan WHERE status ='".$_POST['filkunjungan']."' ORDER BY waktu_kunjung DESC");
                    }
                }else{
                     $kunjungan = query("SELECT * FROM tbkunjungan ORDER BY waktu_kunjung DESC");
                }
             ?>
            <form method="post">
               <label class="filter">Urutkan Menurut </label><br>
               <select name="filkunjungan" style="margin-top: -5px">
                <option value="all">--Pilih--</option>
                <option value="Anggota">Anggota</option>
                <option value="Non Anggota">Non Anggota</option>
            </select>
            <button type="submit" name="okkunjungan" class="btn btn-primary btn-xs">ok</button>

        </form>
        <form method="POST" >

            <div class="table-responsive">

                <table style="font-size: 80%" id="tabelanggota" class="table display table-striped table-hover dataTable">
                    <thead style="background: #f5f5f0; font-size: 100%">
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>No. Identitas</th>
                            <th>Instansi</th>
                            <th>Status</th>
                            <th>Berkunjung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1;
                        foreach ($kunjungan as $row) :?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $row['nama']?></td>
                            <td><?= $row['noidentitas'] ?></td>
                            <td><?= $row['instansi'] ?></td>
                            <td><?= $row['status']?></td>
                            <td><?= date("d/m/Y | H:i",strtotime($row['waktu_kunjung'])) ?></td>
                        </tr>
                    <?php $no++; endforeach ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<!-- #END# Basic Examples -->