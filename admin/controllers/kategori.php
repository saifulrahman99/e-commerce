<?php
require_once '../../assets/basis/kon.php';
$opsi = $_POST['opsi'];

if ($opsi == 'add') {
    $nm_kategori = $_POST['kategori'];
    $kode_kategori = $_POST['kode_kategori'];
    $insert = mysqli_query($db, "INSERT INTO kategori (kategori, kode_kategori) VALUES('$nm_kategori','$kode_kategori')");
} elseif ($opsi = 'delete') {
    $id_kategori = $_POST['id_kategori'];

    $delete = mysqli_query($db, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

    $jml = mysqli_fetch_assoc(mysqli_query($db, "SELECT MAX(id_kategori) as max FROM kategori"));
    // echo $jml['max'];

    $id = $jml['max'];
    $ai = $id + 1;
    // reset id auto incement
    mysqli_query($db, "ALTER TABLE kategori auto_increment = $ai");
}

echo $opsi;
