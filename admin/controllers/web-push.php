<?php
require('../assets/basis/kon.php');

$judul = $_POST['judul'];
$ket = $_POST['ket'];
$action = !empty($_POST['action']) ? $_POST['action'] : 'https://technoyus.my.id';

$gambar = $_FILES['gambar'];

$path = '../assets/img/notif/';

if (empty($gambar['name'])) {
    $gambar = 'https://technoyus.my.id/assets/img/brand/adastra.png';
} else {

    $filepath = $path . $gambar['name'];

    if (!file_exists($filepath)) {
        $upload_gambar = move_uploaded_file($gambar['tmp_name'], $filepath);
    } else {
        unlink($filepath);
        $upload_gambar = move_uploaded_file($gambar['tmp_name'], $filepath);
    }
    $gambar = 'https://technoyus.my.id/admin/assets/img/notif/' . $gambar['name'];
}

echo "$judul, $ket, $action, $gambar";


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
        'title' => $judul,
        'body' => $ket,
        'icon' => 'https://technoyus.my.id/assets/img/brand/adastra.jpg',
        'image' => $gambar,
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

// Close the cURL resource
curl_close($curl);
