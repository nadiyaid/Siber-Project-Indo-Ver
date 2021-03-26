<?php
	include("koneksi.php");
    session_start();

    if(isset($_POST['request'])){

        $fromdate=null;
        $todate= null;
        $status = $_POST['status'];
        $keterangan = $_POST['keterangan'];
        $pengganti = $_POST['pengganti'];
        $nip = $_SESSION['id'];

        if($from=strtotime($_POST['from']) and $to=strtotime($_POST['to'])){
            $fromdate=date("Y-m-d", $from);
            $todate=date("Y-m-d", $to);
            $sql = "INSERT INTO request (request_id, tanggal_request, status_ketidakhadiran, keterangan, dari_tanggal, sampai_tanggal, pengganti, approval, nip) VALUES (0, CURDATE(), '$status', '$keterangan', '$fromdate', '$todate', '$pengganti', '', '$nip')";
            $add = mysqli_query($config, $sql) or die(mysqli_error($config));
        }

        else if($from=strtotime($_POST['from'])){
            $fromdate=date("Y-m-d", $from);
            $sql = "INSERT INTO request (request_id, tanggal_request, status_ketidakhadiran, keterangan, dari_tanggal, sampai_tanggal, pengganti, approval, nip) VALUES (0, CURDATE(), '$status', '$keterangan', '$fromdate', null, '$pengganti', '', '$nip')";
            $add = mysqli_query($config, $sql) or die(mysqli_error($config));
        }

        else{
            $sql = "INSERT INTO request (request_id, tanggal_request, status_ketidakhadiran, keterangan, dari_tanggal, sampai_tanggal, pengganti, approval, nip) VALUES (0, CURDATE(), '$status', '$keterangan', null, null, '$pengganti', '', '$nip')";
            $add = mysqli_query($config, $sql) or die(mysqli_error($config));
        }
        
        if($add){
            echo "<script language='javascript'>alert('Permintaan berhasil diajukan!')</script>";
            echo "<script language='javascript'>window.location.replace('attendance.php'); </script>";
        }
        else{
            echo "<script language='javascript'>alert('GAGAL dalam mengajukan permintaan)</script>";
        }
    }
?>