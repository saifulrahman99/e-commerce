<?php
$id = $_GET['id_produk'];
$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk = $id"));

$gambar_produk = $select['gambar'];
?>
<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="lihat-produk" class="lihat-produk pb-5">
    <div class="container">
        <button class="btn btn-light rounded-circle border border-secondary shadow-sm mb-3" onclick="history.go(-1);">
            <i class="fa-solid fa-arrow-left"></i>
        </button>

        <div class="row justify-content-evenly">
            <dizv class="galeri col-11 col-md-6 col-lg-3 p-0">

                <!-- slide galeri -->
                <div class="mySlides">
                    <img src="<?= (!empty($gambar_produk)) ? base_url('/assets/img/produk/' . $gambar_produk) : base_url('/assets/img/produk/default-produk.jpg') ?>">
                </div>
                <?php
                $galeri = explode(',', $select['galeri']);

                if ($select['galeri'] != '') {

                    foreach ($galeri as $g) {
                ?>
                        <div class="mySlides">
                            <img src="<?= base_url('assets/img/produk/galeri/' . $g) ?>">
                        </div>
                <?php }
                } ?>

                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>

                <div class="row row-navigator mb-2">
                    <div class="column">
                        <img class="demo cursor" src="<?= (!empty($gambar_produk)) ? base_url('/assets/img/produk/' . $gambar_produk) : base_url('/assets/img/produk/default-produk.jpg') ?>" onclick="currentSlide(1)" alt="The Woods">
                    </div>
                    <?php
                    $urutanSlide = 2;
                    if ($select['galeri'] != '') {
                        foreach ($galeri as $g) {
                    ?>
                            <div class="column">
                                <img class="demo cursor" src="<?= base_url('assets/img/produk/galeri/' . $g) ?>" onclick="currentSlide(<?= $urutanSlide++ ?>)" alt="Cinque Terre">
                            </div>
                    <?php }
                    } ?>


                </div>

                <!-- slide galeri end -->


            </dizv>
            <div class="deskripsi col-12 col-lg-5 px-2">
                <div class="rounded bg-white">
                    <span class="nama-produk d-block mb-3"><?= ucwords(strtolower($select['nm_produk'])) ?></span>
                    <span class="harga-produk d-block mb-3"><?= rupiah($select['harga_jual']) ?> /<?= strtolower($select['satuan']) ?>
                        <span id="harga-produk-lihat" class="harga-produk" style="display: none;"><?= $select['harga_jual'] ?></span>
                    </span>

                    <h3 class="keterangan-produk d-block mb-3 text-ijo py-2">Keterangan Produk</h3>
                    <ul>
                        <li>Kategori : <b><?= ucfirst($select['kategori']) ?></b></li>
                        <li>Satuan : <b><?= strtolower($select['satuan']) ?></b></li>
                        <li>Stok : <b id="stok-lihat"><?= $select['stok'] ?></b></li>
                    </ul>
                    <div class="deskripsi">
                        <?= (!empty($select['deskripsi'])) ? $select['deskripsi'] : "<p class='text-justify'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit quos incidunt earum eligendi quisquam, tempore minus fugit magnam eos, quo dolorum. Autem at consectetur porro beatae aliquam similique ut quo!</p>" ?>
                    </div>

                </div>
            </div>
            <div class="keranjang-lihat-produk col-12 col-lg-3 px-1">
                <div class="konten rounded bg-white p-3 d-flex flex-column">
                    <h3 class="d-block mb-3 judul-konten">Atur Jumlah Pembelian</h3>
                    <ul class="pagination jml-item">
                        <li class="page-item">
                            <button class="page-link" onclick="kurangV()"><i class="fa-solid fa-minus"></i></button>
                        </li>
                        <li class="page-item" style="max-width:20%;">
                            <input type="text" id="jml-item" class="form-control text-center" min="0" value="1" onkeypress="return hanyaAngka(event)" required></input>
                        </li>
                        <li class="page-item">
                            <button id="tambahV" class="page-link" onclick="tambahV()"><i class="fa-solid fa-plus"></i></button>
                        </li>
                    </ul>

                    <span>Total Harga</span>

                    <span class="mb-3" id="total-harga-lihat-produk" style="font-weight: 800;"> </span>

                    <button id="tambah-keranjang" class="btn btn-success d-block py-2">
                        <img src="<?= base_url('assets/img/shopping-cart.svg') ?>" alt="..">
                        Tambah ke Keranjang
                    </button>
                    <input id="id-item" type="text" value="<?= $id ?>" hidden>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="sejenis" class="sejenis">
    <div class="container container-section">
        <h2 class="judul-section">Produk <span class="text-light judul-section bg-ijo px-2">Sejenis</span></h2>
        <div class="produk-sejenis pt-3 pb-4 d-inline d-flex scroll-efek-x">

            <!-- produk -->
            <?php
            $dataNama = $select['nm_produk'];
            $array_nm_produk = explode(' ', $dataNama);
            $key_sejenis = '';
            foreach ($array_nm_produk as $key => $value) {
                $key_sejenis .= "nm_produk LIKE '%$value%' OR ";
            }
            $key_sejenis = substr($key_sejenis, 0, -4);

            $kategori = $select['kategori'];

            $query = mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE $key_sejenis ORDER BY nm_produk ASC");

            foreach ($query as $sejenis) {
                if ($sejenis['kode_produk'] != $select['kode_produk']) {
            ?>
                    <div class="col-6 col-md-3 col-lg-2 p-1 me-1 item-scroll">
                        <div class="card shadow-sm">
                            <img src="<?= (!empty($sejenis['gambar'])) ? base_url('/assets/img/produk/' . $sejenis['gambar']) : base_url('/assets/img/produk/default-produk.jpg') ?>" alt="..." style="aspect-ratio: 1/1;">
                            <div class="card-body px-3 py-3">
                                <h5 class="card-title nama-produk m-0"><?= ucwords(strtolower($sejenis['nm_produk'])) ?></h5>
                                <span style="font-weight: 800;"><?= rupiah($sejenis['harga_jual']) ?> /Kg</span>
                            </div>
                            <div class="cart-button text-center">
                                <a href="#" class="btn bg-ijo btn-cart py-2 rounded-circle"><i class="fa-solid fa-cart-plus"></i></a>
                                <a href="<?= $sejenis['id_produk'] ?>" class="btn bg-ijo btn-cart py-2 rounded-circle"><i class="fa-regular fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } ?>
            <!-- end produk -->

            <div class="col-4 col-md-2 col-lg-1 p-1 item-scroll">
                <div class="card shadow-sm position-relative" style="min-height:30vh;">
                    <a href="<?= base_url('produk') ?>" class="position-absolute top-50 start-50 translate-middle p-2 text-decoration-none text-center">
                        <i data-feather="arrow-right" class="mb-2"></i>
                        <span class="d-block fw-bolder">More</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- navigasi -->
        <div class="tombol-navigasi text-center">
            <button class="btn-slide d-inline me-3" onclick="geserKiri()"> <i class="fa-solid fa-chevron-left"></i> </button>
            <button class="btn-slide d-inline" onclick="geserKanan()"> <i class="fa-solid fa-chevron-right"></i> </button>
        </div>
    </div>
</section>



<script type="text/javascript">
    // ======== galeri lihat produk ==============
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
    // ======== galeri lihat produk ==============
</script>