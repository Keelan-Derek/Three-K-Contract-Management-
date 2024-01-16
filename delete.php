<?php
    session_start();
    include_once ('header.php');
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userid = $_SESSION["user"];
    $qry = "SELECT * FROM users WHERE userID='".$userid."' ";
    $result = mysqli_query($connection, $qry);


    if(isset($_POST["deletecontract"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
        $contractID = $_GET["id"];
        $query = "SELECT * FROM contracts WHERE contractID = $contractID";
        $ret = mysqli_query($connection, $query);
        if(!$ret){
            echo "Error" . mysqli_error($connection);
        }else{
            $row = mysqli_fetch_array($ret);
        }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Contract Record</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Contract Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract ID:</td>
                    <td><?php echo $row["contractID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Customer ID:</td>
                    <td><?php echo $row["customerID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Service ID:</td>
                    <td><?php echo $row["serviceID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Name:</td>
                    <td><?php echo $row["contractName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Description:</td>
                    <td><?php echo $row["contractDesc"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Site:</td>
                    <td><?php echo $row["contractSite"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Initiation Date:</td>
                    <td><?php echo $row["initiationDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Deadline:</td>
                    <td><?php echo $row["deadline"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">End Date:</td>
                    <td><?php echo $row["endDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Status:</td>
                    <td><?php echo $row["contractStatus"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Grand Total:</td>
                    <td><?php echo $row["grandTotal"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Registry Date:</td>
                    <td><?php echo $row["registryDate"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Contract?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="contractID" value="<?php echo $row["contractID"]; ?>">
                    <input type="hidden" name="modalForm" value="deleteContract">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Contract">Delete Contract</button>
                    <a href="index1.php?page=contracts"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php 
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; } 
    }else if(isset($_POST["deletepayment"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
            $paymentID = $_GET["id"];
            $query = "SELECT * FROM payments WHERE paymentID = $paymentID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Payment Record</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Payment Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Payment ID:</td>
                    <td><?php echo $row["paymentID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract ID:</td>
                    <td><?php echo $row["contractID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Payment Method ID:</td>
                    <td><?php echo $row["paymentMethodID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Payment Date:</td>
                    <td><?php echo $row["paymentDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Amount Paid:</td>
                    <td><?php echo $row["amountPaid"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Amount Left To Pay:</td>
                    <td><?php echo $row["amountToPay"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Paymentt?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="paymentID" value="<?php echo $row["paymentID"]; ?>">
                    <input type="hidden" name="modalForm" value="deletePayment">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Payment">Delete Payment</button>
                    <a href="index1.php?page=payments"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["deleteservice"])){
        if($_SESSION["accessRole"] == 'Administrator'){
            $serviceID = $_GET["id"];
            $query = "SELECT * FROM service_offerings WHERE serviceID = $serviceID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Service Offering Record</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Service Offering Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Service ID:</td>
                    <td><?php echo $row["serviceID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Service Name:</td>
                    <td><?php echo $row["serviceName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Service Description:</td>
                    <td><?php echo $row["serviceDesc"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Date Last Updated:</td>
                    <td><?php echo $row["dateLastUpdated"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Service Offering?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="serviceID" value="<?php echo $row["serviceID"]; ?>">
                    <input type="hidden" name="modalForm" value="deleteService">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Service Offering">Delete Service Offering</button>
                    <a href="index1.php?page=service_offerings"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["deleteuser"])){
        if($_SESSION["accessRole"] == 'Administrator'){
            $userID = $_GET["id"];
            $query = "SELECT * FROM users WHERE userID = $userID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete System User Record</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">User Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">User ID:</td>
                    <td><?php echo $row["userID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">First Name:</td>
                    <td><?php echo $row["firstName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Last Name:</td>
                    <td><?php echo $row["lastName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Email:</td>
                    <td><?php echo $row["email"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Phone Number:</td>
                    <td><?php echo $row["phoneNumber"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">User Access Role:</td>
                    <td><?php echo $row["userRole"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Username:</td>
                    <td><?php echo $row["username"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Password:</td>
                    <td><?php echo $row["passw"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this User's Account?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="userID" value="<?php echo $row["userID"]; ?>">
                    <input type="hidden" name="modalForm" value="deleteUser">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete System User">Delete System User</button>
                    <a href="index1.php?page=users"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        }else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["deletecontract2"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
            $contractID = $_GET["id"];
            $query = "SELECT * FROM contracts WHERE contractID = $contractID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }

            $qry2 = "SELECT * FROM customers, contracts WHERE contractID=$contractID AND contracts.customerID = customers.customerID";
            $result2 = mysqli_query($connection, $qry2);
            if(!$result2){
                echo "Error" . mysqli_error($connection);
            }else{
                $row2 = mysqli_fetch_array($result2);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Customer Contract Record</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Contract Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract ID:</td>
                    <td><?php echo $row["contractID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Customer ID:</td>
                    <td><?php echo $row["customerID"] ?> &nbsp; - &nbsp; <?php echo $row2["fullName"]; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Service ID:</td>
                    <td><?php echo $row["serviceID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Name:</td>
                    <td><?php echo $row["contractName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Description:</td>
                    <td><?php echo $row["contractDesc"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Site:</td>
                    <td><?php echo $row["contractSite"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Initiation Date:</td>
                    <td><?php echo $row["initiationDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Deadline:</td>
                    <td><?php echo $row["deadline"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">End Date:</td>
                    <td><?php echo $row["endDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract Status:</td>
                    <td><?php echo $row["contractStatus"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Grand Total:</td>
                    <td><?php echo $row["grandTotal"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Registry Date:</td>
                    <td><?php echo $row["registryDate"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Contract with <?php echo $row2['fullName']; ?>?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="contractID" value="<?php echo $row["contractID"]; ?>">
                    <input type="hidden" name="modalForm" value="deleteContract2">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Customer Contract">Delete Customer Contract</button>
                    <a href="viewcustomer.php?id=<?php echo $row2['customerID']; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["deleteactivity"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Project Manager'){
            $activityID = $_GET["id"];
            $contractID = $_SESSION["contractID"];
            $query = "SELECT * FROM contract_activities WHERE activityID = $activityID AND contractID = $contractID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }

            $qry2 = "SELECT * FROM contract_activities, contracts WHERE contracts.contractID=$contractID AND contract_activities.contractID = contracts.contractID";
            $result2 = mysqli_query($connection, $qry2);
            if(!$result2){
                echo "Error" . mysqli_error($connection);
            }else{
                $row2 = mysqli_fetch_array($result2);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Contract Activity Record</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Activity Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract ID:</td>
                    <td><?php echo $row["contractID"] ?>&nbsp; - &nbsp; <?php echo $row2["contractName"]; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Activity ID:</td>
                    <td><?php echo $row["activityID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Activity Name:</td>
                    <td><?php echo $row["activityName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Activity Description:</td>
                    <td><?php echo $row["activityDesc"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Start Date:</td>
                    <td><?php echo $row["startDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Finish Date:</td>
                    <td><?php echo $row["finishDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Completion Status:</td>
                    <td><?php echo $row["completionStatus"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Date Last Updated:</td>
                    <td><?php echo $row["dateLastUpdated"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Contract Activity?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="contractID" value="<?php echo $row["contractID"]; ?>">
                    <input type="hidden" name="activityID" value="<?php echo $row["activityID"]; ?>">
                    <input type="hidden" name="modalForm" value="deleteActivity">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Contract Activity">Delete Contract Activity</button>
                    <a href="viewcontract.php?id=<?php echo $contractID; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["deleteupload"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
            $uploadID = $_GET["id"];
            $contractID = $_SESSION["contractID"];

            $query = "SELECT * FROM uploads WHERE uploadID = $uploadID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }

            $qry2 = "SELECT * FROM uploads, contracts WHERE contracts.contractID=$contractID AND contracts.contractID = uploads.contractID";
            $result2 = mysqli_query($connection, $qry2);
            if(!$result2){
                echo "Error" . mysqli_error($connection);
            }else{
                $row2 = mysqli_fetch_array($result2);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Contract Document</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Document Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Document ID:</td>
                    <td><?php echo $row["uploadID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract ID:</td>
                    <td><?php echo $row["contractID"] ?>&nbsp; - &nbsp; <?php echo $row2["contractName"]; ?></td>
                </tr>

                <tr>
                    <td class="font-weight-bold h6 text-right">File Name:</td>
                    <td><?php echo $row["fileName"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">File Type:</td>
                    <td><?php echo $row["fileType"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">File Size:</td>
                    <td><?php echo $row["fileSize"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Date Uploaded:</td>
                    <td><?php echo $row["dateUploaded"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Contract Document?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="contractID" value="<?php echo $row["contractID"]; ?>">
                    <input type="hidden" name="uploadID" value="<?php echo $row["uploadID"]; ?>">
                    <input type="hidden" name="modalForm" value="deleteUpload">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Contract Document">Delete Contract Document</button>
                    <a href="viewcontract.php?id=<?php echo $contractID; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["deletepayment2"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
            $paymentID = $_GET["id"];
            $query = "SELECT * FROM payments WHERE paymentID = $paymentID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }

            $contractID = $_SESSION["contractID"];

            $query2 = "SELECT * FROM contracts WHERE contractID = '$contractID'";
            $ret2 = mysqli_query($connection, $query2);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row2 = mysqli_fetch_array($ret2);
            }
?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170); letter-spacing:2px;">
                <h2 class="text-center">Delete Contract Payment</h2>
                <p class="lead jumbo-content text-center font-weight-bold mb-2"><?php echo $row2["contractName"]; ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <h4 class="text-center">Payment Information</h4>
        <hr>
        <div class="table-responsive">
            <table class="table  table-hover table-dark mt-3">
                <tr>
                    <td class="font-weight-bold h6 text-right">Payment ID:</td>
                    <td><?php echo $row["paymentID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Contract ID:</td>
                    <td><?php echo $row["contractID"] ?>&nbsp; - &nbsp; <?php echo $row2["contractName"]; ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Payment Method ID:</td>
                    <td><?php echo $row["paymentMethodID"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Payment Date:</td>
                    <td><?php echo $row["paymentDate"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Amount Paid:</td>
                    <td><?php echo $row["amountPaid"] ?></td>
                </tr>
                <tr>
                    <td class="font-weight-bold h6 text-right">Amount Left To Pay:</td>
                    <td><?php echo $row["amountToPay"] ?></td>
                </tr>
            </table>
        </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <br>
    <div class="row">
        <div class="col-sm-12 text-center">
            <hr>
            <h4 class="text-center"><i class="fas fa-exclamation-circle fa-3x"></i></h4>
            <br>
            <h4 class="text-center">Do You Really Want to Delete this Paymentt?</h4>
            <hr>
            <form method="POST" action="delete-processing.php">
                <div class="form-group text-center">
                    <input type="hidden" name="contractID" value="<?php echo $row["contractID"]; ?>">
                    <input type="hidden" name="paymentID" value="<?php echo $row["paymentID"]; ?>">
                    <input type="hidden" name="modalForm" value="deletePayment2">
                    <button type="submit" class="btn btn-danger pr-5 pl-5" name="delete" id="Delete" value="Delete Contract Payment">Delete Contract Payment</button>
                    <a href="viewcontract.php?id=<?php echo $contractID; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Cancel"></a> 
                </div>
            </form>
        </div>
    </div>

</div>
</div>
<?php
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }

?>
<!--

        // Delete Contract Payments on View Contract Page

        // Delete All on View Contract Page (Delete Contract Details)
-->

<?php include ('footer.php'); ?>