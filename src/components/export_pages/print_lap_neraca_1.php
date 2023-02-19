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
			<h3>LAPORAN NERACA <br>KAS SMK BHINNEKA KENDAL</h3>
			<p class="m-0">Jl. Raya Soekarno - Hatta KM. 5, Jambearum, Patebon, Jambe Kidul, Jambearum, Kec. Patebon, <br>Kabupaten Kendal, Jawa Tengah 51351</p>
		</div>
	</div>

	<hr style="border: 1px solid #000; margin: 1px 1px 16px 1px;">
	
	<div class="card-body table-responsive p-0">
    <div class="row">
      <div class="col-6" style="padding: unset;">
        <table id="example1" class="table table-bordered table-striped">

            <!-- bagian aktiva lancar -->
        <thead>
              <tr>
                <th colspan="8">Aktiva Lancar</th>
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
                <th colspan="8">Aktiva Tetap</th>
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
        <table id="example1" class="table table-bordered table-striped">

            <!-- bagian kewajiban -->
        <thead>
              <tr>
                <th colspan="8">Kewajiban</th>
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

              <tr>
                  <td colspan="2" class="text-center"><strong>Jumlah Kewajiban</strong></td>
                  <td><strong>Rp. <?=number_format($jmlKewajiban); ?></strong></td>
              </tr>
            </tbody>

            <!-- bagian ekuitas -->
        <thead>
              <tr>
                <th colspan="8">Ekuitas</th>
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

  </div>
  <!-- /.card-body -->


<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>