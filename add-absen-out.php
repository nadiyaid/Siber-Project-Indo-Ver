<?php
    session_start();
    include("koneksi.php");

        $nip = $_SESSION['id'];

        $sql = "UPDATE absensi SET waktu_pulang = NOW(), jam_kerja = TIMEDIFF(waktu_pulang, waktu_masuk), updated_at = CURRENT_TIMESTAMP WHERE waktu_pulang is null AND nip = '$nip'";
        $update = mysqli_query($config, $sql);

        if($update){
            echo "Presensi keluar berhasil!";
            header("location:attendance-superadmin.php");
        }
        else{
            echo "ERROR in adding data" ;
        }

    //     $now = date('Y-m-d H:i:s');
    //     $masuk = $_POST['waktu_masuk'];

    // if($new_time = date("Y-m-d H:i:s", strtotime('+5 minutes', strtotime($masuk)))){

    //     $sql = "UPDATE absensi SET waktu_pulang = '$new_time', jam_kerja = TIMEDIFF(waktu_pulang, waktu_masuk), updated_at = CURRENT_TIMESTAMP WHERE waktu_pulang is null AND nip = '$nip'";
    //     $update = mysqli_query($config, $sql);
    // }
?>