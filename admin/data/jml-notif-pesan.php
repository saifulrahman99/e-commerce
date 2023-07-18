<?php
require_once '../../assets/basis/kon.php';

$id_admin = $_COOKIE['id_admin'];
$total_pesan = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(status_terbaca) as jml_pesan FROM obrolan WHERE status_terbaca = '0' AND pengirim != '$id_admin'"));

echo $total_pesan['jml_pesan'];
?>