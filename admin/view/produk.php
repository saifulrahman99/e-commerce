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

 <div class="content" style="margin-right:-5px;">
     <!-- Animated -->
     <div class="row">
         <div class="col-12">
             <div class="card">
                 <div class="card-body">

                     <!-- button trigger -->
                     <button id="reload-produk" class="btn btn-info rounded p-1 px-2 mb-3"><i class="ti-reload"></i> Refrash</button>

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
                                     <td>tes</td>
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





 <script>
     $(document).ready(function() {
         $('#tabel-produk').DataTable({
             responsive: true
         });
     });
 </script>