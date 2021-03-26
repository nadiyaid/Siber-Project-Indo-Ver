<?php
    include("koneksi.php");

    $request_id = $_POST['request_id'];
    $comment = $_POST['comment'];
    $fromdate=null;
    $todate= null;

    if(isset($_POST['decline'])){
        $fromdate=date("Y-m-d", $from);
        $todate=date("Y-m-d", $to);
        $query = "UPDATE request SET approval = 'decline', comment = '$comment', updated_at = CURRENT_TIMESTAMP() WHERE request.request_id = '$request_id'";
        mysqli_query($config, $query) or die(mysqli_error());

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else if(isset($_POST['approve']) and $from=strtotime($_POST['from']) and $to=strtotime($_POST['to'])){
        $fromdate=date("Y-m-d", $from);
        $todate=date("Y-m-d", $to);
        $query = "UPDATE request SET dari_tanggal = '$fromdate', sampai_tanggal = '$todate', approval = 'approve', comment = '$comment', updated_at = CURRENT_TIMESTAMP() WHERE request.request_id = '$request_id'";
        mysqli_query($config, $query) or die(mysqli_error());

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else{
        $query = "UPDATE request SET dari_tanggal = null, sampai_tanggal = null, approval = 'approve', comment = '$comment', updated_at = CURRENT_TIMESTAMP() WHERE request.request_id = '$request_id'";
        mysqli_query($config, $query) or die(mysqli_error());

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    
?>