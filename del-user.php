<?php
	session_start();
	include("koneksi.php");

	$del=mysqli_query($config, "DELETE FROM karyawan WHERE nip = '$_GET[nip]'") or die(mysqli_error($config)); 
    mysqli_query($config, "ALTER TABLE karyawan AUTO_INCREMENT=0");

	if($del){
		echo "<script language='javascript'>alert('Berhasil dihapus!')</script>";
        echo "<script language='javascript'>window.location.replace('manage-user.php'); </script>";
	}
?>