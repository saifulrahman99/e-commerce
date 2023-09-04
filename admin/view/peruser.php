 <?php
    require_once '../../assets/basis/kon.php';
    require '../function/base_url.php';
    $select = mysqli_query($db, "SELECT * FROM promo ORDER BY id_promo DESC");
    ?>
 <div class=" breadcrumbs">
     <div class="breadcrumbs-inner">
         <div class="row m-0">
             <div class="col-12">
                 <div class="page-header float-left">
                     <div class="page-title">
                         <h1>Halaman Promo Per User</h1>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="content pb-1">
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body">

                     <div class="button mb-3 d-flex flex-wrap">

                         <!-- Button trigger modal -->
                         <button type="button" class="btn btn-success btn-sm mr-1 my-1" data-toggle="modal" data-target="#tambahPromoUser">
                             <i class="ti-plus"></i>
                             tambah promo
                         </button>

                         <button type="button" class="btn btn-success btn-sm mr-1 my-1" data-toggle="modal" data-target="#listPembeli">
                             <i class="ti-eye"></i>
                             Lihat Daftar Pembeli
                         </button>

                         <button id="reload-peruser" class="btn btn-success btn-sm ml-2 my-1"><i class="ti-reload"></i> Refrash</button>
                         <!-- /button trigger -->

                     </div>

                     <table id="tabel-promo-user" class="table table-striped">
                         <thead>
                             <th>#</th>
                             <th>Nama</th>
                             <th>Nomor</th>
                             <th>Nama Produk</th>
                             <th>Harga Promo</th>
                             <th>Waktu</th>
                             <th>Status</th>
                             <th>Aksi</th>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                $promo = mysqli_query($db, "SELECT * FROM promo_user INNER JOIN produk ON promo_user.id_produk = produk.id_produk");
                                foreach ($promo as $pu) {

                                    $nama = mysqli_fetch_assoc(mysqli_query($db, "SELECT nm_pembeli,id_transaksi FROM transaksi WHERE id_pengunjung = '" . $pu['id_pengunjung'] . "' ORDER BY id_transaksi DESC"));
                                ?>
                                 <tr>
                                     <td><?= $no++ ?></td>
                                     <td><?= $nama['nm_pembeli'] ?></td>
                                     <td><?= $pu['nomor_hp'] ?></td>
                                     <td><?= $pu['nm_produk'] ?></td>
                                     <td><?= ($pu['harga_promo_user'] == '0') ? 'harga pokok' : $pu['harga_promo_user'] ?></td>
                                     <td><?= $pu['waktu_mulai'] ?> sampai <?= $pu['waktu_selesai'] ?></td>
                                     <td><?= ($pu['status'] == '1') ? "<span class=\"badge badge-success\">Hidup</span>" : "<span class=\"badge badge-danger\">Mati</span>" ?></td>
                                     <td>
                                         <button type="button" class="btn btn-sm btn-info my-1" data-toggle="modal" data-target="#editPromoUser<?= $pu['id_promo_user'] ?>"><i class="ti ti-pencil"></i> edit</button>
                                         <button type="button" class="btn btn-sm btn-danger my-1" data-toggle="modal" data-target="#hapusPromoUser<?= $pu['id_promo_user'] ?>"><i class="ti ti-trash"></i> hapus</button>

                                         <form action="<?= base_url('controllers/promo-user.php') ?>" method="post">
                                             <input type="text" name="opsi" value="notif" hidden>
                                             <input type="text" name="id_produk" value="<?= $pu['id_produk'] ?>" hidden>
                                             <input type="text" name="nm_produk" value="<?= $pu['nm_produk'] ?>" hidden>
                                             <input type="text" name="nm_pembeli" value="<?= $nama['nm_pembeli'] ?>" hidden>
                                             <input type="text" name="nomor_hp" value="<?= $pu['nomor_hp'] ?>" hidden>
                                             <input type="text" name="harga_promo_user" value="<?= $pu['harga_promo_user'] ?>" hidden>
                                             <input type="text" name="harga_normal" value="<?= $pu['harga_jual'] ?>" hidden>
                                             <button type="sumbit" class="btn btn-sm btn-warning text-white my-1"><i class="ti ti-bell"></i> Push</button>
                                         </form>
                                     </td>
                                 </tr>

                             <?php } ?>
                         </tbody>
                     </table>


                 </div>
             </div>
         </div>
     </div>
 </div>

 <!-- Modal tambah promo -->
 <div class="modal fade" id="tambahPromoUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahPromoUserLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form action="<?= base_url('controllers/promo-user.php') ?>" id="form-tambah-data-promo-user" method="post" enctype="multipart/form-data">

                 <div class="modal-header">
                     <h5 class="modal-title" id="tambahPromoUserLabel">Tambah Promo</h5>
                 </div>

                 <div class="modal-body row">
                     <input type="text" name="opsi" value="add" hidden>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="id_pengunjung" class="mb-1">ID Pengunjung</label>
                         <input type="text" name="id_pengunjung" class="form-control" id="id_pengunjung" required />
                     </div>

                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="nomor_hp" class="mb-1">Nomor Handpone</label>
                         <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" required />
                     </div>

                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="search-input-promo" class="mb-1">ID Produk</label>
                         <span class="text-danger d-block" style="font-size: 0.6em;">*cari by nama atau kode</span>
                         <input type="text" name="id_produk" class="form-control" id="search-input-promo" required />

                         <div id="display-hasil-search" class=""></div>
                     </div>

                     <div class="form-group col-12 col-md-6">
                         <label for="jenis_promo" class="mb-1">jenis Promo</label>
                         <span class="d-block" style="font-size: 0.6em;">&nbsp</span>
                         <select id="value-jenis-promo" class="custom-select mr-sm-2">
                             <option value="harga pokok" selected> Harga Pokok </option>
                             <option value="custom"> Custom </option>
                         </select>
                     </div>

                     <div id="form-group-harga-promo" class="mb-2 col-12 col-md-6">
                         <label for="input_harga_promo" class="mb-1">Harga promo</label>
                         <input type="text" name="harga_promo" class="form-control" id="input_harga_promo" />
                     </div>

                     <div class="form-group mb-2 col-12">
                         <label>Waktu Promo</label>
                         <div class="row align-items-center">
                             <div class="col-12 col-md-5 pr-md-0">
                                 <input type="datetime-local" name="waktu_mulai" class="form-control" required>
                             </div>
                             <div class="col-2 px-md-0 text-center">
                                 Sampai
                             </div>
                             <div class="col-12 col-md-5 pl-md-0">
                                 <input type="datetime-local" name="waktu_selesai" class="form-control" required>
                             </div>

                         </div>
                     </div>

                 </div>

                 <div class="modal-footer flex-column-reverse flex-md-row">
                     <div class="col-12 col-md-5 mb-2">
                         <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">Kembali</button>
                     </div>
                     <div class="col-12 col-md-5 mb-3 mb-md-2">
                         <button type="submit" class="btn btn-success m-0">Simpan</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- /Modal tambah promo -->

 <!--daftar Pembeli -->
 <div class="modal fade" id="listPembeli" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="listPembeliLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-scrollable modal-md">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="listPembeliLabel">Data Pembeli</h5>
             </div>
             <div class="modal-body">
                 <table id="tabel-pembeli" class="table table-striped" style="width: 100%;">
                     <thead>
                         <th>ID Pembeli</th>
                         <th>No.Telp</th>
                         <th>Jml Order</th>
                     </thead>
                     <tbody>
                         <?php
                            $pembeli = mysqli_query($db, "SELECT DISTINCT id_pengunjung, nomor_hp FROM `transaksi` ORDER BY waktu_transaksi ASC");

                            foreach ($pembeli as $beli) {

                                $_SESSION['pembeli'][$beli['id_pengunjung']] = $beli['nomor_hp'];
                            }

                            $no = 1;
                            foreach ($_SESSION['pembeli'] as
                                $key => $value) {

                                $jml = mysqli_fetch_assoc(mysqli_query($db, "SELECT count(id_pengunjung) as jml FROM transaksi WHERE id_pengunjung = '$key'"));
                            ?>
                             <tr>
                                 <td><?= $key ?></td>
                                 <td><?= $value ?></td>
                                 <td><?= $jml['jml'] ?></td>
                             </tr>
                         <?php } ?>
                     </tbody>
                 </table>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
 <!--/daftar Pembeli -->


 <?php
    $no = 1;
    $promo = mysqli_query($db, "SELECT * FROM promo_user INNER JOIN produk ON promo_user.id_produk = produk.id_produk");
    foreach ($promo as $pu) {

        $nama = mysqli_fetch_assoc(mysqli_query($db, "SELECT nm_pembeli,id_transaksi FROM transaksi WHERE id_pengunjung = '" . $pu['id_pengunjung'] . "' ORDER BY id_transaksi DESC"));
    ?>
     <!-- edit -->
     <div class="modal fade" id="editPromoUser<?= $pu['id_promo_user'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editPromoUser<?= $pu['id_promo_user'] ?>Label" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <form action="<?= base_url('controllers/promo-user.php') ?>" id="form-edit-data-promo-user<?= $pu['id_promo_user'] ?>" method="post">

                     <div class="modal-header">
                         <h5 class="modal-title" id="editPromoUser<?= $pu['id_promo_user'] ?>Label">Edit Promo <?= $pu['nm_produk'] . " (" . $nama['nm_pembeli'] . ")" ?></h5>
                     </div>

                     <div class="modal-body row">
                         <input type="text" name="opsi" value="update" hidden>
                         <input type="text" name="id_promo_user" value="<?= $pu['id_promo_user'] ?>" hidden>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="id_pengunjung" class="mb-1">ID Pengunjung</label>
                             <input type="text" name="id_pengunjung" class="form-control" id="id_pengunjung" value="<?= $pu['id_pengunjung'] ?>" required />
                         </div>

                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="nomor_hp" class="mb-1">Nomor Handpone</label>
                             <input type="text" name="nomor_hp" class="form-control" id="nomor_hp" value="<?= $pu['nomor_hp'] ?>" required />
                         </div>

                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="search-input-promo" class="mb-1">ID Produk</label>
                             <span class="text-danger d-block" style="font-size: 0.6em;">*cari by nama atau kode</span>
                             <input type="text" name="id_produk" class="form-control" id="search-input-promo" value="<?= $pu['id_produk'] ?>" required />

                             <div id="display-hasil-search" class=""></div>
                         </div>

                         <div id="form-group" class="mb-2 col-12 col-md-6">
                             <label for="harga_promo" class="mb-1">Harga promo</label>
                             <span class="text-danger d-block" style="font-size: 0.6em;">*isi nilai 0 jika mau menetapkan menjdai harga pokok</span>
                             <input type="text" name="harga_promo" class="form-control" id="harga_promo" value="<?= $pu['harga_promo_user'] ?>" required />
                         </div>

                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="status" class="mb-1">Status</label>
                             <select id="status" class="form-select" name="status" required>
                                 <option value="0" <?= ($pu['status'] == '0') ? 'selected' : '' ?>> Mati </option>
                                 <option value="1" <?= ($pu['status'] == '1') ? 'selected' : '' ?>> Hidup </option>
                             </select>
                         </div>

                         <div class="form-group mb-2 col-12">
                             <label>Waktu Promo</label>
                             <div class="row align-items-center">
                                 <div class="col-12 col-md-5 pr-md-0">
                                     <input type="datetime-local" name="waktu_mulai" class="form-control" value="<?= $pu['waktu_mulai'] ?>" required>
                                 </div>
                                 <div class="col-2 px-md-0 text-center">
                                     Sampai
                                 </div>
                                 <div class="col-12 col-md-5 pl-md-0">
                                     <input type="datetime-local" name="waktu_selesai" class="form-control" value="<?= $pu['waktu_selesai'] ?>" required>
                                 </div>

                             </div>
                         </div>

                     </div>

                     <div class="modal-footer flex-column-reverse flex-md-row">
                         <div class="col-12 col-md-5 mb-2">
                             <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">Kembali</button>
                         </div>
                         <div class="col-12 col-md-5 mb-3 mb-md-2">
                             <button type="submit" class="btn btn-success m-0">Simpan</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>


     <!-- Modal Hapus-->
     <div class="modal fade" id="hapusPromoUser<?= $pu['id_promo_user'] ?>" tabindex="-1" aria-labelledby="hapusPromoUser<?= $pu['id_promo_user'] ?>Label" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="hapusPromoUser<?= $pu['id_promo_user'] ?>Label">
                         <i class="ti-alert"></i> Peringatan !
                     </h5>
                 </div>
                 <div class="modal-body text-center">
                     <img src="<?= base_url('assets/img/warning.gif') ?>" alt="">
                     <p class="text-dark">
                         Yakin Untuk Menghapus Data Promo Untuk <b><?= $nama['nm_pembeli'] ?></b> ?
                     </p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                     <form action="<?= base_url('controllers/promo-user.php') ?>" method="post" class="col-4">
                         <input type="text" name="opsi" value="delete" hidden>
                         <input type="text" name="id_promo_user" value="<?= $pu['id_promo_user'] ?>" hidden>
                         <button type="submit" class="btn btn-danger">Ya </button>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>


 <!-- Modal sukses -->
 <div class="modal fade" id="suksesNotifModal" tabindex="-1" aria-labelledby="suksesNotifModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content text-center p-3 pb-4">
             <div class="modal-body" style="height: 250px;">
                 <h2 style="font-weight: 700 !important;">Push Notif Berhasil</h2>
                 <img src="<?= base_url('assets/img/notif-success.gif') ?>" alt="">
                 <div class="d-block text-center">
                     <button type="button" class="btn btn-info btn-lg px-4 fs-3" data-dismiss="modal">OK</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /Modal sukses -->


 <script>
     var sendNotif = '<?= $_COOKIE['pesan_notif'] ?>';
     if (sendNotif == 'berhasil') {
         $('#suksesNotifModal').modal('show');
     }

     $(document).ready(function() {
         $('#tabel-pembeli').DataTable({
             responsive: true,
             "paging": false
         });
         $('#tabel-promo-user').DataTable({
             responsive: true,
             "pagingstyle": "simple"
         });

         var base_url = window.location.origin + '/admin/';
         $('#reload-peruser').click(function() {
             $('#isi-content-halaman').load(base_url + 'view/peruser.php');
         });
     });
 </script>
 <script src="<?= base_url('assets/js/ajax-admin.js') ?>"></script>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>