<?php
    session_start();
    include("koneksi.php");

        $nip = $_SESSION['id'];

        $sql = "UPDATE absensi SET waktu_pulang = NOW(), jam_kerja = TIMEDIFF(waktu_pulang, waktu_masuk), updated_at = CURRENT_TIMESTAMP WHERE waktu_pulang is null AND nip = '$nip'";
        $update = mysqli_query($config, $sql);

        if($update){
            echo "Successfully added";
            header("location:attendance.php");
        }
        else{
            echo "ERROR in adding data" ;
        }
?>