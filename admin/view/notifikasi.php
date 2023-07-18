<?php
require '../function/base_url.php';
?>
<div class=" breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Halaman Notifiaksi (Web Push Notification)</h1>
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
                <button id="reload-notifikasi" class="btn btn-success btn-sm">
                    <i class="ti-reload"></i>
                    Refrash
                </button>
            </div>
            <div class="form-notif m-auto">
                <form id="form-notif" method="post" enctype="multipart/form-data" onsubmit="webPush();return false;">
                    <div class="form-group mb-2">
                        <label for="judul" class="mb-1">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" required />
                    </div>
                    <div class="form-group mb-2">
                        <label for="ket" class="mb-1">Keterangan</label>
                        <textarea name="ket" id="ket" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="action" class="mb-1">Link Tujuan Ketika Klik Notif <span class="text-danger" style="font-size: 0.7em;">*Kosongi jika link dituju adalah halaman depan website ini</span></label>
                        <input type="text" name="action" class="form-control" id="action" />
                    </div>
                    <div class="form-group mb-2">
                        <label for="gambar" class="mb-1">Gambar</label>
                        <input type="file" name="gambar" class="form-control" id="gambar" />
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-warning text-white border">
                            <i class="ti-bell"></i>
                            Push Notifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal sukses -->
<div class="modal fade" id="suksesNotifModal" tabindex="-1" aria-labelledby="suksesNotifModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3 pb-4">
            <div class="modal-body" style="height: 250px;">
                <h2 style="font-weight: 700 !important;">Push Notifikasi Berhasil</h2>
                <img src="<?= base_url('assets/img/notif-success.gif') ?>" alt="...">
                <div class="d-block text-center">
                    <button type="button" class="btn btn-info btn-lg px-4 fs-3" data-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /Modal sukses -->

<script type="text/javascript">
    var base_url = window.location.origin + '/admin/';
    $('#reload-notifikasi').click(function() {
        $('#isi-content-halaman').load(base_url + 'view/notifikasi.php');
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>