<section id="home" class="home">
    <div class="container home">
        <div class="row">
            <div class="tagline col-12 col-sm-6 d-flex flex-column justify-content-center">
                <h1 class="mb-4">Belanja Buah Dan Sayur Di <span>Butik Buah Adastra</span></h1>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab cupiditate vitae adipisci commodi non temporibus cumque ea ut, minima culpa.</p>
                <div class="cta">
                    <a href="" class="btn btn-lg btn btn-outline-success" style="font-weight: 600 !important;">Pesan Sekarang</a>
                </div>
            </div>
            <div class="carousel-buah col-12 col-sm-6">
                <div id="carouselBuah" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="5000">
                            <img src="assets/img/buah/pineapple.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="assets/img/buah/strawberry.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="assets/img/buah/jeruk.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="assets/img/buah/melon.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2 align="center" class="pt-5 mt-5">Login Melalui Akun Google Menggunakan PHP</h2>

        <p style="max-width:35vw; text-align:center; margin: auto; margin-bottom:1rem;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, voluptatem!.</p>
        <div class="panel panel-default mb-5">
            <?php
            if ($login_button == '') {
            ?>
                <div class="panel-heading">Welcome User</div>
                <div class="panel-body">
                    <img src="<?php echo $_SESSION['user_image'] ?>" alt="foto" style="border-radius: 50%;">
                    <h3><b>Name :</b> <?php echo $_SESSION['name'] ?></h3>
                    <h3><b>Email :</b> <?php echo $_SESSION['user_email_address'] ?></h3>
                    <h3><a href="Logout">Logout</h3>
                </div>
            <?php } else { ?>
                <div align="center"><?php echo $login_button ?></div>
            <?php }
            ?>
        </div>
    </div>
    <div class="circle-home"></div>
</section>