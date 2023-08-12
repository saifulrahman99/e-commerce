<?php
namespace Midtrans;

require '../assets/basis/kon.php';
require '../function.php';
require_once '../vendor/payment/Midtrans.php';

$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));
$data = unserialize($select['isi_pengaturan']);

$server_key = $data['server_key'];

Config::$serverKey = $server_key;

$orderId = $_GET['orderId'];

$cancel = \Midtrans\Transaction::cancel($orderId);
?>

<script type="text/javascript">
    window.location.href = "<?= base_url('transaksi') ?>";
</script>