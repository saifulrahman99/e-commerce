function addCart(id, opsi) {
    var id_produk = $("#id_produk" + id).val();
    var opsi_cart = opsi;

    $.ajax({
        url: "controllers/cart.php",
        method: "POST",
        data: { "id_produk": id_produk, "opsi": opsi_cart },
        success: function () {

            const cartToast = document.getElementById('cartToast')

            const toast = new bootstrap.Toast(cartToast)

            toast.show()
        }
    });
}
