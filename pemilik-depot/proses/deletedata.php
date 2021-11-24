<?php
    include 'koneksi.php';
	
	if(isset($_GET['id']))
	{
		// select image from db to delete
		$query = $connect->prepare('SELECT gambar FROM depot_galon WHERE  id_galon=:id');
		$query->execute(array(':id'=>$_GET['id']));
		$imgRow=$query->fetch(PDO::FETCH_ASSOC);
		unlink("gambar/".$imgRow['gambar']);
		
		// it will delete an actual record from db
		  $query = $connect->prepare("DELETE FROM depot_galon WHERE id_galon=:id");
        $query->bindParam(":id", $_GET["id"]);
        // Jalankan Perintah SQL
        $query->execute();
        // Alihkan ke index.php
        header("location: ../daftar-depot.php");
    }
	
?>
