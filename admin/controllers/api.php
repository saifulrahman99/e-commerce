<?php
require_once '../../assets/basis/kon.php';

$isi_pengaturan = serialize($_POST);

$jml_data = mysqli_num_rows(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));

if ($jml_data < 1) {
    $aksi =  mysqli_query($db, "INSERT INTO pengaturan (nm_pengaturan, isi_pengaturan) VALUES ('data_api','$isi_pengaturan')");
} else {
    $aksi = mysqli_query($db, "UPDATE pengaturan SET isi_pengaturan = '$isi_pengaturan' WHERE nm_pengaturan = 'data_api'");
}

?>