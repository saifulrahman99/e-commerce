 <?php
    session_start();
    require_once '../../assets/basis/kon.php';
    require '../function/base_url.php';

    function rupiah($angka)
    {
        $hasil_rupiah = "Rp&nbsp" . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }
    ?>
 <div class="content">

     <!-- Animated -->
     <div class="animated fadeIn">

         <div class="row">

             <div class="col-lg-3 col-md-6">
                 <div class="card">
                     <div class="card-body">
                         <div class="stat-widget-five">
                             <div class="stat-icon dib flat-color-1">
                                 <i class="pe-7s-cash"></i>
                             </div>
                             <div class="stat-content">
                                 <div class="text-left dib">
                                     <?php
                                        $pendapatan = mysqli_fetch_assoc(mysqli_query($db, "SELECT SUM(biaya) as pendapatan FROM `transaksi` WHERE status_bayar = '1'"));
                                        ?>
                                     <div class="stat-text"><span class="count"><?= rupiah($pendapatan['pendapatan']) ?></span></div>
                                     <div class="stat-heading">Pendapatan</div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-3 col-md-6">
                 <div class="card">
                     <div class="card-body">
                         <div class="stat-widget-five">
                             <div class="stat-icon dib flat-color-2">
                                 <i class="pe-7s-cart"></i>
                             </div>
                             <div class="stat-content">
                                 <div class="text-left dib">
                                     <?php
                                        $penjualan = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(id_transaksi) as penjualan FROM `transaksi` WHERE status_bayar = '1'"));
                                        ?>
                                     <div class="stat-text"><span class="count"><?= $penjualan['penjualan'] ?></span></div>
                                     <div class="stat-heading">Penjualan</div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-3 col-md-6">
                 <div class="card">
                     <div class="card-body">
                         <div class="stat-widget-five">
                             <div class="stat-icon dib flat-color-4">
                                 <i class="pe-7s-user"></i>
                             </div>
                             <div class="stat-content">
                                 <div class="text-left dib">
                                     <?php
                                        $pembeli = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(DISTINCT id_pengunjung) as jml FROM transaksi WHERE status_bayar = '1'"));
                                        ?>
                                     <div class="stat-text"><span class="count"><?= $pembeli['jml'] ?></span></div>
                                     <div class="stat-heading">Pembeli</div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="col-lg-3 col-md-6">
                 <div class="card">
                     <div class="card-body">
                         <div class="stat-widget-five">
                             <div class="stat-icon dib flat-color-4">
                                 <i class="pe-7s-users"></i>
                             </div>
                             <div class="stat-content">
                                 <div class="text-left dib">
                                     <?php
                                        $pengunjung = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(`id_pengunjung`) as jml  FROM `pengunjung`"));
                                        ?>
                                     <div class="stat-text"><span class="count"><?= $pengunjung['jml'] ?></span></div>
                                     <div class="stat-heading">Pengunjung</div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="clearfix"></div>


         <div class="row">

             <!-- order -->
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                         <h4 class="box-title">Pesanan Yang Belum Dikirim </h4>
                     </div>
                     <div class="card-body">
                         <?php
                            $select = mysqli_query($db, "SELECT * FROM transaksi WHERE status_terkirim = '0' AND ORDER BY id_transaksi DESC");

                            ?>
                         <div class="table table-responsive">
                             <table class="table ">
                                 <thead>
                                     <tr>
                                         <th class="serial">#</th>
                                         <th>ID Order</th>
                                         <th>Nama</th>
                                         <th>Belanjaan</th>
                                         <th>Pembayaran</th>
                                         <th>Total</th>
                                         <th class="text-center">Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $no = 1;
                                        foreach ($select as $order) {
                                            $belanjaan = $order['belanjaan'];
                                            $belanjaan = json_decode($belanjaan);
                                        ?>
                                         <tr>
                                             <td class="serial"><?= $no++ ?></td>
                                             <td> <?= $order['order_id'] ?> </td>
                                             <td> <?= $order['nm_pembeli'] ?> </td>
                                             <td> <button type="button" data-toggle="modal" data-target="#detailModal<?= $order['id_transaksi'] ?>" class="btn btn-sm btn-light shadow-sm text-secondary">Lihat</button> </td>
                                             <td> <?= $order['metode_bayar'] ?> </td>
                                             <td> <?= rupiah($order['biaya']) ?> </td>
                                             <td class="text-center">
                                                 <button type="button" class="btn btn-sm btn-success mx-2" data-toggle="modal" data-target="#kirimPesanan<?= $order['order_id'] ?>">
                                                     Kirim Pesanan
                                                 </button>
                                             </td>


                                             <!-- Detail Belanjaan -->
                                             <div class="modal fade" id="detailModal<?= $order['id_transaksi'] ?>" tabindex="-1" aria-labelledby="detailModal<?= $order['id_transaksi'] ?>Label" aria-hidden="true">
                                                 <div class="modal-dialog modal-dialog-centered">
                                                     <div class="modal-content">
                                                         <div class="modal-body row">
                                                             <?php
                                                                foreach ($belanjaan as $id_item => $ket_item) {
                                                                    $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                                                                ?>

                                                                 <div class="col-12 item-produk my-1 pb-1 border-bottom">
                                                                     <div class="d-flex align-items-center">
                                                                         <a href="<?= base_url('../produk/lihat/' . $id_item) ?>" class="text-decoration-none">
                                                                             <img src="<?= (!empty($produk['gambar'])) ? base_url('../assets/img/produk/' . $produk['gambar']) : base_url('../assets/img/produk/default-produk.jpg') ?>" alt="..." style="width: 3rem; aspect-ratio: 1/1;" class="border rounded mb-1">
                                                                         </a>
                                                                         <h6 class="ml-2 mr-1 mb-0"><?= $produk['nm_produk'] ?></h6>
                                                                         <i class="ti-close mx-1" style="font-size: 0.5em;"></i>
                                                                         <span style="font-weight: 600;"><?= $ket_item[0] ?></span>
                                                                         <span>&nbsp<?= $produk['satuan'] ?></span>
                                                                     </div>
                                                                     <div class="text-end mt-2">
                                                                         <?php
                                                                            $totalHargaItem = $ket_item[1] * $ket_item[0];
                                                                            echo rupiah($totalHargaItem);
                                                                            ?>
                                                                     </div>
                                                                 </div>
                                                             <?php } ?>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- /Detail Belanjaan -->


                                             <!-- modal kirim pesanan -->
                                             <div class="modal fade" id="kirimPesanan<?= $order['order_id'] ?>" tabindex="-1" aria-labelledby="kirimPesanan<?= $order['order_id'] ?>Label" aria-hidden="true">
                                                 <div class="modal-dialog modal-dialog-centered">
                                                     <div class="modal-content">
                                                         <div class="modal-body">
                                                             <p class="text-dark">
                                                                 Yakin Untuk Kirim Pesanan Atas Nama <b><?= $order['nm_pembeli'] ?></b> ?
                                                             </p>
                                                         </div>
                                                         <div class="modal-footer">
                                                             <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                                                             <button type="button" class="btn btn-danger col-4" onclick="transaksi('<?= $order['order_id'] ?>','kirim')">Ya </button>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <!-- /modal kirim pesanan -->

                                         </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div> <!-- /.table-stats -->
                     </div>
                 </div> <!-- /.card -->
             </div> <!-- /.col-lg-8 -->
             <!-- /order -->


         </div>


         <div class="row">

             <!-- pengunjung  -->
             <div class="col-12 col-lg-6">
                 <div class="card">
                     <div class="card-body position-relative pb-0">
                         <h4 class="mb-3 box-title" style="overflow-y: auto;">Pengunjung Hari Ini</h4>
                         <?php
                            $today = date('Y-m-d');
                            $view_today = mysqli_query($db, "SELECT * FROM pengunjung WHERE waktu = '$today'");
                            $jml_p_now = mysqli_num_rows($view_today);
                            ?>
                         <p class="position-absolute" style="font-size: 0.8rem; top:1.4rem; right: 1rem;"><?= "Jumlah Pengunjung : $jml_p_now" ?></p>

                     </div>
                     <div class="table-stats order-table">
                         <table class="table ">
                             <thead>
                                 <tr>
                                     <th class="serial">#</th>
                                     <!-- <th class="avatar">Avatar</th> -->
                                     <th>IP Adress</th>
                                     <th>Browser</th>
                                     <th class="text-center">OS</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $no_pengunjung = 1;
                                    foreach ($view_today as $view) { ?>
                                     <tr>
                                         <td class="serial"><?= $no_pengunjung++ ?>.</td>
                                         <td> <?= $view['ip_address'] ?></td>
                                         <td> <?= $view['browser'] ?></td>
                                         <td class="text-center"> <?= $view['os'] ?> </td>
                                     </tr>
                                 <?php } ?>

                             </tbody>
                         </table>
                     </div>
                 </div><!-- /.card -->
             </div>
             <!-- /pengunjung -->

             <div class="col-lg-6">

                 <?php
                    $arr_os = array();
                    $os = mysqli_query($db, "SELECT DISTINCT os FROM `pengunjung`");
                    foreach ($os as $opsis) {
                        $nm_os = $opsis['os'];
                        array_push($arr_os, $nm_os);
                        $jml = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(os) as jml FROM `pengunjung` WHERE os = '$nm_os'"));
                    ?>
                     <input type="text" id="os<?= $opsis['os'] ?>" value="<?= $jml['jml'] ?>" hidden>
                 <?php } ?>
                 <div id="arr_os" style="display: none;"><?= json_encode($arr_os) ?></div>
                 <div class="card">
                     <div class="card-body">
                         <h4 class="mb-3 box-title">OS Pengunjung</h4>
                         <div class="flot-container">
                             <div id="flot-pie" class="flot-pie-container"></div>
                         </div>
                     </div>
                 </div><!-- /# card -->
             </div><!-- /# column -->

         </div>

         <!-- Scripts -->
         <script src="<?= base_url('assets/template/js/init/flot-chart-init.js') ?>"></script>

     </div>
     <!-- .animated -->
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>