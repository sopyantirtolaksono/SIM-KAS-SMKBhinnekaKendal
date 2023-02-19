<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

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

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data_Laporan_Laba_Rugi.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Data Laporan Laba Rugi KAS SMK BHINNEKA KENDAL</title>
</head>
<body>

	<h3 style="text-align: center; margin-bottom: 20px;">
		DATA LAPORAN LABA RUGI KAS SMK BHINNEKA KENDAL
	</h3>

	<table border="2" width="100%" cellpadding="10" cellspacing="0">

        <!-- bagian pendapatan -->
        <thead>
          <tr>
            <th colspan="2" align="left">Pendapatan</th>
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
          	<th colspan="2" align="left"></th>
          	<th></th>
          </tr>
          <tr>
            <th colspan="2" align="left">Biaya Operasional</th>
            <th></th>
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
          	<th colspan="2" align="left"></th>
          	<th></th>
          </tr>
          <tr>
            <th colspan="2" align="left">Pendapatan Lainnya</th>
            <th></th>
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
          	<th colspan="2" align="left"></th>
          	<th></th>
          </tr>
          <tr>
            <th colspan="2" align="left">Biaya Lainnya</th>
            <th></th>
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
	
</body>
</html>