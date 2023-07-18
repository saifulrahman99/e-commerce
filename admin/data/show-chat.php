<?php
require_once '../../assets/basis/kon.php';
require '../function/base_url.php';
$id_admin = $_COOKIE['id_admin'];
$id_pengunjung = (isset($_COOKIE['idC_pengunjung']) && !empty($_COOKIE['idC_pengunjung']) ? $_COOKIE['idC_pengunjung'] : "");

$select = mysqli_query($db, "SELECT * FROM obrolan WHERE id_pengunjung = '$id_pengunjung' AND id_akun = '$id_admin'");

$tmsg_new = mysqli_num_rows($select);

$tgl = '';

foreach ($select as $pesan) {

    $waktu = explode(' ', $pesan['waktu']);

    if ($tgl != substr($pesan['waktu'], 0, -8)) {
        $tgl = substr($pesan['waktu'], 0, -8); ?>

        <label class="col-12 text-center tebal-600" style="font-size: 0.7em;"><?= $tgl ?></label>

    <?php }

    if ($id_admin == $pesan['pengirim']) { ?>

        <li class="pb-2">
            <div class="msg-sent msg-container">

                <div class="msg-box">
                    <div class="inner-box py-1">
                        <div class="meg">
                            <p class="text-break mb-0 text-dark" style="font-size: 1em;">
                                <?= $pesan['pesan'] ?>
                            </p>
                            <span class="send-time-sent d-block"><?= substr($waktu[1], 0, -3) ?></span>
                        </div>
                    </div>
                </div>
            </div><!-- /.msg-sent -->
            <div class="clear"></div>
        </li>

    <?php } else { ?>
        <li class="pb-2">
            <div class="msg-received msg-container">
                <div class="avatar">
                    <img src="<?= base_url('assets/img/user-profile.png') ?>" alt="">
                </div>
                <div class="msg-box">
                    <div class="inner-box py-1">
                        <div class="meg text-white">
                            <p class="text-break mb-0 text-white" style="font-size: 1em;">
                                <?= $pesan['pesan'] ?>
                            </p>
                            <span class="send-time-received d-block"><?= substr($waktu[1], 0, -3) ?></span>

                        </div>
                    </div>
                </div>
            </div><!-- /.msg-received -->
            <div class="clear"></div>
        </li>

<?php }
}
?>