<?php
require_once '../../assets/basis/kon.php';
require '../function/base_url.php';
$select = mysqli_query($db, "SELECT * FROM pengunjung ORDER BY id_pengunjung DESC");
?>
<div class=" breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-12">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Daftar Pengunjung</h1>
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
                <button id="reload-pengunjung" class="btn btn-success btn-sm">
                    <i class="ti-reload"></i>
                    Refrash
                </button>
            </div>
            <div class="table">

                <table id="tabel-pengunjung" class="table table-striped">
                    <thead>
                        <th style="max-width: 40px;">#</th>
                        <th style="width: 100px !important;">IP address</th>
                        <th>Browser</th>
                        <th>OS</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($select as $p) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <?php
                                $length = strlen($p['ip_address']);
                                if ($length > 20) {
                                    $text = substr($p['ip_address'], 0, 20);
                                    $ip_address = $text . "...";
                                } else {
                                    $ip_address = $p['ip_address'];
                                }
                                ?>
                                <td><?= $ip_address ?></td>
                                <td><?= $p['browser'] ?></td>
                                <td><?= $p['os'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger mx-2" data-toggle="modal" data-target="#hapusPengunjung<?= $p['id_pengunjung'] ?>">
                                        <i class="ti-trash"></i>
                                        hapus
                                    </button>
                                </td>
                                <div class="modal fade" id="hapusPengunjung<?= $p['id_pengunjung'] ?>" tabindex="-1" aria-labelledby="hapusPengunjung<?= $p['id_pengunjung'] ?>Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusPengunjung<?= $p['id_pengunjung'] ?>Label">
                                                    <i class="ti-alert"></i> Peringatan !
                                                </h5>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="<?= base_url('assets/img/warning.gif') ?>" alt="">
                                                <p class="text-dark">
                                                    Yakin Untuk Menghapus Data Pengunjung <b><?= $p['ip_address'] ?></b> ?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary col-4" data-dismiss="modal">Tidak</button>
                                                <button type="button" class="btn btn-danger col-4" onclick="pengunjung(<?= $p['id_pengunjung'] ?>)">Ya </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tr>


                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    $(document).ready(function() {
        $('#tabel-pengunjung').DataTable({
            responsive: true,
            "pagingType": "simple"
        });
        var base_url = window.location.origin + '/admin/';
        $('#reload-pengunjung').click(function() {
            $('#isi-content-halaman').load(base_url + 'view/pengunjung.php');
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>