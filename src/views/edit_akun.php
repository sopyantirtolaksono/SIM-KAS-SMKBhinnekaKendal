<?php

  // cek siapa yang login
  if($pecahUser["jabatan"] !== "bendahara") {
    echo "<script>location ='index.php?halaman=dashboard';</script>";
      exit();
  }

  // ambil id akun diURL
  $idAkun = $_GET["id"];

  // ambil data akun pada tabel akun sesuai id akun yang dikirim
  $sqlDataAkun  = "SELECT * FROM tbl_akun WHERE id_akun = '$idAkun' ";
  $ambilAkun = $conn->query($sqlDataAkun);
  $pecahAkun = $ambilAkun->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Akun</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">Akuntansi</li>
          <li class="breadcrumb-item active">Edit Akun</li>
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
            <h3 class="card-title">Form Edit Akun</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/edit_akun.php" method="post" id="formEditAkun">
            <div class="card-body">

              <div class="row">

                <input type="hidden" name="id_akun" value="<?=$pecahAkun['id_akun']; ?>" required>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Tipe Akun</label>
                    <select class="form-control select2 select2bs4" id="" name="tipe_akun" required>
                        <option selected value="<?=$pecahAkun['tipe_akun']; ?>">
                          <?=$pecahAkun["tipe_akun"]; ?>
                        </option>
                        <option value="aktiva lancar">Aktiva Lancar</option>
                        <option value="aktiva tetap">Aktiva Tetap</option>
                        <option value="kewajiban">Kewajiban</option>
                        <option value="modal">Modal</option>
                        <option value="pendapatan">Pendapatan</option>
                        <option value="biaya">Biaya</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Nama Akun</label>
                    <input type="text" name="nama_akun" class="form-control" id="" value="<?=$pecahAkun['nama_akun']; ?>" placeholder="Nama Akun" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Debet</label>
                    <input type="number" name="debet" class="form-control" id="" value="<?=$pecahAkun['debet']; ?>" placeholder="Debet">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Kredit</label>
                    <input type="number" name="kredit" class="form-control" id="" value="<?=$pecahAkun['kredit']; ?>" placeholder="Kredit">
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

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<!-- JS File-->
<!-- Update Barang -->
<script src="src/dist/js/ajax/edit_akun.js"></script>