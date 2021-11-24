<?php

	require_once "proses/koneksi.php";

// Buat prepared statement untuk mengambil semua data dari tbBiodata
    $query = $connect->prepare("SELECT * FROM depot_galon ORDER BY id_galon desc limit 1");
    // Jalankan perintah SQL
    $query->execute();
    // Ambil semua data dan masukkan ke variable $data
    $data = $query->fetchAll();

    $query2 = $connect->prepare("SELECT max(id_galon) as kodeGalon FROM depot_galon");
    $query2->execute();
    $data2 = $query2->fetch();

    $kodePesan = $data2['kodeGalon'];

    $urutan = (int) substr($kodePesan, 3, 3);

    $urutan++;

    $huruf = "DPT";
    $kodePesan = $huruf . sprintf("%03s", $urutan);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Kelola Depot</title>
  </head>
  <body>
    <div class="container">
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="login-penjual.php">AirGalonPku</a>
        </div>
    </nav>
    <!-- End Navbar-->
    
    <!--kelola Depot-->
    <div class="container" style="background-color: whitesmoke;">
        <h4></h4>
        <!--Daftar depot-->
        <div class="jumbotron">
            <h5>Kamu punya Depot Air Galon ? Promosikanlah Depot kamu diwebsite kami dan berjualan air galon secara online.</h5>
            <p>Daftarkan depot air galon kamu sekarang juga.</p>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modaldaftardepot">
                <i class="bi bi-plus-square-fill"></i> Daftar Depot
            </button>
            <a href="login-penjual.php" type="button" class="btn btn-primary">Login</a>
        </div><br>
        <!--end daftar depot-->
        <?php 
						  // Buat prepared statement untuk mengambil semua data dari tbBiodata
						$query = $connect->prepare("SELECT * FROM depot_galon ORDER BY nama_depot");
						// Jalankan perintah SQL
						$query->execute();
						// Ambil semua data dan masukkan ke variable $data
							$data = $query->fetchAll();
						  ?>
        <table class="table table-sm">
            <thead>
                <td>No</td>
                <td>Nama Galon</td>
                <td>Nama Depot</td>
                <td>Alamat</td>
            </thead>
            <?php 
					$i =1;
					foreach ($data as $value): 
					?>
            <tbody>
                <td>
                <?php echo $i ?>
                </td>
                <td><?php echo $value['nama_galon'] ?></td>
                <td><?php echo $value['nama_depot'] ?></td>
                <td><?php echo $value['alamat_depot'] ?></td>
               
            </tbody>
            <?php $i++; endforeach; ?>
        </table>
    </div><br>
    <!--end kelola depot-->

    <!-- Modal hapus -->
    <div class="modal fade" id="modaldaftardepot" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <?php
										if(isset($errMSG)){
									?>
									<div class="alert alert-danger">
									<span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
									</div>
									<?php
									}
									?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Depot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="proses/input-galon.php" method="post" enctype="multipart/form-data">
                    <table class="table table-borderless" style="width: 400px;">
                        <tbody>
                            <tr>
                                <td>ID Galon</td>
                                <td><input type="text" name="id_galon" placeholder="ID Galon" value="<?php echo $kodePesan ?>" style="width: 200px;" readonly></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><input type="text" name="username" placeholder="Username" value="" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" name="password" placeholder="password" value="" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Nama Galon</td>
                                <td><input type="text" name="nama_galon" placeholder="Nama Galon" value="" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Nama Depot</td>
                                <td><input type="text" name="nama_depot" placeholder="Nama Depot" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Harga Isi Ulang</td>
                                <td><input type="text" name="harga_isi_ulang"placeholder="Harga Isi Ulang (Rupiah)" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Harga Galon Baru</td>
                                <td><input type="text" name="harga_galon_baru" placeholder="Harga Galon Baru (Rupiah)" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td><input type="text" name="lokasi_depot" placeholder="Kecamatan" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><input type="text" name="alamat" placeholder="Alamat" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td><input type="text" name="no_hp" placeholder="No Hp" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>latitude</td>
                                <td><input type="text" name="latitude" placeholder="latitude" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>longitude</td>
                                <td><input type="text" name="longitude" placeholder="longitude" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>pemilik</td>
                                <td><input type="text" name="pemilik" placeholder="pemilik" style="width: 200px;"></td>
                            </tr>
                            <tr>
                                <td>gambar</td>
                                <td><input type="file" name="gambar" placeholder="gambar" style="width: 200px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x"></i> Batal</button>
                    <button type="submit" name="submit" class="btn btn-primary"><i class="bi bi-plus-square-fill"></i> Daftar</button>
                </div>
                </form>
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
