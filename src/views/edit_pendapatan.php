<?php

  // cek siapa yang login
  if($pecahUser["jabatan"] !== "bendahara") {
    echo "<script>location ='index.php?halaman=dashboard';</script>";
      exit();
  }

  // ambil id pendapatan diURL
  $idPendapatan = $_GET["id"];

  // ambil data pendapatan pada tabel pendapatan sesuai id pendapatan yang dikirim
  $sqlPendapatan  = "SELECT * FROM tbl_pendapatan WHERE id_pendapatan = '$idPendapatan' ";
  $ambilPendapatan = $conn->query($sqlPendapatan);
  $pecahPendapatan = $ambilPendapatan->fetch_assoc();

  // ambil data akun dari tabel akun
  $sqlAkun = "SELECT * FROM tbl_akun ORDER BY id_akun DESC";
  $ambilAkun = $conn->query($sqlAkun);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Pendapatan</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Transaksi</li>
          <li class="breadcrumb-item active">Edit Pendapatan</li>
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
            <h3 class="card-title">Form Edit Pendapatan</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/edit_pendapatan.php" method="post" id="formEditPendapatan">
            <div class="card-body">

              <div class="row">

                <input type="hidden" name="id_pendapatan" value="<?=$pecahPendapatan['id_pendapatan']; ?>" required>

                <div class="col-md-12">
                  <div class="form-group">
                    <label for="kodeTransaksi">Kode Transaksi</label>
                    <input type="text" name="kode_transaksi" class="form-control" id="kodeTransaksi" placeholder="Kode Transaksi" value="<?=$pecahPendapatan['kode_transaksi']; ?>" required readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namaAkun">Nama Akun</label>
                        <select class="form-control select2 select2bs4" id="namaAkun" style="width: 100%;" name="nama_akun" required>
                            <option value="<?=$pecahPendapatan['kode_akun']; ?>">
                                <?=$pecahPendapatan["nama_akun"]; ?>
                            </option>
                            <?php while($pecahAkun = $ambilAkun->fetch_assoc()) { ?>
                            <option value="<?=$pecahAkun['kode_akun']; ?>">
                                <?=$pecahAkun["nama_akun"]; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?=$pecahPendapatan['tanggal_pendapatan']; ?>" required>
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="debet">Debet</label>
                        <input type="number" name="debet" class="form-control" id="debet" placeholder="Debet" value="<?=$pecahPendapatan['debet']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kredit">Kredit</label>
                        <input type="number" name="kredit" class="form-control" id="kredit" placeholder="Kredit" value="<?=$pecahPendapatan['kredit']; ?>">
                    </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea name="keterangan" class="form-control" id="keterangan" cols="30" rows="5" placeholder="Keterangan" required><?=$pecahPendapatan["keterangan"]; ?></textarea>
                  </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
              <a href="index.php?halaman=pendapatan" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
        <!-- /.card -->
        </div>
      <!--/.col (left) -->

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- JS File-->
<!-- Update Barang -->
<script src="src/dist/js/ajax/edit_pendapatan.js"></script>