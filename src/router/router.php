<?php

	if(isset($_GET["halaman"])) {
		if($_GET["halaman"] == "dashboard") {
			require "src/views/dashboard.php";
		}
		else if($_GET["halaman"] == "daftar_akun") {
			require "src/views/daftar_akun.php";
		}
		else if($_GET["halaman"] == "tambah_akun") {
			require "src/views/tambah_akun.php";
		}
		else if($_GET["halaman"] == "edit_akun") {
			require "src/views/edit_akun.php";
		}
		else if($_GET["halaman"] == "hapus_akun") {
			require "src/views/hapus_akun.php";
		}
		else if($_GET["halaman"] == "pendapatan") {
			require "src/views/pendapatan.php";
		}
		else if($_GET["halaman"] == "tambah_pendapatan") {
			require "src/views/tambah_pendapatan.php";
		}
		else if($_GET["halaman"] == "edit_pendapatan") {
			require "src/views/edit_pendapatan.php";
		}
		else if($_GET["halaman"] == "hapus_pendapatan") {
			require "src/views/hapus_pendapatan.php";
		}
		else if($_GET["halaman"] == "pengeluaran") {
			require "src/views/pengeluaran.php";
		}
		else if($_GET["halaman"] == "tambah_pengeluaran") {
			require "src/views/tambah_pengeluaran.php";
		}
		else if($_GET["halaman"] == "edit_pengeluaran") {
			require "src/views/edit_pengeluaran.php";
		}
		else if($_GET["halaman"] == "hapus_pengeluaran") {
			require "src/views/hapus_pengeluaran.php";
		}
		else if($_GET["halaman"] == "profil") {
			require "src/views/profil.php";
		}
		else if($_GET["halaman"] == "edit_profil") {
			require "src/views/edit_profil.php";
		}
		else if($_GET["halaman"] == "daftar_user") {
			require "src/views/daftar_user.php";
		}
		else if($_GET["halaman"] == "tambah_user") {
			require "src/views/tambah_user.php";
		}
		else if($_GET["halaman"] == "edit_user") {
			require "src/views/edit_user.php";
		}
		else if($_GET["halaman"] == "hapus_user") {
			require "src/views/hapus_user.php";
		}
		else if($_GET["halaman"] == "lap_pendapatan") {
			require "src/views/lap_pendapatan.php";
		}
		else if($_GET["halaman"] == "lap_pengeluaran") {
			require "src/views/lap_pengeluaran.php";
		}
		else if($_GET["halaman"] == "lap_laba_rugi") {
			require "src/views/lap_laba_rugi.php";
		}
		else if($_GET["halaman"] == "lap_arus_kas") {
			require "src/views/lap_arus_kas.php";
		}
		else if($_GET["halaman"] == "lap_neraca") {
			require "src/views/lap_neraca.php";
		}
		else {
			require "src/views/404.php";
		}
	}
	else {
		echo "<script>location='index.php?halaman=dashboard';</script>";
	}
