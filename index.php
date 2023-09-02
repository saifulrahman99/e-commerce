<?php
session_start();
// pakai base url agar pengalamatan tidak error, base url berfungsi untuk identifikasi domain asli dan mengaturnya sebagai path original atau asli
require('config.php');
require_once('assets/basis/kon.php');
require('function.php');
require('controllers/add-user.php');
require('admin/controllers/off-promo.php');

// $login_button = '';

// if (isset($_GET["code"])) {
//     $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
//     if (!isset($token['error'])) {
//         $google_client->setAccessToken($token['access_token']);
//         $_SESSION['access_token'] = $token['access_token'];
//         $google_service = new Google_Service_Oauth2($google_client);
//         $data = $google_service->userinfo->get();
//         if (!empty($data['given_name']) && !empty($data['family_name'])) {
//             $given_name = $data['given_name'];
//             $family_name = $data['family_name'];
//             $_SESSION['name'] = $given_name;
//         }
//         if (!empty($data['email'])) {
//             $_SESSION['user_email_address'] = $data['email'];
//         }

//         if (!empty($data['gender'])) {
//             $_SESSION['user_gender'] = $data['gender'];
//         }

//         if (!empty($data['picture'])) {
//             $_SESSION['user_image'] = $data['picture'];
//         }
//     }
// }

// if (!isset($_SESSION['access_token'])) {
//     $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="opsi-login text-decoration-none rounded"><img src="assets/img/brand/google.png" width="30" alt="google"/><span class="fw-bolder"> Login Google</span></a>';
// }
// session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <?php
    if ($nm_halaman == 'Lihat') {
        $get_id = (isset($_GET['id_produk']) && !empty($_GET['id_produk']) ? $_GET['id_produk'] : '');
        $tumbnail = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$get_id'"));
        $tumbnail = $tumbnail['gambar'];
    ?>

        <meta property="og:image" content="<?= base_url('assets/img/produk/' . $tumbnail) ?>">

    <?php } else { ?>
        <meta property="og:image" content="<?= base_url('assets/img/brand/adastra.png') ?>">
    <?php } ?>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/gh/yesiamrocks/cssanimation.io@1.0.3/cssanimation.min.css" rel="stylesheet">

</head>

<body>
    <!-- navigasi start -->
    <header id="navbar" class="navbar">
        <div class="container">
            <div class="logo-web" style="position:relative; height: 5rem;">
                <img id="logo-toko" src="<?= base_url('assets/img/brand/adastra.png') ?>" alt="logo adastra" style="<?= ($halaman == 'Home') ? 'max-width: 15rem; position: absolute;' : 'max-width: 5rem' ?>;">
                <div class="cricle-logo" style=" position: absolute; padding: 3rem 3rem; background-color: white; top: -1rem; left: -0.5rem; z-index: -1; border-radius: 50%;"></div>
            </div>
            <nav class="navbar-nav">
                <ul>
                    <li><a href="<?= base_url('home') ?>" class="menu menu-nav">Home</a></li>
                    <li><a href="<?= base_url('produk') ?>" class="menu menu-nav">Produk</a></li>
                    <li><a href="<?= base_url('transaksi') ?>" class="menu menu-nav">Transaksi</a></li>
                    <li class="px-2">
                        <a href="<?= base_url('pesan') ?>" class="menu-nav position-relative">
                            <i data-feather="message-square"></i>
                            <span id="dot-notif-pesan" class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle op-none"> </span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a href="<?= base_url('keranjang') ?>" id="hrefCart" class="menu-nav-extra position-relative">
                            <i data-feather="shopping-cart"></i>

                            <span id="jml-item-dalam-cart" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> </span>
                        </a>
                    </li>

                </ul>
            </nav>

            <!-- mobile menu -->
            <nav class="navbar-nav-extra">
                <ul class="d-flex justify-content-evenly">

                    <li><a href="<?= base_url('home') ?>" class="menu-nav m-0 p-0"> <i data-feather="home" class="d-block m-auto"></i> <span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Home" || $halaman == "Keranjang") ? "active-mobile" : "" ?>">Home</span> </a> </li>

                    <li><a href="<?= base_url('produk') ?>" class="menu-nav m-0 p-0"> <i data-feather="shopping-bag"></i><span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Produk" || $halaman == "Lihat") ? "active-mobile" : "" ?>">Produk</span> </a> </li>

                    <li>
                        <a href="<?= base_url('pesan') ?>" class="menu-nav position-relative ">
                            <div class="position-relative" style="width: 30px; margin: auto;">
                                <i data-feather="message-square" class="d-block m-auto"> </i>
                                <span id="dot-notif-pesan-mobile" class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle op-none"> </span>

                            </div>
                            <span class="d-block m-auto rounded mt-1 px-1 <?= ($halaman == "Pesan") ? "active-mobile" : "" ?>">pesan</span>
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
            <!-- /mobile menu -->


            <nav class="navbar-nav-extra-menu">
                <ul class="p-0">

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

    <?php
    $id_obrolan = (isset($_GET['admin']) && !empty($_GET['admin']) ? $_GET['admin'] : 1);
    ?>
    <!-- value pengunjung dan admin untuk digunakan di js -->
    <input type="text" name="idAdmin" value="<?= $id_obrolan ?>" hidden>
    <input type="text" name="idPengunjung" value="<?= $id_pengunjung ?>" hidden>

    <?php
    // set jlm pesan awal
    $total_pesan = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(status_terbaca) as jml_pesan FROM obrolan WHERE status_terbaca = '0' AND pengirim != '$id_pengunjung' AND id_pengunjung='$id_pengunjung'"));
    ?>
    <input type="text" id="total_pesan_diterima_old" value="<?= $total_pesan['jml_pesan'] ?>" hidden>

    <div id="input-jml-pesan">

    </div>

    <!-- /value untuk digunakan di js -->


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
        case 'Pesan':
            include 'view/pesan.php';
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
                <?php
                $s_info_toko = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan ='data_toko'"));

                $info = unserialize($s_info_toko['isi_pengaturan']);

                ?>
                <div class="row justify-content-evenly">

                    <div id="fOprasional" class="col-12 col-md-4 col-lg-3 text-center text-md-start mb-5 mb-md-0">
                        <h5 class="text-white">Jam Buka</h5>
                        <?= $info['oprasional'] ?>
                    </div>
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <h5 class="text-center text-white">Sosial Media</h5>
                        <div class="row justify-content-center">
                            <a href="<?= $info['ig'] ?>" target="_blank" class="col-4 col-md-6 col-lg-4 sosial-media text-decoration-none text-center mb-2 mb-lg-0">
                                <i class="d-block fa-brands fa-instagram text-white fs-3 mb-2"></i>
                                <span class="d-block text-white">Instagram</span>
                            </a>
                            <a href="<?= $info['fb'] ?>" target="_blank" class="col-4 col-md-6 col-lg-4 sosial-media text-decoration-none text-center mb-2 mb-lg-0">
                                <i class="d-block fa-brands fa-facebook text-white fs-3 mb-2"></i>
                                <span class="d-block text-white">Facebook</span>
                            </a>
                            <a href="https://wa.me/<?= $info['wa'] ?>" target="_blank" class="col-4 col-md-6 col-lg-4 sosial-media text-decoration-none text-center mb-2 mb-lg-0">
                                <i class="d-block fa-brands fa-whatsapp text-white fs-3 mb-2"></i>
                                <span class="d-block text-white">Whatsapp</span>
                            </a>
                        </div>
                    </div>
                    <div id="fAlamat" class="col-12 col-md-4 col-lg-3 text-center text-md-start">
                        <h5 class="text-center text-white">Alamat Toko</h5>
                        <?= $info['alamat'] ?>
                        <i class="fa-regular fa-map text-white"></i>
                        <a href="<?= $info['lokasi'] ?>" target="_blank" class="text-white text-decoration-none fw-bold">Lihat Lokasi</a>
                    </div>
                    <div class="mt-1 text-center text-white">
                        IP Anda : <?= get_client_ip_env() ?>
                    </div>
                </div>

                <div class="copyright text-center">
                    <!-- <span id="token-notif" class="d-block"></span> -->
                    <span class="text-white">by Saiful Rahman 2023</span>
                </div>
            </div>
        </div>

    </footer>

    <!-- footer end -->

    <!-- toast notif -->
    <div class="position-fixed p-3" style="z-index: 5; right: 0; top: 1; width: 250px;">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
            <div class="toast-header">
                <img src="<?= base_url('../assets/img/brand/adastra.jpg') ?>" class="rounded mr-2" alt="..." style="width: 20px;">
                <strong class="mr-auto">Notifikasi</strong>
            </div>
            <div class="toast-body">
                Ada Pesan Baru
            </div>
        </div>
    </div>
    <!-- /toast notif -->

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

    <?php
    if ($halaman == 'Home') { ?>
        <script src="<?= base_url('assets/js/script-home.js') ?>"></script>
    <?php } ?>
    <!-- js costum -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <?php
    switch ($halaman) {
        case 'Lihat':
            $url = '-lihat.js';
            break;
        case 'Pesan':
            $url = '-pesan.js';
            break;

        default:
            $url = '.js';
            break;
    } ?>
    <script type="text/javascript" src="<?= base_url('assets/js/ajax' . $url) ?>"></script>

    <!-- icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>

    <script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging-compat.js"></script>
    <script>
        const firebaseConfig = {
            // firebaseConfig here
            apiKey: "AIzaSyByc2HkXpLxwZVtDwHPU4DynFGxmLCTgKI",

            authDomain: "adastra-project.firebaseapp.com",

            projectId: "adastra-project",

            storageBucket: "adastra-project.appspot.com",

            messagingSenderId: "860097321121",

            appId: "1:860097321121:web:f150953edc8058a80978e0",

            measurementId: "G-ZPRZV7F405"

        };
        const app = firebase.initializeApp(firebaseConfig)
        const messaging = firebase.messaging();

        messaging.getToken({
            vapidKey: 'BPizGrwx-iIJb4lZaBNP7JM7m4wytFBMinZ9Cw4RW8fXaI5gos_Pt_98ixZg0N4qTDQW7Apovp3elAjmr0uEdT4'
        }).then((currentToken) => {
            // app token used for sending notifications
            if (currentToken) {

                var id_pengunjung = '<?= $id_pengunjung ?>';
                var token = currentToken;
                var path = '<?= $path_addToken ?>';
                var base_url = window.location.origin + "/";
                $.ajax({
                    url: base_url + 'controllers/add-token-notif.php',
                    method: "POST",
                    data: {
                        "id_pengunjung": id_pengunjung,
                        "token": token
                    },
                    success: function(data) {
                        // console.log('save sukses');
                    }
                });

                sendTokenToServer(currentToken)
            } else {
                setTokenSentToServer(false);
            }
        }).catch((err) => {
            // notifications are manually blocked, you can ask for unblock here
            console.log('An error occurred while retrieving token. ', err);
            setTokenSentToServer(false);
        });

        function sendTokenToServer(currentToken) {
            if (!isTokenSentToServer()) {
                console.log('Sending token to server...');
                // TODO(developer): Send the current token to your server.
                setTokenSentToServer(true);
            } else {
                setTokenSentToServer(true);
                console.log('Token already available in the server');
            }
        }

        function isTokenSentToServer() {
            return window.localStorage.getItem('sentToServer') === '1';
        }

        function setTokenSentToServer(sent) {
            window.localStorage.setItem('sentToServer', sent ? '1' : '0');
        }
    </script>

</body>

</html>