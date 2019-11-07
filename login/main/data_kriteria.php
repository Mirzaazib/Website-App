<?php
include_once('../includes/kriteria_inc.php');
$conn = new Config();
$db = $conn->getConnection();

$pro = new Kriteria($db);
$stmt = $pro->readAll();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $pro->id = $id;
        
    if($pro->delete()  ){ ?>
        <script>
          window.onload=function(){
            swal({
              title: "Success!",
              text: "Penghapusan data Berhasil..!",
              type: "success"
            }, function(){
                  window.location.href = "index.php?halaman=data_kriteria";
            });
          }
        </script> <?php
        } else { ?>
            <script>
          window.onload=function(){
            swal({
              title: "Failed!",
              text: "Penghapusan data Gagal..!",
              type: "warning"
            });
          }
        </script> <?php
        }
}
	
?>
<!-- Header -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
  	<ol class="breadcrumb">
      <li class="breadcrumb-item">
          <i class="fa fa-dashboard">&nbsp</i><a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Data Kriteria</li>
  	</ol>
    <h2 class="page-header head-font text-muted">
        <i class="fa fa-bank"></i>&nbspData Kriteria
    </h2>
  </div>
</div>
    
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 text-right">
    <a href="index.php?halaman=data_kriteria-baru" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Tambah Data</a>
  </div>
</div>	<br/>
<!-- Tabel -->
<div class="card mb-3">
  <div class="card-header font text-center">
    <h4>Data Kriteria</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table width="100%" class="table table-striped" id="tabeldata">
        <thead>
          <tr>
            <th>ID Kriteria</th>
            <th>Nama Kriteria</th>
            <th>Bobot Kriteria</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID Kriteria</th>
            <th>Nama Kriteria</th>
            <th>Bobot Kriteria</th>
            <th width="100px">Aksi</th>
          </tr>
        </tfoot>
        <tbody>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
          <tr>
              <td style="vertical-align:middle;"><?php echo $row['id_kriteria'] ?></td>
              <td style="vertical-align:middle;"><?php echo $row['nama_kriteria'] ?></td>
              <td style="vertical-align:middle;"><?php echo number_format($row['bobot_kriteria'], 4, ',', '.');?></td>
              <td style="text-align:center;vertical-align:middle;">
              <a href="index.php?halaman=data_kriteria-ubah&id=<?= $row['id_kriteria'] ?>" class="btn btn-warning btn-sm"><span class="fa fa-pencil" aria-hidden="true" style="color:white"></span></a>
              <a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#konfirmasi_hapus' data-href='index.php?halaman=data_kriteria&id=<?php echo $row['id_kriteria'] ?>'><span class="fa fa-trash" aria-hidden="true" style="color:white"></span></a>
              </td>
          </tr>
        <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- -->

<!-- Modal Hapus -->
<div class="modal fade" id="konfirmasi_hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="konfirmasi_hapus">hapus data ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">apakah anda yakin ingin menghapus data ini ?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-fw fa-close"></i> Batal</button>
        <a class="btn btn-danger btn-ok"><i class="fa fa-fw fa-trash"></i> Hapus</a>
      </div>
    </div>
  </div>
</div>
