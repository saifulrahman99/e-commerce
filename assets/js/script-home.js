var wrapLogo = $('.logo-web');
var logoToko = $('#logo-toko');

var range = 10;
$(window).on('scroll', function () {
    var scrollTop = $(this).scrollTop(),
        height = header.outerHeight(),
        offset = height / 2,
        calc = 1 - (scrollTop - offset + range) / range;
    if (calc > '1') {
        wrapLogo.css({
            'height': '5rem'
        });
        logoToko.css({
            'max-width': '12rem'
        });
        logoToko.css({
            'position': 'absolute'
        });

    } else if (calc < '0') {
        logoToko.css({
            'max-width': '5rem'
        });
        logoToko.css({
            'position': 'static'
        });
    }
});