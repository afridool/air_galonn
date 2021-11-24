<?php
  
	require_once "koneksi.php";

 
	
 if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
        $kode_pesanan = htmlentities($_POST['kode_pesanan']);
		$jumlah_isi_ulang = htmlentities($_POST['jumlah_isi_ulang']);
        $jumlah_galon_baru = htmlentities($_POST['jumlah_galon_baru']);
		$total_pembayaran = htmlentities($_POST['total_pembayaran']);
		$metode_pembayaran = htmlentities($_POST['metode_pembayaran']);
		$status_pesanan = htmlentities($_POST['status_pesanan']);
		$id_galon = htmlentities($_POST['id_galon']);
		$id_user = htmlentities($_POST['id_user']);
		


        $query = $connect->prepare("INSERT INTO pesanan_galon(jumlah_isi_ulang, jumlah_galon_baru, kode_pesanan, total_pembayaran, metode_pembayaran, status_pesanan, id_galon, id_user)
        VALUES (:jumlah_isi_ulang,:jumlah_galon_baru,:kode_pesanan,:total_pembayaran,:metode_pembayaran, :status_pesanan, :id_galon, :id_user)");
        $query->bindParam(":jumlah_isi_ulang", $jumlah_isi_ulang);
        $query->bindParam(":jumlah_galon_baru", $jumlah_galon_baru);
		$query->bindParam(":kode_pesanan", $kode_pesanan);
		$query->bindParam(":total_pembayaran", $total_pembayaran);
        $query->bindParam(":metode_pembayaran", $metode_pembayaran);
		$query->bindParam(":status_pesanan", $status_pesanan);
		$query->bindParam(":id_galon", $id_galon);
		$query->bindParam(":id_user", $id_user);
        // Jalankan perintah SQL
		 if( $query->execute())
		{
		 echo "<script>alert('Pesanan Berhasil !',document.location.href='../pesanan.php')</script>";
		}
		else
		{
		 echo "<script>alert('Pesanan Gagal !',document.location.href='../pesanan.php')</script>";
		}
        
		}
    
?>