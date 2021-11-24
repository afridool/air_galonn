<!DOCTYPE html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.php')</script>";	
} else {
	require_once "proses/koneksi.php";
}
// Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $connect->prepare("SELECT depot_galon.nama_galon, pesanan_galon.* FROM pesanan_galon 
    INNER JOIN depot_galon ON depot_galon.id_galon = pesanan_galon.id_galon ");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();


?>
<html>
<title>Beranda</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "helvetica nue", Arial, Helvetica, sans-serif, sans-serif;}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-blue w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">AirGalonPku</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="gambar/<?php echo $_SESSION['gambar_depot']?>" class="w3-circle w3-margin-right" style="width:46px; height: 46px;">
    </div>
    <div class="w3-col s8 w3-bar">
      <span><?php echo $_SESSION['nama_depot']?></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="beranda.php" class="w3-bar-item w3-button w3-padding w3-blue" style="text-decoration: none;"><i class="fa fa-home fa-fw"></i>  Beranda</a>
    <a href="pesanan.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-card-checklist"></i>  Pesanan Air Galon</a>
    <a href="data-penjualan.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-graph-up"></i>  Data Penjualan</a>
    <a href="profil.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-three-dots"></i>  Kelola Depot Air Galon</a>
    <a href="login-penjual.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="fa fa-sign-out"></i> Logout</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-home fa-fw"></i> Beranda</b></h5>
    <hr>
  </header>

  <!--body-->
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-container">
        <div class="container" style= "background-color: white;">
            <h6 class="display-6" style="padding: 100px; margin: 20px;">Selamat Datang <?php echo $_SESSION['nama_depot']?></h6>
        </div><hr>
        <div class="container" style="background-color: white;">
            <iframe src="https://www.google.com/maps/d/embed?mid=16k9ZX88n4lxuloYooBlaW3Qmndd_R9Gx" width="880" height="450" style="padding: 10px;"></iframe>
        </div><hr>
    </div>
  </div>

  <br>
  <div class="w3-container w3-blue w3-padding-32">
    <div class="w3-container">
        <div class="row">
            <div class="col-sm">
                <h6>Layanan</h6>
                <a href="#" class="link" style="text-decoration: none; color: white;">Bantuan</a><br>
                <a href="#" class="link" style="text-decoration: none; color: white;">Metode Pembayaran</a><br>
                <a href="#" class="link" style="text-decoration: none; color: white;">Pengembalian Air Galon dan Dana</a>
            </div><br>
            <div class="col-sm">
                <h6>Jelajahi AirGalonPku</h6>
                <a href="#" class="link" style="text-decoration: none; color: white;">Tentang Kami</a><br>
                <a href="#" class="link" style="text-decoration: none; color: white;">Hubungi Kami</a>
            </div><br>
            <div class="col-sm">
                <h6>Ikuti AirGalonPku</h6>
                <a href="#" class="link" style="text-decoration: none; color: white;"><i class="bi bi-facebook"></i> Facebook</a><br>
                <a href="#" class="link" style="text-decoration: none; color: white;"><i class="bi bi-instagram"></i> Instagram</a><br>
                <a href="#" class="link" style="text-decoration: none; color: white;"><i class="bi bi-twitter"></i> Twitter</a>
            </div><br>
        </div>
    </div>
  </div>

  

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

</body>
</html>
