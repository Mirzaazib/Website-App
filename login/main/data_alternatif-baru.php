<?php 
include_once '../includes/alternatif_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$altObj = new Alternatif($db);

if (isset($_POST['submit'])) { 

	$altObj->id_alternatif = $_POST['id_alternatif'];
	$altObj->lokasi = $_POST['lokasi'];
	$altObj->keterangan = $_POST['keterangan'];

if ($altObj->insert()) { ?>
    <script>
      window.onload=function(){
        swal({
          title: "Success!",
          text: "Tambah data alternatif Berhasil..!",
          type: "success"
        });
      }
    </script> <?php
} else { ?>
    <script type="text/javascript">
        window.onload=function(){
        swal({
          title: "Failed!",
          text: "Tambah data Gagal",
          type: "warning"
        });
      }
    </script> <?php
	}
}
?>
<!--Header -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<i class="fa fa-dashboard">&nbsp</i><a href="index.php">Beranda</a>
			</li>
			<li class="breadcrumb-item">
				<a href="index.php?halaman=data_alternatif">Data alternatif</a>
			</li>
			<li class="breadcrumb-item active">Tambah Data Kriteria</li>
		</ol>
		<h2 class="page-header head-font text-muted">
				<i class="fa fa-pencil-square-o"></i>&nbspData Alternatif 
		</h2>
	</div>
</div>
<!-- -->
<!-- Form -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="card mb-3">
			<div class="card-header font text-center">
				<h4>Tambah Data Alternatif</h4>
			</div>
			<div class="card-body">
				<form class="needs-validation" method="post" novalidate>
          <div class="form-group">
						<label for="id_kriteria">ID Alternatif</label>
					  <input type="text" class="form-control" id="id_kriteria" name="id_alternatif" required readonly="on" value="<?=$altObj->getNewID()?>">
						<div class="valid-feedback">Looks Good</div>
					</div>
					<div class="form-group">
						<label for="nama">Nama Lokasi</label>
						<input type="text" class="form-control" id="nama" name="lokasi" minlength="5" required autofocus>
						<div class="invalid-feedback">Nama Harus Diisi (min 5 karakter)</div>
					</div>
					<div class="form-group">
						<label for="keterangan">Keterangan Lokasi</label>
						<input type="text" class="form-control" id="keterangan" name="keterangan" minlength="5" required autofocus>
						<div class="invalid-feedback">Keterangan Lokasi Harus Diisi (min 5 karakter)</div>
					</div>
					<div class="btn-group">
						<button type="button" onclick="location.href='index.php?halaman=data_alternatif'" class="btn btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Kembali</button>
						<button type="submit" name="submit" class="btn btn-success">Simpan<i class="fa fa-fw fa-check"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- -->