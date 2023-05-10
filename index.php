<?php
$halaman = isset($_GET['halaman']) ? $_GET['halaman'] : "Home";
$nm_halaman = explode('-', $halaman);
$jml = count($nm_halaman);
$nm_halaman = ($jml > 1) ? "$nm_halaman[0] $nm_halaman[1]" : $halaman;

include('config.php');

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
    $login_button = '<a href="' . $google_client->createAuthUrl() . '" class="opsi-login text-decoration-none rounded"><img src="assets/img/brand/google.png" width="30" alt="google"/><span> Login Dengan Google</span></a>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
    <title><?php echo ($nm_halaman == "Home") ? "Butik Buah Adastra" : $nm_halaman ?></title>
    <link rel="shortcut icon" href="assets/img/brand/adastra.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<body>
    <!-- navigasi start -->
    <section id="navbar" class="navbar">
        <div class="container">
            <div class="logo-web" style="position:relative;">
                <!-- <h1>Butik Buah Adastra</h1> -->
                <img src="assets/img/brand/adastra.png" alt="logo adastra">
                <div class="cricle-logo" style="position: absolute; padding: 3rem 3rem; background-color:white;top: -1rem;left: -0.5rem; z-index:-1; border-radius:50%;"></div>
            </div>
            <nav class="navbar-nav">
                <ul>
                    <li><a href="Home" class="menu menu-nav">Home</a></li>
                    <li><a href="Produk" class="menu menu-nav">Produk</a></li>
                    <li><a href="Tentang-Kami" class="menu menu-nav">Tentang Kami</a></li>
                    <li class="search-box">
                        <input type="text" class="search-input" placeholder="Search...">
                        <a> <i data-feather="search"></i> </a>
                    </li>
                    <li class="px-2">
                        <a href="#" class="menu-nav-extra position-relative">
                            <i data-feather="shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a href="#" class="menu-nav position-relative">
                            <i data-feather="message-square"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                        </a>
                    </li>
                    <li class="px-2">
                        <a href="#" class="menu-nav position-relative">
                            <i data-feather="file-text"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                        </a>
                    </li>
                    <?php if ($login_button == '') : ?>
                        <li class="px-2"><span class="nav-user-profile menu-nav"> <i data-feather="user" class="pb-1"></i> <span class=""><?php echo $_SESSION['name'] ?></span></span></li>
                        <!-- <li><a href="Logout" class="menu-nav"> <i data-feather="log-out"></i></a> </li> -->
                    <?php endif; ?>
                </ul>
            </nav>
            <div class="navbar-nav-extra">
                <ul class="d-flex justify-content-evenly">
                    <li><a href="Home" class="menu-nav m-0 p-0"> <i data-feather="home" class="d-block m-auto"></i> <span class="d-block m-auto">Home</span> </a> </li>
                    <li><a href="Produk" class="menu-nav m-0 p-0"> <i data-feather="shopping-bag"></i><span class="d-block m-auto">Produk</span> </a> </li>
                    <!-- <li><span class="nav-user-profile menu-nav"><i data-feather="user" class="pb-1"></i></li> -->
                    <li>
                        <a href="#" class="menu-nav position-relative ">
                            <i data-feather="message-square" class="d-block m-auto"></i>
                            <span class="d-block m-auto">Pesan</span>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="menu-nav position-relative m-0 p-0">
                            <i data-feather="archive" class="d-block m-auto"></i>
                            <span class="d-block m-auto">Transaksi</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="navbar-nav-extra-menu">
                <ul class="p-0">
                    <li class="search-box">
                        <input type="text" class="search-input" placeholder="Search...">
                        <a> <i data-feather="search"></i> </a>
                    </li>
                    <li>
                        <a href="#" class="position-relative">
                            <i data-feather="shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"> </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
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
    }
    ?>
    <!-- konten halaman End -->

    <!-- footer start -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h5 class="text-white">Waktu Oprasional</h5>
                    <span class="d-block text-white">Senin - Kamis : 08.00 - 16.00</span>
                    <span class="d-block text-white">Jumat : 13.00 - 16.00</span>
                    <span class="d-block text-white">Minggu : Libur</span>
                </div>
                <div class="col-4">
                    <h5 class="text-center text-white">Sosial Media</h5>
                </div>
                <div class="col-4">
                    <h5 class="text-end text-white">Alamat Toko</h5>

                </div>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- js costum -->
    <script src="assets/js/script.js"></script>
    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>