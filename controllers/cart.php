<?php
session_start();

if ($_POST['opsi'] == 'direct') {
    
    $qty = 1;
    $id_produk = $_POST['id_produk'];
    
    if (isset($_POST['qty'])) {
        $qty = max($_POST['qty'],1);
    }
    
    if(!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }
    
    if (!isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk] = $qty;
    } else {
        $_SESSION['keranjang'][$id_produk] += $qty;
    }
    
    
}elseif ($_POST['opsi'] == 'hapus') {

    $id_produk = $_POST['id_produk'];
    unset($_SESSION['keranjang'][$id_produk]);
    $jmlData = count($_SESSION['keranjang']);

}
