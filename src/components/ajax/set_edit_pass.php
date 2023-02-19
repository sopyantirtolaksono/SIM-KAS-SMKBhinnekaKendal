<?php

	// mulai session
	require "../session_start.php";

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id user
	$idUser = $_SESSION["user"]["id_user"];

	// ambil data(password) user
	$sqlUser 	= "SELECT * FROM tbl_user WHERE id_user = '$idUser' ";
	$ambilUser 	= $conn->query($sqlUser);
	$statusUser = $ambilUser->num_rows;

	// cek statusnya
	if($statusUser == 1) {
		// ambil datanya, pecah jadi array assosiatif
		$pecahUser 	= $ambilUser->fetch_assoc();
		$passUtama	= $pecahUser["password"];

		// ambil data password lama dan baru dari form
		$passLama 	= $_POST["passwordLama"];
		$passBaru 	= $_POST["passwordBaru"];

		if(password_verify($passLama, $passUtama)) {
			// hilangkan karakter spasi pada password baru
			$passBaru 		= str_replace(" ", "", $passBaru);
			// hitung panjang/jml karakter dlm password baru
			$passBaruLength = strlen($passBaru);

			// cek jika karakter kurang dari 8
			if($passBaruLength < 8) {
				echo "minimal harus 8 karakter";
				exit();
			}
			else {

				// enkripsi password baru
				$passBaru = password_hash($passBaru, PASSWORD_DEFAULT);
				// update password
				$sqlUpdatePass = "UPDATE tbl_user SET password = '$passBaru' WHERE id_user = '$idUser' ";
				$statusUpdatePass = $conn->query($sqlUpdatePass);
				// cek statusnya
				if($statusUpdatePass == 1) {
					echo "edit password sukses";
					exit();
				}
				else {
					echo "edit password gagal";
					exit();
				}

			}
			
		}
		else {
			echo "password anda tidak cocok";
			exit();
		}
	}
	else {
		echo "data user tidak ditemukan";
		exit();
	}

?>