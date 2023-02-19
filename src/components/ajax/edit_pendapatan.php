<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// jika data sudah dikirim
	if(isset($_POST["nama_akun"])) {
		// ambil id pendapatan
        $idPendapatan = mysqli_real_escape_string($conn, htmlspecialchars($_POST["id_pendapatan"]));
        
        // ambil data akun ditabel akun sesuai kode akun yg dikirim
        $kodeAkun 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_akun"]));
        $sqlAkun    = "SELECT * FROM tbl_akun WHERE kode_akun = '$kodeAkun' ";
        $ambilAkun  = $conn->query($sqlAkun);
        $pecahAkun  = $ambilAkun->fetch_assoc();

        // ambil semua data dari form
        $kodeAkun 	= $pecahAkun["kode_akun"];
        $namaAkun 	= $pecahAkun["nama_akun"];
        $tanggal 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["tanggal"]));
        $debet      = mysqli_real_escape_string($conn, htmlspecialchars($_POST["debet"]));
        $kredit     = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kredit"]));
        $keterangan = mysqli_real_escape_string($conn, htmlspecialchars($_POST["keterangan"]));

        // edit data pendapatan ditabel pendapatan
        $sqlPendapatan = "UPDATE tbl_pendapatan SET kode_akun = '$kodeAkun', tanggal_pendapatan = '$tanggal', nama_akun = '$namaAkun', keterangan = '$keterangan', debet = '$debet', kredit = '$kredit' WHERE id_pendapatan = '$idPendapatan' ";
        $status = $conn->query($sqlPendapatan);
        // cek status
        if($status == 1) {
            echo "sukses mengedit data";
            exit();
        }
        else {
            echo "gagal mengedit data";
            exit();
        }

	}

?>