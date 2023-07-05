<?php
if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    header('locoation:transaksi/notif?order_id=' . $order_id);
}
?>
<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="transaksi" class="transaksi">
    <div class="container-transaksi bg-white">
        <button class="btn mt-2 mb-3" onclick="history.go(-1);">
            <i class="fa-solid fa-arrow-left"></i>
        </button>

        <h1 class="judul-section mb-0">Riwayat Transaksi</h1>

        <div class="accordion accordion-flush" id="accordionTransaksi">


        </div>
    </div>
</section>