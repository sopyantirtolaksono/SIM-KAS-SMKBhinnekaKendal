<?php

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

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Neraca</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Lap. Neraca</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <form action="" method="" id="formLapNeraca">
          <div class="row">
            <div class="col-3">
              <!-- Date range -->
              <!-- <div class="form-group">
                <label>Date range</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control" id="dateRange" name="date_range">
                </div> -->
                <!-- /.input group -->
              <!-- </div> -->
              <!-- /.form group -->
            </div>
            <div class="col-1">
              <!-- <div class="form-group">
                <label>&nbsp;</label>
                <div class="input-group">
                  <button type="submit" class="btn btn-primary" id="btnLihat">Lihat</button>
                </div>
              </div> -->
            </div>
            <div class="col-8">
              <div class="form-group float-right">
                <label>&nbsp;</label>
                <div class="input-group">
                  <a href="src/components/export_pages/excel_lap_neraca.php?val=" class="btn btn-success mb-3" target="_blank" id="btnDownloadExcel">Download Excel</a>
                  <a href="src/components/export_pages/print_lap_neraca.php?val=" class="btn btn-default mb-3" target="_blank" id="btnPrint">Print</a>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan Neraca</h3>
          </div>
          <!-- /.card-header -->

          <div id="loadData">
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
          </div>
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>