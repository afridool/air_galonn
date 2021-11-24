<!DOCTYPE html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login-admin.php')</script>";	
} else {
	require_once "proses/koneksi.php";
}
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
    <a href="beranda.php" class="w3-bar-item w3-button w3-padding w3-black" style="text-decoration: none;"><i class="fa fa-home fa-fw"></i> Beranda</a>
    <a href="data-user.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-person-lines-fill"></i> Data User</a>
    <a href="data-depot.php" class="w3-bar-item w3-button w3-padding" style="text-decoration: none;"><i class="bi bi-building"></i> Data Depot</a>
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
    <h5><b><i class="fa fa-home fa-fw"></i> Beranda</b></h5>
    <hr>
  </header>

  <!--body-->
  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-container">
        <div class="container" style= "background-color: white;">
            <h6 class="display-6" style="padding: 100px; margin: 20px;">Dashboard Admin AirGalonPku</h6>
        </div><hr>
    </div>
  </div>

  <br>
  

  

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
