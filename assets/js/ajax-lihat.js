setInterval(function () {
    subTotalLihat();
    disableTambah();
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