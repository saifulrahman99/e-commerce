<?php
function base_url($file = NULL)
{
    // online
    // $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/";
    // offline
    $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/e-commerce" . "/";

    $path .= $file;
    return $path;
}

// function
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

$halaman = ucfirst(isset($_GET['halaman']) ? $_GET['halaman'] : "home");

$nm_halaman = explode('-', $halaman);
$jml = count($nm_halaman);
$nm_halaman = ($jml > 1) ? "$nm_halaman[0] $nm_halaman[1]" : $halaman;