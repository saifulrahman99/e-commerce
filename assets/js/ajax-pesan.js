setInterval(function () {
    show_chat();
    read();
    updateCartLihat();
    showListadmin()
}, 1500);

function scrollBawah() {
    var bawah = $('.messenger-box')[0].scrollHeight;
    $('.messenger-box').scrollTop(bawah);
}


// transaksi
function show_chat() {
    var admin = $("input[name=input_id_admin]").val();
    var base_url = window.location.origin + '/';

    $.ajax({
        url: base_url + "data/show-chat.php",
        method: "POST",
        data: { "id_admin": admin },
        success: function (data) {

            $('#area-msg').html(data);
        }
    });
}

function kirimPesan() {
    var pesan = $("input[name=input_msg]").val();
    var pengunjung = $("input[name=input_id_pengunjung]").val();
    var admin = $("input[name=input_id_admin]").val();
    var base_url = window.location.origin + '/';

    if (pesan == '') {
        alert('Tidak Boleh Kosong');
    } else {
        $.ajax({
            type: 'POST',
            url: base_url + "controllers/pesan.php",
            data: { "pesan": pesan, "pengunjung": pengunjung, "admin": admin },
            success: function () {
                scrollBawah();

                $("input[name=input_msg]").val('');
                $("input[name=input_msg]").focus();

            }

        });
    }
}

function updateCartLihat() {
    var base_url = window.location.origin + '/';

    $.ajax({
        url: base_url + "data/jml-cart.php",
        method: "POST",
        success: function (data) {
            var jml = data;

            if (jml < 1) {
                document.getElementById("jml-item-dalam-cart").style.display = "none";
                document.getElementById("jml-item-dalam-cart-mobile").style.display = "none";
            } else {
                document.getElementById("jml-item-dalam-cart").style.display = "block";
                document.getElementById("jml-item-dalam-cart-mobile").style.display = "block";
                $('#jml-item-dalam-cart').html(data);
                $('#jml-item-dalam-cart-mobile').html(data);
            }
        }
    });

}


// show list obrolan admin

function showListadmin() {
    var base_url = window.location.origin + '/';

    $.ajax({
        url: base_url + "data/list-obrolan-admin.php",
        success: function (data) {

            $('#list-obrolan-admin').html(data);
            $('#modal-list-obrolan-admin').html(data);
        }
    });
}
// show list obrolan admin


// read
function read() {
    var idAdmin = $('input[name=idAdmin]').val();
    var idPengunjung = $('input[name=idPengunjung]').val();

    var base_url = window.location.origin + '/';
    $.ajax({
        url: base_url + "controllers/read.php",
        type: 'POST',
        data: { "id_admin": idAdmin,"id_pengunjung": idPengunjung },
        success: function (data) {

            if (data > 0) {
                scrollBawah();
            }
        }

    });
}
// read



function scrollBawah() {
    var bawah = $('.messenger-box')[0].scrollHeight;
    $('.messenger-box').scrollTop(bawah);
}