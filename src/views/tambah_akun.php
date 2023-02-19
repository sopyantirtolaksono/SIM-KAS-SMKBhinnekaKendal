<?php

  // cek siapa yang login
  if($pecahUser["jabatan"] !== "bendahara") {
    echo "<script>location ='index.php?halaman=dashboard';</script>";
      exit();
  }

  // setting auto increment pada field kode akun ditabel akun
  // $ambilMaxKode = $conn->query("SELECT max(kode_akun) as maxKode FROM tbl_akun");
  // $pecahMaxKode = $ambilMaxKode->fetch_assoc();
  // $maxKode = $pecahMaxKode["maxKode"];
  // lanjut menggabungkan char dan nomor menjadi kode akun yang benar.
  // $kodeUrut = (int) substr($maxKode, 2, 3);
  // $kodeUrut++;
  // $char = "KA";
  // $kodeJadi = $char . sprintf("%03s", $kodeUrut);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Akun</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Akuntansi</li>
          <li class="breadcrumb-item active">Tambah Akun</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- jquery validation -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Form Tambah Akun</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/tambah_akun.php" method="post" id="formTambahAkun">
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tipe Akun</label>
                    <select class="form-control select2 select2bs4" id="" name="tipe_akun" required>
                        <option value="aktiva lancar">Aktiva Lancar</option>
                        <option value="aktiva tetap">Aktiva Tetap</option>
                        <option value="kewajiban">Kewajiban</option>
                        <option value="ekuitas">Ekuitas</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="pendapatan lainnya">Pendapatan Lainnya</option>
                        <option value="biaya operasional">Biaya Operasional</option>
                        <option value="biaya lainnya">Biaya Lainnya</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Akun</label>
                    <input type="text" name="nama_akun" class="form-control" id="" placeholder="Nama Akun" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Debet</label>
                    <input type="number" name="debet" class="form-control" id="" placeholder="Debet">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kredit</label>
                    <input type="number" name="kredit" class="form-control" id="" placeholder="Kredit">
                  </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
              <a href="index.php?halaman=daftar_akun" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->
      <!-- right column -->
      
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- JS File-->
<!-- Tambah Barang -->
<script src="src/dist/js/ajax/tambah_akun.js"></script>
