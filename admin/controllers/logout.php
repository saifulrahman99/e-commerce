<?
session_start();
require_once '../../assets/basis/kon.php';

unset($_SESSION['status_login']);
setcookie('username', '');
setcookie('password', '');
setcookie('id_admin', '');

mysqli_query($db, "UPDATE akun SET status_online = '0'");

header('location:adastra');
