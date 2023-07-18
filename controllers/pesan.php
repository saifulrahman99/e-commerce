<?php
require '../assets/basis/kon.php';
$pesan = $_POST['pesan'];
$pengunjung = $_POST['pengunjung'];
$admin = $_POST['admin'];
$waktu = date('Y-m-d H:i');

mysqli_query($db, "INSERT INTO obrolan (pesan, waktu, pengirim, id_pengunjung,id_akun) VALUE('$pesan','$waktu','$pengunjung','$pengunjung','$admin')");