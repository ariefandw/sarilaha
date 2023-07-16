<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Primary Meta Tags -->
    <title>SIDANG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="SIDANG">
    <meta name="author" content="ColorlibHQ">
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS.">
    <meta name="keywords" content="ugm fmipa sidang mahasiswa akademik tesis skripsi tugas akhir">

    <!-- OPTIONAL LINKS -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.0.3/styles/overlayscrollbars.min.css"
        integrity="sha256-57dSpDS5wv9AYEEmLxcPfrVnygNCdqDWOXyoR46L9H0=" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/all.min.css"
        integrity="sha256-Z1K5uhUaJXA7Ll0XrZ/0JhX4lAtZFpT6jkKrEDT0drU=" crossorigin="anonymous">

    <!-- REQUIRED LINKS -->

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('css/adminlte.css'); ?>">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/vue3-sfc-loader/dist/vue3-sfc-loader.js"></script>
    <script type="importmap">
    { 
        "imports": {
            "vue":               "https://unpkg.com/vue@3/dist/vue.esm-browser.prod.js",
            "vue-router":        "https://cdnjs.cloudflare.com/ajax/libs/vue-router/4.1.5/vue-router.esm-browser.min.js",
            "@vue/devtools-api": "https://unpkg.com/@vue/devtools-api@6.4.5/lib/esm/index.js"
        } 
    }
    </script> -->
    <style>
        .nav-link.active,
        .sidebar-wrapper .sidebar-menu>.nav-item>.nav-link.active:not(:hover) {
            color: #005575 !important;
            background-color: white !important;
            font-weight: bold;
        }
    </style>

    <?= $this->renderSection('css') ?>
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper" id="app">
        <!-- Navbar -->
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <!-- Start navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i
                                class="fa-solid fa-bars"></i></a>
                    </li>
                    <!-- <li class="nav-item d-none d-md-block">
        <a href="#" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-md-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
                </ul>

                <!-- End navbar links -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="<?= base_url('img/user2-160x160.jpg'); ?>"
                                class="user-image rounded-circle shadow" alt="User Image">
                            <span class="d-none d-md-inline">
                                <?= session('user')['nama'] ?>
                                <?= '(' . session('user')['group'] . ')' ?>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!-- User image -->
                            <li class="user-header text-bg-primary">
                                <img src="<?= base_url('img/user2-160x160.jpg'); ?>" class="rounded-circle shadow"
                                    alt="User Image">

                                <p>
                                    <?= session('user')['nama'] ?> -
                                    <?= session('user')['group'] ?>
                                    <small>
                                        <?= session('user')['email'] ?>
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="<?= site_url('logout'); ?>" class="btn btn-default btn-flat float-end">Sign
                                    out</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <button
                            class="btn btn-link nav-link py-2 px-0 px-lg-2 dropdown-toggle d-flex align-items-center"
                            id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
                            data-bs-display="static">
                            <span class="theme-icon-active">
                                <i class="my-1"></i>
                            </span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="bd-theme"
                            style="--bs-dropdown-min-width: 8rem;">
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center active"
                                    data-bs-theme-value="light">
                                    <i class="fa-regular fa-sun me-2"></i>
                                    Light
                                    <i class="fa-solid fa-check ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="dark">
                                    <i class="fa-solid fa-moon me-2"></i>
                                    Dark
                                    <i class="fa-solid fa-check ms-auto d-none"></i>
                                </button>
                            </li>
                            <li>
                                <button type="button" class="dropdown-item d-flex align-items-center"
                                    data-bs-theme-value="auto">
                                    <i class="fa-solid fa-circle-half-stroke me-2"></i>
                                    Auto
                                    <i class="fa-solid fa-check ms-auto d-none"></i>
                                </button>
                            </li>
                        </ul>
                    </li>
                    <!-- TODO tackel in v4.1 -->
                    <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fa-solid fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fa-solid fa-th-large"></i>
        </a>
      </li> -->
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->
        <!-- Sidebar Container -->
        <aside class="app-sidebar shadow" data-bs-theme="dark" style="background-color: #005575;">
            <div class="sidebar-brand">
                <a href="./index.html" class="brand-link">
                    <img src="https://simaster.ugm.ac.id/ugmfw-assets/images/ugm.png" alt="UGM Logo"
                        class="brand-image opacity-75 shadow">
                    <span class="brand-text fw-bold">SIDANG</span>
                </a>
            </div>
            <!-- Sidebar -->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!-- Sidebar Menu -->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= site_url('/'); ?>" class="nav-link <?= activeMenu('/') ?>">
                                <i class="nav-icon fa-solid fa-home"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <li class="nav-header">PENGUJIAN</li>
                        <li class="nav-item">
                            <a href="<?= site_url('ujian'); ?>" class="nav-link <?= activeMenu('ujian') ?>">
                                <i class="nav-icon fa-regular fa-circle"></i>
                                <p>Ujian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('jenisujian'); ?>" class="nav-link <?= activeMenu('jenisujian') ?>">
                                <i class="nav-icon fa-regular fa-circle"></i>
                                <p>Jenis Ujian</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item menu-open">
                            <a href="javascript:;" class="nav-link active">
                                <i class="nav-icon fa-solid fa-gauge-high"></i>
                                <p>
                                    Menu
                                    <i class="nav-arrow fa-solid fa-angle-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= site_url('ujian'); ?>" class="nav-link active">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Ujian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= site_url('jenisujian'); ?>" class="nav-link">
                                        <i class="nav-icon fa-regular fa-circle"></i>
                                        <p>Jenis Ujian</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="nav-header">REFERENSI</li>
                        <li class="nav-item">
                            <a href="<?= site_url('dosen'); ?>" class="nav-link <?= activeMenu('dosen') ?>">
                                <i class="nav-icon fa-regular fa-circle"></i>
                                <p>Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('mahasiswa'); ?>" class="nav-link <?= activeMenu('mahasiswa') ?>">
                                <i class="nav-icon fa-regular fa-circle"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('prodi'); ?>" class="nav-link <?= activeMenu('prodi') ?>">
                                <i class="nav-icon fa-regular fa-circle"></i>
                                <p>Prodi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= site_url('user'); ?>" class="nav-link <?= activeMenu('user') ?>">
                                <i class="nav-icon fa-regular fa-circle"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Main content -->
        <main class="app-main">
            <!-- <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">
                                Title
                            </h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="app-content mt-2">
                <div class="container-fluid" id="app">
                    <div id="template">
                        <?= '' //dd(auth()->user()->getPermissions()) ?>
                        <?= $this->renderSection('content') ?>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
        </main>
        <!-- /.app-content -->

        <!-- Main Footer -->
        <footer class="app-footer">
            <!-- <div class="float-end d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2014-2023 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
        </footer>
    </div>
    <!--  ./app-wrapper -->

    <?= $this->renderSection('js') ?>

</body>

</html>