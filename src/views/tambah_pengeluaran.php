<?php

  // cek siapa yang login
  if($pecahUser["jabatan"] !== "bendahara") {
    echo "<script>location ='index.php?halaman=dashboard';</script>";
      exit();
  }

  // ambil data akun dari tabel akun
  $sqlAkun = "SELECT * FROM tbl_akun ORDER BY id_akun DESC";
  $ambilAkun = $conn->query($sqlAkun);

  // buat kode transaksi pengeluaran
  $sqlKodeTransaksi = "SELECT max(right(kode_transaksi, 4)) AS kode_transaksi FROM tbl_pengeluaran";
  $q = $conn->query($sqlKodeTransaksi);

  if($q->num_rows > 0) {
    foreach ($q as $qq) {
      $no = ((int)$qq["kode_transaksi"]) + 1;
      $kd = sprintf("%04s", $no);
    }
  }
  else {
    $kd = "0000";
  }

  $huruf = "KTK";
  $kode = $huruf . $kd;

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah Pengeluaran</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
          <li class="breadcrumb-item active">Tambah Pengeluaran</li>
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
            <h3 class="card-title">Form Tambah Pengeluaran</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/tambah_pengeluaran.php" method="post" id="formTambahPengeluaran">
            <div class="card-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kodeTransaksi">Kode Transaksi</label>
                    <input type="text" name="kode_transaksi" class="form-control" id="kodeTransaksi" placeholder="Kode Transaksi" value="<?=$kode; ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namaAkun">Nama Akun</label>
                        <select class="form-control select2 select2bs4" id="namaAkun" style="width: 100%;" name="nama_akun" required>
                            <?php while($pecahAkun = $ambilAkun->fetch_assoc()) { ?>
                            <option value="<?=$pecahAkun['id_akun']; ?>">
                                <?=$pecahAkun["nama_akun"]; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Date</label>
                        <div class="input-group date" id="tanggal" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" data-target="#tanggal" name="tanggal" required />
                            <div class="input-group-append" data-target="#tanggal" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.form group -->
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="debet">Debet</label>
                        <input type="number" name="debet" class="form-control" id="debet" placeholder="Debet">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kredit">Kredit</label>
                        <input type="number" name="kredit" class="form-control" id="kredit" placeholder="Kredit">
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="5" placeholder="Keterangan" required></textarea>
                  </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
              <a href="index.php?halaman=pengeluaran" class="btn btn-secondary" id="btnBatalDanSelesai">Batal</a>
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
<script src="src/dist/js/ajax/tambah_pengeluaran.js"></script>
