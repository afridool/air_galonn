<!doctype html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.html')</script>";	
} else {
	require_once "proses/koneksi.php";
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

    <title>Keranjang</title>
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
    
    <!--keranjang-->
    <form action="proses/proses-bayar-keranjang.php" method = "post">
    <div class="container" style="background-color: whitesmoke;">
        <h4>Keranjang</h4><hr>
        <?php 
						 // Buat prepared statement untuk mengambil semua data dari tbBiodata
                         $query = $connect->prepare("SELECT depot_galon.*,user.*, keranjang.* FROM (( keranjang 
                         INNER JOIN depot_galon ON depot_galon.id_galon = keranjang.id_galon)
                         INNER JOIN user ON user.id_user = keranjang.id_user)
                         WHERE user.id_user = :id_user");
                           $query->bindParam(":id_user", $_SESSION['id_user']);
                         $query->execute();
                         // Ambil semua data dan masukkan ke variable $data
                             $data = $query->fetchAll();
                            
                             if($data != null){
                            
			?>
            <?php 
					 $i =1;

                     $sum = 0;
					foreach ($data as $value): 

                        $total_seluruh = $value['total_pembayaran_keranjang'];
                        $total_pengiriman = 1000;

                        $subtotal_pembayaran = $total_seluruh+$total_pengiriman;

                        $total_checkout = $sum += $subtotal_pembayaran
										
			?>
        <div class="row">
            <div class="col-sm-5">
                <img src="../pemilik-depot/gambar/<?php echo $value['gambar_depot']?>" style="width: 100%; height: auto;">
            </div>
            <div class="col-sm-7">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                          <td>Nama Galon</td>
                          <td>:</td>
                          <td><?php echo $value['nama_galon']?></td>
                        </tr>
                            <td>Harga Isi Ulang</td>
                            <td>:</td>
                            <td><?php echo $value['harga_isi_ulang']?></td>
                        </tr>
                        <tr>
                            <td>Harga Galon Baru</td>
                            <td>:</td>
                            <td><?php echo $value['harga_galon_baru']?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Isi Ulang</td>
                            <td>:</td>
                            <td><input type="number" name="jumlah_isi_ulang" value="<?php echo $value['keranjang_isi_ulang']?>" min="0" id="jumlah-isi-ulang" maxlength="5" readonly></td>
                        </tr>
                        <tr>
                            <td>Jumlah Galon Baru</td>
                            <td>:</td>
                            <td><input type="number" name="jumlah_galon_baru" value="<?php echo $value['keranjang_galon_baru']?>" min="0" id="jumlah-isi-ulang" maxlength="5" readonly></td>
                        </tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td>:</td>
                            <td><input type="text" name="total_bayar" value="<?php echo $subtotal_pembayaran?>" min="0" id="jumlah-isi-ulang" maxlength="5" readonly></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button"  class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalhapus<?php echo $value['id_keranjang']?>">
                    <i class="bi bi-trash"></i> Hapus  
                </button><br>
            </div>
        </div><br>

        <?php  $i++; endforeach; ?>
        <div class="row">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7 text-end">
                <table class="table table-borderless">
                    <tbody>   
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td>
                                <select name="metode_pembayaran" class="form-select" id="metode-pembayaran" style="width:300px;" required>
                                    <option value="" selected hidden>Pilih Metode Pembayaran</option>
                                    <option value="Cash On Delivery">Cash On Delivery</option>
                                    <option value="Rekening">Rekening</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <p>
                <?php  

                 echo "Rp. " . $total_checkout.",-  (Ongkos kirim Rp.1000 per item)" ;  

                ?>
                <button class="btn btn-danger" type="submit" name="submit" role="button">
                    <i class="bi bi-cash"></i> Checkout
                </button>
            </p>
            <?php
                            }else{
                        ?>
                            Keranjang anda kosong
                    <?php
                        }
                    ?>
            </div>
        </div>
        <hr><br>
        
    </div><br><br>
    </form>
  
    <!--end keranjang-->

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
    <!-- Modal Keranjang -->
    <?php 
					 $i =1;
					foreach ($data as $value): 
										
	?>
    <div class="modal fade" id="modalhapus<?php echo $value['id_keranjang']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action = "proses/delete-keranjang.php?id=<?php echo $value['id_keranjang'] ?>" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah kamu ingin hapus pesanan ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-check2"></i> Ya</button>
                </div>
            </div>
        </div>
        </form>
    </div>
    <?php $i++; endforeach; ?>
    <!--end modal hapus-->
    

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
