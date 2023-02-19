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

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Style CSS -->
  <style type="text/css">
  	/*tampilan mobile*/
    @media screen and (max-width: 768px) {
        div.row-cop img {
            display: none !important;
        }
    }
  </style>
</head>

<body onload="window.print();">

	<div class="row mb-4 row-cop">
		<div class="col-xs-3 text-center">
			<img src="../../dist/img/img_app_logo/smk_bhinneka_kendal.jpeg" alt="Logo SMK BHINNEKA KENDAL" width="70%">
		</div>
		<div class="col-xs-9 m-auto text-center">
			<h3>LAPORAN LABA RUGI <br>KAS SMK BHINNEKA KENDAL</h3>
			<p class="m-0">Jl. Raya Soekarno - Hatta KM. 5, Jambearum, Patebon, Jambe Kidul, Jambearum, Kec. Patebon, <br>Kabupaten Kendal, Jawa Tengah 51351</p>
		</div>
	</div>

	<hr style="border: 1px solid #000; margin: 1px 1px 16px 1px;">
	
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


<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>