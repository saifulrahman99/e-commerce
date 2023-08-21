<?php
require '../assets/basis/kon.php';

$id_produk = $_POST['id_produk'];
$stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT stok FROM produk WHERE id_produk = '$id_produk'"));

echo $stok['stok'];

