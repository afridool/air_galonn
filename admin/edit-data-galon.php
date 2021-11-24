<!DOCTYPE html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login-admin.php')</script>";	
} else {
	require_once "proses/koneksi.php";
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
		header("Location: login.php");
	}

?>
<html>
<title>Data User</title>
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
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">AirGalonPku</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="gambar/pp.png" class="w3-circle w3-margin-right" style="width:46px; height: 46px;">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Admin</span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="beranda.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="fa fa-home fa-fw"></i>  Beranda</a>
    <a href="data-user.php" class="w3-bar-item w3-button w3-padding w3-black" style="text-decoration: none;"><i class="bi bi-person-lines-fill"></i>  Data User</a>
    <a href="data-depot.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-building"></i>  Data Depot</a>
    <a href="data-pesanan.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-card-checklist"></i> Data Pesanan</a>
    <a href="login-admin.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="fa fa-sign-out"></i> Logout</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="bi bi-person-lines-fill"></i> Data User</b></h5>
    <hr>
  </header>

  <!--body-->
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-container">
    <div class="col-sm-9">
                <div class="container" style="background-color: whitesmoke;">
                    <h4>Edit Profil</h4><hr>
                    <div class="row">
                        <!--biodata-->
                        <div class="col-sm-8">
                           <form action="proses/update-data-galon.php?id=<?php echo $data['id_galon'] ?>" method="post" enctype="multipart/form-data">
                            <table class="table table-borderless" style="width: 500px;">
                                <tbody>
                                    <tr>
                                        <td>Nama Depot</td>
                                        <td><input type="text" placeholder="Nama Depot" name="nama_depot" value="<?php echo $data['nama_depot'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Galon</td>
                                        <td><input type="text" placeholder="Nama Galon" name="nama_galon" value="<?php echo $data['nama_galon'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><input type="text" placeholder="Username" name="username" value="<?php echo $data['username'] ?>"  required style="width: 300px;"></td>
                                 </tr>
                                 <tr>
                                        <td>Password</td>
                                        <td><input type="password" placeholder="Password Baru" name="password_baru" value="<?php echo $data['password'] ?>"  required style="width: 300px;"></td>
                                 </tr>
                                    <tr>
                                        <td>Harga Isi Ulang</td>
                                        <td><input type="text" placeholder="Harga Isi Ulang" name = "harga_isi_ulang" value="<?php echo $data['harga_isi_ulang'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Galon Baru</td>
                                        <td><input type="text" placeholder="Harga Galon Baru" name="harga_galon_baru" value="<?php echo $data['harga_galon_baru'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Lokasi Depot</td>
                                        <td><input type="text" name="lokasi_depot" value="<?php echo $data['lokasi_depot'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Nomor HP</td>
                                        <td><input type="text" placeholder="Nomor HP" name="no_hp" value="<?php echo $data['no_hp'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Depot</td>
                                        <td><input type="text" placeholder="Alamat Depot" name="alamat_depot" value="<?php echo $data['alamat_depot'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Latitude</td>
                                        <td><input type="text" placeholder="Latitude" name="latitude" value="<?php echo $data['latitude'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Longitude</td>
                                        <td><input type="text" placeholder="Longitude" name="longitude" value="<?php echo $data['longitude'] ?>" style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Pemilik</td>
                                        <td><input type="text" placeholder="Pemilik" name="pemilik" value="<?php echo $data['pemilik'] ?>" style="width: 300px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <div class="container">
                        <button class="btn btn-primary" type="submit" name="submit"><i class="bi bi-save-fill"></i> Simpan</button>
                    </div><br>
                    </form>
                </div><br>
            </div>
            <!--end profil-->
        </div>
    </div>
    </div>
  </div>
  
 </div><br>

  <!-- End page content -->
</div>

<!-- modal edit -->

<!-- modal hapus -->

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
