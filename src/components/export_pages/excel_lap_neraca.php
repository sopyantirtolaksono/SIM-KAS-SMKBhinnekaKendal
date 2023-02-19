<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// pencarian data dengan tipe aktiva lancar
  $sqlAktivaL = "SELECT * FROM tbl_akun WHERE tipe_akun = 'aktiva lancar' ";
  $ambilAktivaL = $conn->query($sqlAktivaL);

  // pencarian data dengan tipe aktiva tetap
  $sqlAktivaT = "SELECT * FROM tbl_akun WHERE tipe_akun = 'aktiva tetap' ";
  $ambilAktivaT = $conn->query($sqlAktivaT);

  // pencarian data dengan tipe kewajiban
  $sqlKewajiban = "SELECT * FROM tbl_akun WHERE tipe_akun = 'kewajiban' ";
  $ambilKewajiban = $conn->query($sqlKewajiban);

  // pencarian data dengan tipe ekuitas & nama akun modal
  $sqlEkuitasModal = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'ekuitas' AND nama_akun = 'modal' ";
  $ambilEkuitasModal = $conn->query($sqlEkuitasModal);
  $pecahEkuitasModal = $ambilEkuitasModal->fetch_assoc();
  $jmlKreditModal = $pecahEkuitasModal["SUM(kredit)"];

  // pencarian data dengan tipe ekuitas & nama akun pengambilan prive
  $sqlEkuitasPrive = "SELECT SUM(debet) FROM tbl_akun WHERE tipe_akun = 'ekuitas' AND nama_akun = 'pengambilan prive' ";
  $ambilEkuitasPrive = $conn->query($sqlEkuitasPrive);
  $pecahEkuitasPrive = $ambilEkuitasPrive->fetch_assoc();
  $jmlDebetPrive = $pecahEkuitasPrive["SUM(debet)"];

  // jumlah ekuitas
  $jmlEkuitas = $jmlKreditModal - $jmlDebetPrive;

  // script export to excel
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=Data_Laporan_Neraca.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Data Laporan Neraca KAS SMK BHINNEKA KENDAL</title>
</head>
<body>

	<h3 style="text-align: center; margin-bottom: 20px;">
		DATA LAPORAN NERACA KAS SMK BHINNEKA KENDAL
	</h3>

	<div class="row">
    <div class="col-6" style="padding: unset;">

      <table border="2" width="100%" cellpadding="10" cellspacing="0">

        <!-- bagian aktiva lancar -->
        <thead>
          <tr>
            <th colspan="2" align="left">Aktiva Lancar</th>
          </tr>
        </thead>
        <tbody>
          
          <?php  
            $jmlDebetAL = 0;
            $jmlKreditAL = 0;
            while($pecahAktivaL = $ambilAktivaL->fetch_assoc()) {
              $jmlDebetAL += $pecahAktivaL["debet"];
              $jmlKreditAL += $pecahAktivaL["kredit"];
          ?>
          <tr>
              <td><?=$pecahAktivaL["nama_akun"]; ?></td>
              <td>Rp. <?=number_format($pecahAktivaL["debet"]); ?></td>
              <td>Rp. <?=number_format($pecahAktivaL["kredit"]); ?></td>
          </tr>
          <?php } ?>

          <tr>
              <td colspan="2" class="text-center"><strong>Jumlah Aktiva Lancar</strong></td>
              <td><strong>Rp. <?=number_format($jmlAktivaL = $jmlDebetAL - $jmlKreditAL); ?></strong></td>
          </tr>
        </tbody>

        <!-- bagian aktiva tetap -->
        <thead>
          <tr>
            <th colspan="2" align="left"></th>
            <th></th>
          </tr>
          <tr>
            <th colspan="2" align="left">Aktiva Tetap</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
          <?php  
            $jmlDebetAT = 0;
            $jmlKreditAT = 0;
            while($pecahAktivaT = $ambilAktivaT->fetch_assoc()) {
              $jmlDebetAT += $pecahAktivaT["debet"];
              $jmlKreditAT += $pecahAktivaT["kredit"];
          ?>
          <tr>
              <td><?=$pecahAktivaT["nama_akun"]; ?></td>
              <td>Rp. <?=number_format($pecahAktivaT["debet"]); ?></td>
              <td>Rp. <?=number_format($pecahAktivaT["kredit"]); ?></td>
          </tr>
          <?php } ?>

          <tr>
              <td colspan="2" class="text-center"><strong>Jumlah Aktiva Tetap</strong></td>
              <td><strong>Rp. <?=number_format($jmlAktivaT = $jmlDebetAT - $jmlKreditAT); ?></strong></td>
          </tr>
          <tr>
              <?php
                // menghitung kemungkinan yg terjadi utk mencari total aktiva
                if($jmlAktivaL > 0 && $jmlAktivaT > 0) {
                  $totalAktiva = $jmlAktivaL + $jmlAktivaT;
                }
                else if($jmlAktivaL > 0 && $jmlAktivaT < 0) {
                  $totalAktiva = $jmlAktivaL - $jmlAktivaT;
                }
                else if($jmlAktivaL < 0 && $jmlAktivaT > 0) {
                  $totalAktiva = $jmlAktivaL + $jmlAktivaT;
                }
                else if($jmlAktivaL < 0 && $jmlAktivaT < 0) {
                  $totalAktiva = $jmlAktivaL - $jmlAktivaT;
                }
                else {
                  $totalAktiva = $jmlAktivaL + $jmlAktivaT;
                }
              ?>  
              <td colspan="2" class="text-center"><strong>Total Aktiva</strong></td>
              <td><strong>Rp. <?=number_format($totalAktiva); ?></strong></td>
          </tr>
        </tbody>

      </table>

    </div>

    <div class="col-6" style="padding: unset;">

      <table border="2" width="100%" cellpadding="10" cellspacing="0">

        <!-- bagian kewajiban -->
        <thead>
          <tr>
            <th colspan="2" align="left"></th>
            <th></th>
          </tr>
          <tr>
            <th colspan="2" align="left">Kewajiban</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
          <?php  
            $jmlKewajiban = 0;
            while($pecahKewajiban = $ambilKewajiban->fetch_assoc()) {
              $jmlKewajiban += $pecahKewajiban["kredit"];
          ?>
          <tr>
              <td><?=$pecahKewajiban["nama_akun"]; ?></td>
              <td>Rp. <?=number_format($pecahKewajiban["kredit"]); ?></td>
              <td></td>
          </tr>
          <?php } ?>

          <td colspan="2" class="text-center"><strong>Jumlah Kewajiban</strong></td>
              <td><strong>Rp. <?=number_format($jmlKewajiban); ?></strong></td>
          </tr>
        </tbody>

        <!-- bagian ekuitas -->
        <thead>
          <tr>
            <th colspan="2" align="left"></th>
            <th></th>
          </tr>
          <tr>
            <th colspan="2" align="left">Ekuitas</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          
          <tr>
              <td>modal</td>
              <td>Rp. <?=number_format($jmlKreditModal); ?></td>
              <td></td>
          </tr>
          <tr>
              <td>pengambilan prive</td>
              <td>Rp. <?=number_format($jmlDebetPrive); ?></td>
              <td></td>
          </tr>

          <tr>
              <td colspan="2" class="text-center"><strong>Jumlah Ekuitas</strong></td>
              <td><strong>Rp. <?=number_format($jmlEkuitas); ?></strong></td>
          </tr>
          <tr>
              <?php
                // menghitung kemungkinan yg terjadi utk mencari total passiva
                if($jmlKewajiban > 0 && $jmlEkuitas > 0) {
                  $totalPassiva = $jmlKewajiban + $jmlEkuitas;
                }
                else if($jmlKewajiban > 0 && $jmlEkuitas < 0) {
                  $totalPassiva = $jmlKewajiban - $jmlEkuitas;
                }
                else if($jmlKewajiban < 0 && $jmlEkuitas > 0) {
                  $totalPassiva = $jmlKewajiban + $jmlEkuitas;
                }
                else if($jmlKewajiban < 0 && $jmlEkuitas < 0) {
                  $totalPassiva = $jmlKewajiban - $jmlEkuitas;
                }
                else {
                  $totalPassiva = $jmlKewajiban + $jmlEkuitas;
                }
              ?>
              <td colspan="2" class="text-center"><strong>Total Passiva</strong></td>
              <td><strong>Rp. <?=number_format($totalPassiva); ?></strong></td>
          </tr>
        </tbody>

      </table>

    </div>
  </div>
	
</body>
</html>