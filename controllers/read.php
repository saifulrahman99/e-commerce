<?php
require('../assets/basis/kon.php');
$id_pengunjung = $_COOKIE['id_pengunjung'];
$id_admin = $_POST['id_admin'];

$tmsg_new = mysqli_query($db, "SELECT id_obrolan,status_terbaca FROM obrolan WHERE status_terbaca = '0'  AND pengirim = '$id_admin' AND id_pengunjung = '$id_pengunjung' AND id_akun = '$id_admin'");

$i = 0;
foreach ($tmsg_new as $update) {

    $id_obrolan = $update['id_obrolan'];
    mysqli_query($db, "UPDATE obrolan SET status_terbaca = '1' WHERE id_obrolan = '$id_obrolan'");
    $i++;
}

// untuk deteksi data baru
echo $i;
