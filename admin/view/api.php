 <?php
    require_once '../../assets/basis/kon.php';
    $select = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM pengaturan WHERE nm_pengaturan = 'data_api'"));

    $data = unserialize($select['isi_pengaturan']);

    ?>
 <div class=" breadcrumbs">
     <div class="breadcrumbs-inner">
         <div class="row m-0">
             <div class="col-12">
                 <div class="page-header float-left">
                     <div class="page-title">
                         <h1>Halaman Pengaturan API</h1>
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
                 <button id="reload-api" class="btn btn-success btn-sm">
                     <i class="ti-reload"></i>
                     Refrash
                 </button>
             </div>

             <div class="form-api m-auto">
                 <form id="form-data-api" method="post" enctype="multipart/form-data" onsubmit="api(); return false;">

                     <h4 class="tebal-600 mb-3">API Payment Midtrans</h4>

                     <h5 class="mb-1">Switch Mode Pembayaran</h5>
                     <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons">
                         <label class="btn btn-outline-success <?= ($data['mode_pembayaran'] == 'sandbox') ? 'active' : '' ?>" style="border-radius: 0px !important;">
                             <input type="radio" name="mode_pembayaran" value="sandbox" id="sandbox" <?= ($data['mode_pembayaran'] == 'sandbox') ? 'checked' : '' ?>> Mode Sandbox
                         </label>
                         <label class="btn btn-outline-success <?= ($data['mode_pembayaran'] == 'production') ? 'active' : '' ?>" style="border-radius: 0px !important;">
                             <input type="radio" name="mode_pembayaran" value="production" id="production" <?= ($data['mode_pembayaran'] == 'production') ? 'checked' : '' ?>> Mode Production
                         </label>
                     </div>

                     <h5 class="tebal-600 mb-1">Mode Sandbox</h5>
                     <div class="row">
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="client_sandbox" class="mb-1">client key</label>
                             <input type="text" name="client_sandbox" class="form-control" id="client_sandbox" value="<?= $data['client_sandbox'] ?>" required />
                         </div>

                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="server_sandbox" class="mb-1">server key</label>
                             <input type="text" name="server_sandbox" class="form-control" id="server_sandbox" value="<?= $data['server_sandbox'] ?>" required />
                         </div>
                     </div>

                     <h5 class="tebal-600 mb-1">Mode Production</h5>

                     <div class="row">
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="client_production" class="mb-1">client key</label>
                             <input type="text" name="client_production" class="form-control" id="client_production" value="<?= $data['client_production'] ?>" required />
                         </div>

                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="server_production" class="mb-1">server key</label>
                             <input type="text" name="server_production" class="form-control" id="server_production" value="<?= $data['server_production'] ?>" required />
                         </div>
                     </div>

                     <div class="border my-4"></div>

                     <h4 class="tebal-600 my-3">API Whatsapp Fonnte</h4>
                     <div class="row">
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="token_wa" class="mb-1">Token Key</label>
                             <input type="text" name="token_wa" class="form-control" id="token_wa" value="<?= $data['token_wa'] ?>" required />
                         </div>
                         <div class="form-group mb-2 col-12 col-md-6">
                             <label for="nomor_tujuan" class="mb-1">Nomor Tujuan</label>
                             <input type="text" name="nomor_tujuan" class="form-control" id="nomor_tujuan" value="<?= $data['nomor_tujuan'] ?>" required />
                         </div>
                     </div>

                     <div class="form-group my-3">
                         <button type="submit" class="btn btn-success text-white border">
                             <i class="fa fa-floppy-o mr-1"></i>
                             Simpan
                         </button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script type="text/javascript">
     var base_url = window.location.origin + '/admin/';
     $('#reload-api').click(function() {
         $('#isi-content-halaman').load(base_url + 'view/api.php');
     });
 </script>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>