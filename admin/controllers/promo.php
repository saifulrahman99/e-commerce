<?php
require_once '../../assets/basis/kon.php';
$opsi = (isset($_POST['opsi'])) ? $_POST['opsi'] : $_GET['opsi'];


if ($opsi == 'add') {

    $id_produk = isset($_POST['id_produk']) ? $_POST['id_produk'] : '';
    $id_produk = empty($id_produk) ? 0 : $id_produk;
    $nm_promo = isset($_POST['nama_promo']) ? $_POST['nama_promo'] : '';
    $harga_promo = isset($_POST['harga_promo']) ? $_POST['harga_promo'] : '';
    $harga_promo = empty($harga_promo) ? 0 : $harga_promo;
    $waktu_mulai = isset($_POST['waktu_mulai']) ? $_POST['waktu_mulai'] : '';
    $waktu_selesai = isset($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $status = 1;
    $pathPromo = "../../assets/img/promo/";

    $gambar = $_FILES['gambar'];

    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar['name'])) {
        $filepathPromo = $pathPromo . $gambar['name'];

        if (!file_exists($filepathPromo)) {
            $upload_gambar = move_uploaded_file($gambar_tmp, $filepathPromo);
        } else {
            unlink($filepathPromo);
            $upload_gambar = move_uploaded_file($gambar_tmp, $filepathPromo);
        }
        $gambar = $gambar['name'];
    }

    $query = "INSERT INTO promo(nm_promo, harga_promo, waktu_mulai, waktu_selesai, gambar, status,keterangan, id_produk) VALUES ('$nm_promo', '$harga_promo', '$waktu_mulai', '$waktu_selesai', '$gambar', '$status', '$keterangan', '$id_produk')";
    $eksekusi = mysqli_query($db, $query);
} elseif ($opsi == 'update') {

    $id_promo = isset($_POST['id_promo']) ? $_POST['id_promo'] : '';
    $nm_promo = isset($_POST['nama_promo']) ? $_POST['nama_promo'] : '';
    $harga_promo = isset($_POST['harga_promo']) ? $_POST['harga_promo'] : '';
    $harga_promo = empty($harga_promo) ? 0 : $harga_promo;
    $waktu_mulai = isset($_POST['waktu_mulai']) ? $_POST['waktu_mulai'] : '';
    $waktu_selesai = isset($_POST['waktu_selesai']) ? $_POST['waktu_selesai'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    $pathPromo = "../../assets/img/promo/";

    $gambar = $_FILES['gambar'];


    $gambar_tmp = $_FILES['gambar']['tmp_name'];


    if (!empty($gambar['name'])) {
        $filepathPromo = $pathPromo . $gambar['name'];

        if (!file_exists($filepathPromo)) {
            $upload_gambar = move_uploaded_file($gambar_tmp, $filepathPromo);
        } else {
            unlink($filepathPromo);
            $upload_gambar = move_uploaded_file($gambar_tmp, $filepathPromo);
        }
        $gambar = $gambar['name'];

        $query = "UPDATE promo SET nm_promo='$nm_promo',harga_promo='$harga_promo',waktu_mulai='$waktu_mulai',waktu_selesai='$waktu_selesai',gambar='$gambar',status='$status',ketterangan = '$keterangan' WHERE id_promo = '$id_promo'";
    } else {
        $query = "UPDATE promo SET nm_promo='$nm_promo',harga_promo='$harga_promo',waktu_mulai='$waktu_mulai',waktu_selesai='$waktu_selesai',status='$status',keterangan = '$keterangan' WHERE id_promo = '$id_promo'";
    }
    $eksekusi = mysqli_query($db, $query);
} elseif ($opsi == 'delete') {
    $id = $_POST['id_promo'];
    $query = "DELETE FROM promo WHERE id_promo = '$id'";
    $eksekusi = mysqli_query($db, $query);

    $jml = mysqli_fetch_assoc(mysqli_query($db, "SELECT MAX(id_promo) as max FROM promo"));

    $id = $jml['max'];
    $ai = $id + 1;
    // reset id auto incement
    mysqli_query($db, "ALTER TABLE promo auto_increment = $ai");
}

echo $opsi;
