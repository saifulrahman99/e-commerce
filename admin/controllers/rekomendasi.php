<?php
require_once('../../assets/basis/kon.php');

$list_kode = $_POST['kode'];

$cek = mysqli_num_rows(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'rekomendasi'"));

if ($cek > 0) {
    mysqli_query($db, "UPDATE pengaturan SET isi_pengaturan ='$list_kode' WHERE nm_pengaturan = 'rekomendasi'");
} else {
    mysqli_query($db, "INSERT INTO pengaturan (nm_pengaturan,isi_pengaturan) VALUES ('rekomendasi','$list_kode')");
}
