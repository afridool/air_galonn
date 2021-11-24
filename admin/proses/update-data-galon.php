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
        $nama_depot= htmlentities($_POST['nama_depot']);
        $nama_galon= htmlentities($_POST['nama_galon']);
        $harga_isi_ulang = htmlentities($_POST['harga_isi_ulang']);
        $harga_galon_baru = htmlentities($_POST['harga_galon_baru']);
        $lokasi_depot = htmlentities($_POST['lokasi_depot']);
        $alamat_depot= htmlentities($_POST['alamat_depot']);
        $latitude= htmlentities($_POST['latitude']);
        $longitude= htmlentities($_POST['longitude']);
        $latitude= htmlentities($_POST['no_hp']);
        $pemilik= htmlentities($_POST['pemilik']);
         $username = htmlentities($_POST['username']);
         $password = htmlentities($_POST['password_baru']);
         

         $query = $connect->prepare("UPDATE depot_galon
         SET nama_galon = :nama_galon, 
             nama_depot = :nama_depot,
             harga_isi_ulang = :harga_isi_ulang,
             harga_galon_baru = :harga_galon_baru,
             lokasi_depot = :lokasi_depot,
             no_hp = :no_hp,
             alamat_depot = :alamat_depot,
             latitude = :latitude,
             longitude = :longitude,
             pemilik = :pemilik,
             username = :username,
             password = :password_baru
         WHERE id_galon=:id_galon");
$query->bindParam(":nama_galon", $nama_galon);
$query->bindParam(":nama_depot", $nama_depot);
$query->bindParam(":harga_isi_ulang", $harga_isi_ulang);
$query->bindParam(":harga_galon_baru", $harga_galon_baru);
$query->bindParam(":no_hp", $no_hp);
$query->bindParam(":alamat_depot", $alamat_depot);
$query->bindParam(":lokasi_depot", $lokasi_depot);
$query->bindParam(":latitude", $latitude);
$query->bindParam(":longitude",$longitude);
$query->bindParam(":pemilik",$pemilik);
$query->bindParam(":username",$username);
$query->bindParam(":password_baru",$password);
$query->bindParam(":id_galon", $_GET['id']);

if($query->execute()){
?>
<script>
alert('Berhasil Ubah Data ...');
window.location.href='../data-depot.php';
</script>
<?php
}
else{
?>
<script>
alert('Gagal Ubah Data ...');
window.location.href='../data-depot.php';
</script>
<?php
}
 }
    
?>