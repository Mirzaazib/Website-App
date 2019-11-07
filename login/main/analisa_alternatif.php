<?php
include_once('../includes/skor_inc.php');
include_once('../includes/alternatif_inc.php');
include_once('../includes/kriteria_inc.php');
include_once('../includes/nilai_inc.php');

$conn = new Config;
$db = $conn->getConnection();

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$kriObj = new Kriteria($db);
$nilObj = new Nilai($db);

$altCount = $altObj->countAll();

$r = [];
$alt1 = $altObj->readAll();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)) {
	$alt2 = $altObj->readSatu($row['id_alternatif']);
	while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
		$pcs = explode("A", $roww['id_alternatif']);
		$c = $altCount - $pcs[1];
	}
	if ($c>=1) {
		$r[$row['id_alternatif']] = $c;
	}
}
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index.php">&nbspBeranda</a></li>
			<li class="breadcrumb-item active">Analisa Alternatif</li>
			<li class="breadcrumb-item"><a href="#" data-toggle="modal" data-target="#myModalalt">Tabel Analisa Alternatif</a></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-xs-10 col-sm-10 col-md-10 text-left">
		<h2 class="page-header head-font text-muted">
        <span class="fa fa-search"></span>&nbspPerbandingan Alternatif
    </h2>
	</div>
	<div class="col-xs-2 col-sm-2 col-md-2 text-right">
		<a href="#" data-toggle="modal" data-target="#HelpModal"><i class="fa fa-fw fa-info-circle"></i></a>
	</div>
</div>
	
<div class="row justify-content-center">
	<div class="col-5">
		<div class="row">
			<div class="col-md">
			<form method="post" action="index.php?halaman=analisa_alternatif-tabel">
				<div class="form-group"style="text-align:center;">
				<?php
				if(isset($_GET['id'])){?>
					<label for="">Pilih Kriteria</label>
					<select class="form-control" disabled>
					<?php
					$kri =$kriObj->readSatu($_GET['id']); while ($data = $kri->fetch(PDO::FETCH_ASSOC)):?>
						<option value="<?=$data['id_kriteria']?>"><?=$data['nama_kriteria']?></option>
					</select>
					<input type="hidden" class="form-control" name="kriteria" value="<?=$data['id_kriteria'];?>">
					<?php endwhile; ?>
				<?php
				}
				else {?>
					<label>Pilih Kriteria</label>
					<select class="form-control" id="kriteria" name="kriteria">
						<?php 
						$kri2 = $kriObj->readAll(); while ($row = $kri2->fetch(PDO::FETCH_ASSOC)): ?>
							<option value="<?=$row['id_kriteria'] ?>"><?=$row['nama_kriteria'] ?></option>
						<?php endwhile; ?>
					</select>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="card" style="font-size:20px">
	<div class="card-header">
		<div class="row">
			<div class="col-xs-3 col-sm-3 col-md-3">
					<label>Alternatif Pertama</label>
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6">
					<label>Penilaian</label>
			</div>
			<div class="col-xs-3 col-sm-3 col-md-3">
					<label>Alternatif Kedua</label>
			</div>
		</div>
	</div>
	<div class="card-body">
		<?php $no=1; foreach ($r as $k => $v): ?>
			<?php for ($i=1; $i<=$v; $i++): ?>
				<?php $rows = $altObj->readSatu($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
					<div class="row mb-3">
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
								<?php $rows = $skoObj->readAlternatif($k); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
									<input type="text" class="form-control" value="<?=$row['lokasi'] ?>" data-toggle="tooltip" data-placement="top" title="<?=$row['keterangan'];?>" readonly />
									<input type="hidden" name="<?=$k?><?=$no?>" value="<?=$row['id_alternatif'] ?>" />
								<?php endwhile; ?>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<select class="form-control" name="nl<?=$no?>">
								<?php $stmt1 = $nilObj->readAll(); while ($row2 = $stmt1->fetch(PDO::FETCH_ASSOC)): ?>
									<option value="<?=$row2['jum_nilai'] ?>"><?=$row2['jum_nilai'] ?> - <?=$row2['ket_nilai'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>
						</div>
						<div class="col-xs-12 col-md-3">
							<div class="form-group">
							<?php $pcs = explode("A", $k); $nid = "A".($pcs[1]+$i); ?>
							<?php $rows = $skoObj->readAlternatif($nid); while ($row = $rows->fetch(PDO::FETCH_ASSOC)): ?>
								<input type="text" class="form-control" value="<?=$row['lokasi'] ?>" data-toggle="tooltip" data-placement="top" title="<?=$row['keterangan'];?>" readonly/>
								<input type="hidden" name="<?=$nid?><?=$no?>" value="<?=$row['id_alternatif'] ?>" />
							<?php endwhile; ?>
							</div>
						</div>
					</div>
				<?php endwhile; $no++; ?>
			<?php endfor; ?>
		<?php endforeach; ?>
		<button type="submit" name="submit" class="btn btn-dark"><span class="fa fa-arrow-right"></span> Selanjutnya</button>
		</form>
	</div>
</div>

<!-- Modal -->
<div class="modal fade color" id="myModalalt" tabindex="-1" role="dialog" aria-labelledby="myModalLabelalt" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabelalt">Pilih Kriteria</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form-group">
				<div class="list-group">
					<?php $kri1 = $kriObj->readAll(); while ($row = $kri1->fetch(PDO::FETCH_ASSOC)): ?>
						<a href="index.php?halaman=analisa_alternatif-tabel&kriteria=<?=$row['id_kriteria'] ?>" class="list-group-item list-group-item-action"><?=$row['nama_kriteria'] ?></a>
					<?php endwhile; ?>
				</div>
				<hr>
			</div>
		</div>
	</div>
</div>

<!-- Help Modal -->
<!-- Modal Help -->
<div class="modal fade" id="HelpModal" tabindex="-1" role="dialog" aria-labelledby="HelpModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="HelpModal">Bantuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Untuk dapat melakukan analisa alternatif terhadap kriteria ikuti langkah langkah di bawah ini :
				<ol>
					<li>Masukkan data Alternatif yang akan dihitung pada halaman "Input Data -> Data Alternatif -> Tambah Data" masukkan nama alternatif</li>
					<li>Masuk ke halaman "Analisa Data -> Analisa Alternaitf" masukkan nilai skala</li>
					<li>Pilih nilai skala AHP seperti keterangan berikut :</li>
					<ul>
						<?php
						$stmt = $nilObj->readAll(); 
						while ($row= $stmt->fetch(PDO::FETCH_ASSOC)) :
						?>
						<li><?=$row['jum_nilai']?> <?phpecho " = ";?> <?=$row['ket_nilai'];?></li>
						<?php endwhile; ?>
					</ul>
					<li>Untuk melihat hasil analisa alternatif melalui breadcrumb "Tabel Analisa Alternatif"</li>
				</ol>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>


