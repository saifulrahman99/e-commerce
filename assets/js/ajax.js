$(document).ready(function () {

    show_produk();
    show_transaksi();


    // produk
    function show_produk() {
        $.ajax({
            url: "data/show-produk.php",
            method: "POST",
            success: function (data) {
                $('#show-produk').html(data);
            }
        });
    }

    // pencarian data produk
    $("#search-button").click(function () {
        var nama = $('#search_show_produk').val();
        var kategori = $('#filter-value').val();
        $.ajax({
            url: "data/show-produk.php",
            method: "POST",
            data: { nama: nama, kategori: kategori },
            success: function (data) {
                $('#show-produk').html(data);
            }
        });
    });


    // transaksi
    function show_transaksi(query) {
        $.ajax({
            url: "data/show-transaksi.php",
            method: "POST",
            data: { query: query },
            success: function (data) {
                // document.getElementById('accordionTransaksi').innerHTML = data;
                $('#accordionTransaksi').html(data);
            }
        });
    }


});





// tambah ke keranjnag dengan kuantitas 1
function addCart(id, harga, opsi) {
    var id_produk = $("#id_produk" + id).val();
    var opsi_cart = opsi;
    var harga_produk = harga;
    var base_url = window.location.origin + "/";
    $.ajax({
        url: base_url + "controllers/cart.php",
        method: "POST",
        data: { "id_produk": id_produk, "opsi": opsi_cart, "harga": harga_produk },
        success: function () {

            const cartToast = document.getElementById('cartToast')

            const toast = new bootstrap.Toast(cartToast)

            toast.show()
        }
    });
}


function hapusItemCart(id, opsi) {
    var id_produk = id;
    var opsi_cart = opsi;
    var base_url = window.location.origin + "/";
    $.ajax({
        url: base_url + "controllers/cart.php",
        method: "POST",
        data: { "id_produk": id_produk, "opsi": opsi_cart },
        success: function () {

            window.location.reload(true);
        }
    });
}


// jalankan fungsi jml item dalam keranjang
setInterval(function () {
    updateCart();
}, 1000);




function updateCart() {
    var base_url = window.location.origin + "/";
    $.ajax({
        url: base_url + "data/jml-cart.php",
        method: "POST",
        success: function (data) {

            var jml = data;

            if (jml < 1) {
                document.getElementById("jml-item-dalam-cart").style.display = "none";
                document.getElementById("jml-item-dalam-cart-mobile").style.display = "none";
            } else {
                document.getElementById("jml-item-dalam-cart").style.display = "block";
                document.getElementById("jml-item-dalam-cart-mobile").style.display = "block";
                $('#jml-item-dalam-cart').html(data);
                $('#jml-item-dalam-cart-mobile').html(data);
            }
        }
    });

}
