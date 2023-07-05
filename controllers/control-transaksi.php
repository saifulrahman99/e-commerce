<?php
require '../assets/basis/kon.php';
$orderId = $_GET['orderId'];
$opsi = $_GET['opsi'];

if ($opsi == 'batalkan') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '2' WHERE order_id = '$orderId'");

    $select_transaksi = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE order_id = '$orderId'"));

    $nama_pembeli = $select_transaksi['nm_pembeli'];
    $metode_bayar = $select_transaksi['metode_bayar'];

    $kontak = $select_transaksi['nomor_hp'];
    $kontak_length = strlen("$kontak");
    $kontak_length = (1 - $kontak_length);

    $awalan_kontak = substr($kontak, 0, $kontak_length);

    if ($awalan_kontak == '0') {
        $akhiran_kontak = substr($kontak, 1);
        $kontak = '62' . $akhiran_kontak;
    } else {
        $kontak;
    }

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
            'target' => "081998282879|" . $nama_pembeli,
            'message' => '*Notifikasi Pembatalan Pesanan*

Pesanan atas nama *{name}* Dibatalkan
ID Order *' . $orderId . '*
Metode Pembayaran *' . strtoupper($metode_bayar) . '*

*kontak pemesan :* 
https://wa.me/' . $kontak . '
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
}elseif ($opsi == 'konfirmasi') {
    mysqli_query($db, "UPDATE transaksi SET status_terkirim = '2' WHERE order_id = '$orderId'");
}
?>
<script>
    var base_url = window.location.origin;

    window.location.href = base_url + '/transaksi';
</script>