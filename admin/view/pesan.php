 <?php
    require_once '../../assets/basis/kon.php';
    require '../function/base_url.php';
    ?>

 <div class=" breadcrumbs">
     <div class="breadcrumbs-inner">
         <div class="row m-0">
             <div class="col-12">
                 <div class="page-header float-left">
                     <div class="page-title">
                         <h1>Halaman Pesan</h1>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>


 <div class="content pb-1">
     <!-- Animated -->
     <div class="row">
         <div class="col-11 col-lg-4 bg-white border rounded mx-3 mx-lg-0 mb-3 mb-lg-0">
             <div class="form-group my-2">

                 <input type="text" name="search_pengunjung" class="form-control" id="search_pengunjung" placeholder="cari dengan id pengunjung..." />
             </div>

             <div id="list-obrolan-pengunjung">

             </div>
         </div>
         <!-- live chat -->
         <div class="col-lg-8">
             <div class="card">
                 <div class="card-header position-relative pb-0">
                     <h4 class="card-title box-title d-inline-block">Live Chat <span id="user-obrolan"><?= isset($_COOKIE['idC_pengunjung']) ? "(User" . $_COOKIE['idC_pengunjung'] . ")" : '' ?></span> </h4>
                     <button class="btn btn-sm btn-ijo rounded-circle position-absolute mr-3 text-white" style="right: 0;" onclick="scrollBawah()">
                         <i class="fa fa-chevron-down" aria-hidden="true"></i>
                     </button>

                 </div>
                 <div class="card-body pt-0">
                     <div class="card-content">
                         <div class="messenger-box" style="height: 50vh; overflow-y:auto;">
                             <div class="text-center mb-2">
                                 <label class="p-1 bg-light shadow-sm" style="font-size: 0.7em;">Mulai Obrolanmu</label>
                             </div>
                             <div id="area-msg">


                             </div>
                             <div class="py-4 mt-2"></div>

                         </div><!-- /.messenger-box -->
                     </div>
                 </div> <!-- /.card-body -->
                 <div class="card-footer bg-white">
                     <div class="send-mgs">
                         <div class="yourmsg">
                             <!-- pengunjung -->
                             <input name="input_id_pengunjung" type="text" value="<?= isset($_COOKIE['idC_pengunjung']) ? $_COOKIE['idC_pengunjung'] : '' ?>" hidden>
                             <!-- pengunjung -->

                             <input class="form-control" name="input_msg" type="text">
                         </div>
                         <button class="btn msg-send-btn rounded-circle bg-warning text-white" onclick="kirimPesan()">
                             <i class="pe-7s-paper-plane"></i>
                         </button>
                     </div>
                 </div>
             </div><!-- /.card -->
         </div>
         <!-- /live chat -->
     </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>