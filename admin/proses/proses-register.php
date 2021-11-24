<?php
  
	require_once "koneksi.php";

 
	
 if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
		$username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
		$email = htmlentities($_POST['email']);
		
        $query = $connect->prepare("INSERT INTO user(username, password, email)
        VALUES (:username,:password,:email)");
        $query->bindParam(":username", $username);
		$query->bindParam(":password", $password);
		$query->bindParam(":email", $email);
        // Jalankan perintah SQL
		 if( $query->execute())
		{
		 echo "<script>alert('Input Berhasil !',document.location.href='../login.php')</script>";
		}
		else
		{
		 echo "<script>alert('Input gagal !',document.location.href='../login.php')</script>";
		}
        
		}
    
?>