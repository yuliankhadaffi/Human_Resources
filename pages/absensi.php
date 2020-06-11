<?php 
if (isset($_POST["sumbit"])) 
{
    if ( tambah_absensi($_POST) > 0 ) 
    {
       
        // echo "<script>alert('data berhasil di tambahkan');</script>";
        echo "<script> 
            alert('Congratulation, anda berhasil absensi!');
            document.location.href = '?pages=absensi';
            </script>";

    }else
    {
         echo "<script> 
            alert('Opps, periksa kembali inputan anda!');
            document.location.href = '?pages=absensi';
            </script>";
    }
}

?>

<style type="text/css">
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

    .panel-title:hover{
        opacity: 0.5;
    }
    .btn-tamkat:hover{
        transform: scale(1.3); transition: 0.8s;
    }
    td{
        overflow-x: hidden !important; 
    }

</style>

<!-- Basic Examples -->
<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <div class="card">
            <!-- <div class="header" style="background-color: #f5f5f0">
                <h3 align="center">Tambah Data Kategori Koleksi</h3>
            </div> -->
            <!-- collapse tamba kategori -->
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title" align="center">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Tambah data absensi pegawai
                  </a>
              </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <?php
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "human_resources";
                $db = mysqli_connect($host, $username, $password, $database);
                
                $query = "SELECT * FROM tbanggota ORDER BY nama asc";
                $result = mysqli_query($db, $query);
              ?>

                <form method="POST">   
                    <div class="row clearfix">
                                                
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="nama">ID Anggota</label>
                                    
                                    <select class="form-control" name="idanggota" id="idanggota" required/>

                                       <?php while($data = mysqli_fetch_assoc($result) ){?>
                                        <option value="<?php echo $data['idanggota']; ?>"><?php echo $data['idanggota']; ?></option>
                                    <?php } ?>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-line">
                                    <label for="nama">Nama Anggota</label>
                                    <input id="nama" name="nama" type="text" class="form-control" placeholder="Enter your full name" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label for="Instansi">Instansi </label>
                                    <input id="instansi" name="instansi" type="text" class="form-control" placeholder="Enter here" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-line">
                                    <label for="Instansi">Pekerjaan </label>
                                    <input id="pekerjaan" name="pekerjaan" type="text" class="form-control" placeholder="Enter here this" required/>
                                </div>
                            </div>

                        </div>


                        <div class="row clearfix">
                            <div class="col-sm-12">
                                <div class="body" align="center">
                                    <button type="sumbit" name="sumbit" class="btn btn-tamkat bg-blue-grey waves-effect waves-blue">Tambah Data</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                 
            </form>
        </div>
    </div>
</div>

<!-- collapse tamba kategori -->
<div class="body">
    <div class="table-responsive">

        <table id="tabelkategori" class="table display table-striped table-hover dataTable">

            <thead style="background: #f5f5f0; font-size: 100%">
                <tr>
                    <th style="background: #DCDCDC;">No</th>
                    <th>ID </th>
                    <th>Nama</th>
                    <th>Instansi</th>
                    <th>Pekerjaan</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $host = "localhost";
                $username = "root";
                $password = "";
                $database = "human_resources";
                $db = mysqli_connect($host, $username, $password, $database);

                $sql = "SELECT * FROM absensi";
                $query = mysqli_query($db, $sql);

                $no = 1;
                foreach ($query as $row) :
                 ?>
                 <tr>
                    
                    <td><?= $no; echo "."; ?></td>
                    
                    <td><?= $row["idanggota"] ?></td>
                    <td><?= $row["nama"] ?></td>
                    <td><?= $row["instansi"] ?></td>
                    <td><?= $row["pekerjaan"] ?></td>

               
                </tr>
                <?php $no++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
        // replace karakre spasi jadi titik
        function reptoup(field)
        {
         field.value = field.value.replace(' ','.');
       // uppercase
       field.value = field.value.toUpperCase();
   }
</script>
<!-- #END# Basic Examples -->
