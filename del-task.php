<?php
	session_start();
	include("koneksi.php");

	$del=mysqli_query($config, "DELETE FROM task WHERE task_id = '$_GET[task_id]'");
    mysqli_query($config, "ALTER TABLE task AUTO_INCREMENT=0");
    header("location:task-admin.php");
?>