<?php
	include("koneksi.php");

    if(isset($_POST['add'])){

        $nama = $_POST['nama'];
        $posisi = $_POST['posisi'];
        $email = $_POST['email'];
        $role = $_POST['role'];

        $sql = "INSERT INTO karyawan (nip, nama, alamat, posisi, username, password, email, role) VALUES (0, '$nama', '', '$posisi', '', '', '$email', '$role')";
        $add = mysqli_query($config, $sql);

        if($add){
            echo "New user successfully added";
            header("location:manage-user.php");
        }
        else{
            echo "ERROR adding new user" ;
        }
    }
?>