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

                <th><a href="?pages=koleksi&aksikoleksi=tambah" class="btn btn-primary hover">Tambah Data</a></th>
                 <th >
                        <h2 align="center" style="font-weight: bold;"> Master Data Koleksi</h2>
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
                    $b_edit = @$_GET['aksikoleksi']=='b_edit';
                    $b_cetak = @$_GET['aksikoleksi']=='b_cetak';
                    ?>
                    <ul class="dropdown-menu">
                        <li
                        <?php if ($b_edit): ?>
                           class="active"
                       <?php endif ?> 
                       ><a href="?pages=koleksi&aksikoleksi=b_edit">Ubah Data Koleksi</a></li>
                       <li
                       <?php if ($b_cetak): ?>
                           class="active"
                       <?php endif ?>
                       ><a href="?pages=koleksi&aksikoleksi=b_cetak">Cetak Barcode Koleksi</a></li>
                       <li><a href="javascript:void(0);" data-toggle="modal" data-target="#kolModal" data-color="blue-grey">Cetak Laporan Koleksi</a></li>
                   </ul>
               </div>
           </div>
           </th>
       </table>
           <div class="body">

            <form method="post" id="fomfiljk">
             <label class="filter">Urutkan Menurut </label><br>
             <select name="filkoleks" style="margin-top: -5px">
                <option value="all">Kategori Koleksi</option>
                <?php foreach ($kategori as $row) :  ?>
                    <option value="<?= $row['kategori'];?>"><?= $row['kategori'] ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="okkoleks" class="btn btn-primary btn-xs">ok</button>

        </form>
        <form method="POST" target="_blank" action="pages/koleksi/cetak_barcode.php">

        <div class="table-responsive">

            <table style="font-size: 80%" id="tabelanggota" class="table display table-striped table-hover dataTable">
                <thead style="background: #f5f5f0; font-size: 100%">
                    <tr>
                        <th style="background: #DCDCDC;">Aksi</th>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Kode</th>
                        <th>ISBN/SN</th>
                        <th>Judul Koleksi</th>
                        <th>Pengarang I</th>
                        <th>Pengarang II</th>
                        <th>Editor</th>
                        <th>Penerjemah</th>
                        <th>Kota Terbit</th>
                        <th>Penerbit</th>                        
                        <th>Jenis Buku</th>
                        <th>Cetakan</th>
                        <th>Edisi</th>
                        <th>Tahun</th>
                        <th>Copies</th>
                        <th>Sisa Copies</th>
                        
                        
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  $no = 1;
                  foreach ($koleksi as $row) :
                    ?>
                    
                    <tr>
                        
                        <td style="background: #DCDCDC;" align="center">
                            <!-- edit action -->
                                <?php if ($b_cetak): ?>
                                   <input type="checkbox" name="cek[]" class="" value="<?= $row['id_koleksi'] ?>">
                                <?php else: ?>

                                    <div id="edit" class="aksi btn-group btn-group-justified" role="group" aria-label="Justified button group">
                                    <a href="?pages=ubahkoleksi&id=<?= $row["id_koleksi"]; ?>" class="btn btn-xs bg-cyan waves-effect">
                                        <li class="fa fa-edit"></li>
                                    </a>
                                    <a href="?pages=hapus&idkoleksi=<?= $row["id"]?>&fotoKoleksi=<?= $row["foto"]?>" onclick="return confirm('Apakah Anda Yakin Menghapus Data ini???');" class="btn btn-xs bg-red waves-effect">
                                        <li class="fa fa-trash-o"></li></a>
                                    <?php endif ?>
                                </div>
                            </td>
                            <td><?= $no.'.' ?></td>
                            <td><img class="foto" width="50px" height="50px" src="gambar/<?= $row["foto"] ?>"></td>
                            <td  valign="top" ><?= $row["kode_koleksi"] ?></td>
                            <td  valign="top" ><?= $row["isbn"] ?></td>
                            <td  valign="top"><?= $row["judul"] ?></td>
                            <td  valign="top"><?= substr($row["pengarang1"], 0,25) ?>></td>
                            <td  valign="top"><?= substr($row["pengarang2"], 0,25) ?></td>
                            <td  valign="top"><?= $row["editor"] ?></td>
                            <td  valign="top"><?= $row["penerjemah"] ?></td>
                            <td  valign="top"><?= $row["kota_terbit"] ?></td>
                            <td  valign="top"><?= $row["penerbit"] ?></td>
                            <td  valign="top"><?= $row["jenis_buku"] ?></td>
                            <td  valign="top"><?= $row["cetakan"] ?></td>
                            <td  valign="top"><?= $row["edisi"] ?></td>
                            <td  valign="top"><?= $row["tahun_terbit"] ?></td>
                            <td valign="top" ><?= $row["copies"] ?></td>
                            <td valign="top" ><?= $row["sisa_copies"] ?></td>
                            
                            
                            <?php $no++; ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
                <tfoot>
                    <!-- buuton cetak barcode -->
                    <?php if ($b_cetak): ?>
                        <th border="1"><button type="submit" name="cetak-barcode" class="bg-deep-orange waves-effect btn btn"><i class="material-icons">print</i></button></th>
                    <?php endif ?>
                </tfoot>
            </table>
        </div>
        </form>
    </div>
</div>
</div>
</div>
<!-- #END# Basic Examples -->
<!-- Exportable Table -->
<script>
    $('div.dataTables_filter input').focus()
</script>