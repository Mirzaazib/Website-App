<?php
include_once('../includes/alternatif_inc.php');
include_once('../includes/kriteria_inc.php');
include_once('../includes/ranking_inc.php');
$conn = new Config;
$db = $conn->getConnection();

$altObj = new Alternatif($db);

$kriObj = new Kriteria($db);

$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
$stmtx1y = $ranObj->readBob();
$stmtx2y = $ranObj->readBob();
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
  	<ol class="breadcrumb">
      <li class="breadcrumb-item">
          <i class="fa fa-dashboard">&nbsp</i><a href="index.php">Dashboard</a>
      </li>
      <li class="breadcrumb-item active">Perankingan</li>
  	</ol>
    <h2 class="page-header head-font text-muted">
		<i class="fa fa-graduation-cap"></i>&nbsp Perankingan
    </h2>
  </div>
</div>
<!-- Tabel -->
<div class="card mb-3">
	<div class="card-header text-center font">
		<h4>Data Pembobotan</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover text-center">
				<thead>
						<tr>
							<th rowspan="4" class="text-center active table-danger">Alternatif</th>
							<th colspan="<?php $kri1a = $kriObj->readAll(); echo $kri1a->rowCount(); ?>" class="text-center table-danger">Kriteria</th>
						</tr>
						<tr>
							<?php $kri2a = $kriObj->readAll(); while ($row = $kri2a->fetch(PDO::FETCH_ASSOC)): ?>
								<th class="table-secondary"><?=$row['nama_kriteria']?></th>
							<?php endwhile; ?>
						</tr>
						<tr class="table-success">
							<?php $bobot1 = $ranObj->readBob(); while ($row = $bobot1->fetch(PDO::FETCH_ASSOC)): ?>
								<td><?=number_format($row['bobot_kriteria'], 4, ',', '.')?></td>
							<?php endwhile; ?>
						</tr>
						<tr>
							<?php $kri2a = $kriObj->readAll(); while ($row = $kri2a->fetch(PDO::FETCH_ASSOC)): ?>
							<th class="table-secondary active"><?=$row['nama_kriteria']?></th>
							<?php endwhile; ?>
						</tr>
					</thead>
				<tbody>
					<?php $alt1a = $altObj->readAll(); while ($row1 = $alt1a->fetch(PDO::FETCH_ASSOC)): ?>
						<tr>
							<th class="active table-secondary" data-toggle="tooltip" data-placement="top" title="<?=$row1['keterangan'];?>"><?=$row1['lokasi']?></th>
							<?php $a = $row1['id_alternatif']; ?>
							<?php	$kri2a = $kriObj->readAll(); while ($row2 = $kri2a->fetch(PDO::FETCH_ASSOC)): ?>
								<?php $b = $row2['id_kriteria']; ?>
								<?php $ran1a = $ranObj->readR($a, $b); while ($row3 = $ran1a->fetch(PDO::FETCH_ASSOC)): ?>
									<td>
										<?php
											echo $nor = number_format($row3['skor_alt_kri'], 4, ',', '.');
											/*
											pow($rowr['skor_alt_kri'],$bobot);
											$ranObj->ia = $a;
											$ranObj->ik = $b;
											$ranObj->nn4 = $nor;
											$ranObj->normalisasi1();
											*/
										?>
									</td>
								<?php endwhile; ?>
							<?php endwhile; ?>
						</tr>
					<?php endwhile; ?>
					<!-- <tr class="info">
						<th>Jumlah</th>
						<?php //$bobot2 = $ranObj->readBob(); while ($row = $bobot2->fetch(PDO::FETCH_ASSOC)): ?>
							<td>
								<?php
									// $rmax1 = $ranObj->readMax($row['id_kriteria']);
									// $max = $rmax1->fetch(PDO::FETCH_ASSOC);
									// echo number_format($max['mnr1'], 4, '.', ',');
								?>
							</td>
						<?php //endwhile; ?>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card mb-3">
	<div class="card-header text-center font">
		<h4>Hasil Akhir</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table width="100%" class="table table-striped table-bordered table-hover text-center">
				<thead>
					<tr>
						<th colspan="Hasil Akhir" rowspan="2" class="text-center active table-danger">Alternatif</th>
						<th colspan="<?php $kri1b = $kriObj->readAll(); echo $kri1b->rowCount(); ?>" class="text-center table-danger">Kriteria</th>
						<th rowspan="2" class="text-center table-success">Hasil Akhir</th>
					</tr>
					<tr>
						<?php $kri2b = $kriObj->readAll(); while ($row = $kri2b->fetch(PDO::FETCH_ASSOC)): ?>
							<th class="table-secondary"><?=$row['nama_kriteria']?></th>
						<?php endwhile; ?>
					</tr>
				</thead>
				<tbody>
					<?php $alt1b = $altObj->readAll(); while ($row1 = $alt1b->fetch(PDO::FETCH_ASSOC)): ?>
						<tr>
							<th class="table-secondary active" data-toggle="tooltip" data-placement="top" title="<?=$row1['keterangan'];?>"><?=$row1['lokasi']?></th>
							<?php $a1 = $row1['id_alternatif']; ?>
							<?php $kri2b = $kriObj->readAll(); while ($row2 = $kri2b->fetch(PDO::FETCH_ASSOC)): ?>
								<?php $b2 = $row2['id_kriteria']; ?>
								<?php $ran1b = $ranObj->readR($a1, $b2); while ($row3 = $ran1b->fetch(PDO::FETCH_ASSOC)): ?>
									<td>
										<?php
											$norx = $row3['skor_alt_kri'] * $row2['bobot_kriteria'];
											//pow($row3['skor_alt_kri'],$bobot);
											echo number_format($norx, 4, ',', '.');
											$ranObj->ia = $a1;
											$ranObj->ik = $b2;
											$ranObj->nn4 = $norx;
											$ranObj->normalisasi1();
										?>
									</td>
								<?php endwhile; ?>
							<?php endwhile; ?>
							<td class="table-success">
								<?php
								$stmthasil = $ranObj->readHasil1($a1);
								$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
								echo number_format($hasil['bbn'], 4, ',', '.');
								$ranObj->ia = $a1;
								$ranObj->has1 = $hasil['bbn'];
								$ranObj->hasil1();
								?>
							</td>
						</tr>
					<?php endwhile; ?>
					<!-- <tr>
						<th>Jumlah</th>
						<?php //while ($rowx2 = $stmtx2y->fetch(PDO::FETCH_ASSOC)): ?>
							<td>
								<?php
									// $stmtx3y = $ranObj->readMax($rowx2['id_kriteria']);
									// $rowx3 = $stmtx3y->fetch(PDO::FETCH_ASSOC);
									// echo number_format($rowx3['mnr1'], 5, '.', ',');
								?>
							</td>
						<?php //endwhile; ?>
						<td>
							<?php
								// $stmtx4y = $ranObj->readMax2();
								// $rowx4 = $stmtx4y->fetch(PDO::FETCH_ASSOC);
								// echo number_format($rowx4['mnr2'], 5, '.', ',');
							?>
						</td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="card mb-3">
	<div class="card-header text-center font">
		<h4>Hasil Perankingan</h4>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table width="100%" class="table table-striped table-bordered text-center" id="tabeldata">
				<thead>
				<tr class="table-secondary">
					<th>No</th>
					<th>Lokasi</th>
					<th>Keterangan</th>
					<th>Hasil Akhir</th>
					<th>Ranking</th>
				</tr>
				</thead>
				<tbody>
				<?php $no = 1; $rank = 1; $alt1c = $altObj->readByRank(); while ($row = $alt1c->fetch(PDO::FETCH_ASSOC)): ?>
							<tr>
						<td><?=$no++?></td>
						<td><?=$row["lokasi"]?></td>
						<td><?=$row["keterangan"]?></td>
						<td><?=number_format($row["hasil_akhir"], 4, ',', '.')?></td>
						<td><?=$rank++?></td>
							</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- -->