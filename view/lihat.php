<?php
$id = $_GET['id_produk'];
$select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk = $id"));
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
                    <div class="numbertext">1 / 3</div>
                    <img src="<?= $select['gambar'] ?>">
                </div>

                <div class="mySlides">
                    <div class="numbertext">2 / 3</div>
                    <img src="https://img.freepik.com/free-photo/two-red-apples-isolated-white_114579-73124.jpg?w=996&t=st=1684136762~exp=1684137362~hmac=2122a0c51653bd8172d965cff68ea77c54e76e7bc30cbadbb7fbd750d9c650ee">
                </div>

                <div class="mySlides">
                    <div class="numbertext">3 / 3</div>
                    <img src="https://img.freepik.com/free-photo/apple-red-mellow-juicy-fresh-ripe-half-cut-isolated_179666-163.jpg?w=996&t=st=1684136779~exp=1684137379~hmac=09d87b48af45c8f5b51f6ebd45cccb0f121b10900587343979fa366131ac050c">
                </div>


                <a class="prev" onclick="plusSlides(-1)">❮</a>
                <a class="next" onclick="plusSlides(1)">❯</a>

                <div class="row row-navigator mb-2">
                    <div class="column">
                        <img class="demo cursor" src="https://img.freepik.com/free-photo/delicious-red-apples-isolated-white-table_114579-67401.jpg?w=740&t=st=1684136573~exp=1684137173~hmac=c08abb88f2dd0652d1f759129494a645377c769b151bc7aa9fdc2014001dcc56" onclick="currentSlide(1)" alt="The Woods">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://img.freepik.com/free-photo/two-red-apples-isolated-white_114579-73124.jpg?w=996&t=st=1684136762~exp=1684137362~hmac=2122a0c51653bd8172d965cff68ea77c54e76e7bc30cbadbb7fbd750d9c650ee" onclick="currentSlide(2)" alt="Cinque Terre">
                    </div>
                    <div class="column">
                        <img class="demo cursor" src="https://img.freepik.com/free-photo/apple-red-mellow-juicy-fresh-ripe-half-cut-isolated_179666-163.jpg?w=996&t=st=1684136779~exp=1684137379~hmac=09d87b48af45c8f5b51f6ebd45cccb0f121b10900587343979fa366131ac050c" onclick="currentSlide(3)" alt="Mountains and fjords">
                    </div>

                </div>

                <!-- slide galeri end -->


            </dizv>
            <div class="deskripsi col-12 col-lg-5 px-2">
                <div class="rounded bg-white">
                    <span class="nama-produk d-block mb-3"><?= ucfirst($select['nm_produk']) ?></span>
                    <span class="harga-produk d-block mb-3">Rp <span id="harga-produk-lihat" class="harga-produk"><?= $select['harga'] ?></span></span>

                    <h3 class="keterangan-produk d-block mb-3 text-ijo py-2">Keterangan Produk</h3>
                    <ul>
                        <li>Kategori : <b><?= ucfirst($select['kategori']) ?></b></li>
                        <li>Berat Satuan : <b>500 gram</b></li>
                        <li>Stok : <b id="stok-lihat"><?= $select['stok'] ?></b></li>
                    </ul>
                    <p>
                        <?= $select['deskripsi'] ?>
                    </p>

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
                            <input type="number" id="jml-item" class="form-control text-center" min="1" value="1" readonly></input>
                        </li>
                        <li class="page-item">
                            <button id="tambahV" class="page-link" onclick="tambahV()"><i class="fa-solid fa-plus"></i></button>
                        </li>
                    </ul>

                    <span>Total Harga</span>

                    <span class="mb-3" style="font-weight: 800;">
                        Rp <span id="total-harga-lihat-produk" style="font-weight: 800;"> </span>
                    </span>

                    <button class="btn btn-success d-block py-2" onclick="addCartLihat(<?=$id?>,'lihat')">
                        <img src="<?= base_url('assets/img/shopping-cart.svg') ?>" alt="..">
                        Tambah ke Keranjang
                    </button>
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
            <?php for ($i = 0; $i < 10; $i++) { ?>
                <div class="col-6 col-md-3 col-lg-2 p-1 me-1 item-scroll">
                    <div class="card shadow-sm">
                        <img src="https://img.freepik.com/free-photo/apples-red-fresh-mellow-juicy-perfect-whole-white-desk_179666-271.jpg?w=1060&t=st=1683580806~exp=1683581406~hmac=c6b9b26cf2f9142a8bc7111f3419be12c6c2d8d9676997039cdf970d3ed49196" alt="..." style="aspect-ratio: 2/1.5;">
                        <div class="card-body px-3 py-3">
                            <h5 class="card-title nama-produk m-0">Buah Apel</h5>
                            <span style="font-weight: 800;">Rp 10.000 /Kg</span>
                        </div>
                        <div class="cart-button text-center">
                            <a href="#" class="btn bg-ijo btn-cart"><i class="fa-solid fa-cart-plus"></i></a>
                            <a href="<?= $i ?>" class="btn bg-ijo btn-cart"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
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