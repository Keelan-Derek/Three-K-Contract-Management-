<?php
    if ($_SESSION["login"] == false){
        header('location:login.php');
    }else{
?>
<?php
    //session_start();
    require_once ('dbconnect.php');
    $connection = dbconnect();

    // Dashboard Data

    $query = "SELECT COUNT(customerID) FROM customers";
    $ret = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($ret);

    $query2 = "SELECT COUNT(contractID) FROM contracts";
    $ret2 = mysqli_query($connection, $query2);
    $row2 = mysqli_fetch_array($ret2);

    $query3 = "SELECT COUNT(contractID) FROM contracts WHERE contracts.contractStatus = 'Ongoing'";
    $ret3 = mysqli_query($connection, $query3);
    $row3 = mysqli_fetch_array($ret3);

    $query4 = "SELECT COUNT(contractID) FROM contracts WHERE contracts.contractStatus = 'Initiation Pending'";
    $ret4 = mysqli_query($connection, $query4);
    $row4 = mysqli_fetch_array($ret4);

    $query5 = "SELECT COUNT(contractID) FROM contracts WHERE contracts.contractStatus = 'Completed'";
    $ret5 = mysqli_query($connection, $query5);
    $row5 = mysqli_fetch_array($ret5);

    $query6 = "SELECT COUNT(serviceID) FROM service_offerings";
    $ret6 = mysqli_query($connection, $query6);
    $row6 = mysqli_fetch_array($ret6);

?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <br>
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="jumbotron border border-dark align-self-center pt-5 pb-4" style="background-color: rgb(255,212,170);">
         
                <h1 class="display-4 text-center">Three K Contract Management</h1>
                <br>
                <p class="lead text-center d-print-none"> A solution that facilitates management of Three K Service contracts</p>
               
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 text-center text-dark">
            <span class="h2" >Dashboard</span>
            <hr class="my-3">
        </div>
        <div class="col-sm-3">
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_button_print"><button class="btn btn-primary d-print-none" role="button"><i class="fas fa-download"></i> Generate Report</button></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>  
        </div>
    </div>
    
    <br>
    <div class="row">
        <div class="col-sm-4">
            <br>
            <div class="card bg-light text-center pt-2 pb-2">
                <div class="card-body">
                    <h1 class="font-weight-bold"><?php echo $row["COUNT(customerID)"]?></h1><br><span class="h5">Total Customers at Three K</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <br>
            <div class="card bg-light text-center pt-2 pb-2">
                <div class="card-body">
                    <h1 class="font-weight-bold"><?php echo $row2["COUNT(contractID)"]?></h1><br><span class="h5">Total Contracts</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <br>
            <div class="card bg-light text-center pt-2 pb-2">
                <div class="card-body">
                    <h1 class="font-weight-bold"><?php echo $row3["COUNT(contractID)"]?></h1><br><span class="h5">Total Ongoing Contracts</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <br>
            <div class="card bg-light text-center pt-2 pb-2">
                <div class="card-body">
                    <h1 class="font-weight-bold"><?php echo $row4["COUNT(contractID)"]?></h1><br><span class="h5">Total Contracts Pending Initiation</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <br>
            <div class="card bg-light text-center pt-2 pb-2">
                <div class="card-body">
                    <h1 class="font-weight-bold"><?php echo $row5["COUNT(contractID)"]?></h1><br><span class="h5">Total Completed Contracts</span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <br>
            <div class="card bg-light text-center pt-2 pb-2">
                <div class="card-body">
                    <h1 class="font-weight-bold"><?php echo $row6["COUNT(serviceID)"]?></h1><br><span class="h5">Total Service Offerings</span>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<?php } ?>