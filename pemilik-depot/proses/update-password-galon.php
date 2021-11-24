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
		$query = $connect->prepare("SELECT * FROM depot_galon WHERE id_galon = :id_galon");
		$query->execute(array(':id_galon'=>$id));
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
        $password_lama = htmlentities($_POST['password_lama']);
        $password_baru = htmlentities($_POST['password_baru']);

         if($password_lama == $data['password']){
            $query = $connect->prepare("UPDATE depot_galon 
            SET password = :password
            WHERE id_galon=:id_galon");
            $query->bindParam(":password", $password_baru);
            $query->bindParam(":id_galon", $_GET['id']);

            if($query->execute()){
                    ?>
                     <script>
                    alert('Berhasil Ubah Data ...');
                    window.location.href='../keamanan.php';
                    </script>
                    <?php
                }
                else{
                    ?>
                    <script>
                    alert('Gagal Ubah Data ...');
                    window.location.href='../keamanan.php';
                    </script>
                    <?php
                }
         } else{
            ?>
                    <script>
                    alert('Password salah ...');
                    window.location.href='../keamanan.php';
                    </script>
                    <?php
         }
		
 }
?>