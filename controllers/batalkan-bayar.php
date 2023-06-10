<?php
namespace Midtrans;

require '../function.php';
require_once '../vendor/payment/Midtrans.php';
Config::$serverKey = 'SB-Mid-server-z-__Mmo5avW30d27vWSREhKd';

$orderId = $_GET['orderId'];

$cancel = \Midtrans\Transaction::cancel($orderId);
?>

<script type="text/javascript">
    window.location.href = "<?= base_url('transaksi') ?>";
</script>