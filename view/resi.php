<?php
require_once('../assets/basis/kon.php');
require('../function.php');

$id_order = $_GET['orderId'];
$order = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM transaksi WHERE order_id ='$id_order'"));
$belanjaan = json_decode($order['belanjaan']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .container-resi {
            width: 1100px;
            margin: auto;
            padding: 30px;
        }

        .tebal {
            font-weight: 500;
        }

        .text-ijo {
            color: rgb(80, 184, 46);
        }

        th {
            text-align: center;
        }

        td {
            vertical-align: baseline;
        }
    </style>
</head>

<body>

    <div id="resi" class="mt-3">
        <div class="container-resi">
            <div class="row">
                <div class="col-6">
                    <img src="<?= base_url('assets/img/brand/adastra.png') ?>" class="mb-3" alt="..." style="max-width: 70px;">
                    <div>
                        <h6 class="mb-1 tebal">DITERBITKAN ATAS NAMA</h6>
                        <p>Penjual : <span class="tebal">Butik Buah Adastra</span></p>
                    </div>
                </div>
                <div class="col-6">
                    <h5 class="text-end mb-1">RESI</h5>
                    <p class="text-end tebal text-ijo"><?= $id_order ?></p>
                    <h6 class="text-start tebal">UNTUK</h6>
                    <table>
                        <tr>
                            <td>Pembeli</td>
                            <td class="px-1">:</td>
                            <td class="tebal"><?= $order['nm_pembeli'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td class="px-1">:</td>
                            <td class="tebal"><?= $order['waktu_transaksi'] ?></td>
                        </tr>
                        <tr>
                            <td style="min-width: 150px;">Alamat Pengiriman</td>
                            <td class="px-1">:</td>
                            <td>
                                <p class="mb-0"><span class="tebal"><?= $order['nm_pembeli'] ?></span> (<?= $order['nomor_hp'] ?>)</p>
                                <?= $order['alamat'] ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <table class="table mt-4">
                <thead style="border-top: 2px solid black;border-bottom: 2px solid black;">
                    <th class="text-start" style="width: 50%;">NAMA PRODUK</th>
                    <th>JUMLAH</th>
                    <th>HARGA SATUAN</th>
                    <th>HARGA TOTAL</th>
                </thead>
                <tbody>
                    <?php
                    $totalBelanja = 0;
                    foreach ($belanjaan as $id_item => $ket_item) {
                        $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                    ?>
                        <tr>
                            <td><a href="<?= base_url('produk/lihat/' . $id_item) ?>" class="tebal text-ijo text-decoration-none" target="_blank"><?= $produk['nm_produk'] ?></a></td>
                            <td class="text-center"><?= $ket_item[0] ?></td>
                            <td class="text-center"><?= rupiah($ket_item[1]) ?></td>
                            <td class="text-center">
                                <?php
                                $totalHargaItem = $ket_item[1] * $ket_item[0];

                                // munculkan
                                echo rupiah($totalHargaItem);

                                $totalBelanja = $totalBelanja + $totalHargaItem;
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td colspan="2" class="tebal text-start pt-4">TOTAL TAGIHAN</td>
                        <td class="tebal text-center"><?= rupiah($totalBelanja) ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col-6"></div>
                <div class="col-6 ps-0 mt-3">
                    <span class="d-block">Metode Pembayaran</span>
                    <h6><?= ($order['metode_bayar'] == 'bank_transfer') ? 'Bank Transfer' : ucwords($order['metode_bayar']) ?></h6>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>