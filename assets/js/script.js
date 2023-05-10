// ======== header navbar ==============
var header = $('#navbar-show');
var menu = $('.menu-nav');
var circleLogo = $('.cricle-logo');
var search = $('.search-input');

var range = 10;
$(window).on('scroll', function () {
    var scrollTop = $(this).scrollTop(), height = header.outerHeight(), offset = height / 2, calc = 1 - (scrollTop - offset + range) / range;
    if (calc > '1') {
        header.css({ 'opacity': 0 });
        circleLogo.css({ 'background': 'white' });
        circleLogo.css({ 'opacity': 1 });
        search.css({ 'border': 'none' });

    } else if (calc < '0') {
        header.css({ 'opacity': 1 });
        menu.css({ 'color': 'black' });
        circleLogo.css({ 'background': 'rgb(254, 234, 186)' });
        circleLogo.css({ 'opacity': 0 });
        search.css({ 'border': '1px solid gray' });
    }
});
// ======== end header navbar ==============




// ======== whell mouse scroll section ==============

const element = document.querySelector(".promo-content");

element.addEventListener('wheel', (event) => {
    event.preventDefault();

    element.scrollBy({
        left: event.deltaY < 0 ? -30 : 30,

    });
});
// ======== whell mouse scroll section ==============




// ======== grap scroll section ==============
const slider = document.querySelector('.grap-content');
let isDown = false;
let startX;
let scrollLeft;

slider.addEventListener('mousedown', (e) => {
    isDown = true;
    slider.classList.add('active');
    startX = e.pageX - slider.offsetLeft;
    scrollLeft = slider.scrollLeft;
});
slider.addEventListener('mouseleave', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mouseup', () => {
    isDown = false;
    slider.classList.remove('active');
});
slider.addEventListener('mousemove', (e) => {
    if (!isDown) return;
    e.preventDefault();
    const x = e.pageX - slider.offsetLeft;
    const walk = (x - startX) * 3; //scroll-fast
    slider.scrollLeft = scrollLeft - walk;
    console.log(walk);
});
// ======== grap scroll section ==============





// ======== tombol scroll ==============

// event dan promo
$('#btn-kiri-produk-promo').click(function () {
    $('.produk-promo').animate({ scrollLeft: '-=440' }, 1000);
});

$('#btn-kanan-produk-promo').click(function () {
    $('.produk-promo').animate({ scrollLeft: '+=440' }, 1000);
});


// terlaris
$('#btn-kiri-produk-terlaris').click(function () {
    $('.produk-terlaris').animate({ scrollLeft: '-=440' }, 1000);
});

$('#btn-kanan-produk-terlaris').click(function () {
    $('.produk-terlaris').animate({ scrollLeft: '+=440' }, 1000);
});

// terbaru
$('#btn-kiri-produk-terbaru').click(function () {
    $('.produk-terbaru').animate({ scrollLeft: '-=440' }, 1000);
});

$('#btn-kanan-produk-terbaru').click(function () {
    $('.produk-terbaru').animate({ scrollLeft: '+=440' }, 1000);
});
// ======== tombol scroll ==============