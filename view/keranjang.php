<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="keranjang" class="keranjang">
    <div class="container">
        <button class="btn mt-2" onclick="history.go(-1);">
            <i class="fa-solid fa-arrow-left"></i>
        </button>

        <?php if (isset($_SESSION['keranjang']) && !empty($_SESSION['keranjang'])) { ?>

            <form action="<?= base_url('controllers/cart.php') ?>" method="POST">
                <input type="text" name="opsi" value="update" hidden>
                <div class="row g-2 p-4 bg-white">

                    <h1 class="judul-section mb-0">Keranjang Belanja</h1>
                    <div class="col-12 col-md-8 col-lg-9 mb-3">
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
                        $jml_produk_keranjang = mysqli_num_rows($select);

                        // total awal untuk item
                        $total = 0;
                        $i = 0;
                        foreach ($select as  $produk) {
                            $total += $_SESSION['keranjang'][$produk['id_produk']][1] * $_SESSION['keranjang'][$produk['id_produk']][0];

                        ?>
                            <!-- item cart -->
                            <div class="list-item py-1 mb-3">

                                <div class="item row align-items-center">

                                    <div class="col-5 col-md-4 col-lg-2 p-4">
                                        <a href="produk/lihat/<?= $produk['id_produk'] ?>">
                                            <img id="gmbr-prdk-keranjang" src="<?= (!empty($produk['gambar'])) ? base_url('assets/img/produk/' . $produk['gambar']) : base_url('assets/img/produk/default-produk.jpg') ?>" class="item-img" alt="..." style="aspect-ratio: 1/1;">
                                        </a>
                                    </div>


                                    <div class="col-7 col-lg-6 row">
                                        <div class="col-12 col-lg-8 text-start text-md-center">
                                            <span class="nama_produk mb-2"><?= $produk['nm_produk'] ?></span>
                                        </div>
                                        <div class="col-12 col-lg-4 text-start text-md-center">
                                            <span class="harga" style="font-weight: 800 !important;"><?= rupiah($_SESSION['keranjang'][$produk['id_produk']][1]) ?></span>
                                        </div>

                                    </div>

                                    <div class="col-12 col-lg-3 row">
                                        <div class="col-6 col-md-5 col-lg-9 mt-3">
                                            <ul class="pagination jml-item">
                                                <li class="page-item">
                                                    <button type="button" class="page-link" onclick="kurang(<?= $i ?>)"><i class="fa-solid fa-minus"></i></button>
                                                </li>
                                                <li class="page-item">
                                                    <input type="text" id="jml-item<?= $i ?>" name="qty[<?= $produk['id_produk'] ?>]" class="form-control text-center" min="1" max="<?= $produk['stok'] ?>" value="<?= $_SESSION['keranjang'][$produk['id_produk']][0] ?>" onkeypress="return hanyaAngka(event)" required></input>
                                                    <input type="text" id="stok<?= $i ?>" value="<?= $produk['stok'] ?>" hidden>
                                                </li>
                                                <li class=" page-item">
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

                                    <label style="font-size: 0.8em;">Sisa Stok : <span id="sisa-stok<?= $produk['id_produk'] ?>"></span></label>

                                </div>
                            </div>

                            <!-- script untuk cek stok secara berkala dalam 1 detik -->
                            <script type="text/javascript">
                                setInterval(() => {
                                    disableCheckout(<?= $produk['id_produk'] ?>, <?= $i ?>, <?= $jml_produk_keranjang ?>);
                                }, 1000);
                            </script>

                            <!-- item cart -->
                        <?php $i++;
                        } ?>

                        <!-- tombol update keranjang -->
                        <div class="tombol-update-keranjang d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-secondary my-4">Update Keranjang</button>
                        </div>
                    </div>

                    <div class="col-12 col-md-4 col-lg-3 px-0 px-md-2">

                        <div class="tagihan rounded d-flex flex-column p-3" style="font-weight: 600;">

                            <span>Total</span>
                            <span class="fs-5" style="font-weight: 700;"> <?= rupiah($total) ?></span>

                            <!-- Button trigger modal -->
                            <button type="button" id="button-checkout" class="btn btn-ijo text-white mt-3" data-bs-toggle="modal" data-bs-target="#modalCheckout">
                                Checkout
                            </button>

                            <span class="text-danger text-center mt-3" style="font-size: 0.7em;">usahakan update keranjang sebelum checkout</span>

                        </div>
                    </div>
                </div>
            </form>

        <?php } else { ?>
            <div class="keranjang-kosong d-flex flex-column justify-content-center align-items-center" style="overflow-x: hidden;">
                <img src="<?= base_url('assets/img/empty-cart.gif') ?>" alt="gagal memuat gambar">
                <h4 class="tebal-600 m-0 bg-white">Keranjang Belanja Kosong</h4>

            </div>
        <?php } ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCheckout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCheckoutLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bolder" id="modalCheckoutLabel">Infromasi Data Pembeli</h1>
                </div>

                <div class="modal-body">
                    <form id="form-pembayaran" method="post">
                        <?php $arrayItem = json_encode($_SESSION['keranjang']); ?>
                        <textarea name="item_keranjang" hidden><?= $arrayItem ?></textarea>
                        <input type="text" name="biaya" value="<?= $total ?>" hidden>
                        <input type="text" name="opsi" value="add" hidden>

                        <div class="form-floating mb-3">
                            <input type="text" name="nama" class="form-control" id="floatingNama" placeholder="Nama Anda" value="<?= (isset($_COOKIE['nama'])) ? $_COOKIE['nama'] : "" ?>" required>
                            <label for="floatingNama">Nama</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="alamat" class="form-control" placeholder="Alamat Anda" id="floatingAlamat" style="height: 100px" required><?= (isset($_COOKIE['alamat'])) ? $_COOKIE['alamat'] : "" ?></textarea>
                            <label for="floatingAlamat">Alamat Lengkap</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="tel" name="telepon" class="form-control" id="floatingTelp" placeholder="No Telpon yang dapat dihubungi" value="<?= (isset($_COOKIE['telepon'])) ? $_COOKIE['telepon'] : "" ?>" onkeypress=" return hanyaAngka(event)" required>
                            <label for="floatingTelp">Nomor Telepon/ Nomor Whatsapp</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="catatan" class="form-control" placeholder="catatan Anda" id="floatingcatatan" style="height: 100px"></textarea>
                            <label for="floatingcatatan">Catatan</label>
                        </div>

                        <div class="metode-pembayaran mb-4">
                            <label class="fw-bolder d-block mb-3">Metode Pembayaran</label>

                            <input type="radio" class="btn-check" name="metode_bayar" value="online" id="online" autocomplete="off" checked>
                            <label class="btn" style="box-shadow: 0px 0px 1px 0px gray;" for="online">
                                <img src="../assets/img/pembayaran/midtrans.png" alt="">
                            </label>

                            <input type="radio" class="btn-check" name="metode_bayar" value="cod" id="cod" autocomplete="off">
                            <label class="btn ms-2" style="box-shadow: 0px 0px 1px 0px gray;" for="cod">
                                <img src="../assets/img/pembayaran/cod.png" alt="..">
                            </label>

                        </div>

                        <textarea class="form-control" id="info-error"></textarea>
                </div>

                <div class="modal-footer d-flex flex-column">
                    <button type="button" id="btn-bayar-belanjaan" class="btn btn-ijo text-white col-12">Buat Pesanan</button>
                    <button type="button" class="btn btn-secondary col-12" data-bs-dismiss="modal">Batal</button>
                </div>

                </form>

            </div>
        </div>
    </div>
    <?php
    if (!empty($_SESSION['keranjang'])) {

        $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));

        $data = unserialize($select['isi_pengaturan']);

    ?>
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app<?= ($data['mode_pembayaran'] == 'sandbox') ? '.sandbox' : '' ?>.midtrans.com/snap/snap.js" data-client-key="<?= ($data['mode_pembayaran'] == 'sandbox') ? $data['client_sandbox'] : $data['client_production'] ?>"></script>
        <script type="text/javascript">
            document.getElementById('btn-bayar-belanjaan').onclick = function() {

                var nama = document.getElementById("floatingNama").value;
                var alamat = document.getElementById("floatingAlamat").value;
                var telepon = document.getElementById("floatingTelp").value;


                if (nama == '') {
                    alert("Nama Tidak Boleh Kosong");
                    document.getElementById("floatingNama").focus();
                    return false;
                }
                if (alamat == '') {
                    alert("Alamat Tidak Boleh Kosong");
                    document.getElementById("floatingAlamat").focus();
                    return false;
                }
                if (telepon == '') {
                    alert("Telepon Tidak Boleh Kosong");
                    document.getElementById("floatingTelp").focus();
                    return false;
                }


                $.ajax({
                    type: 'POST',
                    url: "controllers/transaksi.php",
                    data: $('#form-pembayaran').serialize(),
                    success: function(data) {
                        document.getElementById("info-error").innerHTML = data;

                        if (data != 'cod') {
                            $('#modalCheckout').modal('hide');
                            snap.pay(data);
                        } else {
                            window.location.href = 'transaksi';
                        }
                    }
                });

            };
        </script>
    <?php } ?>
</section>

<div class="spasi-header" style="padding-top: 5rem;">

</div>