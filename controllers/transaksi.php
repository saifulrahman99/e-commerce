<?php
namespace Midtrans;
session_start();
require('../assets/basis/kon.php');
require('../function.php');

$id_pengunjung = $_SESSION['id_pengunjung'];

$waktu_bayar = date('Y-m-d H:i:s');
$satatus_bayar = 0;

$nm_pembeli = $_POST['nama'];
$belanjaan = $_POST['item_keranjang'];
$alamat = $_POST['alamat'];
$nomor_hp = $_POST['telepon'];
$biaya = $_POST['biaya'];
$pengiriman = $_POST['ambil_barang'];


$cookie_nama = (isset($_COOKIE['nama'])) ? $_COOKIE['nama'] : '';

if ($cookie_nama != $nm_pembeli || $cookie_nama == '') {
    setcookie('nama', $nm_pembeli, time() + (60 * 60 * 24 * 7), '/');
    setcookie('telepon', $nomor_hp, time() + (60 * 60 * 24 * 7), '/');
    setcookie('alamat', $alamat, time() + (60 * 60 * 24 * 7), '/');
}


require_once '../vendor/payment/Midtrans.php';

//Set Your server key
Config::$serverKey = "SB-Mid-server-z-__Mmo5avW30d27vWSREhKd";

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

// Uncomment for append and override notification URL
// Config::$appendNotifUrl = "https://example.com";
// Config::$overrideNotifUrl = "https://example.com";

// Required
$now = date('d-m-Y');
$t = explode('-', $now);
$susunan_2 = "$t[0]$t[1]$t[2]";

$selectId = mysqli_fetch_assoc(mysqli_query($db, "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC"));

if (empty($selectId['id_transaksi'])) {
    $susunan_3 = '1';
} else {
    $susunan_3 = $selectId['id_transaksi'] + 1;
}

$kodeRandom = kodeRandom(5);
$order_id = "order-$susunan_2$susunan_3-$kodeRandom";

$transaction_details = array(
    'order_id' => $order_id,
    
    'gross_amount' => intval($biaya), // no decimal allowed for creditcard
);

$item_details = array();

$belanjaan_decode = json_decode($belanjaan);

foreach ($belanjaan_decode as $id_item => $ket_item) {
    $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
    $nmProduk = $produk['nm_produk'];
    $harga = $produk['harga_jual'];
    
    $item_array = array(
        'id' => $id_item,
        'price' => $ket_item[1],
        'quantity' => $ket_item[0],
        'name' => $nmProduk
    );
    array_push($item_details,$item_array);
}

// Optional
$billing_address = array(
    'first_name'    => $nm_pembeli,
    'address'       => $alamat,
    'phone'         => $nomor_hp,
    'country_code'  => 'IDN'
);

// Optional
$customer_details = array(
    'first_name'    => $nm_pembeli,
    'phone'         => $nomor_hp,
    'billing_address'  => $billing_address,

);

// Optional, remove this to display all available payment methods
// $enable_payments = array('bni_va', 'bri_va', 'gopay', 'echannel','permata_va','other_qris');

// Fill transaction details
$transaction = array(
    // 'enabled_payments' => $enable_payments,
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snapToken = Snap::getSnapToken($transaction);


if ($_POST['opsi'] == "add") {

    $insert = mysqli_query($db, "INSERT INTO transaksi(nm_pembeli, belanjaan, pengiriman, waktu_bayar, status_bayar, alamat, nomor_hp, biaya, id_pengunjung, order_id, snap_token) VALUES ('$nm_pembeli', '$belanjaan', '$pengiriman', '$waktu_bayar', '$satatus_bayar', '$alamat', '$nomor_hp', '$biaya', '$id_pengunjung', '$order_id', '$snapToken')");

    if ($insert) {
        unset($_SESSION['keranjang']);
    }
}

echo $snapToken;