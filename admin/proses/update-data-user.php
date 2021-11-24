<?php
  session_start();
if (empty($_SESSION['username'])){
	echo "<script>alert('Anda Harus Login Terlebih Dahulu !',document.location.href='../login.html')</script>";	
} else {
	require_once "koneksi.php";
}

if(isset($_GET['id']) && !empty($_GET['id']))
	{
		$id = $_GET['id'];
		$query = $connect->prepare("SELECT * FROM user WHERE id_user = :id_user");
		$query->execute(array(':id_user'=>$id));
		$data = $query->fetch(PDO::FETCH_ASSOC);
		extract($data);
	}
	else
	{
		header("Location: ../profil.php");
	}
	
	
 if(isset($_POST['submit'])){
        // Simpan data yang di inputkan ke POST ke masing-masing variable
        // dan convert semua tag HTML yang mungkin dimasukkan untuk mengindari XSS
         $nama = htmlentities($_POST['nama']);
         $username = htmlentities($_POST['username']);
         $email = htmlentities($_POST['email']);
         $no_hp = htmlentities($_POST['no_hp']);
         $jenis_kelamin = htmlentities($_POST['jenis_kelamin']);
         $tgl_lahir = $_POST['tgl_lahir'];
         $kecamatan = htmlentities($_POST['kecamatan']);
         $kelurahan = htmlentities($_POST['kelurahan']);
         $no_rekening = htmlentities($_POST['no_rekening']);
         $nama_rekening = htmlentities($_POST['nama_rekening']);
         $nama_bank = htmlentities($_POST['nama_bank']);

        
         // Prepared statement untuk menambah data
    $query = $connect->prepare("UPDATE user 
                            SET nama = :nama,
                                username = :username, 
                                email=:email,
                                no_hp=:no_hp,
                                jenis_kelamin=:jenis_kelamin,
                                tgl_lahir = :tgl_lahir,
                                kecamatan = :kecamatan,
                                kelurahan = :kelurahan,
                                no_rekening = :no_rekening,
                                nama_rekening = :nama_rekening,
                                nama_bank = :nama_bank
                            WHERE id_user=:id_user");
    $query->bindParam(":nama", $nama);
    $query->bindParam(":username", $username);
    $query->bindParam(":email", $email);
    $query->bindParam(":no_hp", $no_hp);
    $query->bindParam(":jenis_kelamin", $jenis_kelamin);
    $query->bindParam(":tgl_lahir", $tgl_lahir);
    $query->bindParam(":kecamatan", $kecamatan);
    $query->bindParam(":kelurahan", $kelurahan);
    $query->bindParam(":no_rekening", $no_rekening);
    $query->bindParam(":nama_rekening", $nama_rekening);
    $query->bindParam(":nama_bank", $nama_bank);
    $query->bindParam(":id_user", $_GET['id']);
            
        if($query->execute()){
            ?>
            <script>
            alert('Berhasil Ubah Data ...');
            window.location.href='../data-user.php';
            </script>
            <?php
        }
        else{
            ?>
            <script>
            alert('Gagal Ubah Data ...');
            window.location.href='../data-user`.php';
            </script>
            <?php
        }
    
    }

    
?>