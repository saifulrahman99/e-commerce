<?php
if (!empty($_POST)) {
    foreach ($_POST['qty'] as $id => $jumlah) {
        $_SESSION['keranjang'][$id] = max($jumlah, 1);
    }
?>
    <script type="text/javascript">
        window.location.href = 'keranjang';
    </script>
<?php } ?>

<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="keranjang" class="keranjang">
    <div class="container">
        <?php if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) { ?>

            <form action="" method="POST">
                <div class="row g-2 p-4 bg-white">

                    <h1 class="judul-section">Keranjang Belanja</h1>
                    <div class="col-12 col-md-9 mb-3">
                        <?php
                        $keranjang = $_SESSION['keranjang'];

                        $idItem = "";

                        foreach ($keranjang as $key => $value) {
                            $idItem .= "$key,";
                        }

                        $sql = 'SELECT * FROM produk WHERE id_produk IN(';
                        $sql .= trim($idItem, ',');
                        $sql .= ')';
                        $select = mysqli_query($db, $sql);


                        // total awal untuk item
                        $total = 0;
                        $i = 0;
                        foreach ($select as  $produk) {
                            $total += $produk['harga'] * $_SESSION['keranjang'][$produk['id_produk']];
                        ?>
                            <!-- item cart -->
                            <div class="list-item py-3">

                                <div class="item row align-items-center">

                                    <div class="col-5 col-md-2">
                                        <a href="produk/lihat/<?= $produk['id_produk'] ?>">
                                            <img src="<?= $produk['gambar'] ?>" class="item-img" alt="..." style="aspect-ratio: 2/1.5;">
                                        </a>
                                    </div>


                                    <div class="col-7 col-md-6 row">
                                        <div class="col-12 col-md-8 text-start text-md-center">
                                            <span class="nama_produk mb-2"><?= $produk['nm_produk'] ?></span>
                                        </div>
                                        <div class="col-12 col-md-4 text-start text-md-center">
                                            <span class="harga" style="font-weight: 800 !important;">Rp <?= $produk['harga'] ?></span>
                                        </div>

                                    </div>

                                    <div class="col-12 col-md-3 row">
                                        <div class="col-6 col-md-9 mt-3">
                                            <ul class="pagination jml-item">
                                                <li class="page-item">
                                                    <button type="button" class="page-link" onclick="kurang(<?= $i ?>)"><i class="fa-solid fa-minus"></i></button>
                                                </li>
                                                <li class="page-item">
                                                    <input type="number" id="jml-item<?= $i ?>" name="qty[<?= $produk['id_produk'] ?>]" class="form-control" min="1" value="<?= $_SESSION['keranjang'][$produk['id_produk']] ?>" readonly></input>
                                                </li>
                                                <li class="page-item">
                                                    <button type="button" class="page-link" onclick="tambah(<?= $i ?>)"><i class="fa-solid fa-plus"></i></button>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="col-3 text-end mt-3">
                                            <a class="bg-danger rounded btn text-decoration-none" onclick="hapusItemCart(<?= $produk['id_produk'] ?>,'hapus')">
                                                <img src="assets/img/trash.svg" alt="">
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- item cart -->
                        <?php $i++;
                        } ?>

                        <!-- tombol update keranjang -->
                        <div class="tombol-update-keranjang d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-secondary my-4">Update Keranjang</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-3 px-0 px-md-2">

                        <div class="tagihan rounded d-flex flex-column p-3" style="font-weight: 600;">
                            <!-- <div class="pengiriman mb-4 d-flex justify-content-around">

                                <input type="radio" class="btn-check" name="options-outlined" id="ambil-di-toko" autocomplete="off" checked>
                                <label class="btn btn-outline-primary" for="ambil-di-toko">Ambli di Toko</label>

                                <input type="radio" class="btn-check" name="options-outlined" id="ojek-online" autocomplete="off">
                                <label class="btn btn-outline-primary" for="ojek-online">Ojek Online</label>
                            </div> -->

                            <span>Total</span>
                            <span class="fs-5" style="font-weight: 700;"> Rp <?= $total ?></span>

                            <button class="btn bg-ijo text-white mt-3">Checkout</button>
                        </div>

                    </div>
                </div>
            </form>

        <?php } else { ?>
            <div class="keranjang-kosong d-flex flex-column justify-content-center align-items-center">
                <img src="<?= base_url('assets/img/empty-cart.gif') ?>" alt="gagal memuat gambar">
                <h3 class="fw-bolder m-0 bg-white">Keranjang Belanja Kosong</h3>

            </div>
        <?php } ?>
    </div>
</section>

<div class="spasi-header" style="padding-top: 5rem;"></div>