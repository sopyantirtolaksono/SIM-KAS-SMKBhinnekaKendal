<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// jika data sudah dikirim
	if(isset($_POST["nama_akun"])) {
		// ambil id pengeluaran
        $idPengeluaran = mysqli_real_escape_string($conn, htmlspecialchars($_POST["id_pengeluaran"]));
        
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

        // edit data pengeluaran ditabel pengeluaran
        $sqlPengeluaran = "UPDATE tbl_pengeluaran SET kode_akun = '$kodeAkun', tanggal_pengeluaran = '$tanggal', nama_akun = '$namaAkun', keterangan = '$keterangan', debet = '$debet', kredit = '$kredit' WHERE id_pengeluaran = '$idPengeluaran' ";
        $status = $conn->query($sqlPengeluaran);
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