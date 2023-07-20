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

<section id="promo" class="promo">
    <div class="container">
        <h2 class="judul-section fs-2 my-3 my-lg-0 mb-lg-3">Promo <span class="text-ijo judul-section fs-2 my-3 my-lg-0 mb-lg-3">Terbatas</span></h2>

        <!-- pakai carousel -->
        <div id="carouselPromoDekstop" class="carousel slide">

            <div class="carousel-indicators mb-0 mb-0">

                <a href="#carouselPromoDekstop" data-bs-slide-to="0" class="active mx-1 p-1 rounded-circle" aria-current="true" aria-label="Slide1"></a>

                <a href="#carouselPromoDekstop" data-bs-slide-to="1" class="mx-1 p-1 rounded-circle" aria-current="true" aria-label="Slide2"></a>

            </div>

            <div class="carousel-inner pe-0">

                <div class="carousel-item active">
                    <div class="d-flex pb-3 justify-content-center">

                        <div class="row col-lg-6 px-2">

                            <div id="content-promo-left" class=" col-lg-7 py-5 pe-0">

                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center shadow-sm" style="height: 100%;">
                                    <div class="countdown mb-2">
                                        <span class="p-2 bg-danger text-white rounded">4h</span>
                                        <span class="p-2 bg-danger text-white rounded">17j</span>
                                        <span class="p-2 bg-danger text-white rounded">4m</span>
                                        <span class="p-2 bg-danger text-white rounded">54d</span>
                                    </div>
                                    <h3 class="tebal-700 text-center">Lebih HEMAT Rp&nbsp1.000</h3>
                                </div>
                            </div>

                            <div id="content-promo-right" class="promo my-2 ps-lg-0  col-lg-5">
                                <div class="card border border-0 shadow rounded overflow-hidden">
                                    <div class="position-relative" style="aspect-ratio: 1/1;">

                                        <img id="img-promo" src="<?= base_url('assets/img/produk/apel-fuji.jpg') ?>" alt="...">

                                        <div class="overlay-promo position-absolute bottom-0 px-3 py-3">
                                            <h3 class="nmPromo tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                            <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                            <span class="label-diskon rounded p-1">-10%</span>
                                            <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                            <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row col-lg-6 px-2">

                            <div class=" col-lg-7 py-5 pe-0">

                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                    <div class="countdown mb-2">
                                        <span class="p-2 bg-danger text-white rounded">4h</span>
                                        <span class="p-2 bg-danger text-white rounded">17j</span>
                                        <span class="p-2 bg-danger text-white rounded">4m</span>
                                        <span class="p-2 bg-danger text-white rounded">54d</span>
                                    </div>
                                    <h3 class="tebal-700 text-center">Lebih HEMAT Rp&nbsp1.000</h3>
                                </div>
                            </div>

                            <div class="promo my-2 ps-lg-0  col-lg-5">
                                <div class="card border border-0 shadow rounded overflow-hidden">
                                    <div id="content-promo-left" class="position-relative" style="aspect-ratio: 1/1;">

                                        <img id="img-promo" src="<?= base_url('assets/img/produk/apel-fuji.jpg') ?>" alt="...">

                                        <div class="overlay-promo position-absolute bottom-0 px-3 py-3">
                                            <h3 class="nmPromo tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                            <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                            <span class="label-diskon rounded p-1">-10%</span>
                                            <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                            <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex pb-3 justify-content-center">

                        <div class="row col-lg-6 px-2">

                            <div class=" col-lg-7 py-5 pe-0">

                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center shadow-sm" style="height: 100%;">
                                    <div class="countdown mb-2">
                                        <span class="p-2 bg-danger text-white rounded">4h</span>
                                        <span class="p-2 bg-danger text-white rounded">17j</span>
                                        <span class="p-2 bg-danger text-white rounded">4m</span>
                                        <span class="p-2 bg-danger text-white rounded">54d</span>
                                    </div>
                                    <h3 class="tebal-700 text-center">Lebih HEMAT Rp&nbsp1.000</h3>
                                </div>
                            </div>

                            <div class="promo my-2 ps-lg-0  col-lg-5">
                                <div class="card border border-0 shadow rounded overflow-hidden">
                                    <div id="content-promo-left" class="position-relative" style="aspect-ratio: 1/1;">

                                        <img id="img-promo" src="<?= base_url('assets/img/produk/apel-fuji.jpg') ?>" alt="...">

                                        <div class="overlay-promo position-absolute bottom-0 px-3 py-3">
                                            <h3 class="nmPromo tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                            <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                            <span class="label-diskon rounded p-1">-10%</span>
                                            <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                            <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row col-lg-6 px-2">

                            <div class=" col-lg-7 py-5 pe-0">

                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                    <div class="countdown mb-2">
                                        <span class="p-2 bg-danger text-white rounded">4h</span>
                                        <span class="p-2 bg-danger text-white rounded">17j</span>
                                        <span class="p-2 bg-danger text-white rounded">4m</span>
                                        <span class="p-2 bg-danger text-white rounded">54d</span>
                                    </div>
                                    <h3 class="tebal-700 text-center">Lebih HEMAT Rp&nbsp1.000</h3>
                                </div>
                            </div>

                            <div class="promo my-2 ps-lg-0  col-lg-5">
                                <div class="card border border-0 shadow rounded overflow-hidden">
                                    <div id="content-promo-left" class="position-relative" style="aspect-ratio: 1/1;">

                                        <img id="img-promo" src="<?= base_url('assets/img/produk/apel-fuji.jpg') ?>" alt="...">

                                        <div class="overlay-promo position-absolute bottom-0 px-3 py-3">
                                            <h3 class="nmPromo tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                            <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                            <span class="label-diskon rounded p-1">-10%</span>
                                            <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                            <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev bg-white position-absolute top-50 translate-middle rounded-circle border" type="button" data-bs-target="#carouselPromoDekstop" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left"></i>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next bg-white position-absolute top-50 start-100 translate-middle rounded-circle border" type="button" data-bs-target="#carouselPromoDekstop" data-bs-slide="next">
                <i class="fa-solid fa-angle-right"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- /pakai carousel -->







        <!-- carousel Handheld -->
        <div id="carouselPromoHandheld" class="carousel slide">

            <div class="carousel-indicators mb-0 mb-0">

                <a href="#carouselPromoHandheld" data-bs-slide-to="0" class="active mx-1 p-1 rounded-circle" aria-current="true" aria-label="Slide1"></a>

                <a href="#carouselPromoHandheld" data-bs-slide-to="1" class="mx-1 p-1 rounded-circle" aria-current="true" aria-label="Slide2"></a>

            </div>

            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="d-flex pb-3 justify-content-center">
                        <div class="row col-12 col-lg-6 px-2">

                            <div id="content-promo-left" class=" col-md-7 col-lg-7 py-5 pe-0">

                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center shadow-sm" style="height: 100%;">
                                    <div class="countdown mb-2">
                                        <span class="p-2 bg-danger text-white rounded">4h</span>
                                        <span class="p-2 bg-danger text-white rounded">17j</span>
                                        <span class="p-2 bg-danger text-white rounded">4m</span>
                                        <span class="p-2 bg-danger text-white rounded">54d</span>
                                    </div>
                                    <h3 class="tebal-700 text-center">Lebih HEMAT Rp&nbsp1.000</h3>
                                </div>
                            </div>

                            <div id="content-promo-right" class="promo my-2 ps-lg-0 col-md-5 col-lg-5">
                                <div class="card border border-0 shadow rounded overflow-hidden">
                                    <div class="position-relative" style="aspect-ratio: 1/1;">

                                        <div class="countdown-mobile mb-2 position-absolute top-0 mt-3 ms-2">
                                            <span class="p-2 bg-danger text-white rounded">4h</span>
                                            <span class="p-2 bg-danger text-white rounded">17j</span>
                                            <span class="p-2 bg-danger text-white rounded">4m</span>
                                            <span class="p-2 bg-danger text-white rounded">54d</span>
                                        </div>

                                        <img id="img-promo" src="<?= base_url('assets/img/produk/apel-fuji.jpg') ?>" alt="...">

                                        <div class="overlay-promo position-absolute bottom-0 col-12 px-3 py-3">
                                            <h3 class="nmPromo tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                            <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                            <span class="label-diskon rounded p-1">-10%</span>
                                            <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                            <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="carousel-item">
                    <div class="d-flex pb-3 justify-content-center">

                        <div class="row col-12 col-lg-6 px-2">

                            <div id="content-promo-left" class="col-md-7 col-lg-7 py-5 pe-0">

                                <div id="banner-promo" class="border border-end-0 rounded-start p-3 d-flex align-items-center flex-column justify-content-center" style="height: 100%;">
                                    <div class="countdown mb-2">
                                        <span class="p-2 bg-danger text-white rounded">4h</span>
                                        <span class="p-2 bg-danger text-white rounded">17j</span>
                                        <span class="p-2 bg-danger text-white rounded">4m</span>
                                        <span class="p-2 bg-danger text-white rounded">54d</span>
                                    </div>
                                    <h3 class="tebal-700 text-center">Lebih HEMAT Rp&nbsp1.000</h3>
                                </div>
                            </div>

                            <div id="content-promo-right" class="promo my-2 ps-lg-0 col-md-5 col-lg-5">
                                <div class="card border border-0 shadow rounded overflow-hidden">
                                    <div class="position-relative" style="aspect-ratio: 1/1;">

                                        <div class="countdown-mobile mb-2 position-absolute top-0 mt-3 ms-2">
                                            <span class="p-2 bg-danger text-white rounded">4h</span>
                                            <span class="p-2 bg-danger text-white rounded">17j</span>
                                            <span class="p-2 bg-danger text-white rounded">4m</span>
                                            <span class="p-2 bg-danger text-white rounded">54d</span>
                                        </div>

                                        <img id="img-promo" src="<?= base_url('assets/img/produk/apel-fuji.jpg') ?>" alt="...">

                                        <div class="overlay-promo position-absolute bottom-0 col-12 px-3 py-3">
                                            <h3 class="nmPromo tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                            <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                            <span class="label-diskon rounded p-1">-10%</span>
                                            <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                            <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-absolute bottom-0 end-0 me-3" style="border-radius: 20px !important; border: 3px solid white;">Lihat</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev bg-white position-absolute top-50 translate-middle rounded-circle border" type="button" data-bs-target="#carouselPromoHandheld" data-bs-slide="prev">
                <i class="fa-solid fa-angle-left"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next bg-white position-absolute top-50 translate-middle rounded-circle border" type="button" data-bs-target="#carouselPromoHandheld" data-bs-slide="next">
                <i class="fa-solid fa-angle-right"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- /carousel Handheld -->

    </div>
</section>


<section id="about" class="about">
    <div class="container">
        <div class="row">
            <!-- <div class="col-12 text-center">
                <h2 class="judul-section">About Us</h2>
            </div> -->
            <div id="left-panel-about" class="col-12 col-md-8 col-lg-6">
                <img src="https://img.freepik.com/free-photo/woman-with-tablet-buying-healthy-food-supermarket-grocery-store_342744-1110.jpg?w=1060&t=st=1689548917~exp=1689549517~hmac=19dabc37579833615211d86c34acd4da95ee160043c8c637a306bbd2e6eeb450" alt="..." class="position-relative" style="right: -3em; width: 100%;-webkit-clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%);
clip-path: polygon(0 0, 100% 0%, 75% 100%, 0% 100%); overflow: hidden;
                ">

            </div>
            <div id="right-panel-about" class=" col-12 col-md-12 col-lg-6 p-lg-3">
                <div class="content-about py-lg-3 px-lg-4 position-relative bg-white shadow" style="left: -3em; border-radius: 20px;">

                    <h2 class="judul-section fs-2 my-3 my-lg-0 mb-lg-3">About <span class="text-ijo judul-section fs-2 my-3 my-lg-0 mb-lg-3">Us</span></h2>

                    <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Culpa vel neque ipsam provident velit, sed corrupti nemo fugiat consequuntur similique veniam. Aliquid exercitationem vitae, rem sapiente consectetur eaque blanditiis dignissimos.</p>
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem eum labore laborum inventore velit soluta pariatur ea dolores debitis ducimus dicta modi quo, perferendis odit, vitae illo natus veritatis doloremque.</p>
                    <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem eum labore laborum inventore velit soluta pariatur ea dolores debitis ducimus dicta modi quo, perferendis odit, vitae illo natus veritatis doloremque.</p>

                </div>
            </div>
        </div>
    </div>
</section>














<!-- <section id="login" class="login">
    <div class="container">
        <div class="panel panel-default mb-5">
            <?php
            //if ($login_button == '') {
            ?>
                <div class="panel-body">
                    <img src="<? // echo $_SESSION['user_image'] 
                                ?>" alt="foto" style="border-radius: 50%;">
                    <h3><b>Name :</b> <? // echo $_SESSION['name'] 
                                        ?></h3>
                    <h3><b>Email :</b> <? // echo $_SESSION['user_email_address'] 
                                        ?></h3>
                    <h3><a href="Logout">Logout</a></h3>
                </div>
            <? // } else { 
            ?>
                <h4 align="center" class="pt-5 mt-5" style="font-weight: 600 !important;">Login Melalui Akun Google Untuk Menggunakan Fitur Chat</h4>

                <p class="fw-bolder text-center">Gunakan fitur chat untuk menghubungi penjual secara langsung!</p>
                <div align="center"><? // echo $login_button 
                                    ?></div>
            <? // }
            ?>
        </div>
    </div>
</section> -->