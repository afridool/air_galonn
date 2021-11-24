<!doctype html>
<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='login.html')</script>";	
} else {
	require_once "proses/koneksi.php";
}


// Buat prepared statement untuk mengambil semua data dari tbBiodata
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
		header("Location: list depot air galon.php");
	}
    
    if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS

        $query = $connect->prepare("SELECT * FROM depot_galon WHERE id_galon = :id_galon");
		$query->execute(array(':id_galon'=>$id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		extract($data);

        
        $jumlah_isi_ulang = htmlentities($_POST['jumlah_isi_ulang']);
        $jumlah_galon_baru = htmlentities($_POST['jumlah_galon_baru']);
        
        $total_isi_ulang = $jumlah_isi_ulang*$data['harga_isi_ulang'];
        $total_galon_baru = $jumlah_galon_baru*$data['harga_galon_baru'];

        $total_seluruh = $total_galon_baru + $total_isi_ulang;

        $total_pengiriman = 1000;

        $subtotal_pembayaran = $total_seluruh+$total_pengiriman;
       
        $query2 = $connect->prepare("SELECT max(kode_pesanan) as maxkode FROM pesanan_galon");
        $query2->execute();
        $data2 = $query2->fetch();

        $kodePesan = $data2['maxkode'];

        $urutan = (int) substr($kodePesan, 3, 3);
 
        $urutan++;
 
        $huruf = "GLN";
        $kodePesan = $huruf . sprintf("%03s", $urutan);


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

    <title>Checkout</title>
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
    
    <!--checkout-->
    <div class="container" style="background-color: whitesmoke;">
        <h4>Checkout</h4><hr>
        <div class="row">
            <div class="col-sm-5">
            <img src="../pemilik-depot/gambar/<?php echo $data['gambar_depot']?>" style="width: 100%; height: auto;">
            </div>
            <div class="col-sm-7">
                <form action = "proses/input-transaksi.php" method="post">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                          <td>Nama Galon</td>
                          <td>:</td>
                          <td><?php echo $data['nama_galon']?></td>
                        </tr>
                            <td>Harga Isi Ulang</td>
                            <td>:</td>
                            <td><?php echo $data['harga_isi_ulang']?></td>
                        </tr>
                        <tr>
                            <td>Harga Galon Baru</td>
                            <td>:</td>
                            <td><?php echo $data['harga_galon_baru']?></td>
                        </tr>
                        <tr>
                            <td>Jumlah Isi Ulang</td>
                            <td>:</td>
                            <td><input type="text" name="jumlah_isi_ulang" value="<?php echo $jumlah_isi_ulang ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Jumlah Galon Baru</td>
                            <td>:</td>
                            <td><input type="text" name="jumlah_galon_baru" value="<?php echo $jumlah_galon_baru ?>" readonly></td>
                        </tr>
                        <tr>
                            <td>Total Isi Ulang</td>
                            <td>:</td>
                            <td>
                            <?php echo "Rp. ", $total_isi_ulang ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Total Galon Baru</td>
                            <td>:</td>
                            <td><?php echo "Rp. ", $total_galon_baru ?></td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td>:</td>
                            <td><?php echo "Rp. ", $total_seluruh ?></td>
                        </tr>
                        
    
                            <td><input type="text" name="status_pesanan" value="Sedang Diproses" hidden></td>
                        
                        
                            
                            <td><input type="text" name="id_user" value="<?php echo $_SESSION['id_user']?>" hidden></td>
                        
                        
                            <td><input type="text" name="id_galon" value="<?php echo $data['id_galon']?>" hidden></td>
                        
                    </tbody>
                </table>
            </div>
        </div><hr>
        <div class="row">
            <div class="col-sm-5">
            </div>
            <div class="col-sm-7">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Subtotal Air Galon</td>
                            <td>:</td>
                            <td><?php echo "Rp. ", $total_seluruh ?></td>
                        </tr>
                        <tr>
                            <td>Subtotal pengiriman</td>
                            <td>:</td>
                            <td><?php echo "Rp. ", $total_pengiriman ?></td>
                        </tr>
                        <tr>
                            <td>Subtotal Pembayaran</td>
                            <td>:</td>
                            <td>Rp. <input type="text" name="total_pembayaran" value="<?php echo $subtotal_pembayaran ?>" readonly></td></td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td>:</td>
                            <td>
                                <select name="metode_pembayaran" class="form-select" id="metode-pembayaran" required>
                                    <option value="" selected hidden>Pilih Metode Pembayaran</option>
                                    <option value="Cash On Delivery">Cash On Delivery</option>
                                    <option value="Rekening">Rekening</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="container text-end">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalbatalpesanan">
                        <i class="bi bi-x"></i> Batalkan Pesanan
                    </button>
                    <button type="submit" name="submit" class="btn btn-danger" >
                        <i class="bi bi-file-check"></i> Buat Pesanan
                    </button>
                </div>
                </form>
            </div>
        </div><hr><br>
    </div><br><br>
    <!--end checkout-->

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
