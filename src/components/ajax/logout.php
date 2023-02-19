<?php

	// mulai session
	require "../session_start.php";

	// hapus semua session yang ada
	session_destroy();

	// hilangkan cookienya
	setcookie("idC", "", time()-2629800, "/", "", 0);
	setcookie("keyC", "", time()-2629800, "/", "", 0);

	// alihkan ke halaman login
	header("Location: ../../../login.php");
	exit();

?>