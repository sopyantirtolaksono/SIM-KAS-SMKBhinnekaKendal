<?php

	// koneksi ke database
  	require "../../connection/koneksi_database.php";

	// ambil data user ditabel user
	$sqlUser   = "SELECT * FROM tbl_user ORDER BY id_user DESC";
	$ambilUser = $conn->query($sqlUser);

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Daftar User</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=dashboard">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item">Daftar User</li>
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
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar user</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Gambar</th>
              </tr>
              </thead>
              <tbody>

                <?php 
                  $no = 1;
                  while($pecahUser = $ambilUser->fetch_assoc()) { 
                ?>
                <tr>
                    <td><?=$no; ?></td>
                    <td>
                      <a href="index.php?halaman=edit_user&id=<?=$pecahUser['id_user']; ?>" class="btn btn-info btn-sm">Edit</a>
                      <a href="src/components/ajax/hapus_user.php?id=<?=$pecahUser['id_user']; ?>" class="btn btn-danger btn-sm" id="btnHapusUser">Hapus</a>
                    </td>
                    <td><?=$pecahUser["nama_lengkap"]; ?></td>
                    <td><?=$pecahUser["username"]; ?></td>
                    <td><?=$pecahUser["jenis_kelamin"]; ?></td>
                    <td><?=$pecahUser["jabatan"]; ?></td>
                    <td width="10%">
                      <img src="src/dist/img/img_users/<?=$pecahUser['gambar']; ?>" class="img-thumbnail" alt="Foto User">
                    </td>
                </tr>
                <?php 
                  $no++;
                  } 
                ?>

              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Aksi</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Gambar</th>
              </tr>
              </tfoot>
            </table>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
    </div>
  </div>
</section>


<!-- JS File -->
<!-- Daftar Member -->
<script src="src/dist/js/ajax/daftar_user.js"></script>