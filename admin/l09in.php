<?php
session_start();

require 'function/base_url.php';
require_once '../assets/basis/kon.php';

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {

    $coockie_username = $_COOKIE['username'];
    $coockie_password = $_COOKIE['password'];
    $key_coockie = hash('sha256', "$coockie_password$coockie_username");

    $key = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM admin"));
    $key = $key['key'];

    if ($key_coockie === $key) {
        $_SESSION['status_login'] = true;
    } else {
        $_SESSION['status_login'] = false;
    }
}

if ($_SESSION['status_login'] == true) {
    header('location: control');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<?php
require 'assets/komponen/css.php';
?>

<body id="body-login">
    <section id="login" class="login">
        <div class="container container-login">

            <div class="konten-login row justify-content-center align-items-center">

                <div class="form-login col-12 col-md-8 col-lg-4">
                    <form action="login-control" method="post" id="form-login" class="py-4 border rounded p-3 shadow-sm position-relative">
                        <input type="text" name="login" hidden>
                        <div class="brand-login text-center">
                            <a href="../">
                                <img src="<?= base_url('../assets/img/brand/adastra.png') ?>" alt="" style="width: 100px;">
                            </a>
                        </div>
                        <div class="form-floating my-4">
                            <input type="text" name="username" class="form-control" id="floatingUsername" placeholder="Username" required>
                            <label for="floatingUsername">Username</label>
                        </div>
                        <div class="form-floating my-4">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" value="1" id="rememberme">
                            <label class="form-check-label remember-me" for="rememberme">ingat saya</label>
                        </div>

                        <button type="submit" class="btn my-4 col-12 p-3 btn-dark">MASUK</button>
                        <div class="blur position-absolute top-0 start-0"> </div>
                    </form>
                </div>

                <div class="col-12 col-lg-8 text-center gambar-login">
                    <img src="<?= base_url('../assets/img/home-buah.png') ?>" alt="" class="cssanimation hu__hu__" style="width: 80%;">
                </div>
            </div>
        </div>
    </section>
</body>
<?php
require 'assets/komponen/js.php';
?>

</html>