<?php
require('../assets/basis/kon.php');

$id_pengunjung = $_POST['id_pengunjung'];
$token = $_POST['token'];

mysqli_query($db,"UPDATE pengunjung SET token = '$token' WHERE id_pengunjung = '$id_pengunjung'");
?>