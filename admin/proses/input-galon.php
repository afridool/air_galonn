<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='../login.html')</script>";	
} else {
	require_once "koneksi.php";
}

	
 if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
        $id_galon = htmlentities($_POST['id_galon']);
        $nama_galon = htmlentities($_POST['nama_galon']);
        $nama_depot = htmlentities($_POST['nama_depot']);
		$telp = htmlentities($_POST['no_hp']);
        $harga_isi_ulang = htmlentities($_POST['harga_isi_ulang']);
        $harga_galon_baru = htmlentities($_POST['harga_galon_baru']);
        $alamat = htmlentities($_POST['alamat']);
        $lokasi = htmlentities($_POST['lokasi_depot']);
		$lat = htmlentities($_POST['latitude']);
		$long = htmlentities($_POST['longitude']);
        $pemilik = htmlentities($_POST['pemilik']);
		
		$imgFile = $_FILES['gambar']['name'];
		$tmp_dir = $_FILES['gambar']['tmp_name'];
		$imgSize = $_FILES['gambar']['size'];
        
		if(empty($imgFile)){
		$errMSG = "gambar belum dipilih";
		}
		 else
		{
		$upload_dir = '../gambar/'; // upload directory
 
		$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
  
		// valid image extensions
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
  
		// rename uploading image
		$foto = rand(1000,1000000).".".$imgExt;
    
		// allow valid image file formats
		if(in_array($imgExt, $valid_extensions)){   
		// Check file size '5MB'
		if($imgSize < 5000000)    {
		move_uploaded_file($tmp_dir,$upload_dir.$foto);
		}
		else{
		$errMSG = "Maaf, Ukuran Foto Anda Terlalu Besar";
		}
		}
		else{
		$errMSG = "Maaf, Tipe Foto Anda Tidak Di Dukung.";  
		}
		
	}
		 if(!isset($errMSG)){
			 
        // Prepared statement untuk menambah data
        $query = $connect->prepare("INSERT INTO depot_galon(nama_galon, nama_depot, harga_isi_ulang, harga_galon_baru, lokasi_depot, no_hp, id_galon, alamat, latitude, longitude, gambar, pemilik)
        VALUES (:nama_galon,:nama_depot,:harga_isi_ulang,:harga_galon_baru,:lokasi_depot,:no_hp,:id_galon,:alamat,:latitude,:longitude,:gambar,:pemilik)");
        $query->bindParam(":nama_galon", $nama_galon);
        $query->bindParam(":nama_depot", $nama_depot);
		$query->bindParam(":harga_isi_ulang", $harga_isi_ulang);
		$query->bindParam(":harga_galon_baru", $harga_galon_baru);
		$query->bindParam(":lokasi_depot", $lokasi);
		$query->bindParam(":no_hp", $telp);
        $query->bindParam(":id_galon", $id_galon);
        $query->bindParam(":alamat", $alamat);
        $query->bindParam(":latitude", $lat);
        $query->bindParam(":longitude", $long);
        $query->bindParam(":gambar", $foto);
        $query->bindParam(":pemilik", $pemilik);
        // Jalankan perintah SQL
		 if( $query->execute())
		{
		 echo "<script>alert('Input Berhasil !',document.location.href='../(user) kelola depot.php')</script>";
		}
		else
		{
		 echo "<script>alert('Input gagal !',document.location.href='(user)beranda.php')</script>";
		}
        
		}
    }
?>