<?php
require_once '../../assets/basis/kon.php';
require '../function/base_url.php';
$select = mysqli_query($db, "SELECT * FROM kategori ORDER BY id_kategori DESC");
?>
<div class=" breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Halaman Kategori</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="kategori" class="content pb-1">
    <!-- Animated -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button id="reload-kategori" class="btn btn-success btn-sm">
                        <i class="ti-reload"></i>
                        Refrash
                    </button>
                    <div class="row">
                        <div class="col-12 col-md-3 mb-4 mb-md-0">
                            <form id="form-kategori" class="border rounded p-3 mt-3">
                                <div class="form-group mb-2">
                                    <label for="nm_kategori" class="mb-1">Nama Kategori</label>
                                    <input type="text" name="nm_kategori" class="form-control" id="nm_kategori"  />
                                    <label for="kode_kategori" class="mb-1">Kode Kategori</label>
                                    <input type="text" name="kode_kategori" class="form-control" id="kode_kategori"  />
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-info" onclick="kategori('','add')">Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-9">
                            <table id="tabel-kategori" class="table table-striped">
                                <thead>
                                    <th style="max-width: 40px;">#</th>
                                    <th style="max-width: 240px;">Nama Kategori</th>
                                    <th>Kode Kategori</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($select as $k) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $k['kategori'] ?></td>
                                            <td><?= $k['kode_kategori'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger mx-2" data-toggle="modal" data-target="#hapusKategori<?= $k['id_kategori'] ?>">
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
        </div>
    </div>


    <?php
    foreach ($select as $modal) { ?>
        <!-- Modal -->
        <div class="modal fade" id="hapusKategori<?= $modal['id_kategori'] ?>" tabindex="-1" aria-labelledby="hapusKategori<?= $modal['id_kategori'] ?>Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusKategori<?= $modal['id_kategori'] ?>Label">
                            <i class="ti-alert"></i> Peringatan !
                        </h5>
                    </div>
                    <div class="modal-body">
                        <p class="text-dark">
                            Yakin Untuk Menghapus Data Kategori <b><?= $modal['kategori'] ?></b> ?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                        <button type="button" class="btn btn-danger col-4" onclick="kategori(<?= $modal['id_kategori'] ?>,'delete')">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>


<script>
    $(document).ready(function() {
        $('#tabel-kategori').DataTable({
            responsive: true
        });
        var base_url = window.location.origin + '/admin/';
        $('#reload-kategori').click(function() {
            $('#isi-content-halaman').load(base_url + 'view/kategori.php');
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>