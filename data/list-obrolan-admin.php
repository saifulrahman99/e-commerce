<?php
require('../assets/basis/kon.php');
require('../function.php');

$list_admin = mysqli_query($db, "SELECT * FROM akun");
foreach ($list_admin as $admin) { ?>
    <div class="card" style="border: none !important;">
        <a href="<?= base_url('pesan/' . $admin['id_akun']) ?>" class="text-decoration-none">
            <div class="card-body">
                <div class="img-user d-inline-block position-relative">
                    <img src="<?= base_url('assets/img/brand/adastra.png') ?>" alt="" style="max-width: 40px;">
                    <?php
                    if ($admin['status_online'] == '1') { ?>
                        <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                        </span>
                    <?php } else { ?>
                        <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        </span>

                    <?php } ?>
                </div>
                <label class="ms-2" style="font-weight: 600; cursor:pointer;"><?= $admin['username'] ?></label>
            </div>
        </a>
    </div>
<?php } ?>