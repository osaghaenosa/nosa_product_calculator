<?php
ob_start();
session_start();
include("../widgets/alert.widget");
include("../widgets/loading2.widget");

showLoading();
if(isset($_SESSION['rrr'])){
    showAlert($_SESSION['rrr']);
    unset($_SESSION['rrr']);
}

if(!isset($_SESSION["alogged_in"])){
    header("location: login");
    $_SESSION["rrr"] = "This is for the Admins alone<br> You Have to Login to access It...";
}
ob_flush();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Dashboard - CastiUnion</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-light">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 d-flex gap-2" href="index.html"><img class="dashboard-img" src="../assets/images/logo.png" alt="" style="width:initial; height: 30px;opacity:1"> <span class="text-dark">Casti Union</span></a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars text-dark"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </form>
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="<?php echo '../adminx?r=home'; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="<?php echo '../signup'; ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-plus-fill fs-6"></i></div>
                                Register A User
                            </a>

                            <!-- <a class="nav-link" href="<?php echo '../adminx?r=error_pages'; ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-x fs-6"></i></div>
                                Error Pages
                            </a> -->
                        
                            <a class="nav-link" href="<?php echo '../adminx?r=statistics'; ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-fill"></i></div>
                                User Statistics
                            </a>

                            <a class="nav-link" href="<?php echo '../adminx?r=maintenance'; ?>">
                                <div class="sb-nav-link-icon"><i class="bi bi-gear-fill fs-6"></i></div>
                                Maintenance Mode
                            </a>
                            <!-- <a class="nav-link" href="<?php echo '../adminx?r=customer_care_chat'; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Customer care Chat
                            </a>
                            <a class="nav-link" href="<?php echo '../adminx?r=a2c_requst'; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Airtime/Data to cash Request
                            </a>
                            
                            <a class="nav-link" href="<?php echo '../adminx?r=settings'; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Change a setting
                            </a>
                            <a class="nav-link" href="<?php echo '../adminx?r=services'; ?>">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Services
                            </a> -->
                            <!-- <div class="sb-sidenav-menu-heading">Services</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Crypto
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Gift cards
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Utility Bills
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div> -->
                            <!-- <div class="sb-sidenav-menu-heading">Addons</div> -->
                            <!-- <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a> -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small"><a href="logout.php" class="btn btn-danger"><i class="bi bi-person"></i>Logout</a></div>
                        CastiUnion
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <?php 
                if(isset($_GET["r"])){
                    if($_GET["r"] == "home"){
                        if(isset($_GET['users']) && $_GET['users']!==''){
                            include("user_info.html");

                            
                            
                        }
                        
                        else{
                            include("initiala.html");
                        }
                    
                    }
                    else if($_GET["r"] == "overview"){
                        include("overview.html");
                    }
                    else if($_GET["r"] == "statistics"){
                        include("statistics.html");
                    }
                    else if($_GET["r"] == "highlights"){
                        include("highlights.html");
                    }
                    else if($_GET["r"] == "notifications"){
                        include("notifications.html");
                    }
                    else if($_GET["r"] == "verifications"){
                        include("verifications.html");
                    }
                    else if($_GET["r"] == "settings"){
                        include("setting.html");
                    }
                    else if($_GET["r"] == "a2c_requst"){
                        include("a2c_request.php");
                    }
                    else if($_GET["r"] == "customer_care_chat"){
                        include("customer_chat.php");
                    }
                    else if($_GET["r"] == "create_customer_care"){
                        include("create_customer_care.php");
                    }
                    else if($_GET["r"] == "ccare_management"){
                        include("ccare_management.php");
                    }
                    else if($_GET["r"] == "maintenance"){
                        include("maintenance.php");
                    }
                   
                } 
                if(isset($_GET["message"])){
                    include("chat.php");
                }
                ?>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Castiunion 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <style>
            .nav-link:hover{
                background: rgb(0,50,255);
                border-radius: 16px;
                color: white !important;
            }
            .nav-link:hover i{
                color: white !important;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
