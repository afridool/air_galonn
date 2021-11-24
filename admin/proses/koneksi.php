<?php
try {
	$connect = new PDO("mysql:host=localhost;dbname=air_galon", "root", "");
} catch (PDOException $ex) {
	echo 'Koneksi gagal, hubungi Administrator Sistem.';
	exit();
}
?>