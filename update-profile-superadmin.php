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
        $update=mysqli_query($config, $query);
 
        if($update){
            header("Location: profile-superadmin.php?success=Berhasil diubah!");
        }
    }
?>