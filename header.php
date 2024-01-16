<?php
//session_start();
require_once ('dbconnect.php');
$connection = dbconnect();

    @$page = $_GET["page"];
    switch(@$page){
        case "":
            $home = "";
            $customers = "";
            $contracts = "";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
        case "home":
            $home = "current";
            $customers = "";
            $contracts = "";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
        case "customers":
            $home = "";
            $customers = "current";
            $contracts = "";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
        case "contracts":
            $home = "";
            $customers = "";
            $contracts = "current";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
        case "payments":
            $home = "";
            $customers = "";
            $contracts = "";
            $payments = "current";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
        case "service_offerings":
            $home = "";
            $customers = "";
            $contracts = "";
            $payments = "";
            $service_offerings = "current";
            $users = "";
            $myaccount = "";
            break;
        case "users":
            $home = "";
            $customers = "";
            $contracts = "";
            $payments = "";
            $service_offerings = "";
            $users = "current";
            $myaccount = "";
            break;
        case "myaccount":
            $home = "";
            $customers = "";
            $contracts = "";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "current";
            break;
        case "viewcustomer":
            $home = "";
            $customers = "current";
            $contracts = "";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
        case "viewcontract":
            $home = "";
            $customers = "";
            $contracts = "current";
            $payments = "";
            $service_offerings = "";
            $users = "";
            $myaccount = "";
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Three K Contract Management</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"> 
        <link href="fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.4.1.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <div id="wrapper">
    
        <!-- Sidebar -->
        <nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
            <div class="simplebar-content">
            
            <a href="index1.php?page=home"><img src="images/Three K System Logo.png" alt="Three K Services Logo" class="align-self-center" style="width:250px;height:250px;"/></a>

            <ul class="navbar-nav">
        
                <li>
                    <a href="index1.php?page=home" class="bar-link <?php echo $home; ?>"><i class="fas fa-home fa-2x"></i>&nbsp;&nbsp;&nbsp;<span class="h5">Home</span></a>
                </li>
                <br>
                <li>
                    <a href="index1.php?page=customers" class="bar-link <?php echo $customers; ?>"><i class="fas fa-users fa-2x"></i>&nbsp;&nbsp;&nbsp;<span class="h5">Customers</span></a>
                </li>
                <br>
                <li>
                    <a href="index1.php?page=contracts" class="bar-link <?php echo $contracts; ?>"><i class="fas fa-file-contract fa-2x"></i>&nbsp;&nbsp;&nbsp;<span class="h5">Contracts</span></a>
                </li>
                <br>
                <li>
                    <a href="index1.php?page=payments" class="bar-link <?php echo $payments; ?>"><i class="fas fa-money-check-alt fa-2x"></i>&nbsp;&nbsp;&nbsp;<span class="h5">Payments</span></a>
                </li>
                <br>
                <li>
                    <a href="index1.php?page=service_offerings" class="bar-link <?php echo $service_offerings; ?>"><i class="fas fa-tools fa-2x"></i>&nbsp;&nbsp;&nbsp;<span class="h5">Service Offerings</span></a>
                </li>
                <br>
                <li>
                    <a href="index1.php?page=users" class="bar-link <?php echo $users; ?>"><i class="fas fa-user fa-2x"></i>&nbsp;&nbsp;&nbsp;<span class="h5">Users</span></a>
                </li>
                <ul class="list-unstyled mt-5">
                    <?php if($_SESSION["accessRole"] == "Administrator"){ ?>
                    <li>
                        <button class="btn btn-info p-2 pr-5 pl-5 ml-4" role="button">Backup System</button>
                    </li>
                    <br>
                    <li>
                        <button class="btn btn-info p-2 pr-5 pl-5 ml-4" role="button">Restore System</button>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <button class="btn btn-info p-2 pr-5 pl-5 ml-4" role="button">Backup System</button>
                    </li>
                    <?php } ?>
                </ul>
            </ul>
                        
            </div>     
        </nav>

        <!-- Page Content -->
        <div class="page-content-wrapper">
               
            <div id="content">

                <div class="container-fluid p-0 px-lg-0 px-md-0">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light my-navbar" style="background-color:#79b6e6;">

                        <!-- Sidebar Toggle (Topbar) -->
                        <div type="button"  id="bar" class="nav-icon1 hamburger animated fadeInLeft is-closed" data-toggle="offcanvas">
                        <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        

                        <ul class="navbar-nav ml-auto mr-5">

                            <li class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle text-dark h5" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-user-circle fa-2x"></i>&nbsp;<?php    
                                if($_SESSION["login"] == true){
                                echo "  Welcome, " . $_SESSION['firstname'] . " !";
                                }   
                                ?></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                    <li><a href="index1.php?page=myaccount" class="dropdown-item">My Account</a></li>
                                
                                    <li><a href="signout.php" class="dropdown-item">Sign Out</a></li>
                                </ul>
                            </li>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <li class="nav-item dropleft"><a href="#" class="nav-link dropleft-toggle text-dark h5" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="far fa-bell fa-2x"></i>&nbsp; Notifications</a>
                                <ul class="dropdown-menu" id="notifications" aria-labelledby="navbarDropdown2">
                                    <?php
                                        $notify1 = "SELECT contracts.contractID, contracts.contractName, contracts.initiationDate FROM contracts";
                                        $ret1 = mysqli_query($connection, $notify1);
                                        $num_results1 = mysqli_num_rows($ret1);

                                        for($i = 0; $i < $num_results1; $i++){
                                            $row1 = mysqli_fetch_array($ret1);
                                            if(strtotime($row1["initiationDate"]) <= strtotime("7 days"))
                                    ?>

                                    <li class="alert alert-warning alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                                        <?php echo '<div class="font-weight-bold"> Contract: # <a href="viewcontract.php?id='.$row1["contractID"].'">' . $row1["contractID"] . ' - ' . $row1["contractName"] . '</a> <u>initiation date</u> is in less than 7 days !</div> ('. $row1["initiationDate"] .')'; ?>    
                                    </li>
                                    <br>

                                    <?php } ?>

                                    <?php
                                        $notify2 = "SELECT contracts.contractID, contracts.contractName, contracts.deadline FROM contracts";
                                        $ret2 = mysqli_query($connection, $notify2);
                                        $num_results2 = mysqli_num_rows($ret2);

                                        for($i = 0; $i < $num_results2; $i++){
                                            $row2 = mysqli_fetch_array($ret2);
                                            if(strtotime($row2["deadline"]) <= strtotime("7 days"))
                                    ?>

                                    <li class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><i class="fas fa-times"></i></button>
                                        <?php echo '<div class="font-weight-bold"> Contract: # <a href="viewcontract.php?id='.$row2["contractID"].'">' . $row2["contractID"] . ' - ' . $row2["contractName"] . '</a> <u>deadline</u> is in less than 7 days !</div> ('. $row2["deadline"] .')'; ?>    
                                    </li>
                                    <br>

                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>

    </div>
        <!-- /#wrapper -->
    
    

    <script>
    
    $('#bar').click(function(){
        $(this).toggleClass('open');
        $('.page-content-wrapper ,#sidebar-wrapper').toggleClass('toggled' );

    });
    </script>

