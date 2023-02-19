<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id pendapatan diURL
	$idPendapatan = $_GET["id"];

	// ambil data saldo debet dan kredit transaksi
	$sqlSaldoTransaksi 	 = "SELECT * FROM tbl_pendapatan WHERE id_pendapatan = '$idPendapatan' ";
	$ambilSaldoTransaksi = $conn->query($sqlSaldoTransaksi);
	$pecahSaldoTransaksi = $ambilSaldoTransaksi->fetch_assoc();
	$debetTransaksi  	 = $pecahSaldoTransaksi["debet"];
	$kreditTransaksi  	 = $pecahSaldoTransaksi["kredit"];
	$idAkun 			 = $pecahSaldoTransaksi["id_akun"];

	// ambil data saldo debet dan kredit akun
	$sqlSaldoAkun 	= "SELECT * FROM tbl_akun WHERE id_akun = '$idAkun' ";
	$ambilSaldoAkun = $conn->query($sqlSaldoAkun);
	$pecahSaldoAkun = $ambilSaldoAkun->fetch_assoc();
	$debetAkun 		= $pecahSaldoAkun["debet"];
	$kreditAkun 	= $pecahSaldoAkun["kredit"];

	// merubah value debet & kredit dari string ke integer
    $debetTransaksi  = intval($debetTransaksi);
    $kreditTransaksi = intval($kreditTransaksi);
    $debetAkun       = intval($debetAkun);
    $kreditAkun      = intval($kreditAkun);
    // operasi perhitungan debet & kredit (penghapusan data transaksi)
    if($debetTransaksi > 0) {
        if($debetAkun > 0 || $debetAkun < 0) {
            $debetAkun = $debetAkun - $debetTransaksi;
            $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
            $conn->query($sqlUpdateSaldo);
        }
        else if($kreditAkun > 0 || $kreditAkun < 0) {
            $kreditAkun = $kreditAkun + $debetTransaksi;
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
                $debetAkun = $debetAkun - $debetTransaksi;
                $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
                $conn->query($sqlUpdateSaldo);
            }
            else {
                $kreditAkun = $kreditAkun + $debetTransaksi;
                $sqlUpdateSaldo = "UPDATE tbl_akun SET kredit = '$kreditAkun' WHERE id_akun = '$idAkun' ";
                $conn->query($sqlUpdateSaldo);
            }
        }
    }
    else if($kreditTransaksi > 0) {
        if($debetAkun > 0 || $debetAkun < 0) {
            $debetAkun = $debetAkun + $kreditTransaksi;
            $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
            $conn->query($sqlUpdateSaldo);
        }
        else if($kreditAkun > 0 || $kreditAkun < 0) {
            $kreditAkun = $kreditAkun - $kreditTransaksi;
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
                $debetAkun = $debetAkun + $kreditTransaksi;
                $sqlUpdateSaldo = "UPDATE tbl_akun SET debet = '$debetAkun' WHERE id_akun = '$idAkun' ";
                $conn->query($sqlUpdateSaldo);
            }
            else {
                $kreditAkun = $kreditAkun - $kreditTransaksi;
                $sqlUpdateSaldo = "UPDATE tbl_akun SET kredit = '$kreditAkun' WHERE id_akun = '$idAkun' ";
                $conn->query($sqlUpdateSaldo);
            }
        }
    }

	// hapus data pendapatan ditabel pendapatan sesuai dengan id yang dikirim
	$sqlHapusPendapatan = "DELETE FROM tbl_pendapatan WHERE id_pendapatan = '$idPendapatan' ";
	$status = $conn->query($sqlHapusPendapatan);

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