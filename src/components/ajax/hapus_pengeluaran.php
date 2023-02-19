<?php

	// koneksi ke database
	require "../../connection/koneksi_database.php";

	// ambil id pengeluaran diURL
	$idPengeluaran = $_GET["id"];

	// ambil data saldo debet dan kredit transaksi
	$sqlSaldoTransaksi 	 = "SELECT * FROM tbl_pengeluaran WHERE id_pengeluaran = '$idPengeluaran' ";
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

	// hapus data pengeluaran ditabel pengeluaran sesuai dengan id yang dikirim
	$sqlHapusPengeluaran = "DELETE FROM tbl_pengeluaran WHERE id_pengeluaran = '$idPengeluaran' ";
	$status = $conn->query($sqlHapusPengeluaran);

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