<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil semua data pengeluaran dari tabel pengeluaran
  $sqlPengeluaran = "SELECT * FROM tbl_pengeluaran ORDER BY id_pengeluaran DESC";
  $ambilPengeluaran   = $conn->query($sqlPengeluaran);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Pengeluaran</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
          <li class="breadcrumb-item active">Pengeluaran</li>
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

        <div class="row">
          <div class="col-12 text-right">
            <a href="index.php?halaman=tambah_pengeluaran" class="btn btn-primary mb-3">Tambah Pengeluaran</a>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Pengeluaran</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Aksi</th>
                    <th>Kode Transaksi</th>
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
                      $no = 1;
                      while($pecahPengeluaran = $ambilPengeluaran->fetch_assoc()) { 
                        $jmlDebet  += $pecahPengeluaran["debet"];
                        $jmlKredit += $pecahPengeluaran["kredit"];
                    ?>
                    <tr>
                      <td><?=$no; ?></td>
                      <td>
                      <!-- <a href="index.php?halaman=edit_pengeluaran&id=<?//=$pecahPengeluaran['id_pengeluaran']; ?>" class="btn btn-info btn-sm">Edit</a> -->
                      <a href="src/components/ajax/hapus_pengeluaran.php?id=<?=$pecahPengeluaran['id_pengeluaran']; ?>" class="btn btn-danger btn-sm" id="btnHapusPengeluaran">Hapus</a>
                      </td>
                      <td><?=$pecahPengeluaran["kode_transaksi"]; ?></td>
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

                </tbody>
                
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
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>

<!-- JS File-->
<!-- Data Pendapatan -->
<script src="src/dist/js/ajax/pengeluaran.js"></script>