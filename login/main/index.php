<?php
include '../includes/connection.php';
include_once '../includes/profile_inc.php';
  $conn = new Config();
  $db = $conn->getConnection();
  $pflObj = new Profile($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="Mirza" content="">
  <title>Dashboard MySPK</title>
  
  <link rel="shortcut icon" href="../../dist/img/favicon.png">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Courgette|Philosopher|Roboto|Roboto+Slab|Viga&display=swap" rel="stylesheet">
  <!-- Bootstrap core CSS-->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="../assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin.css" rel="stylesheet">
  <!--sweetalert-->
  <link rel="stylesheet" href="../assets/vendor/sweetalert/css/sweetalert.css">
  <!--toastmessage-->
  <link rel="stylesheet" href="../assets/vendor/toastmessage/css/jquery.toastmessage.css">
  <!-- Chart.js -->
  <script src="../assets/vendor/chartjs/Chart.js"></script>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!--check session login-->
<?php
	session_start();

    if (!isset($_SESSION['level_user']) || $_SESSION['level_user'] == '' ) {
			header('location:./../login.php');
	exit();
}
?>
<!-- -->
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Metode AHP</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <?php if($_SESSION['level_user'] == "Admin"): ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Skala AHP">
          <a class="nav-link" href="index.php?halaman=nilai">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Skala AHP</span>
          </a>
        </li>
        <?php endif; ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Input Data">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Input Data</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="index.php?halaman=data_kriteria"><i class="fa fa-fw fa-book"></i>Data Kriteria</a>
            </li>
            <li>
              <a href="index.php?halaman=data_alternatif"><i class="fa fa-fw fa-file-text-o"></i>Data Alternatif</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Analisa Data">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Analisa Data</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="index.php?halaman=analisa_kriteria"><i class="fa fa-fw fa-pencil-square-o"></i>Analisa Kriteria</a>
            </li>
            <li>
              <a href="index.php?halaman=analisa_alternatif"><i class="fa fa-fw fa-pencil-square-o"></i>Analisa Alternatif</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Perankingan">
          <a class="nav-link" href="index.php?halaman=perankingan">
            <i class="fa fa-fw fa-graduation-cap"></i>
            <span class="nav-link-text">Ranking</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Laporan">
          <a class="nav-link" href="laporan.php">
            <i class="fa fa-fw fa-file-pdf-o"></i>
            <span class="nav-link-text">Laporan</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          $id = $_SESSION['id_pengguna'];
          $pflObj->id = $id;
          $pflObj->read();
          ?>
          <img src="../assets/images/profile/<?=$pflObj->foto;?>" class="nav-images" alt=""> <?=$_SESSION['nama'];?>
          </a>
          <div class="dropdown-menu  dropdown-shadow" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header"><?=$_SESSION['level_user']?> Profile</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" data-toggle='modal' data-target='#profilemodal' href="#">
              <strong><i class="fa fa-fw fa-gear"></i> </strong><span class="large float-center text-muted">Pengaturan  
            </a>
            <a class='dropdown-item btn' data-toggle='modal' data-target='#logoutModal' data-href='../'>
              <strong><i class="fa fa-fw fa-power-off"></i> </strong><span class="large float-center text-muted">Keluar
            </a>
            <div class="dropdown-divider"></div>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
    <?php
      if (isset($_GET['halaman'])) {
          if($_GET['halaman']=="data_kriteria-master"){
              include 'data_kriteria-master.php';
              }
          if($_GET['halaman']=="data_kriteria"){
              include 'data_kriteria.php';
              }
          if($_GET['halaman']=="data_kriteria-baru"){
              include 'data_kriteria-baru.php';
              }
          if($_GET['halaman']=="data_kriteria-ubah"){
              include 'data_kriteria-ubah.php';
              }
          if($_GET['halaman']=="data_kriteria-generate"){
              include 'data_kriteria-generate.php';
              }
          if($_GET['halaman']=="data_kriteria_user-hapus"){
              include 'data_kriteria_user-hapus.php';
              }
          if($_GET['halaman']=="nilai"){
              include 'nilai.php';
              }
          if($_GET['halaman']=="nilai-baru"){
              include 'nilai-baru.php';
              }
          if($_GET['halaman']=="nilai-ubah"){
              include 'nilai-ubah.php';
              }
          if($_GET['halaman']=="data_alternatif"){
              include 'data_alternatif.php';
              }
          if($_GET['halaman']=="data_alternatif-baru"){
              include 'data_alternatif-baru.php';
              }
          if($_GET['halaman']=="data_alternatif-ubah"){
              include 'data_alternatif-ubah.php';
              }
          if($_GET['halaman']=="analisa_kriteria"){
              include 'analisa_kriteria.php';
              }
          if($_GET['halaman']=="analisa_kriteria-tabel"){
              include 'analisa_kriteria-tabel.php';
              }
          if($_GET['halaman']=="analisa_alternatif"){
              include 'analisa_alternatif.php';
              }
          if($_GET['halaman']=="analisa_alternatif-tabel"){
              include 'analisa_alternatif-tabel.php';
              }
          if($_GET['halaman']=="perankingan"){
              include 'perankingan.php';
              }
          if($_GET['halaman']=="pfl_proses"){
              include 'pfl_proses.php';
              }
      }
      else{
          include 'home.php';
      }
      ?>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Right Reserved by Mirza Azib 2019</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ingin Keluar ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih Tombol "Keluar" dibawah jika anda ingin keluar dan mengakhiri sesi ini.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="../logout.php">Keluar</a>
          </div>
        </div>
      </div>
    </div>
          <?php
          $id = $_SESSION['id_pengguna'];
          $pflObj->id = $id;
          $pflObj->read();
          $pflObj->role;
          ?>
    <!-- Profile Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="profilemodal">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Profile Saya</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" action="index.php?halaman=pfl_proses" method="post" enctype="multipart/form-data" novalidate>
              <div class="form-group text-center">
                <img src="../assets/images/profile/<?=$pflObj->foto;?>" class="img-panel modal-images" id="imagePreview" alt="">
                <h4 class="text-muted"><?=$pflObj->role;?></h4><br>
              </div>
              <div class="form-group">
                <input type="file" name="foto" id="file" onchange="return fileValidation()"/>
              </div>
              <div class="form-group">
                <label for="nama">Nama</label>
                <input class="form-control" type="text" minlength="5" id="nama" name="nama" value="<?=$pflObj->nama;?>" required/>
                <div class="invalid-feedback">Nama Pengguna Harus Diisi</div>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" id="username" name="username" minlength="5" value="<?=$pflObj->username;?>" required/>
                <div class="invalid-feedback">Username Harus (min. 5 karakter)</div>
              </div>
              <div class="form-group">
                <label for="pass">Password</label>
                <input class="form-control" type="password"  id="password" name="password" minlength="8" value="<?=$_SESSION['pass'];?>" data-toggle="password" placeholder="Type Your New Password Here" required/>
                <div class="invalid-feedback">Password Harus (min. 8 karakter)</div>
              </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap-show-password.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../assets/vendor/sweetalert/js/sweetalert.min.js"></script>
    <script src="../assets/vendor/toastmessage/js/jquery.toastmessage.js"></script>
    <script src="../assets/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="../assets/js/sb-admin-datatables.min.js"></script>
    <!--<script src="../assets/js/sb-admin-charts.js"></script>-->
    <!-- Custom JavaScript -->
    <script src="../assets/js/app.js"></script>
  </div>
</body>

</html>
