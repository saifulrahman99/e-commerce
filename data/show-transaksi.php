 <?php
    session_start();
    require('../assets/basis/kon.php');
    require('../function.php');

    // $id_pengunjung = $_SESSION['id_pengunjung'];
    $id_pengunjung = $_COOKIE['id_pengunjung'];


    $select_transaksi = mysqli_query($db, "SELECT * FROM transaksi WHERE id_pengunjung='$id_pengunjung' ORDER BY id_transaksi DESC");
    $jml_data_transaksi = mysqli_num_rows($select_transaksi);

    if ($jml_data_transaksi < 1) { ?>
     <div class="text-center">
         <!-- Kamu Belum Pernah Melakukan Transaksi -->
         <img class="mt-2" src="<?= base_url('assets/img/transaksi.gif') ?>" alt="..." style="max-width: 350px;">
         <h4 class="tebal-600 m-0 bg-white">Riwayat Transaksi Tidak Ditemukan</h4>
     </div>
     <div style='margin-bottom: 8rem;'></div>

     <?php } else {

        $jml_data_ada_harga = 0;

        foreach ($select_transaksi as $sk) {
            $belanjaan = $sk['belanjaan'];
            $belanjaan = json_decode($belanjaan);
            // $convert_obj = (array)$belanjaan;
            foreach ($belanjaan as $k => $v) {
                $data_belanja = $v;
            }
            $ket_harga = (isset($data_belanja[1])) ? "Ada" : "Tidak Ada";


            if ($ket_harga == 'Ada') {

                if ($sk['status_bayar'] == 0) {
                    $statusBayar = "pending";
                    $btnStatus = "accordion-button-pending";
                    $ketBayar = "Belum Dibayar";
                } elseif ($sk['status_bayar'] == 1) {
                    $statusBayar = "sukses";
                    $btnStatus = "accordion-button-sukses";
                    $ketBayar = "Sudah Dibayar";
                } elseif ($sk['status_bayar'] == 2) {
                    $statusBayar = "gagal";
                    $btnStatus = "accordion-button-gagal";
                    $ketBayar = "Dibatalkan";
                }
                $tgl_bayar = explode(' ', $sk['waktu_bayar']);
                $tgl_hari = $tgl_bayar[0];

                $tgl_bayar = explode('-', $tgl_bayar[0]);
                $tgl_bayar = "$tgl_bayar[2]-$tgl_bayar[1]-$tgl_bayar[0]";
                $today = date('d-m-Y');

                if ($tgl_bayar == $today) {
                    $label_tanggal = 'Hari ini';
                } else {
                    $label_tanggal = $tgl_bayar;

                    $tanggal = $tgl_hari;
                    $day = date('D', strtotime($tanggal));
                    $dayList = array(
                        'Sun' => 'Minggu',
                        'Mon' => 'Senin',
                        'Tue' => 'Selasa',
                        'Wed' => 'Rabu',
                        'Thu' => 'Kamis',
                        'Fri' => 'Jumat',
                        'Sat' => 'Sabtu'
                    );
                    $label_tanggal_hari = "$dayList[$day],";
                }

                if ($label_tanggal != $label_tgl_sebelumnya) {

        ?>
                 <label class="tebal-700 mt-5 mb-2">
                     <?= "$label_tanggal_hari $label_tanggal" ?>
                 </label>
             <?php
                    $label_tgl_sebelumnya = $label_tanggal;
                }


                ?>
             <div class="accordion-item mb-2" style="border: none !important;">
                 <h2 class="accordion-header">
                     <button class="accordion-button collapsed border rounded-top row m-0 position-relative <?= $btnStatus ?>" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse<?= $sk['id_transaksi'] ?>" aria-expanded="false" aria-controls="flush-collapse<?= $sk['id_transaksi'] ?>" style="z-index:0;">
                         <?php
                            $nm_transaksi = '';
                            foreach ($belanjaan as $id_item => $jml_item) {
                                $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                                $nmProduk = $produk['nm_produk'];
                                $nm_transaksi .= "$nmProduk, ";
                            }
                            ?>

                         <div class="p-0 mb-2 fw-bolder">
                             <?= substr($nm_transaksi, 0, -2) ?>
                         </div>
                         <div class="p-0">
                             <i data-feather="clock" style="width: 0.8rem;"> </i>
                             <span style="font-size: 0.7rem;"> <?= $sk['waktu_bayar'] ?> </span>
                         </div>
                         <?php

                            ?>
                         <span class="status-pembayaran position-absolute <?= $statusBayar ?>"><?= $ketBayar ?></span>

                     </button>
                 </h2>
                 <div id="flush-collapse<?= $sk['id_transaksi'] ?>" class="accordion-collapse collapse" data-bs-parent="#accordionTransaksi">
                     <div class="accordion-body border rounded-bottom">

                         <div>
                             ID Order : <span class="text-ijo tebal-600"><?= $sk['order_id'] ?></span>
                         </div>

                         <div class="my-1">
                             Metode Pembayaran (<?= $sk['metode_bayar'] ?>)
                         </div>

                         <div class="tebal-700 border-top pt-2 pb-1">Daftar Belanjaan</div>

                         <div class="row pb-2">
                             <?php
                                foreach ($belanjaan as $id_item => $ket_item) {
                                    $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE id_produk = '$id_item'"));
                                ?>

                                 <div class="col-12 col-md-4 item-produk my-1 pb-1 border-bottom">
                                     <div class="d-flex align-items-center">
                                         <a href="<?= base_url('produk/lihat/' . $id_item) ?>" class="text-decoration-none">
                                             <img src="<?= base_url('assets/img/produk/'.$produk['gambar']) ?>" alt="..." style="width: 3rem; aspect-ratio: 1/1;" class="border rounded mb-1">
                                         </a>
                                         <h6 class="ms-2 me-1 mb-0"><?= $produk['nm_produk'] ?></h6>
                                         <i data-feather="x" class="me-1" style="width: 0.8rem;"></i>
                                         <span><?= $ket_item[0] ?></span>
                                     </div>
                                     <div class="tebal-500 text-end">
                                         <?php
                                            $totalHargaItem = $ket_item[1] * $ket_item[0];
                                            echo rupiah($totalHargaItem);
                                            ?>
                                     </div>
                                 </div>
                             <?php } ?>
                         </div>
                         <div class="row mt-2 pb-2">
                             <div class="col-6 tebal-700">
                                 Total Pesanan
                             </div>
                             <div class="col-6 tebal-700 text-end">
                                 <?= rupiah($sk['biaya']) ?>
                             </div>
                         </div>

                         <?php
                            if ($ketBayar == "Belum Dibayar") { ?>
                             <div class="tombol-aksi-transaksi py-2 text-end border-top">

                                 <a href="transaksi/bayarlagi/<?= $sk['snap_token'] ?>" type="button" class="btn btn-ijo text-white me-2">Bayar</a>

                                 <?php
                                    if (!empty($sk['metode_bayar'])) { ?>
                                     <a href="transaksi/batalkanbayar/<?= $sk['order_id'] ?>" type="button" class="btn btn-danger">Batalkan Transaksi</a>

                                 <?php } ?>
                             </div>
                         <?php } ?>

                     </div>
                 </div>
             </div>

         <?php
                $jml_data_ada_harga++;
            }
        }
        if ($jml_data_ada_harga < 1) { ?>
         <div class="text-center">
             <!-- Kamu Belum Pernah Melakukan Transaksi -->
             <img class="mt-2" src="<?= base_url('assets/img/transaksi.gif') ?>" alt="..." style="max-width: 350px;">
             <h4 class="tebal-600 m-0 bg-white">Riwayat Transaksi Tidak Ditemukan</h4>
         </div>
         <div style='margin-bottom: 8rem;'></div>
     <?php }

        if ($jml_data_transaksi == 1) { ?>
         <div class="spasi-bawah"></div>
     <?php } else { ?>
         <div class="spasi-header">
         <?php } ?>
     <?php }

        ?>

     <script src="https://unpkg.com/feather-icons"></script>
     <script>
         feather.replace()
     </script>