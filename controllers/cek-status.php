<?php

namespace Midtrans;

require '../function.php';
require_once '../vendor/payment/Midtrans.php';
Config::$serverKey = 'SB-Mid-server-z-__Mmo5avW30d27vWSREhKd';

$orderId = 'order-1006202378-PN3XG';

$status = \Midtrans\Transaction::status($orderId);

// var_dump($status);
// JSON.stringify($status, null, 2)

?>
<pre>
    <? print_r($status) ?>
</pre>