<?php
  
	require_once "koneksi.php";

 
	
 if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
		$username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
		$email 	  = htmlentities($_POST['email']);
		$nama 	  = htmlentities($_POST['nama']);
		$no_hp	  = htmlentities($_POST['no_hp']);
		$alamat	  = htmlentities($_POST['alamat']);
		
        $query = $connect->prepare("INSERT INTO user(username, password, email, no_hp, alamat, nama, jenis_kelamin, tgl_lahir, gambar, kecamatan, kelurahan, no_rekening, nama_rekening, nama_bank)
        VALUES (:username, :password, :email, :no_hp, :alamat , :nama, '-', '-', '-', '-', '-', '-','-', '-')" );
        $query->bindParam(":username", $username);
		$query->bindParam(":password", $password);
		$query->bindParam(":email", $email);
		$query->bindParam(":no_hp", $no_hp);
		$query->bindParam(":alamat", $alamat);
		$query->bindParam(":nama", $nama);
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