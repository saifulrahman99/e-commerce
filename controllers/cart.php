<?php
require('../assets/basis/kon.php');
session_start();

if ($_POST['opsi'] == 'direct') {

    $qty = 1;
    $id_produk = $_POST['id_produk'];

    $harga = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_pokok,harga_jual FROM produk WHERE id_produk = '$id_produk'"));

    if (isset($_POST['qty'])) {
        $qty = max($_POST['qty'], 1);
    }

    if (!isset($_SESSION['keranjang'])) {
        $_SESSION['keranjang'] = [];
    }

    if (!isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk][0] = $qty;
        $_SESSION['keranjang'][$id_produk][1] = $harga['harga_jual'];
    } else {
        $_SESSION['keranjang'][$id_produk][0] += $qty;
    }
} elseif ($_POST['opsi'] == 'hapus') {

    $id_produk = $_POST['id_produk'];
    unset($_SESSION['keranjang'][$id_produk]);
    $jmlData = count($_SESSION['keranjang']);
} elseif ($_POST['opsi'] == 'lihat') {

    $qty = $_POST['jml-item'];
    $id_produk = $_POST['id_produk'];

    $harga = mysqli_fetch_assoc(mysqli_query($db, "SELECT harga_pokok,harga_jual FROM produk WHERE id_produk = '$id_produk'"));

    if (!isset($_SESSION['keranjang'][$id_produk])) {
        $_SESSION['keranjang'][$id_produk][0] = $qty;
        $_SESSION['keranjang'][$id_produk][1] = $harga['harga_jual'];
    } else {

        $_SESSION['keranjang'][$id_produk][0] += $qty;

        $jumlah_item = $_SESSION['keranjang'][$id_produk][0];

        $stok = mysqli_fetch_assoc(mysqli_query($db, "SELECT stok FROM produk WHERE id_produk = '$id_produk'"));

        if ($jumlah_item > $stok['stok']) {
            $_SESSION['keranjang'][$id_produk][0] = $stok['stok'];
        }
    }
} elseif ($_POST['opsi'] == 'update') {
    foreach ($_POST['qty'] as $id => $jumlah) {
        $_SESSION['keranjang'][$id][0] = max($jumlah, 1);
    }
?>
    <script type="text/javascript">
        window.location.href = '../keranjang';
    </script>
<?php } ?>