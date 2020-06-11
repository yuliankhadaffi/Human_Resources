<style type="text/css">
    #fomfiljk, .filter select {
        margin-left: 20px
        
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
    .foto {border-radius: 5px;}
    .foto
    {
        -webkit-transition :1s; 
    }
    .foto:hover
    {
        transform: scale(2);
    }


</style>

<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <table class="table table-responsive" >
                    <tr>
                <th>
                <a href="?pages=anggota&aksianggota=tambah" class="btn btn-primary hover">Tambah Data</a>
                </th>
                <th >
                        <h2 align="center" style="font-weight: bold;">  Data Anggota</h2>
                </th>

                <th>
                <div class="btn-group pull-right">
                    <button type="button" class="btn btn-info waves-effect">
                        <li class="fa fa-flash"></li>
                    </button>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Aksi </span>
                        <span class="caret"></span>
                    </button>
                    <?php 
                    $b_edit = @$_GET['aksianggota']=='b_edit';
                    $b_cetak = @$_GET['aksianggota']=='b_cetak';
                    ?>
                    <ul class="dropdown-menu">
                        <li
                        <?php if ($b_edit): ?>
                           class="active"
                       <?php endif ?> 
                       ><a href="?pages=anggota&aksianggota=b_edit">Ubah Data Anggota</a></li>
                       <li
                       <?php if ($b_cetak): ?>
                           class="active"
                       <?php endif ?>
                       ><a href="?pages=anggota&aksianggota=b_cetak">Cetak Kartu Anggota</a></li>
                      
                   </ul>
               </div>
           </div>
           </th>
           </tr>
           </table>

            <form method="post" id="fomfiljk">
               <label class="filter">Urutkan Menurut </label><br>
                <select name="filjk">
                    <option value="semua">Jenis Kelamin</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <button type="submit" name="okjk" class="btn btn-primary btn-xs">ok</button>
            

            </form>
        
    
    <div class="body">

        <div class="table-responsive">

            <table style="font-size: 80%" id="tabelanggota" class="table display table-striped table-hover dataTable">

                <thead style="background: #f5f5f0; font-size: 100%">
                    <tr>
                        <th style="background: #DCDCDC;">Aksi</th>
                        <th>No</th>
                        <th>foto</th>
                        <th>Nama</th>
                        <th>No. Identitas</th>
                        <th>Instansi</th>
                        <th>Telpon</th>
                        <th>Kelamin</th>
                        <th>Pekerjaan</th>
                        <th>Alamat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;
                    foreach ($anggota as $row) :
                        ?>
                        <tr>
                            <td style="background: #DCDCDC;">
                                <!-- edit action -->
                                <div id="edit" class="aksi btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                    <?php if ($b_cetak): ?>
                                        <a href="pages/kartuanggota.php?id=<?= $row["idanggota"] ?>" class="btn btn-xs bg-deep-orange waves-effect" target="_blank">
                                            <i class="material-icons">print</i>
                                        </a>
                                    <?php else: ?>
                                        <a href="?pages=ubah&id=<?= $row["idanggota"] ?>" class="btn btn-xs bg-cyan waves-effect">
                                            <li class="fa fa-edit"></li>
                                        </a>
                                        <a href="?pages=hapus&idanggota=<?= $row["idanggota"]?>&potoname=<?= $row["foto"]?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini???');" class="btn btn-xs bg-red waves-effect">
                                            <li class="fa fa-trash-o"></li></a>
                                        <?php endif ?>
                                    </div>
                                </td>
                                <td width="5px"><?= $no; echo "."; ?></td>
                                <td><img class="foto" width="50px" height="50px" src="gambar/<?= $row["foto"] ?>"></td>
                                <td><?= $row["nama"] ?></td>
                                <td><?= $row["noidentitas"] ?></td>
                                <td ><?= $row["Instansi"] ?></td>
                                <td><?= $row["notlf"] ?></td>
                                <td><?= $row["jk"] ?></td>
                                <td><?= $row["pekerjaan"] ?></td>
                                <td width="100%"><?= $row["alamat"] ?></td>
                                <td>
                                    <div <?php if ($row["status"]=="Aktif"): ?>
                                        class="btn btn-xs bg-light-green"
                                    <?php else: ?>
                                        class="btn btn-xs bg-red"
                                    <?php endif ?>>
                                    <?= $row["status"] ?>
                                </div>   
                            </td>
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
                <tfoot>
                    <th border="1" id="total">TOTAL</th>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>
</div>

<!-- #END# Basic Examples -->
<!-- Exportable Table -->
