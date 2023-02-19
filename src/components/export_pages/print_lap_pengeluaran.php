<?php

  	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil date range di url
	$dateRange 	 = $_GET["val"];
	$dateRange 	 = explode("-", $dateRange);
	$tglMulai  	 = $dateRange[0];
	$tglSelesai  = $dateRange[1];

	// ambil data pengeluaran
	$sqlPengeluaran 	= "SELECT * FROM tbl_pengeluaran WHERE tanggal_pengeluaran BETWEEN '$tglMulai' AND '$tglSelesai' ";
	$ambilPengeluaran 	= $conn->query($sqlPengeluaran);

	// mencari & menghitung semua total pengeluaran dari akun yg bernama "KAS"
	$totalKas = 0;
	$sqlTotalKas = "SELECT * FROM tbl_pengeluaran WHERE tanggal_pengeluaran BETWEEN '$tglMulai' AND '$tglSelesai' AND nama_akun = 'kas' ";
	$ambilTotalKas = $conn->query($sqlTotalKas);
	while($pecahTotalKas = $ambilTotalKas->fetch_assoc()) {
		$totalKas += $pecahTotalKas["debet"];
	}

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
			<h3>LAPORAN PENGELUARAN <br>KAS SMK BHINNEKA KENDAL</h3>
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
	            	$jmlDebet  = 0;
			        $jmlKredit = 0;
			        $total     = 0;
		            $no 	   = 1;
	            	while($pecahPengeluaran = $ambilPengeluaran->fetch_assoc()) { 
	            		$jmlDebet  += $pecahPengeluaran["debet"];
            			$jmlKredit += $pecahPengeluaran["kredit"];
	            ?>
	            <tr>
	                <td><?=$no; ?></td>
	                <td><?=$pecahPengeluaran["kode_transaksi"]; ?></td>
	                <td><?=$pecahPengeluaran["kode_akun"]; ?></td>
	                <td><?=$pecahPengeluaran["tanggal_pengeluaran"]; ?></td>
	                <td><?=$pecahPengeluaran["nama_akun"]; ?></td>
	                <td><?=$pecahPengeluaran["keterangan"]; ?></td>
	                <td><?=number_format($pecahPengeluaran["debet"]); ?></td>
	                <td><?=number_format($pecahPengeluaran["kredit"]); ?></td>
	            </tr>
	            <?php 
		            $no++;
		            } 
	            ?>

	            <tr>
		          	<td colspan="6" class="text-right">
		            	<h6>Jumlah(Rp):</h6>
		          	</td>
		          	<td>
		            	<h6><?=number_format($jmlDebet); ?></h6>
		          	</td>
		          	<td>
		            	<h6><?=number_format($jmlKredit); ?></h6>
		          	</td>
		        </tr>

		        <tr>
		          	<td colspan="6" class="text-right">
		            <h6>Total Kas(Rp):</h6>
		          	</td>
		          	<td colspan="2">
		            	<h6><?=number_format($totalKas); ?></h6>
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