$(document).ready(function () {

    load_data();

    function load_data(query) {
        $.ajax({
            url: "data/show-produk.php",
            method: "POST",
            data: { query: query },
            success: function (data) {
                $('#show-produk').html(data);
            }
        });
    }
    // $('#search_text').keyup(function () {
    //     var search = $(this).val();
    //     if (search != '') {
    //         load_data(search);
    //     }
    //     else {
    //         load_data();
    //     }
    // });

});

// tambah ke keranjnag dengan kuantitas 1
function addCart(id,opsi) {
    var id_produk = $("#id_produk" + id).val();
    var opsi_cart = opsi;

    $.ajax({
        url: "controllers/cart.php",
        method: "POST",
        data: { "id_produk": id_produk, "opsi" : opsi_cart },
        success: function () {

            const cartToast = document.getElementById('cartToast')

            const toast = new bootstrap.Toast(cartToast)

            toast.show()
        }
    });
}


function hapusItemCart(id,opsi) {
    var id_produk = id;
    var opsi_cart = opsi;
    
    $.ajax({
        url: "controllers/cart.php",
        method: "POST",
        data: { "id_produk": id_produk, "opsi" : opsi_cart },
        success: function () {
    
            window.location.reload(true);
        }
    });
}


// jalankan fungsi jml item dalam keranjang
setInterval(function () {
    updateCart()
}, 500);

function updateCart() {
    $.ajax({
        url: "data/jml-cart.php",
        method: "POST",
        success: function (data) {
            $('#jml-item-dalam-cart').html(data);
            $('#jml-item-dalam-cart-mobile').html(data);
        }
    });
}
