 <?php
    require_once '../../assets/basis/kon.php';
    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_toko'"));

    $data = unserialize($select['isi_pengaturan']);
    ?>
 <div class=" breadcrumbs">
     <div class="breadcrumbs-inner">
         <div class="row m-0">
             <div class="col-12">
                 <div class="page-header float-left">
                     <div class="page-title">
                         <h1>Halaman Toko</h1>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="content pb-1">

     <div class="card">
         <div class="card-body">

             <div class="button mb-3 d-flex flex-wrap">

                 <button id="reload-toko" class="btn btn-success btn-sm ml-2 my-1"><i class="ti-reload"></i> Refrash</button>

             </div>

             <form id="form-data-toko" method="post" action="controllers/toko.php">

                 <h4 class="tebal-600 mb-2">About Us</h4>
                 <textarea name="about_us" id="about_us" class="ckeditor"><?= $data['about_us'] ?></textarea>

                 <h4 class="tebal-600 mb-2 mt-3">Informasi Footer</h4>
                 <div class="row">

                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="oprasional" class="mb-1">Jam oprasional</label>
                         <textarea name="oprasional" id="oprasional" class="ckeditor"><?= $data['oprasional'] ?></textarea>
                     </div>

                     <div class="form-group mb-2 col-12 col-md-6">
                         <label for="alamat" class="mb-1">Alamat Toko</label>
                         <textarea name="alamat" id="alamat" rows="4" class="ckeditor"><?= $data['alamat'] ?></textarea>
                     </div>

                     <div class="form-group mb-2 col-12">
                         <label for="lokasi" class="mb-1">Link Lokasi (Google Maps)</label>
                         <div class="input-group">
                             <div class="input-group-prepend">
                                 <span class="input-group-text" id="fb"><i class="fa fa-map"></i></span>
                             </div>
                             <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Link Lokasi" value="<?= $data['lokasi'] ?>" />
                         </div>
                     </div>
                 </div>

                 <h4 class="tebal-600 mb-2 mt-3">Media Sosial</h4>
                 <div class="row">
                     <div class="input-group mb-2 col-12 col-md-4">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="fb"><i class="fa fa-instagram"></i></span>
                         </div>
                         <input type="text" name="ig" class="form-control" placeholder="Link Instagram" aria-label="Instagram" aria-describedby="ig" value="<?= $data['ig'] ?>" required>
                     </div>
                     <div class="input-group mb-2 col-12 col-md-4">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="fb"><i class="fa fa-facebook"></i></span>
                         </div>
                         <input type="text" name="fb" class="form-control" placeholder="Link Facebook" aria-label="Facebook" aria-describedby="fb" value="<?= $data['fb'] ?>" required>
                     </div>
                     <div class="input-group mb-2 col-12 col-md-4">
                         <div class="input-group-prepend">
                             <span class="input-group-text" id="fb"><i class="fa fa-whatsapp"></i></span>
                         </div>
                         <input type="text" name="wa" class="form-control" placeholder="Nomor Whatsapp" aria-label="Whatsapp" aria-describedby="wa" value="<?= $data['wa'] ?>" required>
                     </div>
                 </div>

                 <button type="submit" class="btn btn-success my-3 px-4"> <i class="fa fa-floppy-o pr-1" aria-hidden="true"></i> Simpan</button>
             </form>
         </div>
     </div>

 </div>


 <script>
     $(document).ready(function() {

         var base_url = window.location.origin + '/admin/';
         $('#reload-toko').click(function() {
             $('#isi-content-halaman').load(base_url + 'view/toko.php');
         });

     });

     CKEDITOR.replace('about_us');
     CKEDITOR.replace('alamat');
     CKEDITOR.replace('oprasional');
 </script>


 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>