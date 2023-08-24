<?php
session_start();
require_once '../assets/basis/kon.php';
require 'function/cek-login.php';
require 'function/base_url.php';
require 'controllers/off-promo.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="apple-touch-icon" href="<?= base_url('../assets/img/brand/adastra.png') ?>">
    <link rel="shortcut icon" href="<?= base_url('../assets/img/brand/adastra.png') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

    <!-- data table -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">



    <!-- data table -->


    <link rel="stylesheet" href="<?= base_url('assets/template/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body class="p-0">

    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li class="klik_menu active" id="dashboard">
                        <a><i class="menu-icon ti-home"></i>Dashboard </a>
                    </li>


                    <li class="menu-title">Data</li><!-- /.menu-title -->
                    <li class="klik_menu menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-bag"></i>Produk</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li class="pt-2 pb-1 klik_menu" id="produk"><i class="ti-direction pt-2"></i><a>Produk</a></li>
                            <li class="pt-2 pb-1 klik_menu" id="kategori"><i class="ti-direction pt-2"></i><a>Kategori</a></li>
                        </ul>
                    </li>
                    <li class="klik_menu" id="promo">
                        <a><i class="menu-icon fa fa-gift"></i>Promo </a>
                    </li>
                    <li class="klik_menu" id="toko">
                        <a><i class="menu-icon fa fa-laptop"></i>Toko </a>
                    </li>
                    <li class="klik_menu" id="pengunjung">
                        <a><i class="menu-icon fa fa-users"></i>Pengunjung </a>
                    </li>

                    <li class="menu-title">Informasi</li><!-- /.menu-title -->
                    <li class="klik_menu" id="transaksi">
                        <a><i class="menu-icon ti-receipt"></i>Transaksi </a>
                    </li>
                    <li class="klik_menu" id="pesan">
                        <a><i class="menu-icon ti-comment-alt"></i>Pesan </a>
                    </li>
                    <li class="klik_menu" id="notifikasi">
                        <a><i class="menu-icon ti-bell"></i>Notifikasi </a>
                    </li>
                    <li class="menu-title">Pengaturan</li><!-- /.menu-title -->

                    <li class="klik_menu" id="api">
                        <a><i class="menu-icon ti-settings"></i>Pengaturan API</a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">

        <!-- toast notif -->
        <div class="position-fixed p-3" style="z-index: 5; right: 0; top: 1; width: 250px;">
            <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
                <div class="toast-header">
                    <img src="<?= base_url('../assets/img/brand/adastra.jpg') ?>" class="rounded mr-2" alt="..." style="width: 20px;">
                    <strong class="mr-auto">Notifikasi</strong>
                </div>
                <div class="toast-body">
                    Ada Pesan Baru
                </div>
            </div>
        </div>
        <!-- /toast notif -->

        <!-- Modal sukses-->
        <div class="modal fade" id="suksesModal" tabindex="-1" aria-labelledby="suksesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center py-4">
                        <h3 style="font-weight: 700;">Berhasil</h3>
                        <img src="assets/img/success.gif" alt="..">
                        <div class="text-center mt-3">
                            <button type="button" class="btn btn-lg btn-success px-5" data-dismiss="modal">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Modal sukses-->


        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?= base_url('adastra') ?>"><img src="<?= base_url('../assets/img/brand/adastra.png') ?>" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="<?= base_url('../assets/img/brand/adastra.png') ?>" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div id="input-jml-pesan">

                    </div>

                    <?php
                    $id_admin = $_COOKIE['id_admin'];
                    // set jlm pesan awal
                    $total_pesan = mysqli_fetch_assoc(mysqli_query($db, "SELECT COUNT(status_terbaca) as jml_pesan FROM obrolan WHERE status_terbaca = '0' AND pengirim != '$id_admin'"));
                    ?>
                    <!-- jml pesan awal -->
                    <input type="text" id="total_pesan_diterima_old" value="<?= $total_pesan['jml_pesan'] ?>" hidden>
                    <!-- jml pesan awal -->
                    <div class="header-left">

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" onclick="loadPesan()">
                                <i class="fa fa-comments"></i>
                                <span id="notif-bell-pesan" class="count bg-danger op-none"></span>
                            </button>
                        </div>

                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?= base_url('assets/img/user-profile.png') ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#exampleModal" data-toggle="modal"><i class="fa fa- user"></i>Settings</a>

                            <a class="nav-link" href="logout"><i class="fa fa-power -off"></i>Logout</a>

                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

        <!-- Content -->
        <div id="isi-content-halaman">

        </div>
        <!-- /.content -->

        <div class="clearfix"></div>


        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white p-2">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2023 Saiful Rahman
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pengaturan Akun Admin</h5>
                    </div>
                    <form action="<?= base_url('adastra/edit-akun') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="username" class="mb-1">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Kosongi jika tidak ada perubahan" />
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="mb-1">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Kosongi jika tidak ada perubahan" />
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-success col-11">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary col-11" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- /#right-panel -->


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>

    <script src="<?= base_url('assets/template/js/main.js') ?>"></script>

    <!-- data table -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

    <!-- /data table -->

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flot-charts@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot.tooltip@0.9.0/js/jquery.flot.tooltip.min.js"></script>

    <!-- ckeditor -->
    <script src="<?= base_url('vendor/ckeditor/ckeditor.js') ?>"></script>
    <!-- /ckeditor -->


    <script src="<?= base_url('assets/template/js/init/fullcalendar-init.js') ?>"></script>
    <script src="<?= base_url('assets/js/admin-halaman.js') ?>"></script>
    <script src="<?= base_url('assets/js/ajax-admin.js') ?>"></script>

    <script src="<?= base_url('assets/template/js/init/flot-chart-init.js') ?>"></script>

    <?php
    $hlm = (isset($_SESSION['hlmn_admin'])) ? $_SESSION['hlmn_admin'] : "";
    ?>
    <script>
        $(document).ready(function() {

            var hlm = "<?= $hlm ?>";
            // alert(hlm);

            if (hlm != '') {
                var page = "view/" + hlm + ".php";
                setTimeout(() => {
                    $('#isi-content-halaman').load(page);
                }, 50);
            }
        });
        document.getElementsByClassName('subtitle').remove();
    </script>

    <?php $_SESSION['hlmn_admin'] = ''; ?>
</body>

</html>