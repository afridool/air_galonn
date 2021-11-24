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
<title>Pesanan</title>
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
    <a href="pesanan.php" class="w3-bar-item w3-button w3-padding w3-blue" style="text-decoration: none;"><i class="bi bi-card-checklist"></i>  Pesanan Air Galon</a>
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
    <h5><b><i class="bi bi-card-checklist"></i> Pesanan Air Galon</b></h5>
    <hr>
  </header>

  <!--body-->
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-container">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link" href="pesanan.php" style="color:black;">Semuanya</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pesanan-proses.php" style="color:black;">Sedang Diproses</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pesanan-dikirim.php" style="color:black;">Dikirim</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pesanan-selesai.php" style="color:black;">Selesai</a>
            </li>
        </ul><br>
        <div class="col-sm-10">
        <div class="container" style="background-color: whitesmoke;">
                    <h4>Sedang Diproses</h4><hr>
                    <div class="card mb-3" style="max-width: 700px;">
                    <?php 
						  // Buat prepared statement untuk mengambil semua data dari tbBiodata
						$query = $connect->prepare("SELECT depot_galon.*,user.*, pesanan_galon.* FROM (( pesanan_galon 
            INNER JOIN depot_galon ON depot_galon.id_galon = pesanan_galon.id_galon)
            INNER JOIN user ON user.id_user = pesanan_galon.id_user)
            WHERE depot_galon.id_galon = :id_galon AND pesanan_galon.status_pesanan = 'Dikirim'
                        ");
						// Jalankan perintah SQL
            $query->bindParam(":id_galon", $_SESSION['id_galon']);
						$query->execute();
						// Ambil semua data dan masukkan ke variable $data
							$data = $query->fetchAll();

                            if($data != null){
			        ?>
                     <?php 
					     $i =1;
					    foreach ($data as $value): 
										
			        ?>
                  
                        <div class="row g-0">
                        <div class="col-md-5">
                              <div class="container" style="padding: 20px;">
                                <img src="gambar/<?php echo $value['gambar_depot'] ?>" alt="..." style="width: 280px;">
                                <?php
                                if($value['status_pesanan'] == "Dikirim")
                                {

                                ?>
                              <p class="card-text"> <span class="badge badge-secondary"><?php echo $value['status_pesanan'] ?> <i class="bi bi-truck"></i></span> </p>
                              <?php
                                }elseif($value['status_pesanan'] == "Sedang Diproses") {
                              ?>
                                <p class="card-text"> <span class="badge badge-secondary"><?php echo $value['status_pesanan'] ?> <i class="bi bi-arrow-repeat"></i></span> </p>
                                <?php
                                }else{
                                ?>
                                 <p class="card-text"> <span class="badge badge-secondary"><?php echo $value['status_pesanan'] ?> <i class="bi bi-check-square-fill"></i></span> </p>
                                 <?php
                                    }
                                ?>
                              
                              </div>
                          </div>
                          <div class="col-md-7">
                            <div class="card-body">
                            <table class="table">
                            <tr>
                            <td> Nama Depot </td>
                            <td>:</td>
                            <td> <?php echo $value['nama_depot'] ?> </td>
                            </tr>
                            <tr>
                            <td> Nama Pemesan  </td>
                            <td>  : </td>
                            <td> <?php echo $value['nama'] ?> </td>
                            </tr>
                            <tr>
                            <td> Jumlah Isi Ulang </td>
                            <td>:</td>
                            <td><?php echo $value['jumlah_isi_ulang'] ?> </td>
                            <tr>
                            <td> Jumlah Galon Baru </td>
                            <td>:</td>
                            <td><?php echo $value['jumlah_galon_baru'] ?> </td>
                            </tr>
                            <tr>
                            <td> Alamat Pengirim </td>
                            <td>:</td>
                            <td><?php echo $value['alamat'] ?> </td>
                            </tr>
                            <tr>
                            <td> Total Pembayaran  </td>
                            <td>:</td>
                            <td>Rp. <?php echo $value['total_pembayaran'] ?> </td>
                            </tr>
                            </table>
                              <a href="proses/update-status-selesai.php?id=<?php echo $value['kode_pesanan'] ?>"><input type ="button" class="btn btn-primary" name="submit" value="Selesai"></a>
                            </div>
                          </div>
                        </div>
                        <?php $i++; endforeach; ?>
                        <?php
                            }else{
                        ?>
                            Tidak Ada Pesanan Diproses
                    <?php
                        }
                    ?>
                    </div><br>
                </div><br>
            </div>
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
