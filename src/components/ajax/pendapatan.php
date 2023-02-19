<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil semua data pendapatan dari tabel pendapatan
  $sqlPendapatan = "SELECT * FROM tbl_pendapatan ORDER BY id_pendapatan DESC";
  $ambilPendapatan   = $conn->query($sqlPendapatan);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Pendapatan</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
          <li class="breadcrumb-item active">Pendapatan</li>
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
            <a href="index.php?halaman=tambah_pendapatan" class="btn btn-primary mb-3">Tambah Pendapatan</a>
          </div>
        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Pendapatan</h3>
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
                      while($pecahPendapatan = $ambilPendapatan->fetch_assoc()) { 
                        $jmlDebet  += $pecahPendapatan["debet"];
                        $jmlKredit += $pecahPendapatan["kredit"];
                    ?>
                    <tr>
                        <td><?=$no; ?></td>
                        <td>
                        <!-- <a href="index.php?halaman=edit_pendapatan&id=<?//=$pecahPendapatan['id_pendapatan']; ?>" class="btn btn-info btn-sm">Edit</a> -->
                        <a href="src/components/ajax/hapus_pendapatan.php?id=<?=$pecahPendapatan['id_pendapatan']; ?>" class="btn btn-danger btn-sm" id="btnHapusPendapatan">Hapus</a>
                        </td>
                        <td><?=$pecahPendapatan["kode_transaksi"]; ?></td>
                        <td><?=$pecahPendapatan["tanggal_pendapatan"]; ?></td>
                        <td><?=$pecahPendapatan["nama_akun"]; ?></td>
                        <td><?=$pecahPendapatan["keterangan"]; ?></td>
                        <td><?=number_format($pecahPendapatan["debet"]); ?></td>
                        <td><?=number_format($pecahPendapatan["kredit"]); ?></td>
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
<script src="src/dist/js/ajax/pendapatan.js"></script>