<!-- <h2>Halo Produk</h2> -->
<?php
// $otp = rand(100000, 999999);
// echo  "OTP kamu = $otp";
?>
<div class="bar-navigasi shadow-sm"></div>

<section id="toko-produk" class="toko-produk">
    <div class="img-toko-produk position-relative">
        <img src="https://img.freepik.com/free-photo/colorful-collage-fruits-texture-close-up_23-2149870264.jpg?w=1380&t=st=1683871383~exp=1683871983~hmac=80a6978cff7a15935ab6e9b272def2581437c43426469fedc5b3e5298df1c547" alt="">
        <div class="overlay-img-toko-produk position-absolute top-0 d-flex justify-content-center align-items-center">
            <h1 class="text-white">Toko Adastra</h1>
        </div>
    </div>
</section>

<!-- toast pemberitahuan kalau berhasil dimasukkan ke keranjang -->
<section id="produk" class="produk p-0 mb-5">
    <div class="container">
        <script type="text/javascript">
            function open_filter() {
                const filter = document.getElementsByClassName('filter-melayang');

                filter.preventDefault();
                this.classList.toggle('open-filter');
            }
        </script>

        <div class="filter bg-white p-4 text-center shadow position-relative rounded m-auto">
            <div class="input-group">
                <button class="filter-search input-group-text bg-white" id="inputGroup-sizing-default" onclick="open_filter()">
                    <i data-feather="sliders"></i>
                </button>

                <input type="text" name="search_produk" id="search_show_produk" placeholder="Cari produk..." class="form-control">

                <button class="input-group-text btn btn-light border" id="search-button" style="z-index: 0;">
                    <i data-feather="search"></i>
                </button>

                <div id="filter-melayang" class="filter-melayang position-absolute bg-white p-3 shadow start-0 text-start" style="z-index: 1; top: 3rem; width: 100%;">
                    <span class="d-block fw-bolder mb-2">Filter Kategori</span>
                    <select id="filter-value" class="form-select" aria-label="Default select example">
                        <option selected>All</option>
                        <?php
                        $kategori = mysqli_query($db, "SELECT * FROM kategori");
                        foreach ($kategori as $k) { ?>
                            <option class="form-select"><?= ucwords($k['kategori']) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>


        <div id="show-produk" class="row big-demo go-wide" data-js="filtering-demo">
        </div>
    </div>

</section>