<?php
require_once '../../assets/basis/kon.php';
require '../function/base_url.php';

function rupiah($angka)
{
    $hasil_rupiah = "Rp&nbsp" . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

$select = mysqli_query($db, "SELECT * FROM transaksi ORDER BY id_transaksi DESC");
?>
<div class=" breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Halaman Transaksi</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content pb-1">
    <div class="card">
        <div class="card-body">
            <div class="button mb-3 d-flex flex-wrap">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success btn-sm mr-1 my-1">
                    Ekspor (excel)
                </button>

                <button id="reload-transaksi" class="btn btn-success btn-sm ml-2 my-1"><i class="ti-reload"></i> Refrash</button>
                <!-- /button trigger -->

            </div>

            <div class="table">

                <table id="tabel-transaksi" class="table table-striped">
                    <thead>
                        <th style="max-width: 40px;">#</th>
                        <th>ID Order</th>
                        <th>Nama Pembeli</th>
                        <th>Belanjaan</th>
                        <th>Catatan</th>
                        <th>Alamat</th>
                        <th>Nomor</th>
                        <th>Total Harga pesanan</th>
                        <th>Waktu</th>
                        <th>Metode Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Status Pengiriman</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($select as $t) {

                            // status Pembayaran
                            switch ($t['status_bayar']) {
                                case 0:
                                    $status_bayar = "<span class='badge badge-secondary'>Belum Dibayar</span>";
                                    break;
                                case 1:
                                    $status_bayar = "<span class='badge badge-success'>Sudah Dibayar</span>";
                                    break;
                                case 2:
                                    $status_bayar = "<span class='badge badge-danger'>Dibatalkan</span>";
                                    break;
                            }

                            switch ($t['status_terkirim']) {
                                case 0:
                                    $status_terkirim = "<span class='badge badge-secondary'>Diproses</span>";
                                    break;
                                case 1:
                                    $status_terkirim = "<span class='badge badge-info'>Dikirim</span>";
                                    break;
                                case 2:
                                    $status_terkirim = "<span class='badge badge-success'>Diterima</span>";
                                    break;
                            }
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $t['order_id'] ?></td>
                                <td><?= $t['nm_pembeli'] ?></td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#detailModal<?= $t['id_transaksi'] ?>" class="btn btn-sm btn-light shadow-sm text-secondary">Lihat</button>
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#catatanModal<?= $t['id_transaksi'] ?>" class="btn btn-sm btn-light shadow-sm text-secondary">Lihat</button>
                                </td>
                                <td>
                                    <button type="button" data-toggle="modal" data-target="#alamatModal<?= $t['id_transaksi'] ?>" class="btn btn-sm btn-light shadow-sm text-secondary">Lihat</button>
                                </td>
                                <td><?= $t['nomor_hp'] ?></td>
                                <td><?= rupiah($t['biaya']) ?></td>
                                <td><?= $t['waktu_transaksi'] ?></td>
                                <td><?= $t['metode_bayar'] ?></td>
                                <td><?= $status_bayar ?></td>
                                <td><?= $status_terkirim ?></td>
                                <td>
                                    <?php
                                    if ($t['metode_bayar'] != 'cod') {
                                        if ($t['status_bayar'] == 0) { ?>
                                            <button type="button" class="btn btn-sm btn-success mx-2" data-toggle="modal" data-target="#konfirmasiPembayaran<?= $t['order_id'] ?>">
                                                Konfirmasi Bayar
                                            </button>
                                            <?php } else {
                                            if ($t['status_terkirim'] == 0 || empty($t['status_terkirim'])) {
                                                if ($t['status_bayar'] != 2) {
                                            ?>
                                                    <button type="button" class="btn btn-sm btn-success mx-2" data-toggle="modal" data-target="#kirimPesanan<?= $t['order_id'] ?>">
                                                        Kirim Pesanan
                                                    </button>
                                                <?php }
                                            }
                                        }
                                    } else {
                                        if ($t['status_bayar'] != 2) {
                                            if ($t['status_terkirim'] == 0 || empty($t['status_terkirim'])) { ?>
                                                <button type="button" class="btn btn-sm btn-success mx-2" data-toggle="modal" data-target="#kirimPesanan<?= $t['order_id'] ?>">
                                                    Kirim Pesanan
                                                </button>
                                            <?php } elseif ($t['status_terkirim'] == 1 && $t['status_bayar'] == 0) { ?>
                                                <button type="button" class="btn btn-sm btn-success mx-2" data-toggle="modal" data-target="#konfirmasiPembayaran<?= $t['order_id'] ?>">
                                                    Konfirmasi Bayar
                                                </button>
                                    <?php }
                                        }
                                    }

                                    ?>
                                </td>
                                <!-- modal kirim pesanan -->
                                <div class="modal fade" id="kirimPesanan<?= $t['order_id'] ?>" tabindex="-1" aria-labelledby="kirimPesanan<?= $t['order_id'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <p class="text-dark">
                                                    Yakin Untuk Kirim Pesanan Atas Nama <b><?= $t['nm_pembeli'] ?></b> ?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                                                <button type="button" class="btn btn-danger col-4" onclick="transaksi('<?= $t['order_id'] ?>','kirim')">Ya </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /modal kirim pesanan -->


                                <!-- modal konfirmasi pembayaran -->
                                <div class="modal fade" id="konfirmasiPembayaran<?= $t['order_id'] ?>" tabindex="-1" aria-labelledby="konfirmasiPembayaran<?= $t['order_id'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <p class="text-dark">
                                                    Yakin Untuk Konfirmasi Pembayaran Atas Nama <b><?= $t['nm_pembeli'] ?></b> ?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                                                <button type="button" class="btn btn-danger col-4" onclick="transaksi('<?= $t['order_id'] ?>','konfirmasi')">Ya </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /modal konfirmasi pembayaran -->

                            </tr>


                            <!-- Detail Belanjaan -->
                            <div class="modal fade" id="detailModal<?= $t['id_transaksi'] ?>" tabindex="-1" aria-labelledby="detailModal<?= $t['id_transaksi'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body row">
                                            <?php
                                            $belanjaan = $t['belanjaan'];
                                            $belanjaan = json_decode($belanjaan);
                                            foreach ($belanjaan as $id_item => $ket_item) {
                                                $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                                            ?>

                                                <div class="col-12 item-produk my-1 pb-1 border-bottom">
                                                    <div class="d-flex align-items-center">
                                                        <a href="<?= base_url('../produk/lihat/' . $id_item) ?>" class="text-decoration-none">
                                                            <img src="<?= (!empty($produk['gambar'])) ? base_url('../assets/img/produk/' . $produk['gambar']) : base_url('../assets/img/produk/default-produk.jpg') ?>" alt="..." style="width: 3rem; aspect-ratio: 1/1;" class="border rounded mb-1">
                                                        </a>
                                                        <h6 class="ml-2 mr-1 mb-0"><?= $produk['nm_produk'] ?></h6>
                                                        <i class="ti-close mx-1" style="font-size: 0.5em;"></i>
                                                        <span style="font-weight: 600;"><?= $ket_item[0] ?></span>
                                                        <span>&nbsp<?= $produk['satuan'] ?></span>
                                                    </div>
                                                    <div class="text-end mt-2">
                                                        <?php
                                                        $totalHargaItem = $ket_item[1] * $ket_item[0];
                                                        echo rupiah($totalHargaItem);
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Detail Belanjaan -->

                            <!-- catatan -->
                            <div class="modal fade" id="catatanModal<?= $t['id_transaksi'] ?>" tabindex="-1" aria-labelledby="catatanModal<?= $t['id_transaksi'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5> <i class="ti-tag me-2"></i> Catatan </h5>
                                        </div>
                                        <div class="modal-body">
                                            <?= $t['catatan'] ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /catatan -->

                            <!-- alamat -->
                            <div class="modal fade" id="alamatModal<?= $t['id_transaksi'] ?>" tabindex="-1" aria-labelledby="alamatModal<?= $t['id_transaksi'] ?>Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5> <i class="ti-pin me-2"></i> alamat </h5>
                                        </div>
                                        <div class="modal-body">
                                            <?= $t['alamat'] ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /alamat -->
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tabel-transaksi').DataTable({
            responsive: true,
            "pagingType": "simple"
        });

        var base_url = window.location.origin + '/admin/';
        $('#reload-transaksi').click(function() {
            $('#isi-content-halaman').load(base_url + 'view/transaksi.php');
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>