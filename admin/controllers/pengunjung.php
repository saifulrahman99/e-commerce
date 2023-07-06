<?php
require_once '../../assets/basis/kon.php';

$id_pengunjung = $_POST['id_pengunjung'];

mysqli_query($db,"DELETE FROM pengunjung WHERE id_pengunjung ='$id_pengunjung'");
