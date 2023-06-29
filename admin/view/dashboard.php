 <?php
    session_start();
    require_once '../../assets/basis/kon.php';
    require '../function/base_url.php';
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
                                     <div class="stat-text">$<span class="count">23569</span></div>
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
                                     <div class="stat-text"><span class="count">3435</span></div>
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
                                     <div class="stat-text"><span class="count">2986</span></div>
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
                                     <div class="stat-text"><span class="count">2986</span></div>
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
                     <div class="card-body--">
                         <div class="table table-responsive">
                             <table class="table ">
                                 <thead>
                                     <tr>
                                         <th class="serial">#</th>
                                         <!-- <th class="avatar">Avatar</th> -->
                                         <th>ID</th>
                                         <th>Name</th>
                                         <th>Product</th>
                                         <th>Quantity</th>
                                         <th class="text-center">Status</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <tr>
                                         <td class="serial">1.</td>
                                         <td> #5469 </td>
                                         <td> <span class="name">Louis Stanley</span> </td>
                                         <td> <span class="product">iMax</span> </td>
                                         <td><span class="count">231</span></td>
                                         <td class="text-center">
                                             <span class="badge badge-complete bg-success p-1 text-white">Complete</span>
                                         </td>
                                     </tr>
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


         <!-- Modal - Calendar - Add New Event -->
         <div class="modal fade none-border" id="event-modal">
             <div class="modal-dialog">
                 <div class="modal-content">
                     <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title"><strong>Add New Event</strong></h4>
                     </div>
                     <div class="modal-body"></div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                         <button type="button" class="btn btn-success save-event waves-effect waves-light">Create event</button>
                         <button type="button" class="btn btn-danger delete-event waves-effect waves-light" data-dismiss="modal">Delete</button>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /#event-modal -->

         <!-- Scripts -->
         <script src="<?= base_url('assets/template/js/init/flot-chart-init.js') ?>"></script>

     </div>
     <!-- .animated -->
 </div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>