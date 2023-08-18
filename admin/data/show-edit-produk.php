<?php
require_once '../../assets/basis/kon.php';
$id_produk = $_POST['id'];

$select = mysqli_query($db, "SELECT * FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE id_produk = '$id_produk'");


foreach ($select as $p) { ?>
    <!-- Modal Ubah -->
    <div class="modal fade" id="editProduk<?= $p['id_produk'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editProduk<?= $p['id_produk'] ?>Label" aria-hidden="true">
        <div id="form-edit-data-produk" class="modal-dialog modal-dialog-scrollable modal-lg">
            <form id="form-edit-data-produk<?= $p['id_produk']; ?>" method="post" enctype="multipart/form-data" onsubmit="produk('<?= $p['id_produk'] ?>','update');return false;">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editProduk<?= $p['id_produk'] ?>Label">Edit Data Produk</h5>
                    </div>

                    <div class="modal-body row">
                        <input type="text" name="opsi" value="update" hidden>
                        <input type="text" name="id_produk" value="<?= $p['id_produk'] ?>" hidden>

                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="kode" class="mb-1">Kode Produk</label>
                            <input type="text" name="kode" class="form-control" id="kode" value="<?= $p['kode_produk'] ?>" required />
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="nama_produk" class="mb-1">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="<?= $p['nm_produk'] ?>" required />
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="merek" class="mb-1">Merek</label>
                            <input type="text" name="merek" class="form-control" id="merek" value="<?= $p['merek'] ?>" />
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="kategori" class="mb-1">Kategori</label>
                            <select id="kategori" class="custom-select mr-sm-2" name="kategori" required>
                                <?php
                                $kategori = mysqli_query($db, "SELECT * FROM kategori");
                                foreach ($kategori as $k) { ?>
                                    <option value="<?= $k['id_kategori'] ?>" <?= ($k['kategori'] == $p['kategori']) ? 'selected' : '' ?>> <?= ucwords($k['kategori']) ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="satuan" class="mb-1">Satuan</label>
                            <select id="satuan" class="custom-select mr-sm-2" name="satuan" required>
                                <option <?= ($p['satuan'] == '') ? 'selected' : '' ?>>-Pilih </option>
                                <option <?= ($p['satuan'] == 'CUP') ? 'selected' : '' ?> value="CUP"> CUP </option>
                                <option <?= ($p['satuan'] == 'DUS') ? 'selected' : '' ?> value="DUS"> DUS </option>
                                <option <?= ($p['satuan'] == 'Gr') ? 'selected' : '' ?> value="Gr"> Gr </option>
                                <option <?= ($p['satuan'] == 'Kg') ? 'selected' : '' ?> value="Kg"> Kg </option>
                                <option <?= ($p['satuan'] == 'Ons') ? 'selected' : '' ?> value="Ons"> Ons </option>
                                <option <?= ($p['satuan'] == 'PAK') ? 'selected' : '' ?> value="PAK"> PAK </option>
                                <option <?= ($p['satuan'] == 'PCS') ? 'selected' : '' ?> value="PCS"> PCS </option>
                                <option <?= ($p['satuan'] == 'Liter') ? 'selected' : '' ?> value="Liter"> Liter </option>
                            </select>
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="harga_pokok" class="mb-1">Harga Pokok</label>
                            <input type="text" name="harga_pokok" class="form-control" id="harga_pokok" value="<?= $p['harga_pokok'] ?>" required />
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="harga_jual" class="mb-1">Harga Jual</label>
                            <input type="text" name="harga_jual" class="form-control" id="harga_jual" value="<?= $p['harga_jual'] ?>" required />
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="stok" class="mb-1">Stok</label>
                            <input type="text" name="stok" class="form-control" id="stok" value="<?= $p['stok'] ?>" required />
                        </div>
                        <div class="form-group mb-2 col-12 col-md-6">
                            <label for="kode_gudang" class="mb-1">Kode Gudang</label>
                            <input type="text" name="kode_gudang" class="form-control" id="kode_gudang" value="<?= $p['kode_gudang'] ?>" required />
                        </div>
                        <div class="form-group mb-2 col-12">
                            <label for="deskripsi" class="mb-1">Deskripsi Produk</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?= $p['deskripsi'] ?></textarea>
                        </div>
                        <div class="form-group mb-2 col-12 mt-3">
                            <label class="mb-1" for="gambar">Gambar Produk</label>
                            <input type="file" name="gambar" class="form-control" id="gambar" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="form-group mb-2 col-12 mt-3">
                            <label class="mb-1" for="galeri">Galeri Gambar Produk</label>
                            <input type="file" name="galeri[]" class="form-control" id="galeri" accept=".png, .jpg, .jpeg" multiple>
                        </div>
                    </div>
                    <div class="modal-footer flex-column-reverse flex-md-row">
                        <div class="col-12 col-md-5 mb-2">
                            <button type="button" class="btn btn-secondary m-0 " data-dismiss="modal">Kembali</button>
                        </div>
                        <div class="col-12 col-md-5 mb-3 mb-md-2">
                            <button type="submit" class="btn btn-info m-0">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


<?php } ?>