<?php 
include 'config/proses.php';
session_start();
if(!isset($_SESSION['nama'], $_SESSION['level'], $_SESSION['code'])){
    header("Location: ../index.php");
    exit();
}

// $list_anggota = new Show_anggota();
// $anggota = $list_anggota->view_anggota();

$nama_anggota = "";
$ponsel_anggota = "";
$email_anggota = "";
$tgl_lahir = "";
$alamat = "";
$id = "";
if(isset($_GET['cari']) && !empty($_GET['cari'])){
    $cari = $_GET['cari'];
    $db = database::connect();
    $query = $db->prepare("SELECT * FROM cash_anggota WHERE nama_anggota LIKE :nama_anggota or ponsel_anggota LIKE :nomer or email_anggota LIKE :email");
    $query->bindValue(":nama_anggota", '%' . $cari . '%' , PDO::PARAM_STR);
    $query->bindValue(":nomer", '%' . $cari . '%' , PDO::PARAM_STR);
    $query->bindValue(":email", '%' . $cari . '%' , PDO::PARAM_STR);
    $query->execute();
        if($query->rowCount() > 0){
            $all_anggota = $query->fetch(PDO::FETCH_ASSOC);
                $nama_anggota = $all_anggota['nama_anggota'];
                $ponsel_anggota = $all_anggota['ponsel_anggota'];
                $email_anggota = $all_anggota['email_anggota'];
                $tgl_lahir = $all_anggota['tgl_lahir'];
                $alamat = $all_anggota['alamat_anggota'];
                $id = $all_anggota['id_anggota'];
        }else{
            echo "<script>alert('Tidak ada data!'); 
                          document.location.href = 'lihat.php';</script>";

        }
}else{
    header("Location: lihat.php");
    exit();
}




 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cash-ORG</title>
    <!-- 
        *** CREATE ON : 16-MARET-2021
        *** LAUNCHING : 06-APRIL-2021
        *** SCRIPT    : FECORE
        *** FREE AND OPEN SOURCE

    -->

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-money-bill-alt"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Cash<sup>org</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Anggota
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-user fa-cog"></i>
                    <span>Manajemen Anggota</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="tambah_anggota.php">Tambah Anggota</a>  
                        <a class="collapse-item" href="daftar_anggota.php">Daftar Anggota</a> 
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Menu Keuangan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Manajemen Keuangan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="setor_uang.php">Setor Uang</a>
                        <a class="collapse-item" href="daftar_keuangan.php">Daftar Keuangan</a>
                        <a class="collapse-item" href="catat_pengeluaran.php">Catat Pengeluaran</a>
                        <a class="collapse-item" href="daftar_pengeluaran.php">Daftar Pengeluaran</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Pengaturan
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCon"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Pengaturan Akun</span>
                </a>
                <div id="collapseCon" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_user.php">Tambah User</a>
                        <a class="collapse-item" href="list_user.php">Daftar User</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Charts -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
<!--             <div class="sidebar-card">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['nama']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

                <div class="container-fluid">
                    <center>
                    <div class="col-md-10 justify-content-center">
                   <div class="card shadow mb-5">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Anggota</h6>
                        </div>
                        <div class="card-body">
                                <div class="row mt-3">
                             <div class="col-md-2  mt-4">
                                <!-- <h7 class="m-0 font-weight-bold">Kapasitas Anggota: #</h7><br> -->
                                <a href="export.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-1"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                             </div>

                             <div class="col-md-8 mt-5 ">
                               <form class="form-inline my-2 my-lg-0" action="search.php" method="get" name='cari'>
                                     <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name='cari'  required>
                                     <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                   </form>
                             </div>

                             </div>
                             <br>
                            <div class="table-responsive d-flex">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <?php $no = 1; ?>
                                    <thead>
                                        <tr >
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Nomer Telpon</th>
                                            <th>Email</th>
                                            <th>Tanggal lahir</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $nama_anggota; ?></td>
                                            <td><?php echo "+62" . $ponsel_anggota; ?></td>
                                            <td><?php echo $email_anggota; ?></td>
                                            <td><?php echo $tgl_lahir; ?></td>
                                            <td>&nbsp;<a href="edit_anggota.php?num=<?php echo $id; ?>"><button type="button" class="btn btn-success">Edit</button></a> 
                                                &nbsp; <a href="hapus_anggota.php?num=<?php echo $id; ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Apakah Anda Yakin?')">Hapus</button></a>
                                                &nbsp;<a href="detail.php?num=<?php echo $id; ?>"><button type="button" class="btn btn-info"  >Detail</button></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php $no++; ?>
                                </table>
                            </div>
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="?page=#">1</a></li>
                                    </ul>
                                </nav>
                        </div>
                    </div>
                    </div>
                    </center>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Built with <i class="fas fa-heart"></i> Using PHP @<?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hallo <?php echo $_SESSION['nama']; ?>!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah kamu yakin ingin logout? .</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>