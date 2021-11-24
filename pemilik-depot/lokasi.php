<!DOCTYPE html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.php')</script>";	
} else {
	require_once "proses/koneksi.php";
}

if(isset($_SESSION['id_galon']) && !empty($_SESSION['id_galon']))
	{
		$id = $_SESSION['id_galon'];
		$query = $connect->prepare("SELECT * FROM depot_galon WHERE id_galon = :id_galon");
		$query->execute(array(':id_galon'=>$id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		extract($data);
	}
	else
	{
		header("Location: login.php");
	}
?>
<html>
<title>Lokasi Depot</title>
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
    <a href="beranda.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="fa fa-home fa-fw"></i>  Beranda</a>
    <a href="pesanan.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-card-checklist"></i>  Pesanan Air Galon</a>
    <a href="data-penjualan.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-graph-up"></i>  Data Penjualan</a>
    <a href="profil.php" class="w3-bar-item w3-button w3-padding w3-blue" style="text-decoration: none;"><i class="bi bi-three-dots"></i>  Kelola Depot Air Galon</a>
    <a href="login-penjual.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="fa fa-sign-out"></i> Logout</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="bi bi-geo-alt-fill"></i> Lokasi</b></h5>
    <hr>
  </header>

  <!--body-->
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="profil.php" style=" color: black;">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="lokasi.php">Lokasi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="keamanan.php" style=" color: black;">Keamanan</a>
            </li>
        </ul><br>
        <div class="row">
            <div class="col-sm-8">
            <form action="proses/update-lokasi-galon.php?id=<?php echo $data['id_galon'] ?>" method="post" >
                <table class="table table-borderless" style="width: 500px;">
                    <tbody>
                        <tr>
                            <td>Alamat</td>
                            <td><input type="text" name="alamat_depot" value="<?php echo $data['alamat_depot']?>" style="width: 200px;"></td>
                        </tr>
                        <tr>
                                <td>Kecamatan</td>
                                <td><select name="lokasi_depot" class="form-select" id="" style="width:200px;" required>
                                    <option value="<?php echo $data['lokasi_depot']; ?>" selected hidden><?php echo $data['lokasi_depot']; ?></option>
                                    <option value="Bina Widya">Bina Widya</option>
                                    <option value="Tuah Madani">Tuah Madani</option>
                                    <option value="Sukajadi">Sukajadi</option>
                                    <option value="Marpoyan Damai">Marpoyan Damai</option>
                                    <option value="Payung Sekaki">Payung Sekaki</option>
                                    <option value="Bukit Raya">Bukit Raya</option>
                                    <option value="Pekanbaru Kota">Pekanbaru Kota</option>
                                    <option value="Rumbai">Rumbai</option>
                                    <option value="Rumbai Barat">Rumbai Barat</option>
                                    <option value="Rumbai Timur">Rumbai Timur</option>
                                    <option value="Sail">Sail</option>
                                    <option value="Senapelan">Senapelan</option>
                                    <option value="Kulim">Kulim</option>
                                    <option value="Tenayan Raya">Tenayan Raya</option>
                                    <option value="Lima Puluh">Lima Puluh</option>
                                </select></td>
                            </tr>
                        <tr>
                            <td>Latitude</td>
                            <td><input type="text" name ="latitude" placeholder="Latitude" value="<?php echo $data['latitude']?>" style="width: 200px;"></a></td>
                        </tr>
                        <tr>
                            <td>Longitude</td>
                            <td><input type="text" name="longitude" placeholder="Longitude" value="<?php echo $data['longitude']?>" style="width: 200px;"</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
        <div class="container">
            <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan</button>
        </div><hr>
        </form>
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
