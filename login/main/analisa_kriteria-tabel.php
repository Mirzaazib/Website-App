<?php
include_once('../includes/bobot_inc.php');
include_once('../includes/kriteria_inc.php');
$conn = new Config();
$db = $conn->getConnection();

$bobotObj = new Bobot($db);
$count = $bobotObj->countAll();
if(isset($_POST['submit'])){
	$kriteriaObj = new Kriteria($db);
	$kriteriaCount = $kriteriaObj->countAll();

	$r = [];//array 1 dimensi
	$kriterias = $kriteriaObj->readAll();
	while ($row = $kriterias->fetch(PDO::FETCH_ASSOC)) {
		$kriteriass = $kriteriaObj->readSatu($row['id_kriteria']);
		while ($roww = $kriteriass->fetch(PDO::FETCH_ASSOC)) {
			$pcs = explode("C", $roww['id_kriteria']);
			$c = $kriteriaCount - $pcs[1];
		}
		if ($c>=1) {
			$r[$row['id_kriteria']] = $c;
		}
	}

	$no=1;
	foreach ($r as $k => $v) {
		for ($i=1; $i<=$v; $i++) {
			$pcs = explode("C", $k);
			$nid = "C".($pcs[1]+$i);
			if ($bobotObj->insert($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no])) {
				// ...
			} else {
				$bobotObj->update($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no]);
			}

			if ($bobotObj->insert($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no])) {
				// ...
			} else {
				$bobotObj->update($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no]);
			}
			$no++;
		}
	}
}

if (isset($_POST['hapus'])) {
	$bobotObj->delete();
	echo "<script>location.href='index.php?halaman=analisa_kriteria-tabel'</script>";
}
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
  	<ol class="breadcrumb">
		  <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> <a href="index.php">&nbspBeranda</a></li>
		  <li class="breadcrumb-item"><a href="index.php?halaman=analisa_kriteria">Analisa Kriteria</a></li>
		  <li class="breadcrumb-item active">Tabel Analisa Kriteria</li>
		</ol>
    <h2 class="page-header head-font text-muted">
        <span class="fa fa-table"></span>&nbspTabel Perbandingan Kriteria
    </h2>
  </div>
</div>

<div class="row">
  <div class="col-12 text-right">
    <form method="post">
      <button name="hapus" class="btn btn-danger">Hapus Semua Data</button>
    </form>
  </div>
</div>

<div class="row">	
  <div class="col-xs-12 col-sm-12 col-md-12">
		<br/>
		<div class="table-responsive mb-3">
			<table class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="table-danger">Perbandingan Kriteria</th>
						<?php $bobots1 = $bobotObj->readAll2(); while ($row = $bobots1->fetch(PDO::FETCH_ASSOC)): ?>
						<th class="table-secondary"><?=$row['nama_kriteria'] ?></th>
						<?php endwhile; ?>
					</tr>
				</thead>
				<tbody>
					<?php $bobots2 = $bobotObj->readAll2(); while ($baris = $bobots2->fetch(PDO::FETCH_ASSOC)): ?>
						<tr>
							<th class="table-secondary active"><?=$baris['nama_kriteria'] ?></th>
							<?php $bobots3 = $bobotObj->readAll2(); while ($kolom = $bobots3->fetch(PDO::FETCH_ASSOC)): ?>
								<td>
									<?php
									if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
										echo '1';
										if ($bobotObj->insert($baris['id_kriteria'], '1', $kolom['id_kriteria'])) {
											// ...
										} else {
											$bobotObj->update($baris['id_kriteria'], '1', $kolom['id_kriteria']);
										}
									} else {
										$bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
										echo number_format($bobotObj->kp, 4, ',', '.');
									}
									?>
								</td>
							<?php endwhile; ?>
						</tr>
					<?php endwhile; ?>
				</tbody>
				<tfoot>
					<tr class="table-info">
						<th>Jumlah</th>
						<?php $stmt5 = $bobotObj->readAll2(); while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)): ?>
							<th>
								<?php
									$bobotObj->readSum1($row['id_kriteria']);
									echo number_format($bobotObj->nak, 4, ',', '.');
									$bobotObj->insert3($bobotObj->nak, $row['id_kriteria']);
								?>
							</th>
						<?php endwhile; ?>
					</tr>
				</tfoot>
			</table>
		</div>
		
		<div class="table-responsive mb-3">
			<table width="100%" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="table-danger">Normalisasi</th>
						<?php $bobots1x = $bobotObj->readAll2(); while ($row2x = $bobots1x->fetch(PDO::FETCH_ASSOC)): ?>
						<th class="table-secondary"><?=$row2x['nama_kriteria'] ?></th>
						<?php endwhile; ?>
						<th class="table-info table-stripped">Jumlah</th>
						<th class="table-success">Eignvector</th>
					</tr>
				</thead>
				<tbody>
					<?php $bobots2x = $bobotObj->readAll2(); while ($baris = $bobots2x->fetch(PDO::FETCH_ASSOC)): ?>
						<tr>
							<th class="table-secondary active"><?=$baris['nama_kriteria'] ?></th>
							<?php $stmt4x = $bobotObj->readAll2(); while ($kolom = $stmt4x->fetch(PDO::FETCH_ASSOC)): ?>
								<td>
								<?php
									if ($baris['id_kriteria'] == $kolom['id_kriteria']) {
										$c = 1/$kolom['jumlah_kriteria'];
										$bobotObj->insert2($c, $baris['id_kriteria'], $kolom['id_kriteria']);
										echo number_format($c, 4, ',', '.');
									} else {
										$bobotObj->readAll1($baris['id_kriteria'], $kolom['id_kriteria']);
										$c = $bobotObj->kp/$kolom['jumlah_kriteria'];
										$bobotObj->insert2($c, $baris['id_kriteria'], $kolom['id_kriteria']);
										echo number_format($c, 4, ',', '.');
									}
									?>
								</td>
							<?php endwhile; ?>
							<th class="table-info">
								<?php
								$bobotObj->readSum2($baris['id_kriteria']);
								$j = $bobotObj->hak;
								echo number_format($j, 4, ',', '.');
								?>
							</th>
							<th class="table-success">
								<?php
								$bobotObj->readAvg($baris['id_kriteria']);
								$b = $bobotObj->hak;
								$bobotObj->insert4($b, $baris['id_kriteria']);
								echo number_format($b, 4, ',', '.');
								?>
							</th>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		
		<div class="table-responsive mb-3">
			<table width="100%" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th class="table-danger">Rasio Konsistensi</th>
						<th class="table-info">Jumlah</th>
						<th class="table-success">Prioritas</th>
						<th class="table-primary">Hasil</th>
					</tr>
				</thead>
				<tbody>
					<?php $total=0; $bobots1z = $bobotObj->readAll2(); while ($row1 = $bobots1z->fetch(PDO::FETCH_ASSOC)): ?>
						<tr>
							<th class="table-secondary active"><?=$row1["nama_kriteria"]?></th>
							<th class="table-info"><?=number_format($row1["jumlah_kriteria"], 4, ',', '.')?></th>
							<th class="table-success"><?=number_format($row1["bobot_kriteria"], 4, ',', '.');?></th>
							<?php $jumlah = $row1["jumlah_kriteria"] * $row1["bobot_kriteria"]; ?>
							<th class="table-primary"><?=number_format($jumlah, 4, ',', '.');?></th>
							<?php $total += $jumlah; ?>
						</tr>
					<?php endwhile; ?>
				</tbody>
				<tfoot>
					<tr class="table-warning">
						<th colspan="3">λ maks</th>
						<th><?php $total; echo number_format($total, 4, ',', '.'); ?></th>
					</tr>
				</tfoot>
			</table>
		</div>	
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-6" style="text-align:center">
		<table width="100%" class="table table-striped table-bordered table-hover">
			<tbody>
				<tr class="table-secondary">
					<th>N (kriteria)</th>
					<td><?=$count?></td>
				</tr>
				<tr>
					<th>Hasil Akhir (λ maks)</th>
					<td><?=number_format($total, 4, ',', '.');?></td>
				</tr>
				<tr class="table-secondary">
					<th>IR</th>
					<?php $ir = $bobotObj->getIr($count); ?>
					<td><?php echo  number_format($ir, 2, ',', '.');?></td>
				</tr>
				<tr>
					<th>CI</th>
					<td><?php $ci = ($total-$count)/($count-1); echo number_format($ci, 4, ',', '.');?></td>
				</tr>
				<tr class="table-secondary">
					<th>CR</th>
					<td><?php $cr = $ci/$ir; echo number_format($cr, 4, ',', '.');?></td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<?php
	if ($cr <= 0.1) {
		$color = "success";
		$link = '<a href="index.php?halaman=analisa_alternatif" class="alert alert-link">Analisa Alternatif</a>';
		$msgkonsisten = "Hasil Dari Consistency Ratio = ". number_format($cr, 4, ',', '.'). "<br>Consistency Ratio Terpenuhi Silahkan Lanjut ke ". $link;
	} else {
		$color = "danger";
		$link = '<a href="index.php?halaman=analisa_kriteria" class="alert alert-link">Analisa Kriteria</a>';
		$msgkonsisten = "Hasil Dari Consistency Ratio = ". number_format($cr, 4, ',', '.'). "<br>Consistency Ratio Tidak Terpenuhi Silahkan Kembali ke ". $link;
	}
	?>
	
	<div class="col-xs-12 0l-sm-12 col-md-6 mt-5">
		<div class="alert alert-<?=$color;?>" role="alert">
			<?=$msgkonsisten;?>
		</div>
	</div>
</div>