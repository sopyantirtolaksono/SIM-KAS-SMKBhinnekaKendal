<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // jika data sudah dikirim
  if(isset($_POST["date_range"])) {
    // ambil datanya
    $dateRange   = mysqli_real_escape_string($conn, htmlspecialchars($_POST["date_range"]));

    // merubah date range bertipe data string menjadi array
    $explodeDateRange = explode(" - ", $dateRange);
    $dateRange1  = $explodeDateRange[0];
    $dateRange2  = $explodeDateRange[1];

    // pencarian data dengan tipe pendapatan
    // menghitung jumlah SPI kemudian menghitung total dari SPI & SPP
    $sqlSpi = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan' AND nama_akun = 'spi' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
    $ambilSpi = $conn->query($sqlSpi);
    $pecahSpi = $ambilSpi->fetch_assoc();
    // menghitung jumlah SPP kemudian menghitung total dari SPI & SPP
    $sqlSpp = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan' AND nama_akun = 'spp' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
    $ambilSpp = $conn->query($sqlSpp);
    $pecahSpp = $ambilSpp->fetch_assoc();
    // total spi dan spp
    $totalSpiDanSpp = $pecahSpi["SUM(kredit)"] + $pecahSpp["SUM(kredit)"];

    // pencarian data dengan tipe biaya operasional
    $sqlBiayaO = "SELECT * FROM tbl_akun WHERE tipe_akun = 'biaya operasional' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
    $ambilBiayaO = $conn->query($sqlBiayaO);
    $statusBiayaO = $ambilBiayaO->num_rows;

    // pencarian data dengan tipe pendapatan lainnya
    $sqlPendapatanL = "SELECT * FROM tbl_akun WHERE tipe_akun = 'pendapatan lainnya' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
    $ambilPendapatanL = $conn->query($sqlPendapatanL);
    $statusPendapatanL = $ambilPendapatanL->num_rows;

    // pencarian data dengan tipe biaya lainnya
    $sqlBiayaL = "SELECT * FROM tbl_akun WHERE tipe_akun = 'biaya lainnya' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
    $ambilBiayaL = $conn->query($sqlBiayaL);
    $statusBiayaL = $ambilBiayaL->num_rows;   

  }

?>

<div class="card-body table-responsive p-0">
  <table id="example1" class="table table-bordered table-striped">

    <!-- bagian pendapatan -->
    <thead>
      <tr>
        <th colspan="8">Pendapatan</th>
      </tr>
    </thead>
    <tbody>
      <?php if($totalSpiDanSpp > 0 || $totalSpiDanSpp < 0) { ?>

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
      <?php } else { ?>
      <tr>
          <td>Not found</td>
          <td>Rp. 0</td>
          <td></td>
      </tr>
      <tr>
          <td colspan="2" class="text-center"><strong>Total Pendapatan</strong></td>
          <td><strong>Rp. 0</strong></td>
      </tr>
      <?php } ?>

    </tbody>

    <!-- bagian biaya operasional -->
    <thead>
      <tr>
        <th colspan="8">Biaya Operasional</th>
      </tr>
    </thead>
    <tbody>
      <?php if($statusBiayaO > 0) { ?>

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

      <?php } else { ?>

      <?php $totalBiayaO = 0; ?>
      <tr>
          <td>Not found</td>
          <td>Rp. 0</td>
          <td></td>
      </tr>
      <tr>
          <td colspan="2" class="text-center"><strong>Total Biaya Operasional</strong></td>
          <td><strong>Rp. 0</strong></td>
      </tr>
      <tr>
          <td colspan="2" class="text-center"><strong>Laba Kotor Usaha</strong></td>
          <td><strong>Rp. 0</strong></td>
      </tr>

      <?php } ?>
    </tbody>

    <!-- bagian pendapatan lainnya -->
    <thead>
      <tr>
        <th colspan="8">Pendapatan Lainnya</th>
      </tr>
    </thead>
    <tbody>
      <?php if($statusPendapatanL > 0) { ?>
      
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

      <?php } else { ?>

      <?php $totalPendapatanL = 0; ?>
      <tr>
          <td>Not found</td>
          <td>Rp. 0</td>
          <td></td>
      </tr>

      <tr>
          <td colspan="2" class="text-center"><strong>Total Pendapatan Lainnya</strong></td>
          <td><strong>Rp. 0</strong></td>
      </tr>

      <?php } ?>
    </tbody>

    <!-- bagian biaya lainnya -->
    <thead>
      <tr>
        <th colspan="8">Biaya Lainnya</th>
      </tr>
    </thead>
    <tbody>
      <?php if($statusBiayaL > 0) { ?>
      
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

      <?php } else { ?>

      <?php $totalBiayaL = 0; ?>
      <tr>
          <td>Not found</td>
          <td>Rp. 0</td>
          <td></td>
      </tr>
      <tr>
          <td colspan="2" class="text-center"><strong>Total Biaya Lainnya</strong></td>
          <td><strong>Rp. 0</strong></td>
      </tr>

      <?php } ?>

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