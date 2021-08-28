<?php
    include("koneksi.php");

    if(isset($_POST['edit'])){
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $posisi = $_POST['posisi'];
        $absen_id = $_POST['absen_id'];
        $status = $_POST['status'];

        $query = "UPDATE absensi SET stat = '$status' WHERE absen_id = '$absen_id'";
        mysqli_query($config, $query) or die(mysqli_error());

        header("location: dashboard-superadmin.php");

    }
    
?>