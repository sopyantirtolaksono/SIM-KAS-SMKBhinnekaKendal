<?php

    // pencarian data dengan tipe pendapatan
    // menghitung jumlah SPI kemudian menghitung total dari SPI & SPP
    $sqlSpi = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan' AND nama_akun = 'spi' ";
    $ambilSpi = $conn->query($sqlSpi);
    $pecahSpi = $ambilSpi->fetch_assoc();
    // menghitung jumlah SPP kemudian menghitung total dari SPI & SPP
    $sqlSpp = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan' AND nama_akun = 'spp' ";
    $ambilSpp = $conn->query($sqlSpp);
    $pecahSpp = $ambilSpp->fetch_assoc();
    // total spi dan spp
    $totalSpiDanSpp = $pecahSpi["SUM(kredit)"] + $pecahSpp["SUM(kredit)"];

    // pencarian data dengan tipe biaya operasional
    $sqlBiayaO = "SELECT * FROM tbl_akun WHERE tipe_akun = 'biaya operasional' ";
    $ambilBiayaO = $conn->query($sqlBiayaO);

    // pencarian data dengan tipe pendapatan lainnya
    $sqlPendapatanL = "SELECT * FROM tbl_akun WHERE tipe_akun = 'pendapatan lainnya' ";
    $ambilPendapatanL = $conn->query($sqlPendapatanL);

    // pencarian data dengan tipe biaya lainnya
    $sqlBiayaL = "SELECT * FROM tbl_akun WHERE tipe_akun = 'biaya lainnya' ";
    $ambilBiayaL = $conn->query($sqlBiayaL);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Laba Rugi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Lap. Laba Rugi</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <form action="" method="" id="formLapLabaRugi">
          <div class="row">
            <div class="col-3">
              <!-- Date range -->
              <!-- <div class="form-group">
                <label>Date range</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="dateRange" name="date_range">
                </div> -->
                <!-- /.input group -->
              <!-- </div> -->
              <!-- /.form group -->
            </div>
            <div class="col-1">
              <!-- <div class="form-group">
                <label>&nbsp;</label>
                <div class="input-group">
                  <button type="submit" class="btn btn-primary" id="btnLihat">Lihat</button>
                </div>
              </div> -->
            </div>
            <div class="col-8">
              <div class="form-group float-right">
                <label>&nbsp;</label>
                <div class="input-group">
                  <a href="src/components/export_pages/excel_lap_laba_rugi.php" class="btn btn-success mb-3" target="_blank" id="btnDownloadExcel">Download Excel</a>
                  <a href="src/components/export_pages/print_lap_laba_rugi.php" class="btn btn-default mb-3" target="_blank" id="btnPrint">Print</a>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan Laba Rugi</h3>
          </div>
          <!-- /.card-header -->

          <div id="loadData">
            <div class="card-body table-responsive p-0">
              <table id="example1" class="table table-bordered table-striped">

                <!-- bagian pendapatan -->
                <thead>
                  <tr>
                    <th colspan="8">Pendapatan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                      <td>pendapatan spi</td>
                      <td>Rp. <?=number_format($pecahSpi["SUM(kredit)"]); ?></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td>pendapatan spp</td>
                      <td>Rp. <?=number_format($pecahSpp["SUM(kredit)"]); ?></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Pendapatan</strong></td>
                      <td><strong>Rp. <?=number_format($totalSpiDanSpp); ?></strong></td>
                  </tr>
                </tbody>

                <!-- bagian biaya operasional -->
                <thead>
                  <tr>
                    <th colspan="8">Biaya Operasional</th>
                  </tr>
                </thead>
                <tbody>

                  <?php  
                    $totalBiayaO = 0;
                    while($pecahBiayaO = $ambilBiayaO->fetch_assoc()) {
                      $totalBiayaO += $pecahBiayaO["debet"];
                  ?>
                  <tr>
                      <td><?=$pecahBiayaO["nama_akun"]; ?></td>
                      <td>Rp. <?=number_format($pecahBiayaO["debet"]); ?></td>
                      <td></td>
                  </tr>
                  <?php } ?>

                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Biaya Operasional</strong></td>
                      <td><strong>Rp. <?=number_format($totalBiayaO); ?></strong></td>
                  </tr>
                  <tr>
                      <?php
                        $labaKotorUsaha = $totalSpiDanSpp - $totalBiayaO;
                      ?>
                      <td colspan="2" class="text-center"><strong>Laba Kotor Usaha</strong></td>
                      <td><strong>Rp. <?=number_format($labaKotorUsaha); ?></strong></td>
                  </tr>
                </tbody>

                <!-- bagian pendapatan lainnya -->
                <thead>
                  <tr>
                    <th colspan="8">Pendapatan Lainnya</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php  
                    $totalPendapatanL = 0;
                    while($pecahPendapatanL = $ambilPendapatanL->fetch_assoc()) {
                      $totalPendapatanL += $pecahPendapatanL["kredit"];
                  ?>
                  <tr>
                      <td><?=$pecahPendapatanL["nama_akun"]; ?></td>
                      <td>Rp. <?=number_format($pecahPendapatanL["kredit"]); ?></td>
                      <td></td>
                  </tr>
                  <?php } ?>

                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Pendapatan Lainnya</strong></td>
                      <td><strong>Rp. <?=number_format($totalPendapatanL); ?></strong></td>
                  </tr>
                </tbody>

                <!-- bagian biaya lainnya -->
                <thead>
                  <tr>
                    <th colspan="8">Biaya Lainnya</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php  
                    $totalBiayaL = 0;
                    while($pecahBiayaL = $ambilBiayaL->fetch_assoc()) {
                      $totalBiayaL += $pecahBiayaL["debet"];
                  ?>
                  <tr>
                      <td><?=$pecahBiayaL["nama_akun"]; ?></td>
                      <td>Rp. <?=number_format($pecahBiayaL["debet"]); ?></td>
                      <td></td>
                  </tr>
                  <?php } ?>

                  <tr>
                      <td colspan="2" class="text-center"><strong>Total Biaya Lainnya</strong></td>
                      <td><strong>Rp. <?=number_format($totalBiayaL); ?></strong></td>
                  </tr>
                  <tr>
                      <?php
                        $labaAtauRugiBersihUsaha = $totalSpiDanSpp - $totalBiayaO + $totalPendapatanL - $totalBiayaL;
                      ?>
                      <td colspan="2" class="text-center"><strong>Laba/Rugi Bersih Usaha</strong></td>
                      <td><strong>Rp. <?=number_format($labaAtauRugiBersihUsaha); ?></strong></td>
                  </tr>
                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>