<section id="home" class="home">
    <div class="container home">
        <div class="row">
            <div class="tagline col-12 col-sm-6 d-flex flex-column justify-content-center">
                <h1 class="mb-4">Belanja Buah Dan Sayur Di <span>Butik Buah Adastra</span></h1>
                <p class="mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab cupiditate vitae adipisci commodi non temporibus cumque ea ut, minima culpa.</p>
                <div class="cta">
                    <a href="" class="btn btn-lg text-light shadow" style="background-color: #F0BB62;">Pesan Sekarang</a>
                </div>
            </div>
            <div class="carousel-buah col-12 col-sm-6 d-flex flex-column justify-content-center">
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
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="assets/img/buah/cabbage.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 indikator-carousel">
            <div class="slides">
                <a type="button" href="#carouselBuah" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"><img src="assets/img/buah/pineapple.png"></a>
                <a type="button" href="#carouselBuah" data-bs-slide-to="1" aria-label="Slide 2"><img src="assets/img/buah/strawberry.png"></a>
                <a type="button" href="#carouselBuah" data-bs-slide-to="2" aria-label="Slide 3"><img src="assets/img/buah/jeruk.png"></a>
                <a type="button" href="#carouselBuah" data-bs-slide-to="3" aria-label="Slide 4"><img src="assets/img/buah/melon.png"></a>
                <a type="button" href="#carouselBuah" data-bs-slide-to="4" aria-label="Slide 5"><img src="assets/img/buah/cabbage.png"></a>
            </div>
        </div>

    </div>
    <div class="circle-home"></div>
</section>

<section id="promo" class="promo">
    <div class="container">
        <div class="carousel-promo row d-flex flex-column align-items-center">
            <div id="carouselpromo" class="carousel slide col-10 col-md-8 col-lg-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="assets/img/promo/promo1.jpg" class="d-block w-100 rounded" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="10000">
                        <img src="assets/img/promo/promo2.jpg" class="d-block w-100 rounded" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselpromo" data-bs-slide="prev">
                    <span aria-hidden="true"><i data-feather="arrow-left-circle"></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselpromo" data-bs-slide="next">
                    <span aria-hidden="true"><i data-feather="arrow-right-circle"></i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section id="login" class="login">
    <div class="container">
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
</section>