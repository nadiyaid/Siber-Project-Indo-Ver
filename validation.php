<?php
	include("koneksi.php");
	date_default_timezone_set('Asia/Jakarta');
	if (!$_SESSION['username'])
	{
		header("location:login.php?error=Anda belum masuk");
	}

?>
