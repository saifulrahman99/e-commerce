<?php

namespace Midtrans;

require_once '../vendor/payment/Midtrans.php';

//Set Your server key
Config::$serverKey = "SB-Mid-server-z-__Mmo5avW30d27vWSREhKd";
// Config::$serverKey = "Mid-server-khIKLaZqaGlwbUArR1wWG68m";

// Uncomment for production environment
// Config::$isProduction = true;

// Enable sanitization
Config::$isSanitized = true;

// Enable 3D-Secure
Config::$is3ds = true;

$snapToken = $_GET['snapToken'];
?>

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-j1UwFlBeVMen-Fxd"></script>

<!-- <script src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-8mpTS156jrQlXUpz"></script> -->
<script type="text/javascript">
    snap.pay('<?php echo $snapToken ?>')
</script>