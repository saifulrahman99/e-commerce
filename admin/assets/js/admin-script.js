$(document).ready(function () {
    $('.klik_menu').click(function () {
        var menu = $(this).attr('id');
        if (menu == "dashboard") {
            $('#isi-content-halaman').load('view/dashboard.php');
        } else if (menu == "promo") {
            $('#isi-content-halaman').load('view/promo.php');
        } else if (menu == "pesan") {
            $('#isi-content-halaman').load('view/pesan.php');
        } else if (menu == "sosmed") {
            $('#isi-content-halaman').load('sosmed.php');
        }

        $('.klik_menu.active').removeClass('active');
        $(this).addClass('active');
        
        console.log(this);
    });
    
    $('#dashboard').addClass('active');
    // halaman yang di load default pertama kali
    $('#isi-content-halaman').load('view/dashboard.php');

});
