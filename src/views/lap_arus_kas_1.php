<?php

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
    // $sqlPiutangUsaha = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'piutang usaha' ";
    // $ambilPiutangUsaha = $conn->query($sqlPiutangUsaha);
    // $pecahPiutangUsaha = $ambilPiutangUsaha->fetch_assoc();
    // $jmlPiutangUsaha = $pecahPiutangUsaha["SUM(debet)"];

    // perlengkapan kantor
    $sqlPerlengkapanKantor = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'perlengkapan kantor' ";
    $ambilPerlengkapanKantor = $conn->query($sqlPerlengkapanKantor);
    $pecahPerlengkapanKantor = $ambilPerlengkapanKantor->fetch_assoc();
    $jmlPerlengkapanKantor = $pecahPerlengkapanKantor["SUM(debet)"];

    // asuransi dibayar dimuka
    // $sqlAsuransiBayarMuka = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'asuransi dibayar dimuka' ";
    // $ambilAsuransiBayarMuka = $conn->query($sqlAsuransiBayarMuka);
    // $pecahAsuransiBayarMuka = $ambilAsuransiBayarMuka->fetch_assoc();
    // $jmlAsuransiBayarMuka = $pecahAsuransiBayarMuka["SUM(debet)"];

    // hutang usaha
    $sqlHutangUsaha = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'hutang usaha' ";
    $ambilHutangUsaha = $conn->query($sqlHutangUsaha);
    $pecahHutangUsaha = $ambilHutangUsaha->fetch_assoc();
    $jmlHutangUsaha = $pecahHutangUsaha["SUM(kredit)"];

    // total arus kas bersih dari kegiatan operasional
    // $totArusKasBersihKegOperasional = $labaAtauRugiBersihUsaha - $jmlPiutangUsaha - $jmlPerlengkapanKantor - $jmlAsuransiBayarMuka + $jmlHutangUsaha;
    $totArusKasBersihKegOperasional = $labaAtauRugiBersihUsaha - $jmlPerlengkapanKantor + $jmlHutangUsaha;


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
    // $sqlGedung = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'gedung' ";
    // $ambilGedung = $conn->query($sqlGedung);
    // $pecahGedung = $ambilGedung->fetch_assoc();
    // $jmlGedung = $pecahGedung["SUM(debet)"];

    // akumulasi penyusutan gedung
    // $sqlAkumulasiPg = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'akumulasi penyusutan gedung' ";
    // $ambilAkumulasiPg = $conn->query($sqlAkumulasiPg);
    // $pecahAkumulasiPg = $ambilAkumulasiPg->fetch_assoc();
    // $jmlAkumulasiPg = $pecahAkumulasiPg["SUM(kredit)"];

    // kendaraan
    // $sqlKendaraan = "SELECT SUM(debet) FROM tbl_akun WHERE nama_akun = 'kendaraan' ";
    // $ambilKendaraan = $conn->query($sqlKendaraan);
    // $pecahKendaraan = $ambilKendaraan->fetch_assoc();
    // $jmlKendaraan = $pecahKendaraan["SUM(debet)"];

    // akumulasi penyusutan kendaraan
    // $sqlAkumulasiPk = "SELECT SUM(kredit) FROM tbl_akun WHERE nama_akun = 'akumulasi penyusutan kendaraan' ";
    // $ambilAkumulasiPk = $conn->query($sqlAkumulasiPk);
    // $pecahAkumulasiPk = $ambilAkumulasiPk->fetch_assoc();
    // $jmlAkumulasiPk = $pecahAkumulasiPk["SUM(kredit)"];

    // total arus kas bersih dari kegiatan investasi
    // $totArusKasBersihKegInvestasi = $jmlPeralatan + $jmlAkumulasiPp - $jmlGedung + $jmlAkumulasiPg - $jmlKendaraan + $jmlAkumulasiPk;
    $totArusKasBersihKegInvestasi = $jmlPeralatan + $jmlAkumulasiPp;


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

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Arus Kas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Laporan</li>
          <li class="breadcrumb-item active">Lap. Arus Kas</li>
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

        <form action="" method="" id="formLapArusKas">
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
                  <a href="src/components/export_pages/excel_lap_arus_kas.php" class="btn btn-success mb-3" target="_blank" id="btnDownloadExcel">Download Excel</a>
                  <a href="src/components/export_pages/print_lap_arus_kas.php" class="btn btn-default mb-3" target="_blank" id="btnPrint">Print</a>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Laporan Arus Kas</h3>
          </div>
          <!-- /.card-header -->

          <div id="loadData">
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
                  <!-- <tr>
                      <td>Piutang Usaha</td>
                      <td>Rp. <?//=number_format($jmlPiutangUsaha); ?></td>
                      <td></td>
                  </tr> -->
                  <tr>
                      <td>Perlengkapan Kantor</td>
                      <td>Rp. <?=number_format($jmlPerlengkapanKantor); ?></td>
                      <td></td>
                  </tr>
                  <!-- <tr>
                      <td>Asuransi Dibayar Dimuka</td>
                      <td>Rp. <?//=number_format($jmlAsuransiBayarMuka); ?></td>
                      <td></td>
                  </tr> -->
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
                  <!-- <tr>
                      <td>Gedung</td>
                      <td>Rp. <?//=number_format($jmlGedung); ?></td>
                      <td></td>
                  </tr> -->
                  <!-- <tr>
                      <td>Akumulasi Penyusutan Gedung</td>
                      <td>Rp. <?//=number_format($jmlAkumulasiPg); ?></td>
                      <td></td>
                  </tr> -->
                  <!-- <tr>
                      <td>Kendaraan </td>
                      <td>Rp. <?//=number_format($jmlKendaraan); ?></td>
                      <td></td>
                  </tr> -->
                  <!-- <tr>
                      <td>Akumulasi Penyusutan Kendaraan </td>
                      <td>Rp. <?//=number_format($jmlAkumulasiPk); ?></td>
                      <td></td>
                  </tr> -->

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
          </div>
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>