<section id="home" class="home">
    <div class="container home">
        <div class="row row-tagline">
            <div class="tagline col-12 col-sm-6 d-flex flex-column justify-content-center cssanimation fadeInLeft">
                <h1 class="mb-3 mb-md-4">Belanja <span style="margin-left: -2.9px;">Buah dan Sayur</span></h1>
                <p class="mb-3 mb-md-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab cupiditate vitae adipisci commodi non temporibus cumque ea ut, minima culpa.</p>
                <div class="cta">
                    <a href="produk" class="btn btn-lg shadow"> <img src="assets/img/shopping-cart.svg" alt=".." class="me-2 pb-1"> Belanja Sekarang</a>
                </div>
            </div>
            <div class="carousel-buah col-12 col-sm-6 d-flex flex-column justify-content-center bounce" style="z-index: 1;">
                <div class="buah">
                    <img src="<?= base_url('assets/img/home-buah.png') ?>" alt="...">
                </div>
            </div>
        </div>

    </div>
    <div class="circle-home"> </div>

</section>

<?php
$list = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'rekomendasi'"));
$data = $list['isi_pengaturan'];
$dp = explode(',', $data);

if (!empty($data)) { ?>
    <section id="rekomendasi-produk" class="rekomendasi-produk my-5">
        <div class="container">
            <h2 class="judul-section fs-2 my-3 my-lg-0 mb-lg-3 text-center">Rekomendasi <span class="text-ijo judul-section fs-2 my-3 my-lg-0 mb-lg-3">Produk</span></h2>
            <div class="marquee">

                <marquee behavior="scroll" direction="right" class="py-3 d-flex justify-content-evenly" onmouseout="this.start()" onmouseover="this.stop()" loop="true">

                    <?php foreach ($dp as $p) {
                        $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE kode_produk = '$p'"));
                        $gambar = !empty($produk['gambar']) ? $produk['gambar'] : 'default-produk.jpg';
                    ?>
                        <div id="item-rekomendasi-produk" class="me-2 d-inline-block">
                            <div class="card">
                                <div class="card-header p-0 overflow-hidden">
                                    <img src="<?= base_url('assets/img/produk/' . $gambar) ?>" alt="..." style="width: 100%;">
                                </div>
                                <div class="card-body">
                                    <a href="<?=base_url('produk/lihat/'.$produk['id_produk'])?>" class="text-decoration-none text-dark">
                                        <?= $produk['nm_produk'] ?>
                                        <span class="d-block fw-bold"><?= rupiah($produk['harga_jual']) ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </marquee>
            </div>

        </div>
    </section>
<?php }

$promo = mysqli_query($db, "SELECT * FROM promo WHERE status = '1'");
$jml_promo = mysqli_num_rows($promo);
$jml_carousel = $jml_promo / 2;

if ($jml_promo > 0) { ?>
    <section id="promo" class="promo">
        <div class="container">
            <h2 class="judul-section fs-2 my-3 my-lg-0 mb-lg-3">Promo <span class="text-ijo judul-section fs-2 my-3 my-lg-0 mb-lg-3">Terbatas</span></h2>

            <!-- pakai carousel -->
            <div id="carouselPromoDekstop" class="carousel slide">

                <div class="carousel-indicators mb-0 mb-0">

                    <?php
                    for ($i = 0; $i < $jml_carousel; $i++) { ?>
                        <a href="#carouselPromoDekstop" data-bs-slide-to="<?= $i ?>" class="<?= ($i == 0) ? "active" : "" ?> mx-1 p-1 rounded-circle" aria-current="true" aria-label="Slide<?= $i ?>"></a>
                    <?php } ?>

                </div>
                <div class="carousel-inner pe-0">

                    <?php
                    $limit = 0;
                    for ($i = 1; $i < $jml_carousel + 1; $i++) { ?>

                        <div class="carousel-item <?= ($i == 1) ? "active" : "" ?>">
                            <div class="d-flex pb-3 justify-content-center">

                                <?php
                                $start = $limit;
                                $limit = $i + 1;

                                $query_iPromo = mysqli_query($db, "SELECT * FROM promo WHERE status = '1' ORDER BY id_promo DESC LIMIT $start,$limit");

                                foreach ($query_iPromo as $p) {

                                    $id_produk = $p['id_produk'];

                                    if ($id_produk != 0) {

                                        $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_produk'"));

                                        $gmbr_produk = (!empty($produk['gambar'])) ? $produk['gambar'] : "default-produk.jpg";

                                        $harga_promo = ($p['harga_promo'] == 0) ? $produk['harga_pokok'] : $p['harga_promo'];
                                        $diskon = number_format((($harga_promo / $produk['harga_jual']) * 100), 2);
                                        $arr_diskon = explode('.', $diskon);
                                        $diskon = ($arr_diskon[1] == '00') ? $arr_diskon[0] : $diskon;

                                        $diskon = 100 - $diskon;
                                ?>
                                        <div id="item-promo" class="row col-lg-6 px-2">

                                            <div id="content-promo-left" class=" col-lg-7 py-5 pe-0">

                                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center shadow-sm" style="height: 100%;">
                                                    <h6 class="tebal-700 text-center">Berakhir pada</h6>
                                                    <div id="countdown<?= $id_produk ?>" class="countdown text-danger fw-bold mb-2">

                                                    </div>
                                                </div>
                                            </div>

                                            <div id="content-promo-right" class="promo my-2 ps-lg-0  col-lg-5">
                                                <div class="card border border-0 shadow rounded overflow-hidden">
                                                    <div class="position-relative" style="aspect-ratio: 1/1;">

                                                        <img id="img-promo" src="<?= base_url('assets/img/produk/' . $gmbr_produk) ?>" alt="...">

                                                        <div class="overlay-promo position-absolute bottom-0 px-3 py-3">
                                                            <h3 class="nmPromo tebal-600 fs-5 text-white mb-3"><?= $produk['nm_produk'] ?></h3>

                                                            <?php if ($produk['harga_jual'] != $produk['harga_pokok']) { ?>
                                                                <span class="coret-text fs-6 text-white"><?= rupiah($produk['harga_jual']) ?></span>
                                                                <span class="label-diskon rounded p-1">-<?= $diskon ?>%</span>
                                                            <?php } ?>
                                                            <span class="d-block fs-5 text-white" style="font-weight: 700;"><?= ($p['harga_promo'] == 0) ? rupiah($produk['harga_pokok']) : rupiah($p['harga_promo']) ?></span>

                                                            <a href="<?= base_url('produk/lihat/' . $id_produk) ?>" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php } else { ?>

                                        <div id="item-promo" class="row justify-content-center col-lg-6 px-2">
                                            <div class="text-center">
                                                <h6 class="fw-bold">Berakhir pada</h6>
                                                <div id="countdown<?= $id_produk ?>" class="countdown text-danger fw-bold my-2">

                                                </div>

                                                <img src="<?= base_url('assets/img/promo/' . $p['gambar']) ?>" alt="" id="img-promo-0" class="my-1 pb-1">

                                            </div>
                                        </div>

                                    <?php } ?>
                                    <script>
                                        setInterval(() => {
                                            var countDownDate = new Date('<?= $p['waktu_selesai'] ?>').getTime();
                                            var countDownTag = 'countdown' + <?= $id_produk ?>;
                                            countdown(countDownDate, countDownTag)
                                        }, 1000);
                                    </script>

                                <?php } ?>

                            </div>
                        </div>

                    <?php } ?>
                </div>

                <button class="carousel-control-prev bg-white position-absolute top-50 translate-middle rounded-circle border shadow-sm" type="button" data-bs-target="#carouselPromoDekstop" data-bs-slide="prev" style="opacity: 1;">
                    <i class="fa-solid fa-angle-left"></i>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next bg-white position-absolute top-50 start-100 translate-middle rounded-circle border shadow-sm" type="button" data-bs-target="#carouselPromoDekstop" data-bs-slide="next" style="opacity: 1;">
                    <i class="fa-solid fa-angle-right"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- /pakai carousel -->







            <!-- carousel Handheld -->
            <div id="carouselPromoHandheld" class="carousel slide">

                <div class="carousel-indicators mb-0 mb-0">
                    <?php
                    $i = 0;
                    foreach ($promo as $p) { ?>

                        <a href="#carouselPromoHandheld" data-bs-slide-to="<?= $i ?>" class="<?= ($i == 0) ? "active" : "" ?> mx-1 p-1 rounded-circle" aria-current="true" aria-label="Slide<?= $i ?>"></a>

                    <?php $i++;
                    } ?>
                </div>

                <div class="carousel-inner">
                    <?php
                    $i = 1;
                    foreach ($promo as $p) {


                        $id_produk = intval($p['id_produk']);

                        if ($id_produk != 0) {

                            $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_produk'"));

                            $gmbr_produk = (!empty($produk['gambar'])) ? $produk['gambar'] : $harga_promo = ($p['harga_promo'] == 0) ? $produk['harga_pokok'] : $p['harga_promo'];
                            "default-produ
                            k.jpg";

                            $diskon = number_format((($harga_promo / $produk['harga_jual']) * 100), 2);
                            $arr_diskon = explode('.', $diskon);
                            $diskon = ($arr_diskon[1] == '00') ? $arr_diskon[0] : $diskon;

                            $diskon = 100 - $diskon;
                    ?>

                            <div class="carousel-item <?= ($i == 1) ? "active" : "" ?>">
                                <div class="d-flex pb-3 justify-content-center">
                                    <div class="row col-12 col-lg-6 px-2">

                                        <div id="content-promo-left" class=" col-md-7 col-lg-7 py-5 pe-0">

                                            <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center shadow-sm" style="height: 100%;">
                                                <h6 class="tebal-700 text-center">Berakhir pada</h6>
                                                <div id="countdownTablet<?= $id_produk ?>" class="countdown text-danger fw-bold mb-2">

                                                </div>
                                            </div>
                                        </div>

                                        <div id="content-promo-right" class="promo my-2 ps-lg-0 col-md-5 col-lg-5">
                                            <div class="card border border-0 shadow rounded overflow-hidden">
                                                <div class="position-relative" style="aspect-ratio: 1/1;">

                                                    <div id="countdownMobile<?= $id_produk ?>" class="countdown-mobile text-danger fw-bold mb-2 position-absolute top-0 mt-3 ms-2">

                                                    </div>

                                                    <img id="img-promo" src="<?= base_url('assets/img/produk/' . $gmbr_produk) ?>" alt="...">

                                                    <div class="overlay-promo position-absolute bottom-0 col-12 px-3 py-3">
                                                        <h3 class="nmPromo tebal-600 fs-5 text-white"><?= $produk['nm_produk'] ?></h3>
                                                        <?php if ($produk['harga_jual'] != $produk['harga_pokok']) { ?>
                                                            <span class="coret-text fs-6 text-white"><?= rupiah($produk['harga_jual']) ?></span>
                                                            <span class="label-diskon rounded p-1">-<?= $diskon ?>%</span>
                                                        <?php } ?>
                                                        <span class="d-block fs-5 text-white" style="font-weight: 700;"><?= ($p['harga_promo'] == 0) ? rupiah($produk['harga_pokok']) : rupiah($p['harga_promo']) ?></span>

                                                        <a href="<?= base_url('produk/lihat/' . $id_produk) ?>" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        <?php } else { ?>

                            <div class="carousel-item <?= ($i == 1) ? "active" : "" ?> pb-3">
                                <div id="item-promo" class="row justify-content-center col-lg-6 px-2">
                                    <div class="text-center">
                                        <h6 class="fw-bold">Berakhir pada</h6>
                                        <div id="countdownMobile<?= $id_produk ?>" class="countdown text-danger fw-bold my-2">

                                        </div>

                                        <img src="<?= base_url('assets/img/promo/' . $p['gambar']) ?>" alt="..." id="img-promo-0" class="my-1">

                                    </div>
                                </div>
                            </div>

                        <?php   } ?>

                        <script>
                            setInterval(() => {
                                var countDownDate = new Date('<?= $p['waktu_selesai'] ?>').getTime();
                                var countDownTagM = 'countdownMobile' + <?= $id_produk ?>;
                                var countDownTagT = 'countdownTablet' + <?= $id_produk ?>;

                                countdown(countDownDate, countDownTagM);
                                if (countDownTagT != 'countdownTablet0') {
                                    countdown(countDownDate, countDownTagT);
                                }
                            }, 1000);
                        </script>

                    <?php $i++;
                    } ?>
                </div>

                <button class="carousel-control-prev bg-white position-absolute top-50 translate-middle rounded-circle border" type="button" data-bs-target="#carouselPromoHandheld" data-bs-slide="prev">
                    <i class="fa-solid fa-angle-left"></i>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next bg-white position-absolute top-50 translate-middle rounded-circle border" type="button" data-bs-target="#carouselPromoHandheld" data-bs-slide="next">
                    <i class="fa-solid fa-angle-right"></i>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <!-- /carousel Handheld -->

        </div>
    </section>
<?php } ?>

<section id="about" class="about">
    <div class="container">
        <div class="row">
            <div id="left-panel-about" class="col-12 col-md-8 col-lg-6">
                <img src="https://img.freepik.com/free-photo/woman-with-tablet-buying-healthy-food-supermarket-grocery-store_342744-1110.jpg?w=1060&t=st=1689548917~exp=1689549517~hmac=19dabc37579833615211d86c34acd4da95ee160043c8c637a306bbd2e6eeb450" alt="..." class="position-relative" style="right: -3em; width: 100%;-webkit-clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%);
clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%); overflow: hidden;
                ">

            </div>
            <div id="right-panel-about" class=" col-12 col-md-12 col-lg-6 p-lg-3">
                <div class="content-about py-lg-3 px-lg-4 position-relative bg-white shadow" style="left: -3em; border-radius: 20px;">

                    <h2 class="judul-section fs-2 my-3 my-lg-0 mb-lg-3">About <span class="text-ijo judul-section fs-2 my-3 my-lg-0 mb-lg-3">Us</span></h2>
                    <?php
                    $s_about = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan ='data_toko'"));

                    $about = unserialize($s_about['isi_pengaturan']);
                    echo $about['about_us'];
                    ?>

                </div>
            </div>
        </div>
    </div>
</section>








<!-- <section id="login" class="login">
    <div class="container">
        <div class="panel panel-default mb-5">
            <?php
            //if ($login_button == '') {
            ?>
                <div class="panel-body">
                    <img src="<? // echo $_SESSION['user_image'] 
                                ?>" alt="foto" style="border-radius: 50%;">
                    <h3><b>Name :</b> <? // echo $_SESSION['name'] 
                                        ?></h3>
                    <h3><b>Email :</b> <? // echo $_SESSION['user_email_address'] 
                                        ?></h3>
                    <h3><a href="Logout">Logout</a></h3>
                </div>
            <? // } else { 
            ?>
                <h4 align="center" class="pt-5 mt-5" style="font-weight: 600 !important;">Login Melalui Akun Google Untuk Menggunakan Fitur Chat</h4>

                <p class="fw-bolder text-center">Gunakan fitur chat untuk menghubungi penjual secara langsung!</p>
                <div align="center"><? // echo $login_button 
                                    ?></div>
            <? // }
            ?>
        </div>
    </div>
</section> -->