<?php

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil semua data akun dari tabel akun
  $sqlDataAkun = "SELECT * FROM tbl_akun ORDER BY id_akun DESC";
  $ambilAkun   = $conn->query($sqlDataAkun);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Daftar Akun</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Akuntansi</li>
          <li class="breadcrumb-item active">Daftar Akun</li>
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

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Akun</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Tipe Akun</th>
                <th>Nama Akun</th>
                <th>Tanggal</th>
                <th>Debet(Rp)</th>
                <th>Kredit(Rp)</th>
              </tr>
              </thead>
              <tbody>

                <?php 
                  $jmlDebet  = 0;
                  $jmlKredit = 0;
                  $no = 1;
                  while($pecahAkun = $ambilAkun->fetch_assoc()) { 
                    $jmlDebet  += $pecahAkun["debet"];
                    $jmlKredit += $pecahAkun["kredit"];
                ?>
                <tr>
                    <td><?=$no; ?></td>
                    <td>
                      <a href="index.php?halaman=edit_akun&id=<?=$pecahAkun['id_akun']; ?>" class="btn btn-info btn-sm">Edit</a>
                      <a href="src/components/ajax/hapus_akun.php?id=<?=$pecahAkun['id_akun']; ?>" class="btn btn-danger btn-sm" id="btnHapusAkun">Hapus</a>
                    </td>
                    <td><?=$pecahAkun["tipe_akun"]; ?></td>
                    <td><?=$pecahAkun["nama_akun"]; ?></td>
                    <td><?=$pecahAkun["tanggal"]; ?></td>
                    <td><?=number_format($pecahAkun["debet"]); ?></td>
                    <td><?=number_format($pecahAkun["kredit"]); ?></td>
                </tr>
                <?php 
                  $no++;
                  } 
                ?>
              </tbody>

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
<!-- Daftar Akun -->
<script src="src/dist/js/ajax/daftar_akun.js"></script>