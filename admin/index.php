<?php
session_start();
require_once '../assets/basis/kon.php';
require 'function/cek-login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    INI DASHBOARD<br>
    <a href="logout" class="btn btn-primary btn-sm my-3">Keluar</a>
</body>
</html>