<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id user diURL
	$idUser = $_GET["id"];

	// hapus data user ditabel user sesuai dengan id yang dikirim
	$sqlHapusUser = "DELETE FROM tbl_user WHERE id_user = '$idUser' ";
	$status = $conn->query($sqlHapusUser);

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