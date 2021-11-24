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
<title>Data Penjualan</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.3.1/dt-1.10.25/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.6.0/jq-3.3.1/dt-1.10.25/datatables.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>



 

<style>
html,body,h1,h2,h3,h4,h5 {font-family: "helvetica nue", Arial, Helvetica, sans-serif, sans-serif;}
.dropbtn {
  background-color: blue;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: blue;
}
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
    <a href="data-penjualan.php" class="w3-bar-item w3-button w3-padding w3-blue" style="text-decoration: none;"><i class="bi bi-graph-up"></i>  Data Penjualan</a>
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
    <h5><b><i class="bi bi-graph-up"></i>  Data Penjualan</b></h5>
    <hr>
  </header>

  <!--body-->
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-container">
    <table id="myTable" class="table" style="font-size:9pt;">
        <thead>
            <tr>
                <th>No</th>
                <th>Pesanan dari</th>
                <th>Jumlah Isi Ulang</th>
                <th>Jumlah Galon Baru</th>
                <th>Total Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Alamat</th>
                <th>No Hp</th>
                <th>Status</th>
            </tr>
        </thead>
      
        <tbody>
        <?php 
            
            // Buat prepared statement untuk mengambil semua data dari tbBiodata
          $query = $connect->prepare("SELECT depot_galon.*,user.*, pesanan_galon.* FROM (( pesanan_galon 
                      INNER JOIN depot_galon ON depot_galon.id_galon = pesanan_galon.id_galon)
                      INNER JOIN user ON user.id_user = pesanan_galon.id_user)
                      WHERE depot_galon.id_galon = :id_galon");
           $query->bindParam(":id_galon", $_SESSION['id_galon']);
          // Jalankan perintah SQL
          $query->execute();
          // Ambil semua data dan masukkan ke variable $data
            $data = $query->fetchAll();
          
                          if($data != null){

            ?>
                   <?php 
             $i =1;
            foreach ($data as $value): 

                      
                  
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $value['nama'] ?></td>
                <td><?php echo $value['jumlah_isi_ulang'] ?></td>
                <td><?php echo $value['jumlah_galon_baru'] ?></td>
                <td>Rp. <?php echo $value['total_pembayaran'] ?></td>
                <td><?php echo $value['metode_pembayaran'] ?></td>
                <td><?php echo $value['alamat'] ?></td>
                <td><?php echo $value['no_hp'] ?></td>
                <td><?php echo $value['status_pesanan'] ?></td>
            </tr>
            <?php $i++; endforeach; ?>
                        <?php
                            }else{
                        ?>
                            Tidak Ada Pesanan Diproses
                    <?php
                        }
                    ?>
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Pesanan dari</th>
                <th>Jumlah Isi Ulang</th>
                <th>Jumlah Galon Baru</th>
                <th>Total Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Alamat</th>
                <th>No Hp</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
    <script>
   $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
    </div>
  </div>
  
 </div><br>

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
