var header = $('#navbar-show');
var menu = $('.menu-nav');
var menuRounded = $('.menu-nav.rounded');
var circleLogo = $('.cricle-logo');
var range = 10;
$(window).on('scroll', function () {
    var scrollTop = $(this).scrollTop(), height = header.outerHeight(), offset = height / 2, calc = 1 - (scrollTop - offset + range) / range;
    if (calc > '1') {
        header.css({ 'opacity': 0});
        menuRounded.css({ 'color': 'rgb(26, 131, 0)'});
        circleLogo.css({ 'background': 'white'});
        circleLogo.css({ 'opacity': 1});
        
    } else if (calc < '0') {
        header.css({ 'opacity': 1 });
        menu.css({ 'color': 'black' });
        circleLogo.css({ 'background': 'rgb(254, 234, 186)'});
        menuRounded.css({ 'color': 'rgb(26, 131, 0)'});
        circleLogo.css({ 'opacity': 0});
    }
});

