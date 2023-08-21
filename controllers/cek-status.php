<?php

namespace Midtrans;

require '../assets/basis/kon.php';
require '../function.php';
require_once '../vendor/payment/Midtrans.php';

$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));
$data = unserialize($select['isi_pengaturan']);

$server_key = ($data['mode_pembayaran'] == 'sandbox') ? $data['server_sandbox'] : $data['server_production'];

$nomor_target = $data['nomor_tujuan'];
$token_wa = $data['token_wa'];


Config::$serverKey = $server_key;

$orderId = $_GET['orderId'];

$status = \Midtrans\Transaction::status($orderId);

$transaction = $status->transaction_status;
$type = $status->payment_type;
$order_id = $orderId;

if ($transaction == 'settlement') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '1', metode_bayar = '$type' WHERE order_id = '$order_id'");

    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT belanjaan FROM transaksi WHERE order_id = '$order_id'"));
    $belanjaan = $select['belanjaan'];
    $belanjaan = json_decode($belanjaan);
    $jml_arr = count((array)$belanjaan);
    $text = '';
    $i = 1;
    foreach ($belanjaan as $id_produk => $jml_item) {

        $stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_produk'"));

        $nm_produk = $stok['nm_produk'];
        $satuan = $stok['satuan'];

        if ($i == $jml_arr) {
            $text .= "dan " . $nm_produk . " sebanyak " . $jml_item[0] . " " . $satuan . " ( " . rupiah($jml_item[1]) . " /" . $satuan . ") ";
        } elseif ($i == ($jml_arr - 1)) {
            $text .= $nm_produk . " sebanyak " . $jml_item[0] . " " . $satuan . " ( " . rupiah($jml_item[1]) . " /" . $satuan . ") ";
        } else {
            $text .= $nm_produk . " sebanyak " . $jml_item[0] . " " . $satuan . " ( " . rupiah($jml_item[1]) . " /" . $satuan . "), ";
        }

        $stok = $stok['stok'];
        $stok = $stok - $jml_item[0];

        mysqli_query($db, "UPDATE produk SET stok = '$stok' WHERE id_produk = '$id_produk'");
    }

    $select_transaksi = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE order_id = '$order_id'"));

    $nama_pembeli = $select_transaksi['nm_pembeli'];

    $kontak = $select_transaksi['nomor_hp'];
    $kontak_length = strlen($kontak);
    $kontak_length = (0 - $kontak_length) + 1;

    $awalan_kontak = substr($kontak, 0, $kontak_length);

    if ($awalan_kontak == '0') {
        $akhiran_kontak = substr($kontak, -1);
        $kontak = '62' . $akhiran_kontak;
    } else {
        $kontak;
    }

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
            'target' => $nomor_target . "|" . $nama_pembeli,
            'message' => '*Notifikasi Pemesanan*

Pesanan atas nama *{name}* dengan belanjaan :
' . $text . '

*kontak pemesan :* 
https://wa.me/' . $kontak . '
*cek website :*
https://technoyus.my.id/admin/adastra/transaksi
',
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token_wa //change TOKEN to your actual token
        ),
    ));


    $response = curl_exec($curl);

    curl_close($curl);
} else if ($transaction == 'pending') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '0', metode_bayar = '$type' WHERE order_id = '$order_id'");
} else if ($transaction == 'deny') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2', metode_bayar = '$type' WHERE order_id = '$order_id'");
} else if ($transaction == 'expire') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2', metode_bayar = '$type' WHERE order_id = '$order_id'");
} else if ($transaction == 'cancel') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2', metode_bayar = '$type' WHERE order_id = '$order_id'");
}
?>
<script type="text/javascript">
    window.location.href = '../../transaksi';
</script>