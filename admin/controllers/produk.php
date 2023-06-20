<?php
require_once '../../assets/basis/kon.php';

//library excel reader
require_once('../vendor/excel-reader/php-excel-reader/excel_reader2.php');
require_once('../vendor/excel-reader/SpreadsheetReader.php');


$opsi = (isset($_POST['opsi'])) ? $_POST['opsi'] : $_GET['opsi'];

if ($opsi == 'add') {

    $kode_produk = (isset($_POST['kode']) ? $_POST['kode'] : '');
    $nm_produk = (isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '');
    $merek = (isset($_POST['merek']) ? $_POST['merek'] : '');
    $deskripsi = (isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '');
    $harga_pokok = (isset($_POST['harga_pokok']) ? $_POST['harga_pokok'] : '');
    $harga_jual = (isset($_POST['harga_jual']) ? $_POST['harga_jual'] : '');
    $stok = (isset($_POST['stok']) ? $_POST['stok'] : '');
    $satuan = (isset($_POST['satuan']) ? $_POST['satuan'] : '');
    $kode_gudang = (isset($_POST['kode_gudang']) ? $_POST['kode_gudang'] : '');
    $id_kategori = (isset($_POST['kategori']) ? $_POST['kategori'] : '');


    $pathProduk = "../../assets/img/produk/";
    $pathGaleri = "../../assets/img/produk/galeri/";

    // gambar
    $gambar = $_FILES['gambar'];

    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar['name'])) {
        $filepathProduk = $pathProduk . $gambar['name'];

        if (!file_exists($filepathProduk)) {
            $upload_gambar = move_uploaded_file($gambar_tmp, $filepathProduk);
        } else {
            unlink($filepathProduk);
            $upload_gambar = move_uploaded_file($gambar_tmp, $filepathProduk);
        }
        $gambar = $gambar['name'];
    } else {
        $upload_gambar = false;
    }

    if ($upload_gambar = false) {
        $gambar = 'default.jpg';
    }
    // gambar end


    // galeri
    $limit = 5 * 1024 * 1024;
    $jumlahFile = count($_FILES['galeri']['name']);
    $nm_galeri = '';

    if ($jumlahFile > 0) {

        for ($x = 0; $x < $jumlahFile; $x++) {
            $galeri = $_FILES['galeri']['name'][$x];
            $galeri_tmp = $_FILES['galeri']['tmp_name'][$x];
            $ukuran = $_FILES['galeri']['size'][$x];
            $nm_galeri .= $galeri . ",";
            if ($ukuran > $limit) {
?>
                <script>
                    alert('ukuran file terlalu besar');
                </script>
                <?php
            } else {
                $filepathGaleri = $pathGaleri . $galeri;

                if (!file_exists($filepathGaleri)) {
                    $upload_galeri = move_uploaded_file($galeri_tmp, $filepathGaleri);
                } else {
                    unlink($filepathGaleri);
                    $upload_galeri = move_uploaded_file($galeri_tmp, $filepathGaleri);
                }
            }
        }
        $nm_galeri = substr($nm_galeri, 0, -1);
    } else {
        $nm_galeri = '';
    }


    $query = "INSERT INTO produk(kode_produk, nm_produk, merek, deskripsi, harga_pokok, harga_jual, stok, satuan, gambar, galeri, kode_gudang, id_kategori) VALUES ('$kode_produk', '$nm_produk', '$merek', '$deskripsi', '$harga_pokok', '$harga_jual', '$stok', '$satuan', '$gambar', '$nm_galeri', '$kode_gudang', '$id_kategori')";

    $eksekusi = mysqli_query($db, $query);
} elseif ($opsi == 'update') {

    $id = $_POST['id_produk'];

    $kode_produk = (isset($_POST['kode']) ? $_POST['kode'] : '');
    $nm_produk = (isset($_POST['nama_produk']) ? $_POST['nama_produk'] : '');
    $merek = (isset($_POST['merek']) ? $_POST['merek'] : '');
    $deskripsi = (isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '');
    $harga_pokok = (isset($_POST['harga_pokok']) ? $_POST['harga_pokok'] : '');
    $harga_jual = (isset($_POST['harga_jual']) ? $_POST['harga_jual'] : '');
    $stok = (isset($_POST['stok']) ? $_POST['stok'] : '');
    $satuan = (isset($_POST['satuan']) ? $_POST['satuan'] : '');
    $kode_gudang = (isset($_POST['kode_gudang']) ? $_POST['kode_gudang'] : '');
    $id_kategori = (isset($_POST['kategori']) ? $_POST['kategori'] : '');

    $pathProduk = "../../assets/img/produk/";
    $pathGaleri = "../../assets/img/produk/galeri/";

    // gambar
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar'];

        $gambar_tmp = $_FILES['gambar']['tmp_name'];

        if (!empty($gambar['name'])) {
            $filepathProduk = $pathProduk . $gambar['name'];

            if (!file_exists($filepathProduk)) {
                $upload_gambar = move_uploaded_file($gambar_tmp, $filepathProduk);
            } else {
                unlink($filepathProduk);
                $upload_gambar = move_uploaded_file($gambar_tmp, $filepathProduk);
            }
            $gambar = $gambar['name'];
        } else {
            $upload_gambar = false;
        }

        if ($upload_gambar = false) {
            $gambar = 'default.jpg';
        }
    } else {
        $gambar_lama = mysqli_fetch_assoc(mysqli_query($db, "SELECT gambar FROM produk WHERE id_produk = '$id'"));
        $gambar = $gambar_lama['gambar'];
    }
    // gambar end


    if (!empty($_FILES['galeri']['name'][0])) {
        // galeri
        $limit = 5 * 1024 * 1024;
        $jumlahFile = count($_FILES['galeri']['name']);
        $nm_galeri = '';

        if ($jumlahFile > 0) {

            for ($x = 0; $x < $jumlahFile; $x++) {
                $galeri = $_FILES['galeri']['name'][$x];
                $galeri_tmp = $_FILES['galeri']['tmp_name'][$x];
                $ukuran = $_FILES['galeri']['size'][$x];
                $nm_galeri .= $galeri . ",";
                if ($ukuran > $limit) {
                ?>
                    <script>
                        alert('ukuran file terlalu besar');
                    </script>
<?php
                } else {
                    $filepathGaleri = $pathGaleri . $galeri;

                    if (!file_exists($filepathGaleri)) {
                        $upload_galeri = move_uploaded_file($galeri_tmp, $filepathGaleri);
                    } else {
                        unlink($filepathGaleri);
                        $upload_galeri = move_uploaded_file($galeri_tmp, $filepathGaleri);
                    }
                }
            }
            $nm_galeri = substr($nm_galeri, 0, -1);
        } else {
            $nm_galeri = '';
        }
    } else {
        $galeri_lama = mysqli_fetch_assoc(mysqli_query($db, "SELECT galeri FROM produk WHERE id_produk = '$id'"));
        $nm_galeri = $galeri_lama['galeri'];
    }

    $query = "UPDATE produk SET kode_produk='$kode_produk',nm_produk='$nm_produk',merek='$merek',deskripsi='$deskripsi',harga_pokok='$harga_pokok',harga_jual='$harga_jual',stok='$stok',satuan='$satuan',gambar='$gambar',galeri='$nm_galeri',kode_gudang='$kode_gudang',id_kategori='$id_kategori' WHERE id_produk = '$id'";

    $eksekusi = mysqli_query($db, $query);
} elseif ($opsi == 'delete') {

    $id = $_POST['id_produk'];
    $query = "DELETE FROM produk WHERE id_produk = '$id'";
    $eksekusi = mysqli_query($db, $query);

    $jml = mysqli_fetch_assoc(mysqli_query($db, "SELECT MAX(id_produk) as max FROM produk"));
    // echo $jml['max'];

    $id = $jml['max'];
    $ai = $id + 1;
    // reset id auto incement
    mysqli_query($db, "ALTER TABLE produk auto_increment = $ai");
} elseif ($opsi == 'impor') {

    $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
    // fungsi in_array adalah untuk cek apakah nilainya false or true dengan sesuai kondisi yang telah ditentukan
    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        // piindahkan file ke folder uploads pada projek
        $targetPath = '../' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $reader = new SpreadsheetReader($targetPath);

        // hitung sheet
        $sheetCount = count($reader->sheets());

        for ($i = 0; $i < $sheetCount; $i++) {

            $reader->ChangeSheet($i);
            $j = 1;
            foreach ($reader as $kolom) {
                //definisikan satu persatu kolom yang akan di impor,
                $kode_produk = (isset($kolom[0])) ? $kolom[0] : "";
                $nm_produk = (isset($kolom[2])) ? $kolom[2] : "";
                $merek = (isset($kolom[4])) ? $kolom[4] : "";
                $harga_pokok = (isset($kolom[6])) ? $kolom[6] : "";
                $harga_jual = (isset($kolom[7])) ? $kolom[7] : "";
                $stok = (isset($kolom[8])) ? $kolom[8] : "";
                $satuan = (isset($kolom[5])) ? $kolom[5] : "";
                $kode_gudang = (isset($kolom[13])) ? $kolom[13] : "";

                $kode_kategori = (isset($kolom[3])) ? $kolom[3] : "";

                $select_kategori = mysqli_fetch_assoc(mysqli_query($db,"SELECT id_kategori FROM kategori WHERE kode_kategori = '$kode_kategori'"));

                $id_kategori = $select_kategori['id_kategori'];

                $jml_data_sama = mysqli_num_rows(mysqli_query($db, "SELECT kode_produk FROM produk WHERE kode_produk = '$kode_produk'"));

                if ($jml_data_sama > 0) {
                    $query = "UPDATE produk SET kode_produk='$kode_produk',nm_produk='$nm_produk',merek='$merek', harga_pokok='$harga_pokok',harga_jual='$harga_jual',stok='$stok',satuan='$satuan',kode_gudang='$kode_gudang',id_kategori='$id_kategori' WHERE kode_produk = '$kode_produk'";
                } else {
                    if ($j > 1) {
                        $query = "INSERT INTO produk( kode_produk, nm_produk, merek, harga_pokok, harga_jual, stok, satuan, kode_gudang, id_kategori) VALUES ('$kode_produk', '$nm_produk', '$merek', '$harga_pokok', '$harga_jual', '$stok', '$satuan', '$kode_gudang', '$id_kategori')";
                    }
                }
                $eksekusi = mysqli_query($db, $query);
                $j++;
            }
            // agar file tidak memakan rauang, terutama nanti ketika di hosting. maka setelah selesai di gunakan, file akan langsung di hapus.
            if (file_exists($targetPath)) {
                unlink($targetPath);
            }
        }
    }
} elseif ($opsi == 'ekspor') {

    # code...
}

echo $opsi;
