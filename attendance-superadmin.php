<?php
    include("koneksi.php");
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    
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
                    <ul class="dropdown list-unstyled" id="attSubmenu">
                        <li class="active">
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
                    <b class="menu">Presensi Super Admin</b>
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

            <div class="container attendance">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body d-flex">                            
                                <a href="add-request-query.php" type="button" class="btn btn-info btn-request" data-toggle="modal" data-target="#requestModal">
                                    <div class="maintext">Permohonan</div>
                                    <div class="subtext">untuk izin</div>
                                </a>
                                <a href="add-absen.php" id="hide" type="button" class="btn btn-checkin" name="checkin">Masuk</a>
                                <a href="add-absen-out.php" onclick="checkout()" type="button" class="btn btn-danger btn-checkout" >Keluar</a>

                                <script>
                                    function checkout(anchor) {
                                        var r = confirm("Apakah Anda yakin ingin keluar?");
                                        if (r) {
                                            window.location=anchor.attr("href");
                                        }
                                    }   
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row table-attendance">
                    <div class="col-12 mt-4 py-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="header">
                                    <h5 class="title">Presensi Harian</h5>
                                    <text-muted>selama satu minggu</text-muted>
                                </div>
                                <table class="table" id="tblAtt">
                                    <thead>
                                        <tr>
                                            <th>TANGGAL</th>
                                            <th>JAM MASUK</th>
                                            <th>JAM KELUAR</th>
                                            <th>JAM KERJA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        if($config->connect_error){
                                            die("Connection failed: ".$config->connect_error);
                                        }

                                        $query = "SELECT tanggal, waktu_masuk, waktu_pulang, date_format(jam_kerja, '%H:%i') as jam_kerja FROM absensi WHERE nip = '$_SESSION[id]'";
                                        $query_run = mysqli_query($config, $query);
                                        while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                        <tr>
                                            <td><?php $tgl = $row['tanggal'];
                                                echo date("d-M", strtotime($tgl));
                                                ?>
                                            </td>
                                            <td><?php echo $row['waktu_masuk']; ?></td>
                                            <td><?php echo $row['waktu_pulang']; ?></td>
                                            <td><?php echo $row['jam_kerja']; ?> Jam</td>
                                        </tr>
                                        
                                    <?php
                                            $keluar = $row['waktu_pulang'];
                                            $time = $row['waktu_masuk'];
                                            $current_time = date('H:i:s');

                                            if($current_time >= date('H:i:s', strtotime($time.'+9 hours')) && $keluar == null){
                                                $masuk = date('H:i:s', strtotime($row['waktu_masuk'].'+9 hours'));
                                                $sql = "UPDATE absensi SET waktu_pulang = '$masuk', jam_kerja = TIMEDIFF(waktu_pulang, waktu_masuk), updated_at = CURRENT_TIMESTAMP WHERE waktu_pulang is null AND nip = '$_SESSION[id]'";
                                                $update = mysqli_query($config, $sql) or die(mysqli_error($config));
                                            }
                                        }
                                    ?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Permohonan izin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="add-request-query.php" method="POST">
                                <div class="modal-body">                       
                                    <div class="fromdate">
                                        <input type="date" class="form-control" id="recipient-name" name="reqdate" readonly value="<?php echo date('Y-m-j'); ?>" hidden>
                                    </div>         
                                    <label class="col-form-label">Permohonan untuk:</label>
                                    <div class="form-group radio">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="1" required>
                                            <label class="form-check-label">
                                                Izin
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="2">
                                            <label class="form-check-label">
                                                Sakit
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="3">
                                            <label class="form-check-label">
                                                Cuti
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" value="4">
                                            <label class="form-check-label">
                                                Unpaid
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Alasan:</label>
                                        <textarea class="form-control" id="message-text" name="keterangan" required></textarea>
                                    </div>
                                    <div class="form-group d-flex req-date">
                                        <div class="fromdate">
                                            <label class="col-form-label">Dari:</label>
                                            <input type="date" class="form-control" id="recipient-name" name="from">
                                        </div>
                                        <div class="todate">
                                            <label class="col-form-label">Sampai:</label>
                                            <input type="date" class="form-control" id="recipient-name" name="to">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Pengganti:</label>
                                        <select class="form-control" name="pengganti" required>
                                        <option selected class="selected"></option>
                                        <?php
                                            $q_subt = mysqli_query($config, "SELECT * FROM karyawan");
                                            while ($data_subt = mysqli_fetch_array($q_subt)) {
                                        ?>                         
                                            <option value="<?php echo $data_subt['nama']; ?>"><?php echo $data_subt['nama']; ?></option>
                                        <?php
                                            }  
                                        ?>
                                        </select>
                                    </div>                                
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-primary" name="request">Ajukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/#wrapper-->

    <script>
    $('a#hide').click(function() {
        $('td:nth-child(3)').hide();
        $('td:nth-child(4)').hide();
        });
    </script>
    
    <script>
        $(document).ready(function() {
            $('#tblAtt').DataTable({
                responsive: true,
                "pageLength": 5
            });
        } );
    </script>
</body>
</html>