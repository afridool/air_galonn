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
         $nama_galon = htmlentities($_POST['nama_galon']);
         $nama_depot = htmlentities($_POST['nama_depot']);
         $harga_isi_ulang = htmlentities($_POST['harga_isi_ulang']);
         $harga_galon_baru = htmlentities($_POST['harga_galon_baru']);
         $no_hp = htmlentities($_POST['no_hp']);
         $pemilik = htmlentities($_POST['pemilik']);
         

        $imgFile = $_FILES['gambar_depot']['name'];
		$tmp_dir = $_FILES['gambar_depot']['tmp_name'];
		$imgSize = $_FILES['gambar_depot']['size'];
        
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
			$foto = $data['gambar_depot']; // old image from database
		}	
		
		
	}
    if(!isset($errMSG))
    {
         // Prepared statement untuk menambah data
    $query = $connect->prepare("UPDATE depot_galon 
                            SET nama_galon = :nama_galon,
                                nama_depot = :nama_depot,
                                harga_isi_ulang = :harga_isi_ulang,
                                harga_galon_baru = :harga_galon_baru,
                                no_hp =:no_hp,
                                pemilik = :pemilik,
                                gambar_depot =:gambar_depot
                            WHERE id_galon=:id_galon");
    $query->bindParam(":nama_galon", $nama_galon);
    $query->bindParam(":nama_depot", $nama_depot);
    $query->bindParam(":harga_isi_ulang", $harga_isi_ulang);
    $query->bindParam(":harga_galon_baru", $harga_galon_baru);
    $query->bindParam(":no_hp", $no_hp);
    $query->bindParam(":pemilik", $pemilik);
    $query->bindParam(":gambar_depot", $foto);
    $query->bindParam(":id_galon", $_GET['id']);
            
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