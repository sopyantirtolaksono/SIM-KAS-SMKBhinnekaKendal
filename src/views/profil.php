<?php

	// cek siapa yang login
	// if(!isset($_SESSION["member"])) {
	//     if(isset($_SESSION["admin"])) {
	//       	echo "<script>location ='index.php?halaman=dashboard';</script>";
	//       	exit();
	//     }
	//     else {
	//       	echo "<script>location ='login.php';</script>";
	//       	exit();
	//     }
	// }

	// ambil id user
	$idU 	= $_SESSION["user"]["id_user"];
	// ambil data user yg login
	$sqlU 	= "SELECT * FROM tbl_user WHERE id_user = '$idU' ";
	$ambilU = $conn->query($sqlU);
	$pecahU = $ambilU->fetch_assoc();

?>

<?php if($pecahU["jabatan"] == "pimpinan") { ?>

	<div id="loadData">
	
		<!-- JS -->
		<script type="text/javascript">

		function loadData() {
			$.get("src/components/ajax/profil.php", function(data) {
			$("#loadData").html(data);
			});
		}

		loadData();
		
		</script>

	</div>

<?php } else { ?>

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
				<div class="col-md-3">

					<!-- Profile Image -->
					<div class="card card-primary card-outline">
					<div class="card-body box-profile">
						<div class="text-center">
							<img class="profile-user-img img-fluid img-circle" src="src/dist/img/img_users/<?=$pecahU['gambar']; ?>" alt="Foto user">
						</div>

						<h3 class="profile-username text-center">
							<?=$pecahU["username"]; ?>
						</h3>
					</div>
					<!-- /.card-body -->
					</div>
					<!-- /.card -->

				</div>
				<!-- /.col -->

				<div class="col-md-9">

					<!-- About Me Box -->
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Tentang</h3>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							<strong><i class="fas fa-user mr-1"></i> Nama Lengkap</strong>

							<p class="text-muted text-capitalize">
								<?=$pecahU["nama_lengkap"]; ?>
							</p>

							<hr>

							<strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>

							<p class="text-muted text-capitalize">
								<?=$pecahU["jenis_kelamin"]; ?>
							</p>

							<hr>

							<strong><i class="fas fa-briefcase mr-1"></i> Jabatan</strong>

							<p class="text-muted text-capitalize">
								<?=$pecahU["jabatan"]; ?>
							</p>

						</div>
						<!-- /.card-body -->
					</div>
					<!-- /.card -->
					
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div><!-- /.container-fluid -->
	</section>
	<!-- /.content -->

<?php } ?>