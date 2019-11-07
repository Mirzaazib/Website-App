<?php
include_once 'includes/connection.php';
include_once 'includes/register_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$regObj = new register($db);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="assets/vendor/toastmessage/css/jquery.toastmessage.css">
  <link type="text/css" rel="stylesheet" href="assets/vendor/sweetalert/css/sweetalert.css">
</head>
<?php
if(isset($_POST['submit'])){
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];	
  move_uploaded_file($lokasi,"assets/images/profile/$namafoto");
  
  $id = $regObj->getNewID();
  $name = $_POST['name'];
  $role = "Member";
  $username = $_POST['username'];
  $password = md5($_POST['password']);

	$regObj->id = $id;
	$regObj->nama = $name;
	$regObj->role = $role;
	$regObj->username = $username;
  $regObj->password = $password;
  $regObj->foto = $foto;
  
	if($regObj->insert()  ){ ?>
    <script>
      window.onload=function(){
        swal({
          title: "Success!",
          text: "Pendaftaran Berhasil",
          type: "success"
        }, function(){
              window.location.href = "main/index.php";
        });
      }
    </script> <?php
	} else { ?>
		<script>
      window.onload=function(){
        swal({
          title: "Failed!",
          text: "Pendaftaran Gagal",
          type: "warning"
        });
      }
    </script> <?php
	}
}
?>
<body background="../dist/img/bkg-body.jpg">
<div class="card card-login mx-auto mt-5">
  <div class="card-header">Register an Account</div>
  <div class="card-body">
  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Your Name</label>
        <input class="form-control" name="name" type="text" placeholder="Enter your name" minlength="5" required="on">
    </div>
    <div class="form-group">
        <label>Username</label>
        <input class="form-control" name="username" type="text" placeholder="Enter Username" minlength="5" required="on">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input class="form-control" name="password" type="password" placeholder="enter Password" minlength="5" required="on">
    </div>
    
    <div class="form-group mt-3 mb-3">
      <label for="foto">Pilih Foto</label>
      <input type="file" name="foto" id="file" onchange="return fileValidation()">
    </div>
    
    <input class="btn btn-primary btn-block" type="submit" name="submit" value="REGISTER">
  </form>
  <div class="text-center">
    <a class="d-block small mt-3" href="login.php">Login Page</a>
  </div>
  </div>
</div>
    
<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script type="text/javascript" src="assets/vendor/sweetalert/js/sweetalert.min.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
