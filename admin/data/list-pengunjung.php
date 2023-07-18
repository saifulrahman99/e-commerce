<?php
require '../../assets/basis/kon.php';
require '../function/base_url.php';

$search = (isset($_POST['id_pengunjung']) && !empty($_POST['id_pengunjung'])) ? " WHERE id_pengunjung LIKE '%" . $_POST['id_pengunjung'] . "%'" : "";

$id_admin = $_COOKIE['id_admin'];

$list_pengunjung = mysqli_query($db, "SELECT DISTINCT id_pengunjung FROM obrolan $search ORDER BY waktu DESC");

foreach ($list_pengunjung as $p) {
    $id_pengunjung = $p['id_pengunjung'];

    $tmsg_new = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(status_terbaca) as jml_pesan FROM obrolan WHERE status_terbaca = '0'  AND pengirim = '$id_pengunjung' AND id_pengunjung = '$id_pengunjung' AND id_akun = '$id_admin'"));
?>
    <div class="card mb-0" style="border: none !important; box-shadow: none;">
        <a class="text-decoration-none col-12" onclick="idPengunjung(<?= $id_pengunjung ?>)" style="cursor: pointer;">
            <div class="card-body px-0 py-2 position-relative border-bottom">
                <div class="img-user d-inline-block position-relative">
                    <img src="<?= base_url('assets/img/user-profile.png') ?>" alt="" style="max-width: 40px;">
                </div>
                <label class="ms-2" style="font-weight: 600; cursor:pointer;">User<?= $id_pengunjung ?></label>

                <?php if (intval($tmsg_new['jml_pesan'] != 0)) { ?>
                    <span class="badge badge-success rounded-circle position-absolute py-1" style="right: 0; margin-top: 8px; font-size: 0.8em;"><?= intval($tmsg_new['jml_pesan']) ?></span>
                <?php } ?>
            </div>
        </a>
    </div>
<?php } 