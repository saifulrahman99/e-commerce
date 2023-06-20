function produk(id, opsi) {
    var id_produk = id;
    var opsi_control = opsi;

    if (opsi_control == 'add') {
        var form = new FormData(document.getElementById("form-tambah-data-produk"));
    }
    if (opsi_control == 'update') {
        var form = new FormData(document.getElementById("form-edit-data-produk"));
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

    if (opsi_control == 'delete'){
        $.ajax({
            url: base_url + "controllers/produk.php",
            method: "POST",
            data: { "id_produk": id_produk, "opsi": opsi_control, },
            success: function (data) {

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
