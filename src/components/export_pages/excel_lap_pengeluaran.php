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

    // script export to excel
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data_Laporan_Pengeluaran.xls");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Export Data Laporan Pengeluaran KAS SMK BHINNEKA KENDAL</title>
</head>
<body>

	<h3 style="text-align: center; margin-bottom: 20px;">
		DATA LAPORAN PENGELUARAN KAS SMK BHINNEKA KENDAL<br>
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
				$jmlDebet  = 0;
		        $jmlKredit = 0;
	          	foreach($ambilPengeluaran as $data => $value) :
	          		$jmlDebet  += $value["debet"];
            		$jmlKredit += $value["kredit"];
	        ?>
	        <tr>
	          	<td><?=$data+1; ?></td>
	          	<td><?=$value["kode_transaksi"]; ?></td>
	          	<td><?=$value["kode_akun"]; ?></td>
	          	<td><?=$value["tanggal_pengeluaran"]; ?></td>
	          	<td><?=$value["nama_akun"]; ?></td>
	          	<td><?=$value["keterangan"]; ?></td>
	          	<td><?=number_format($value["debet"]); ?></td>
          		<td><?=number_format($value["kredit"]); ?></td>
	        </tr>
	        <?php
	          endforeach;
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
	
</body>
</html>