<?php
$end_promo = mysqli_query($db, "SELECT * FROM promo");
foreach ($end_promo as $val) {

    $id_promo = $val['id_promo'];
    $waktuSelesai = strtotime($val['waktu_selesai']);
    $timeNow = strtotime(date("Y-m-d H:i"));

    if ($timeNow > $waktuSelesai) {
        mysqli_query($db, "UPDATE promo SET status = '0' WHERE id_promo = '$id_promo'");
    }
}
