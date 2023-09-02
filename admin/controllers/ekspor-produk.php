<?php
require_once '../../assets/basis/kon.php';
require '../function/base_url.php';


$tgl_now = date('d-m-Y');
$full_tgl = date('d-m-Y h:i:sa');
// convert data ke bentuk excel
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Produk_" . $tgl_now . ".xls");

$select = mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY stok ASC");

?>
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ekspor Produk</title>
    <style>
        td {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Data Produk Butik Buah Adastra Per Tanggal <?= $full_tgl ?></h1>
    <table border="1">
        <thead>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Merk</th>
            <th>Satuan</th>
            <th>Jenis</th>
            <th>Harga Pokok</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Kode Gudang</th>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($select as $p) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="text-align: left;"><?= $p['kode_produk'] ?></td>
                    <td style="text-align: left;"><?= $p['nm_produk'] ?></td>
                    <td><?= $p['merek'] ?></td>
                    <td><?= $p['satuan'] ?></td>
                    <td><?= $p['kategori'] ?></td>
                    <td><?= $p['harga_pokok'] ?></td>
                    <td><?= $p['harga_jual'] ?></td>
                    <td><?= $p['stok'] ?></td>
                    <td><?= $p['kode_gudang'] ?></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
</body>

</html>