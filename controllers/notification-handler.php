<?php

namespace Midtrans;

require('../assets/basis/kon.php');

require_once '../vendor/payment/Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-z-__Mmo5avW30d27vWSREhKd';

$notif = new Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;

if ($transaction == 'settlement') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '1', metode_bayar = '$type' WHERE order_id = '$order_id'");

    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT belanjaan FROM transaksi WHERE order_id = '$order_id'"));
    $belanjaan = $select['belanjaan'];
    $belanjaan = json_decode($belanjaan);
    foreach ($belanjaan as $id_produk => $jml_item) {

        $stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT stok FROM produk WHERE id_produk = '$id_produk'"));

        $stok = $stok['stok'];
        $stok = $stok - $jml_item[0];

        mysqli_query($db, "UPDATE produk SET stok = '$stok' WHERE id_produk = '$id_produk'");
    }
    
} else if ($transaction == 'pending') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '0', metode_bayar = '$type' WHERE order_id = '$order_id'");
} else if ($transaction == 'deny') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2', metode_bayar = '$type' WHERE order_id = '$order_id'");
} else if ($transaction == 'expire') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2', metode_bayar = '$type' WHERE order_id = '$order_id'");
} else if ($transaction == 'cancel') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2', metode_bayar = '$type' WHERE order_id = '$order_id'");
}