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
            <h1 class="text-white">Toko Adasatra</h1>
        </div>
    </div>
</section>
<?php
function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if (getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if (getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if (getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if (getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if (getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}
?>

<section id="produk" class="produk p-0 mb-5">
    <div class="container">
        <div class="filter bg-white p-4 text-center shadow position-relative rounded">
            <h2 class="judul-section text-center m-0">Kategori Produk <?php echo get_client_ip() ?></h2>
        </div>
        <div class="row">
            <?php for ($i = 0; $i < 20; $i++) { ?>
                <div class="col-6 col-md-3 col-lg-2 mb-5">
                    <div class="card shadow-sm">
                        <img src="https://img.freepik.com/free-photo/apples-red-fresh-mellow-juicy-perfect-whole-white-desk_179666-271.jpg?w=1060&t=st=1683580806~exp=1683581406~hmac=c6b9b26cf2f9142a8bc7111f3419be12c6c2d8d9676997039cdf970d3ed49196" alt="..." style="aspect-ratio: 2/1.5;">
                        <div class="card-body px-3 py-3">
                            <h5 class="card-title nama-produk m-0">Buah Apel</h5>
                            <span style="font-weight: 800;">Rp 10.000 /Kg</span>
                            <!-- <span class="d-block">
                                <input type="number" value="1" min="1" style="max-width: 30%;" class="mt-3 text-center"> Kg
                            </span> -->
                        </div>
                        <div class="cart-button text-center">

                            <a href="#" class="btn bg-ijo btn-cart"><i class="fa-solid fa-cart-plus"></i></a>

                            <a href="produk/lihat/<?=$i?>" class="btn bg-ijo btn-cart"><i 
                            class="fa-regular fa-eye"></i></a>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>