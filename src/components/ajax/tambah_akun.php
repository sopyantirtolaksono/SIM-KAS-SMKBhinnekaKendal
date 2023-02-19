<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

    // set timezone
    date_default_timezone_set("Asia/Jakarta");

	// jika data sudah dikirim
	if(isset($_POST["tipe_akun"])) {

        // ambil semua data dari form
        $tipeAkun = mysqli_real_escape_string($conn, htmlspecialchars($_POST["tipe_akun"]));
        $namaAkun = mysqli_real_escape_string($conn, htmlspecialchars(strtolower($_POST["nama_akun"])));
        $debet 	  = mysqli_real_escape_string($conn, htmlspecialchars($_POST["debet"]));
        $kredit   = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kredit"]));
        $tanggal  = date("Y-m-d");

        // cek status saldonya debet/kredit
        if(intval($debet) == 0) {
            $statusSaldo = "kredit";
        }
        else {
            $statusSaldo = "debet";
        }

        // masukkan data baru pada tabel akun
        $sqlTambahAkun = "INSERT INTO tbl_akun (tipe_akun, nama_akun, debet, kredit, debet_awal, kredit_awal, status_saldo, tanggal) VALUES ('$tipeAkun', '$namaAkun', '$debet', '$kredit', '$debet', '$kredit', '$statusSaldo', '$tanggal')";
        $status = $conn->query($sqlTambahAkun);
        // cek status
        if($status == 1) {
            echo "sukses menambah data baru";
            exit();
        }
        else {
            echo "gagal menambah data baru";
            exit();
        }

	}

?>