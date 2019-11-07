<?php
include_once('../includes/skor_inc.php');
include_once('../includes/kriteria_inc.php');
include_once('../includes/alternatif_inc.php');
$conn = new Config;
$db = $conn->getConnection();

$skoObj = new Skor($db);
$kriObj = new Kriteria($db);

if (isset($_POST['kriteria'])) {
	$altkriteria = $_POST['kriteria'];
}else {
	$altkriteria = $_GET['kriteria'];
}

if (isset($altkriteria)) {
	$skoObj->readKri($altkriteria);
	$count = $skoObj->countAll();
	$countkri = $kriObj->countAll();
		

	if (isset($_POST['submit'])) {
		$altObj = new Alternatif($db);
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

		$no=1;
		foreach ($r as $k => $v) {
			for ($i=1; $i<=$v; $i++) {
        $pcs = explode("A", $k);
		$nid = "A".($pcs[1]+$i);
		
				if ($skoObj->insert($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $altkriteria)) {
					// ...
				} else {
					$skoObj->update($_POST[$k.$no], $_POST['nl'.$no], $_POST[$nid.$no], $altkriteria);
				}

				if ($skoObj->insert($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $altkriteria)) {
					// ...
				} else {
					$skoObj->update($_POST[$nid.$no], 1/$_POST['nl'.$no], $_POST[$k.$no], $altkriteria);
				}
				$no++;
			}
		}
	}

	if (isset($_POST['hapus'])) {
		$skoObj->delete();
		echo "<script>location.href='index.php?halaman=analisa_alternatif'</script>";
		exit;
	}


	?>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><i class="fa fa-dashboard"></i><a href="index.php">&nbspBeranda</a></li>
				<li class="breadcrumb-item"><a href="index.php?halaman=analisa_alternatif">Analisa Alternatif</a></li>
				<li class="breadcrumb-item active">Tabel Analisa Alternatif</li>
			</ol>
			<h2 class="page-header head-font text-muted">
				<span class="fa fa-table"></span>&nbspTable Perbandingan Alternatif : Menurut Kriteria <?=$skoObj->kri;?>
			</h2>
		</div>
	</div>

	<div class="row">
		<div class="col-12 text-right">
			<form method="post">
				<button name="hapus" class="btn btn-danger">Hapus Semua Data</button>
			</form>
		</div>
	</div><br/>

	<div class="row">
		<div class="col-12">
			<div class="table-responsive mb-3">
				<table width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="table-danger"><?=$skoObj->kri?></th>
							<?php $alt1a = $skoObj->readAll2(); while ($row = $alt1a->fetch(PDO::FETCH_ASSOC)): ?>
							<th class="table-secondary" data-toggle="tooltip" data-placement="right" title="<?=$row['keterangan'];?>"><?=$row['lokasi']?></th>
							<?php endwhile; ?>
						</tr>
					</thead>
					<tbody>
						<?php $alt2a = $skoObj->readAll2(); while ($baris = $alt2a->fetch(PDO::FETCH_ASSOC)): ?>
							<tr>
								<th class="table-secondary active" data-toggle="tooltip" data-placement="top" title="<?=$baris['keterangan'];?>"><?=$baris['lokasi']?></th>
								<?php $alt3a = $skoObj->readAll2(); while ($kolom = $alt3a->fetch(PDO::FETCH_ASSOC)): ?>
									<td>
									<?php
										if ($baris['id_alternatif'] == $kolom['id_alternatif']) {
											echo '1';
											if (!$skoObj->insert($baris['id_alternatif'], '1', $kolom['id_alternatif'], $altkriteria)) {
												$skoObj->update($baris['id_alternatif'], '1', $kolom['id_alternatif'], $altkriteria);
											}
										} else {
											$skoObj->readAll1($baris['id_alternatif'], $kolom['id_alternatif'], $altkriteria);
											echo number_format($skoObj->kp, 4, ',', '.');
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
							<?php /*$jumlahBobot=[];*/ $alt4a = $skoObj->readAll2(); while ($row = $alt4a->fetch(PDO::FETCH_ASSOC)): ?>
							<th>
								<?php
									$skoObj->readSum1($row['id_alternatif'], $altkriteria);
									echo number_format($skoObj->nak, 4, ',', '.');
									if (!$skoObj->insert3($row['id_alternatif'], $altkriteria, $skoObj->nak)) {
										$skoObj->insert5($skoObj->nak, $row['id_alternatif'], $altkriteria);
									}
									// $jumlahBobot[$row["id_alternatif"]] = $skoObj->nak;
								?>
							</th>
						<?php endwhile;?>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="table-responsive mb-3">
				<table width="100%" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="table-danger">Normalisasi</th>
							<?php $alt1b = $skoObj->readAll2(); while ($row = $alt1b->fetch(PDO::FETCH_ASSOC)): ?>
								<th class="table-secondary" data-toggle="tooltip" data-placement="right" title="<?=$row['keterangan'];?>"><?=$row['lokasi']?></th>
							<?php endwhile; ?>
							<th class="table-info">Jumlah</th>
							<th class="table-success">Eignvector</th>
						</tr>
					</thead>
					<tbody>
						<?php $alt2b = $skoObj->readAll2(); while ($baris = $alt2b->fetch(PDO::FETCH_ASSOC)): ?>
							<tr>
								<th class="table-secondary active" data-toggle="tooltip" data-placement="top" title="<?=$baris['keterangan'];?>"><?=$baris['lokasi']?></th>
								<?php $alt3b = $skoObj->readAll2(); while ($kolom = $alt3b->fetch(PDO::FETCH_ASSOC)): ?>
									<td>
										<?php
											$skoObj->readAll3($kolom['id_alternatif'], $altkriteria);
											$jumlahBobot = $skoObj->jak;
											if ($baris['id_alternatif'] == $kolom['id_alternatif']) {
												$n = 1/$jumlahBobot;
												$skoObj->insert2($n, $baris['id_alternatif'], $kolom['id_alternatif'], $altkriteria);
												echo number_format($n, 4, ',', '.');
											} else {
												$skoObj->readAll1($baris['id_alternatif'], $kolom['id_alternatif'], $altkriteria);
												$bobot = $skoObj->kp;
												$n = $bobot/$jumlahBobot;
												$skoObj->insert2($n, $baris['id_alternatif'], $kolom['id_alternatif'], $altkriteria);
												echo number_format($n, 4, ',', '.');
											}
										?>
									</td>
								<?php endwhile; ?>
								<th class="table-info">
									<?php
									$skoObj->readSum2($baris['id_alternatif'], $altkriteria);
									$jml = $skoObj->nak;
									echo number_format($jml, 4, ',', '.');
									?>
								</th>
								<th class="table-success">
									<?php
									$skoObj->readAvg($baris['id_alternatif'], $altkriteria);
									$prioritas = $skoObj->hak;
									$skoObj->insert4($prioritas, $baris['id_alternatif'], $altkriteria);
									echo number_format($prioritas, 4, ',', '.');
									?>
								</th>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php
	if(isset($_POST['submit'])){
		$data_exp = explode("C", $altkriteria);
		$incr = $data_exp[1] + 1;
		?>
		<div class="row mb-3">
			<div class="col-12">
				<?php
				if($incr <= $countkri){?>
				<a href="index.php?halaman=analisa_alternatif&id=C<?=$incr?>" class="btn btn-dark"><span class="fa fa-arrow-right"></span> Selanjutnya</a>
				<?php 
				} else{?>
				<button onclick="alert()" class="btn btn-dark"><span class="fa fa-check"></span> Selesai</button>
					<script>
						function alert(){
							swal({
								title: "Success!",
								text: "Analisa Alternatif Berhasil",
								type: "success"
							}, function(){
              window.location.href = "index.php?halaman=analisa_alternatif";
        		});
						}
    			</script>
			</div>
		</div>
<?php	}	
	}
	?>
<?php } else {
	echo "<script>location.href='index.php?halaman=analisa_alternatif'</script>";
}
?>
