// ======== filter angka ==============
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))

        return false;
    return true;
}
// ======== filter angka ==============

// ======== header navbar ==============
var header = $('#navbar-show');
var menu = $('.menu-nav');
var circleLogo = $('.cricle-logo');
// var search = $('.search-input');
var barNavigasi = $(".bar-navigasi");

var range = 10;
$(window).on('scroll', function () {
    var scrollTop = $(this).scrollTop(), height = header.outerHeight(), offset = height / 2, calc = 1 - (scrollTop - offset + range) / range;
    if (calc > '1') {
        header.css({ 'opacity': 0 });
        circleLogo.css({ 'background': 'white' });
        circleLogo.css({ 'opacity': 1 });
        // search.css({ 'border': 'none' });
        barNavigasi.css({ 'opacity': 1 });

    } else if (calc < '0') {
        header.css({ 'opacity': 1 });
        menu.css({ 'color': 'black' });
        circleLogo.css({ 'background': 'rgb(254, 234, 186)' });
        circleLogo.css({ 'opacity': 0 });
        // search.css({ 'border': '1px solid gray' });
        barNavigasi.css({ 'opacity': 0 });
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


// sejenis
function geserKiri() {
    let bungkus = $('.produk-sejenis');
    bungkus.animate({
        scrollLeft: '-=440'
    }, 1000);

}

function geserKanan() {
    let bungkus = $('.produk-sejenis');
    bungkus.animate({
        scrollLeft: '+=440'
    }, 1000);

}
// ======== tombol scroll ==============





// ======== tombol tambah kurang keranjang ==============

function tambah(i) {
    var jml = document.getElementById("jml-item" + i).value;

    if (jml == "") {
        jml = 0;
    } else {
        jml = parseInt(jml);
    }

    if (jml < 0) {
        document.getElementById("jml-item" + i).value = 1;
    }
    else {
        document.getElementById("jml-item" + i).value = jml + 1;
    }
}
function kurang(i) {
    var jml = document.getElementById("jml-item" + i).value;

    if (jml == "") {
        jml = 1;
    } else {
        jml = parseInt(jml);
    }

    if (jml < 2) {
        document.getElementById("jml-item" + i).value = 1;
    }
    else {
        document.getElementById("jml-item" + i).value = jml - 1;
    }
}

// ======== tombol tambah kurang keranjang ==============





// ======== tombol tambah kurang keranjang lihat produk ==============

function tambahV() {
    var jml = document.getElementById("jml-item").value;

    if (jml == "") {
        jml = 0;
    } else {
        jml = parseInt(jml);
    }

    if (jml < 0) {
        document.getElementById("jml-item").value = 1;
    }
    else {
        document.getElementById("jml-item").value = jml + 1;
    }
}
function kurangV() {
    var jml = document.getElementById("jml-item").value;

    if (jml == "") {
        jml = 1;
    } else {
        jml = parseInt(jml);
    }

    if (jml < 2) {
        document.getElementById("jml-item").value = 1;
    }
    else {
        document.getElementById("jml-item").value = jml - 1;
    }
}


// ======== tombol tambah kurang keranjang lihat produk ==============

function subTotalLihat() {
    var jmlItem = document.getElementById("jml-item").value;
    var price = document.getElementById("harga-produk-lihat").innerHTML;

    const rupiah = (number) => {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR", 
            minimumFractionDigits: 0
        }).format(number);
    }

    var subtotal = rupiah(jmlItem * price);


    document.getElementById("total-harga-lihat-produk").innerHTML = subtotal;

}

function disableTambah() {
    var stok = parseInt(document.getElementById("stok-lihat").innerHTML);
    var addCart = document.getElementById("tambah-keranjang");
    var id = document.getElementById("id-item").value;
    var jmlitem = document.getElementById("jml-item").value;

    if (jmlitem == ''|| jmlitem == 0) {
        
        addCart.style.background = 'gray';
        addCart.setAttribute('onclick', '')
    }else{
        var jmlItemLihat = parseInt(jmlitem);
        addCart.setAttribute('onclick', "addCartLihat("+id+",'lihat')")
        addCart.style.background = '#198754';
    }

    if (jmlItemLihat > stok) {
        document.getElementById("jml-item").value = stok;
    }
}




// ======== tombol kembali ==============
function kembali() {
    window.history.back();
}
// ======== tombol kembali ==============


// ======== tombol popover filter produk ==============

function open_filter() {
    var x = document.getElementById("filter-melayang");
    x.classList.toggle("open-filter");
}
// ======== tombol popover filter produk ==============