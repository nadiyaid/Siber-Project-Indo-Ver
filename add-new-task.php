<?php
	include("koneksi.php");
    session_start();

    if(isset($_POST['addtask'])){

        $namatask = $_POST['nama_task'];
        $deskripsi = $_POST['deskripsi'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $end_time = $_POST['end_time'];
        $nip = $_POST['user'];
        $nama = $_SESSION['name'];

        $sql = "INSERT INTO task (task_id, nama_task, deskripsi, created_at, created_by, start_date, end_date, end_time, nip, status, comment, updated_at, percentage) VALUES (0, '$namatask', '$deskripsi', CURRENT_TIMESTAMP, '$nama', '$start_date', '$end_date', '$end_time', '$nip', 'Belum dikerjakan', '', CURRENT_TIMESTAMP, '0')";
        $add = mysqli_query($config, $sql) or die(mysqli_error($config));
        

        if($add){
            echo "<script language='javascript'>alert('Tugas berhasil ditambahkan')</script>";
            echo "<script language='javascript'>window.location.replace('task-admin.php'); </script>";
        }
        else{
            echo "<script language='javascript'>alert('GAGAL menambah data')</script>";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }
?>