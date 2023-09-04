$(document).ready(function () {
    $('.klik_menu').click(function () {
        var menu = $(this).attr('id');
        var base_url = window.location.origin + '/admin/';

        if (menu == "dashboard") {
            $('#isi-content-halaman').load(base_url + 'view/dashboard.php');
        } else if (menu == "promo") {
            $('#isi-content-halaman').load(base_url + 'view/promo.php');
        } else if (menu == "pesan") {
            $('#isi-content-halaman').load(base_url + 'view/pesan.php');
        } else if (menu == "produk") {
            $('#isi-content-halaman').load(base_url + 'view/produk.php');
        } else if (menu == "kategori") {
            $('#isi-content-halaman').load(base_url + 'view/kategori.php');
        } else if (menu == "transaksi") {
            $('#isi-content-halaman').load(base_url + 'view/transaksi.php');
        } else if (menu == "api") {
            $('#isi-content-halaman').load(base_url + 'view/api.php');
        } else if (menu == "notifikasi") {
            $('#isi-content-halaman').load(base_url + 'view/notifikasi.php');
        } else if (menu == "toko") {
            $('#isi-content-halaman').load(base_url + 'view/toko.php');
        } else if (menu == "pengunjung") {
            $('#isi-content-halaman').load(base_url + 'view/pengunjung.php');
        } else if (menu == "rekomendasi") {
            $('#isi-content-halaman').load(base_url + 'view/rekomendasi.php');
        } else if (menu == "peruser") {
            $('#isi-content-halaman').load(base_url + 'view/peruser.php');
        }

        $('.klik_menu.active').removeClass('active');
        $(this).addClass('active');

    });

    var base_url = window.location.origin + '/admin/';
    $('#dashboard').addClass('active');
    // halaman yang di load default pertama kali
    $('#isi-content-halaman').load(base_url + 'view/dashboard.php');
    // $('#isi-content-halaman').load('view/produk.php');

});
