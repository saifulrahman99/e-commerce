<?php
require_once '../../assets/basis/kon.php';

// convert data ke bentuk excel
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan" . $tgl_now . ".xls");

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function bulan($bulan)
{
    switch ($bulan) {
        case '1':
            $hasil = 'Januari';
            break;
        case '2':
            $hasil = 'Februari';
            break;
        case '3':
            $hasil = 'Maret';
            break;
        case '4':
            $hasil = 'April';
            break;
        case '5':
            $hasil = 'Mei';
            break;
        case '6':
            $hasil = 'Juni';
            break;
        case '7':
            $hasil = 'Juli';
            break;
        case '8':
            $hasil = 'Agustus';
            break;
        case '9':
            $hasil = 'September';
            break;
        case '10':
            $hasil = 'Oktober';
            break;
        case '11':
            $hasil = 'November';
            break;
        case '12':
            $hasil = 'Desember';
            break;
    }
    return $hasil;
}
$tgl_now = date('d-m-Y');

$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];

$order = mysqli_query($db, "SELECT * FROM `transaksi` WHERE status_bayar = '1' AND waktu_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_transaksi ASC");

$bln_awal = explode('-', $tgl_awal);
$bln_akhir = explode('-', $tgl_akhir);

?>

<html>
<h1>Laporan Penjualan Periode Tanggal <?= $bln_awal[2] . " " . bulan($bln_awal[1]) . " " . $bln_awal[0] ?> Hingga <?= $bln_akhir[2] . " " . bulan($bln_akhir[1]) . " " . $bln_akhir[0] ?></h1>
<table border="1">
    <thead>
        <th>No</th>
        <th>ID Order</th>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Nomor Telpon</th>
        <th>Mata Uang</th>
        <th>Total</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $totalPendapatan = 0;
        foreach ($order as $o) {
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $o['order_id'] ?></td>
                <td><?= $o['waktu_transaksi'] ?></td>
                <td><?= $o['nm_pembeli'] ?></td>
                <td><?= $o['alamat'] ?></td>
                <td><?= $o['nomor_hp'] ?></td>
                <td><?= 'IDR' ?></td>
                <td><?= $o['biaya'] ?></td>
            </tr>
        <?php
            $totalPendapatan = $totalPendapatan + $o['biaya'];
        } ?>
    </tbody>
</table>

<h2>TOTAL PENDAPATAN : <?= rupiah($totalPendapatan) ?></h2>

</html>