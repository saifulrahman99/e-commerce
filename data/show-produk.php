<?php
$db = mysqli_connect("localhost", "root", "", "adastra");
$query = mysqli_query($db, "SELECT * FROM produk");
foreach ($query as $produk) {
?>
    <div class="col-6 col-md-3 col-lg-2 mb-5">
        <div class="card">
            <img src="<?= $produk['gambar'] ?>" alt="..." style="aspect-ratio: 2/1.5;">
            <div class="card-body px-3 py-3">
                <h5 class="card-title nama-produk m-0"><?= $produk['nm_produk'] ?></h5>
                <span style="font-weight: 800;">Rp <?= $produk['harga'] ?></span>
            </div>
            <input id="id_produk<?= $produk['id_produk'] ?>" type="text" value="<?= $produk['id_produk'] ?>" hidden>
            <div class="cart-button text-center">

                <a class="btn bg-ijo btn-cart" onclick="addCart(<?= $produk['id_produk'] ?>,'direct')"><i class="fa-solid fa-cart-plus"></i></a>

                <a href="produk/lihat/<?= $produk['id_produk'] ?>" class="btn bg-ijo btn-cart"><i class="fa-regular fa-eye"></i></a>

            </div>
        </div>
    </div>
<?php  } ?>