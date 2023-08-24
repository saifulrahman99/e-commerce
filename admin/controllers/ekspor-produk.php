<?php
require_once '../../assets/basis/kon.php';

// convert data ke bentuk excel
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Produk" . $tgl_now . ".xls");

?>