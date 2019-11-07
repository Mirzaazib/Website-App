<?php
include_once('../includes/alternatif_inc.php');
$conn = new Config();
$db = $conn->getConnection();

$pro = new Alternatif($db);
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
                  window.location.href = "index.php?halaman=data_alternatif";
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
      <li class="breadcrumb-item active">Data Alternatif</li>
  	</ol>
    <h2 class="page-header head-font text-muted">
        <i class="fa fa-bank"></i>&nbspData Alternatif
    </h2>
  </div>
</div>
<!-- -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
      <a href="index.php?halaman=data_alternatif-baru" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Tambah Data</a>
    </div>
</div>	<br/>
<!-- tabel -->
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="card">
    <div class="card-header font text-center">
    <h4>Data Alternatif</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table width="100%" class="table table-striped" id="tabeldata">
        <thead>
          <tr>
            <th>ID Alternatif</th>
            <th>Nama Lokasi</th>
            <th>Keterangan</th>
            <th>Hasi Akhir</th>
            <th width="100px">Aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID Alternatif</th>
            <th>Nama Lokasi</th>
            <th>Keterangan</th>
            <th>Hasi Akhir</th>
            <th width="100px">Aksi</th>
          </tr>
        </tfoot>
          <tbody>
          <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :  ?>
            <tr>
              <td style="vertical-align:middle;"><?php echo $row['id_alternatif'] ?></td>
              <td style="vertical-align:middle;"><?php echo $row['lokasi'] ?></td>
              <td style="vertical-align:middle;"><?php echo $row['keterangan'] ?></td>
              <td style="vertical-align:middle;"><?php echo number_format($row['hasil_akhir'], 4, ',', '.'); ?></td>
              <td style="text-align:center;vertical-align:middle;">
                <a href="index.php?halaman=data_alternatif-ubah&id=<?= $row['id_alternatif'] ?>" class="btn btn-warning btn-sm"><span class="fa fa-pencil" aria-hidden="true" style="color: white"></span></a>
                <a class='btn btn-danger btn-sm' data-toggle='modal' data-target='#konfirmasi_hapus' data-href='index.php?halaman=data_alternatif&id=<?= $row['id_alternatif'] ?>'><span class="fa fa-trash" aria-hidden="true" style="color: white"></span></a>
              </td>
            </tr>
          <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    </div>
  </div>
</div>
<div class="card mb-3">
  
  </div>

    


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