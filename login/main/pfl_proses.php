<?php
include_once '../includes/profile_inc.php';
$conn = new Config();
$db = $conn->getConnection();

$pflObj = new Profile($db);
$pflObj->id = $_SESSION['id_pengguna'];
$pflObj->read();
$foto = $pflObj->foto;

if (isset($_POST['submit'])) {
	$temp = $_FILES['foto']['name'];
	if (empty($temp)) {
		$foto;
	} else {
		$foto = $_FILES['foto']['name'];
	}
	$namafoto = $foto;
	$lokasi = $_FILES['foto']['tmp_name'];	
	move_uploaded_file($lokasi,"../assets/images/profile/$namafoto");
	$pflObj->foto = $namafoto;
	$pflObj->id = $_SESSION['id_pengguna'];
	$pflObj->nama = $_POST['nama'];
	$pflObj->username = $_POST['username'];
	$pflObj->password = md5($_POST['password']);
	if ($pflObj->update()) { 
		$_SESSION['nama'] = $_POST['nama'];
		$_SESSION['pass'] = $_POST['password']; ?>
		<script>
		window.onload=function(){
				swal({
				title: "Success!",
				text: "Ubah data kriteria Berhasil..!",
				type: "success"
				}, function(){
					window.location.href = "index.php";
		});
		}
		</script> <?php
	} else { ?>
		<script type="text/javascript">
			window.onload=function(){
				swal({
				title: "Failed!",
				text: "Ubah data Gagal..!",
				type: "warning"
				}, function(){
					window.location.href = "index.php";
			});
			}
		</script> <?php
	}
	
}

?>