<?php
    include 'koneksi.php';
	
	if(isset($_GET['id']))
	{
		
		// it will delete an actual record from db
		  $query = $connect->prepare("DELETE FROM pesanan_galon WHERE kode_pesanan=:id");
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
			window.location.href='../data-pesanan.php';
			</script>
			<?php
			}
    }
	
?>
