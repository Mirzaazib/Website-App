<?php
session_start();
if(!isset($_SESSION['id_pengguna'])||$_SESSION['id_pengguna']==''){
	echo "<script>location.href=index.php</script>";
}

    define('FPDF_FONTPATH','../includes/fpdf/font/');
    require('../includes/fpdf/fpdf.php');
     
    class PDF extends FPDF
    {
    	//Page header
    	function Judul()
    	{
				//Logo
				//$this->Image('logo-ubl.jpg',10,8);
				//Custom Font
				$this->AddFont('OleoScript-Bold','','OleoScript-Bold.php');
				$this->SetFont('OleoScript-Bold','',20);
				//pindah ke posisi ke tengah untuk membuat judul
				$this->Cell(80);
				// Judul
				$this->Cell(30,7,'Laporan Sistem Penunjang Keputusan',0,1,'C');
				$this->Cell(80);
				$this->Cell(30,7,'Menentukan Lokasi Cabang',0,1,'C');
				$this->Cell(80);
				$this->Cell(30,7,'Kedai Raden Bandung',0,1,'C');
				// Line break 5mm
				$this->Ln(10);
			}
			
			function garis()
			{
				//buat garis horisontal
    		$this->SetLineWidth(1);
				$this->Line(10,36,200,36);
				$this->SetLineWidth(0);
				$this->Line(10,37,200,37);
				$this->Ln(10);
			}
     
    	//Page Content
    	function Content()
    	{
				include "../includes/connection.php";
				$conn = new Config;
				$db = $conn->getConnection();
				//Alternatif
				include_once('../includes/alternatif_inc.php');
				$alt = new Alternatif($db);
				//Kriteria
				include_once('../includes/kriteria_inc.php');
				$kri = new Kriteria($db);
				//Ranking
				include_once('../includes/ranking_inc.php');
				$rank = new Ranking($db);
				//Custom Font Head
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',16);
				$this->Cell(40,15,'Bobot Kriteria',0,0,'L',false);
				$this->Ln();
				//Custom Font Tabel
				$this->AddFont('NotoSerif-Regular','','NotoSerif-Regular.php');
				$this->SetFont('NotoSerif-Regular','',12);
				$this->SetFillColor(210,210,210);
				$this->Cell(30,7,'',1,0,'C',true);
				//Nama Kriteria
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',12);
				$stmt2 = $kri->readAll();
				while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
					$this->Cell(30,7,$row['nama_kriteria'],1,0,'C',true);
				}
				$this->Ln();
				//Jml bobot
				$this->Cell(30,7,'Bobot',1,0,'C',true);
				$this->AddFont('NotoSerif-Regular','','NotoSerif-Regular.php');
				$this->SetFont('NotoSerif-Regular','',12);
				$stmt3 = $rank->readBob();
				while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)){
					$this->Cell(30,7,number_format($row['bobot_kriteria'],4,',','.'),1,0,'C');
				}
				$this->Ln();
				
				//Custom Font Head
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',16);
				$this->Cell(40,15,'Bobot Alternatif Kriteria',0,0,'L',false);
				$this->Ln();
				//Custom Font Tabel
				$this->AddFont('NotoSerif-Regular','','NotoSerif-Regular.php');
				$this->SetFont('NotoSerif-Regular','',12);
				$this->SetFillColor(210,210,210);
				$this->Cell(30,7,'',1,0,'C',true);
				//Nama Kriteria
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',12);
				$stmt2 = $kri->readAll();
				while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
					$this->Cell(30,7,$row['nama_kriteria'],1,0,'C',true);
				}
				$this->Ln();
				$fill = false;
				$stmt1 = $alt->readAll();
				while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
					$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
					$this->SetFont('NotoSerif-Bold','',12);
					$this->SetFillColor(210,210,210);
					$this->Cell(30,7,$row['lokasi'],1,0,'C',true);
					$a = $row['id_alternatif'];
					$stmt2 = $kri->readAll();
					while ($row1 = $stmt2->fetch(PDO::FETCH_ASSOC)){
						$b = $row1['id_kriteria'];
						$stmtrow = $rank->readR($a,$b);
						while ($row2 = $stmtrow->fetch(PDO::FETCH_ASSOC)){
						$this->AddFont('NotoSerif-Regular','','NotoSerif-Regular.php');
						$this->SetFont('NotoSerif-Regular','',12);	
						$this->SetFillColor(235,235,235);
						$this->Cell(30,7,number_format($row2['skor_alt_kri'],4,',','.'),1,0,'C',$fill);
						}
					}
					$fill = !$fill;
					$this->Ln();
				}

				//Custom Font Head
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',16);
				$this->Cell(40,15,'Hasil Akhir',0,0,'L',false);
				$this->Ln();
				//Custom Font Tabel
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',12);
				$this->SetFillColor(210,210,210);
				$this->Cell(30,7,'',1,0,'C',true);
				//Nama Kriteria
				$stmt2 = $kri->readAll();
				while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
					$this->Cell(25,7,$row['nama_kriteria'],1,0,'C',true);
				}
				$this->Cell(25,7,'Hasil',1,0,'C',true);
				$this->Ln();
				$fill = false;
				$stmt1 = $alt->readAll();
				while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
					$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
					$this->SetFont('NotoSerif-Bold','',12);
					$this->SetFillColor(210,210,210);
					$this->Cell(30,7,$row['lokasi'],1,0,'C',true);
					$a = $row['id_alternatif'];
					$stmt2 = $kri->readAll();
					while ($row1 = $stmt2->fetch(PDO::FETCH_ASSOC)){
						$b = $row1['id_kriteria'];
						$stmt3data = $rank->readR($a,$b);
						while ($row2 = $stmt3data->fetch(PDO::FETCH_ASSOC)){								
						$this->AddFont('NotoSerif-Regular','','NotoSerif-Regular.php');
						$this->SetFont('NotoSerif-Regular','',12);
						$this->SetFillColor(235,235,235);
						$this->Cell(25,7,number_format($row2['hasil_alt_kri'],4,',','.'),1,0,'C',$fill);
					}
				}
					$stmt3hsl = $rank->readHasil2($a);
					while ($row3 = $stmt3hsl->fetch(PDO::FETCH_ASSOC)){
						$this->Cell(25,7,number_format($row3['hasil_akhir'],4,',','.'),1,0,'C',$fill);
					}
					$fill = !$fill;
					$this->Ln();
				}

				//Custom Font Head
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',16);
				$this->Cell(40,15,'Hasil Perankingan',0,0,'L',false);
				$this->Ln();
				//Custom Font Tabel
				$this->AddFont('NotoSerif-Bold','','NotoSerif-Bold.php');
				$this->SetFont('NotoSerif-Bold','',12);
				$this->SetFillColor(210,210,210);
				
				$this->Cell(18,7,'No',1,0,'C',true);
				$this->Cell(82,7,'Lokasi',1,0,'C',true);
				$this->Cell(40,7,'Hasil Akhir',1,0,'C',true);
				$this->Cell(40,7,'Ranking',1,0,'C',true);
				//
				$this->SetFillColor(235,235,235);
				$this->Ln();
				$no = 1;
				$rank = 1;
				$fill = false;
				$stmt1 = $alt->readByRank();
				while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)){
					$this->AddFont('NotoSerif-Regular','','NotoSerif-Regular.php');
					$this->SetFont('NotoSerif-Regular','',12);
					$this->Cell(18,7,$no++,1,0,'C',$fill);
					$this->Cell(82,7,$row['keterangan'],1,0,"C",$fill);
					$this->Cell(40,7,number_format($row['hasil_akhir'],4,',','.'),1,0,"C",$fill);
					$this->Cell(40,7,$rank++,1,0,'C',$fill);
					$fill = !$fill;
					$this->Ln();
				}
				
			}
     
    	//Page footer
    	function Footer()
    	{
    		//atur posisi 1.5 cm dari bawah
    		$this->SetY(-15);
    		//buat garis horizontal
    		$this->Line(10,$this->GetY(),200,$this->GetY());
    		//Arial italic 9
    		$this->SetFont('Arial','I',9);
				//nomor halaman
				$this->Cell(0,10,date("l Y/m/d"),0,0,'L');
    		$this->Cell(0,10,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
    	}
    }
     
    //contoh pemanggilan class
    $pdf = new PDF('P','mm','A4');
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->Judul();
		$pdf->garis();
    $pdf->Content();
    $pdf->Output('Hasil akhir', 'I');
?>