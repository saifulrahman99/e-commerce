<?
session_start();

unset($_SESSION['status_login']);
setcookie('username', '');
setcookie('password', '');

header('location:adastra');
