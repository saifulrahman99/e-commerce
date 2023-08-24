setInterval(function () {
    subTotalLihat();
    disableTambah();
    updateCart();
}, 500);

function addCartLihat(id, harga, opsi) {
    var id_produk = id;
    var jmlItem = $("#jml-item").val();
    var opsi_cart = opsi;
    var harga_produk = harga;
    var base_url = window.location.origin + "/";
    $.ajax({
        url: base_url + "controllers/cart.php",
        method: "POST",
        data: { "id_produk": id_produk, "opsi": opsi_cart, "jml-item": jmlItem, "harga": harga_produk },
        success: function () {
            document.getElementById("jml-item").value = 1;

            const cartToast = document.getElementById('cartToast')

            const toast = new bootstrap.Toast(cartToast)

            toast.show()
        }
    });
}

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