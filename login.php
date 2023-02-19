<?php 

    // mulai session
    require "src/components/session_start.php";

    // cek jika sudah ada session user
    if(isset($_SESSION["user"])) {
      // alihkan agar tetap dihalaman index/dashboard
      header("Location: index.php");
      exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>kas smk bhinneka kendal | login</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="src/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="src/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="src/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="src/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- jQuery -->
  <script src="src/plugins/jquery/jquery.min.js"></script>

  <!-- <style>
    html,body {
      background-color: black !important;
    }
  </style> -->

</head>
<body class="hold-transition login-page">


<div class="login-box">
  <div class="login-logo">
    <a href="#" class="stationary"><b>KAS SMK BHINNEKA KENDAL</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Login untuk user</p>

      <form action="src/components/ajax/login.php" method="post" id="formLogin">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <!-- <div class="input-group mb-0 justify-content-center">
          <div class="row">
            <div class="col-12">
              <label>Status User</label>
            </div>
          </div>
        </div> -->
        
        <div class="input-group mb-3">
          <select class="form-control" name="jabatan" required>
            <option disabled>Jabatan:</option>
            <option value="pimpinan">Pimpinan</option>
            <option value="kepala sekolah">Kepala Sekolah</option>
            <option value="bendahara">Bendahara</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-7">
            <div class="icheck-primary">
              <input type="checkbox" id="lihatPassword" onclick="showHide()">
              <label for="lihatPassword">
                Lihat Password
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-5">
            <button type="submit" class="btn btn-primary btn-block" name="btn_submit">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <hr>
      <p class="mb-0">
        <div class="icheck-primary">
          <input type="checkbox" id="remember" name="remember">
          <label for="remember">
            Remember Me
          </label>
        </div>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->


<!-- Bootstrap 4 -->
<script src="src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="src/dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="src/plugins/sweetalert2/sweetalert2.min.js"></script>


<!-- JS File -->
<!-- Login -->
<script src="src/dist/js/ajax/login.js"></script>

</body>
</html>
