<div class="bar-navigasi shadow-sm bg-light"></div>
<div class="spasi-header"></div>

<section id="keranjang" class="keranjang">

    <div class="container-obrolan px-2">
        <button class="btn mt-1" onclick="history.go(-1);">
            <i class="fa-solid fa-arrow-left"></i>
        </button>

        <div class="row">
            <!-- akun admin -->
            <div class="col-md-4 list-akun-admin border rounded">
                <h5 class="tebal-600 p-2 border-bottom">Obrolan (User<?= $id_pengunjung ?>)</h5>
                <div id="list-obrolan-admin">

                </div>

            </div>
            <!-- /akun admin -->

            <!-- live chat -->
            <div class="col-md-8">
                <?php
                $nama_admin = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM akun WHERE id_akun = '$id_obrolan'"));

                ?>
                <div class="card overflow-hidden">
                    <div class="card-body p-0">
                        <div class="header-msg p-3 bg-light position-relative">
                            <h6 id="judul-pesan-dekstop" class="card-title box-title tebal-600 d-inline-block mb-0"><?= $nama_admin['username'] ?> </h6>
                            <button id="judul-pesan-mobile" type="button" class="btn btn-sm tebal-600 fs-6" data-bs-toggle="modal" data-bs-target="#exampleModal"><?= $nama_admin['username'] ?> <i class="fa-solid fa-sort-down"></i></button>
                            <span class="badge rounded-pill text-bg-success" style="font-size: 0.5em !important;">online</span>

                            <button class="btn bg-ijo btn-sm rounded-circle position-absolute end-0 me-3" onclick="scrollBawah()"><i class="fa-solid fa-chevron-down text-white"></i></button>

                        </div>
                        <div class="card-content p-0">
                            <div class="messenger-box overflow-y-auto p-3" style="height: 55vh;">
                                <div class="text-center mb-2">
                                    <label class="p-1 bg-light shadow-sm" style="font-size: 0.7em;">Mulai Obrolanmu</label>
                                </div>

                                <!-- area pesan -->
                                <div id="area-msg">

                                </div>
                                <!-- area pesan -->
                                <div class="py-4 mt-1"></div>

                            </div>
                            <div class="card-footer bg-white">
                                <div class="send-mgs">
                                    <div class="yourmsg">
                                        <!-- hidden -->
                                        <input type="text" name="input_id_admin" value="<?= $id_obrolan ?>" hidden>
                                        <input type="text" name="input_id_pengunjung" value="<?= $id_pengunjung ?>" hidden>
                                        <!-- hidden -->
                                        <input class="form-control" name="input_msg" type="text">
                                    </div>
                                    <button class="btn msg-send-btn rounded-circle bg-warning" onclick="kirimPesan()">
                                        <i class="pe-7s-paper-plane text-white"></i>
                                    </button>

                                </div><!-- /.messenger-box -->
                            </div>
                        </div>
                    </div> <!-- /.card-body -->
                </div><!-- /.card -->
            </div>
            <!-- /live chat -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5 tebal-600" id="exampleModalLabel">Obrolan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div id="modal-list-obrolan-admin">

                    </div>

                </div>
            </div>
        </div>
    </div>


</section>