<!doctype html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.html')</script>";	
} else {
	require_once "proses/koneksi.php";
}
// Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $connect->prepare("SELECT * FROM depot_galon ORDER BY id_galon desc limit 1");
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

    <title>List Depot Air Galon</title>
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
    
    <div class="container" style="background-color: whitesmoke;">
        <h4>List Depot Air Galon</h4><hr>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
						  // Buat prepared statement untuk mengambil semua data dari tbBiodata
						$query = $connect->prepare("SELECT * FROM depot_galon ORDER BY nama_depot desc");
						// Jalankan perintah SQL
						$query->execute();
						// Ambil semua data dan masukkan ke variable $data
							$data = $query->fetchAll();
			?>
            <?php 
					 $i =1;
					foreach ($data as $value): 
										
			?>
                <div class="col">
                <div class="card h-100">
                    <img src="../pemilik-depot/gambar/<?php echo $value['gambar_depot'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $value['nama_depot'] ?></h5>
                        <p class="card-text">
                            Harga Isi Ulang : <?php echo $value['harga_isi_ulang'] ?><br>
                            Harga Galon Baru : <?php echo $value['harga_galon_baru'] ?>
                        </p><br>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalbeli<?php echo $value['id_galon'] ?>">
                            <i class="bi bi-cash"></i> Beli
                        </button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalkeranjang<?php echo $value['id_galon'] ?>">
                            <i class="bi bi-cart-plus-fill"></i> + Keranjang 
                        </button><br><br>
                        <a class="btn btn-info" href="detail depot.php?id=<?php echo $value['id_galon']?>" role="button">
                            <i class="bi bi-cash"></i> Cek Detail Air Galon
                        </a>
                    </div>
                   
                </div>
            </div>
            <?php $i++; endforeach; ?>
        </div><hr>
    </div><br><br>
    <!--end list-->

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

     <!-- Modal Beli -->
     <?php 
					 $i =1;
					foreach ($data as $value): 
										
	?>
     <div class="modal fade" id="modalbeli<?php echo $value['id_galon'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action = "checkout.php?id=<?php echo $value['id_galon'] ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Beli Air Galon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                              <td>Jumlah Isi Ulang</td>
                              <td>:</td>
                              <td><input type="number" name="jumlah_isi_ulang" value="0" min="0" id="jumlah-isi-ulang" maxlength="5"></td>
                            </tr>
                            <tr>
                              <td>Jumlah Galon Baru</td>
                              <td>:</td>
                              <td><input type="number" name="jumlah_galon_baru" value="0" min="0" id="jumlah-isi-ulang" maxlength="5"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-cash"></i> beli</button>
                </div>
            </form> 
            </div>
            </form>
        </div>
    </div>
    <?php $i++; endforeach; ?>                   
     <!-- Modal Keranjang -->
     <?php 
					 $i =1;
					foreach ($data as $value): 
										
	?>
    <div class="modal fade" id="modalkeranjang<?php echo $value['id_galon'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form action = "proses/input-keranjang.php?id=<?php echo $value['id_galon'] ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah ke Keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                              <td>Jumlah Isi Ulang</td>
                              <td>:</td>
                              <td>
                                  <input type="number" name="isi_ulang" value="0" min="0" id="jumlah-isi-ulang" maxlength="5">
                              </td>
                            </tr>
                            <tr>
                              <td>Jumlah Galon Baru</td>
                              <td>:</td>
                              <td><input type="number" name="galon_baru" value="0" min="0" id="jumlah-isi-ulang" maxlength="5"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Batal</button>
                    <button  type="submit" name="submit" class="btn btn-danger"><i class="bi bi-cart-plus-fill"></i> Masuk Keranjang</button>
                </div>
                </form>
            </div>
           
        </div>
    </div>
    <?php $i++; endforeach; ?>       
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
