<?php header ("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename= Laporan Presensi.xls");
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
                            <h5 class="card-title">Data Presensi</h5>
                            <text-muted class="card-text">bulan ini</text-muted>
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
    
</body>
</html>