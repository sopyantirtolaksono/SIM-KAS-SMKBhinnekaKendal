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
      
      // pencarian data laporan pengeluaran
      $sqlLapPengeluaran = "SELECT * FROM tbl_pengeluaran WHERE tanggal_pengeluaran BETWEEN '$dateRange1' AND '$dateRange2' ";
      $ambilData = $conn->query($sqlLapPengeluaran);
      $status = $ambilData->num_rows;
      // lakukan perulangan data yg didapat
      while($pecahData = $ambilData->fetch_assoc()) {
        // masukkan data yg didapat pada variabel $semuaData[]
        $semuaData[] = $pecahData;
      }

      // mencari & menghitung semua total pengeluaran dari akun yg bernama "KAS"
      $totalKas = 0;
      $sqlTotalKas = "SELECT * FROM tbl_pengeluaran WHERE tanggal_pengeluaran BETWEEN '$dateRange1' AND '$dateRange2' AND nama_akun = 'kas' ";
      $ambilTotalKas = $conn->query($sqlTotalKas);
      while($pecahTotalKas = $ambilTotalKas->fetch_assoc()) {
        $totalKas += $pecahTotalKas["debet"];
      }

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
          $jmlDebet  = 0;
          $jmlKredit = 0;
          foreach($semuaData as $data => $value) :
            $jmlDebet  += $value["debet"];
            $jmlKredit += $value["kredit"];
        ?>
        <tr>
          <td><?=$data+1; ?></td>
          <td><?=$value["kode_transaksi"]; ?></td>
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
          <td colspan="5" class="text-right">
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
            <h6>Jumlah Pengeluaran(Rp):</h6>
          </td>
          <td colspan="2">
            <h6><?=number_format($totalKas); ?></h6>
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