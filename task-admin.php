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
                <li class="active">
                    <a href="task-admin.php">
                    <i class="bi bi-list-task"></i>Tugas</a>
                </li>
                <li>
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
                    <b class="menu">Manajemen Tugas Admin</b>
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
                            <a href="#" class="btn newtask" data-toggle="modal" data-target="#newTask"><span class="bi bi-plus-circle"></span></a>
                        </div>
                        <div class="card taskundone scrollable">
                            <div class="card-body tasklist">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query = "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip=karyawan.nip WHERE status = 'Belum dikerjakan'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <div class="card task1">
                                            <div class="card-body" style="cursor:pointer;" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                                                <div class="d-flex">
                                                    <h5><?php echo $row['nama_task']; ?></h5>
                                                    <a class="deltask" href="del-task.php?task_id=<?php echo $row['task_id']; ?>"onClick="javascript:hapus($(this));return false;"><span class="bi bi-x"></span></a>

                                                    <script>
                                                        function hapus(anchor) {
                                                            var r = confirm("Apakah Anda yakin ingin menghapus tugas ini?");
                                                            if (r) {
                                                                window.location=anchor.attr("href");
                                                            }
                                                        }   
                                                    </script>
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
                                <?php include 'details-task.php'; }?>
                                <div class="add-task mt-2">
                                    <a href="#" class="btn btn-newtask" data-toggle="modal" data-target="#newTask">+ Tugas Baru</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tugas Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="add-new-task.php" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama Tugas:</label>
                                            <input class="form-control" type="text" name="nama_task" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Deskripsi:</label>
                                            <textarea class="form-control" id="message-text" name="deskripsi" required></textarea>
                                        </div>
                                        <div class="form-group d-flex req-date">
                                            <div class="fromdate">
                                                <label class="col-form-label">Tanggal Mulai:</label>
                                                <input type="date" class="form-control" name="start_date">
                                            </div>
                                            <div class="todate">
                                                <label class="col-form-label">Tenggat Waktu:</label>
                                                <input type="date" class="form-control" name="end_date">
                                                <input type="time" class="form-control" name="end_time">
                                            </div>                           
                                        </div>
                                        <div class="form-group">
                                            <label>Ditujukan untuk:</label>
                                            <select class="form-control" name="user" required>
                                            <option selected class="selected"></option>
                                            <?php
                                                $q_subt = mysqli_query($config, "SELECT * FROM karyawan");
                                                while ($data_subt = mysqli_fetch_array($q_subt)) {
                                            ?>
                                                <option value="<?php echo $data_subt['nip']; ?>"><?php echo $data_subt['nama']; ?></option>
                                            <?php
                                                }  
                                            ?>
                                            </select>
                                        </div>                                
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary" name="addtask">Tambah Tugas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-3">
                        <div class="header progress-task px-2">
                            <h5>Dalam Pengerjaan</h5>
                            <div class="underline"></div>
                        </div>
                        <div class="card taskundone scrollable">
                            <div class="card-body tasklist">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query =  "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip=karyawan.nip WHERE status = 'Dalam pengerjaan'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <div class="card task1">
                                            <div class="card-body" style="cursor:pointer;" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                                                <div class="d-flex">
                                                    <h5><?php echo $row['nama_task']; ?></h5>
                                                    <a class="deltask" href="del-task.php?task_id=<?php echo $row['task_id']; ?>" onClick="javascript:hapus($(this));return false;"><span class="bi bi-x"></span></a>

                                                    <script>
                                                        function hapus(anchor) {
                                                            var r = confirm("Apakah Anda yakin ingin menghapus tugas ini?");
                                                            if (r) {
                                                                window.location=anchor.attr("href");
                                                            }
                                                        }   
                                                    </script>
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
                                <?php include 'details-task.php'; }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-3">
                        <div class="header complete-task px-2">
                            <h5>Selesai</h5>
                            <div class="underline"></div>
                        </div>
                        <div class="card taskundone scrollable">
                            <div class="card-body tasklist">
                                <?php
                                    if($config->connect_error){
                                        die("Connection failed: ".$config->connect_error);
                                    }

                                    $query =  "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip=karyawan.nip WHERE status = 'Selesai'";
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                <div class="row pb-2">
                                    <div class="col-12">
                                        <div class="card task1">
                                            <div class="card-body" style="cursor:pointer;" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">
                                                <div class="d-flex">
                                                    <h5><?php echo $row['nama_task']; ?></h5>
                                                    <a class="deltask" href="del-task.php?task_id=<?php echo $row['task_id']; ?>" onClick="javascript:hapus($(this));return false;"><span class="bi bi-x"></span></a>

                                                    <script>
                                                        function hapus(anchor) {
                                                            var r = confirm("Apakah Anda yakin ingin menghapus tugas ini?");
                                                            if (r) {
                                                                window.location=anchor.attr("href");
                                                            }
                                                        }   
                                                    </script>
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
                                <?php include 'details-task.php'; }?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- should insert in details-task.php -->
                <?php
                    // if($config->connect_error){
                    //     die("Connection failed: ".$config->connect_error);
                    // }

                    // $query = "SELECT task.*, karyawan.nama FROM task INNER JOIN karyawan ON task.nip = karyawan.nip WHERE task_id = '$row[task_id]'";
                    // $query_run = mysqli_query($config, $query);
                    // while($row = mysqli_fetch_array($query_run)){
                ?>
                <!-- <div class="timeline">
                    <p style="line-height:0px;" class="pt-3"><?php echo $row['created_by'];?> created this task</p>
                    <p class="tm"><?php echo $row['created_at']; ?></p>
                    <p style="line-height:10px;" class="pt-3">You edited status to <?php echo $row['status']; ?></p>
                    <p class="tm"><?php echo $row['updated_at']; ?></p> -->
                </div>
                <?php //} ?>
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
                "data-content":"<?php echo $data['nama']; ?>",
                "data-trigger":"focus"
                });
            
            $("[data-toggle=tooltip]").tooltip();
            $("[data-toggle=popover]").popover(); 
        });
    </script>

    <script>
        $(document).ready(function() {
        $('.assignto').popover({
            html: true,
            content: function() {
            return $('#popover-content').html();
            }
        });
        });
    </script>
</body>
</html>