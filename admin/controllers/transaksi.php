<?php
require_once '../../assets/basis/kon.php';
$opsi = (isset($_POST['opsi'])) ? $_POST['opsi'] : $_GET['opsi'];
$id_order = $_POST['id_order'];


if ($opsi == 'konfirmasi') {
    mysqli_query($db, "UPDATE transaksi SET status_bayar = '1' WHERE order_id = '$id_order'");
    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE order_id = '$id_order'"));

    $belanjaan = $select['belanjaan'];
    $belanjaan = json_decode($belanjaan);

    foreach ($belanjaan as $id_produk => $isi_item) {

        $stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT stok FROM produk WHERE id_produk = '$id_produk'"));

        $stok = $stok['stok'];
        $stok = $stok - $isi_item[0];

        mysqli_query($db, "UPDATE produk SET stok = '$stok' WHERE id_produk = '$id_produk'");
    }
} elseif ($opsi == 'kirim') {
    mysqli_query($db, "UPDATE transaksi SET status_terkirim = '1' WHERE order_id = '$id_order'");

    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi JOIN pengunjung ON transaksi.id_pengunjung = pengunjung.id_pengunjung WHERE order_id = '$id_order'"));

    // add notif engiriman, web push
    $token_push = $select['token'];

    $belanjaan = $select['belanjaan'];
    $belanjaan = json_decode($belanjaan);
    $jml_arr = count((array)$belanjaan);

    // pesanan
    $pesanan = '';
    $i = 1;
    foreach ($belanjaan as $id_item => $jml_item) {
        $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
        $nmProduk = $produk['nm_produk'];
        if ($jml_arr == 1) {
            $pesanan .= "$nmProduk";
        } elseif ($i == $jml_arr) {
            $pesanan .= "dan $nmProduk.";
        } elseif ($i == ($jml_arr - 1)) {
            $pesanan .= "$nmProduk ";
        } else {
            $pesanan .= "$nmProduk, ";
        }
        $i++;
    }

    // Set the URL of the FCM API endpoint
    $url = 'https://fcm.googleapis.com/fcm/send';

    // Set the server key for authentication
    $server_key = 'AAAAyEHLmKE:APA91bHyBrCa3oNpWrVDjqjbCKy97Wz9VSbtP1_BuEApEVbO1uCChsD7K-iYvHumBjDPyxkhuIwr0zimkQGBc_InX3spp5D0ePty20X5LhB1RlNjmSc89xgoIBHWbm7x0zAOT4jbv5Mg';

    // Set the message payload
    $message = array(
        'data' => array(
            'title' => 'Pesananmu Sudah Dikirim',
            'body' => $pesanan,
            'icon' => 'https://technoyus.my.id/assets/img/brand/adastra.png',
            'image' => '',
            'click_action' => 'https://technoyus.my.id/transaksi'
        ),
        'registration_ids' => [$token_push],
    );

    // Set additional cURL options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: key=' . $server_key,
            'Content-Type: application/json',
        ),
        CURLOPT_POSTFIELDS => json_encode($message),
    );

    // Create a new cURL resource and set the options
    $curl = curl_init();
    curl_setopt_array($curl, $options);

    // Send the HTTP request and get the response
    $response = curl_exec($curl);

    // Close the cURL resource
    curl_close($curl);
}

echo $opsi;
