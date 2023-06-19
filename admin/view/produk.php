 <?php
    require_once '../../assets/basis/kon.php';
    require '../function/base_url.php';
    $select = mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY id_produk DESC");
    ?>
 <div class=" breadcrumbs">
     <div class="breadcrumbs-inner">
         <div class="row m-0">
             <div class="col-12">
                 <div class="page-header float-left">
                     <div class="page-title">
                         <h1>Halaman Produk</h1>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="content pb-1">
     <!-- Animated -->
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body">
                     <!-- button trigger -->
                     <div class="button mb-3">

                         <!-- Button trigger modal -->
                         <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahProduk">
                             <i class="ti-plus"></i>
                             tambah data
                         </button>


                         <div class="dropdown mx-1 d-inline-block">
                             <button type="button" class="btn btn-success px-3  btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false" data-offset="10,20">
                                 Excel
                             </button>
                             <div class="dropdown-menu">
                                 <a class="dropdown-item" data-toggle="modal" href="#imporExcel">Impor Excel (.CSV)</a>

                                 <a class="dropdown-item" href="<?= base_url('produk-control/ekspor') ?>">Ekspor Excel</a>
                             </div>
                         </div>

                         <button id="reload-produk" class="btn btn-success btn-sm mx-4"><i class="ti-reload"></i> Refrash</button>

                     </div>
                     <!-- /button trigger -->

                     <table id="tabel-produk" class="table table-striped">
                         <thead>
                             <th>#</th>
                             <th>Nama</th>
                             <th>Kode</th>
                             <th>Merk</th>
                             <th>Harga Pokok</th>
                             <th>Harga Jual</th>
                             <th>Stok</th>
                             <th>Kategori</th>
                             <th>Aksi</th>
                         </thead>
                         <tbody>
                             <?php $no = 1;
                                foreach ($select as $p) { ?>
                                 <tr>
                                     <td><?= $no++ ?>&nbsp.</td>
                                     <td><?= $p['nm_produk'] ?></td>
                                     <td><?= $p['kode_produk'] ?></td>
                                     <td><?= $p['merek'] ?></td>
                                     <td><?= $p['harga_pokok'] ?></td>
                                     <td><?= $p['harga_jual'] ?></td>
                                     <td><?= $p['stok'] ?></td>
                                     <td><?= $p['kategori'] ?></td>
                                     <td>
                                         <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editProduk<?= $p['id_produk'] ?>">
                                             <i class="ti-pencil"></i>
                                             edit
                                         </button>

                                         <button type="button" class="btn btn-sm btn-danger mx-2" data-toggle="modal" data-target="#hapusProduk<?= $p['id_produk'] ?>">
                                             <i class="ti-trash"></i>
                                             hapus
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
     <!-- .animated -->
 </div>




 <!-- Modal tambah produk -->
 <div class="modal fade" id="tambahProduk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahProdukLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form action="<?= base_url('produk-control') ?>" id="form-tambah-data-produk" method="post" enctype="multipart/form-data">

                 <div class="modal-header">
                     <h5 class="modal-title" id="tambahProdukLabel">Tambah Data Produk</h5>
                 </div>

                 <div class="modal-body row">
                     <input type="text" name="opsi" value="add" hidden>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="kode" class="mb-1">Kode Produk</label>
                         <input type="text" name="kode" class="form-control" id="kode" required />
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="nama_produk" class="mb-1">Nama Produk</label>
                         <input type="text" name="nama_produk" class="form-control" id="nama_produk" required />
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="merek" class="mb-1">Merek</label>
                         <input type="text" name="merek" class="form-control" id="merek" />
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="kategori" class="mb-1">Kategori</label>
                         <select id="kategori" class="custom-select mr-sm-2" name="kategori" required>
                             <option selected>-Pilih </option>
                             <?php
                                $kategori = mysqli_query($db, "SELECT * FROM kategori");
                                foreach ($kategori as $k) { ?>
                                 <option value="<?= $k['id_kategori'] ?>"> <?= ucwords($k['kategori']) ?> </option>
                             <?php } ?>
                         </select>
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="satuan" class="mb-1">Satuan</label>
                         <select id="satuan" class="custom-select mr-sm-2" name="satuan" required>
                             <option selected>-Pilih </option>
                             <option value="CUP"> CUP </option>
                             <option value="DUS"> DUS </option>
                             <option value="Gr"> Gr </option>
                             <option value="Kg"> Kg </option>
                             <option value="Ons"> Ons </option>
                             <option value="PAK"> PAK </option>
                             <option value="PCS"> PCS </option>
                         </select>
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="harga_pokok" class="mb-1">Harga Pokok</label>
                         <input type="text" name="harga_pokok" class="form-control" id="harga_pokok" required />
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="harga_jual" class="mb-1">Harga Jual</label>
                         <input type="text" name="harga_jual" class="form-control" id="harga_jual" required />
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="stok" class="mb-1">Stok</label>
                         <input type="text" name="stok" class="form-control" id="stok" required />
                     </div>
                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="kode_gudang" class="mb-1">Kode Gudang</label>
                         <input type="text" name="kode_gudang" class="form-control" id="kode_gudang" required />
                     </div>
                     <div class="form-group mb-2 col-12">
                         <label for="deskripsi" class="mb-1">Deskripsi Produk</label>
                         <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"></textarea>
                     </div>
                     <div class="form-group mb-2 col-12 mt-3">
                         <label class="mb-1" for="gambar">Gambar Produk</label>
                         <input type="file" name="gambar" class="form-control" id="gambar" accept=".png, .jpg, .jpeg" required>
                     </div>
                     <div class="form-group mb-2 col-12 mt-3">
                         <label class="mb-1" for="galeri">Galeri Gambar Produk</label>
                         <input type="file" name="galeri[]" class="form-control" id="galeri" accept=".png, .jpg, .jpeg" multiple>
                     </div>
                 </div>

                 <div class="modal-footer">
                     <div class="col-12 col-md-5 mb-2">
                         <button type="button" class="btn btn-secondary m-0" data-dismiss="modal">Kembali</button>
                     </div>
                     <div class="col-12 col-md-5 mb-3">
                         <button type="submit" class="btn btn-success m-0">Simpan</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- /Modal tambah produk -->



 <?php
    foreach ($select as $modal) { ?>
     <!-- Modal -->
     <div class="modal fade" id="editProduk<?= $modal['id_produk'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editProduk<?= $modal['id_produk'] ?>Label" aria-hidden="true">
         <div class="modal-dialog modal-dialog-scrollable modal-lg">
             <div class="modal-content">
                 <form action="<?= base_url('produk-control') ?>" id="form-edit-data-produk" method="post" enctype="multipart/form-data">
                     <div class="modal-header">
                         <h5 class="modal-title" id="editProduk<?= $modal['id_produk'] ?>Label">Edit Data Produk</h5>
                     </div>

                     <div class="modal-body row">
                         <input type="text" name="opsi" value="update" hidden>
                         <input type="text" name="id_produk" value="<?= $modal['id_produk'] ?>" hidden>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="kode" class="mb-1">Kode Produk</label>
                             <input type="text" name="kode" class="form-control" id="kode" value="<?= $modal['kode_produk'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="nama_produk" class="mb-1">Nama Produk</label>
                             <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="<?= $modal['nm_produk'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="merek" class="mb-1">Merek</label>
                             <input type="text" name="merek" class="form-control" id="merek" value="<?= $modal['merek'] ?>" />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="kategori" class="mb-1">Kategori</label>
                             <select id="kategori" class="custom-select mr-sm-2" name="kategori" required>
                                 <?php
                                    $kategori = mysqli_query($db, "SELECT * FROM kategori");
                                    foreach ($kategori as $k) { ?>
                                     <option value="<?= $k['id_kategori'] ?>" <?= ($k['kategori'] == $modal['kategori']) ? 'selected' : '' ?>> <?= ucwords($k['kategori']) ?> </option>
                                 <?php } ?>
                             </select>
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="satuan" class="mb-1">Satuan</label>
                             <select id="satuan" class="custom-select mr-sm-2" name="satuan" required>
                                 <option <?= ($modal['satuan'] == '') ? 'selected' : '' ?>>-Pilih </option>
                                 <option <?= ($modal['satuan'] == 'CUP') ? 'selected' : '' ?> value="CUP"> CUP </option>
                                 <option <?= ($modal['satuan'] == 'DUS') ? 'selected' : '' ?> value="DUS"> DUS </option>
                                 <option <?= ($modal['satuan'] == 'Gr') ? 'selected' : '' ?> value="Gr"> Gr </option>
                                 <option <?= ($modal['satuan'] == 'Kg') ? 'selected' : '' ?> value="Kg"> Kg </option>
                                 <option <?= ($modal['satuan'] == 'Ons') ? 'selected' : '' ?> value="Ons"> Ons </option>
                                 <option <?= ($modal['satuan'] == 'PAK') ? 'selected' : '' ?> value="PAK"> PAK </option>
                                 <option <?= ($modal['satuan'] == 'PCS') ? 'selected' : '' ?> value="PCS"> PCS </option>
                             </select>
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="harga_pokok" class="mb-1">Harga Pokok</label>
                             <input type="text" name="harga_pokok" class="form-control" id="harga_pokok" value="<?= $modal['harga_pokok'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="harga_jual" class="mb-1">Harga Jual</label>
                             <input type="text" name="harga_jual" class="form-control" id="harga_jual" value="<?= $modal['harga_jual'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="stok" class="mb-1">Stok</label>
                             <input type="text" name="stok" class="form-control" id="stok" value="<?= $modal['stok'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="kode_gudang" class="mb-1">Kode Gudang</label>
                             <input type="text" name="kode_gudang" class="form-control" id="kode_gudang" value="<?= $modal['kode_gudang'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12">
                             <label for="deskripsi" class="mb-1">Deskripsi Produk</label>
                             <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?= $modal['deskripsi'] ?></textarea>
                         </div>
                         <div class="form-group mb-2 col-12 mt-3">
                             <label class="mb-1" for="gambar">Gambar Produk</label>
                             <input type="file" name="gambar" class="form-control" id="gambar" accept=".png, .jpg, .jpeg">
                         </div>
                         <div class="form-group mb-2 col-12 mt-3">
                             <label class="mb-1" for="galeri">Galeri Gambar Produk</label>
                             <input type="file" name="galeri[]" class="form-control" id="galeri" accept=".png, .jpg, .jpeg" multiple>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <div class="col-12 col-md-5 mb-2">
                             <button type="button" class="btn btn-secondary m-0 " data-dismiss="modal">Kembali</button>
                         </div>
                         <div class="col-12 col-md-5 mb-3">
                             <button type="submit" class="btn btn-info m-0">Simpan Perubahan</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>

     <!-- Modal -->
     <div class="modal fade" id="hapusProduk<?= $modal['id_produk'] ?>" tabindex="-1" aria-labelledby="hapusProduk<?= $modal['id_produk'] ?>Label" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="hapusProduk<?= $modal['id_produk'] ?>Label">
                         <i class="ti-alert"></i> Peringatan !
                     </h5>
                 </div>
                 <div class="modal-body">
                     <p class="text-dark">
                         Yakin Untuk Menghapus Data Produk <?= $modal['nm_produk'] ?> ?
                     </p>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                     <a href='<?= base_url('produk-control/' . $modal['id_produk'] . '/delete') ?>' class="btn btn-danger col-4">Ya</a>
                 </div>
             </div>
         </div>
     </div>
 <?php } ?>


 <!-- Modal -->
 <div class="modal fade" id="imporExcel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="imporExcelLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <form action="<?= base_url('produk-control') ?>" method="post">
                 <div class="modal-body">
                     <input type="text" name="opsi" value="impor" hidden>
                     <div class="form-group mb-2">
                         <label for="file_excel" class="mb-1">Impor File Excel (.CSV)</label>
                         <input type="file" name="file_excel" class="form-control" id="file_excel" required />
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Batal</button>
                     <button type="submit" class="btn btn-success col-4">Impor Data</button>
                 </div>
             </form>
         </div>
     </div>
 </div>



 <script>
     $(document).ready(function() {
         $('#tabel-produk').DataTable({
             responsive: true
         });
         var base_url = window.location.origin + '/admin/';
         $('#reload-produk').click(function() {
             $('#isi-content-halaman').load(base_url + 'view/produk.php');
         });
     });
 </script>