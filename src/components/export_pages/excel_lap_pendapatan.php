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

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data_Laporan_Pendapatan.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Data Laporan Pendapatan KAS SMK BHINNEKA KENDAL</title>
</head>
<body>

	<h3 style="text-align: center; margin-bottom: 20px;">
		DATA LAPORAN PENDAPATAN KAS SMK BHINNEKA KENDAL<br>
		(<?php echo $tglMulai." - ".$tglSelesai; ?>)
	</h3>

	<table border="2" width="100%" cellpadding="10" cellspacing="0">
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
	          	foreach($ambilPendapatan as $data => $value) :
	        ?>
	        <tr>
	          	<td><?=$data+1; ?></td>
	          	<td><?=$value["kode_transaksi"]; ?></td>
	          	<td><?=$value["kode_akun"]; ?></td>
	          	<td><?=$value["tanggal_pendapatan"]; ?></td>
	          	<td><?=$value["nama_akun"]; ?></td>
	          	<td><?=$value["keterangan"]; ?></td>
	          	<td><?=number_format($value["debet"]); ?></td>
	          	<td><?=number_format($value["kredit"]); ?></td>
	        </tr>
	        <?php
	          endforeach;
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
	
</body>
</html>