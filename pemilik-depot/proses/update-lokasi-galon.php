<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='../login.html')</script>";	
} else {
	require_once "koneksi.php";
}

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
		header("Location: ../profil.php");
	}
	
	
 if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
         $alamat_depot= htmlentities($_POST['alamat_depot']);
         $lokasi_depot = htmlentities($_POST['lokasi_depot']);
         $latitude = htmlentities($_POST['latitude']);
         $longitude = htmlentities($_POST['longitude']);
         

         $query = $connect->prepare("UPDATE depot_galon 
         SET alamat_depot = :alamat_depot,
             lokasi_depot = :lokasi_depot, 
             latitude = :latitude,
             longitude = :longitude
         WHERE id_galon=:id_galon");
$query->bindParam(":alamat_depot", $alamat_depot);
$query->bindParam(":lokasi_depot", $lokasi_depot);
$query->bindParam(":latitude", $latitude);
$query->bindParam(":longitude",$longitude);
$query->bindParam(":id_galon", $_GET['id']);

if($query->execute()){
?>
<script>
alert('Berhasil Ubah Data ...');
window.location.href='../lokasi.php';
</script>
<?php
}
else{
?>
<script>
alert('Gagal Ubah Data ...');
window.location.href='../lokasi.php';
</script>
<?php
}
 }
    
?>