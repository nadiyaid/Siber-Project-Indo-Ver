<?php
    include("koneksi.php");

    if(isset($_POST['updateprofile'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $nama = $_POST['nama'];
        $posisi = $_POST['posisi'];
        $alamat = $_POST['alamat'];
        $nip = $_POST['nip'];

        $query = "UPDATE karyawan SET nama = '$nama', alamat = '$alamat', posisi='$posisi', username = '$username', password = MD5('$password'), email = '$email' WHERE nip = '$nip'";
        mysqli_query($config, $query) or die(mysqli_error($config));

        echo "<script language='javascript'>alert('Berhasil diubah!')</script>";
        echo "<script language='javascript'>window.location.replace('profile-superadmin.php'); </script>";
    }
?>