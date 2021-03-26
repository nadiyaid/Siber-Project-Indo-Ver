<?php
session_start();
include('koneksi.php');
	if(isset($_POST['loginbtn']))
	{
		$username = $_POST['username'];
		$password = $_POST['pw'];
        $password = md5($password);
	
		$query = "SELECT * FROM karyawan WHERE username='$username' AND password='$password'";
		$query_run = mysqli_query($config, $query);
        $role = mysqli_fetch_array($query_run);

		if($role['role'] == "admin"){
			$_SESSION['username'] = $username;
            $_SESSION['id'] = $role['nip'];
            $_SESSION['name'] = $role['nama'];
            $_SESSION['position'] = $role['posisi'];
			header("location:dashboard-admin.php");
		}
        else if($role['role'] == "user"){
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $role['nip'];
            $_SESSION['name'] = $role['nama'];
            $_SESSION['position'] = $role['posisi'];
            header("location:dashboard.php");
        }
        else if($role['role'] == "superadmin"){
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $role['nip'];
            $_SESSION['name'] = $role['nama'];
            $_SESSION['position'] = $role['posisi'];
            header("location:dashboard-superadmin.php");
        }
		else
		{
			header("location:login.php?error=Username atau Kata sandi salah");
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

    <div class="login-wrapper">
        <div class="content shadow p-3">
            <div class="title">
                <h2>Halo</h2>
                <p>Silahkan masuk</p>
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
                ?>
                <input type="text" name="username" class="input " placeholder="Nama pengguna" required>
                <input type="password" name="pw" class="input" placeholder="Kata sandi" required>
                <div id="login-forgot">
                    <a class="underlineHover" href="forgot-password.php">Lupa kata sandi?</a>
                </div>
                <input type="submit" class="login" value="Masuk" name="loginbtn"></input>
                <div id="register">
                    Tidak punya akun? <a class="underlineHover" href="register.php">Daftar di sini</a>
                </div>
            </form>	
        </div>
    </div>
</body>
</html>