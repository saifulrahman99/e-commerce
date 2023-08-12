<?php

namespace Midtrans;

require '../assets/basis/kon.php';
require_once '../vendor/payment/Midtrans.php';

$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));
$data = unserialize($select['isi_pengaturan']);

$server_key = ($data['mode_pembayaran'] == 'sandbox') ? $data['server_sandbox'] : $data['server_production'];

//Set Your server key
Config::$serverKey = $server_key;

// Uncomment for production environment
if ($data['mode_pembayaran'] == 'production') {
    Config::$isProduction = true;
}

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

$snapToken = $_GET['snapToken'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar</title>
</head>
<style>
    .container {
        max-width: 800px;
    }
</style>

<body>
    <div class="container"></div>
</body>

</html>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app<?= ($data['mode_pembayaran'] == 'sandbox') ? '.sandbox' : '' ?>.midtrans.com/snap/snap.js" data-client-key="<?= ($data['mode_pembayaran'] == 'sandbox') ? $data['client_sandbox'] : $data['client_production'] ?>"></script>

<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-8mpTS156jrQlXUpz"></script> -->
<script type="text/javascript">
    snap.pay('<?php echo $snapToken ?>')
</script>