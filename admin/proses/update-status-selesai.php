<?php
	
    require_once "koneksi.php";

// Buat prepared statement untuk mengambil semua data dari tbBiodata
if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$id = $_GET['id'];
		$query = $connect->prepare("UPDATE pesanan_galon 
                                    SET status_pesanan = 'Selesai'
                                    WHERE kode_pesanan = :kode_pesanan");
        $query->bindParam(":kode_pesanan", $id);
		
        if($query->execute()){
            ?>
            <script>
            alert('Statu Pesanan Diubah ...');
            window.location.href='../(user) transaksi.php';
            </script>
            <?php
        }
        else{
            ?>
            <script>
            alert('Gagal Ubah Status Pesanan ...');
            window.location.href='../(user) transaksi.php';
            </script>
            <?php
        }
	}


	else
	{
		header("Location: ../(user) transaksi.php");
	}
    
   
?>