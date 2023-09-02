<?php
require_once '../../assets/basis/kon.php';

$tgl_now = date('d-m-Y');
// convert data ke bentuk excel
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Penjualan_" . $tgl_now . ".xls");

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
        <th>Modal</th>
        <th>Total</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $totalPendapatan = 0;
        $total_modal = 0;
        foreach ($order as $o) {
            $belanjaan = json_decode($o['belanjaan']);
            $modal = 0;
            foreach ($belanjaan as $key => $value) {
                $harga = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$key'"));

                $modal = $modal + $harga['harga_pokok'];
            }
        ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $o['order_id'] ?></td>
                <td><?= $o['waktu_transaksi'] ?></td>
                <td><?= $o['nm_pembeli'] ?></td>
                <td><?= $o['alamat'] ?></td>
                <td style="text-align: center;"><?= $o['nomor_hp'] ?></td>
                <td><?= 'IDR' ?></td>
                <td><?= $modal ?></td>
                <td style="background-color: <?= ($modal > $o['biaya']) ? 'red' : '' ?>;"><?= $o['biaya'] ?></td>
            </tr>
        <?php
            $total_modal = $total_modal + $modal;
            $totalPendapatan = $totalPendapatan + $o['biaya'];
        } ?>
        <tr>
            <td colspan="9">&nbsp</td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td>TOTAL MODAL</td>
            <td style="text-align: center;">:</td>
            <td><?= rupiah($total_modal) ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td>TOTAL PENDAPATAN KOTOR</td>
            <td style="text-align: center;">:</td>
            <td></td>
            <td><?= rupiah($totalPendapatan) ?></td>
        </tr>
        <tr>
            <td colspan="5"></td>
            <td>LABA/KEUNTUNGAN</td>
            <td style="text-align: center;">:</td>
            <td colspan="2" style="text-align: center;"><?= rupiah(($totalPendapatan - $total_modal)) ?></td>
        </tr>
    </tbody>
</table>

</html>