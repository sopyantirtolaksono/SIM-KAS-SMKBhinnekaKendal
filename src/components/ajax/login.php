<?php

	// mulai session
	require "../session_start.php";

	// koneksi ke database
  	require "../../connection/koneksi_database.php";

  	// jika data sudah dikirimkan
  	if(isset($_POST["username"])) {

  		// ambil datanya pada form login
  		$username		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["username"]));
  		$password		= mysqli_real_escape_string($conn, htmlspecialchars($_POST["password"]));
  		$jabatan      	= mysqli_real_escape_string($conn, htmlspecialchars($_POST["jabatan"]));

  		// jika yg login pimpinan
  		if($jabatan == "pimpinan") {
  			// ambil data pimpinan yg login pada tabel user
  			$usernameJabatan = "SELECT * FROM tbl_user WHERE username = '$username' AND jabatan = '$jabatan' ";
	  		$ambilAkun = $conn->query($usernameJabatan);
	  		$status = $ambilAkun->num_rows;

	  		// cek statusnya
	  		if($status == 1) {
	  			// ambil datanya & jadikan array assosiatif
	  			$akunUser = $ambilAkun->fetch_assoc();
	  			// verifikasi password
	  			if(password_verify($password, $akunUser["password"])) {
	  				// cek jabatan user
	  				if($akunUser["jabatan"] == "pimpinan") {
	  					$_SESSION["user"] = $akunUser;

	  					// cek ada cookie tidak
		                if(isset($_POST["remember"])) {
		                    // set cookie id user
		                    setcookie("idC", $akunUser["id_user"], time()+2629800, "/", "", 0 );
		                    // set cookie username
		                    setcookie("keyC", hash("sha256", $akunUser["username"]), time()+2629800, "/", "", 0 );
		                }

	  					echo "login sukses";
	  					exit();
	  				}
	  				else {
	  					echo "akun tidak ditemukan";
	  					exit();
	  				}
	  			}
	  			else {
	  				echo "password salah";
	  				exit();
	  			}
	  		}
	  		else {
	  			echo "akun tidak ditemukan";
	  			exit();
	  		}

  		}
  		// jika yg login kepala sekolah
  		else if($jabatan == "kepala sekolah") {

  			// ambil data kepala sekolah yg login pada tabel user
  			$usernameJabatan = "SELECT * FROM tbl_user WHERE username = '$username' AND jabatan = '$jabatan' ";
	  		$ambilAkun = $conn->query($usernameJabatan);
	  		$status = $ambilAkun->num_rows;

	  		// cek statusnya
	  		if($status == 1) {
	  			// ambil datanya & dipecah jadi array assosiatif
	  			$akunUser = $ambilAkun->fetch_assoc();
	  			// verifikasi password
	  			if(password_verify($password, $akunUser["password"])) {

	  				// cek jabatan user
	  				if($akunUser["jabatan"] == "kepala sekolah") {
	  					$_SESSION["user"] = $akunUser;

	  					// cek ada cookie tidak
		                if(isset($_POST["remember"])) {
		                    // set cookie id user
		                    setcookie("idC", $akunUser["id_user"], time()+2629800, "/", "", 0 );
		                    // set cookie username
		                    setcookie("keyC", hash("sha256", $akunUser["username"]), time()+2629800, "/", "", 0 );
		                }

	  					echo "login sukses";
	  					exit();
	  				}
	  				else {
	  					echo "akun tidak ditemukan";
	  					exit();
	  				}
	  			}
	  			else {
	  				echo "password salah";
	  				exit();
	  			}
	  		}
	  		else {
	  			echo "akun tidak ditemukan";
	  			exit();
	  		}

		}
		// jika yg login bendahara
		else if($jabatan == "bendahara") {

			// ambil data bendahara yg login pada tabel user
			$usernameJabatan = "SELECT * FROM tbl_user WHERE username = '$username' AND jabatan = '$jabatan' ";
			$ambilAkun = $conn->query($usernameJabatan);
			$status = $ambilAkun->num_rows;

			// cek statusnya
			if($status == 1) {
				// ambil datanya & dipecah jadi array assosiatif
				$akunUser = $ambilAkun->fetch_assoc();
				// verifikasi password
				if(password_verify($password, $akunUser["password"])) {

					// cek jabatan user
					if($akunUser["jabatan"] == "bendahara") {
						$_SESSION["user"] = $akunUser;

						// cek ada cookie tidak
						if(isset($_POST["remember"])) {
							// set cookie id user
							setcookie("idC", $akunUser["id_user"], time()+2629800, "/", "", 0 );
							// set cookie username
							setcookie("keyC", hash("sha256", $akunUser["username"]), time()+2629800, "/", "", 0 );
						}

						echo "login sukses";
						exit();
					}
					else {
						echo "akun tidak ditemukan";
						exit();
					}
				}
				else {
					echo "password salah";
					exit();
				}
			}
			else {
				echo "akun tidak ditemukan";
				exit();
			}

		}  
  		// jika statusnya tidak dikenali
  		else {

  			echo "akun tidak ditemukan";
  			exit();

  		}

  	}

?>