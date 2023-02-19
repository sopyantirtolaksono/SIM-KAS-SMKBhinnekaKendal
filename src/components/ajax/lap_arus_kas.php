<?php

	// hilangkan notice & warning
	error_reporting(0);

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


		// ARUS KAS DARI KEGIATAN OPERASIONAL

	    // pencarian data dengan tipe pendapatan
	    // menghitung jumlah SPI kemudian menghitung total dari SPI & SPP
	    $sqlSpi = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan' AND nama_akun = 'spi' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilSpi = $conn->query($sqlSpi);
	    $pecahSpi = $ambilSpi->fetch_assoc();
	    // menghitung jumlah SPP kemudian menghitung total dari SPI & SPP
	    $sqlSpp = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan' AND nama_akun = 'spp' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilSpp = $conn->query($sqlSpp);
	    $pecahSpp = $ambilSpp->fetch_assoc();
	    // total spi dan spp
	    $totalSpiDanSpp = $pecahSpi["SUM(kredit)"] + $pecahSpp["SUM(kredit)"];

	    // pencarian data dengan tipe biaya operasional
	    $sqlBiayaO = "SELECT SUM(debet) FROM tbl_akun WHERE tipe_akun = 'biaya operasional' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilBiayaO = $conn->query($sqlBiayaO);
	    $pecahBiayaO = $ambilBiayaO->fetch_assoc();
	    $totalBiayaO = $pecahBiayaO["SUM(debet)"];

	    // pencarian data dengan tipe pendapatan lainnya
	    $sqlPendapatanL = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan lainnya' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilPendapatanL = $conn->query($sqlPendapatanL);
	    $pecahPendapatanL = $ambilPendapatanL->fetch_assoc();
	    $totalPendapatanL = $pecahPendapatanL["SUM(kredit)"];

	    // pencarian data dengan tipe biaya lainnya
	    $sqlBiayaL = "SELECT SUM(debet) FROM tbl_akun WHERE tipe_akun = 'biaya lainnya' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilBiayaL = $conn->query($sqlBiayaL);
	    $pecahBiayaL = $ambilBiayaL->fetch_assoc();
	    $totalBiayaL = $pecahBiayaL["SUM(debet)"];

	    // laba/rugi bersih usaha
	    $labaAtauRugiBersihUsaha = $totalSpiDanSpp - $totalBiayaO + $totalPendapatanL - $totalBiayaL;

	    // perlengkapan kantor
	    $sqlPerlengkapanKantor = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'perlengkapan kantor' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilPerlengkapanKantor = $conn->query($sqlPerlengkapanKantor);
	    $pecahPerlengkapanKantor = $ambilPerlengkapanKantor->fetch_assoc();
	    $jmlPerlengkapanKantor = $pecahPerlengkapanKantor["SUM(debet)"];

	    // hutang usaha
	    $sqlHutangUsaha = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'hutang usaha' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilHutangUsaha = $conn->query($sqlHutangUsaha);
	    $pecahHutangUsaha = $ambilHutangUsaha->fetch_assoc();
	    $jmlHutangUsaha = $pecahHutangUsaha["SUM(kredit)"];

	    // total arus kas bersih dari kegiatan operasional
	    $totArusKasBersihKegOperasional = $labaAtauRugiBersihUsaha - $jmlPerlengkapanKantor + $jmlHutangUsaha;


	    // ARUS KAS DARI KEGIATAN INVESTASI

	    // peralatan
	    $sqlPeralatan = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'peralatan' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilPeralatan = $conn->query($sqlPeralatan);
	    $pecahPeralatan = $ambilPeralatan->fetch_assoc();
	    $jmlPeralatan = $pecahPeralatan["SUM(debet)"];

	    // akumulasi penyusutan peralatan
	    $sqlAkumulasiPp = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'akumulasi penyusutan peralatan' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilAkumulasiPp = $conn->query($sqlAkumulasiPp);
	    $pecahAkumulasiPp = $ambilAkumulasiPp->fetch_assoc();
	    $jmlAkumulasiPp = $pecahAkumulasiPp["SUM(kredit)"];

	    // total arus kas bersih dari kegiatan investasi
	    $totArusKasBersihKegInvestasi = $jmlPeralatan + $jmlAkumulasiPp;


	    // ARUS KAS DARI KEGIATAN PENDANAAN

	    // modal
	    $sqlModal = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'modal' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilModal = $conn->query($sqlModal);
	    $pecahModal = $ambilModal->fetch_assoc();
	    $jmlModal = $pecahModal["SUM(kredit)"];

	    // pengambilan prive
	    $sqlPengambilanPrive = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'pengambilan prive' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilPengambilanPrive = $conn->query($sqlPengambilanPrive);
	    $pecahPengambilanPrive = $ambilPengambilanPrive->fetch_assoc();
	    $jmlPengambilanPrive = $pecahPengambilanPrive["SUM(debet)"];

	    // total arus kas bersih dari kegiatan pendanaan
	    $totArusKasBersihKegPendanaan = $jmlModal + $jmlPengambilanPrive;


	    // MENGHITUNG BANYAKNYA KEMUNGKINAN YANG TERJADI PADA KENAIKAN/PENURUNAN KAS BERSIH PADA LAP. ARUS KAS
	    if($totArusKasBersihKegOperasional > 0 && $totArusKasBersihKegInvestasi > 0 && $totArusKasBersihKegPendanaan > 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional > 0 && $totArusKasBersihKegInvestasi > 0 && $totArusKasBersihKegPendanaan < 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional > 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan < 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi > 0 && $totArusKasBersihKegPendanaan > 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan > 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan < 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional > 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan > 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi > 0 && $totArusKasBersihKegPendanaan < 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional > 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan == 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi > 0 && $totArusKasBersihKegPendanaan == 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional > 0 && $totArusKasBersihKegInvestasi == 0 && $totArusKasBersihKegPendanaan < 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi == 0 && $totArusKasBersihKegPendanaan > 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional == 0 && $totArusKasBersihKegInvestasi > 0 && $totArusKasBersihKegPendanaan < 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional == 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan > 0) {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }
	    else if($totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan == 0 || $totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi == 0 && $totArusKasBersihKegPendanaan == 0 || $totArusKasBersihKegOperasional == 0 && $totArusKasBersihKegInvestasi == 0 && $totArusKasBersihKegPendanaan == 0 || $totArusKasBersihKegOperasional == 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan < 0 || $totArusKasBersihKegOperasional == 0 && $totArusKasBersihKegInvestasi == 0 && $totArusKasBersihKegPendanaan < 0 || $totArusKasBersihKegOperasional < 0 && $totArusKasBersihKegInvestasi == 0 && $totArusKasBersihKegPendanaan < 0 || $totArusKasBersihKegOperasional == 0 && $totArusKasBersihKegInvestasi < 0 && $totArusKasBersihKegPendanaan == 0) {

	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional - $totArusKasBersihKegInvestasi - $totArusKasBersihKegPendanaan;
	    }
	    else {
	      $totNaikAtauTurunKasBersih = $totArusKasBersihKegOperasional + $totArusKasBersihKegInvestasi + $totArusKasBersihKegPendanaan;
	    }


	    // KAS & SETARA KAS AWAL PERIODE
	    $sqlKasSetaraKasAwal = "SELECT debet_awal FROM tbl_akun WHERE nama_akun = 'kas' AND tanggal BETWEEN '$dateRange1' AND '$dateRange2' ";
	    $ambilKasSetaraKasAwal = $conn->query($sqlKasSetaraKasAwal);
	    $pecahKasSetaraKasAwal = $ambilKasSetaraKasAwal->fetch_assoc();
	    $kasSetaraKasAwal = $pecahKasSetaraKasAwal["debet_awal"];


	    // KAS & SETARA KAS AKHIR PERIODE
	    $kasSetaraKasAkhir = intval($totNaikAtauTurunKasBersih) + intval($kasSetaraKasAwal);     	
  	}

?>

<div class="card-body table-responsive p-0">
  <table id="example1" class="table table-bordered table-striped">

    <!-- Arus Kas dari Kegiatan Operasional -->
    <thead>
      <tr>
        <th colspan="8">Arus Kas dari Kegiatan Operasional</th>
      </tr>
    </thead>
    <tbody>
    	<?php if($totArusKasBersihKegOperasional > 0 || $totArusKasBersihKegOperasional < 0) { ?>

      	<tr>
          	<td>Pendapatan Bersih</td>
          	<td>Rp. <?=number_format($labaAtauRugiBersihUsaha); ?></td>
          	<td></td>
      	</tr>
      	<tr>
          	<td>Perlengkapan Kantor</td>
          	<td>Rp. <?=number_format($jmlPerlengkapanKantor); ?></td>
          	<td></td>
      	</tr>
      	<tr>
          	<td>Hutang Usaha</td>
          	<td>Rp. <?=number_format($jmlHutangUsaha); ?></td>
          	<td></td>
      	</tr>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Operasional</strong></td>
          	<td><strong>Rp. <?=number_format($totArusKasBersihKegOperasional); ?></strong></td>
      	</tr>

  		<?php } else { ?>

  		<tr>
          	<td>Not found</td>
          	<td>Rp. 0</td>
          	<td></td>
      	</tr>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Operasional</strong></td>
          	<td><strong>Rp. 0</strong></td>
      	</tr>

  		<?php } ?>
    </tbody>

    <!-- Arus Kas dari Kegiatan Investasi -->
    <thead>
      <tr>
        <th colspan="8">Arus Kas dari Kegiatan Investasi</th>
      </tr>
    </thead>
    <tbody>
    	<?php if($totArusKasBersihKegInvestasi > 0 || $totArusKasBersihKegInvestasi < 0) { ?>

      	<tr>
          	<td>Peralatan </td>
          	<td>Rp. <?=number_format($jmlPeralatan); ?></td>
          	<td></td>
      	</tr>
      	<tr>
          	<td>Akumulasi Penyusutan Peralatan</td>
          	<td>Rp. <?=number_format($jmlAkumulasiPp); ?></td>
          	<td></td>
      	</tr>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Investasi</strong></td>
          	<td><strong>Rp. <?=number_format($totArusKasBersihKegInvestasi); ?></strong></td>
      	</tr>

  		<?php } else { ?>

  		<tr>
          	<td>Not found</td>
          	<td>Rp. 0</td>
          	<td></td>
      	</tr>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Investasi</strong></td>
          	<td><strong>Rp. 0</strong></td>
      	</tr>

  		<?php } ?>
    </tbody>

    <!-- Arus Kas dari Kegiatan Pendanaan -->
    <thead>
      <tr>
        <th colspan="8">Arus Kas dari Kegiatan Pendanaan</th>
      </tr>
    </thead>
    <tbody>
    	<?php if($totArusKasBersihKegPendanaan > 0 || $totArusKasBersihKegPendanaan < 0) { ?>

      	<tr>
          	<td>Modal </td>
          	<td>Rp. <?=number_format($jmlModal); ?></td>
          	<td></td>
      	</tr>
      	<tr>
          	<td>Pengambilan Prive </td>
          	<td>Rp. <?=number_format($jmlPengambilanPrive); ?></td>
          	<td></td>
      	</tr>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Pendanaan</td>
          	<td><strong>Rp. <?=number_format($totArusKasBersihKegPendanaan); ?></strong></td>
      	</tr>

  		<?php } else { ?>

  		<tr>
          	<td>Not found</td>
          	<td>Rp. 0</td>
          	<td></td>
      	</tr>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Pendanaan</td>
          	<td><strong>Rp. 0</strong></td>
      	</tr>

  		<?php } ?>

      	<tr>
          	<td colspan="2" class="text-center"><strong>Kenaikan/Penurunan Kas Bersih</strong></td>
          	<td><strong>Rp. <?=number_format($totNaikAtauTurunKasBersih); ?></strong></td>
      	</tr>
      	<tr>
          	<td colspan="2" class="text-center"><strong>Kas dan Setara Kas Awal Periode</strong></td>
          	<td><strong>Rp. <?=number_format($kasSetaraKasAwal); ?></strong></td>
      	</tr>
      	<tr>
          	<td colspan="2" class="text-center"><strong>Kas dan Setara Kas Akhir Periode</strong></td>
          	<td><strong>Rp. <?=number_format($kasSetaraKasAkhir); ?></strong></td>
      	</tr>
    </tbody>

  </table>
</div>
<!-- /.card-body -->