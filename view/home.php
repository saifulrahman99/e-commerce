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

        <div class="row">

            <div class="promo my-2 col-12 col-md-8 col-lg-5">
                <div class="card bg-ijo border border-0 shadow">
                    <div class="card-body p-0 overflow-hidden">
                        <div class="row align-items-stretch">
                            <div id="content-promo-left" class="col-7 px-4 py-3 pe-0 pe-lg-0 px-lg-5 position-relative">

                                <h3 class="tebal-600 fs-5 text-white">Yogurt Biokul Manggo</h3>
                                <span class="coret-text fs-6 text-white">Rp 10.000</span>
                                <span class="label-diskon rounded p-1">-10%</span>
                                <span class="d-block fs-5 text-white" style="font-weight: 700;">Rp 9.000</span>

                                <a href="#" class="text-dark fw-bold text-white btn btn-warning px-3 my-3 position-relative" style="border-radius: 20px !important; border: 3px solid white; z-index: 1;">Lihat</a>

                                <svg id="wave" class="position-absolute" style="transform:rotate(0deg); transition: 0.3s;  left: 10; bottom:0; width: 500px;" viewBox="0 0 1440 240" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0">
                                            <stop stop-color="rgba(255, 255, 255, 0.3)" offset="0%"></stop>
                                            <stop stop-color="rgba(214.78, 255, 205.397, 0.3)" offset="100%"></stop>
                                        </linearGradient>
                                    </defs>
                                    <path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,0L48,28C96,56,192,112,288,144C384,176,480,184,576,156C672,128,768,64,864,52C960,40,1056,80,1152,108C1248,136,1344,152,1440,160C1536,168,1632,168,1728,144C1824,120,1920,72,2016,60C2112,48,2208,72,2304,84C2400,96,2496,96,2592,112C2688,128,2784,160,2880,172C2976,184,3072,176,3168,148C3264,120,3360,72,3456,60C3552,48,3648,72,3744,96C3840,120,3936,144,4032,160C4128,176,4224,184,4320,164C4416,144,4512,96,4608,76C4704,56,4800,64,4896,60C4992,56,5088,40,5184,64C5280,88,5376,152,5472,180C5568,208,5664,200,5760,188C5856,176,5952,160,6048,136C6144,112,6240,80,6336,60C6432,40,6528,32,6624,44C6720,56,6816,88,6864,104L6912,120L6912,240L6864,240C6816,240,6720,240,6624,240C6528,240,6432,240,6336,240C6240,240,6144,240,6048,240C5952,240,5856,240,5760,240C5664,240,5568,240,5472,240C5376,240,5280,240,5184,240C5088,240,4992,240,4896,240C4800,240,4704,240,4608,240C4512,240,4416,240,4320,240C4224,240,4128,240,4032,240C3936,240,3840,240,3744,240C3648,240,3552,240,3456,240C3360,240,3264,240,3168,240C3072,240,2976,240,2880,240C2784,240,2688,240,2592,240C2496,240,2400,240,2304,240C2208,240,2112,240,2016,240C1920,240,1824,240,1728,240C1632,240,1536,240,1440,240C1344,240,1248,240,1152,240C1056,240,960,240,864,240C768,240,672,240,576,240C480,240,384,240,288,240C192,240,96,240,48,240L0,240Z"></path>
                                </svg>
                            </div>

                            <div id="content-promo-right" class="col-5 ps-lg-0 posotion-relative overflow-hidden" style="z-index: 1;-webkit-clip-path: polygon(0 0, 100% 0%, 100% 100%, 35% 100%);
clip-path: polygon(0 0, 100% 0%, 100% 100%, 35% 100%);">
                                <img id="img-promo" src="<?= base_url('assets/img/produk/sawi-asin.jpg') ?>" alt="..." style="width: 250px" class="position-absolute end-0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
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