<?php
session_start();
// pakai base url agar pengalamatan tidak error, base url berfungsi untuk identifikasi domain asli dan mengaturnya sebagai path original atau asli
require('config.php');
require_once('assets/basis/kon.php');
require('function.php');
require('controllers/add-user.php');

$login_button = '';

if (isset($_GET["code"])) {
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        if (!empty($data['given_name']) && !empty($data['family_name'])) {
            $given_name = $data['given_name'];
            $family_name = $data['family_name'];
            $_SESSION['name'] = $given_name;
        }
        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

if (!isset($_SESSION['access_token'])) {
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="opsi-login text-decoration-none rounded"><img src="assets/img/brand/google.png" width="30" alt="google"/><span class="fw-bolder"> Login Google</span></a>';
}
// session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <title>
        <?php
        if ($nm_halaman == "Home") {
            $nm_halaman = "Butik Buah Adastra";
            $body = "body-home";
        } elseif (isset($_GET['id_produk'])) {
            $id_produk_halaman = $_GET['id_produk'];
            $hlm_nm_produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT nm_produk FROM produk WHERE id_produk='$id_produk_halaman'"));
            $nm_halaman = $hlm_nm_produk['nm_produk'];
        }
        echo $nm_halaman;
        ?>
    </title>
    <link rel="shortcut icon" href="<?= base_url('assets/img/brand/adastra.png') ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">

</head>

<body id="<? //$body 
            ?>">
    <!-- navigasi start -->
    <header id="navbar" class="navbar">
        <div class="container">
            <div class="logo-web" style="position:relative;">
                <!-- <h1>Butik Buah Adastra</h1> -->
                <img src="<?= base_url('assets/img/brand/adastra.png') ?>" alt="logo adastra">
                <div class="cricle-logo" style=" position: absolute; padding: 3rem 3rem; background-color: white; top: -1rem; left: -0.5rem; z-index: -1; border-radius: 50%;"></div>
            </div>
            <nav class="navbar-nav">
                <ul>
                    <li><a href="<?= base_url('home') ?>" class="menu menu-nav">Home</a></li>
                    <li><a href="<?= base_url('produk') ?>" class="menu menu-nav">Produk</a></li>
                    <li><a href="#" class="menu menu-nav">About Us</a></li>
                    <!-- <li class="search-box">
                        <input type="text" class="search-input" placeholder="Search...">
                        <a> <i data-feather="search"></i> </a>
                    </li> -->
                    <li class="px-2">
                        <a href="<?= base_url('keranjang') ?>" id="hrefCart" class="menu-nav-extra position-relative">
                            <i data-feather="shopping-cart"></i>

                            <span id="jml-item-dalam-cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> </span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a href="#" class="menu-nav position-relative">
                            <i data-feather="message-square"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a href="<?= base_url('transaksi') ?>" class="menu-nav">
                            <i data-feather="file-text"></i>
                        </a>
                    </li>
                    <?php if ($login_button == '') : ?>
                        <li class="px-2"><span class="nav-user-profile menu-nav"> <i data-feather="user" class="pb-1"></i> <span class=""><?php echo $_SESSION['name'] ?></span></span></li>

                    <?php endif; ?>
                </ul>
            </nav>


            <nav class="navbar-nav-extra">
                <ul class="d-flex justify-content-evenly">

                    <li><a href="<?= base_url('home') ?>" class="menu-nav m-0 p-0"> <i data-feather="home" class="d-block m-auto"></i> <span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Home" || $halaman == "Keranjang") ? "active-mobile" : "" ?>">Home</span> </a> </li>

                    <li><a href="<?= base_url('produk') ?>" class="menu-nav m-0 p-0"> <i data-feather="shopping-bag"></i><span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Produk" || $halaman == "Lihat") ? "active-mobile" : "" ?>">Produk</span> </a> </li>

                    <li>
                        <a href="#" class="menu-nav position-relative ">
                            <i data-feather="message-square" class="d-block m-auto"> </i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                            <span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Pesan") ? "active-mobile" : "" ?>">Pesan</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url('transaksi') ?>" class="menu-nav m-0 p-0">
                            <i data-feather="file-text" class="d-block m-auto"></i>
                            <span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Transaksi") ? "active-mobile" : "" ?>">Transaksi</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <nav class="navbar-nav-extra-menu">
                <ul class="p-0">
                    <!-- <li class="search-box">
                        <input type="text" class="search-input" placeholder="Search...">
                        <a> <i data-feather="search"></i> </a>
                    </li> -->
                    <li>
                        <a href="<?= base_url('keranjang') ?>" id="hrefCart" class="position-relative">
                            <i data-feather="shopping-cart"></i>
                            <span id="jml-item-dalam-cart-mobile" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> </span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </header>
    <div id="navbar-show" class="navbar-show"></div>
    <!-- navigasi end -->

    <!-- konten halaman start -->
    <?php
    switch ($halaman) {
        case 'Home':
            include 'view/home.php';
            break;
        case 'Produk':
            include 'view/produk.php';
            break;
        case 'Keranjang':
            include 'view/keranjang.php';
            break;
        case 'Lihat':
            include 'view/lihat.php';
            break;
        case 'Transaksi':
            include 'view/transaksi.php';
            break;
    }
    ?>
    <!-- konten halaman End -->

    <!-- footer start -->
    <footer>
        <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
                <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
                <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(80, 184, 46,0.7" />
                <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(80, 184, 46,0.5)" />
                <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(80, 184, 46,0.3)" />
                <use xlink:href="#gentle-wave" x="48" y="7" fill="rgba(80, 184, 46,0.1)" />
            </g>
        </svg>
        <div class="body-footer">

            <div class="container">
                <div class="row justify-content-evenly">

                    <div class="col-12 col-md-4 col-lg-3 text-center text-md-start mb-5 mb-md-0">
                        <h5 class="text-white">Jam Buka</h5>
                        <span class="d-block text-white">Senin - Kamis : 08.00 - 16.00</span>
                        <span class="d-block text-white">Jumat : 13.00 - 16.00</span>
                        <span class="d-block text-white">Minggu : Libur</span>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <h5 class="text-center text-white">Sosial Media</h5>
                        <div class="d-flex justify-content-center">
                            <a href="#" target="_blank" class="sosial-media text-decoration-none text-center mx-3">
                                <i class="d-block fa-brands fa-instagram text-white fs-3 mb-2"></i>
                                <span class="d-block text-white">Instagram</span>
                            </a>
                            <a href="#" target="_blank" class="sosial-media text-decoration-none text-center mx-3">
                                <i class="d-block fa-brands fa-facebook text-white fs-3 mb-2"></i>
                                <span class="d-block text-white">Facebook</span>
                            </a>
                            <a href="#" target="_blank" class="sosial-media text-decoration-none text-center mx-3">
                                <i class="d-block fa-brands fa-whatsapp text-white fs-3 mb-2"></i>
                                <span class="d-block text-white">Whatsapp</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 text-center text-md-start">
                        <h5 class="text-center text-white">Alamat Toko</h5>
                        <p class=" text-white mb-2" style="font-size: 0.9rem;">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. At, harum.
                        </p>
                        <i class="fa-solid fa-location-dot text-warning"></i>
                        <a href="https://goo.gl/maps/UQ1ruuepLQiodRK97" target="_blank" class="text-warning text-decoration-none">Lihat Lokasi</a>
                    </div>
                </div>

                <div class="copyright text-center">
                    <span class="text-white">by Saiful Rahman 2023</span>
                </div>
            </div>
        </div>

    </footer>

    <!-- footer end -->

    <!-- popup add keranjang -->
    <div class="position-fixed top-50 start-50 translate-middle">
        <div id="cartToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body p-4">
                <b>Berhasil Ditambahkan Ke Keranjang</b>
            </div>
            <div class="toast-footer">
                <button type="button" class="btn-info-cart m-auto p-2 rounded-bottom" data-bs-dismiss="toast" aria-label="Close">OK</button>
            </div>
        </div>
    </div>
    <!-- end popup add keranjang -->


    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jquery js -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- js costum -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <?php
    if ($halaman != "Lihat") { ?>
        <script src="<?= base_url('assets/js/ajax.js') ?>"></script>
    <?php } else { ?>
        <script src="<?= base_url('assets/js/ajax-lihat.js') ?>"></script>
    <?php } ?>
    <!-- icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>