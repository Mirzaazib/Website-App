<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>
    </div>
</div>

<?php
include_once('../includes/kriteria_inc.php');
include_once('../includes/alternatif_inc.php');
include_once('../includes/nilai_inc.php');
$conn = new Config();
$db = $conn->getConnection();

$kri = new Kriteria($db);
$countKri = $kri->countAll();
$alt = new Alternatif($db);
$countAlt = $alt->countAll();
$alt->countMax();


$nilai = new Nilai($db);
$countNilai = $nilai->countAll();
?>

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-8">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-area-chart"></i> Grafik Perangkingan</div>
      <div class="card-body" width="100%" height="50">
        <canvas id="myChart"></canvas>
      </div>
      <script> 
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: [ <?php $stmt = $alt->readAll(); while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :?> "<?= $row['lokasi']?>", <?php endwhile; ?>],
            datasets: [{
              label: "",
              backgroundColor: "rgba(2,117,216,1)",
              borderColor: "rgba(2,117,216,1)",
              data: [<?php $stmt = $alt->readAll(); while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) :?> <?= number_format($row['hasil_akhir'], 2,'.',',')?>, <?php endwhile; ?>],
            }],
          },
          options: {
            animation: {
              duration: 2000,
              easing: 'easeInQuart'
            },
            responsive: true,
            mainAspecRatio:true,
            scales: {
              xAxes: [{
                gridLines: {
                  display: false
                }
              }],
              yAxes: [{
                ticks: {
                  min: 0,
                  max: <?= number_format($alt->hsl, 2,'.',','); ?>,
                },
                gridLines: {
                  display: true
                }
              }],
            },
            legend: {
              display: false
            },
          }
        });
      </script>
    </div>
  </div>
  <div class="col-xs-12 col-sm-12 col-md-4">
  <div class="card">
    <div class="card-header">
      <i class="fa fa-pie-chart"></i> Data Perhitungan AHP</div>
    <div class="card-body">
      <canvas id="myPieChart" width="100%" height="100"></canvas>
    </div>
    <script>
    var ctx = document.getElementById("myPieChart").getContext('2d');
    var myPieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        labels: ["Data Kriteria", "Data Alternatif", "Nilai Skala",],
        datasets: [{
          data: [<?=$countKri?>, <?=$countAlt?>, <?=$countNilai?>],
          backgroundColor: ['#007bff', '#dc3545', '#ffc107'],
        }],
      },
      options: {
        animation: {
          duration: 2000,
          easing: 'easeInQuart'
        },
      }
    });
    </script>
    </div>
  </div>
</div>


