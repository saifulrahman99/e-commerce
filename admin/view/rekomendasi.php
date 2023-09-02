 <?php
    require_once '../../assets/basis/kon.php';
    require '../function/base_url.php';
    $select = mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY id_produk DESC");
    ?>
 <div class="breadcrumbs">
     <div class="breadcrumbs-inner">
         <div class="row m-0">
             <div class="col-12">
                 <div class="page-header float-left">
                     <div class="page-title">
                         <h1>Atur Rekomendasi Produk</h1>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="content pb-1">
     <div class="card">
         <div class="card-body">
             <!-- button trigger -->
             <div class="button mb-3 d-flex flex-wrap">

                 <!-- Button trigger modal -->
                 <button type="button" class="btn btn-success btn-sm mr-1 my-1" data-toggle="modal" data-target="#tambahRekProduk">
                     <i class="ti-plus"></i>
                     tambah data
                 </button>

                 <button id="reload-rekomendasi" class="btn btn-success btn-sm ml-2 my-1"><i class="ti-reload"></i> Refrash</button>

             </div>
             <!-- /button trigger -->

             <!-- produk -->
             <div class="list-rek-produk">
                 <?php
                    $list = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'rekomendasi'"));
                    $data = $list['isi_pengaturan'];
                    $dp = explode(',', $data);

                    if (!empty($data)) { ?>
                     <div class="row">
                         <?php foreach ($dp as $p) {
                                $produk = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM produk WHERE kode_produk = '$p'"));
                                $gambar = !empty($produk['gambar']) ? $produk['gambar'] : 'default-produk.jpg';
                            ?>
                             <div class="col-6 col-md-3 col-lg-2">
                                 <div class="card shadow-sm">
                                     <div class="card-header p-0">
                                         <img src="<?= base_url('../assets/img/produk/' . $gambar)  ?>" alt="..." style="width: 100%;">
                                     </div>
                                     <div class="card-body">
                                         <span><?= $produk['nm_produk'] ?></span>
                                     </div>
                                 </div>
                             </div>
                         <?php } ?>
                     </div>
                 <?php } else { ?>
                     <h5 class="text-center my-5">Produk Rekomendasi Belum Ada !</h5>
                 <?php } ?>

             </div>
             <!-- produk -->
         </div>
     </div>
 </div>



 <!-- Modal tambah produk -->
 <div class="modal fade" id="tambahRekProduk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahRekProdukLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <form id="form-tambah-rek-produk" method="post" enctype="multipart/form-data" onsubmit="rekomendasi();return false;">

                 <div class="modal-header">
                     <h5 class="modal-title" id="tambahRekProdukLabel">Tambah Produk Rekomendasi</h5>
                 </div>

                 <div class="modal-body pe-3">
                     <input type="text" name="opsi" value="add" hidden>
                     <div class="form-group mb-2">
                         <label for="kode" class="mb-1">Kode Produk</label>
                         <textarea name="kode" id="kode" class="form-control" rows="5" placeholder="contoh : tahu10,YGRT,YGRT10"><?= $data ?></textarea>
                     </div>
                     <span class="text-info" style="font-size: 0.8em;">*gunakan koma ' , ' untuk memisahkan kode produk jika akan menambahkan lebih dari satu produk</span>
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
 <!-- /Modal tambah produk -->

 <script>
     $(document).ready(function() {
         var base_url = window.location.origin + '/admin/';
         $('#reload-rekomendasi').click(function() {
             $('#isi-content-halaman').load(base_url + 'view/rekomendasi.php');
         });
     });
 </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>