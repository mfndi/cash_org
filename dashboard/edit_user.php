<?php 
include 'config/proses.php';
session_start();

$cek_user = "Admin";
if(!isset($_SESSION['nama'], $_SESSION['level'], $_SESSION['code'])){
   header("Location: ../index.php");
   exit();
} if($_SESSION['level'] !== $cek_user){
        header("Location: index.php");
        exit(); 
    }

$data = new Config_User();


function generate_token() {
    // Check if a token is present for the current session
    if(!isset($_SESSION["token"])) {
        // No token present, generate a new one
        $token = bin2hex(random_bytes(32));
        $_SESSION["token"] = $token;
    }
     else {
        // Reuse the token
        $token = $_SESSION["token"];
        
            }
    return $token;
  }





$nama_depan = "";
$nama_akhir = "";
$email = "";
$level = "";
$id = "";
$code = "";

if(isset($_GET['user']) && !empty($_GET['user'])){
    $data_user = $_GET['user'];
    $db = database::connect();
        $query_user = $db->prepare("SELECT * FROM cash_user WHERE code_uniq = :id_user");
        $query_user->bindParam(":id_user", $data_user);
        $query_user->execute();
            if($query_user->rowCount() == 1){
                $isi_data = $query_user->fetch(PDO::FETCH_ASSOC);
                    $nama_depan = $isi_data['nama_awal'];
                    $nama_akhir = $isi_data['nama_akhir'];
                    $email = $isi_data['email'];
                    $level = $isi_data['level_user'];
                    $id = $isi_data['id'];
                    $code = $isi_data['code_uniq'];
            }else{
                header("Location: list_user.php");
                exit();
            }
}



if(isset($_POST['submit'])){
    if($data->update_user($_POST) > 0){
        echo "<script>alert('Sukses'); 
                    document.location.href = 'list_user.php';
                </script>";
    }
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
<!--     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->


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
                    <div class="col-lg-8">
                                <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
                                </div>
                                <div class="card-body">
                                     <div class="p-5">
<!--                                     <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div> -->
                                    <form class="user" method="post" action="">
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="<?php echo $nama_depan; ?>" name="nama_awal" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="<?php echo $nama_akhir; ?>" name="nama_akhir" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="level" required>
                                            <option selected value="<?php echo $level; ?>"><?php echo $level; ?></option>
                                            <option value="Admin">Admin</option>
                                            <option value="Moderator">Moderator</option>
                                            </select> 
                                        </div>
                                        <a href="change_passwd.php?user=<?php echo $code; ?>&token=<?php echo generate_token(); ?>"><button type="button" class="btn btn-outline-primary btn-user btn-block">Ganti Password </button>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label>Pastikan Semua Data Sudah Benar</label>   
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="submit">Simpan </button>
                                    </form>
                                    <hr>
                                </div>
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