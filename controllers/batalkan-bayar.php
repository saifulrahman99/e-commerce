<?php
$order_id = $_GET['orderId'];
require_once('../vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.sandbox.midtrans.com/v2/'.$order_id.'/cancel', [
    'headers' => [
        'accept' => 'application/json',
    ],
]);

echo $response->getBody();
