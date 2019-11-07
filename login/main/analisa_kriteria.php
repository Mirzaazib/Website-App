<?php 
include_once('../includes/kriteria_inc.php');
include_once('../includes/nilai_inc.php');
$conn = new Config();
$db = $conn->getConnection();

$kriteriaObj = new Kriteria($db);
$nilaiObj = new Nilai($db);

$kriteriaCount = $kriteriaObj->countAll();

$r = [];
$kriterias = $kriteriaObj->readall();
while ($row = $kriterias->fetch(PDO::FETCH_ASSOC)) {
	$kriteriass = $kriteriaObj->readSatu($row['id_kriteria']);
	while ($roww = $kriteriass->fetch(PDO::FETCH_ASSOC)) {
		$pcs = explode("C", $roww['id_kriteria']);//melakukan pemisahan antara C dengan angkanya
		$c = $kriteriaCount - $pcs[1];
	}
	if ($c>=1) {
		$r[$row['id_kriteria']] = $c;
	}
}
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<i class="fa fa-dashboard"></i> <a href="index.php">&nbspBeranda</a>
			</li>
			<li class="breadcrumb-item active">Analisa Kriteria</li>
			<li class="breadcrumb-item"><a href="index.php?halaman=analisa_kriteria-tabel">Tabel Analisa Kriteria</a></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xs-10 col-sm-10 col-md-10">
		<h2 class="page-header head-font text-muted">
      <span class="fa fa-search"></span>&nbspAnalisa Kriteria
    </h2>
	</div>
	<div class="col-xs-1 col-sm-2 col-md-2 text-right">
    <a href="#" data-toggle="modal" data-target="#HelpModal"><i class="fa fa-fw fa-info-circle"></i> </a>
	</div>
</div>

<div class="card" style="font-size:20px">
	<div class="card-header">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3">
					<label>Kriteria Pertama</label>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6">
					<label>Penilaian</label>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3">
					<label>Kriteria Kedua</label>
			</div>
		</div>
	</div>
	<div class="card-body">
		<form method="post" action="index.php?halaman=analisa_kriteria-tabel">
			<?php $no=1; foreach ($r as $k => $v):?>
				<?php for ($i=1; $i<=$v; $i++):?>
					<?php $rows = $kriteriaObj->readSatu($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
						<div class="row mb-3">
							<div class="col-xs-3 col-sm-3 col-md-3">
								<div class="form-group">
								<?php $rows = $kriteriaObj->readSatu($k); while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
										<input type="text" class="form-control" value="<?=$row['nama_kriteria'] ?>" readonly />
										<input type="hidden" name="<?=$k?><?=$no?>" value="<?=$row['id_kriteria']?>" />
								<?php endwhile;?>
								</div>
							</div>
							<div class="col-xs-6 col-sm-6 col-md-6">
								<div class="form-group">
									<select class="form-control" name="nl<?=$no?>">
										<?php $rows = $nilaiObj->readAll(); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
											<option value="<?=$row['jum_nilai']?>"><?=$row['jum_nilai']?> - <?=$row['ket_nilai']?></option>
										<?php endwhile; ?>
									</select>
								</div>
							</div>
							<div class="col-xs-3 col-sm-3 col-md-3">
								<div class="form-group">
									<?php $pcs = explode("C", $k); $nid = "C".($pcs[1]+$i); ?>
									<?php $rows = $kriteriaObj->readSatu($nid); while($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
										<input type="text" class="form-control" value="<?=$row['nama_kriteria']?>" readonly />
										<input type="hidden" name="<?=$nid?><?=$no?>" value="<?=$row['id_kriteria']?>" />
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					<?php endwhile; $no++; ?>
				<?php endfor; ?>
			<?php endforeach; ?>
			<button type="submit" name="submit" class="btn btn-dark"> Selanjutnya <span class="fa fa-arrow-right"></span></button>
		</form>
	</div>
</div>

<!-- Modal Help -->
<div class="modal fade" id="HelpModal" tabindex="-1" role="dialog" aria-labelledby="HelpModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="HelpModal">Bantuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			Untuk dapat melakukan analisa terhadap kriteria ikuti langkah di bawah ini
				<ol>
					<li>Masukkan data kriteria yang akan dihitung pada halaman "Input data -> Data Kriteria -> Tambah Data" masukkan nama kriteria</li>
					<li>Masuk ke halaman "Analisa Data -> Analisa Kriteria" masukkan nilai skala dasar untuk antar kriteria</li>
					<li>Pilih nilai skala AHP seperti keterangan berikut :</li>
					<ul>
						<?php
						$stmt = $nilaiObj->readAll();
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
						?>
						<li><?=$row['jum_nilai']?> <?php echo" = ";?> <?=$row['ket_nilai']?></li>
						<?php endwhile; ?>
					</ul>
					<li>Untuk melihat hasil analisa kriteria melalui breadcrumb "Tabel Analisa Kriteria"</li>
				</ol>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
