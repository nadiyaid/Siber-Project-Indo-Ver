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
                    <b class="menu">Perbarui Data Tugas</b>
                </h5>

                <!-- <div class="search-wrapper">
                    <span class="bi bi-search"></span>
                    <input type="search" />
                </div> -->

                <div class="user-wrapper dropdown">
                    <?php include 'user-wrapper.php';?>
                </div>
            </nav>

            <div class="container">
                <div class="row py-3 justify-content-center">
                    <div class="col-8">
                        <div class="card update-task pt-2">
                            <div class="card-body">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query = "SELECT* FROM task WHERE task_id = '$_GET[task_id]'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <form action="update-task-user-query.php" method="POST">
                                    <input type="hidden" class="form-control" name="task_id" value="<?php echo $row['task_id'];?>">
                                    <div class="task-header d-flex">
                                        <h5 class="font-weight-bold"><?php echo $row['nama_task']; ?></h5>
                                        <div class="created" style="margin-left:auto;">
                                            <span class="bi bi-calendar-date"><text-muted> <?php echo date("l, d M Y", strtotime($row['created_at']));?></span><text-muted> oleh <?php echo $row['created_by']; ?></text-muted>
                                        </div>
                                        
                                        <!-- <button type="button" id="done" class="btn-cancel tooltip-test" title="Mark as Done">
                                            <span class="bi bi-check2 "></span>
                                        </button> -->
                                    </div>
                                    <p class="tooltip-test" title="Task Description"></p>
                                    <div class="form-group deskripsi">
                                        <textarea class="form-control a" name="deskripsi"><?php echo $row['deskripsi']; ?></textarea>
                                    </div>
                                    <div class="form-group d-flex task-date">
                                        <div class="fromdate">
                                            <label class="col-form-label">Tanggal mulai:</label>
                                            <input type="date" class="form-control" id="task-date" name="from" value="<?php echo $row['start_date'];?>">
                                        </div>
                                        <div class="todate">
                                            <label class="col-form-label">Tenggat waktu:</label>
                                            <div class="datetime d-flex">
                                                <input type="date" class="form-control" id="task-date" name="todate" value="<?php echo $row['end_date'];?>">

                                                <input type="time" class="form-control mx-2" id="task-date" name="totime" value="<?php echo $row['end_time'];?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment">
                                        <label>Komentar</label>
                                        <textarea class="form-control" placeholder="Updated task details (optional)"></textarea>
                                    </div>
                                    <div class="update-progress d-flex py-2">
                                        <label class="pr-2">Persentase :</label>
                                        <input type="number" class="form-control" name="progress" value="<?php echo $row['percentage']; ?>">%
                                    </div>
                                    <div class="selstatus d-flex py-2">
                                        <label class="pr-2">Status:</label>
                                        <div class="col-3">
                                            <select class="form-control" name="status">
                                                <option value="<?php echo $row['status'];?>"><?php echo $row['status'];?></option>
                                                <option value="Belum dikerjakan">Belum dikerjakan</option>
                                                <option value="Dalam pengerjaan">Dalam pengerjaan</option>
                                                <option value="Selesai">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="button-footer d-flex px-5">
                                        <a href="javascript:history.go(-1)" class="btn btn-close">Tutup</a>
                                        <button type="submit" name="updatetask" class="btn btn-primary" onclick="update()">Perbarui</button>
                                        <script>
                                            function update(){
                                                alert ("Successfully updated!");
                                            }
                                        </script>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!--/#wrapper-->

    <!-- <script>
        $("#done").click(function() {
            $(this).toggleClass('red');
        });
        jQuery(function($) {
            $('#done').on('click', function() {
                var $el = $(this);
            $el.find('span').toggleClass('bi-check2 bi-x');
        }
    )});
    </script> -->
</body>
</html>