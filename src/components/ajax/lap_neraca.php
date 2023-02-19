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

      	// pencarian data dengan tipe aktiva lancar
	    $sqlAktivaL = "SELECT * FROM tbl_akun WHERE tipe_akun = 'aktiva lancar' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilAktivaL = $conn->query($sqlAktivaL);
	    $statusAktivaL = $ambilAktivaL->num_rows;

	    // pencarian data dengan tipe aktiva tetap
	    $sqlAktivaT = "SELECT * FROM tbl_akun WHERE tipe_akun = 'aktiva tetap' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilAktivaT = $conn->query($sqlAktivaT);
	    $statusAktivaT = $ambilAktivaT->num_rows;

	    // pencarian data dengan tipe kewajiban
	    $sqlKewajiban = "SELECT * FROM tbl_akun WHERE tipe_akun = 'kewajiban' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilKewajiban = $conn->query($sqlKewajiban);
	    $statusKewajiban = $ambilKewajiban->num_rows;

	    // pencarian data dengan tipe ekuitas & nama akun modal
	    $sqlEkuitasModal = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'ekuitas' AND nama_akun = 'modal' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilEkuitasModal = $conn->query($sqlEkuitasModal);
	    $pecahEkuitasModal = $ambilEkuitasModal->fetch_assoc();
	    $jmlKreditModal = $pecahEkuitasModal["SUM(kredit)"];

	    // pencarian data dengan tipe ekuitas & nama akun pengambilan prive
	    $sqlEkuitasPrive = "SELECT SUM(debet) FROM tbl_akun WHERE tipe_akun = 'ekuitas' AND nama_akun = 'pengambilan prive' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilEkuitasPrive = $conn->query($sqlEkuitasPrive);
	    $pecahEkuitasPrive = $ambilEkuitasPrive->fetch_assoc();
	    $jmlDebetPrive = $pecahEkuitasPrive["SUM(debet)"];

	    // jumlah ekuitas
	    $jmlEkuitas = $jmlKreditModal - $jmlDebetPrive;

    }

?>

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
                	<?php if($statusAktivaL > 0) { ?>
                  
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

                  	<?php } else { ?>

                  	<?php $jmlAktivaL = 0; ?>
                  	<tr>
                      	<td>Not found</td>
                      	<td>Rp. 0</td>
                      	<td>Rp. 0</td>
                  	</tr>
                  	<tr>
                      	<td colspan="2" class="text-center"><strong>Jumlah Aktiva Lancar</strong></td>
                      	<td><strong>Rp. 0</strong></td>
                  	</tr>

                  	<?php } ?>
                </tbody>

                <!-- bagian aktiva tetap -->
        		<thead>
                  	<tr>
                    	<th colspan="8">Aktiva Tetap</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php if($statusAktivaT > 0) { ?>
                  
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

	                <?php } else { ?>

	                <?php $jmlAktivaT = 0; ?>
	                <tr>
                      	<td>Not found</td>
                      	<td>Rp. 0</td>
                      	<td>Rp. 0</td>
                  	</tr>
                  	<tr>
                      	<td colspan="2" class="text-center"><strong>Jumlah Aktiva Tetap</strong></td>
                      	<td><strong>Rp. 0</strong></td>
                  	</tr>

	                <?php } ?>

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
                	<?php if($statusKewajiban > 0) { ?>
                  
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

                  	<?php } else { ?>

                  	<?php $jmlKewajiban = 0; ?>
                  	<tr>
                      	<td>Not found</td>
                      	<td>Rp. 0</td>
                      	<td></td>
                  	</tr>
                  	<tr>
                      	<td colspan="2" class="text-center"><strong>Jumlah Kewajiban</strong></td>
                      	<td><strong>Rp. 0</strong></td>
                  	</tr>

                  	<?php } ?>
                </tbody>

                <!-- bagian ekuitas -->
        		<thead>
                  	<tr>
                   		<th colspan="8">Ekuitas</th>
                  	</tr>
                </thead>
                <tbody>
                	<?php if($jmlEkuitas > 0 || $jmlEkuitas < 0) { ?>
                  
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

	                <?php } else { ?>

	                <tr>
                      	<td>Not found</td>
                      	<td>Rp. 0</td>
                      	<td></td>
                  	</tr>
                  	<tr>
                      	<td colspan="2" class="text-center"><strong>Jumlah Ekuitas</strong></td>
                      	<td><strong>Rp. 0</strong></td>
                  	</tr>

	                <?php } ?>

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