<?php
    include 'koneksi.php';
	
	if(isset($_GET['id']))
	{
		if(isset($_POST['submit'])){
			// it will delete an actual record from db
			$query = $connect->prepare("DELETE FROM keranjang WHERE id_keranjang=:id");
			$query->bindParam(":id", $_GET["id"]);
			// Jalankan Perintah SQL
			$query->execute();
			// Alihkan ke index.php
			header("location: ../keranjang.php");

		}
		
    }
	
?>
