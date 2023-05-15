<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="keranjang" class="keranjang">
    <div class="container">

        <div class="row g-2 p-4 bg-white">

            <h1 class="judul-section">Keranjang Belanja</h1>

            <div class="col-12 col-md-9 mb-3">

                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <!-- item cart -->
                    <div class="list-item py-3">

                        <div class="item row align-items-center">

                            <div class="col-5 col-md-2">
                                <img src="https://img.freepik.com/free-photo/apples-red-fresh-mellow-juicy-perfect-whole-white-desk_179666-271.jpg?w=1060&t=st=1683580806~exp=1683581406~hmac=c6b9b26cf2f9142a8bc7111f3419be12c6c2d8d9676997039cdf970d3ed49196" class="item-img" alt="..." style="aspect-ratio: 2/1.5;">
                            </div>


                            <div class="col-7 col-md-6 row">
                                <div class="col-12 col-md-8 text-start text-md-center">
                                    <span class="nama_produk mb-2">Apel Malang</span>
                                </div>
                                <div class="col-12 col-md-4 text-start text-md-center">
                                    <span class="harga" style="font-weight: 800 !important;">Rp 10.000</span>
                                </div>

                            </div>

                            <div class="col-12 col-md-3 row">
                                <div class="col-6 col-md-9 mt-3">
                                    <ul class="pagination jml-item">
                                        <li class="page-item">
                                            <button class="page-link" onclick="kurang(<?=$i?>)"><i class="fa-solid fa-minus"></i></button>
                                        </li>
                                        <li class="page-item">
                                            <input type="number" id="jml-item<?=$i?>" class="form-control" min="1" value="1"></input>
                                        </li>
                                        <li class="page-item">
                                            <button class="page-link" onclick="tambah(<?=$i?>)"><i class="fa-solid fa-plus"></i></button>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-3 text-end mt-3">
                                    <a href="#" class="bg-danger rounded btn text-decoration-none">
                                        <img src="assets/img/trash.svg" alt="">
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- item cart -->
                <?php } ?>

            </div>

            <div class="col-12 col-md-3 px-0 px-md-2">

                <div class="tagihan rounded d-flex flex-column p-3" style="font-weight: 600;">
                    <div class="pengiriman mb-4 d-flex justify-content-around">

                        <input type="radio" class="btn-check" name="options-outlined" id="ambil-di-toko" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="ambil-di-toko">Ambli di Toko</label>

                        <input type="radio" class="btn-check" name="options-outlined" id="ojek-online" autocomplete="off">
                        <label class="btn btn-outline-primary" for="ojek-online">Ojek Online</label>
                    </div>

                    <h5>Total</h5>
                    <span> Rp 10.000</span>

                    <button class="btn bg-ijo text-white mt-3">Checkout</button>
                </div>
            </div>
        </div>

    </div>
</section>

<div class="spasi-header" style="padding-top: 10rem;"></div>