<?php
function base_url($file = NULL)
{
    // online
    $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/";
    // offline
    // $path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "/e-commerce" . "/";

    $path .= $file;
    return $path;
}

// function
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function kodeRandom($panjang)
{
    $karakter = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
        $pos = rand(0, strlen($karakter) - 1);
        $string .= $karakter{
            $pos};
    }
    return $string;
}

function cek_diskon($id)
{
    $db = mysqli_connect("localhost", "saiz5787_adastra", "adastra5787", "saiz5787_adastra");
    $harga_jual = '';

    $query_promoAll = "SELECT * FROM promo WHERE id_produk = '0' AND status = '1'";
    // cek promo untuk all produk
    $promoAll = mysqli_num_rows(mysqli_query($db, $query_promoAll));

    if ($promoAll > 0) {
        // promo kembali ke harga pokok
        $data_harga = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id'"));

        $data_waktu = mysqli_fetch_assoc(mysqli_query($db, $query_promoAll));
        $waktu_mulai = strtotime($data_waktu['waktu_mulai']);
        $waktu_selesai = strtotime($data_waktu['waktu_selesai']);

        $timeNow = strtotime(date("Y-m-d H:i"));

        if ($waktu_mulai <= $timeNow && $waktu_selesai >= $timeNow) {
            // tentukan harga
            $harga_jual = $data_harga['harga_pokok'];
        }
    }

    $query_promo = "SELECT * FROM promo INNER JOIN produk ON promo.id_produk = produk.id_produk WHERE promo.id_produk = '$id' AND status ='1'";

    $jmlPromo = mysqli_num_rows(mysqli_query($db, $query_promo));

    if ($jmlPromo > 0) {
        // promo spesial
        $data_harga = mysqli_fetch_assoc(mysqli_query($db, $query_promo));

        $waktuP_mulai = strtotime($data_harga['waktu_mulai']);
        $waktuP_selesai = strtotime($data_harga['waktu_selesai']);
        $timeNow = strtotime(date("Y-m-d H:i"));


        if ($waktuP_mulai <= $timeNow && $waktuP_selesai >= $timeNow) {
            // tentukan harga
            $harga_jual = $data_harga['harga_promo'];

            if ($harga_jual == 0) {
                $harga_jual = $data_harga['harga_pokok'];
            }
        }
    }

    if (isset($_COOKIE['id_pengunjung']) && !empty($_COOKIE['id_pengunjung'])) {
        $id_pengunjung = $_COOKIE['id_pengunjung'];
        $query_promo_user = "SELECT * FROM promo_user INNER JOIN produk ON promo_user.id_produk = produk.id_produk WHERE promo_user.id_produk = '$id' AND id_pengunjung = '$id_pengunjung' AND status = '1'";

        $jmlPromoUser = mysqli_num_rows(mysqli_query($db, $query_promo_user));

        if ($jmlPromoUser > 0) {
            $data_harga_promo_user = mysqli_fetch_assoc(mysqli_query($db, $query_promo_user));
            $waktuP_mulai = strtotime($data_harga_promo_user['waktu_mulai']);
            $waktuP_selesai = strtotime($data_harga_promo_user['waktu_selesai']);
            $timeNow = strtotime(date("Y-m-d H:i"));

            if ($waktuP_mulai <= $timeNow && $waktuP_selesai >= $timeNow) {
                // tentukan harga
                $harga_jual = $data_harga_promo_user['harga_promo_user'];

                if ($harga_jual == 0) {
                    $harga_jual = $data_harga['harga_pokok'];
                }
            }
        }
    }

    return $harga_jual;
}

$halaman = ucfirst(isset($_GET['halaman']) ? $_GET['halaman'] : "home");

$nm_halaman = explode('-', $halaman);
$jml = count($nm_halaman);
$nm_halaman = ($jml > 1) ? "$nm_halaman[0] $nm_halaman[1]" : $halaman;
