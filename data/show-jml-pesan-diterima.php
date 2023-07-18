<?php
require_once '../assets/basis/kon.php';

$id_pengunjung = $_COOKIE['id_pengunjung'];

$total_pesan = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(status_terbaca) as jml_pesan FROM obrolan WHERE status_terbaca = '0' AND pengirim != '$id_pengunjung' AND id_pengunjung='$id_pengunjung'"));
?>
<!-- jml pesan baru -->
<input type="text" id="total_pesan_diterima" value="<?= $total_pesan['jml_pesan'] ?>" hidden>
<!-- jml pesan baru -->