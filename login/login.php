<?php
include_once 'includes/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login Admin</title>
  <link rel="shortcut icon" href="../dist/img/favicon.png">
  <!-- Bootstrap core CSS-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/vendor/sweetalert/css/sweetalert.css" rel="stylesheet">
  
</head>

<!-- handle error -->
<?php
$config = new Config();
$db = $config->getConnection();

if ($_POST) {
    include_once 'includes/login_inc.php';
    $login = new Login($db);
    $login->userid = $_POST['username'];
    session_start();
    $_SESSION['pass'] = $_POST['password'];
    $login->passid = md5($_POST['password']);
    if ($login->login()) { 
      header('location:main/index.php');
    } else { ?>
        <script>
          window.onload=function(){
            swal({
              title: "Failed!",
              text: "Username dan Password salah !",
              type: "warning"
            });
          }
        </script>
<?php
    }
}
?>

<body background="../dist/img/bkg-body.jpg">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">
        <a href="../"><img src="assets/images/left.png" style="width:8%" alt=""></a>
        </a>&nbsp Login</div>
      <div class="card-body">
        <form action="<?=$_SERVER['REQUEST_URI']?>" method="post">
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="username" type="text" placeholder="Username" autofocus="">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" id="password" name="password" type="password" data-toggle="password" placeholder="Password">
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="LOGIN">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
        </div>
      </div>
    </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/sweetalert/js/sweetalert.min.js"></script>
  <script src="assets/vendor/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/bootstrap-show-password.min.js"></script>
  <script src="assets/js/app.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/bootstrap/js/jquery.easing.min.js"></script>
</body>

</html>
