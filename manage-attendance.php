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
                    <a href="dashboard-superadmin.php">
                    <i class="bi bi-grid"></i>Dasbor</a>
                </li>
                <li>
                    <a href="#attSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="bi bi-calendar-check"></i>Presensi</a>
                    <ul class="list-unstyled" id="attSubmenu">
                        <li>
                            <a href="attendance-superadmin.php">Presensi Harian</a>
                        </li>
                        <li class="active">
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
                    <b class="menu">Pengaturan Presensi Karyawan</b>
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

            <div class="container manage-attendance">
                <div class="row mt-4">
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-select dropdown-toggle2" type="button" data-toggle="dropdown">Pilih Karyawan
                            <span class="bi bi-caret-down-fill"></span></button>
                            <ul class="dropdown-menu pre-scrollable filter">
                                <input class="form-control" id="filter" type="text" placeholder="Cari..">
                                <div class="dropdown-content">
                                <?php
                                    $q_subt = mysqli_query($config, "SELECT * FROM karyawan ORDER BY nip");
                                    while ($data_subt = mysqli_fetch_array($q_subt)) {
                                ?>                                
                                    <a href="rekap-absen.php?nip=<?php echo $data_subt['nip']; ?>"><?php echo $data_subt['nama']; ?></a>
                                <?php
                                    }
                                ?>                                    
                                </div>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <a target="_blank" href="print.php" class="btn btn-select print" type="button">Cetak Laporan
                            <span class="bi bi-printer-fill"></span></a>
                    </div>
                </div>               
                <div class="col-12 pb-2 pt-4">
                    <div class="card informasi" style="border: none;">
                        <div class="card-header pt-4">
                            <h5 class="card-title">Data Presensi</h5>
                            <text-muted class="card-text">bulan ini</text-muted>
                        </div>
                        <div class="card-body py-0 tabinfo scrollable">
                            <table class="table table-hover declined">
                                <thead>
                                    <tr>
                                        <th>NAMA</th>
                                        <th>POSISI</th>
                                        <th>TANGGAL</th>
                                        <th style="text-align:center;">STATUS KEHADIRAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query = "SELECT absensi.*, karyawan.nama, karyawan.posisi FROM absensi INNER JOIN karyawan ON absensi.nip=karyawan.nip WHERE MONTH(tanggal) = 8";
                                    
                                    $query_run = mysqli_query($config, $query);
                                    while($row = mysqli_fetch_array($query_run)){
                                ?>
                                    <tr>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['posisi']; ?></td>
                                        <td><?php echo $row['tanggal']; ?></td>
                                        <td style="text-align:center;"><?php echo $row['stat']; ?></td>
                                    </tr>
                                    <?php
                                        include 'approve-decline.php';
                                        }
                                    ?> 
                                </tbody>
                            </table>                                
                        </div>
                    </div>
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
        $(document).ready(function(){
            $("#filter").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $(".dropdown-menu a").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>