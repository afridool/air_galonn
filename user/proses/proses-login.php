<?php
  require_once "koneksi.php";
  
  session_start();
  
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	$username = $_POST['username'];
	$password = $_POST['password'];
		$sql = $connect->prepare('SELECT * FROM user WHERE username = :username and password = :password');
		$sql->execute(array(
							':username' => $username,
							':password' => $password
							));
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if(empty($row['username'])){
			echo "<script>alert('Username atau Password Salah !',document.location.href='../login.php')</script>";
		}else{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['id_user'] = $row['id_user'];
			$_SESSION['email'] = $row['email'];
			$_SESSION['no_hp'] = $row['no_hp'];
			$_SESSION['alamat'] = $row['alamat'];
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['jenis_kelamin'] = $row['jenis_kelamin'];
			$_SESSION['tgl_lahir'] = $row['tgl_lahir'];
			$_SESSION['gambar'] = $row['gambar'];
			$_SESSION['kecamatan'] = $row['kecamatan'];
			$_SESSION['kelurahan'] = $row['kelurahan'];
			$_SESSION['no_rekening'] = $row['no_rekening'];
			$_SESSION['nama_rekening'] = $row['nam_rekenings'];
			$_SESSION['nama_bank'] = $row['nama_bank'];

			header("location: ../beranda.php");
		}
	}
?>