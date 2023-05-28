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


<!-- toast pemberitahuan kalau berhasil dimasukkan ke keranjang -->
<section id="produk" class="produk p-0 mb-5">
    <div class="container">
        <div class="filter bg-white p-4 text-center shadow position-relative rounded">
           a
        </div>
        <div id="show-produk" class="row">
        </div>
    </div>

</section>