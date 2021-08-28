<?php
include('koneksi.php');

    if(isset($_POST['reset'])){
        $username = $_POST['username'];
        $password = $_POST['pw'];
        $password = md5($password);

        $sql = mysqli_query($config, "SELECT * FROM karyawan WHERE username = '$username'") or die(mysqli_error($config));
        $check = mysqli_num_rows($sql);

        if($check == 0){
            header("location:forgot-password.php?error=Username tidak ditemukan!");
        }

        else{
            $sql = mysqli_query($config, "UPDATE karyawan SET password = '$password' WHERE username='$username'") or die(mysqli_error($config));
            header("location:forgot-password.php?success=Kata sandi berhasil diubah");
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Attendance and Task Management</title>

    <!-- bootstrap css cdn -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body background="img/bg.png">
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
     <!-- JavaScript Bundle with Popper -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

     <!-- bootstrap js -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <div class="header-logo py-3 px-2">
        <a href="#"><h2>
            <img src="img/logo-siber.png" alt="logo" width="150" height="65" class="logo">
        </a>
    </div>

    <div class="login-wrapper">
        <div class="content shadow p-3">
            <div class="title">
                <h2>Ubah Kata Sandi</h2>
                <p>Masukkan nama pengguna anda</p>
            </div>

            <form action="" method="POST">
                <?php
                    if(isset($_GET['error'])){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?=$_GET['error']?>
                </div>
                <?php
                    }
                    else if(isset($_GET['success'])){
                ?>
                <div class="alert alert-success" role="alert">
                        <?=$_GET['success']?>
                </div>
                <?php }?>
                <input type="text" name="username" class="input " placeholder="Nama Pengguna" required>
                <input type="password" name="pw" class="input" placeholder="Kata sandi baru" required>
                <input type="submit" class="login" value="Ubah Kata Sandi" name="reset"></input>
                <div id="back">
                    <a class="underlineHover" href="login.php"><span class= "bi bi-arrow-left"> Kembali ke Halaman Awal</span></a>
                </div>
            </form>	
        </div>
    </div>
</body>
</html>