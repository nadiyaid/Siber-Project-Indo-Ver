<?php
    include("koneksi.php");

    if(isset($_POST['updatetask'])){
        $task_id = $_POST['task_id'];
        $deskripsi = $_POST['deskripsi'];
        $comment = $_POST['comment'];
        $from = $_POST['from'];
        $todate = $_POST['todate'];
        $totime = $_POST['totime'];
        $status = $_POST['status'];
        $progress = $_POST['progress'];

        $query = "UPDATE task SET deskripsi = '$deskripsi', start_date = '$from', end_date = '$todate', end_time = '$totime', status = '$status', comment = '$comment', updated_at = CURRENT_TIMESTAMP, percentage = '$progress' WHERE task_id = '$task_id'";
        mysqli_query($config, $query) or die(mysqli_error($config));

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>