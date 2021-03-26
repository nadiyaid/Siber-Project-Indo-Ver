<?php
	session_start();
	include("koneksi.php");

	$del=mysqli_query($config, "DELETE FROM request WHERE request_id = '$_GET[request_id]'");
    mysqli_query($config, "ALTER TABLE request AUTO_INCREMENT=0");
    header("location:manage-attendance.php");
?>