<?php

  // cek siapa yang login
  if($pecahUser["jabatan"] !== "pimpinan") {
    echo "<script>location ='index.php?halaman=dashboard';</script>";
      exit();
  }

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Tambah User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item active">User</li>
          <li class="breadcrumb-item active">Tambah User</li>
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
            <h3 class="card-title">Form Tambah User</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="src/components/ajax/tambah_user.php" method="post" id="formTambahUser">
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" placeholder="Nama Lengkap" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="@username" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jenisKelamin">Jenis Kelamin</label>
                    <select class="form-control select2 select2bs4" id="jenisKelamin" name="jenis_kelamin" required>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <select class="form-control select2 select2bs4" id="jabatan" name="jabatan" required>
                        <option value="pimpinan">Pimpinan</option>
                        <option value="kepala sekolah">Kepala Sekolah</option>
                        <option value="bendahara">Bendahara</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="konfirmasiPassword">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="konfirmasiPassword" name="konfirmasi_password" placeholder="Konfirmasi Password" onkeyup="confirmPassword()" required>
                    <div class="invalid-feedback">
                      * Password tidak sama!
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                    <div class="icheck-primary">
                        <input type="checkbox" id="lihatPassword" onclick="showHide()">
                        <label for="lihatPassword">
                            Lihat Password
                        </label>
                    </div>
                </div>
              </div>
              
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" name="btn_simpan" class="btn btn-primary">Simpan</button>
              <a href="index.php?halaman=daftar_user" class="btn btn-secondary">Batal</a>
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
<script src="src/dist/js/ajax/tambah_user.js"></script>
