<?php
 
 session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.php')</script>";	
} else {
	require_once "koneksi.php";
}

// Buat prepared statement untuk mengambil semua data dari tbBiodata
if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$id = $_GET['id'];
		$query = $connect->prepare("SELECT * FROM depot_galon WHERE id_galon = :id_galon");
		$query->execute(array(':id_galon'=>$id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		extract($data);
	}
	else
	{
		header("Location: list depot air galon.php");
	}
    
    if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS

        $query = $connect->prepare("SELECT * FROM depot_galon WHERE id_galon = :id_galon");
		$query->execute(array(':id_galon'=>$id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		extract($data);

        
        
    
       
        $query2 = $connect->prepare("SELECT max(id_keranjang) as maxkode FROM keranjang");
        $query2->execute();
        $data2 = $query2->fetch();

        $kodePesan = $data2['maxkode'];

        $urutan = (int) substr($kodePesan, 3, 3);
 
        $urutan++;
 
        $huruf = "KRJ";
        $kodePesan = $huruf . sprintf("%03s", $urutan);

        
        $isi_ulang = htmlentities($_POST['isi_ulang']);
        $galon_baru = htmlentities($_POST['galon_baru']);

		$total_isi_ulang = $isi_ulang*$data['harga_isi_ulang'];
        $total_galon_baru = $galon_baru*$data['harga_galon_baru'];

		$total_pembayaran_keranjang = $total_isi_ulang+$total_galon_baru+1000;



        $sql = $connect->prepare("INSERT INTO keranjang(id_keranjang, id_galon, id_user, keranjang_isi_ulang, keranjang_galon_baru, total_pembayaran_keranjang)
        VALUES (:id_keranjang, :id_galon, :id_user, :isi_ulang , :galon_baru , :total_pembayaran_keranjang)" );
        $sql->bindParam(":id_keranjang", $kodePesan);
		$sql->bindParam(":id_galon", $id);
		$sql->bindParam(":id_user", $_SESSION['id_user']);
        $sql->bindParam(":isi_ulang", $isi_ulang);
        $sql->bindParam(":galon_baru", $galon_baru);
		$sql->bindParam(":total_pembayaran_keranjang", $total_pembayaran_keranjang);
		
        // Jalankan perintah SQL
		 if( $sql->execute())
		{
		 echo "<script>alert('Input Berhasil !',document.location.href='../list depot air galon.php')</script>";
		}
		else
		{
		 echo "<script>alert('Input gagal !',document.location.href='../list depot air galon.php')</script>";
		}
        
		}

?>