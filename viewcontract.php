<?php
session_start();
    include_once ('header.php');
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userid = $_SESSION["user"];

    $contID = $_GET["id"];
    $_SESSION["contractID"] = $contID;
    @$contID = $_SESSION["contractID"];

    $query = "SELECT * FROM contracts WHERE contractID = '$contID'";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error:" . mysqli_error($connection);
    }
    $row = mysqli_fetch_array($ret);

    $query2 = "SELECT * FROM contracts, contract_activities WHERE contracts.contractID='$contID' AND contracts.contractID = contract_activities.contractID";
    $ret2 = mysqli_query($connection, $query2);
    if(!$ret2){
        echo "Error:" . mysqli_error($connection);
    }

    $query3 = "SELECT * FROM contracts, uploads WHERE contracts.contractID='$contID' AND contracts.contractID = uploads.contractID";
    $ret3 = mysqli_query($connection, $query3);
    if(!$ret3){
        echo "Error:" . mysqli_error($connection);
    }

    $query4 = "SELECT * FROM contracts, payments WHERE contracts.contractID='$contID' AND contracts.contractID = payments.contractID";
    $ret4 = mysqli_query($connection, $query4);
    if(!$ret4){
        echo "Error:" . mysqli_error($connection);
    }

    $qry = "SELECT * FROM customers, contracts WHERE contracts.contractID='$contID' AND customers.customerID = contracts.customerID";
    $fetch = mysqli_query($connection, $qry);
    if(!$fetch){
        echo "Error:" . mysqli_error($connection);
    }
    $fet = mysqli_fetch_array($fetch);

    $qry2 = "SELECT * FROM service_offerings, contracts WHERE contracts.contractID='$contID' AND service_offerings.serviceID = contracts.serviceID";
    $fetch2 = mysqli_query($connection, $qry2);
    if(!$fetch2){
        echo "Error:" . mysqli_error($connection);
    }
    $fet2 = mysqli_fetch_array($fetch2);

    $qry4 = "SELECT * FROM payment_method";
    $fetch4 = mysqli_query($connection, $qry4);
    if(!$fetch4){
        echo "Error:" . mysqli_error($connection);
    }

?>
<div class="page-content-wrapper">
<div class="container-fluid">
    <br>
    <?php if (isset($_SESSION["alert"])) { ?>
        <div class='row'><?= $_SESSION["alert"] ?></div>
    <?php unset($_SESSION["alert"]); } ?>

    <?php if (isset($_SESSION["message"])) { ?>
        <div class='row'><?= $_SESSION["message"] ?></div>
    <?php unset($_SESSION["message"]); } ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-4" style="background-color: rgb(255,212,170);">
                <h1 class="text-center"> Contract #<?php echo $row['contractID']; ?> Page </h1>
                <p class="lead jumbo-content text-center font-weight-bold mb-2"><?php echo $row["contractName"]; ?></p>
                <p class="lead jumbo-content text-right font-weight-bold"><span class="font-italic">Registry Date:  </span><?php echo $row["registryDate"]; ?></p>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-3">
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_button_email"><button class="btn btn-info p-2 mr-2 pr-4 pl-4 d-print-none" role="button"><i class="fas fa-envelope"></i>&nbsp;Email</button></a>
                <a class="a2a_button_google_gmail"><button class="btn btn-info p-2 ml-2 pr-4 pl-4 d-print-none" role="button"><i class="fab fa-google"></i>&nbsp;Gmail</button></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
        </div>

        <div class="col-sm-3">
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_button_print"><button class="btn btn-info p-2 mr-2 pr-4 pl-4 d-print-none" role="button"><i class="fas fa-print"></i>&nbsp;Print</button></a>
                <a class="a2a_button_print"><button class="btn btn-info p-2 ml-2 pr-3 pl-3 d-print-none" role="button"><i class="far fa-file-pdf"></i>&nbsp;Export To PDF</button></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <br>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="table-responsive">
                <table class="table table-hover table-light mt-3">
                    <tr>
                        <thead class="thead-dark h2 text-center">
                            <th colspan="2">Contract Details</th>
                        </thead>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Contract ID:</td>
                        <td><?php echo $row["contractID"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Customer ID:</td>
                        <td><?php echo $row["customerID"]; ?> &nbsp; - &nbsp; <?php echo $fet['fullName']; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Service ID:</td>
                        <td><?php echo $row["serviceID"]; ?> &nbsp; - &nbsp; <?php echo $fet2['serviceName']; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Contract Name:</td>
                        <td><?php echo $row["contractName"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Contract Description:</td>
                        <td><?php echo $row["contractDesc"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Site:</td>
                        <td><?php echo $row["contractSite"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Initiation Date:</td>
                        <td><?php echo $row["initiationDate"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Deadline:</td>
                        <td><?php echo $row["deadline"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">End Date:</td>
                        <td><?php echo $row["endDate"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Contract Status:</td>
                        <td class="font-weight-bold"><?php echo $row["contractStatus"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Grand Total:</td>
                        <td><?php echo $row["grandTotal"]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-right bg-dark d-print-none"><form method="POST" action="edit.php?id=<?php echo $contID; ?>"><input type="submit" class="btn btn-success p-2 pr-5 pl-5" id="<?php echo $contID; ?>" value="Edit Contract" name="editcontract3"></form></td>
                    </tr>
                </table>
                <br>
                
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="table-responsive">
            <table class="table table-light mt-3">
                <tr>
                    <thead class="thead-dark h2">
                        <th colspan="7" class="pl-5">Contract Activities</th>
                        <th colspan="2">
                            <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Project Manager'){?>
                                <div class="text-right">
                                    <button class="btn btn-primary p-2 pr-4 pl-4 d-print-none" type="button" data-toggle="modal" data-target="#addContractActivity">Add Contract Activity</button>
                                </div>
                            <?php }else{ }?>
                        </th>
                    </thead>
                </tr>
                <tr>
                    <thead class="thead-light h6">
                        <th>Activity ID</th>
                        <th>Activity Name</th>
                        <th>Activity Description</th>
                        <th>Start Date</th>
                        <th>Finish Date</th>
                        <th>Completion Status</th>
                        <th>Date Last Updated</th>
                        <th colspan="2" class="d-print-none">Commands</th>
                    </thead>
                </tr>
                    <?php
                        while($row2 = mysqli_fetch_array($ret2)){
                    ?>
                <tr>
                    <td><?php echo $row2['activityID']; ?></td>
                    <td><?php echo $row2['activityName']; ?></td>
                    <td><?php echo $row2['activityDesc']; ?></td>
                    <td><?php echo $row2['startDate']; ?></td>
                    <td><?php echo $row2['finishDate']; ?></td>
                    <td class="font-weight-bold"><?php echo $row2['completionStatus']; ?></td>
                    <td><?php echo $row2['dateLastUpdated']; ?></td>
                    <td class="d-print-none"><form method="POST" action="edit.php?id=<?php echo $row2['activityID']; ?>"><input type="submit" class="btn btn-outline-success" id="<?php echo $row2['activityID']; ?>" value="Edit" name="editactivity"></form></td>
                    <td class="d-print-none"><form method="POST" action="delete.php?id=<?php echo $row2['activityID']; ?>"><input type="submit" class="btn btn-outline-danger" id="<?php echo $row2['activityID']; ?>" value="Delete" name="deleteactivity"></form></td>
                </tr>
                    <?php } ?>

            </table>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="table-responsive">
            <table class="table table-light mt-3">
                <tr>
                    <thead class="thead-dark h2">
                        <th colspan="5" class="pl-5">Contract Documents</th>
                        <th colspan="1">
                            <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                                <div class="text-right">
                                    <button class="btn btn-primary p-2 pr-4 pl-4 d-print-none" type="button" data-toggle="modal" data-target="#addDocument">Upload Contract Document</button>
                                </div>
                            <?php }else{ }?>
                        </th>
                    </thead>
                </tr>
                <tr>
                    <thead class="thead-light h6">
                        <th>Upload ID</th>
                        <th>File Name</th>
                        <th>File Type</th>
                        <th>File Size</th>
                        <th>Date Uploaded</th>
                        <th class="d-print-none">Command</th>
                    </thead>
                </tr>
                    <?php
                        while($row3 = mysqli_fetch_array($ret3)){
                    ?>
                <tr>
                    <td><?php echo $row3['uploadID']; ?></td>
                    <td><a href="uploads/<?php echo $row3['fileName'];?>"><?php echo $row3['fileName']; ?></a></td>
                    <td><?php echo $row3['fileType']; ?></td>
                    <td><?php echo $row3['fileSize']; ?></td>
                    <td><?php echo $row3['dateUploaded']; ?></td>
                    <td class="text-center d-print-none"><form method="POST" action="delete.php?id=<?php echo $row3['uploadID']; ?>"><input type="submit" class="btn btn-outline-danger p-2 pr-4 pl-4" id="<?php echo $row3['uploadID']; ?>" value="Delete" name="deleteupload"></form></td>
                </tr>
                    <?php } ?>

            </table>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <div class="table-responsive">
            <table class="table table-light mt-3">
                <tr>
                    <thead class="thead-dark h2">
                        <th colspan="6" class="pl-5">Contract Payments</th>
                        <th colspan="2">
                            <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                                <div class="text-right">
                                    <button class="btn btn-primary p-2 pr-4 pl-4 d-print-none" type="button" data-toggle="modal" data-target="#addContractPayment">Add Contract Payment</button>
                                </div>
                            <?php }else{ }?>
                        </th>
                    </thead>
                </tr>
                <tr>
                    <thead class="thead-light h6">
                        <th>Payment ID</th>
                        <th>Contract ID</th>
                        <th>Payment Method ID</th>
                        <th>Payment Date</th>
                        <th>Amount Paid</th>
                        <th>Amount Left to Pay</th>
                        <th colspan="2" class="d-print-none">Commands</th>
                    </thead>
                </tr>
                    <?php
                        while($row4 = mysqli_fetch_array($ret4)){
                    ?>
                    <?php 
                        $_SESSION["paymentMethod"] = $row4["paymentMethodID"]; 
                        $paymentMethodID = $_SESSION["paymentMethod"];

                        $qry3 = "SELECT * FROM payment_method, payments WHERE payments.paymentMethodID='$paymentMethodID' AND payment_method.paymentMethodID = payments.paymentMethodID";
                        $fetch3 = mysqli_query($connection, $qry3);
                        if(!$fetch3){
                            echo "Error:" . mysqli_error($connection);
                        }
                        $fet3 = mysqli_fetch_array($fetch3);
                    ?>
                <tr>
                    <td><?php echo $row4['paymentID']; ?></td> 
                    <td><?php echo $row4['contractID']; ?>&nbsp; - &nbsp; <?php echo $row["contractName"]; ?></td>
                    <td><?php echo $row4['paymentMethodID']; ?>&nbsp; - &nbsp; <?php echo $fet3["methodName"]; ?></td>
                    <td><?php echo $row4['paymentDate']; ?></td>
                    <td><?php echo $row4['amountPaid']; ?></td>
                    <td class="font-weight-bold"><?php echo $row4['amountToPay']; ?></td>
                    <td class="d-print-none"><form method="POST" action="edit.php?id=<?php echo $row4['paymentID']; ?>"><input type="submit" class="btn btn-outline-success" id="<?php echo $row4['paymentID']; ?>" value="Edit" name="editpayment2"></form></td>
                    <td class="d-print-none"><form method="POST" action="delete.php?id=<?php echo $row4['paymentID']; ?>"><input type="submit" class="btn btn-outline-danger" id="<?php echo $row4['paymentID']; ?>" value="Delete" name="deletepayment2"></form></td>
                </tr>
                    <?php } ?>

            </table>
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row mb-3 mt-2">
        <div class="col-sm-12">
            <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                <div class="text-center">
                    <button class="btn btn-danger p-2 pr-5 pl-5 d-print-none" type="button" data-toggle="modal" data-target="#deleteContract">Delete Contract</button>
                </div>
            <?php }else{ }?>
        </div>
    </div>

</div>
</div>    

<!-- Add Customer Modal  -->

<div class="modal fade" id="addContractActivity" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Contract Activity" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Contract Activity">Add Contract Activity</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                    <form method="POST" action="viewcontract-inserts.php" id="addForm">
                    <div class="form-group">
                        <label for="contractID" class="font-weight-bold">Contract ID</label>
                        <input class="form-control" type="number" id="contractID" name="contractID" value="<?php echo $row["contractID"]; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="activityID" class="font-weight-bold">Activity ID</label>
                        <input class="form-control" type="number" id="activityID" name="activityID" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="activityName" class="font-weight-bold">Activity Name</label>
                        <input class="form-control" type="text" id="activityName" name="activityName" required>
                    </div>
                    <div class="form-group">
                        <label for="activityDesc" class="font-weight-bold">Activity Description</label>
                        <textarea class="form-control" type="text" id="activityDesc" name="activityDesc" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="startDate" class="font-weight-bold">Start Date</label>
                        <input class="form-control" type="text" id="startDate" name="startDate" placeholder="Format: YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="finishDate" class="font-weight-bold">Finish Date</label>
                        <input class="form-control" type="text" id="finishDate" name="finishDate" placeholder="Format: YYYY-MM-DD">
                    </div>
                    <div class="form-group">
                        <label for="completionStatus" class="font-weight-bold">Completion Status</label>
                        <select class="form-control" id="completionStatus" name="completionStatus" required>
                            <option selected>Choose...</option>
                            <option name="CompletionStatus" value="Incomplete">Incomplete</option>
                            <option name="CompletionStatus" value="Complete">Complete</option>
                        </select>
                    </div>  
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="modalForm" value="addContractActivity">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Add Contract Activity">Add Contract Activity</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Upload Document Modal -->

    <div class="modal fade" id="addDocument" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Contract Activity" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Contract Activity">Upload Contract Document</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                <form method="POST" action="viewcontract-inserts.php" enctype="multipart/form-data" id="addForm">
                    <div class="form-group">
                        <label for="contractID" class="font-weight-bold">Contract ID</label>
                        <input class="form-control form control-lg" type="number" id="contractID" name="contractID" value="<?php echo $row["contractID"]; ?>" required readonly>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="upload" class="font-weight-bold">Document Upload</label>
                        <input class="form-control-file form control-lg mb-1" type="file" id="upload" name="upload[]" multiple aria-describedby="uploadNote">
                        <small id="uploadNote" class="form-text text-muted">Upload the file for the Contract Estimate and/or Bill. If possible upload one document at a time.</small>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="modalForm" value="addDocument">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Upload Document">Upload Document</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Add Contract Payment Modal -->

    <div class="modal fade" id="addContractPayment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Contract Payment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Contract Payment">Add Contract Payment</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                    <form method="POST" action="viewcontract-inserts.php" id="addForm">
                    <div class="form-group">
                        <label for="contractID" class="font-weight-bold">Contract ID</label>
                        <input class="form-control" type="number" id="contractID" name="contractID" value="<?php echo $row["contractID"]; ?>" required readonly>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethodID" class="font-weight-bold">Payment Method ID</label>
                        <select class="form-control" id="paymentMethodID" name="paymentMethodID" required>
                            <option selected>Choose...</option>
                            <?php

                                while($fet4 = mysqli_fetch_array($fetch4)){
                                    echo "<option value='" . $fet4["paymentMethodID"] ."'>". $fet4["paymentMethodID"]. " - ". $fet4["methodName"] ."</option>";
                                }

                            ?>
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="paymentDate" class="font-weight-bold">Payment Date</label>
                        <input class="form-control" type="text" id="paymentDate" name="paymentDate" placeholder="Format: YYYY-MM-DD HH:MM:SS" required>
                    </div>
                    <div class="form-group">
                        <label for="amountPaid" class="font-weight-bold">Amount Paid</label>
                        <input class="form-control" type="text" id="amountPaid" name="amountPaid" required>
                    </div>
                    <div class="form-group">
                        <label for="amountToPay" class="font-weight-bold">Amount Left to Pay</label>
                        <input class="form-control" type="text" id="amountToPay" name="amountToPay" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="modalForm" value="addContractPayment">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Add Contract Payment">Add Contract Payment</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Account Deletion Modal -->
    <div class="modal fade" id="deleteContract" data-toggle="modal" data-backdrop="static" tab-index="-1" role="dialog" aria-labelledby="deleteContract" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-weight-bold" id="deleteContract"> Contract Deletion</h3>
                <button type="button" class="close" data-toggle="modal" data-dismiss="modal" aria-label="Close" title="Cancel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body bg-light p-5">
            
                <div class="text-center display-3 mb-4"><i class="fas fa-exclamation-circle"></i></div>
                <p class="lead font-weight-bold h3"> Do you really want to delete this contract? </p>
                <p class="">This action is irreversible, if you choose to proceed.</p>
            
            </div>
            <div class="modal-footer">
                <form action="delete-processing.php" method="POST">
                    <input type="hidden" name="contractID" value="<?php echo $contID; ?>">
                    <input type="hidden" name="modalForm" value="deleteContract3">
                    <button type="submit" class="btn btn-danger" id="delete" name="Delete">Yes, delete contract!</button>
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-dismiss="modal" onClick="return alert('Contract deletion aborted.')">No, please cancel!</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include ('footer.php'); ?>