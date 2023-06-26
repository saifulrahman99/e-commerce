<?php
session_start();

require_once '../assets/basis/kon.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    
    $s_admin = mysqli_num_rows(mysqli_query($db, "SELECT * FROM akun WHERE username = '$username' AND password = '$password'"));

    if ($s_admin > 0) {
        
        if ($_POST['remember'] == '1') {
            setcookie('username', "$username", time() + (60 * 60 * 24 * 3));
            setcookie('password', "$password", time() + (60 * 60 * 24 * 3));
        }
        $_SESSION['status_login'] = true;
        header('location:login');
    }else {
        header('location:login');
    }
}
