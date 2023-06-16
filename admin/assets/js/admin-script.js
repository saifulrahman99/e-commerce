$(document).ready(function () {
    $('.klik_menu').click(function () {
        var menu = $(this).attr('id');
        if (menu == "dashboard") {
            $('#isi-content-halaman').load('view/dashboard.php');
        } else if (menu == "promo") {
            $('#isi-content-halaman').load('view/promo.php');
        } else if (menu == "pesan") {
            $('#isi-content-halaman').load('view/pesan.php');
        } else if (menu == "produk") {
            $('#isi-content-halaman').load('view/produk.php');
        } else if (menu == "kategori") {
            $('#isi-content-halaman').load('view/kategori.php');
        } else if (menu == "transaksi") {
            $('#isi-content-halaman').load('view/transaksi.php');
        } else if (menu == "pengaturan") {
            $('#isi-content-halaman').load('view/pengaturan.php');
        } else if (menu == "notifikasi") {
            $('#isi-content-halaman').load('view/notifikasi.php');
        } else if (menu == "toko") {
            $('#isi-content-halaman').load('view/toko.php');
        }

        $('.klik_menu.active').removeClass('active');
        $(this).addClass('active');
        
    });
    
    $('#dashboard').addClass('active');
    // halaman yang di load default pertama kali
    // $('#isi-content-halaman').load('view/dashboard.php');
    $('#isi-content-halaman').load('view/produk.php');
    
    $('#reload-produk').click(function () { 
        $('#isi-content-halaman').load('view/produk.php');
    });

});
