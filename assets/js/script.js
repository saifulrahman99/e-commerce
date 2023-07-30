// ======== filter angka ==============
function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode == 46) {
        if (!(evt.indexOf(".") > -1)) {

            return true;
        }
    }
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

// const element = document.querySelector(".promo-content");

// element.addEventListener('wheel', (event) => {
//     event.preventDefault();

//     element.scrollBy({
//         left: event.deltaY < 0 ? -30 : 30,

//     });
// });
// ======== whell mouse scroll section ==============




// ======== grap scroll section ==============
// const slider = document.querySelector('.grap-content');
// let isDown = false;
// let startX;
// let scrollLeft;

// slider.addEventListener('mousedown', (e) => {
//     isDown = true;
//     slider.classList.add('active');
//     startX = e.pageX - slider.offsetLeft;
//     scrollLeft = slider.scrollLeft;
// });
// slider.addEventListener('mouseleave', () => {
//     isDown = false;
//     slider.classList.remove('active');
// });
// slider.addEventListener('mouseup', () => {
//     isDown = false;
//     slider.classList.remove('active');
// });
// slider.addEventListener('mousemove', (e) => {
//     if (!isDown) return;
//     e.preventDefault();
//     const x = e.pageX - slider.offsetLeft;
//     const walk = (x - startX) * 3; //scroll-fast
//     slider.scrollLeft = scrollLeft - walk;
//     console.log(walk);
// });
// ======== grap scroll section ==============





// ======== tombol scroll ==============

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
    var stok = document.getElementById("stok" + i).value;


    if (jml == "") {
        jml = 0;
    } else {
        jml = parseFloat(jml);
    }

    // console.log(stok);

    if (jml < 0.1) {
        document.getElementById("jml-item" + i).value = 1;
    }
    else {
        if (jml >= stok) {
            document.getElementById("jml-item" + i).value = stok;
            alert("Jumlah Melebihi Stok");
        } else {
            document.getElementById("jml-item" + i).value = jml + 1;
        }
    }
}
function kurang(i) {
    var jml = document.getElementById("jml-item" + i).value;

    if (jml == "") {
        jml = 1;
    } else {
        jml = parseInt(jml);
    }

    if (jml < 0.1) {
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
        jml = parseFloat(jml);
    }

    if (jml < 0.1) {
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

    if (jml < 0.1) {
        document.getElementById("jml-item").value = 1;
    }
    else {
        document.getElementById("jml-item").value = jml - 1;
    }
}


// ======== tombol tambah kurang keranjang lihat produk ==============

function subTotalLihat() {
    var jmlItem = document.getElementById("jml-item").value.replace(/,/g, ".");
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
    var stok = parseFloat(document.getElementById("stok-lihat").innerHTML);
    var addCart = document.getElementById("tambah-keranjang");
    var id = document.getElementById("id-item").value;
    var jmlItem = document.getElementById("jml-item").value;
    var hargaItem = document.getElementById("harga-item").value;

    if (isNaN(jmlItem) || jmlItem == '' || jmlItem == 0) {

        addCart.style.background = 'gray';
        addCart.setAttribute('onclick', '')
    } else {
        var jmlItemLihat = parseFloat(jmlItem);
        addCart.setAttribute('onclick', "addCartLihat(" + id + "," + hargaItem + ",'lihat')")
        addCart.style.background = '#198754';
    }

    if (jmlItemLihat > stok) {
        alert("Melebihi Stok");
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




$(".jenis-pembayaran label").click(function () {
    // $(this).toggleClass("payment-aktif");
    $(".jenis-pembayaran label").addClass("payment-aktif");
});


// Hitungan Mundur Waktu Dilakukan Setiap Satu Detik
function countdown(time, tag) {
    // Silahkan anda atur tanggal anda
    var countDownDate = time;
    var CountDownTag = ''+tag+'';
    // Mendapatkan Tanggal dan waktu Pada Hari ini
    var now = new Date().getTime();
    //Jarak Waktu Antara Hitungan Mundur
    var distance = countDownDate - now;
    // Perhitungan waktu hari, jam, menit dan detik
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    // Tampilkan hasilnya di elemen id = "carasingkat"
    document.getElementById(CountDownTag).innerHTML = "<span class='p-2 bg-danger text-white rounded'>" + days + "h</span> : <span class='p-2 bg-danger text-white rounded'>" + hours + "j</span> : <span class='p-2 bg-danger text-white rounded'>" +
        minutes + "m</span> : <span class='p-2 bg-danger text-white rounded'>" + seconds + "d</span>";
    // Jika hitungan mundur selesai,
    if (distance < 0) {
        document.getElementById(CountDownTag).innerHTML = "<span class='p-2 bg-danger text-white rounded'> EXPIRED </span>";
    }
}