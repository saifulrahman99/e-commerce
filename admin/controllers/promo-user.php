<?php
session_start();
require_once '../../assets/basis/kon.php';
require_once '../function/base_url.php';
$opsi = (isset($_POST['opsi'])) ? $_POST['opsi'] : $_GET['opsi'];

if ($opsi == 'add') {
    $aksi = mysqli_query($db, "INSERT INTO promo_user (harga_promo_user,waktu_mulai,waktu_selesai,status,nomor_hp,id_produk,id_pengunjung)VALUES('" . $_POST['harga_promo'] . "','" . $_POST['waktu_mulai'] . "','" . $_POST['waktu_selesai'] . "','1','" . $_POST['nomor_hp'] . "','" . $_POST['id_produk'] . "','" . $_POST['id_pengunjung'] . "')");
} elseif ($opsi == 'update') {
    $aksi = mysqli_query($db, "UPDATE promo_user SET harga_promo_user = '" . $_POST['harga_promo'] . "',waktu_mulai = '" . $_POST['waktu_mulai'] . "',waktu_selesai = '" . $_POST['waktu_selesai'] . "',status = '" . $_POST['status'] . "',nomor_hp = '" . $_POST['nomor_hp'] . "',id_pengunjung = '" . $_POST['id_pengunjung'] . "' WHERE id_promo_user = '" . $_POST['id_promo_user'] . "'");
} elseif ($opsi == 'delete') {
    $aksi = mysqli_query($db, "DELETE FROM promo_user WHERE id_promo_user = '" . $_POST['id_promo_user'] . "'");
} elseif ($opsi == 'notif') {
    $nm_pembeli = $_POST['nm_pembeli'];
    $id_produk = $_POST['id_produk'];
    $nm_produk = $_POST['nm_produk'];
    $nomor_hp = $_POST['nomor_hp'];
    $harga_promo_user = $_POST['harga_promo_user'];
    $harga_normal = $_POST['harga_normal'];

    $selisih = $harga_normal - $harga_promo_user;
    $diskon = ($selisih / $harga_normal) * 100;

    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));

    $data = unserialize($select['isi_pengaturan']);
    $token_wa = $data['token_wa'];

    // notif
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target' => $nomor_hp . "|" . $nm_pembeli,
            'message' => '*SELAMAT ANDA MENDAPAT DISKON SPESIAL!*

Akun *{name}* Mendapatkan Diskon Produk ' . $nm_produk . ' sebesar ' . $diskon . '%,
Silahkan cek produk tertera pada link berikut.

https://technoyus.my.id/produk/lihat/' . $id_produk . '
',
            'countryCode' => '62', //optional
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token_wa //change TOKEN to your actual token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    // notif

    setcookie('pesan_notif', 'berhasil', time() + (10), '/');
}


$_SESSION['hlmn_admin'] = 'peruser';

header('location:' . base_url('adastra'));
