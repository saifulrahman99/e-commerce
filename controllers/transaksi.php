<?php

namespace Midtrans;

session_start();
require('../assets/basis/kon.php');
require('../function.php');

$id_pengunjung = $_COOKIE['id_pengunjung'];

$waktu_transaksi = date('Y-m-d H:i:s');
$status_bayar = 0;
$status_terkirim = 0;

$nm_pembeli = $_POST['nama'];
$belanjaan = $_POST['item_keranjang'];
$alamat = $_POST['alamat'];
$nomor_hp = $_POST['telepon'];
$catatan = $_POST['catatan'];
$biaya = $_POST['biaya'];
$metode_bayar = ($_POST['metode_bayar'] != 'cod') ? '' : $_POST['metode_bayar'];


$cookie_nama = (isset($_COOKIE['nama'])) ? $_COOKIE['nama'] : '';
$cookie_alamat = (isset($_COOKIE['alamat'])) ? $_COOKIE['alamat'] : '';
$cookie_telepon = (isset($_COOKIE['telepon'])) ? $_COOKIE['telepon'] : '';

if ($cookie_nama != $nm_pembeli || $cookie_nama == '') {
    setcookie('nama', $nm_pembeli, time() + (60 * 60 * 24 * 365), '/');
}
if ($cookie_alamat != $alamat || $cookie_alamat == '') {
    setcookie('alamat', $alamat, time() + (60 * 60 * 24 * 365), '/');
}
if ($cookie_telepon != $nomor_hp || $cookie_telepon == '') {
    setcookie('telepon', $nomor_hp, time() + (60 * 60 * 24 * 365), '/');
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

// $item_details = array();

// $belanjaan_decode = json_decode($belanjaan);

// foreach ($belanjaan_decode as $id_item => $ket_item) {
//     $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
//     $nmProduk = $produk['nm_produk'];
//     $harga = $produk['harga_jual'];

//     $item_array = array(
//         'id' => $id_item,
//         'price' => $ket_item[1],
//         'quantity' => round($ket_item[0]),
//         'name' => $nmProduk
//     );
//     array_push($item_details,$item_array);
// }

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
    'customer_details' => $customer_details
    // 'item_details' => $item_details,
);


$snapToken = Snap::getSnapToken($transaction);

if ($_POST['opsi'] == "add") {

    $insert = mysqli_query($db, "INSERT INTO transaksi(nm_pembeli, belanjaan, metode_bayar, waktu_transaksi, status_bayar, alamat, catatan, nomor_hp, biaya, id_pengunjung, order_id, snap_token,status_terkirim) VALUES ('$nm_pembeli', '$belanjaan', '$metode_bayar', '$waktu_transaksi', '$status_bayar', '$alamat', '$catatan', '$nomor_hp', '$biaya', '$id_pengunjung', '$order_id', '$snapToken','$status_terkirim')");

    if ($insert) {
        unset($_SESSION['keranjang']);
    }
}

if ($metode_bayar != 'cod') {
    echo $snapToken;
} else {

    $belanjaan = json_decode($belanjaan);

    $jml_arr = count((array)$belanjaan);
    $text = '';
    $i = 1;
    foreach ($belanjaan as $id_produk => $isi_item) {

        $stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_produk'"));

        $nm_produk = $stok['nm_produk'];
        $satuan = $stok['satuan'];
        if ($jml_arr == 1) {
            $text .= "*" . $nm_produk . "* sebanyak " . $isi_item[0] . " " . $satuan . " ( " . rupiah($isi_item[1]) . " /" . $satuan . ")";
        } elseif ($i == $jml_arr) {
            $text .= "dan *" . $nm_produk . "* sebanyak " . $isi_item[0] . " " . $satuan . " ( " . rupiah($isi_item[1]) . " /" . $satuan . ") ";
        } elseif ($i == ($jml_arr - 1)) {
            $text .= "*" . $nm_produk . "* sebanyak " . $isi_item[0] . " " . $satuan . " ( " . rupiah($isi_item[1]) . " /" . $satuan . ") ";
        } else {
            $text .= "*" . $nm_produk . "* sebanyak " . $isi_item[0] . " " . $satuan . " ( " . rupiah($isi_item[1]) . " /" . $satuan . "), ";
        }

        $i++;
    }

    $nomor_hp_length = strlen("$nomor_hp");
    $nomor_hp_length = (1 - $nomor_hp_length);

    $awalan_nomor_hp = substr($nomor_hp, 0, $nomor_hp_length);

    if ($awalan_nomor_hp == '0') {
        $akhiran_nomor_hp = substr($nomor_hp, 1);
        $nomor_hp = '62' . $akhiran_nomor_hp;
    } else {
        $nomor_hp;
    }

    $catatan = (empty($catatan)) ? 'tidak ada' : $catatan;
    // notif ke admin
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => "081998282879|" . $nm_pembeli,
            'message' => '*Notifikasi Pemesanan*

Pesanan atas nama *{name}*
ID Order *' . $order_id . '*
Metode Pembayaran *' . strtoupper($metode_bayar) . '*

Pesanan :
' . $text . '

*Catatan*
' . $catatan . '

*kontak pemesan :* 
https://wa.me/' . $nomor_hp . '
*cek website :*
https://technoyus.my.id/admin/adastra/transaksi
',
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: @ec9ZkWrLCRZ-#v51RP0' //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    echo 'cod';
}
