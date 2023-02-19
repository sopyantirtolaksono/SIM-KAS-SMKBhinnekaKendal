<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id akun diURL
	$idAkun = $_GET["id"];

	// hapus data akun ditabel akun sesuai dengan id yang dikirim
	$sqlHapusAkun = "DELETE FROM tbl_akun WHERE id_akun = '$idAkun' ";
	$status = $conn->query($sqlHapusAkun);

	// cek status
	if($status == 1) {
		echo "sukses menghapus data";
		exit();
	}
	else {
		echo "gagal menghapus data";
		exit();
	}

?>