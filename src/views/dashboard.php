<?php

  // jumlah data akuntansi
  $sqlAkun = "SELECT * FROM tbl_akun";
  $ambilAkun = $conn->query($sqlAkun);
  $jmlDataAkun = $ambilAkun->num_rows;

  // jumlah data transaksi pendapatan
  $sqlPendapatan = "SELECT * FROM tbl_pendapatan";
  $ambilPendapatan = $conn->query($sqlPendapatan);
  $jmlDataPendapatan = $ambilPendapatan->num_rows;

  // jumlah data transaksi pengeluaran
  $sqlPengeluaran = "SELECT * FROM tbl_pengeluaran";
  $ambilPengeluaran = $conn->query($sqlPengeluaran);
  $jmlDataPengeluaran = $ambilPengeluaran->num_rows;

  // jumlah data user
  $sqlUser = "SELECT * FROM tbl_user";
  $ambilUser = $conn->query($sqlUser);
  $jmlDataUser = $ambilUser->num_rows;

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard KAS</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box">
          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-calculator"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Akuntansi</span>
            <span class="info-box-number">
              <?=$jmlDataAkun; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number">
              <?=$jmlDataUser; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix hidden-md-up"></div>

      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Transaksi Pendapatan</span>
            <span class="info-box-number">
              <?=$jmlDataPendapatan; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Transaksi Pengeluaran</span>
            <span class="info-box-number">
              <?=$jmlDataPengeluaran; ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

  </div><!--/. container-fluid -->
</section>
<!-- /.content -->