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
         

        $imgFile = $_FILES['gambar']['name'];
		$tmp_dir = $_FILES['gambar']['tmp_name'];
		$imgSize = $_FILES['gambar']['size'];
        
		if($imgFile)
		{
			$upload_dir = '../gambar/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$foto = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					move_uploaded_file($tmp_dir,$upload_dir.$foto);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
                    ?>
                    <script>
                    alert('Foto Terlalu Besar (kecil dari 5mb) ...');
                    window.location.href='../profil.php';
                    </script>
                    <?php
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                ?>
                <script>
                alert('Hanya tipe file JPG, JPEG, PNG, GIF yang diperbolehkan ...');
                window.location.href='../profil.php';
                </script>
                <?php
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$foto = $data['gambar']; // old image from database
		}	
		
		
	}
    if(!isset($errMSG))
    {
         // Prepared statement untuk menambah data
    $query = $connect->prepare("UPDATE user 
                            SET nama = :nama,
                                username = :username, 
                                email=:email,
                                no_hp=:no_hp,
                                jenis_kelamin=:jenis_kelamin,
                                tgl_lahir = :tgl_lahir,
                                gambar=:gambar
                            WHERE id_user=:id_user");
    $query->bindParam(":nama", $nama);
    $query->bindParam(":username", $username);
    $query->bindParam(":email", $email);
    $query->bindParam(":no_hp", $no_hp);
    $query->bindParam(":jenis_kelamin", $jenis_kelamin);
    $query->bindParam(":tgl_lahir", $tgl_lahir);
    $query->bindParam(":gambar", $foto);
    $query->bindParam(":id_user", $_GET['id']);
            
        if($query->execute()){
            ?>
            <script>
            alert('Berhasil Ubah Data ...');
            window.location.href='../profil.php';
            </script>
            <?php
        }
        else{
            ?>
            <script>
            alert('Gagal Ubah Data ...');
            window.location.href='../profil.php';
            </script>
            <?php
        }
    
    }

    
?>