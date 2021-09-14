<?php
    session_start();
    include("koneksi.php");

    $nip = $_SESSION['id'];

    $sql = "SELECT * FROM absensi WHERE nip = '$_SESSION[id]' AND waktu_pulang is null";
    $run = mysqli_query($config, $sql);
    $row = mysqli_fetch_object($run);
    $wm = $row->waktu_masuk;

    $status_out = '';
    if(!(date('H:i:s') >= date('H:i:s', strtotime($wm.'+8hours')))){
        $status_out = 'leave early';
    }

    $sql = "UPDATE absensi SET waktu_pulang = NOW(), jam_kerja = TIMEDIFF(waktu_pulang, waktu_masuk), updated_at = CURRENT_TIMESTAMP, stat_out = '$status_out' WHERE tanggal = CURDATE() AND waktu_pulang is null AND nip = '$nip' AND waktu_masuk is not null";
    $update = mysqli_query($config, $sql);

    if($update){
        echo "<script language='javascript'>alert('Presensi keluar berhasil')</script>";
        echo "<script language='javascript'>window.location.replace('attendance-admin.php'); </script>";
    }
    else {
        die(mysqli_error($config) );
    }
    
?>