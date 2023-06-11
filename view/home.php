<section id="home" class="home">
    <div class="container home">
        <div class="row row-tagline">
            <div class="tagline col-12 col-sm-6 d-flex flex-column justify-content-center cssanimation fadeInLeft">
                <h1 class="mb-3 mb-md-4">Belanja <span>Buah dan Sayur</span></h1>
                <p class="mb-3 mb-md-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab cupiditate vitae adipisci commodi non temporibus cumque ea ut, minima culpa.</p>
                <div class="cta">
                    <a href="produk" class="btn btn-lg shadow"> <img src="assets/img/shopping-cart.svg" alt=".." class="me-2 pb-1"> Belanja Sekarang</a>
                </div>
            </div>
            <div class="carousel-buah col-12 col-sm-6 d-flex flex-column justify-content-center bounce" style="z-index: 1;">
                <div class="buah">
                    <img src="<?= base_url('assets/img/home-buah.png') ?>" alt="...">
                </div>
            </div>
        </div>

    </div>
    <div class="circle-home"> </div>

</section>



<section id="login" class="login">
    <div class="container">
        <div class="panel panel-default mb-5">
            <?php
            if ($login_button == '') {
            ?>
                <div class="panel-body">
                    <img src="<?php echo $_SESSION['user_image'] ?>" alt="foto" style="border-radius: 50%;">
                    <h3><b>Name :</b> <?php echo $_SESSION['name'] ?></h3>
                    <h3><b>Email :</b> <?php echo $_SESSION['user_email_address'] ?></h3>
                    <h3><a href="Logout">Logout</a></h3>
                </div>
            <?php } else { ?>
                <h4 align="center" class="pt-5 mt-5" style="font-weight: 600 !important;">Login Melalui Akun Google Untuk Menggunakan Fitur Chat</h4>

                <p class="fw-bolder text-center">Gunakan fitur chat untuk menghubungi penjual secara langsung!</p>
                <div align="center"><?php echo $login_button ?></div>
            <?php }
            ?>
        </div>
    </div>
</section>
