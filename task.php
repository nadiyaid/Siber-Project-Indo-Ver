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
                    <a href="dashboard.php">
                    <i class="bi bi-grid"></i>Dasbor</a>
                </li>
                <li>
                    <a href="attendance.php">
                    <i class="bi bi-calendar-check"></i>Presensi</a>
                </li>
                <li class="active">
                    <a href="task.php">
                    <i class="bi bi-list-task"></i>Tugas</a>
                </li>
                <li>
                    <a href="user.php">
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
                    <b class="menu">Manajemen Tugas</b>
                </h5>

                <!-- <div class="search-wrapper">
                    <span class="bi bi-search"></span>
                    <input type="search" />
                </div> -->

                <div class="user-wrapper dropdown">
                    <?php
                        include 'user-wrapper.php';
                    ?>
                </div>
            </nav>

            <div class="container">
                <div class="row py-2">
                    <div class="col-md-4 py-3">
                        <div class="header undone-task px-2">
                            <h5>Belum Dikerjakan</h5>
                            <div class="underline"></div>
                            <!-- <a href="#" class="btn" style="border-radius: 50%; margin-left: 10em;margin-top:-10px;padding: 5px 5px; font-size: 15pt; vertical-align: middle;">+</a> -->
                        </div>
                        <div class="card taskundone" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                            <div class="card-body tasklist">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query = "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip=karyawan.nip WHERE status = 'Belum dikerjakan' AND task.nip = '$_SESSION[id]'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <div class="card task1">
                                            <div class="card-body" style="cursor:pointer;" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                                                <div class="d-flex">
                                                    <h5><?php echo $row['nama_task']; ?></h5>
                                                </div>
                                                <p><?php echo $row['deskripsi']; ?></p>
                                            </div>
                                            <div class="card-footer text-muted d-flex">
                                                <?php echo date("j M", strtotime($row['start_date'])); ?> - 
                                                <?php echo date("j M", strtotime($row['end_date'])); ?>

                                                <div class="assign" style="margin-left: auto;" data-toggle="tooltip" title="Ditujukan untuk" data-trigger="hover" data-placement="bottom">
                                                    <!-- <a href="#"class="userPopover"><img src="img/img4.png" alt="" width="30" height="30" style="border-radius: 50%;"></a> -->
                                                    <p><?php echo $row['nama']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php include 'details-task-user.php'; }?>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-md-4 py-3">
                        <div class="header progress-task px-2">
                            <h5>Dalam Pengerjaan</h5>
                            <div class="underline"></div>
                        </div>
                        <div class="card taskundone">
                            <div class="card-body tasklist">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query = "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip=karyawan.nip WHERE status = 'progress' AND task.nip = '$_SESSION[id]'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <div class="card task1">
                                            <div class="card-body" style="cursor:pointer;" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                                                <div class="d-flex">
                                                    <h5><?php echo $row['nama_task']; ?></h5>
                                                </div>
                                                <p><?php echo $row['deskripsi']; ?></p>
                                            </div>
                                            <div class="card-footer text-muted d-flex">
                                                <?php echo date("j M", strtotime($row['start_date'])); ?> - 
                                                <?php echo date("j M", strtotime($row['end_date'])); ?>

                                                <div class="assign" style="margin-left: auto;" data-toggle="tooltip" title="Ditujukan untuk" data-trigger="hover" data-placement="bottom">
                                                    <!-- <a href="#"class="userPopover"><img src="img/img4.png" alt="" width="30" height="30" style="border-radius: 50%;"></a> -->
                                                    <p><?php echo $row['nama']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php include 'details-task-user.php'; }?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 py-3">
                        <div class="header complete-task px-2">
                            <h5>Selesai</h5>
                            <div class="underline"></div>
                        </div>
                        <div class="card taskundone">
                            <div class="card-body tasklist">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query =  "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip=karyawan.nip WHERE status = 'done' AND task.nip = '$_SESSION[id]'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <div class="card task1">
                                            <div class="card-body" style="cursor:pointer;" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                                                <div class="d-flex">
                                                    <h5><?php echo $row['nama_task']; ?></h5>
                                                </div>
                                                <p><?php echo $row['deskripsi']; ?></p>
                                            </div>
                                            <div class="card-footer text-muted d-flex">
                                                <?php echo date("j M", strtotime($row['start_date'])); ?> - 
                                                <?php echo date("j M", strtotime($row['end_date'])); ?>

                                                <div class="assign" style="margin-left: auto;" data-toggle="tooltip" title="Ditujukan untuk" data-trigger="hover" data-placement="bottom">
                                                    <!-- <a href="#"class="userPopover"><img src="img/img4.png" alt="" width="30" height="30" style="border-radius: 50%;"></a> -->
                                                    <p><?php echo $row['nama']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php include 'details-task-user.php'; }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/#wrapper-->

    <script>
        $("#done").click(function() {
            $(this).toggleClass('red');
        });
        jQuery(function($) {
            $('#done').on('click', function() {
                var $el = $(this);
            $el.find('span').toggleClass('bi-check2 bi-x');
        }
    )});
    </script>

    <?php $q = mysqli_query($config, "SELECT karyawan.nama FROM karyawan INNER JOIN task ON karyawan.nip=task.nip WHERE task_id = '2'");
            $data = mysqli_fetch_array($q) ?>
    <script>
        $(document).ready(function(){
            $(".userPopover").attr({
                "data-toggle":"popover",
                "data-content":"user",
                "data-trigger":"focus"
                });
            
            $("[data-toggle=tooltip]").tooltip();
            $("[data-toggle=popover]").popover(); 
        });
    </script>
</body>
</html>