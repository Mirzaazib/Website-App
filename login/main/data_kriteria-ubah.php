<?php 
include_once '../includes/kriteria_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$kriObj = new Kriteria($db);


if (isset($_GET['id'])) { 
    $kriObj->id = $_GET['id'];
    $kriObj->readOne();

	if(isset($_POST['submit'])){
			$kriObj->id = $_POST['id_kriteria'];
			$kriObj->nama = $_POST['nama'];
			if ($kriObj->update()) { ?>
					<script>
					window.onload=function(){
							swal({
							title: "Success!",
							text: "Ubah data kriteria Berhasil..!",
							type: "success"
							}, function(){
								window.location.href = "index.php?halaman=data_kriteria";
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
<div class="row mb-3">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<i class="fa fa-dashboard">&nbsp</i><a href="index.php">Beranda</a></li>
			<li class="breadcrumb-item">
				<a href="index.php?halaman=data_kriteria">Data Kriteria</a></li>
			<li class="breadcrumb-item active">Ubah Data</li>
		</ol>
		<h2 class="page-header text-muted head-font">
				<i class="fa fa-pencil"></i>&nbspData Kriteria
		</h2>
	</div>
</div>
<!-- -->
<!-- Form -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="card mb-3">
			<div class="card-header font text-center">
				<h4>Ubah Data Kriteria</h4>
			</div>
			<div class="card-body">
				<form class="needs-validation" method="post" novalidate>
					<div class="form-group">
						<label for="id_kriteria">ID Kriteria</label>
						<input type="text" class="form-control" id="id_kriteria" name="id_kriteria" value="<?= $kriObj->id; ?>" readonly required>
						<div class="invalid-feedback">id kriteria Harus Diisi</div>
					</div>
					<div class="form-group">
						<label for="nama">Nama Kriteria</label>
						<input type="text" class="form-control" id="nama" name="nama" minlength="5" value="<?= $kriObj->nama;?>" required="on" autofocus>
						<div class="invalid-feedback">Nama Harus Diisi (min 5 karakter)</div>
					</div>
					<div class="btn-group">
						<button type="button" onclick="location.href='index.php?halaman=data_kriteria'" class="btn btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Kembali</button>
						<button type="submit" name="submit" class="btn btn-success">Simpan<i class="fa fa-fw fa-check"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- -->