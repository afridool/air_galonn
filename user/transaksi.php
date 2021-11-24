<!doctype html>
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
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Transaksi</title>
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
    
    <!--transaksi-->
    <div class="container">
        <div class="row">
            <!--menu transaksi-->
            <div class="col-sm-4">
                <div class="container" style="background-color: whitesmoke;">
                    <h4>Transaksi</h4><hr>
                    <div class="list-group">
                        <a href="transaksi.php" class="list-group-item list-group-item-action active"><i class="bi bi-three-dots"></i> Semuanya</a>
                        <a href="transaksi-proses.php" class="list-group-item list-group-item-action"><i class="bi bi-arrow-repeat"></i> Sedang di Proses</a>
                        <a href="transaksi-dikirim.php" class="list-group-item list-group-item-action"><i class="bi bi-truck"></i> Dikirim</a>
                        <a href="transaksi-selesai.php" class="list-group-item list-group-item-action"><i class="bi bi-check-square-fill"></i> Selesai</a>
                    </div><br>
                </div><br>
            </div>
            <!--end menu transaksi-->
            <!--semuanya-->
            <div class="col-sm-8">
                <div class="container" style="background-color: whitesmoke;">
                    <h4>Semuanya</h4><hr>
                    <div class="card mb-3" style="max-width: 700px;">
                    <?php 
            
						  // Buat prepared statement untuk mengambil semua data dari tbBiodata
						$query = $connect->prepare("SELECT depot_galon.*,user.*, pesanan_galon.* FROM (( pesanan_galon 
                        INNER JOIN depot_galon ON depot_galon.id_galon = pesanan_galon.id_galon)
                        INNER JOIN user ON user.id_user = pesanan_galon.id_user)
                        WHERE user.id_user = :id_user ORDER BY pesanan_galon.kode_pesanan");
                        $query->bindParam(":id_user", $_SESSION['id_user']);
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
                        <div class="row g-0">
                        <div class="col-md-5">
                              <div class="container" style="padding: 20px;">
                                <img src="../pemilik-depot/gambar/<?php echo $value['gambar_depot'] ?>" alt="..." style="width: 280px;">
                              </div>
                          </div>
                          <div class="col-md-7">
                            <div class="card-body">
                              <h6 class="card-title"> <?php echo $value['nama_galon'] ?></h6>
                              <p class="card-text"> Jumlah Isi Ulang  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;: <?php echo $value['jumlah_isi_ulang'] ?> </p>
                              <p class="card-text"> Jumlah Galon Baru &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $value['jumlah_galon_baru'] ?></p>
                              <p class="card-text"> Total Pembayaran  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $value['total_pembayaran'] ?></p>
                              <?php
                                if($value['status_pesanan'] == "Dikirim")
                                {

                                ?>
                              <p class="card-text"> Status Pesanan    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp :  <span class="badge badge-secondary"><?php echo $value['status_pesanan'] ?> <i class="bi bi-truck"></i></span> </p>
                              <?php
                                }elseif($value['status_pesanan'] == "Sedang Diproses") {
                              ?>
                                <p class="card-text"> Status Pesanan    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp :  <span class="badge badge-secondary"><?php echo $value['status_pesanan'] ?> <i class="bi bi-arrow-repeat"></i></span> </p>
                                <?php
                                }else{
                                ?>
                                 <p class="card-text"> Status Pesanan    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp :  <span class="badge badge-secondary"><?php echo $value['status_pesanan'] ?> <i class="bi bi-check-square-fill"></i></span> </p>
                                 <?php
                                    }
                                ?>
                             
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
            <!--end semuanya-->
        </div>
    </div>
    <!--end transaksi-->

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
