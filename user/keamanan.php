<!doctype html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.php')</script>";	
} else {
	require_once "proses/koneksi.php";
}

if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user']))
	{
		$id = $_SESSION['id_user'];
		$query = $connect->prepare("SELECT * FROM user WHERE id_user = :id_user");
		$query->execute(array(':id_user'=>$id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		extract($data);
	}
	else
	{
		header("Location: login.php");
	}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- JQuery -->
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
    <title>Keamanan</title>
  </head>
  <body>
    <div class="container">
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="beranda.php">AirGalonPku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="list depot air galon.php">List Depot Air Galon</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="keranjang.php">Keranjang</a>
                    </li>
                </ul>
            </div>
            <form class="d-flex" action="pencarian.php" method="post">
                <input class="form-control me-2" name="pencarian_depot" type="search" placeholder="Cari" aria-label="cari">
                <button class="btn btn-success" type="submit" name="submit"><i class="bi bi-search"></i></button>
            </form>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="transaksi.php">Transaksi</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kelola Akun
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                            <li><a class="dropdown-item" href="keamanan.php">Pengaturan Akun</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="proses/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><br><br>
    <!-- End Navbar-->
    
    <!--kelola akun-->
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="container" style="background-color: whitesmoke;">
                    <h4>Kelola Akun</h4><hr>
                    <div class="list-group">
                        <a href="profil.php" class="list-group-item list-group-item-action"><i class="bi bi-person"></i> Profil</a>
                        <a href="lokasi.php" class="list-group-item list-group-item-action"><i class="bi bi-geo-alt-fill"></i> Lokasi</a>
                        <a href="rekening.php" class="list-group-item list-group-item-action"><i class="bi bi-bank2"></i> Rekening</a>
                        <a href="keamanan.php" class="list-group-item list-group-item-action active"><i class="bi bi-shield-lock-fill"></i> Keamanan</a>
                    </div><br>
                </div><br>
            </div>
            <!--profil-->
            <div class="col-sm-9">
                <div class="container" style="background-color: whitesmoke;">
                   <form action = "proses/update-password.php?id=<?php echo $data['id_user'] ?>" method="post"?>
                    <h4>Keamanan</h4><hr>
                    <table class="table table-borderless" style="width: 400px;">
                        <tbody>
                            <tr>
                                <td>Password Lama</td>
                                <td><input type="password" name="password_lama" placeholder="Password Lama" required style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Password Baru</td>
                                <td><input type="password" placeholder="Password Baru" name="password_baru" id="passbaru" required style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Konfirmasi Password Baru</td>
                                <td><input type="password" placeholder="Password Baru" id="confirmpassbaru" required style="width: 200px;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="container">
                        <button class="btn btn-primary" type="submit" id="btnSubmit" name="submit"><i class="bi bi-save-fill"></i> Simpan</button>
                    </div><br>
                    </form>
                </div><br>
                <script type="text/javascript">
        $(function () {
            $("#btnSubmit").click(function () {
                var passbaru = $("#passbaru").val();
                var confirmpassbaru = $("#confirmpassbaru").val();
                if (passbaru != confirmpassbaru) {
                    alert("password baru tidak sama...");
                    return false;
                }
                return true;
            });
        });
    </script>
            </div>
            <!--end profil-->
        </div>
    </div>
    <!--end kelola akun-->

    <!--footer-->
    <footer class="bg-primary" style="color: white;">
        <div class="container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm">
                        <h6>Layanan Pelanggan</h6>
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
                    <div class="col-sm">
                        <h6>Lainnya</h6>
                        <p>
                            Ingin jualan air galon di website kami ? Daftarkan depotmu sekarang juga. <a href="#" class="link" style="color: white;">Klik Disini</a> Untuk Daftar.
                        </p>                   
                    </div>
                </div>
            </div>
        </div><br>
    </footer>
    <!--end footer-->

    <!-- Modal hapus -->
    <div class="modal fade" id="modalbatalpesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu ingin batalkan pesanan ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Batal</button>
                    <button type="button" class="btn btn-primary"><i class="bi bi-check2"></i> Ya</button>
                </div>
            </div>
        </div>
    </div>
    <!--end modal hapus-->
    
    <!--modal buat pesanan-->
    <div class="modal fade" id="modalbuatpesanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu ingin memesan air galon ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Batal</button>
                    <button type="button" class="btn btn-primary"><i class="bi bi-check2"></i> Ya</button>
                </div>
            </div>
        </div>
    </div>
    <!--end modal buat pesanan-->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
