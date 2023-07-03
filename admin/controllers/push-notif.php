<?php
require('../assets/basis/kon.php');

$id_promo = $_POST['id_promo'];
$promo = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM promo WHERE id_promo = '$id_promo'"));

$nm_promo = $promo['nm_promo'];
$keterangan = $promo['keterangan'];
$gambar = $promo['gambar'];
$id_produk = $promo['id_produk'];

if ($id_produk != 0) {
    $action = 'https://technoyus.my.id/produk/lihat/' . $id_produk;
} else {
    $action = 'https://technoyus.my.id/produk';
}



$token = mysqli_query($db, "SELECT DISTINCT token FROM pengunjung WHERE token != ''");

foreach ($token as $t) {
    $token_push[] = $t['token'];
}

// Set the URL of the FCM API endpoint
$url = 'https://fcm.googleapis.com/fcm/send';

// Set the server key for authentication
$server_key = 'AAAAyEHLmKE:APA91bHyBrCa3oNpWrVDjqjbCKy97Wz9VSbtP1_BuEApEVbO1uCChsD7K-iYvHumBjDPyxkhuIwr0zimkQGBc_InX3spp5D0ePty20X5LhB1RlNjmSc89xgoIBHWbm7x0zAOT4jbv5Mg';

// Set the message payload
$message = array(
    'data' => array(
        'title' => $nm_promo,
        'body' => $keterangan,
        'icon' => 'https://technoyus.my.id/assets/img/brand/adastra.png',
        'image' => "https://technoyus.my.id/assets/img/promo/" . $gambar,
        'click_action' => $action
    ),
    'registration_ids' => $token_push,
    // 'registration_ids' => [
    //     'fJmJrIf2StJGKsHbyybpoL:APA91bEQj9W3v8feow2eSC7uYPkybViDntm_3qM86n5f1mp1W5WP1GY6TcXu-FKBlTG_o-aZTTgkLEGhs4XpdUoprTp2BPTZd1aacT1-a8nAbLaQzQqnsAkogufewecFuGJIIM9AsXAp'
    // ],
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

// Check for errors
if ($response === false) {
    echo 'Error sending message: ' . curl_error($curl);
} else {
    echo 'Message sent successfully';
}

// Close the cURL resource
curl_close($curl);
