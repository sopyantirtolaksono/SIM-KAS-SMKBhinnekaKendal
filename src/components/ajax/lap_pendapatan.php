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

      // buat variabel baru dengan nilainya array kosong
      $semuaData = array();
      
      // pencarian data laporan pendapatan
      $sqlLapPendapatan = "SELECT * FROM tbl_pendapatan WHERE tanggal_pendapatan BETWEEN '$dateRange1' AND '$dateRange2' ";
      $ambilData = $conn->query($sqlLapPendapatan);
      $status = $ambilData->num_rows;
      // lakukan perulangan data yg didapat
      while($pecahData = $ambilData->fetch_assoc()) {
        // masukkan data yg didapat pada variabel $semuaData[]
        $semuaData[] = $pecahData;
      }

      // menghitung jumlah SPI kemudian menghitung total dari SPI & SPP
      $sqlSpi = "SELECT SUM(kredit) FROM tbl_pendapatan WHERE nama_akun = 'spi' AND tanggal_pendapatan BETWEEN '$dateRange1' AND '$dateRange2' ";
      $ambilSpi = $conn->query($sqlSpi);
      $pecahSpi = $ambilSpi->fetch_assoc();

      // menghitung jumlah SPP kemudian menghitung total dari SPI & SPP
      $sqlSpp = "SELECT SUM(kredit) FROM tbl_pendapatan WHERE nama_akun = 'spp' AND tanggal_pendapatan BETWEEN '$dateRange1' AND '$dateRange2' ";
      $ambilSpp = $conn->query($sqlSpp);
      $pecahSpp = $ambilSpp->fetch_assoc();

    }

?>

<div class="card-body table-responsive p-0">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode Transaksi</th>
          <th>Tanggal</th>
          <th>Nama Akun</th>
          <th>Keterangan</th>
          <th>Debet(Rp)</th>
          <th>Kredit(Rp)</th>
        </tr>
      </thead>

      <!-- cek statusnya, jika ada data dan tidak -->
      <?php if($status > 0) { ?>

      <tbody>

        <?php
          $total = 0;
          foreach($semuaData as $data => $value) :
        ?>
        <tr>
          <td><?=$data+1; ?></td>
          <td><?=$value["kode_transaksi"]; ?></td>
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
          <td colspan="6" class="text-right">
            <h6>Jumlah SPI(Rp):</h6>
          </td>
          <td>
            <h6><?=number_format($pecahSpi["SUM(kredit)"]); ?></h6>
          </td>
        </tr>
        <tr>
          <td colspan="6" class="text-right">
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
        
      <?php } else { ?>

      <tbody>
        <tr>
            <td colspan="8" class="text-center">No matching records found for <?=$dateRange; ?></td>
        </tr>
      </tbody>

      <?php } ?>

    </table>
</div>
<!-- /.card-body -->