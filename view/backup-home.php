<section id="promo" class="promo">
    <div class="container container-section">
        <h2 class="judul-section">EVENT & <span class="text-light judul-section bg-ijo px-2">PROMO</span></h2>
        <div class="d-flex promo-content grap-content gap-3">

            <img src="assets/img/promo/promo1.jpg" class="rounded" alt="...">
            <img src="assets/img/promo/promo2.jpg" class="rounded" alt="...">
            <img src="assets/img/promo/promo1.jpg" class="rounded" alt="...">
            <img src="assets/img/promo/promo2.jpg" class="rounded" alt="...">
            <img src="assets/img/promo/promo1.jpg" class="rounded" alt="...">
            <img src="assets/img/promo/promo2.jpg" class="rounded" alt="...">

        </div>

        <div class="produk-promo pt-3 pb-4 d-inline d-flex scroll-efek-x">

            <!-- produk -->
            <?php for ($i = 0; $i < 10; $i++) { ?>
                <div class="col-6 col-md-3 col-lg-2 p-1 me-1 item-scroll">
                    <div class="card shadow-sm">
                        <img src="https://img.freepik.com/free-photo/apples-red-fresh-mellow-juicy-perfect-whole-white-desk_179666-271.jpg?w=1060&t=st=1683580806~exp=1683581406~hmac=c6b9b26cf2f9142a8bc7111f3419be12c6c2d8d9676997039cdf970d3ed49196" alt="..." style="aspect-ratio: 2/1.5;">
                        <div class="card-body px-3 py-3">
                            <h5 class="card-title nama-produk m-0">Buah Apel</h5>
                            <span style="font-weight: 800;">Rp 10.000 /Kg</span>
                            <!-- <span class="d-block">
                                <input type="number" value="1" min="1" style="max-width: 30%;" class="mt-3 text-center" min="0" > Kg
                            </span> -->
                        </div>
                        <div class="cart-button text-center">
                            <a href="#" class="btn bg-ijo btn-cart"><i class="fa-solid fa-cart-plus"></i></a>
                            <a href="produk/lihat/<?= $i ?>" class="btn bg-ijo btn-cart"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- end produk -->

        </div>
        <!-- navigasi -->
        <div class="tombol-navigasi text-center">
            <button id="btn-kiri-produk-promo" class="btn-slide d-inline ms-2 me-3"> <i class="fa-solid fa-chevron-left"></i> </button>
            <button id="btn-kanan-produk-promo" class="btn-slide d-inline"> <i class="fa-solid fa-chevron-right"></i> </button>
        </div>
    </div>
</section>

<section id="terlaris" class="terlaris">
    <div class="container container-section">
        <h2 class="judul-section">Produk <span class="text-light judul-section bg-ijo px-2">Terlaris</span></h2>
        <div class="produk-terlaris pt-3 pb-4 d-inline d-flex scroll-efek-x">

            <!-- produk -->
            <?php for ($i = 0; $i < 10; $i++) { ?>
                <div class="col-6 col-md-3 col-lg-2 p-1 me-1 item-scroll">
                    <div class="card shadow-sm">
                        <img src="https://img.freepik.com/free-photo/apples-red-fresh-mellow-juicy-perfect-whole-white-desk_179666-271.jpg?w=1060&t=st=1683580806~exp=1683581406~hmac=c6b9b26cf2f9142a8bc7111f3419be12c6c2d8d9676997039cdf970d3ed49196" alt="..." style="aspect-ratio: 2/1.5;">
                        <div class="card-body px-3 py-3">
                            <h5 class="card-title nama-produk m-0">Buah Apel</h5>
                            <span style="font-weight: 800;">Rp 10.000 /Kg</span>
                            <!-- <span class="d-block">
                                <input type="number" value="1" min="1" style="max-width: 30%;" class="mt-3 text-center" min="0" > Kg
                            </span> -->
                        </div>
                        <div class="cart-button text-center">
                            <a href="#" class="btn bg-ijo btn-cart"><i class="fa-solid fa-cart-plus"></i></a>
                            <a href="produk/lihat/<?= $i ?>" class="btn bg-ijo btn-cart"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- end produk -->

        </div>
        <!-- navigasi -->
        <div class="tombol-navigasi text-center">
            <button id="btn-kiri-produk-terlaris" class="btn-slide d-inline ms-2 me-3"> <i class="fa-solid fa-chevron-left"></i> </button>
            <button id="btn-kanan-produk-terlaris" class="btn-slide d-inline"> <i class="fa-solid fa-chevron-right"></i> </button>
        </div>
    </div>
</section>

<section id="terbaru" class="terbaru">
    <div class="container container-section">
        <h2 class="judul-section">Produk <span class="text-light judul-section bg-ijo px-2">terbaru</span></h2>
        <div class="produk-terbaru pt-3 pb-4 d-inline d-flex scroll-efek-x">

            <!-- produk -->
            <?php for ($i = 0; $i < 10; $i++) { ?>
                <div class="col-6 col-md-3 col-lg-2 p-1 me-1 item-scroll">
                    <div class="card shadow-sm">
                        <img src="https://img.freepik.com/free-photo/apples-red-fresh-mellow-juicy-perfect-whole-white-desk_179666-271.jpg?w=1060&t=st=1683580806~exp=1683581406~hmac=c6b9b26cf2f9142a8bc7111f3419be12c6c2d8d9676997039cdf970d3ed49196" alt="..." style="aspect-ratio: 2/1.5;">
                        <div class="card-body px-3 py-3">
                            <h5 class="card-title nama-produk m-0">Buah Apel</h5>
                            <span style="font-weight: 800;">Rp 10.000 /Kg</span>
                            <!-- <span class="d-block">
                                <input type="number" value="1" min="1" style="max-width: 30%;" class="mt-3 text-center" min="0" > Kg
                            </span> -->
                        </div>
                        <div class="cart-button text-center">
                            <a href="#" class="btn bg-ijo btn-cart"><i class="fa-solid fa-cart-plus"></i></a>
                            <a href="produk/lihat/<?= $i ?>" class="btn bg-ijo btn-cart"><i class="fa-regular fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- end produk -->

            <div class="col-4 col-md-2 col-lg-1 p-1 item-scroll">
                <div class="card shadow-sm position-relative" style="min-height:30vh;">
                    <a href="#" class="position-absolute top-50 start-50 translate-middle p-2 text-decoration-none text-center">
                        <i data-feather="arrow-right" class="mb-2"></i>
                        <span class="d-block fw-bolder">More</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- navigasi -->
        <div class="tombol-navigasi text-center">
            <button id="btn-kiri-produk-terbaru" class="btn-slide d-inline ms-2 me-3"> <i class="fa-solid fa-chevron-left"></i> </button>
            <button id="btn-kanan-produk-terbaru" class="btn-slide d-inline"> <i class="fa-solid fa-chevron-right"></i> </button>
        </div>
    </div>
</section>