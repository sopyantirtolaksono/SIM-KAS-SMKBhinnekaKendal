<?php

  // mulai session
  require "src/components/session_start.php";
  
  // koneksi database
  require "src/connection/koneksi_database.php";

  // cek cookienya
  // if(!isset($_COOKIE["idC"]) && !isset($_COOKIE["keyC"])) {

  //   // echo "<h1>";
  //   // echo "Cookie belum ada.";
  //   // echo "</h1>";

  // }

  // cek jika belum ada yang login
  if(!isset($_SESSION["user"])) {
    // alihkan ke halaman login
    header("Location: login.php");
    exit();
  }
  else {
    // ambil id user yg login
    $idUser = $_SESSION["user"]["id_user"];
    // ambil data user yg login
    $sqlUser = "SELECT * FROM tbl_user WHERE id_user = '$idUser' ";
    $ambilUser = $conn->query($sqlUser);
    $pecahUser = $ambilUser->fetch_assoc();
  }

?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if(isset($_GET["halaman"])) {
    $halaman      = $_GET["halaman"];
    $halExploade  = explode("_", $halaman);
    $halImplode   = implode(" ", $halExploade);
  ?>
  <title>kas smk bhinneka kendal | <?=$halImplode; ?></title>
  <?php } ?>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="src/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="src/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="src/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="src/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="src/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="src/plugins/daterangepicker/daterangepicker.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="src/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- jQuery -->
  <script src="src/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php?halaman=dashboard" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="src/components/ajax/logout.php" role="button" id="btnLogoutNavbar">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="src/dist/img/AdminLTELogo.png" alt="Logo Aplikasi" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">KAS SMK BHINNEKA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="src/dist/img/img_users/<?=$pecahUser['gambar']; ?>" class="img-circle elevation-2" alt="Foto User">
        </div>
        <div class="info">
          <a href="index.php?halaman=profil" class="d-block text-capitalize"><?=$pecahUser["nama_lengkap"]; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php if($_GET["halaman"] == "dashboard") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php } ?>
  
          <!-- hak akses untuk bendahara -->
          <?php if($pecahUser["jabatan"] === "bendahara") { ?>
          <?php if($_GET["halaman"] == "daftar_akun") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Akuntansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_akun" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Akun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_akun" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Akun</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "edit_akun") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Akuntansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_akun" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Akun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_akun" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Akun</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "tambah_akun") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Akuntansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_akun" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Akun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_akun" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Akun</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-calculator"></i>
              <p>
                Akuntansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_akun" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Akun</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_akun" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Akun</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <?php if($_GET["halaman"] == "pendapatan") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "tambah_pendapatan") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "edit_pendapatan") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "pengeluaran") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "tambah_pengeluaran") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "edit_pengeluaran") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-hand-holding-usd"></i>
              <p>
                Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php } ?>
          <!-- akhir hak akses bendahara -->

          <?php if($_GET["halaman"] == "profil") { ?>
          <li class="nav-item">
            <a href="index.php?halaman=profil" class="nav-link active">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profil Saya
              </p>
            </a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a href="index.php?halaman=profil" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profil Saya
              </p>
            </a>
          </li>
          <?php } ?>

          <!-- hak akses pimpinan -->
          <?php if($pecahUser["jabatan"] === "pimpinan") { ?>
          <?php if($_GET["halaman"] == "daftar_user") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_user" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "tambah_user") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_user" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "edit_user") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_user" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=daftar_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=tambah_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah User</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php } ?>
          <!-- akhir hak akses pimpinan -->

          <?php if($_GET["halaman"] == "lap_pendapatan") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=lap_pendapatan" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_laba_rugi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_arus_kas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Arus Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_neraca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Neraca</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "lap_pengeluaran") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=lap_pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_pengeluaran" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_laba_rugi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_arus_kas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Arus Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_neraca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Neraca</p>
                </a>
              </li>
            </ul>
          </li>
        <?php } else if($_GET["halaman"] == "lap_laba_rugi") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=lap_pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_laba_rugi" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_arus_kas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Arus Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_neraca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Neraca</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "lap_arus_kas") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=lap_pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_laba_rugi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_arus_kas" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Arus Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_neraca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Neraca</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else if($_GET["halaman"] == "lap_neraca") { ?>
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=lap_pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_laba_rugi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_arus_kas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Arus Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_neraca" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Neraca</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } else { ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?halaman=lap_pendapatan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pendapatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_pengeluaran" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Pengeluaran</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_laba_rugi" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Laba Rugi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_arus_kas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Arus Kas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?halaman=lap_neraca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lap. Neraca</p>
                </a>
              </li>
            </ul>
          </li>
          <?php } ?>

          <li class="nav-item">
            <a href="src/components/ajax/logout.php" class="nav-link" id="btnLogoutSidebar">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>