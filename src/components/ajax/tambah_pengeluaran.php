<?php

	// koneksi ke database
    require "../../connection/koneksi_database.php";
    
    // mulai session
    require "../session_start.php";

	// jika data sudah dikirim
	if(isset($_POST["nama_akun"])) {

        $idAkun    = mysqli_real_escape_string($conn, htmlspecialchars($_POST["nama_akun"]));
        $sqlAkun   = "SELECT * FROM tbl_akun WHERE id_akun = '$idAkun' ";
        $ambilAkun = $conn->query($sqlAkun);
        $pecahAkun = $ambilAkun->fetch_assoc();

        // ambil semua data dari form
        $idUser         = $_SESSION["user"]["id_user"];
        $kodeTransaksi  = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kode_transaksi"]));
        $namaAkun       = $pecahAkun["nama_akun"];
        $tanggal        = mysqli_real_escape_string($conn, htmlspecialchars($_POST["tanggal"]));
        $debet 	        = mysqli_real_escape_string($conn, htmlspecialchars($_POST["debet"]));
        $kredit         = mysqli_real_escape_string($conn, htmlspecialchars($_POST["kredit"]));
        $debetAkun      = $pecahAkun["debet"];
        $kreditAkun     = $pecahAkun["kredit"];
        $keterangan     = mysqli_real_escape_string($conn, htmlspecialchars($_POST["keterangan"]));

        // masukkan data baru pada tabel pengeluaran
        $sqlPengeluaran = "INSERT INTO tbl_pengeluaran (id_user, id_akun, kode_transaksi, tanggal_pengeluaran, nama_akun, keterangan, debet, kredit) VALUES ('$idUser', '$idAkun', '$kodeTransaksi', '$tanggal', '$namaAkun', '$keterangan', '$debet', '$kredit')";
        $status = $conn->query($sqlPengeluaran);
        // cek status
        if($status == 1) {
            // merubah value debet & kredit dari string ke integer
            $debetTransaksi  = intval($debet);
            $kreditTransaksi = intval($kredit);
            $debetAkun       = intval($debetAkun);
            $kreditAkun      = intval($kreditAkun);
            // operasi perhitungan debet & kredit (penambahan transaksi baru)
            if($debetTransaksi > 0) {
                if($debetAkun > 0 || $debetAkun < 0) {
                    $debetAkun = $debetAkun + $debetTransaksi;
                    $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
                    $conn->query($sqlUpdateSaldo);
                }
                else if($kreditAkun > 0 || $kreditAkun < 0) {
                    $kreditAkun = $kreditAkun - $debetTransaksi;
                    $sqlUpdateSaldo = "UPDATE tbl_akun SET kredit = '$kreditAkun' WHERE id_akun = '$idAkun' ";
                    $conn->query($sqlUpdateSaldo);
                }
                else {
                    $sqlStatusSaldo = "SELECT status_saldo FROM tbl_akun WHERE id_akun = '$idAkun' ";
                    $ambilStatusSaldo = $conn->query($sqlStatusSaldo);
                    $pecahStatusSaldo = $ambilStatusSaldo->fetch_assoc();
                    $statusSaldo      = $pecahStatusSaldo["status_saldo"];
                    // cek posisi status saldo akun
                    if($statusSaldo == "debet") {
                        $debetAkun = $debetAkun + $debetTransaksi;
                        $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
                        $conn->query($sqlUpdateSaldo);
                    }
                    else {
                        $kreditAkun = $kreditAkun - $debetTransaksi;
                        $sqlUpdateSaldo = "UPDATE tbl_akun SET kredit = '$kreditAkun' WHERE id_akun = '$idAkun' ";
                        $conn->query($sqlUpdateSaldo);
                    }
                }
            }
            else if($kreditTransaksi > 0) {
                if($debetAkun > 0 || $debetAkun < 0) {
                    $debetAkun = $debetAkun - $kreditTransaksi;
                    $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
                    $conn->query($sqlUpdateSaldo);
                }
                else if($kreditAkun > 0 || $kreditAkun < 0) {
                    $kreditAkun = $kreditAkun + $kreditTransaksi;
                    $sqlUpdateSaldo = "UPDATE tbl_akun SET kredit = '$kreditAkun' WHERE id_akun = '$idAkun' ";
                    $conn->query($sqlUpdateSaldo);
                }
                else {
                    $sqlStatusSaldo = "SELECT status_saldo FROM tbl_akun WHERE id_akun = '$idAkun' ";
                    $ambilStatusSaldo = $conn->query($sqlStatusSaldo);
                    $pecahStatusSaldo = $ambilStatusSaldo->fetch_assoc();
                    $statusSaldo      = $pecahStatusSaldo["status_saldo"];
                    // cek posisi status saldo akun
                    if($statusSaldo == "debet") {
                        $debetAkun = $debetAkun - $kreditTransaksi;
                        $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
                        $conn->query($sqlUpdateSaldo);
                    }
                    else {
                        $kreditAkun = $kreditAkun + $kreditTransaksi;
                        $sqlUpdateSaldo = "UPDATE tbl_akun SET kredit = '$kreditAkun' WHERE id_akun = '$idAkun' ";
                        $conn->query($sqlUpdateSaldo);
                    }
                }
            }
            
            echo "sukses menambah data baru";
            exit();
        }
        else {
            echo "gagal menambah data baru";
            exit();
        }

	}

?>