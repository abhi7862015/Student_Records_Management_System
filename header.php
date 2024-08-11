<?php
include 'db_connection.php';

//check account logged in or not
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}
//Logout functionality
if (isset($_GET['logout'])) {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    header('Location: login.php');
}

$query1 = "select * from user_details where user_id=" . $_SESSION['user_id'];
$result = $conn->query($query1);
$num = mysqli_num_rows($result);

if($num == 0){
    unset($_SESSION['user_id']);
    unset($_SESSION['user_type']);
    header('Location: login.php');
}

$query2 = "select * from user_details where user_type = 'Admin'";
$result2 = $conn->query($query2);
$AdminCount = mysqli_num_rows($result2);

$query3 = "select * from user_details where user_type = 'Student'";
$result3 = $conn->query($query3);
$StudentCount = mysqli_num_rows($result3);

$query4 = "select * from user_details where user_type = 'Parent'";
$result4 = $conn->query($query4);
$ParentCount = mysqli_num_rows($result4);

$query5 = "select * from user_details where user_type = 'Teacher'";
$result5 = $conn->query($query5);
$TeacherCount = mysqli_num_rows($result5);

?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>SRMS | Student Records Management System</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Skote is a fully featured premium admin dashboard template built on top of awesome Bootstrap 4.4.1" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    </head>

    <body data-sidebar="dark">
        <!-- Begin page -->
        <div id="layout-wrapper">

            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm" style="color:white; font-weight:700; font-size:12px;letter-spacing:2px;">
                                    SRMS
                                </span>
                                <span class="logo-lg" style="color:white; font-weight:700; font-size:28px;letter-spacing:5px;">
                                    SRMS
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="mdi mdi-backburger"></i>
                        </button>

                    </div>

                    <div class="d-flex">

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="rounded-circle header-profile-user" src="assets/images/dummy-profile.png" alt="Header Avatar">
                                <span class="d-none d-xl-inline-block ml-1" key="t-henry">
                                    <?php
                                    if ($num>0){
                                        $row = $result->fetch_assoc();
                                        echo $row['user_type'];
                                    }
                                    ?>
                                </span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" style="">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> <span key="t-lock-screen"><?php echo $row['first_name']." ".$row['last_name'];?></span></a>
                                <div class="dropdown-divider"></div>
                                
                                <a class="dropdown-item text-danger" href="header.php?logout=<?php if (isset($_SESSION['student_id'])) echo $_SESSION['student_id']; ?>"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> <span key="t-logout">Logout</span></a>
                            </div>
                        </div>

                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Docs</li>

                            <li>
                                <a href="index.php" class="waves-effect">
                                    <i class="mdi mdi-file-document-box-outline"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="userList.php" class="waves-effect">
                                    <i class="mdi mdi-apps"></i>
                                    <span>User Accounts List</span>
                                </a>
                            </li>
                            <li>
                                <a href="teacherList.php" class="waves-effect">
                                    <i class="mdi mdi-apps"></i>
                                    <span>Teacher List</span>
                                </a>
                            </li>
                            <li>
                                <a href="studentList.php" class="waves-effect">
                                    <i class="mdi mdi-apps"></i>
                                    <span>Student List</span>
                                </a>
                            </li>
                        </ul>

                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->