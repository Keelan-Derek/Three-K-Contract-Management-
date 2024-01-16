<?php
session_start();
    include_once ('header.php');
    require_once ('dbconnect.php');
    $connection = dbconnect();
    $userid = $_SESSION["user"];

    $custID = $_GET["id"];
    $_SESSION["customerID"] = $custID;
    @$custID = $_SESSION["customerID"];

    $query = "SELECT * FROM customers WHERE customerID = '$custID'";
    $ret = mysqli_query($connection, $query);
    if(!$ret){
        echo "Error: " . mysqli_error($connection);
    }
    $row = mysqli_fetch_array($ret);

    $query2 = "SELECT * FROM contracts WHERE contracts.customerID='$custID'";
    $ret2 = mysqli_query($connection, $query2);
    if(!$ret2){
        echo "Error: " . mysqli_error($connection);
    }

    /*
    $query3 = "SELECT * FROM payments WHERE contractID=(SELECT contractID FROM contracts WHERE contracts.customerID='$custID') ORDER BY payments.contractID";
    $ret3 = mysqli_query($connection, $query3);
    if(!$ret3){
        echo "Error: " . mysqli_error($connection);
    }
    $rows = mysqli_fetch_all($ret3);
    $showRows = mysqli_use_result($rows);
    */

    $query4 = "SELECT * FROM service_offerings";
    $ret4 = mysqli_query($connection, $query4);
    if(!$ret4){
        echo "Error:" . mysqli_error($connection);
    }

    $modalForm = "";

    if(isset($_POST["modalForm"])){
        $modalForm = $_POST["modalForm"];
    }
  
    if($modalForm == "addCustContract"){
      $customerID =  mysqli_real_escape_string($connection, $_POST["CustomerID"]);
      $serviceID = mysqli_real_escape_string($connection, $_POST["ServiceID"]); 
      $contractName = mysqli_real_escape_string($connection, $_POST["contractName"]);
      $contractDesc = mysqli_real_escape_string($connection, $_POST["contractDesc"]);
      $contractSite = mysqli_real_escape_string($connection, $_POST["contractSite"]);
      $initiationDate = mysqli_real_escape_string($connection, $_POST["initiationDate"]);
      $deadline = mysqli_real_escape_string($connection, $_POST["deadline"]);
      $endDate = mysqli_real_escape_string($connection, $_POST["endDate"]);
      $contractStatus = mysqli_real_escape_string($connection, $_POST["contractStatus"]);
      $grandTotal = mysqli_real_escape_string($connection, $_POST["grandTotal"]);
  
      $query5 = "INSERT INTO contracts(customerID, serviceID, contractName, contractDesc, contractSite, initiationDate, deadline, endDate, contractStatus, grandTotal) 
                  VALUES('$customerID', '$serviceID', '$contractName', '$contractDesc', '$contractSite', '$initiationDate', '$deadline', '$endDate', '$contractStatus', '$grandTotal')";
      $ret5 = mysqli_query($connection, $query5);
  
        if($ret5) {
          echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Customer Contract succesfully added.</span> &nbsp; Please reload page to see the change effectuated.</div>';
        } else {
          echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error: ' . mysqli_error($connection) . '</div>';
        } 
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
                <h1 class="text-center"><?php echo $row['fullName']."'s"; ?> Customer Page </h1>
                <p class="lead jumbo-content text-right font-weight-bold"><span class="font-italic">Date Last Updated:  </span><?php echo $row["dateLastUpdated"]; ?></p>
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
                            <th colspan="2">Customer Information</th>
                        </thead>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Customer ID:</td>
                        <td><?php echo $row["customerID"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Customer Type:</td>
                        <td><?php echo $row["customerType"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Customer Name:</td>
                        <td><?php echo $row["fullName"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Email:</td>
                        <td><a href="mailto:<?php echo $row["email"]?>"><?php echo $row["email"]; ?></a></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Phone Number:</td>
                        <td><?php echo $row["phoneNumber"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Address:</td>
                        <td><?php echo $row["addr"]; ?></td>
                    </tr>
                    <tr>
                        <td class="font-weight-bold h6">Date of Birth </td>
                        <td><?php echo $row["DOB"]; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right bg-dark d-print-none"><form method="POST" action="edit.php?id=<?php echo $custID; ?>"><input type="submit" class="btn btn-success p-2 pr-5 pl-5" id="<?php echo $custID; ?>" value="Edit Customer" name="editcustomer2"></form></td>
                    </tr>
                </table>
                <br>
                
            </div>
        </div>
        <div class="col-sm-1"></div>
    </div>

    <div class="row">
       
        <div class="col-sm-12">
            <div class="table-responsive">
            <table class="table table-light mt-3">
                <tr>
                    <thead class="thead-dark h2">
                        <th colspan="11" class="pl-5">Customer Contracts History</th>
                        <th colspan="2">
                            <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                                <div class="text-right">
                                    <button class="btn btn-primary d-print-none" type="button" data-toggle="modal" data-target="#addCustContract">Add Customer Contract</button>
                                </div>
                            <?php }else{ }?>
                        </th>
                    </thead>
                </tr>
                <tr>
                    <thead class="thead-light h6">
                        <th>Contract ID</th>
                        <th>Service ID</th>
                        <th>Contract Name</th>
                        <th>Contract Description</th>
                        <th>Site</th>
                        <th>Initiation Date</th>
                        <th>Deadline</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Grand Total</th>
                        <th colspan="3" class="d-print-none">Commands</th>
                    </thead>
                </tr>
                    <?php
                        while($row2 = mysqli_fetch_array($ret2)){
                    ?>
                <tr>
                    <td><?php echo $row2['contractID']; ?></td>
                    <td><?php echo $row2['serviceID']; ?></td>
                    <td><?php echo $row2['contractName']; ?></td>
                    <td><?php echo $row2['contractDesc']; ?></td>
                    <td><?php echo $row2['contractSite']; ?></td>
                    <td><?php echo $row2['initiationDate']; ?></td>
                    <td><?php echo $row2['deadline']; ?></td>
                    <td><?php echo $row2['endDate']; ?></td>
                    <td><?php echo $row2['contractStatus']; ?></td>
                    <td><?php echo $row2['grandTotal']; ?></td>
                    <td class="d-print-none"> <a href="viewcontract.php?id=<?php echo $row2['contractID']; ?>"><input type="button" class="btn btn-outline-secondary" value="View"></a></td>
                    <td class="d-print-none"><form method="POST" action="edit.php?id=<?php echo $row2['contractID']; ?>"><input type="submit" class="btn btn-outline-success" id="<?php echo $row2['contractID']; ?>" value="Edit" name="editcontract2"></form></td>
                    <td class="d-print-none"><form method="POST" action="delete.php?id=<?php echo $row2['contractID']; ?>"><input type="submit" class="btn btn-outline-danger" id="<?php echo $row2['contractID']; ?>" value="Delete" name="deletecontract2"></form></td>
                </tr>
                    <?php } //$_SESSION['custContractID'] = $row2['contractID']; ?>

            </table>
            </div>
        </div>
   
    </div>

</div>
</div>


<!-- Add Contract Modal -->

<div class="modal fade" id="addCustContract" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Contract" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title" id="Add Contract">Add Customer Contract</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body p-5">
                <form method="POST" action="#" id="addForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="CustomerID" class="font-weight-bold">Customer ID</label>
                    <input class="form-control" type="nummber" id="CustomerID" name="CustomerID" value="<?php echo $row["customerID"]; ?>" readonly>
                </div>  
                <div class="form-group">
                    <label for="ServiceID" class="font-weight-bold">Service ID</label>
                    <select class="form-control" id="ServiceID" name="ServiceID" required>
                        <option selected>Choose...</option>
                        <?php

                            while($row4 = mysqli_fetch_array($ret4)){
                                echo "<option value='" . $row4["serviceID"] ."'>". $row4["serviceID"]. " - ". $row4["serviceName"] ."</option>";
                            }

                        ?>
                    </select>
                </div>  
                <div class="form-group">
                    <label for="contractName" class="font-weight-bold">Contract Name</label>
                    <input class="form-control" type="text" id="contractName" name="contractName" required>
                </div>
                <div class="form-group">
                    <label for="contractDesc" class="font-weight-bold">Contract Description</label>
                    <textarea class="form-control" type="text" id="contractDesc" name="contractDesc" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="contractSite" class="font-weight-bold">Contract Site</label>
                    <input class="form-control" type="text" id="contractSite" name="contractSite" required>
                </div>
                <div class="form-group">
                    <label for="initiationDate" class="font-weight-bold">Initiation Date</label>
                    <input class="form-control" type="text" id="initiationDate" name="initiationDate" placeholder="Format: YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="deadline" class="font-weight-bold">Deadline</label>
                    <input class="form-control" type="text" id="deadline" name="deadline" placeholder="Format: YYYY-MM-DD" required>
                </div>
                <div class="form-group">
                    <label for="endDate" class="font-weight-bold">End Date</label>
                    <input class="form-control" type="text" id="endDate" name="endDate" placeholder="Format: YYYY-MM-DD" aria-describedby="endDateNote">
                    <small id="endDateNote" class="form-text text-muted">Insert if the contract has already been completed, otherwise leave blank and fill when contract has been completed.</small>
                </div>
                <div class="form-group">
                    <label for="contractStatus" class="font-weight-bold">Contract Status</label>
                    <select class="form-control" id="contractStatus" name="contractStatus" required>
                        <option selected>Choose...</option>
                        <option name="ContractStatus" value="Initiation Pending">Initiation Pending</option>
                        <option name="ContractStatus" value="Ongoing">Ongoing</option>
                        <option name="ContractStatus" value="Completed">Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="grandTotal" class="font-weight-bold">Grand Total</label>
                    <input class="form-control" type="text" id="grandTotal" name="grandTotal" required>
                </div>
        </div>
        <div class="modal-footer">
            <div class="form-group">
                <input type="hidden" name="contractID" id="contractID">
                <input type="hidden" name="modalForm" value="addCustContract">
                <button type="submit" class="btn btn-success" name="create" id="create" value="Add Customer Contract">Add Customer Contract</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
            </form>
        </div>
    </div>
    </div>
</div>

<!-- Modal End -->


<?php include ('footer.php'); ?>