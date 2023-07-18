<?php
require_once '../../assets/basis/kon.php';
$pesan = $_POST['pesan'];
$pengunjung = $_POST['pengunjung'];
$admin = $_COOKIE['id_admin'];
$waktu = date('Y-m-d H:i');

mysqli_query($db, "INSERT INTO obrolan (pesan, waktu, pengirim, id_pengunjung,id_akun) VALUE('$pesan','$waktu','$admin','$pengunjung','$admin')");
?>