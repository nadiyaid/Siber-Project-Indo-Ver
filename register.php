<?php
session_start();
include('koneksi.php');
	if(isset($_POST['register']))
	{
        $username = $_POST['username'];
		$password = $_POST['pw'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $confirm = $_POST['confirm'];

        $sql = mysqli_query($config, "SELECT * FROM karyawan WHERE nama = '$nama'") or die(mysqli_error($config));
        $check = mysqli_num_rows($sql);

        if($password !== $confirm){
            header("location:register.php?error=Kata sandi tidak cocok");
        }
        
        else if ($password === $confirm and $check>0) {
		
            $query = "UPDATE karyawan SET nama='$nama', username='$username', password=MD5('$password'), email='$email' WHERE nama='$nama'";
            $query_run = mysqli_query($config, $query) or die(mysqli_error($config));

			header("location:register.php?success=Pendaftaran berhasil");
        }

        else{
            header("location:register.php?error=Nama pengguna tidak ditemukan. Harap hubungi admin");
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
<body>
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

    <div class="register">
        <div class="content shadow p-3">
            <div class="title">
                <h3>Buat akun baru</h3>
            </div>

            <form action="" method="post">
                <?php
                    if(isset($_GET['error'])){
                ?>
                <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?=$_GET['error']?>
                </div>
                <?php
                    }
                    else if(isset($_GET['success'])){
                ?>
                <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </div>
                <?php }?>

                <div class="form-group">
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
                </div>

                <div class="form-group">
                <input type="text" name="username" class="form-control " placeholder="Nama Pengguna" required>
                </div>

                
                <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group">
                <input type="password" name="pw" class="form-control" placeholder="Kata Sandi" required>  
                </div>

                <div class="form-group">
                <input type="password" name="confirm" class="form-control" placeholder="Confirm Password" required>
                </div>

                <input type="submit" class="login" value="Daftar" name="register"></input>
                <div id="register">
                    Sudah punya akun? <a class="underlineHover" href="login.php">Silahkan Masuk</a>
                </div>
            </form>	
        </div>
    </div>
</body>
</html>