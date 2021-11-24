<?php
  require_once "koneksi.php";
  
  session_start();
  
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
	$username = $_POST['username'];
	$password = $_POST['password'];
		$sql = $connect->prepare('SELECT * FROM admin WHERE username = :username and password = :password');
		$sql->execute(array(
							':username' => $username,
							':password' => $password
							));
		$row = $sql->fetch(PDO::FETCH_ASSOC);
		if(empty($row['username'])){
			echo "<script>alert('Username atau Password Salah !',document.location.href='../login-admin.php')</script>";
		}else{
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['id_admin'] = $row['id_admin'];
			header("location: ../beranda.php");
		}
	}
?>