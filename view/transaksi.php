<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="transaksi" class="transaksi">
    <div class="container-transaksi bg-white">
        <h1 class="judul-section mt-4 mb-3">Riwayat Transaksi</h1>

        <div class="accordion accordion-flush" id="accordionTrensaksi">

            <?php
            $id_pengunjung = $_SESSION['id_pengunjung'];

            $select_transaksi = mysqli_query($db, "SELECT * FROM transaksi WHERE id_pengunjung='$id_pengunjung' ORDER BY id_transaksi DESC");
            foreach ($select_transaksi as $sk) {
                $belanjaan = $sk['belanjaan'];
                $belanjaan = json_decode($belanjaan);

                if ($sk['status_bayar'] == 0) {
                    $statusBayar = "pending";
                    $btnStatus = "accordion-button-pending";
                    $ketBayar = "Belum Dibayar";
                } elseif ($sk['status_bayar'] == 1) {
                    $statusBayar = "sukses";
                    $btnStatus = "accordion-button-sukses";
                    $ketBayar = "Sudah Dibayar";
                } elseif ($sk['status_bayar'] == 2) {
                    $statusBayar = "gagal";
                    $btnStatus = "accordion-button-gagal";
                    $ketBayar = "Dibatalkan";
                }
            ?>

                <div class="accordion-item mb-2" style="border: none !important;">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed border row m-0 position-relative <?= $btnStatus ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $sk['id_transaksi'] ?>" aria-expanded="false" aria-controls="flush-collapse<?= $sk['id_transaksi'] ?>" style="z-index:0;">
                            <?php
                            $nm_transaksi = '';
                            foreach ($belanjaan as $id_item => $jml_item) {
                                $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                                $nmProduk = $produk['nm_produk'];
                                $nm_transaksi .= "$nmProduk, ";
                            }
                            ?>

                            <span class="col-12 p-0 mb-2 fw-bolder">
                                <?= substr($nm_transaksi, 0, -2) ?>
                            </span>
                            <span class="col-12 p-0">
                                <i data-feather="clock" style="width: 0.8rem;"> </i>
                                <span style="font-size: 0.7rem;"> <?= $sk['waktu_bayar'] ?> </span>
                            </span>
                            <?php

                            ?>
                            <span class="status-pembayaran position-absolute <?= $statusBayar ?>"><?= $ketBayar ?></span>

                        </button>
                    </h2>
                    <div id="flush-collapse<?= $sk['id_transaksi'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionTrensaksi">
                        <div class="accordion-body border">

                            <div>
                                ID Order : <span class="text-ijo tebal-600"><?= $sk['order_id'] ?></span>
                            </div>

                            <div class="my-1">
                                Metode Pembayaran (<?= $sk['metode_bayar'] ?>)
                            </div>

                            <div class="tebal-700 border-top pt-2 pb-1">Daftar Belanjaan</div>

                            <div class="row pb-2">
                                <?php
                                foreach ($belanjaan as $id_item => $jml_item) {
                                    $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                                ?>

                                    <div class="col-12 col-md-4 item-produk my-1 pb-1 border-bottom">
                                        <div class="d-flex align-items-center">
                                            <a href="<?=base_url('produk/lihat/'.$id_item)?>" class="text-decoration-none">
                                                <img src="<?= $produk['gambar'] ?>" alt="..." style="width: 3rem; aspect-ratio: 1/1;" class="border rounded mb-1">
                                            </a>
                                            <h6 class="ms-2 me-1 mb-0"><?= $produk['nm_produk'] ?></h6>
                                            <i data-feather="x" class="me-1" style="width: 0.8rem;"></i>
                                            <span><?= $jml_item ?></span>
                                        </div>
                                        <div class="tebal-500 text-end">
                                            <?php
                                            $totalHargaItem = $produk['harga'] * $jml_item;
                                            echo rupiah($totalHargaItem);
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="row mt-2 pb-2">
                                <div class="col-6 tebal-700">
                                    Total Pesanan
                                </div>
                                <div class="col-6 tebal-700 text-end">
                                    <?= rupiah($sk['biaya']) ?>
                                </div>
                            </div>

                            <?php
                            if ($ketBayar == "Belum Dibayar") { ?>
                                <div class="tombol-aksi-transaksi py-2 text-end border-top">

                                    <a href="transaksi/bayarlagi/<?= $sk['snap_token'] ?>" type="button" class="btn btn-ijo text-white me-2">Bayar</a>
                                    <a href="transaksi/batalkanbayar/<?= $sk['order_id'] ?>" type="button" class="btn btn-danger">Batalkan Transaksi</a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</section>

<div class="spasi-bawah"></div>