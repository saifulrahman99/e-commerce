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
var barNavigasi = $(".bar-navigasi");

var range = 10;
$(window).on('scroll', function () {
    var scrollTop = $(this).scrollTop(), height = header.outerHeight(), offset = height / 2, calc = 1 - (scrollTop - offset + range) / range;
    if (calc > '1') {
        header.css({ 'opacity': 0 });
        circleLogo.css({ 'background': 'white' });
        circleLogo.css({ 'opacity': 1 });
        barNavigasi.css({ 'opacity': 1 });

    } else if (calc < '0') {
        header.css({ 'opacity': 1 });
        menu.css({ 'color': 'black' });
        circleLogo.css({ 'background': 'rgb(254, 234, 186)' });
        circleLogo.css({ 'opacity': 0 });
        barNavigasi.css({ 'opacity': 0 });
    }
});
// ======== end header navbar ==============


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


// =============== keranjang ===================
function disableCheckout(id_produk, i, jmlProduk) {
    cekStok(id_produk);

    var stok = parseFloat(document.getElementById("sisa-stok" + id_produk).innerHTML);
    var checkout = document.getElementById("button-checkout");
    var jmlItem = document.getElementById("jml-item" + i).value;

    if (isNaN(jmlItem) || jmlItem == '' || jmlItem == 0) {

        checkout.style.background = 'gray';
        checkout.classList.remove('btn-ijo');
        checkout.setAttribute('data-bs-target', '');
    } else {
        var jmlItemLihat = parseFloat(jmlItem);
        checkout.setAttribute('data-bs-target', "#modalCheckout")
        checkout.classList.add('btn-ijo');

    }

    if (jmlItemLihat > stok) {
        alert("Melebihi Stok");
        document.getElementById("jml-item" + i).value = stok;
    }

    var jmlkProdukAkhir = 9999;
    for (let index = 0; index < jmlProduk; index++) {
        var jmlItemProduk = document.getElementById("jml-item" + index).value;

        if (jmlkProdukAkhir > jmlItemProduk) {
            console.log(jmlItemProduk);
            var jmlkProdukAkhir = jmlItemProduk;
        }

    }

    if (jmlkProdukAkhir == 0) {
        checkout.style.background = 'gray';
        checkout.classList.remove('btn-ijo');
        checkout.setAttribute('data-bs-target', '');
    } else {
        var jmlItemLihat = parseFloat(jmlItem);
        checkout.setAttribute('data-bs-target', "#modalCheckout")
        checkout.classList.add('btn-ijo');
    }
}

// =============== keranjang ===================



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
    var CountDownTag = '' + tag + '';
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



setInterval(() => {
    jmlPesanNow();
}, 100);

setInterval(function () {
    playSound();
    show_notif();
}, 1500);
// jumlah pesan diterima
// show jml notif pesan
function jmlPesanNow() {
    var base_url = window.location.origin + '/';

    $.ajax({
        url: base_url + "data/show-jml-pesan-diterima.php",
        success: function (data) {
            $('#input-jml-pesan').html(data);
        }
    });
}

// jumlah pesan diterima


function playSound() {

    // atur untuk dapat notif pesan baru
    var base_url = window.location.origin + '/';
    var pOld = $("#total_pesan_diterima_old").val();
    var pNew = $("#total_pesan_diterima").val();
    var audio = new Audio(base_url + 'admin/assets/sound/notif.mp3');

    if (pNew > pOld) {
        $("#total_pesan_diterima_old").val(pNew);
        $('#liveToast').toast('show');
        audio.play();
    }
    if (pNew < pOld) {
        $("#total_pesan_diterima_old").val(pNew);
    }
    // atur untuk dapat notif pesan baru
}

// show jml notif pesan
function show_notif() {
    var pNew = $("#total_pesan_diterima").val();
    if (pNew == 0) {
        $('#dot-notif-pesan').addClass('op-none');
        $('#dot-notif-pesan-mobile').addClass('op-none');
    } else {
        $('#dot-notif-pesan').removeClass('op-none');
        $('#dot-notif-pesan-mobile').removeClass('op-none');
    }
}