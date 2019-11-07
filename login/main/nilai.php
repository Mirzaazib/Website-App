<?php
include_once '../includes/nilai_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$nilai = new Nilai($db);
$stmt = $nilai->readAll();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $nilai->id = $id;
        
    if($nilai->delete()){ ?>
        <script>
          window.onload=function(){
            swal({
              title: "Success!",
              text: "Penghapusan data Berhasil..!",
              type: "success"
            }, function(){
                  window.location.href = "index.php?halaman=nilai";
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
            <i class="fa fa-dashboard"></i>&nbsp<a href="index.php">Dashboard</a>
        </li>
  	    <li class="breadcrumb-item active">Skala AHP</li>
  	</ol>
    <h2 class="page-header head-font text-muted">
        <i class="fa fa-area-chart">&nbsp</i>Skala Dasar AHP
    </h2>
  </div>
</div>
<!-- -->
  
<div class="row">
    <div class="col-md-12 text-right">
        <a href="index.php?halaman=nilai-baru" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Tambah Data</a>
  </div>
</div>
<br/>

<!-- Table -->
<div class="card mb-3">
  <div class="card-header text-center font">
    <h4>Data Skala</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table width="100%" class="table table-striped table-bordered" id="dataTable">
            <thead class="text-center">
              <tr>
                  <th>Nilai</th>
                  <th>Keterangan</th>
                  <th width="100px">Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr class="text-center">
                  <th>Nilai</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
            <?php $no=1; while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
              <tr>
                  <td class="text-center" style="vertical-align:middle;"><?php echo $row['jum_nilai'] ?></td>
                  <td style="vertical-align:middle;"><?php echo $row['ket_nilai'] ?></td>
                  <td class="text-center" style="text-align:center;vertical-align:middle;">
                    <a href="index.php?halaman=nilai-ubah&id=<?= $row['id_nilai'] ?>" class="btn btn-warning btn-sm"><span class="fa fa-pencil" aria-hidden="true" style="color:white"></span></a>
                    <a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#konfirmasi_hapus' data-href='index.php?halaman=nilai&id=<?= $row['id_nilai'] ?>'><span class="fa fa-trash" aria-hidden="true" style="color:white"></span></a>
                  </td>
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
<!-- -->