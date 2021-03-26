<?php
    include 'koneksi.php';
    session_start();
    include 'validation.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

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

     <script type="text/javascript">
        $(document).ready(function () {
   
           $('#sidebarCollapse').on('click', function () {
               $('#sidebar').toggleClass('active');
           });
       
       });
       </script>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="#">
                    <img src="img/logo.png" alt="logo" width="190" height="80" class="logo">
                </a>
                <strong>SDMN</strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="dashboard-admin.php">
                    <i class="bi bi-grid"></i>Dasbor</a>
                </li>
                <li>
                    <a href="attendance-admin.php">
                    <i class="bi bi-calendar-check"></i>Presensi</a>
                </li>
                <li>
                    <a href="task-admin.php">
                    <i class="bi bi-list-task"></i>Tugas</a>
                </li>
                <li class="active">
                    <a href="user-admin.php">
                    <i class="bi bi-person"></i>Profil</a>
                </li>
                <li>
                    <a href="login.php">
                    <i class="bi bi-power"></i>Keluar</a>
                </li>
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <div class="w-100" id="main-content">
            <nav class="navbar">
                <h5>
                    <button type="button" id="sidebarCollapse" class="btn">
                        <span class="bi bi-list"></span>
                    </button>
                    <b class="menu">Profil Saya</b>
                </h5>

                <!-- <div class="search-wrapper">
                    <span class="bi bi-search"></span>
                    <input type="search" />
                </div> -->

                <div class="user-wrapper dropdown">
                    <div>
                        <a href="user-admin.php" class="user"><img src="img/img.png" width="40px" height="40px" alt="">
                        <?=$_SESSION['name'];?></a>
                        <div class="dropdown-content">
                            <a href="user-admin.php" class="profile">Profil</a>
                            <a href="logout.php">Keluar</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="user-content">
                <div class="container-fluid">
                    <div class="row mt-2" style="justify-content:center;">
                        <div class="col-5">
                        <?php if(isset($_GET['success'])){ ?>
                            <div class="alert alert-success alert-dismissible" style="position:absolute;z-index:10;margin:auto;">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $_GET['success']; ?>
                            </div>
                         <?php } ?>
                         </div>
                    </div>
                    <div class="row pt-2">                        
                        <div class="col-md-8 py-5">
                            <div class="card px-3">
                                <div class="header">
                                    <h5 class="title">Ubah Profil</h5>
                                </div>
                                <div class="user-content">
                                    <?php 
                                            if($config->connect_error){
                                                die("Connection failed: ".$config->connect_error);
                                            }

                                            $query = "SELECT * FROM karyawan WHERE nip = '$_SESSION[id]'";
                                            $query_run = mysqli_query($config, $query);
                                            while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                    <form class="py-2" action="update-profile-admin.php" method="POST">
                                        <div class="row py-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="hidden" class="form-control" name="nip" value="<?php echo $row['nip'];?>">
                                                    <input type="text" class="form-control" required placeholder=" " name="username" value="<?php echo $row['username']; ?>">
                                                    <div class="underline"></div>
                                                    <label class="disabled">Nama Pengguna</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder=" " name="email" value="<?php echo $row['email'];?>">
                                                    <div class="underline"></div>
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="password" class="form-control" required placeholder=" " name="password">
                                                    <div class="underline"></div>
                                                    <label>Kata Sandi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder=" " required name="nama" value="<?php echo $row['nama'];?>">
                                                    <div class="underline"></div>
                                                    <label>Nama</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" readonly placeholder=" " name="posisi" value="<?php echo $row['posisi'];?>" style="cursor:text;">
                                                    <div class="underline"></div>
                                                    <label>Posisi</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-select" disabled style="cursor: unset;" name="role">
                                                        <option value="<?php echo $row['role'];?>"><?php echo $row['role'];?></option>
                                                        <option value="superadmin">Super Admin</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                    <div class="underline"></div>
                                                    <label>Hak Akses</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder=" " name="alamat" value="<?php echo $row['alamat'];?>">
                                                    <div class="underline"></div>
                                                    <label>Alamat</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" name="updateprofile" class="btn btn-info">Ubah Profil</button>
                                    </form>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php
                            require 'koneksi.php';
                            $query = mysqli_query($config, "SELECT * FROM karyawan WHERE nip = '$_SESSION[id]'") or die(mysqli_error());
                            while($row = mysqli_fetch_array($query)){
                        ?>
                        <div class="col-md-4 py-5">
                            <div class="card h-100" style="text-align: center;">
                                <div class="card-body userinfo">
                                    <img src="img/img.png" class="img-fluid rounded-circle mb-3" alt="">
                                    <h4><?php echo $row['nama'];?> / <?php echo $row['username']; ?></h4>
                                    <h5 class="card-text"><?php echo $row['posisi'];?></h5>
                                    <p>Tentang</p>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!--/#wrapper-->
</body>
</html>