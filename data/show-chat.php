<?php
require('../assets/basis/kon.php');
require('../function.php');
$id_pengunjung = $_COOKIE['id_pengunjung'];
$id_admin = $_POST['id_admin'];

$select = mysqli_query($db, "SELECT * FROM obrolan WHERE id_pengunjung = '$id_pengunjung' AND id_akun = '$id_admin'");
$tgl = '';
foreach ($select as $pesan) {

    $waktu = explode(' ', $pesan['waktu']);

    if ($tgl != substr($pesan['waktu'], 0, -8)) {
        $tgl = substr($pesan['waktu'], 0, -8); ?>

        <label class="col-12 text-center tebal-600" style="font-size: 0.7em;"><?= $tgl ?></label>
    <?php }

    if ($id_pengunjung == $pesan['pengirim']) { ?>

        <!-- .msg-sent -->
        <li class="pb-1">
            <div class="msg-sent msg-container">

                <div class="msg-box">
                    <div class="inner-box p-2 px-3">
                        <div class="meg">
                            <p class="text-break mb-0">
                                <?= $pesan['pesan'] ?>
                            </p>
                            <span class="send-time-sent d-block text-end" style="margin-top: -3px;"><?= substr($waktu[1], 0, -3) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </li>
        <!-- /.msg-sent -->

    <?php } else { ?>

        <!-- .msg-received -->
        <li class="pb-1">
            <div class="msg-received msg-container">
                <div class="avatar">
                    <img src="<?= base_url('assets/img/brand/adastra.png') ?>" alt="">
                </div>
                <div class="msg-box">
                    <div class="inner-box bg-ijo p-2 px-3">
                        <div class="meg">
                            <p class="text-break mb-0 text-white">
                                <?= $pesan['pesan'] ?>
                            </p>
                            <span class="send-time-received d-block text-white text-end" style="margin-top: -3px;"><?= substr($waktu[1], 0, -3) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </li>
        <!-- /.msg-received -->
<?php }
}
?>