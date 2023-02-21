var header = $('#navbar-show');
var menu = $('.menu-nav');
var menuRounded = $('.menu-nav.rounded');
var range = 10;
$(window).on('scroll', function () {
    var scrollTop = $(this).scrollTop(), height = header.outerHeight(), offset = height / 2, calc = 1 - (scrollTop - offset + range) / range;
    if (calc > '1') {
        header.css({ 'opacity': 0});
        menuRounded.css({ 'background': 'rgb(212, 158, 83, 0)'});
        menuRounded.css({ 'color': 'white '});
        
    } else if (calc < '0') {
        header.css({ 'opacity': 1 });
        menu.css({ 'color': 'black' });
        menuRounded.css({ 'background': 'rgb(212, 158, 83)' });
        menuRounded.css({ 'color': 'white '});
    }
});

