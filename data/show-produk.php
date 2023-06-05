<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

require('../assets/basis/kon.php');
if (isset($_POST["query"])) {

    $search = mysqli_real_escape_string($db, $_POST["query"]);

    $sql = "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE nm_produk LIKE '%" . $search . "%' OR kategori LIKE '%" . $search . "%' ";
    $query = mysqli_query($db, $sql);
} else {
    $query = mysqli_query($db, "SELECT * FROM produk ORDER BY id_produk DESC");
}

if (mysqli_num_rows($query) > 0) {
    foreach ($query as $produk) { ?>
        <div class="col-6 col-md-3 col-lg-2 mb-5">
            <div class="card cssanimation fadeInBottom">
                <img src="<?= $produk['gambar'] ?>" alt="..." style="aspect-ratio: 2/1.5;">
                <div class="card-body px-3 py-3">
                    <h5 class="card-title nama-produk m-0"><?= $produk['nm_produk'] ?></h5>
                    <span style="font-weight: 800;"><?= rupiah($produk['harga']) ?></span>
                </div>
                <input id="id_produk<?= $produk['id_produk'] ?>" type="text" value="<?= $produk['id_produk'] ?>" hidden>
                <div class="cart-button text-center">

                    <a class="btn bg-ijo btn-cart" onclick="addCart(<?= $produk['id_produk'] ?>,'direct')"><i class="fa-solid fa-cart-plus"></i></a>

                    <a href="produk/lihat/<?= $produk['id_produk'] ?>" class="btn bg-ijo btn-cart"><i class="fa-regular fa-eye"></i></a>

                </div>
            </div>
        </div>
<?php  }
} else {
    echo "
    <div class='text-center' style='margin-top:-8rem;'>
    <img class='gif-empty-search' src='assets/img/empty-search.gif' alt='...' style='max-width:25rem;'>
    <h3 class='fw-bolder m-0 bg-white text-center' style='margin-top: -10rem;'>Hasil Pencarian Tidak Ditemukan</h3></div>";
} ?>