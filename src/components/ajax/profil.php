<?php

  // mulai session
  require "../session_start.php";

  // koneksi ke database
  require "../../connection/koneksi_database.php";

  // ambil id user
	$idUser = $_SESSION["user"]["id_user"];

  // ambil data user
  $sqlUser       = "SELECT * FROM tbl_user WHERE id_user = '$idUser' ";
  $ambilUser     = $conn->query($sqlUser);
  $pecahUser     = $ambilUser->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profil</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Profil</li>
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
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle"
                   src="src/dist/img/img_users/<?=$pecahUser['gambar']; ?>"
                   alt="Foto user">
            </div>

            <h3 class="profile-username text-center"><?=$pecahUser["username"]; ?></h3>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tentang</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <strong><i class="fas fa-user mr-1"></i> Nama Lengkap</strong>

            <p class="text-muted text-capitalize">
              <?=$pecahUser["nama_lengkap"]; ?>
            </p>

            <hr>

            <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>

            <p class="text-muted text-capitalize">
              <?=$pecahUser["jenis_kelamin"]; ?>
            </p>

            <hr>

            <strong><i class="fas fa-briefcase mr-1"></i> Jabatan</strong>

            <p class="text-muted text-capitalize">
              <?=$pecahUser["jabatan"]; ?>
            </p>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->

      <!-- right column -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
            	<li class="nav-item"><a class="nav-link active" href="#editProfil" data-toggle="tab">Edit Profil</a></li>
              	<li class="nav-item"><a class="nav-link" href="#editPassword" data-toggle="tab">Edit Password</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">

              <div class="tab-pane active" id="editProfil">
                <form action="src/components/ajax/set_edit_profil.php" method="post" class="form-horizontal" id="formEditProfil" enctype="multipart/form-data">
                  
                  <div class="form-group row">
                    <label for="namaLengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" value="<?=$pecahUser['nama_lengkap']; ?>" placeholder="Nama Lengkap" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="username" name="username" value="<?=$pecahUser['username']; ?>" placeholder="@username" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jenisKelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 select2bs4" id="jenisKelamin" name="jenis_kelamin" required>
                      	<option selected value="<?=$pecahUser['jenis_kelamin']; ?>">
                      		<?=$pecahUser["jenis_kelamin"]; ?>
                      	</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                    <div class="col-sm-10">
                      <select class="form-control select2 select2bs4" id="jabatan" name="jabatan" required>
                      	<option selected value="<?=$pecahUser['jabatan']; ?>">
                      		<?=$pecahUser["jabatan"]; ?>
                      	</option>
                        <option value="pimpinan">Pimpinan</option>
                        <option value="kepala sekolah">Kepala Sekolah</option>
                        <option value="bendahara">Bendahara</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="gambar" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-10">
                      <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane " id="editPassword">
                <form action="src/components/ajax/set_edit_pass.php" method="post" class="form-horizontal" id="formEditPassword">

                  <div class="form-group row">
                    <label for="passwordLama" class="col-sm-2 col-form-label">Password Lama</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="passwordLama" name="passwordLama" placeholder="Password Lama" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="passwordBaru" class="col-sm-2 col-form-label">Password Baru</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="passwordBaru" name="passwordBaru" placeholder="Password Baru" required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" onclick="showHide()"> Lihat password
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Simpan</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->

            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<!-- JS File -->
<!-- Profil -->
<script src="src/dist/js/ajax/profil.js"></script>