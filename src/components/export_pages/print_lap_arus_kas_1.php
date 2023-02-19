<?php

  // koneksi ke database
	require "../../connection/koneksi_database.php";

	// ARUS KAS DARI KEGIATAN OPERASIONAL

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
  $sqlBiayaO = "SELECT SUM(debet) FROM tbl_akun WHERE tipe_akun = 'biaya operasional' ";
  $ambilBiayaO = $conn->query($sqlBiayaO);
  $pecahBiayaO = $ambilBiayaO->fetch_assoc();
  $totalBiayaO = $pecahBiayaO["SUM(debet)"];

  // pencarian data dengan tipe pendapatan lainnya
  $sqlPendapatanL = "SELECT SUM(kredit) FROM tbl_akun WHERE tipe_akun = 'pendapatan lainnya' ";
  $ambilPendapatanL = $conn->query($sqlPendapatanL);
  $pecahPendapatanL = $ambilPendapatanL->fetch_assoc();
  $totalPendapatanL = $pecahPendapatanL["SUM(kredit)"];

  // pencarian data dengan tipe biaya lainnya
  $sqlBiayaL = "SELECT SUM(debet) FROM tbl_akun WHERE tipe_akun = 'biaya lainnya' ";
  $ambilBiayaL = $conn->query($sqlBiayaL);
  $pecahBiayaL = $ambilBiayaL->fetch_assoc();
  $totalBiayaL = $pecahBiayaL["SUM(debet)"];

  // laba/rugi bersih usaha
  $labaAtauRugiBersihUsaha = $totalSpiDanSpp - $totalBiayaO + $totalPendapatanL - $totalBiayaL;

  // piutang usaha
  $sqlPiutangUsaha = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'piutang usaha' ";
  $ambilPiutangUsaha = $conn->query($sqlPiutangUsaha);
  $pecahPiutangUsaha = $ambilPiutangUsaha->fetch_assoc();
  $jmlPiutangUsaha = $pecahPiutangUsaha["SUM(debet)"];

  // perlengkapan kantor
  $sqlPerlengkapanKantor = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'perlengkapan kantor' ";
  $ambilPerlengkapanKantor = $conn->query($sqlPerlengkapanKantor);
  $pecahPerlengkapanKantor = $ambilPerlengkapanKantor->fetch_assoc();
  $jmlPerlengkapanKantor = $pecahPerlengkapanKantor["SUM(debet)"];

  // asuransi dibayar dimuka
  $sqlAsuransiBayarMuka = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'asuransi dibayar dimuka' ";
  $ambilAsuransiBayarMuka = $conn->query($sqlAsuransiBayarMuka);
  $pecahAsuransiBayarMuka = $ambilAsuransiBayarMuka->fetch_assoc();
  $jmlAsuransiBayarMuka = $pecahAsuransiBayarMuka["SUM(debet)"];

  // hutang usaha
  $sqlHutangUsaha = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'hutang usaha' ";
  $ambilHutangUsaha = $conn->query($sqlHutangUsaha);
  $pecahHutangUsaha = $ambilHutangUsaha->fetch_assoc();
  $jmlHutangUsaha = $pecahHutangUsaha["SUM(kredit)"];

  // total arus kas bersih dari kegiatan operasional
  $totArusKasBersihKegOperasional = $labaAtauRugiBersihUsaha - $jmlPiutangUsaha - $jmlPerlengkapanKantor - $jmlAsuransiBayarMuka + $jmlHutangUsaha;


  // ARUS KAS DARI KEGIATAN INVESTASI

  // peralatan
  $sqlPeralatan = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'peralatan' ";
  $ambilPeralatan = $conn->query($sqlPeralatan);
  $pecahPeralatan = $ambilPeralatan->fetch_assoc();
  $jmlPeralatan = $pecahPeralatan["SUM(debet)"];

  // akumulasi penyusutan peralatan
  $sqlAkumulasiPp = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'akumulasi penyusutan peralatan' ";
  $ambilAkumulasiPp = $conn->query($sqlAkumulasiPp);
  $pecahAkumulasiPp = $ambilAkumulasiPp->fetch_assoc();
  $jmlAkumulasiPp = $pecahAkumulasiPp["SUM(kredit)"];

  // gedung
  $sqlGedung = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'gedung' ";
  $ambilGedung = $conn->query($sqlGedung);
  $pecahGedung = $ambilGedung->fetch_assoc();
  $jmlGedung = $pecahGedung["SUM(debet)"];

  // akumulasi penyusutan gedung
  $sqlAkumulasiPg = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'akumulasi penyusutan gedung' ";
  $ambilAkumulasiPg = $conn->query($sqlAkumulasiPg);
  $pecahAkumulasiPg = $ambilAkumulasiPg->fetch_assoc();
  $jmlAkumulasiPg = $pecahAkumulasiPg["SUM(kredit)"];

  // kendaraan
  $sqlKendaraan = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'kendaraan' ";
  $ambilKendaraan = $conn->query($sqlKendaraan);
  $pecahKendaraan = $ambilKendaraan->fetch_assoc();
  $jmlKendaraan = $pecahKendaraan["SUM(debet)"];

  // akumulasi penyusutan kendaraan
  $sqlAkumulasiPk = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'akumulasi penyusutan kendaraan' ";
  $ambilAkumulasiPk = $conn->query($sqlAkumulasiPk);
  $pecahAkumulasiPk = $ambilAkumulasiPk->fetch_assoc();
  $jmlAkumulasiPk = $pecahAkumulasiPk["SUM(kredit)"];

  // total arus kas bersih dari kegiatan investasi
  $totArusKasBersihKegInvestasi = $jmlPeralatan + $jmlAkumulasiPp - $jmlGedung + $jmlAkumulasiPg - $jmlKendaraan + $jmlAkumulasiPk;


  // ARUS KAS DARI KEGIATAN PENDANAAN

  // modal
  $sqlModal = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'modal' ";
  $ambilModal = $conn->query($sqlModal);
  $pecahModal = $ambilModal->fetch_assoc();
  $jmlModal = $pecahModal["SUM(kredit)"];

  // pengambilan prive
  $sqlPengambilanPrive = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'pengambilan prive' ";
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
  $sqlKasSetaraKasAwal = "SELECT debet_awal FROM tbl_akun WHERE nama_akun = 'kas' ";
  $ambilKasSetaraKasAwal = $conn->query($sqlKasSetaraKasAwal);
  $pecahKasSetaraKasAwal = $ambilKasSetaraKasAwal->fetch_assoc();
  $kasSetaraKasAwal = $pecahKasSetaraKasAwal["debet_awal"];


  // KAS & SETARA KAS AKHIR PERIODE
  $kasSetaraKasAkhir = intval($totNaikAtauTurunKasBersih) + intval($kasSetaraKasAwal);

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
			<h3>LAPORAN ARUS KAS <br>KAS SMK BHINNEKA KENDAL</h3>
			<p class="m-0">Jl. Raya Soekarno - Hatta KM. 5, Jambearum, Patebon, Jambe Kidul, Jambearum, Kec. Patebon, <br>Kabupaten Kendal, Jawa Tengah 51351</p>
		</div>
	</div>

	<hr style="border: 1px solid #000; margin: 1px 1px 16px 1px;">
	
	<div class="card-body table-responsive p-0">
    <table id="example1" class="table table-bordered table-striped">

      <!-- Arus Kas dari Kegiatan Operasional -->
      <thead>
        <tr>
          <th colspan="8">Arus Kas dari Kegiatan Operasional</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>Pendapatan Bersih</td>
            <td>Rp. <?=number_format($labaAtauRugiBersihUsaha); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Piutang Usaha</td>
            <td>Rp. <?=number_format($jmlPiutangUsaha); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Perlengkapan Kantor</td>
            <td>Rp. <?=number_format($jmlPerlengkapanKantor); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Asuransi Dibayar Dimuka</td>
            <td>Rp. <?=number_format($jmlAsuransiBayarMuka); ?></td>
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
      </tbody>

      <!-- Arus Kas dari Kegiatan Investasi -->
      <thead>
        <tr>
          <th colspan="8">Arus Kas dari Kegiatan Investasi</th>
        </tr>
      </thead>
      <tbody>
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
            <td>Gedung</td>
            <td>Rp. <?=number_format($jmlGedung); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Akumulasi Penyusutan Gedung</td>
            <td>Rp. <?=number_format($jmlAkumulasiPg); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Kendaraan </td>
            <td>Rp. <?=number_format($jmlKendaraan); ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Akumulasi Penyusutan Kendaraan </td>
            <td>Rp. <?=number_format($jmlAkumulasiPk); ?></td>
            <td></td>
        </tr>

        <tr>
            <td colspan="2" class="text-center"><strong>Total Arus Kas Bersih dari Kegiatan Investasi</strong></td>
            <td><strong>Rp. <?=number_format($totArusKasBersihKegInvestasi); ?></strong></td>
        </tr>
      </tbody>

      <!-- Arus Kas dari Kegiatan Pendanaan -->
      <thead>
        <tr>
          <th colspan="8">Arus Kas dari Kegiatan Pendanaan</th>
        </tr>
      </thead>
      <tbody>
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


<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>