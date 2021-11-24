<?php
    include 'koneksi.php';
	
	if(isset($_GET['id']))
	{
		// select image from db to delete
		$query = $connect->prepare('SELECT gambar_depot FROM depot_galon WHERE  id_galon=:id');
		$query->execute(array(':id'=>$_GET['id']));
		$imgRow=$query->fetch(PDO::FETCH_ASSOC);
		unlink("../../user/gambar/".$imgRow['gambar_depot']);
		
		// it will delete an actual record from db
		  $query = $connect->prepare("DELETE FROM depot_galon WHERE id_galon=:id");
        $query->bindParam(":id", $_GET["id"]);
        // Jalankan Perintah SQL
		if($query->execute()){
			?>
			<script>
			alert('Berhasil Hapus Data Pesanan ...');
			window.location.href='../data-pesanan.php';
			</script>
			<?php
			}
			else{
			?>
			<script>
			alert('Gagal Hapus Data Pesanan ...');
			window.location.href='../data-depot.php';
			</script>
			<?php
			}
        header("location: ../data-pesanan.php");
    }
	
?>
