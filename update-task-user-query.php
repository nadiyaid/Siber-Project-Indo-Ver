<?php
    include("koneksi.php");

    if(isset($_POST['updatetask'])){
        $namaFile = $_FILES['berkas']['name'];
        $namaSementara = $_FILES['berkas']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = "attachment/";

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

        if ($terupload) {
            echo "Berhasil!<br/>";
            echo "Tautan: <a href='".$dirUpload.$namaFile."'>".$namaFile."</a>";
        } else {
            echo "Gagal!";
        }

        $task_id = $_POST['task_id'];
        $deskripsi = $_POST['deskripsi'];
        $comment = $_POST['comment'];
        $from = $_POST['from'];
        $todate = $_POST['todate'];
        $totime = $_POST['totime'];
        $status = $_POST['status'];
        $progress = $_POST['progress'];
        $file = $dirUpload.$namaFile;

        $query = "UPDATE task SET deskripsi = '$deskripsi', start_date = '$from', end_date = '$todate', end_time = '$totime', status = '$status', comment = '$comment', updated_at = CURRENT_TIMESTAMP, percentage = '$progress', file = '$file' WHERE task_id = '$task_id'";
        mysqli_query($config, $query) or die(mysqli_error($config));

        header("location: task.php");
    }
?>