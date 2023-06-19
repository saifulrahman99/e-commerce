// function produk(id, opsi) {
//     var id_produk = id;
//     var opsi_control = opsi;
//     var base_url = window.location.origin + '/admin/';

//     $.ajax({
//         url: base_url + "controllers/produk.php",
//         method: "POST",
//         data: { "id_produk": id_produk, "opsi": opsi_control },
//         success: function (data) {
//             window.location.href= base_url+'control/produk';

//             if (data == 'hapus') {
//                 $('#hapusProduk' + id_produk).modal('hide');
//                 $('.modal-backdrop.fade').remove();
                
//             } else if (data == 'edit') {
//                 $('#isi-content-halaman').load(base_url + 'view/produk.php');
//             }

//             // $('#modalSukses').modal('show');
//             // $('.modal-backdrop.fade.show').addClass('hide');


//         }
//     });
// }
