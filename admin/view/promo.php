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
                         <h1>Halaman Promo</h1>
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
                         <button type="button" class="btn btn-success btn-sm mr-1 my-1" data-toggle="modal" data-target="#tambahPromo">
                             <i class="ti-plus"></i>
                             tambah promo
                         </button>

                         <button id="reload-promo" class="btn btn-success btn-sm ml-2 my-1"><i class="ti-reload"></i> Refrash</button>
                         <!-- /button trigger -->

                     </div>

                     <table id="tabel-promo" class="table table-striped">
                         <thead>
                             <th>#</th>
                             <th>Nama Produk</th>
                             <th>Nama promo</th>
                             <th>Harga Promo</th>
                             <th>Waktu</th>
                             <th>Gambar Promo</th>
                             <th>Status</th>
                             <th>Aksi</th>
                         </thead>
                         <tbody>
                             <?php $no = 1;
                                foreach ($select as $p) {
                                    $id_produk = $p['id_produk'];
                                    if ($id_produk != 0) {
                                        $nm_produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT nm_produk FROM produk WHERE id_produk = '$id_produk'"));
                                        $nm_produk = $nm_produk['nm_produk'];
                                    }
                                ?>
                                 <tr>
                                     <td><?= $no++ ?></td>
                                     <td><?= ($id_produk != 0) ? $nm_produk : "promo semua produk" ?></td>
                                     <td><?= $p['nm_promo'] ?></td>
                                     <td><?= ($p['harga_promo'] == 0) ? "harga pokok" : $p['harga_promo'] ?></td>
                                     <td><?= "Dari " . substr($p['waktu_mulai'], 0, -3) . " Sampai " . substr($p['waktu_selesai'], 0, -3) ?></td>
                                     <td>
                                         <img src="<?= base_url('../../assets/img/promo/' . $p['gambar']) ?>" alt="" width="150px">
                                     </td>
                                     <td><?= ($p['status'] == 0) ? "<span class=\"badge badge-danger\">Mati</span>" : "<span class=\"badge badge-success\">Hidup</span>" ?></td>
                                     <td>
                                         <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editPromo<?= $p['id_promo'] ?>">
                                             <i class="ti-pencil"></i>
                                             edit
                                         </button>

                                         <button type="button" class="btn btn-sm btn-danger mx-1" data-toggle="modal" data-target="#hapusPromo<?= $p['id_promo'] ?>">
                                             <i class="ti-trash"></i>
                                             hapus
                                         </button>
                                         <button type="button" class="btn btn-sm btn-warning text-white ms-1 my-1" onclick="notif(<?= $p['id_promo'] ?>)">
                                             <i class="ti-bell"></i>
                                             Push Notif
                                         </button>
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
 <div class="modal fade" id="tambahPromo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahPromoLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form id="form-tambah-data-promo" method="post" enctype="multipart/form-data" onsubmit="promo('','add');return false;">

                 <div class="modal-header">
                     <h5 class="modal-title" id="tambahPromoLabel">Tambah Promo</h5>
                 </div>

                 <div class="modal-body row">
                     <input type="text" name="opsi" value="add" hidden>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="search-input-promo" class="mb-1">ID Produk</label>
                         <span class="text-danger d-block" style="font-size: 0.6em;">*cari by nama atau kode (Kosongi jika promo untuk semua produk)</span>
                         <input type="text" name="id_produk" class="form-control" id="search-input-promo" />

                         <div id="display-hasil-search" class=""></div>
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="nama_promo" class="mb-1">Nama promo</label>
                         <span class="text-danger d-block" style="font-size: 0.6em;">*</span>
                         <input type="text" name="nama_promo" class="form-control" id="nama_promo" required />
                     </div>

                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="jenis_promo" class="mb-1">jenis Promo</label>
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

                     <div class="form-group mb-2 col-12">
                         <label for="keterangan">Keterangan</label>
                         <textarea name="keterangan" id="keterangan" rows="6" class="form-control"></textarea>
                     </div>

                     <div class="form-group mb-2 col-12 mt-3">
                         <label class="mb-1" for="gambar">Gambar Promo</label>
                         <input type="file" name="gambar" class="form-control" id="gambar" accept=".png, .jpg, .jpeg" required>
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


 <!-- Modal sukses -->
 <div class="modal fade" id="suksesNotifModal" tabindex="-1" aria-labelledby="suksesNotifModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content text-center p-3 pb-4">
             <div class="modal-body" style="height: 250px;">
                 <h2 style="font-weight: 700 !important;">Push Notif Berhasil</h2>
                 <img src="<?=  base_url('assets/img/notif-success.gif')?>" alt="">
                 <div class="d-block text-center">
                     <button type="button" class="btn btn-info btn-lg px-4 fs-3" data-dismiss="modal">OK</button>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /Modal sukses -->


 <?php
    foreach ($select as $modal) { ?>
     <!-- Modal -->
     <div class="modal fade" id="editPromo<?= $modal['id_promo'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editPromo<?= $modal['id_promo'] ?>Label" aria-hidden="true">
         <div id="form-edit-data-promo" class="modal-dialog modal-dialog-scrollable modal-lg">
             <div class="modal-content">
                 <form id="form-edit-data-promo<?= $modal['id_promo'] ?>" method="post" enctype="multipart/form-data" onsubmit="promo(<?= $modal['id_promo'] ?>,'update');return false;">

                     <div class="modal-header">
                         <h5 class="modal-title" id="editPromoLabel">Ubah Data Promo</h5>
                     </div>

                     <div class="modal-body row">
                         <input type="text" name="opsi" value="update" hidden>
                         <input type="text" name="id_promo" value="<?= $modal['id_promo'] ?>" hidden>

                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="nama_promo" class="mb-1">Nama promo</label>
                             <span class="text-danger d-block" style="font-size: 0.6em;">*</span>

                             <input type="text" name="nama_promo" class="form-control" id="nama_promo" value="<?= $modal['nm_promo'] ?>" required />
                         </div>

                         <div id="form-group-harga-promo" class="mb-2 col-12 col-md-6">
                             <label for="input_harga_promo" class="mb-1">Harga promo</label>
                             <span class="text-danger d-block" style="font-size: 0.6em;">*set nilai 0 jika mau mengubah ke harga pokok</span>
                             <input type="text" name="harga_promo" class="form-control" value="<?= $modal['harga_promo'] ?>" id="input_harga_promo" />
                         </div>

                         <div class="form-group mb-2 col-12">
                             <label>Waktu Promo</label>
                             <div class="row align-items-center">
                                 <div class="col-12 col-md-5 pr-md-0">
                                     <input type="datetime-local" name="waktu_mulai" class="form-control" value="<?= $modal['waktu_mulai'] ?>" required>
                                 </div>
                                 <div class="col-2 px-md-0 text-center">
                                     Sampai
                                 </div>
                                 <div class="col-12 col-md-5 pl-md-0">
                                     <input type="datetime-local" name="waktu_selesai" class="form-control" value="<?= $modal['waktu_selesai'] ?>" required>
                                 </div>

                             </div>
                         </div>

                         <div class="form-group mb-2 col-12">
                             <label class="d-block">Status Promo</label>
                             <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="status" id="mati" value="0" <?= ($modal['status'] == '0') ? 'checked' : '' ?>>
                                 <label class="form-check-label" for="mati">Mati</label>
                             </div>
                             <div class="form-check form-check-inline">
                                 <input class="form-check-input" type="radio" name="status" id="hidup" value="1" <?= ($modal['status'] == '1') ? 'checked' : '' ?>>
                                 <label class="form-check-label" for="hidup">Hidup</label>
                             </div>
                         </div>

                         <div class="form-group mb-2 col-12">
                             <label for="keterangan">Keterangan</label>
                             <textarea name="keterangan" id="keterangan" rows="6" class="form-control"><?= $modal['keterangan'] ?></textarea>
                         </div>

                         <div class="form-group mb-2 col-12 mt-3">
                             <div class="preview mb-2 text-center">
                                 <label class="d-block">Preview Gambar</label>
                                 <img src="<?= base_url('../../assets/img/promo/' . $modal['gambar']) ?>" alt="" style="width: 80%;">
                             </div>
                             <label class="mb-1 d-block" for="gambar">Ganti Gambar Promo</label>
                             <input type="file" name="gambar" class="form-control" id="gambar" accept=".png, .jpg, .jpeg">
                         </div>

                     </div>

                     <div class="modal-footer flex-column-reverse flex-md-row">
                         <div class="col-12 col-md-5 mb-2">
                             <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">Kembali</button>
                         </div>
                         <div class="col-12 col-md-5 mb-3 mb-md-2">
                             <button type="submit" class="btn btn-info m-0">Simpan Perubahan</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <!-- Modal -->
     <div class="modal fade" id="hapusPromo<?= $modal['id_promo'] ?>" tabindex="-1" aria-labelledby="hapusPromo<?= $modal['id_promo'] ?>Label" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="hapusPromo<?= $modal['id_promo'] ?>Label">
                         <i class="ti-alert"></i> Peringatan !
                     </h5>
                 </div>
                 <div class="modal-body text-center">
                    <img src="<?=base_url('assets/img/warning.gif')?>" alt="">
                     <p class="text-dark">
                         Yakin Untuk Menghapus Data Promo <b><?= $modal['nm_promo'] ?></b> ?
                     </p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                     <button type="button" class="btn btn-danger col-4" onclick="promo(<?= $modal['id_promo'] ?>,'delete')">Ya </button>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>

 <script>
     $(document).ready(function() {
         $('#tabel-promo').DataTable({
             responsive: true,
             "pagingType": "simple"
         });

         var base_url = window.location.origin + '/admin/';
         $('#reload-promo').click(function() {
             $('#isi-content-halaman').load(base_url + 'view/promo.php');
         });
     });
 </script>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>