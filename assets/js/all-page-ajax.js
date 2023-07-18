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