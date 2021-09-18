<?php
	session_start();
	include("koneksi.php");
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
                <li class="active">
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
                <li>
                    <a href="user-admin.php">
                    <i class="bi bi-person"></i>Profil</a>
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
                        <a href="user-admin.php" class="user"><img src="img/img.png" width="40px" height="40px" alt="">
                        <?=$_SESSION['name'];?></a>
                        <div class="dropdown-content">
                            <a href="user-admin.php" class="profile">Profil</a>
                            <a href="logout.php">Keluar</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row pt-4 pb-2">
                    <div class="col-5">
                        <div class="card informasi" style="border: none;">
                            <div class="card-header pt-4">
                                <h5 class="card-title">Informasi</h5>
                                <text-muted class="card-text">Karyawan yang sedang WFH</text-muted>
                            </div>
                            <div class="card-body py-0 tabinfo scrollable">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>NAMA</th>
                                            <th>POSISI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $query = "SELECT karyawan.nama, karyawan.posisi, absensi.tanggal, absensi.stat FROM absensi INNER JOIN karyawan ON absensi.nip=karyawan.nip WHERE absensi.stat='' AND absensi.tanggal=CURDATE() or absensi.stat='late' AND absensi.tanggal=CURDATE()";
                                        $query_run = mysqli_query($config, $query);
                                        while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                        <tr>
                                            <td><?php echo $row['nama']; ?></td>
                                            <td><text-muted><?php echo $row['posisi']; ?></text-muted></td>
                                        </tr>
                                        <?php
                                            }
                                        ?> 
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                    <div class="col-7 pl-1">
                        <div class="card table-task">
                            <div class="header">
                                    <h5 class="title">Tugas Baru</h5>
                                </div>
                            <div class="card-body tabtask py-0 scrollable">
                                <table class="table w-100">
                                    <thead>
                                        <tr>
                                            <th>JUDUL</th>
                                            <th>DESKRIPSI</th>
                                            <th>DIBUAT</th>
                                            <th>TENGGAT</th>
                                            <th>STATUS</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($config->connect_error){
                                                die("Connection failed: ".$config->connect_error);
                                            }

                                            $query = "SELECT * FROM task WHERE nip = '$_SESSION[id]' AND status = 'Belum dikerjakan'";
                                            $query_run = mysqli_query($config, $query);
                                            while($row = mysqli_fetch_array($query_run)){
                                        ?>
                                        <tr>
                                            <td><?php echo $row['nama_task']; ?></td>
                                            <td><?php echo $row['deskripsi']; ?></td>
                                            <td><?php echo date("d M", strtotime($row['created_at'])); ?></td>
                                            <td><?php echo date("j M", strtotime($row['end_date'])); ?></td>
                                            <td class="indikator"><?php echo $row['status']; ?></td>
                                            <td class="details-btn">
                                                <button type="button" class="btn btn-info detbtn" data-toggle="modal" data-target="#taskModal<?php echo $row['task_id']; ?>">Detail</button>
                                            </td>
                                        </tr>
                                        <?php
                                            include 'details-task.php';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">
                    <div class="col-5 pt-2 d-flex">
                        <div class="card card-body color-card admin">
                            <div class="card-body chart">
                                <h6 class="card-title py-0">Presensi</h6>
                                <text-muted>Rekapitulasi presensi Anda bulan ini</text-muted>                                
                            </div>
                            <div class="divchart">
                                <canvas id="pie" height="100" width="150"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-7 pt-2 d-flex pl-1">
                        <div class="card card-body color-card admin">
                            <div class="card-body chart">
                                <h6 class="card-title py-0">Perkembangan Tugas</h6>
                                <text-muted>Perkembangan tugas Anda</text-muted>
                            </div>
                            <div class="divchart">
                                <canvas id="bar" height="150"></canvas>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="https://github.com/chartjs/Chart.js/releases/download/v2.6.0/Chart.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
                    $hadir = mysqli_query($config, "select * FROM absensi WHERE MONTH(tanggal) = 9 and stat = '' and nip = '$_SESSION[id]'");
                    echo mysqli_num_rows($hadir);
                    ?>,

                    <?php
                    $late = mysqli_query($config, "select * FROM absensi WHERE MONTH(tanggal) = 9 and stat = 'late' and nip = '$_SESSION[id]'");
                    echo mysqli_num_rows($late);
                    ?>,

                    <?php
                    $absen = mysqli_query($config, "select * FROM absensi WHERE MONTH(tanggal) = 9 and stat = 'absent' and nip = '$_SESSION[id]'");
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

    <script>

        <?php 
            $tanggal = '';
            $status = '';

            $sql = mysqli_query($config, "SELECT * FROM task where nip = '$_SESSION[id]' AND status = 'Belum dikerjakan'");
            while($row = mysqli_fetch_array($sql)){
                $rowtanggal = date('d-M', strtotime($row['start_date']));
                $rowstatus = $row['status'];

                $tanggal = $tanggal.'"'.$rowtanggal.'",';
                $status = $status.$rowstatus.',';
            }
        ?>        
        
        var months = ["jan", "feb", "mar", "apr", "mei", "jun", "jul", "ags", "sep", "okt", "nov", "des"]
        
        function dateData(days){
            var d = new Date();
            var tgl =  new Date (d.setDate(d.getDate()+(days)))
            return tgl.getDate()+"-"+ months[tgl.getMonth()]
        }

        var barChartData = {
            // labels: [dateData(-4), dateData(-3), dateData(2), dateData(3), dateData(4), dateData(5)],
            labels: [<?php echo $tanggal; ?>],
            datasets: [
                {
                label: "Belum dikerjakan",
                backgroundColor: "#FF6A6A",
                borderColor: "#FF6A6A",
                borderWidth: 1,
                data: [<?php echo mysqli_num_rows($sql); ?>]
                },
                {
                label: "Dalam pengerjaan",
                backgroundColor: "rgba(255, 206, 86, 1)",
                borderColor: "rgba(255, 206, 86, 1)",
                borderWidth: 1,
                data: [<?php echo mysqli_num_rows($sql); ?>]
                },
                {
                label: "Selesai",
                backgroundColor: "rgba(76, 191, 143, 1)",
                borderColor: "rgba(76, 191, 143, 1)",
                borderWidth: 1,
                data: [<?php echo mysqli_num_rows($sql); ?>]
                }
            ]
        };

        var chartOptions = {
            responsive: true,
            legend: {
                position: "bottom"
                // display:false
            },
            title: {
                display: false,
                text: ""
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    },
                    barPercentage: 0.2,
                    ticks: {
                        maxTicksLimit: 6
                    }
                    // type: 'time',
                    // time: {
                    //     displayFormats: {
                    //         day: 'D'
                    //     }
                    // }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }

        window.onload = function() {
            var ctx = document.getElementById("bar").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: "bar",
                data: barChartData,
                options: chartOptions
            });
        };
    </script>
</body>
</html>
<!-- test push fadhel -->