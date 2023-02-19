<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// jika data sudah dikirim
	if(isset($_POST["tipe_akun"])) {
		// ambil id akun
        $idAkun = mysqli_real_escape_string($conn, htmlspecialchars($_POST["id_akun"]));
        
        // ambil semua data dari form
        $tipeAkun 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["tipe_akun"]));
        $namaAkun = mysqli_real_escape_string($conn, htmlspecialchars(strtolower($_POST["nama_akun"])));
        $debet 	    = mysqli_real_escape_string($conn, htmlspecialchars($_POST["debet"]));
        $kredit 	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["kredit"]));

        // masukkan data baru pada tabel akun
        $sqlEditAkun = "UPDATE tbl_akun SET tipe_akun = '$tipeAkun', nama_akun = '$namaAkun', debet = '$debet', kredit = '$kredit' WHERE id_akun = '$idAkun' ";
        $status = $conn->query($sqlEditAkun);
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