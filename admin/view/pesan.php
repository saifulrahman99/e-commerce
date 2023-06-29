 <?php
    session_start();
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
         <!-- live chat -->
         <div class="col-lg-6">
             <div class="card">
                 <div class="card-body">
                     <h4 class="card-title box-title">Live Chat</h4>
                     <div class="card-content">
                         <div class="messenger-box">
                             <ul>
                                 <li>
                                     <div class="msg-received msg-container">
                                         <div class="avatar">
                                             <img src="<?= base_url('assets/img/user-profile.png') ?>" alt="">
                                             <div class="send-time">11.11 am</div>
                                         </div>
                                         <div class="msg-box">
                                             <div class="inner-box">
                                                 <div class="name">
                                                     John Doe
                                                 </div>
                                                 <div class="meg">
                                                     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis sunt placeat velit ad reiciendis ipsam
                                                 </div>
                                             </div>
                                         </div>
                                     </div><!-- /.msg-received -->
                                 </li>
                                 <li>
                                     <div class="msg-sent msg-container">
                                         <div class="avatar">
                                             <img src="<?= base_url('assets/img/user-profile.png') ?>" alt="">
                                             <div class="send-time">11.11 am</div>
                                         </div>
                                         <div class="msg-box">
                                             <div class="inner-box">
                                                 <div class="meg">
                                                     Hay how are you doing?
                                                 </div>
                                             </div>
                                         </div>
                                     </div><!-- /.msg-sent -->
                                 </li>
                             </ul>
                             <div class="send-mgs">
                                 <div class="yourmsg">
                                     <input class="form-control" type="text">
                                 </div>
                                 <button class="btn msg-send-btn">
                                     <i class="pe-7s-paper-plane"></i>
                                 </button>
                             </div>
                         </div><!-- /.messenger-box -->
                     </div>
                 </div> <!-- /.card-body -->
             </div><!-- /.card -->
         </div>
         <!-- /live chat -->
     </div>
 </div>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>