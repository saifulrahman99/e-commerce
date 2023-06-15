<?php
session_start();
require_once '../assets/basis/kon.php';
require 'function/cek-login.php';
require 'function/base_url.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="apple-touch-icon" href="<?= base_url('../assets/img/brand/adastra.png') ?>">
    <link rel="shortcut icon" href="<?= base_url('../assets/img/brand/adastra.png') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">

    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/template/css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin-style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li>
                        <a class="klik_menu active" id="dashboard"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>


                    <li class="menu-title">Data</li><!-- /.menu-title -->
                    <li class="klik_menu menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Produk</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="ti-direction"></i><a class="klik_menu" id="produk">Produk</a></li>
                            <li><i class="ti-direction"></i><a class="klik_menu" id="kategori">Kategori</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="klik_menu" id="promo"><i class="menu-icon fa fa-laptop"></i>Promo </a>
                    </li>
                    <li>
                        <a class="klik_menu" id="toko"><i class="menu-icon fa fa-laptop"></i>Toko </a>
                    </li>

                    <li class="menu-title">Informasi</li><!-- /.menu-title -->
                    <li>
                        <a class="klik_menu" id="transaksi"><i class="menu-icon fa fa-laptop"></i>Transaksi </a>
                    </li>
                    <li>
                        <a class="klik_menu" id="pesan"><i class="menu-icon ti-comment-alt"></i>Pesan <span class="count bg-danger">3</span></a>
                    </li>
                    <li>
                        <a class="klik_menu" id="notifikasi"><i class="menu-icon ti-bell"></i>Notifikasi </a>
                    </li>

                    <li class="menu-title">Pengaturan</li><!-- /.menu-title -->

                    <li>
                        <a class="klik_menu" id="pengaturan"><i class="menu-icon ti-settings"></i>Pengaturan </a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="<?= base_url('../assets/img/brand/adastra.png') ?>" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="<?= base_url('../assets/img/brand/adastra.png') ?>" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>


                    </div>

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="<?= base_url('assets/img/user-profile.png') ?>" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                            <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">13</span></a>

                            <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="logout"><i class="fa fa-power -off"></i>Logout</a>

                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->

        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div id="isi-content-halaman" class="animated fadeIn">

            </div>
            <!-- .animated -->
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
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->


    </div>
    <!-- /#right-panel -->


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="<?= base_url('assets/template/js/main.js') ?>"></script>


    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/flot-charts@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.flot.tooltip@0.9.0/js/jquery.flot.tooltip.min.js"></script>


    <script src="<?= base_url('assets/template/js/init/fullcalendar-init.js') ?>"></script>
    <script src="<?= base_url('assets/js/admin-script.js') ?>"></script>

    <script src="<?= base_url('assets/template/js/init/flot-chart-init.js') ?>"></script>
</body>

</html>