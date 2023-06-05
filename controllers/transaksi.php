<?php
session_start();
require('../assets/basis/kon.php');



$id_pengunjung = $_SESSION['id_pengunjung'];
$waktu_bayar = date('Y-m-d H:i:s');
$pengiriman = 1;
$satatus_bayar = 0;

$nm_pembeli = $_POST['nama'];
$belanjaan = $_POST['item_keranjang'];
$alamat = $_POST['alamat'];
$nomor_hp = $_POST['telepon'];
$biaya = $_POST['biaya'];

if (!isset($_COOKIE['nama']) || $_COOKIE['nama'] == '' || $_COOKIE['nama'] != $nm_pembeli) {
    setcookie('nama', $nm_pembeli, time() + (60 * 60 * 24 * 7), '/');
    setcookie('telepon', $nomor_hp, time() + (60 * 60 * 24 * 7), '/');
    setcookie('alamat', $alamat, time() + (60 * 60 * 24 * 7), '/');
}


if ($_POST['opsi'] == "add") {

    $insert = mysqli_query($db, "INSERT INTO transaksi(nm_pembeli, belanjaan, pengiriman, waktu_bayar, satatus_bayar, alamat, nomor_hp, biaya, id_pengunjung) VALUES ('$nm_pembeli', '$belanjaan', '$pengiriman', '$waktu_bayar', '$satatus_bayar', '$alamat', '$nomor_hp', '$biaya', '$id_pengunjung')");

    if ($insert) {
        unset($_SESSION['keranjang']);
    }
}
