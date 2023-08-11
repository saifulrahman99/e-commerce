<?php
session_start();
require_once '../../assets/basis/kon.php';
require '../function/base_url.php';

$isi_pengaturan = serialize($_POST);


$jml_data = mysqli_num_rows(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_toko'"));

if ($jml_data < 1) {
    $aksi =  mysqli_query($db, "INSERT INTO pengaturan (nm_pengaturan, isi_pengaturan) VALUES ('data_toko','$isi_pengaturan')");
    
} else {
    $aksi = mysqli_query($db, "UPDATE pengaturan SET isi_pengaturan = '$isi_pengaturan' WHERE nm_pengaturan = 'data_toko'");

}

$_SESSION['hlmn_admin'] = 'toko';
header("Location: ".base_url('adastra'));