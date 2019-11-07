<?php 
include_once '../includes/nilai_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$nilai = new Nilai($db);
$nilai->readOne();

if(isset($_GET['id'])){
	$nilai->id = $_GET['id'];
	$nilai->readOne();
}


if(isset($_POST['submit'])){
	$nilai->jm = $_POST['jm'];
	$nilai->kt = $_POST['kt'];
	if($nilai->update()){ ?>
		<script>
		window.onload=function(){
				swal({
				title: "Success!",
				text: "Ubah Nilai Skala Berhasil..!",
				type: "success"
				}, function(){
					window.location.href = "index.php?halaman=nilai";
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
?>
<!-- Header -->
<div class="row mb-3">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-dashboard">&nbsp</i><a href="index.php">Beranda</a></li>
			<li class="breadcrumb-item"><a href="index.php?halaman=nilai">Skala AHP</a></li>
			<li class="breadcrumb-item active">Ubah Data</li>
		</ol>
		<h2 class="page-header head-font text-muted">
				<i class="fa fa-pencil"></i>&nbspSkala Dasar AHP
		</h2>
	</div>
</div>
<!-- -->
<!-- Form -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="card">
			<div class="card-header font text-center">
				<h4>Ubah Data Skala Dasar</h4>
			</div>
			<div class="card-body">
				<form class="needs-validation" method="post" novalidate>
						<div class="form-group">
							<label for="id_kriteria">Jumlah Nilai</label>
							<input type="text" class="form-control" name="jm" required="on" value="<?= $nilai->jm ?>">
							<div class="invalid-feedback">Jumlah Nilai Harus Diisi</div>
						</div>
						<div class="form-group">
							<label for="nama">Keterangan Nilai</label>
							<input type="text" class="form-control" name="kt" minlength="5" required="on" value="<?= $nilai->kt ?>">
							<div class="invalid-feedback">Keterangan Harus Diisi (min 5 Karakter)</div>
						</div>
						<div class="btn-group">
							<button type="button" onclick="location.href='index.php?halaman=nilai'" class="btn btn-primary"><i class="fa fa-fw fa-arrow-left"></i>Kembali</button>
							<button type="submit" name="submit" class="btn btn-success">Simpan<i class="fa fa-fw fa-check"></i></button>
						</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- -->
