<?php
  
  session_start();
  if (empty($_SESSION['username'])){
      echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.html')</script>";	
  } else {
      require_once "koneksi.php";
  }

if(isset($_POST['submit'])){
  $query = $connect->prepare("SELECT depot_galon.*,user.*, keranjang.* FROM (( keranjang 
  INNER JOIN depot_galon ON depot_galon.id_galon = keranjang.id_galon)
  INNER JOIN user ON user.id_user = keranjang.id_user)
  WHERE user.id_user = :id_user");
    $query->bindParam(":id_user", $_SESSION['id_user']);
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();

    
    $metode_bayar = htmlentities($_POST['metode_pembayaran']);

    $query2 = $connect->prepare("SELECT max(kode_pesanan) as maxkode FROM pesanan_galon");
    $query2->execute();
    $data2 = $query2->fetch();

    $kodePesan = $data2['maxkode'];

    $urutan = (int) substr($kodePesan, 3, 3);

    $urutan++;
    $huruf = "GLN";
    $kodePesan = $huruf . sprintf("%03s", $urutan);
    $i = 0;
        foreach ($data as $value):
           
            $sql[$i] = $connect->prepare("INSERT INTO pesanan_galon(jumlah_isi_ulang, jumlah_galon_baru,  total_pembayaran, metode_pembayaran, status_pesanan, id_galon, id_user)
            VALUES (:jumlah_isi_ulang,:jumlah_galon_baru,:total_pembayaran,:metode_pembayaran, 'Sedang Diproses', :id_galon, :id_user)");
            $sql[$i]->bindParam(":jumlah_isi_ulang", $value['keranjang_isi_ulang']);
            $sql[$i]->bindParam(":jumlah_galon_baru", $value['keranjang_galon_baru']);
            $sql[$i]->bindParam(":total_pembayaran", $value['total_pembayaran_keranjang']);
            $sql[$i]->bindParam(":metode_pembayaran", $metode_bayar);
            $sql[$i]->bindParam(":id_galon", $value['id_galon']);
            $sql[$i]->bindParam(":id_user", $value['id_user']);
            // Jalankan perintah SQL
            $succed = $sql[$i]->execute();
            
            $i++;
        endforeach;

     if($succed){

        $query = $connect->prepare("TRUNCATE TABLE keranjang");
			// Jalankan Perintah SQL
			$query->execute();
			// Alihkan ke index.php
      echo "<script>alert('Checkout Berhasi !',document.location.href='../transaksi.php')</script>";

     }else{
        echo "<script>alert('Checkout Gagal !',document.location.href='../keranjang.php')</script>";
     }

    
}
    

?>