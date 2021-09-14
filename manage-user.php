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
                    <ul class="collapse list-unstyled" id="attSubmenu">
                        <li>
                            <a href="attendance-superadmin.php">Presensi Harian</a>
                        </li>
                        <li>
                            <a href="manage-attendance.php">Presensi Karyawan</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="profile-superadmin.php">
                    <i class="bi bi-person"></i>Profil</a>
                </li>
                <li class="active">
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
                    <b class="menu">Data Karyawan</b>
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

            <div class="container user-list">
                <div class="row table-user">
                    <div class="col-12 mt-4 py-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="header">
                                    <h5 class="title">Karyawan</h5>
                                </div>

                                <div class="createbtn">
                                    <a href="add-user.php" class="btn addbtn" data-toggle="modal" data-target="#addUser">Tambah Baru</a>
                                </div>

                                <table class="table" id="tblUsr">
                                    <thead>
                                        <tr>
                                            <th>NIP</th>
                                            <th>NAMA</th>
                                            <th>POSISI</th>
                                            <th>EMAIL</th>
                                            <th>HAK AKSES</th>
                                            <th style="text-align: center;">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $connection = mysqli_connect("localhost", "root", "", "kehadiran");

                                        if($connection->connect_error){
                                            die("Connection failed: ".$connection->connect_error);
                                        }

                                        $query = "SELECT * FROM karyawan ORDER BY nip DESC";
                                        $query_run = mysqli_query($connection, $query);
                                        while($row = mysqli_fetch_array($query_run)){
                                    ?>
                                        <tr>
                                            <td> <?php echo $row['nip']; ?></td>
                                            <td> <?php echo $row['nama']; ?></td>
                                            <td> <text-muted> <?php echo $row['posisi']; ?></text-muted></td>
                                            <td> <?php echo $row['email']; ?></td>
                                            <td> <?php echo $row['role']; ?></td>
                                            <td style="text-align: center;" class="details-btn">
                                                <button data-toggle="modal" data-target="#editUser<?php echo $row['nip']; ?>" class="btn btn-info detbtn">Ubah</button>

                                                <a href="del-user.php?nip=<?php echo $row['nip']; ?>" class="btn delbtn" onClick="javascript:hapus($(this));return false;">Hapus</a>
                                                 
                                                <script>
                                                    function hapus(anchor) {
                                                        var r = confirm("Apakah Anda yakin ingin menghapus data ini?");
                                                        if (r) {
                                                            window.location=anchor.attr("href");
                                                        }
                                                    }   
                                                </script>
                                            </td>
                                        </tr>
                                        <?php
                                            include 'edit-user.php';
                                            }
                                        ?>                                 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

<!------------------- Add user modal ----------------------->
                <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah User Baru</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="add-user.php" method="POST">
                                <div class="modal-body">
                                    <div class="alert alert-success d-none success"></div>
                                    <div class="alert alert-danger d-none error"></div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-2">Nama</label>
                                        <div class="col-10">
                                            <input class="form-control" type="text" name="nama" id="nama" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-2">Posisi</label>
                                        <div class="col-10">
                                            <select class="form-control" name="posisi" id="posisi" required>
                                                <option value=""></option>
                                                <option value="IT Manager">IT Manager</option>
                                                <option value="Front End">Front End</option>
                                                <option value="Back End">Back End</option>
                                                <option value="Mobile Apps Developer">Mobile Apps Developer</option>
                                                <option value="Data Science">Data Science</option>
                                                <option value="IT Support">IT Support</option>
                                                <option value="Human Resource">Human Resource</option>
                                                <option value="Graphic Design">Graphic Design</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-2">Email</label>
                                        <div class="col-10">
                                            <input class="form-control" type="email" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-2">Hak Akses</label>
                                        <div class="col-10">
                                            <select class="form-control" name="role" id="role" required>
                                                <option value=""></option>
                                                <option value="superadmin">Superadmin</option>
                                                <option value="admin">Admin</option>
                                                <option value="user">User</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="add" class="btn btn-info">Tambah</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<!------------------- End Add user modal ----------------------->
            </div>
        </div>
    </div>
    <!--/#wrapper-->

    <script>
        // $(document).ready(function(){
        //     $('.detbtn').on('click', function(){
        //         $('#editUser').modal('show');

        //             $tr = $(this).closest('tr');
                    
        //             var data = $tr.children("td").map(function(){
        //                 return $(this).text();
        //             }).get();
                    
        //             console.log(data);

        //             $('#nama').val(data[0]);
        //             $('#posisi').val(data[1]);
        //             $('#email').val(data[2]);
        //             $('#role').val(data[3]);
        //     });
        // });
    </script>

    <script>
        $(document).ready(function() {
            $('#tblUsr').DataTable({
                responsive: true,
                "pageLength": 5,
                "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ],
                "order": [[ 0, "desc" ]]
            });
        } );
    </script>
</body>
</html>