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

    <script src="js/daypilot/daypilot-all.min.js"></script>
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
                <li class="active">
                    <a href="dashboard-superadmin.php">
                    <i class="bi bi-grid"></i>Dasbor</a>
                </li>
                <li>
                    <a href="#attSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="bi bi-calendar-check"></i>Presensi</a>
                    <ul class="collapse list-unstyled" id="attSubmenu">
                        <li>
                            <a href="attendance-superadmin.php">Presensi Harian</a>
                        </li>
                        <li>
                            <a href="manage-attendance.php">Pengaturan Presensi Karyawan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="profile-superadmin.php">
                    <i class="bi bi-person"></i>Profil</a>
                </li>
                <li>
                    <a href="manage-user.php">
                    <i class="bi bi-people"></i>Pengaturan Karyawan</a>
                </li>
                <li>
                    <a href="logout.php">
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
                    <b class="menu">Dasbor</b>
                </h5>

                <!-- <div class="search-wrapper">
                    <span class="bi bi-search"></span>
                    <input type="search" />
                </div> -->

                <div class="user-wrapper dropdown">
                    <div>
                        <a href="profle-superadmin.php" class="user"><img src="img/img.png" width="40px" height="40px" alt="">
                        <?=$_SESSION['name'];?></a>
                        <div class="dropdown-content">
                            <a href="profile-superadmin.php" class="profile">Profil</a>
                            <a href="logout.php">Keluar</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row pt-4 pb-2">
                    <div class="col-7">
                        <div class="card informasi" style="border: none;">
                            <div class="card-header pt-4">
                                <h5 class="card-title">Informasi</h5>
                                <text-muted class="card-text">Karyawan yang WFH</text-muted>
                            </div>
                            <div class="card-body py-0 tabinfo">
                                <table class="table table-hover approved">
                                    <thead>
                                        <tr>
                                            <th>NAMA</th>
                                            <th>POSISI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "SELECT karyawan.*, absensi.* FROM absensi INNER JOIN karyawan ON absensi.nip=karyawan.nip WHERE absensi.stat='' AND absensi.tanggal=CURDATE() or absensi.stat='late' AND absensi.tanggal=CURDATE()";
                                        $query_run = mysqli_query($config, $query);
                                        while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                        <tr>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><text-muted><?php echo $row['posisi']; ?></text-muted></td>
                                            <td class="details-btn">
                                                <button type="button" class="btn btn-info detbtn" data-toggle="modal" data-target="#editPresensi<?php echo $row['absen_id']; ?>">Ubah</button>
                                            </td>
                                        </tr>
                                        <?php
                                            include 'edit-presensi.php';
                                            }
                                        ?> 
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-5 pl-1 d-flex">
                        <div class="card approval flex-fill">
                            <h6 class="card-header">Kalender</h6>
                                <div class="card-body chart">
                                <div id="nav" style="margin: 0 auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row px-0 pb-3">
                    <div class="col-7 mt-1 pt-2">
                        <div class="card informasi color-card superadmin">
                            <div class="card-header pt-4">
                                <h6 class="card-title">Presensi</h6>
                                <text-muted class="card-text">Karyawan dalam seminggu</text-muted>
                            </div>
                            <div class="divchart">
                                <canvas id="pie" height="100" width="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-7 mt-1 pt-2 d-flex">
                        <div class="card card-body color-card superadmin">
                            <div class="card-body chart">
                                <h6 class="card-title">Presensi</h6>
                                <text-muted>Karyawan dalam seminggu</text-muted>
                            </div>
                            <div class="divchart">
                                <canvas id="pie" height="100" width="200"></canvas>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
    <!--/#wrapper-->

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/wordcloud.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/wordcloud.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <script>
        // Pie Chart
        var ctx = document.getElementById('pie').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'pie',
            backgroundColor: '#6a6a6a',
        
            // The data for our dataset
            data: {
                labels: ['hadir', 'terlambat', 'absen'],
                datasets: [{
                    label: 'Presensi',
                    data: [
                    <?php
                    $hadir = mysqli_query($config, "select * FROM absensi WHERE MONTH(tanggal) = 9 and stat = ''");
                    echo mysqli_num_rows($hadir);
                    ?>,

                    <?php
                    $late = mysqli_query($config, "select * FROM absensi WHERE MONTH(tanggal) = 9 and stat = 'late'");
                    echo mysqli_num_rows($late);
                    ?>,

                    <?php
                    $absen = mysqli_query($config, "select * FROM absensi WHERE MONTH(tanggal) = 9 and stat = 'absent'");
                    echo mysqli_num_rows($absen);
                    ?>
                    ],
                    backgroundColor: ['#79D2DE','#FFC83A', '#FF6A6A'],
                    borderColor: ['#79D2DE','#FFC83A', '#FF6A6A']
                }]
            },
        
            // Configuration options go here
            options: {
                legend:{
                    display: true,
                    position: 'bottom',
                    labels:{
                        fontSize: 11,
                        boxWidth: 10,
                    }
                }
            }
        });
    </script>

    <script type="text/javascript">

        var nav = new DayPilot.Navigator("nav");
        nav.showMonths = 1;
        nav.skipMonths = 1;
        nav.onTimeRangeSelected = function (args) {
        dp.startDate = args.day;
        dp.update();
        loadEvents();
        };
        nav.init();

    </script>
</body>
</html>