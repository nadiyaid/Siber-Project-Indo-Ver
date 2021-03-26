<?php
    include("koneksi.php");

    if(isset($_POST['edit'])){
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $posisi = $_POST['posisi'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $query = "UPDATE karyawan SET nama = '$nama', posisi = '$posisi', email = '$email', role = '$role' WHERE nip = '$nip'";
        mysqli_query($config, $query) or die(mysqli_error());

        header("location: manage-user.php");

    }
    
?>