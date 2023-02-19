<?php

    // koneksi ke database
    require "../../connection/koneksi_database.php";

    // jika sudah menggirimkan data
    if(isset($_POST["nama_lengkap"])) {
        
        // ambil semua data di form
        $namaLengkap    = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_lengkap"]));
        $jenisKelamin   = mysqli_real_escape_string($conn, htmlspecialchars($_POST["jenis_kelamin"]));
        $jabatan        = mysqli_real_escape_string($conn, htmlspecialchars($_POST["jabatan"]));
        $username       = mysqli_real_escape_string($conn, htmlspecialchars($_POST["username"]));
        $password       = $_POST["password"];

        // cek username
        // hilangkan karakter spasi pada username
        $username       = str_replace(" ", "", $username);
        // jadikan semua karakter huruf besar menjadi huruf kecil
        $username       = strtolower($username);
        // jadikan nilai variabel username menjadi array & ambil karakter pertamanya
        $usernameSplit  = str_split($username);
        // cek karakter pertama dari nilai username
        if($usernameSplit[0] != "@") {

            echo "karakter pertama harus @";
            exit();

        }
        else {

            // cek username sudah ada belum
            $sqlUser        = "SELECT * FROM tbl_user WHERE username = '$username' ";
            $ambilUser      = $conn->query($sqlUser);
            $statusUsername = $ambilUser->num_rows;

            if($statusUsername != 0) {

                echo "username sudah ada";
                exit();

            }
            else {

                // cek password
                // hilangkan karakter spasi pada password
                $password       = str_replace(" ", "", $password);
                // hitung panjang/jml karakter dlm password
                $passwordLength = strlen($password);

                // cek jika karakter kurang dari 8
                if($passwordLength < 8) {

                    echo "minimal harus 8 karakter";
                    exit();

                }
                else {

                    // enkripsi password
                    $password = password_hash($password, PASSWORD_DEFAULT);

                    // masukkan data user baru pada tabel user
                    $sqlRegistrasi = "INSERT INTO tbl_user (username, password, nama_lengkap, jenis_kelamin, jabatan) VALUES ('$username', '$password', '$namaLengkap', '$jenisKelamin', '$jabatan')";
                    $status = $conn->query($sqlRegistrasi);

                    // cek statusnya
                    if($status == 1) {
                        echo "registrasi berhasil";
                        exit();
                    }
                    else {
                        echo "registrasi gagal";
                        exit();
                    }

                }

            }

        }

    }

?>