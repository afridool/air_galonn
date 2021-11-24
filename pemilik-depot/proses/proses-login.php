<?php
  require_once "koneksi.php";
  
  session_start();
  
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	$username = $_POST['username'];
	$password = $_POST['password'];
		$sql = $connect->prepare('SELECT * FROM depot_galon WHERE username = :username and password = :password');
		$sql->execute(array(
							':username' => $username,
							':password' => $password
							));
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if(empty($row['username'])){
			echo "<script>alert('Username atau Password Salah !',document.location.href='../login-penjual.php')</script>";
		}else{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['id_galon'] = $row['id_galon'];
			$_SESSION['nama_depot'] = $row['nama_depot'];
			$_SESSION['nama_galon'] = $row['nama_galon'];
			$_SESSION['gambar_depot'] = $row['gambar_depot'];
			$_SESSION['harga_isi_ulang'] = $row['harga_isi_ulang'];
			$_SESSION['harga_galon_baru'] = $row['harga_galon_baru'];
			$_SESSION['lokasi_galon'] = $row['lokasi_depot'];
			$_SESSION['no_hp'] = $row['no_hp'];
			$_SESSION['id_galon'] = $row['id_galon'];
			$_SESSION['alamat_depot'] = $row['alamat_depot'];
			$_SESSION['latitude'] = $row['latitude'];
			$_SESSION['longitude'] = $row['longitude'];
			$_SESSION['gambar_depot'] = $row['gambar_depot'];
			$_SESSION['pemilik'] = $row['pemilik'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['password'] = $row['password'];
			header("location: ../beranda.php");
		}
	}
?>