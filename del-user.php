<?php
	session_start();
	include("koneksi.php");

	$del=mysqli_query($config, "DELETE FROM karyawan WHERE nip = '$_GET[nip]'");
    mysqli_query($config, "ALTER TABLE karyawan AUTO_INCREMENT=0");
    header("location:manage-user.php");
?>