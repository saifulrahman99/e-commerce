function produk(id, opsi) {
    var id_produk = id;
    var opsi_control = opsi;

    if (opsi_control == 'add') {
        var form = new FormData(document.getElementById("form-tambah-data-produk"));
    }
    if (opsi_control == 'update') {
        var form = new FormData(document.getElementById("form-edit-data-produk" + id_produk));
    }
    if (opsi_control == 'impor') {
        var form = new FormData(document.getElementById("form-impor-produk"));
    }

    var base_url = window.location.origin + '/admin/';

    if (opsi_control != 'delete') {

        $.ajax({
            url: base_url + "controllers/produk.php",
            method: "POST",
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                $('body').removeClass('modal-open');
                $('.modal-backdrop.fade.show').remove();
                if (data == 'add') {
                    $('#tambahProduk').modal('hide');
                } else if (data == 'update') {
                    $('#editProduk' + id_produk).modal('hide');
                } else if (data == 'impor') {
                    $('#imporExcel').modal('hide');
                }

                $('#suksesModal').modal('show');
                $('body').removeClass('modal-open');

                $('#isi-content-halaman').load(base_url + 'view/produk.php');

            }
        });
    }

    if (opsi_control == 'delete') {
        $.ajax({
            url: base_url + "controllers/produk.php",
            method: "POST",
            data: { "id_produk": id_produk, "opsi": opsi_control, },
            success: function () {

                $('body').removeClass('modal-open');
                $('.modal-backdrop.fade.show').remove();
                $('#hapusProduk' + id_produk).modal('hide');

                $('#suksesModal').modal('show');
                $('body').removeClass('modal-open');

                $('#isi-content-halaman').load(base_url + 'view/produk.php');

            }
        });
    }

}



function kategori(id, opsi) {
    var id_kategori = id;
    var opsi_control = opsi;
    var base_url = window.location.origin + '/admin/';
    var input_nm = document.getElementById('nm_kategori').value;
    var input_kode = document.getElementById('kode_kategori').value;

    if (opsi_control == 'add') {
        if (input_nm == '') {
            alert('field Nama tidak boleh kosong!');
            return false;
        }
        if (input_kode == '') {
            alert('field Kode tidak boleh kosong!');
            return false;
        }
    }

    $.ajax({
        url: base_url + "controllers/kategori.php",
        method: "POST",
        data: { "id_kategori": id_kategori, "opsi": opsi_control, "kategori": input_nm, "kode_kategori": input_kode },
        success: function (data) {
            document.getElementById("form-kategori").reset();
            if (data == 'delete') {

                $('body').removeClass('modal-open');
                $('.modal-backdrop.fade.show').remove();
                $('#hapusKategori' + id_kategori).modal('hide');

                $('#suksesModal').modal('show');
                $('body').removeClass('modal-open');

                $('#isi-content-halaman').load(base_url + 'view/kategori.php');

            } else if (data == 'add') {

                $('#suksesModal').modal('show');
                $('body').removeClass('modal-open');
                $('#isi-content-halaman').load(base_url + 'view/kategori.php');
            }
        }
    });
}



// promo


//Getting value from "ajax.php".
function fill(Value) {
    //Assigning value to "search" div in "search.php" file.
    $('#search-input-promo').val(Value);
    //Hiding "display" div in "search.php" file.
    $('#display-hasil-search').hide();
}
$(document).ready(function () {
    var base_url = window.location.origin + '/admin/';

    //On pressing a key on "Search box" in "search.php" file. This function will be called.
    $("#search-input-promo").keyup(function () {
        //Assigning search box value to javascript variable named as "name".
        var name = $('#search-input-promo').val();
        //Validating, if "name" is empty.
        if (name == "") {
            //Assigning empty value to "display" div in "search.php" file.
            $("#display-hasil-search").html("");
        }
        //If name is not empty.
        else {
            //AJAX is called.
            $.ajax({
                //AJAX type is "Post".
                type: "POST",
                //Data will be sent to "ajax.php".
                url: base_url + "data/ajax-form-promo.php",
                //Data, that will be sent to "ajax.php".
                data: {
                    //Assigning value of "name" into "search" variable.
                    search: name
                },
                //If result found, this funtion will be called.
                success: function (html) {
                    //Assigning result to "display" div in "search.php" file.
                    $("#display-hasil-search").html(html).show();
                }
            });
        }
    });

    $('#form-group-harga-promo').hide();

    $("#value-jenis-promo").change(function () {
        var jenis = $(this).val();
        if (jenis == 'harga pokok') {
            $('#form-group-harga-promo').hide();
        } else {
            $('#form-group-harga-promo').show();
        }
    });


});







// controllers promo

function promo(id, opsi) {
    var id_promo = id;
    var opsi_control = opsi;

    if (opsi_control == 'add') {
        var form = new FormData(document.getElementById("form-tambah-data-promo"));
    }
    if (opsi_control == 'update') {
        var form = new FormData(document.getElementById("form-edit-data-promo" + id_promo));
    }

    var base_url = window.location.origin + '/admin/';

    if (opsi_control != 'delete') {

        $.ajax({
            url: base_url + "controllers/promo.php",
            method: "POST",
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop.fade.show').remove();
                if (data == 'add') {
                    $('#tambahPromo').modal('hide');
                } else if (data == 'update') {
                    $('#editPromo' + id_promo).modal('hide');
                }

                $('#suksesModal').modal('show');
                $('body').removeClass('modal-open');

                $('#isi-content-halaman').load(base_url + 'view/promo.php');

            }
        });
    }

    if (opsi_control == 'delete') {
        $.ajax({
            url: base_url + "controllers/promo.php",
            method: "POST",
            data: { "id_promo": id_promo, "opsi": opsi_control, },
            success: function () {

                $('body').removeClass('modal-open');
                $('.modal-backdrop.fade.show').remove();
                $('#hapusPromo' + id_promo).modal('hide');

                $('#suksesModal').modal('show');
                $('body').removeClass('modal-open');

                $('#isi-content-halaman').load(base_url + 'view/promo.php');
            }
        });
    }

}

// /promo


// push notif

function notif(id) {
    var id_promo = id;
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        url: base_url + "controllers/push-notif.php",
        method: "POST",
        data: { "id_promo": id_promo },
        success: function () {
            $('#suksesNotifModal').modal('show');
        }
    });
}

// push notif



// web push
function webPush() {
    var base_url = window.location.origin + '/admin/';
    var form = document.getElementById("form-notif");


    $.ajax({
        url: base_url + "controllers/web-push.php",
        method: "POST",
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            // console.log(data);
            form.reset();
            $('#suksesNotifModal').modal('show');

        }
    });
}

// web push



// control transaksi
function transaksi(order_id, opsi) {
    var id_order = order_id;
    var opsi_control = opsi;
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        url: base_url + "controllers/transaksi.php",
        method: "POST",
        data: { "id_order": id_order, "opsi": opsi_control },
        success: function () {


            $('body').removeClass('modal-open');
            $('.modal-backdrop.fade.show').remove();
            $('#kirimPesanan' + id_order).modal('hide');
            $('#konfirmasiPembayaran' + id_order).modal('hide');

            $('#suksesModal').modal('show');
            $('body').removeClass('modal-open');

            $('#isi-content-halaman').load(base_url + 'view/transaksi.php');
        }
    });
}

// control transaksi

// control pengunjung
function pengunjung(id) {
    var id_pengunjung = id;
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        url: base_url + "controllers/pengunjung.php",
        method: "POST",
        data: { "id_pengunjung": id_pengunjung },
        success: function () {

            $('body').removeClass('modal-open');
            $('.modal-backdrop.fade.show').remove();
            $('#hapusPengunjung' + id_pengunjung).modal('hide');

            $('#suksesModal').modal('show');
            $('body').removeClass('modal-open');

            $('#isi-content-halaman').load(base_url + 'view/pengunjung.php');

        }
    });
}

// control pengunjung

// show list obrolan pengunjung

function showListPengunjung() {
    var id = $("input[name=search_pengunjung]").val();
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        url: base_url + "data/list-pengunjung.php",
        method: "POST",
        data: { "id_pengunjung": id },
        success: function (data) {

            $('#list-obrolan-pengunjung').html(data);
        }
    });
}
// show list obrolan pengunjung


setInterval(() => {

    show_notif();
    jmlPesanNow();
    playSound();

    show_chat();
    showListPengunjung();

}, 1500);
// paly sound notif
function playSound() {
    // atur untuk dapat notif pesan baru
    var pOld = $("#total_pesan_diterima_old").val();
    var pNew = $("#total_pesan_diterima").val();
    var audio = new Audio('assets/sound/notif.mp3');

    if (pNew > pOld) {
        $("#total_pesan_diterima_old").val(pNew);
        $('#liveToast').toast('show');
        audio.play();
        // alert('pesan baru');
    }
    if (pNew < pOld) {
        $("#total_pesan_diterima_old").val(pNew);
    }
    // atur untuk dapat notif pesan baru
}
// paly sound notif

// show jml notif pesan
function show_notif() {
    var base_url = window.location.origin + '/admin/';
    var pNew = $("#total_pesan_diterima").val();

    if (pNew == 0) {
        $('#notif-bell-pesan').addClass('op-none');
    } else {
        $('#notif-bell-pesan').removeClass('op-none');
    }

    $.ajax({
        url: base_url + "data/jml-notif-pesan.php",
        success: function (data) {
            document.getElementById('notif-bell-pesan').innerHTML = data;

        }
    });
}
// show jml notif pesan
function jmlPesanNow() {
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        url: base_url + "data/show-input-jml-pesan.php",
        success: function (data) {
            $('#input-jml-pesan').html(data);
        }
    });
}


// show chat
function show_chat() {
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        url: base_url + "data/show-chat.php",
        success: function (data) {
            $('#area-msg').html(data);

        }
    });
}
// show chat

// click user
function idPengunjung(id) {

    setIdPengunjung(id);
    read(id);

    document.getElementById("total_pesan_diterima_old").value = document.getElementById("total_pesan_diterima").value;
    // console.log();


    $("input[name=input_id_pengunjung]").val(id);

    document.getElementById("user-obrolan").innerHTML = "(User" + id + ")";
    scrollBawah();
}
// click user

// send chat
function kirimPesan() {
    var pesan = $("input[name=input_msg]").val();
    var pengunjung = $("input[name=input_id_pengunjung]").val();
    var base_url = window.location.origin + '/admin/';

    if (pesan == '') {
        alert('Tidak Boleh Kosong');
    } else {
        $.ajax({
            type: 'POST',
            url: base_url + "controllers/pesan.php",
            data: { "pesan": pesan, "pengunjung": pengunjung },
            success: function () {

                $("input[name=input_msg]").val('');
                $("input[name=input_msg]").focus();
                scrollBawah();

            }

        });
    }
}
// send chat

// read
function read(id) {
    var base_url = window.location.origin + '/admin/';
    $.ajax({
        type: 'POST',
        url: base_url + "controllers/read.php",
        data: { "id_pengunjung": id },
        success: function (data) {
            if (data > 0) {
                scrollBawah();
            }
        }

    });
}
// read



// set id pengunjung
function setIdPengunjung(id) {
    var base_url = window.location.origin + '/admin/';

    $.ajax({
        type: 'POST',
        url: base_url + "controllers/set-id-pengunjung.php",
        data: { "idC_pengunjung": id }

    });
}
// set id pengunjung

// load halaman pesan
function loadPesan() {
    var base_url = window.location.origin + '/admin/';
    $('#isi-content-halaman').load(base_url + 'view/pesan.php');
}
// load halaman pesan

function scrollBawah() {
    var bawah = $('.messenger-box')[0].scrollHeight;
    $('.messenger-box').scrollTop(bawah);
}


// show_edit_produk
function show_edit_produk(id) {
    var base_url = window.location.origin + '/admin/';
    // var page = document.querySelector("#tabel-produk_info").innerHTML;

    $.ajax({
        type: 'POST',
        url: base_url + "data/show-edit-produk.php",
        data: { "id": id },
        success: function (data) {
            $('#area-modal-edit').html(data);

            setTimeout(() => {
                $('#editProduk' + id).modal('show')
            }, 100);
        }
    });
}


// crud api
function api() {

    var base_url = window.location.origin + '/admin/';
    var form = new FormData(document.getElementById("form-data-api"));

    $.ajax({
        url: base_url + "controllers/api.php",
        method: "POST",
        data: form,
        contentType: false,
        cache: false,
        processData: false,
        success: function () {

            $('#suksesModal').modal('show');
            $('body').removeClass('modal-open');

            $('#isi-content-halaman').load(base_url + 'view/api.php');

        }
    });

}