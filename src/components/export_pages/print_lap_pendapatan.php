<?php

  	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil date range di url
	$dateRange 	 = $_GET["val"];
	$dateRange 	 = explode("-", $dateRange);
	$tglMulai  	 = $dateRange[0];
	$tglSelesai  = $dateRange[1];

	// ambil data pendapatan
	$sqlPendapatan 	 	= "SELECT * FROM tbl_pendapatan WHERE tanggal_pendapatan BETWEEN '$tglMulai' AND '$tglSelesai' ";
	$ambilPendapatan 	= $conn->query($sqlPendapatan);

	// menghitung jumlah SPI kemudian menghitung total dari SPI & SPP
	$sqlSpi = "SELECT SUM(kredit) FROM tbl_pendapatan WHERE nama_akun = 'spi' AND tanggal_pendapatan BETWEEN '$tglMulai' AND '$tglSelesai' ";
	$ambilSpi = $conn->query($sqlSpi);
	$pecahSpi = $ambilSpi->fetch_assoc();

	// menghitung jumlah SPP kemudian menghitung total dari SPI & SPP
	$sqlSpp = "SELECT SUM(kredit) FROM tbl_pendapatan WHERE nama_akun = 'spp' AND tanggal_pendapatan BETWEEN '$tglMulai' AND '$tglSelesai' ";
	$ambilSpp = $conn->query($sqlSpp);
	$pecahSpp = $ambilSpp->fetch_assoc();

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
			<h3>LAPORAN PENDAPATAN <br>KAS SMK BHINNEKA KENDAL</h3>
			<p class="m-0">Jl. Raya Soekarno - Hatta KM. 5, Jambearum, Patebon, Jambe Kidul, Jambearum, Kec. Patebon, <br>Kabupaten Kendal, Jawa Tengah 51351</p>
		</div>
	</div>

	<hr style="border: 1px solid #000; margin: 1px 1px 16px 1px;">

	<div class="table-responsive">
		<table id="example1" class="table table-bordered table-striped">
	        <thead>
	        <tr>
	            <th>No</th>
	            <th>Kode Transaksi</th>
	            <th>Kode Akun</th>
	            <th>Tanggal</th>
	            <th>Nama Akun</th>
	            <th>Keterangan</th>
	            <th>Debet(Rp)</th>
	            <th>Kredit(Rp)</th>
	        </tr>
	        </thead>
	        <tbody>

	            <?php
			        $total     = 0;
		            $no 	   = 1;
		            while($pecahPendapatan = $ambilPendapatan->fetch_assoc()) {
	            ?>
	            <tr>
	                <td><?=$no; ?></td>
	                <td><?=$pecahPendapatan["kode_transaksi"]; ?></td>
	                <td><?=$pecahPendapatan["kode_akun"]; ?></td>
	                <td><?=$pecahPendapatan["tanggal_pendapatan"]; ?></td>
	                <td><?=$pecahPendapatan["nama_akun"]; ?></td>
	                <td><?=$pecahPendapatan["keterangan"]; ?></td>
	                <td><?=number_format($pecahPendapatan["debet"]); ?></td>
	                <td><?=number_format($pecahPendapatan["kredit"]); ?></td>
	            </tr>
	            <?php 
		            $no++;
		            } 
	            ?>

	            <tr>
		          	<td colspan="7" class="text-right">
		            	<h6>Jumlah SPI(Rp):</h6>
		          	</td>
		          	<td>
		            	<h6><?=number_format($pecahSpi["SUM(kredit)"]); ?></h6>
		          	</td>
		        </tr>
		        <tr>
		          	<td colspan="7" class="text-right">
		            	<h6>Jumlah SPP(Rp):</h6>
		          	</td>
		          	<td>
		            	<h6><?=number_format($pecahSpp["SUM(kredit)"]); ?></h6>
		          	</td>
		        </tr>

		        <tr>
		          	<td colspan="6" class="text-right">
		            	<h6>Total(Rp):</h6>
		          	</td>
		          	<td colspan="2">
		            	<h6>
		              		<?=number_format($total = $pecahSpi["SUM(kredit)"] + $pecahSpp["SUM(kredit)"]); ?>
		            	</h6>
		          	</td>
		        </tr>
	        </tbody>
	    </table>
    </div>



<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>