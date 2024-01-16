<?php
    session_start();
    include_once ('header.php');
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userid = $_SESSION["user"];

    $qry = "SELECT * FROM users WHERE userID='".$userid."' ";
    $result = mysqli_query($connection, $qry);

    if(isset($_POST["editcustomer"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
        $customerID = $_GET["id"];
        $query = "SELECT * FROM customers WHERE customerID = $customerID";
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
                <h2 class="text-center">Edit Customer Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newCustomerID" class="font-weight-bold h5">Customer ID</label>
                    <input class="form-control" type="nummber" id="newCustomerID" name="newCustomerID" value="<?php echo $row["customerID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newCustomerType" class="font-weight-bold h5">Customer Type</label>
                    <select class="form-control" id="newCustomerType" name="newCustomerType" required>
                    <?php
                        if($row["customerType"] == "Business"){
                            echo "<option name='CustomerType' value='Business' selected>Business</option>
                            <option name='CustomerType' value='Individual'>Individual</option>";
                        }else
                            echo "<option name='CustomerType' value='Individual' selected>Individual</option>
                            <option name='CustomerType' value='Business'>Business</option>;"
                    ?>
                    </select>
                </div>  
                <div class="form-group">
                    <label for="newCustomerName" class="font-weight-bold h5">Full Name</label>
                    <input class="form-control" type="text" id="newCustomerName" name="newCustomerName" value="<?php echo $row["fullName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerEmail" class="font-weight-bold h5">Email</label>
                    <input class="form-control" type="text" id="newCustomerEmail" name="newCustomerEmail" value="<?php echo $row["email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerPhone" class="font-weight-bold h5">Phone Number</label>
                    <input class="form-control" type="text" id="newCustomerPhone" name="newCustomerPhone" value="<?php echo $row["phoneNumber"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerAddress" class="font-weight-bold h5">Address</label>
                    <input class="form-control" type="text" id="newCustomerAddress" name="newCustomerAddress" value="<?php echo $row["addr"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerDOB" class="font-weight-bold h5">Date of Birth</label>
                    <input class="form-control" type="text" id="newCustomerDOB" name="newCustomerDOB" value="<?php echo $row["DOB"]; ?>" required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editCustomer">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Customer">Edit Customer</button>
                    <a href="index1.php?page=customers"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php 
        } else{ echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; } 
    }else if(isset($_POST["editcontract"])){
        $qry2 = "SELECT * FROM service_offerings";
        $ret2 = mysqli_query($connection, $qry2);

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
                <h2 class="text-center">Edit Contract Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newContractID" class="font-weight-bold h5">Contract ID</label>
                    <input class="form-control" type="nummber" id="newContractID" name="newContractID" value="<?php echo $row["contractID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newCustomerID" class="font-weight-bold h5">Customer ID</label>
                    <input class="form-control" type="nummber" id="newCustomerID" name="newCustomerID" value="<?php echo $row["customerID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newServiceID" class="font-weight-bold">Service ID</label>
                    <select class="form-control" id="newServiceID" name="newServiceID" required>
                        <option value="<?php echo $row["serviceID"] ?>" selected><?php echo $row["serviceID"] ?></option>
                        <?php
                            while($row2 = mysqli_fetch_array($ret2)){
                                echo "<option value='" . $row2["serviceID"] ."'>". $row2["serviceID"]. " - ". $row2["serviceName"] ."</option>";
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="newContractName" class="font-weight-bold h5">Contract Name</label>
                    <input class="form-control" type="text" id="newContractName" name="newContractName" value="<?php echo $row["contractName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newContractDesc" class="font-weight-bold h5">Contract Description</label>
                    <textarea class="form-control" type="text" id="newContractDesc" name="newContractDesc" rows="3" value="<?php echo $row["contractDesc"]; ?>"><?php echo $row["contractDesc"]; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="newContractSite" class="font-weight-bold h5">Contract Site</label>
                    <input class="form-control" type="text" id="newContractSite" name="newContractSite" value="<?php echo $row["contractSite"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newInitiationDate" class="font-weight-bold">Initiation Date</label>
                    <input class="form-control" type="text" id="newInitiationDate" name="newInitiationDate" value="<?php echo $row["initiationDate"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newDeadline" class="font-weight-bold">Deadline</label>
                    <input class="form-control" type="text" id="newDeadline" name="newDeadline" value="<?php echo $row["deadline"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newEndDate" class="font-weight-bold">End Date</label>
                    <input class="form-control" type="text" id="newEndDate" name="newEndDate" value="<?php echo $row["endDate"]; ?>">
                </div>
                <div class="form-group">
                    <label for="newContractStatus" class="font-weight-bold h5">Contract Status</label>
                    <select class="form-control" id="newContractStatus" name="newContractStatus" required>
                    <?php
                        if($row["contractStatus"] == "Initiation Pending"){
                          echo '<option name="ContractStatus" value="Initiation Pending" selected>Initiation Pending</option><option name="ContractStatus" value="Ongoing">Ongoing</option><option name="ContractStatus" value="Completed">Completed</option>';
                        }elseif($row["contractStatus"] == "Ongoing"){
                            echo '<option name="ContractStatus" value="Ongoing" selected>Ongoing</option><option name="ContractStatus" value="Completed">Completed</option><option name="ContractStatus" value="Initiation Pending">Initiation Pending</option>';
                        }else{
                            echo '<option name="ContractStatus" value="Completed" selected>Completed</option><option name="ContractStatus" value="Initiation Pending">Initiation Pending</option><option name="ContractStatus" value="Ongoing">Ongoing</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newGrandTotal" class="font-weight-bold h5">Grand Total</label>
                    <input class="form-control" type="text" id="newGrandTotal" name="newGrandTotal" value="<?php echo $row["grandTotal"]; ?>" required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editContract">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Contract">Edit Contract</button>
                    <a href="index1.php?page=contracts"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php 
    } else if(isset($_POST["editpayment"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
        $qry2 = "SELECT * FROM payment_method";
        $ret2 = mysqli_query($connection, $qry2);

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
                <h2 class="text-center">Edit Payment Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newPaymentID" class="font-weight-bold h5">Payment ID</label>
                    <input class="form-control" type="nummber" id="newPaymentID" name="newPaymentID" value="<?php echo $row["paymentID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newContractID" class="font-weight-bold h5">Contract ID</label>
                    <input class="form-control" id="newContractID" name="newContractID" value="<?php echo $row["contractID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newPaymentMethodID" class="font-weight-bold h5">Payment Method ID</label>
                    <select class="form-control" id="newPaymentMethodID" name="newPaymentMethodID" required>
                        <option value="<?php echo $row["paymentMethodID"] ?>" selected><?php echo $row["paymentMethodID"] ?></option>
                        <?php
                            while($row2 = mysqli_fetch_array($ret2)){
                                echo "<option value='" . $row2["paymentMethodID"] ."'>". $row2["paymentMethodID"]. " - ". $row2["methodName"] ."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newPaymentDate" class="font-weight-bold h5">Payment Date</label>
                    <input class="form-control" type="text" id="newPaymentDate" name="newPaymentDate" value="<?php echo $row["paymentDate"]; ?>" required>
                </div>  
                <div class="form-group">
                    <label for="newAmountPaid" class="font-weight-bold h5">Amount Paid</label>
                    <input class="form-control" type="text" id="newAmountPaid" name="newAmountPaid" value="<?php echo $row["amountPaid"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newAmountToPay" class="font-weight-bold h5">Amount Left to Pay</label>
                    <input class="form-control" type="text" id="newAmountToPay" name="newAmountToPay" value="<?php echo $row["amountToPay"]; ?>"required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editPayment">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Payment">Edit Payment</button>
                    <a href="index1.php?page=payments"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
        } else { echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["editservice"])){
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
                <h2 class="text-center">Edit Service Offering Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newServiceID" class="font-weight-bold h5">Service ID</label>
                    <input class="form-control" type="nummber" id="newServiceID" name="newServiceID" value="<?php echo $row["serviceID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newServiceName" class="font-weight-bold h5">Service Name</label>
                    <input class="form-control" type="text" id="newServiceName" name="newServiceName" value="<?php echo $row["serviceName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newServiceDesc" class="font-weight-bold h5">Service Description</label>
                    <textarea class="form-control" type="text" id="newServiceDesc" name="newServiceDesc" rows="3" value="<?php echo $row["serviceDesc"]; ?>"><?php echo $row["serviceDesc"]; ?></textarea>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editService">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Service">Edit Service Offering</button>
                    <a href="index1.php?page=service_offerings"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
        } else { echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["edituser"])){
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
                <h2 class="text-center">Edit User Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newUserID" class="font-weight-bold h5">User ID</label>
                    <input class="form-control" type="nummber" id="newUserID" name="newUserID" value="<?php echo $row["userID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newFirstname" class="font-weight-bold h5">First Name</label>
                    <input class="form-control" type="text" id="newFirstname" name="newFirstname" value="<?php echo $row["firstName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newLastname" class="font-weight-bold h5">Last Name</label>
                    <input class="form-control" type="text" id="newLastname" name="newLastname" value="<?php echo $row["lastName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newEmail" class="font-weight-bold h5">Email</label>
                    <input class="form-control" type="text" id="newEmail" name="newEmail" value="<?php echo $row["email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newPhoneNumber" class="font-weight-bold h5">Phone Number</label>
                    <input class="form-control" type="text" id="newPhoneNumber" name="newPhoneNumber" value="<?php echo $row["phoneNumber"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newUserRole" class="font-weight-bold h5">User Access Role</label>
                    <select class="form-control" id="newUserRole" name="newUserRole" required>
                    <?php
                        if($row["userRole"] == "Administrator"){
                          echo '<option name="userRole" value="Administrator" selected>Administrator</option><option name="userRole" value="Administrative Staff">Administrative Staff</option><option name="userRole" value="Project Manager">Project Manager</option>';
                        }elseif($row["userRole"] == "Administrative Staff"){
                            echo '<option name="userRole" value="Administrative Staff" selected>Administrative Staff</option><option name="userRole" value="Project Manager">Project Manager</option><option name="userRole" value="Administrator">Administrator</option>';
                        }else{
                            echo '<option name="userRole" value="Project Manager" selected>Project Manager</option><option name="userRole" value="Administrator">Administrator</option><option name="userRole" value="Administrative Staff">Administrative Staff</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newUsername" class="font-weight-bold h5">Username</label>
                    <input class="form-control" type="text" id="newUsername" name="newUsername" value="<?php echo $row["username"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newPass" class="font-weight-bold h5">Password</label>
                    <input class="form-control" type="text" id="newPass" name="newPass" value="<?php echo $row["passw"]; ?>" readonly>
                </div>
                <br>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editUser">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit User">Edit System User</button>
                    <a href="index1.php?page=users"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
        } else { echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["editcustomer2"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
            $customerID = $_GET["id"];
            $query = "SELECT * FROM customers WHERE customerID = $customerID";
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
                <h2 class="text-center">Edit Customer Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newCustomerID" class="font-weight-bold h5">Customer ID</label>
                    <input class="form-control" type="nummber" id="newCustomerID" name="newCustomerID" value="<?php echo $row["customerID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newCustomerType" class="font-weight-bold h5">Customer Type</label>
                    <select class="form-control" id="newCustomerType" name="newCustomerType" required>
                    <?php
                        if($row["customerType"] == "Business"){
                            echo "<option name='CustomerType' value='Business' selected>Business</option>
                            <option name='CustomerType' value='Individual'>Individual</option>";
                        }else
                            echo "<option name='CustomerType' value='Individual' selected>Individual</option>
                            <option name='CustomerType' value='Business'>Business</option>;"
                    ?>
                    </select>
                </div>  
                <div class="form-group">
                    <label for="newCustomerName" class="font-weight-bold h5">Full Name</label>
                    <input class="form-control" type="text" id="newCustomerName" name="newCustomerName" value="<?php echo $row["fullName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerEmail" class="font-weight-bold h5">Email</label>
                    <input class="form-control" type="text" id="newCustomerEmail" name="newCustomerEmail" value="<?php echo $row["email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerPhone" class="font-weight-bold h5">Phone Number</label>
                    <input class="form-control" type="text" id="newCustomerPhone" name="newCustomerPhone" value="<?php echo $row["phoneNumber"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerAddress" class="font-weight-bold h5">Address</label>
                    <input class="form-control" type="text" id="newCustomerAddress" name="newCustomerAddress" value="<?php echo $row["addr"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCustomerDOB" class="font-weight-bold h5">Date of Birth</label>
                    <input class="form-control" type="text" id="newCustomerDOB" name="newCustomerDOB" value="<?php echo $row["DOB"]; ?>" required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editCustomer2">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Customer">Edit Customer</button>
                    <a href="viewcustomer.php?id=<?php echo $row['customerID'];?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
        } else { echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["editcontract2"])){
        $qry3 = "SELECT * FROM service_offerings";
        $ret3 = mysqli_query($connection, $qry3);

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
                <h2 class="text-center">Edit Customer Contract Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newContractID" class="font-weight-bold h5">Contract ID</label>
                    <input class="form-control" type="nummber" id="newContractID" name="newContractID" value="<?php echo $row["contractID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newCustomerID" class="font-weight-bold h5">Customer ID</label>
                    <input class="form-control" type="nummber" id="newCustomerID" name="newCustomerID" value="<?php echo $row["customerID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newServiceID" class="font-weight-bold">Service ID</label>
                    <select class="form-control" id="newServiceID" name="newServiceID" required>
                        <option value="<?php echo $row["serviceID"] ?>" selected><?php echo $row["serviceID"] ?></option>
                        <?php
                            while($row3 = mysqli_fetch_array($ret3)){
                                echo "<option value='" . $row3["serviceID"] ."'>". $row3["serviceID"]. " - ". $row3["serviceName"] ."</option>";
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="newContractName" class="font-weight-bold h5">Contract Name</label>
                    <input class="form-control" type="text" id="newContractName" name="newContractName" value="<?php echo $row["contractName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newContractDesc" class="font-weight-bold h5">Contract Description</label>
                    <textarea class="form-control" type="text" id="newContractDesc" name="newContractDesc" rows="3" value="<?php echo $row["contractDesc"]; ?>"><?php echo $row["contractDesc"]; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="newContractSite" class="font-weight-bold h5">Contract Site</label>
                    <input class="form-control" type="text" id="newContractSite" name="newContractSite" value="<?php echo $row["contractSite"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newInitiationDate" class="font-weight-bold">Initiation Date</label>
                    <input class="form-control" type="text" id="newInitiationDate" name="newInitiationDate" value="<?php echo $row["initiationDate"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newDeadline" class="font-weight-bold">Deadline</label>
                    <input class="form-control" type="text" id="newDeadline" name="newDeadline" value="<?php echo $row["deadline"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newEndDate" class="font-weight-bold">End Date</label>
                    <input class="form-control" type="text" id="newEndDate" name="newEndDate" value="<?php echo $row["endDate"]; ?>">
                </div>
                <div class="form-group">
                    <label for="newContractStatus" class="font-weight-bold h5">Contract Status</label>
                    <select class="form-control" id="newContractStatus" name="newContractStatus" required>
                    <?php
                        if($row["contractStatus"] == "Initiation Pending"){
                          echo '<option name="ContractStatus" value="Initiation Pending" selected>Initiation Pending</option><option name="ContractStatus" value="Ongoing">Ongoing</option><option name="ContractStatus" value="Completed">Completed</option>';
                        }elseif($row["contractStatus"] == "Ongoing"){
                            echo '<option name="ContractStatus" value="Ongoing" selected>Ongoing</option><option name="ContractStatus" value="Completed">Completed</option><option name="ContractStatus" value="Initiation Pending">Initiation Pending</option>';
                        }else{
                            echo '<option name="ContractStatus" value="Completed" selected>Completed</option><option name="ContractStatus" value="Initiation Pending">Initiation Pending</option><option name="ContractStatus" value="Ongoing">Ongoing</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newGrandTotal" class="font-weight-bold h5">Grand Total</label>
                    <input class="form-control" type="text" id="newGrandTotal" name="newGrandTotal" value="<?php echo $row["grandTotal"]; ?>" required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editContract2">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Customer Contract">Edit Customer Contract</button>
                    <a href="viewcustomer.php?id=<?php echo $row['customerID']; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
    } else if(isset($_POST["editcontract3"])){
        $qry4 = "SELECT * FROM customers";
        $ret4 = mysqli_query($connection, $qry4);

        $qry5 = "SELECT * FROM service_offerings";
        $ret5 = mysqli_query($connection, $qry5);

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
                <h2 class="text-center">Edit Contract Details</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newContractID" class="font-weight-bold h5">Contract ID</label>
                    <input class="form-control" type="nummber" id="newContractID" name="newContractID" value="<?php echo $row["contractID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newCustomerID" class="font-weight-bold">Customer ID</label>
                    <select class="form-control" id="newCustomerID" name="newCustomerID" required>
                        <option value="<?php echo $row["customerID"] ?>" selected><?php echo $row["customerID"] ?></option>
                        <?php

                            while($row4 = mysqli_fetch_array($ret4)){
                                echo "<option value='" . $row4["customerID"] ."'>". $row4["customerID"]. " - ". $row4["fullName"] ."</option>";
                            }

                        ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="newServiceID" class="font-weight-bold">Service ID</label>
                    <select class="form-control" id="newServiceID" name="newServiceID" required>
                        <option value="<?php echo $row["serviceID"] ?>" selected><?php echo $row["serviceID"] ?></option>
                        <?php
                            while($row5 = mysqli_fetch_array($ret5)){
                                echo "<option value='" . $row5["serviceID"] ."'>". $row5["serviceID"]. " - ". $row5["serviceName"] ."</option>";
                            }
                        ?>
                    </select>
                </div> 
                <div class="form-group">
                    <label for="newContractName" class="font-weight-bold h5">Contract Name</label>
                    <input class="form-control" type="text" id="newContractName" name="newContractName" value="<?php echo $row["contractName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newContractDesc" class="font-weight-bold h5">Contract Description</label>
                    <textarea class="form-control" type="text" id="newContractDesc" name="newContractDesc" rows="3" value="<?php echo $row["contractDesc"]; ?>"><?php echo $row["contractDesc"]; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="newContractSite" class="font-weight-bold h5">Contract Site</label>
                    <input class="form-control" type="text" id="newContractSite" name="newContractSite" value="<?php echo $row["contractSite"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newInitiationDate" class="font-weight-bold">Initiation Date</label>
                    <input class="form-control" type="text" id="newInitiationDate" name="newInitiationDate" value="<?php echo $row["initiationDate"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newDeadline" class="font-weight-bold">Deadline</label>
                    <input class="form-control" type="text" id="newDeadline" name="newDeadline" value="<?php echo $row["deadline"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newEndDate" class="font-weight-bold">End Date</label>
                    <input class="form-control" type="text" id="newEndDate" name="newEndDate" value="<?php echo $row["endDate"]; ?>">
                </div>
                <div class="form-group">
                    <label for="newContractStatus" class="font-weight-bold h5">Contract Status</label>
                    <select class="form-control" id="newContractStatus" name="newContractStatus" required>
                    <?php
                        if($row["contractStatus"] == "Initiation Pending"){
                          echo '<option name="ContractStatus" value="Initiation Pending" selected>Initiation Pending</option><option name="ContractStatus" value="Ongoing">Ongoing</option><option name="ContractStatus" value="Completed">Completed</option>';
                        }elseif($row["contractStatus"] == "Ongoing"){
                            echo '<option name="ContractStatus" value="Ongoing" selected>Ongoing</option><option name="ContractStatus" value="Completed">Completed</option><option name="ContractStatus" value="Initiation Pending">Initiation Pending</option>';
                        }else{
                            echo '<option name="ContractStatus" value="Completed" selected>Completed</option><option name="ContractStatus" value="Initiation Pending">Initiation Pending</option><option name="ContractStatus" value="Ongoing">Ongoing</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newGrandTotal" class="font-weight-bold h5">Grand Total</label>
                    <input class="form-control" type="text" id="newGrandTotal" name="newGrandTotal" value="<?php echo $row["grandTotal"]; ?>" required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editContract3">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Contract">Edit Contract</button>
                    <a href="viewcontract.php?id=<?php echo $row['contractID']; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
    }else if(isset($_POST["editactivity"])){
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
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170);">
                <h2 class="text-center" style="letter-spacing:2px;">Edit Contract Activity</h2><br>
                <p class="lead jumbo-content text-center font-weight-bold mb-2"><?php echo $row2["contractName"]; ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newContractID" class="font-weight-bold h5">Contract ID</label>
                    <input class="form-control" type="number" id="newContractID" name="newContractID" value="<?php echo $row["contractID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="oldActivityID" class="font-weight-bold h5">Stored Activity ID</label>
                    <input class="form-control" type="hidden" id="oldActivityID" name="oldActivityID" value="<?php echo $row["activityID"]; ?>">
                </div>
                <div class="form-group">
                    <label for="newActivityID" class="font-weight-bold h5">Activity ID</label>
                    <input class="form-control" type="number" id="newActivityID" name="newActivityID" min="1" value="<?php echo $row["activityID"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newActivityName" class="font-weight-bold h5">Activity Name</label>
                    <input class="form-control" type="text" id="newActivityName" name="newActivityName" value="<?php echo $row["activityName"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newActivityDesc" class="font-weight-bold h5">Activity Description</label>
                    <textarea class="form-control" type="text" id="newActivityDesc" name="newActivityDesc" rows="3" value="<?php echo $row["activityDesc"]; ?>"><?php echo $row["activityDesc"]; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="newStartDate" class="font-weight-bold h5">Start Date</label>
                    <input class="form-control" type="text" id="newStartDate" name="newStartDate" value="<?php echo $row["startDate"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newFinishDate" class="font-weight-bold h5">Finish Date</label>
                    <input class="form-control" type="text" id="newFinishDate" name="newFinishDate" value="<?php echo $row["finishDate"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCompletionStatus" class="font-weight-bold h5">Completion Status</label>
                    <select class="form-control" id="newCompletionStatus" name="newCompletionStatus" required>
                    <?php
                        if($row["completionStatus"] == "Incomplete"){
                          echo '<option name="CompletionStatus" value="Incomplete" selected>Incomplete</option><option name="CompletionStatus" value="Complete">Complete</option>';
                        }else{
                            echo '<option name="CompletionStatus" value="Complete" selected>Complete</option><option name="CompletionStatus" value="Incomplete">Incomplete</option>';
                        }
                    ?>
                    </select>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editActivity">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Contract Activity">Edit Contract Activity</button>
                    <a href="viewcontract.php?id=<?php echo $contractID; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
        }else { echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }else if(isset($_POST["editpayment2"])){
        if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){
            $qry6 = "SELECT * FROM payment_method";
            $ret6 = mysqli_query($connection, $qry6);

            $contractID = $_SESSION["contractID"];
    
            $paymentID = $_GET["id"];
            $query = "SELECT * FROM payments WHERE paymentID = $paymentID";
            $ret = mysqli_query($connection, $query);
            if(!$ret){
                echo "Error" . mysqli_error($connection);
            }else{
                $row = mysqli_fetch_array($ret);
            }

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
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(255,212,170);">
                <h2 class="text-center" style="letter-spacing:2px;">Edit Contract Payment</h2>
                <p class="lead jumbo-content text-center font-weight-bold mb-2"><?php echo $row2["contractName"]; ?></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <form method="POST" action="edit-processing.php">
                <div class="form-group">
                    <label for="newPaymentID" class="font-weight-bold h5">Payment ID</label>
                    <input class="form-control" type="nummber" id="newPaymentID" name="newPaymentID" value="<?php echo $row["paymentID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newContractID" class="font-weight-bold h5">Contract ID</label>
                    <input class="form-control" id="newContractID" name="newContractID" value="<?php echo $row["contractID"]; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newPaymentMethodID" class="font-weight-bold h5">Payment Method ID</label>
                    <select class="form-control" id="newPaymentMethodID" name="newPaymentMethodID" required>
                        <option value="<?php echo $row["paymentMethodID"] ?>" selected><?php echo $row["paymentMethodID"] ?></option>
                        <?php
                            while($row6 = mysqli_fetch_array($ret6)){
                                echo "<option value='" . $row6["paymentMethodID"] ."'>". $row6["paymentMethodID"]. " - ". $row6["methodName"] ."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="newPaymentDate" class="font-weight-bold h5">Payment Date</label>
                    <input class="form-control" type="text" id="newPaymentDate" name="newPaymentDate" value="<?php echo $row["paymentDate"]; ?>" required>
                </div>  
                <div class="form-group">
                    <label for="newAmountPaid" class="font-weight-bold h5">Amount Paid</label>
                    <input class="form-control" type="text" id="newAmountPaid" name="newAmountPaid" value="<?php echo $row["amountPaid"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newAmountToPay" class="font-weight-bold h5">Amount Left to Pay</label>
                    <input class="form-control" type="text" id="newAmountToPay" name="newAmountToPay" value="<?php echo $row["amountToPay"]; ?>"required>
                </div>
                <div class="form-group text-center">
                    <input type="hidden" name="modalForm" value="editPayment2">
                    <button type="submit" class="btn btn-success pr-5 pl-5" name="edit" id="Edit" value="Edit Contract Payment">Edit Contract Payment</button>
                    <a href="viewcontract.php?id=<?php echo $contractID; ?>"><input class="btn text-center btn-secondary pr-0 pl-0" value="Back"></a> 
                </div>
            </form>
        </div>
        <div class="col-sm-2"></div>
    </div>

</div>
</div>
<?php
        }else { echo "<br><div class='alert alert-danger font-weight-bold' role='alert'> Your Access Role does not permit you to perfrom this operation. Please go back. </div>"; }
    }
?>
<!--

        // Edit (& Create) Contract Payments on View Contract Page

-->
<?php include ('footer.php'); ?>