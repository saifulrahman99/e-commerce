<?php 
$id_pengunjung = $_POST['idC_pengunjung'];
setcookie('idC_pengunjung', $id_pengunjung, time() + (60 * 60 * 24 * 1), '/');