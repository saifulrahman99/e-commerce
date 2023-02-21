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
            $_SESSION['name'] = " $given_name  $family_name";
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
    <title><?php echo $nm_halaman ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

</head>

<body>
    <!-- navigasi start -->
    <section id="navbar" class="navbar">
        <div class="container">
            <div class="logo-web">
                <h1>Butik Buah Adastra</h1>
            </div>
            <nav class="navbar-nav">
                <ul>
                    <li><a href="Home">Home</a></li>
                    <li><a href="Produk">Produk</a></li>
                    <li><a href="Tentang-Kami">Tentang Kami</a></li>
                </ul>
            </nav>
            <div class="navbar-nav-extra">
                <ul>
                    <?php if ($login_button == '') : ?>
                        <li><a class="d-flex justify-content-center"> <img class="mx-1" src="<?php echo $_SESSION['user_image'] ?>" alt="foto" style="border-radius: 50%; max-width:2rem;"> <span class="pt-2"><?php echo $_SESSION['name'] ?></span></a></li>
                        <li><a href="#" class="d-flex justify-content-center"> <i data-feather="shopping-cart"></i> <span>&nbsp(0)</span></a> </li>
                        <li><a href="#" class="d-flex justify-content-center"> <i data-feather="log-out"></i></a> </li>
                    <?php else : ?>
                        <li><a href="#"> Login </a></li> |
                        <li><a href="#"> Register </a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="navbar-nav-extra-menu">
                <ul>
                    <li><a href="#"> <i data-feather="menu"></i> </a></li>
                </ul>
            </div>
        </div>
    </section>
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

    </footer>
    <!-- footer end -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- js costum -->
    <script src="assets/js/script.js"></script>
    <!-- icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>