<?php 
include_once '../includes/nilai_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$nilai = new Nilai($db);

if ($_POST) { 

$nilai->jm = $_POST['jml'];
$nilai->kt = $_POST['ket'];

    if ($nilai->insert()) { ?>
        <script>
        window.onload=function(){
            swal({
            title: "Success!",
            text: "Tambah data nilai skala Berhasil..!",
            type: "success"
            });
        }
        </script> <?php
    } else { ?>
        <script type="text/javascript">
            window.onload=function(){
            swal({
            title: "Failed!",
            text: "Tambah Data Gagal",
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
			<li class="breadcrumb-item">
				<i class="fa fa-dashboard"></i>&nbsp<a href="index.php">Beranda</a>
			</li>
			<li class="breadcrumb-item active">
				<a href="index.php?halaman=nilai">Skala AHP</a>
			</li>
			<li class="breadcrumb-item active">Tambah Data</li>
		</ol>
		<h2 class="page-header head-font text-muted">
				<i class="fa fa-pencil-square-o"></i>&nbspSkala Dasar AHP
		</h2>
	</div>
</div>
<!-- -->
<!-- Form -->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6">
		<div class="card mb-3">
			<div class="card">
				<div class="card-header font text-center">
					<h4>Tambah Skala Dasar</h4>
				</div>
				<div class="card-body">
					<form class="needs-validation" method="post" novalidate>
						<div class="form-group">
							<label for="jml_nilai">Jumlah Nilai</label>
							<input type="text" class="form-control" id="jml-nilai" name="jml" required autofocus>
							<div class="invalid-feedback">Jumlah Nilai Harus Diisi</div>
						</div>
						<div class="form-group">
							<label for="keterangan">Keterangan Nilai</label>
							<input type="text" class="form-control" id="keterangan" name="ket" minlength="5" required="on">
							<div class="invalid-feedback">Keterangan Harus Diisi (min 5 karakter)</div>
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
</div>
<!-- -->
