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

                if (data == 'add') {
                    $('#tambahProduk').modal('hide');
                } else if (data == 'update') {
                    $('#editProduk' + id_produk).modal('hide');
                } else if (data == 'impor') {
                    $('#imporExcel').modal('hide');
                }
                $('.modal-backdrop.fade').removeClass("modal-backdrop");
                $('#isi-content-halaman').load(base_url + 'view/produk.php');

                // console.log(data + " bukan delete");

            }
        });
    }

    if (opsi_control == 'delete') {
        $.ajax({
            url: base_url + "controllers/produk.php",
            method: "POST",
            data: { "id_produk": id_produk, "opsi": opsi_control, },
            success: function () {

                $('#hapusProduk' + id_produk).modal('hide');
                $('.modal-backdrop.fade').removeClass("modal-backdrop");
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

                $('#hapusKategori' + id_kategori).modal('hide');
                $('#isi-content-halaman').load(base_url + 'view/kategori.php');
                $('.modal-backdrop.fade').removeClass("modal-backdrop");

            } else if (data == 'add') {
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
                if (data == 'add') {
                    $('#tambahPromo').modal('hide');
                } else if (data == 'update') {
                    $('#editPromo' + id_promo).modal('hide');
                }
                $('.modal-backdrop.fade').removeClass("modal-backdrop");
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

                $('#hapusPromo' + id_promo).modal('hide');
                $('.modal-backdrop.fade').removeClass("modal-backdrop");
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
            $('#suksesModal').modal('show');
        }
    });
}

// push notif