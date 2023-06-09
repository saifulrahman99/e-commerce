<?php

namespace Midtrans;

use mysqli;

require('../assets/basis/kon.php');


require_once '../vendor/payment/Midtrans.php';
Config::$isProduction = false;
Config::$serverKey = 'SB-Mid-server-z-__Mmo5avW30d27vWSREhKd';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

try {
    $notif = new Notification();
} catch (\Exception $e) {
    exit($e->getMessage());
}

$notif = $notif->getResponse();
$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;


if ($transaction == 'settlement') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '1', metode_bayar = '$type' WHERE order_id = '$order_id'");

    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT belanjaan FROM transaksi WHERE order_id = '$order_id'"));
    $belanjaan = $select['belanjaan'];
    $belanjaan = json_decode($belanjaan);
    foreach ($belanjaan as $id_produk => $jml_item) {

        $stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT stok FROM produk WHERE id_produk = '$id_produk'"));

        $stok = $stok['stok'];
        $stok = $stok - $jml_item;

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

function printExampleWarningMessage()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        echo 'Notification-handler are not meant to be opened via browser / GET HTTP method. It is used to handle Midtrans HTTP POST notification / webhook.';
    }
    if (strpos(Config::$serverKey, 'SB-Mid-server-z-__Mmo5avW30d27vWSREhKd') != false) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-z-__Mmo5avW30d27vWSREhKd\';');
        die();
    }
}
