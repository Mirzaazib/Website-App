<?php 
include_once '../includes/alternatif_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$altObj = new Alternatif($db);


if (isset($_GET['id'])) { 
    $altObj->id = $_GET['id'];
    $altObj->readOne();

	if(isset($_POST['submit'])){
			$altObj->id = $_POST['id_alternatif'];
			$altObj->lokasi = $_POST['lokasi'];
			$altObj->ket = $_POST['keterangan'];
			if ($altObj->update()) { ?>
					<script>
					window.onload=function(){
							swal({
							title: "Success!",
							text: "Ubah data Alternatif Berhasil..!",
							type: "success"
							}, function(){
								window.location.href = "index.php?halaman=data_alternatif";
					});
					}
					</script> <?php
			} else { ?>
					<script type="text/javascript">
							window.onload=function(){
							swal({
							title: "Failed!",
							text: "Ubah data Gagal..!",
							type: "warning"
							});
					}
					</script> <?php
			}
    }
}
?>
<!-- Header -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-dashboard">&nbsp</i><a href="index.php">Beranda</a></li>
			<li class="breadcrumb-item"><a href="index.php?halaman=data_alternatif">Data Alternatif</a></li>
			<li class="breadcrumb-item active">Ubah Data</li>
		</ol>
		<h2 class="page-header head-font text-muted">
				<i class="fa fa-pencil"></i>&nbspData Alternatif
		</h2>
	</div>
</div>
<!-- -->
<!-- Form -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="card">
			<div class="card-header font text-center">
				<h4>Ubah Data Alternatif</h4>
			</div>
			<div class="card-body">
				<form class="needs-validation" method="post" novalidate>
						<div class="form-group">
							<label for="id_kriteria">ID Alternatif</label>
							<input type="text" class="form-control" id="id_kriteria" name="id_alternatif" value="<?= $altObj->id; ?>" readonly required>
							<div class="invalid-feedback">ID Harus Diisi</div>
						</div>
						<div class="form-group">
							<label for="nama">Nama Lokasi</label>
							<input type="text" class="form-control" is="nama" name="lokasi" minlength="5" value="<?= $altObj->lokasi;?>" required="on">
							<div class="invalid-feedback">Nama Harus Diisi (min 5 karakter)</div>
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan</label>
							<input type="text" class="form-control" id="keterangan" name="keterangan" minlength="5" value="<?= $altObj->ket;?>" required="on">
							<div class="invalid-feedback">keterangan harus diisi (min 5 karakter)</div>
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