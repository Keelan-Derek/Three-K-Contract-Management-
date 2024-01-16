<?php
    if ($_SESSION["login"] == false){
        header('location:login.php');
    }else{
?>
<?php
  //session_start();
  require_once ('dbconnect.php');
  $connection = dbconnect();
  $userid = $_SESSION["user"];

  //$contractID = $_SESSION["contractID"];

  $query = "SELECT * FROM customers";
  $ret = mysqli_query($connection, $query);

  $query2 = "SELECT * FROM service_offerings";
  $ret2 = mysqli_query($connection, $query2);

  $modalForm = "";

  if(isset($_POST["modalForm"])){
      $modalForm = $_POST["modalForm"];
  }

  if($modalForm == "addContract"){
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

    $query3 = "INSERT INTO contracts(customerID, serviceID, contractName, contractDesc, contractSite, initiationDate, deadline, endDate, contractStatus, grandTotal) 
                VALUES('$customerID', '$serviceID', '$contractName', '$contractDesc', '$contractSite', '$initiationDate', '$deadline', '$endDate', '$contractStatus', '$grandTotal')";
    $ret3 = mysqli_query($connection, $query3);

    if (isset($ret3)) {
        echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Contract succesfully added.</span> &nbsp; Please reload page to see the effectuated change.</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
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
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(205, 221, 241);">
                <h1>Contracts</h1>
                <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                    <div class="text-right">
                        <button class="btn btn-primary d-print-none" type="button" data-toggle="modal" data-target="#addContract">Add Contract</button>
                    </div>
                <?php }else{ }?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline d-print-none" action="index1.php?page=contracts" method="POST">
                <div class="form-group">
                    <input type="text" name="valueToSearchcontracts" id="valueToSearchcontracts" class="form-control border border-info" placeholder="Search">
                </div>
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-outline-info" name="search"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="col-sm-3">
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_button_email"><button class="btn btn-info d-print-none" role="button"><i class="fas fa-envelope"></i>&nbsp;Email</button></a>
                <a class="a2a_button_google_gmail"><button class="btn btn-info d-print-none" role="button"><i class="fab fa-google"></i>&nbsp;Gmail</button></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
        </div>

        <div class="col-sm-3">
            <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_button_print"><button class="btn btn-info d-print-none" role="button"><i class="fas fa-print"></i>&nbsp;Print</button></a>
                <a class="a2a_button_print"><button class="btn btn-info d-print-none" role="button"><i class="far fa-file-pdf"></i>&nbsp;Export To PDF</button></a>
            </div>
            <script async src="https://static.addtoany.com/menu/page.js"></script>
        </div>

    </div>

    <div class="row justify-content-start d-print-none">
        <div class="col-sm-6">
            <br>
            <span class="h6" for="filtercontract">Filter Results By: </span>
            <select class="col-sm-3" id="fetchval" name="filtercontract">
                <option value="contractID">Contract ID</option>
                <option value="customerID">Customer ID</option>
                <option value="serviceID">Service ID</option>
                <option value="contractName">Contract Name</option>
                <option value="contractDesc">Contract Description</option>
                <option value="site">Site</option>
                <option value="initiationDate">Initiation Date</option>
                <option value="deadline">Deadline</option>
                <option value="contractStatus">Contract Status</option>
                <option value="registryDate">Registry Date</option>
            </select>
        </div>
    </div>

    <br>
    <div class="row" id="source-html">
        <div class="col-sm-12" id="result">
        <br>
        <span></span>
            <form><input type="hidden" name="type" value="contract"></form>
        </div>
    </div>

    <!-- Add Contract Modal -->

    <div class="modal fade" id="addContract" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Contract" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Contract">Add a Contract</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                    <form method="POST" action="#" id="addForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="CustomerID" class="font-weight-bold">Customer ID</label>
                        <select class="form-control" id="CustomerID" name="CustomerID" required>
                            <option selected>Choose...</option>
                            <?php

                                while($row = mysqli_fetch_array($ret)){
                                    echo "<option value='" . $row["customerID"] ."'>". $row["customerID"]. " - ". $row["fullName"] ."</option>";
                                }

                            ?>
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="ServiceID" class="font-weight-bold">Service ID</label>
                        <select class="form-control" id="ServiceID" name="ServiceID" required>
                            <option selected>Choose...</option>
                            <?php

                                while($row = mysqli_fetch_array($ret2)){
                                    echo "<option value='" . $row["serviceID"] ."'>". $row["serviceID"]. " - ". $row["serviceName"] ."</option>";
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
                    <input type="hidden" name="modalForm" value="addContract">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Add Contract">Add Contract</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal End -->

</div>
</div>

<script>
  $(document).ready(function(){
      $("#fetchval").on('change', function(){
          var value = $(this).val();
          $.ajax({
              url:"fetch-contracts.php",
              method:"POST",
              data:"request="+value,
              beforeSend:function(){
                  $("#result").html("Filtering...");
              },
              success:function(data){
                  $("#result").html(data);
              },

          });
      });
  });
</script>

<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch-contracts.php",
   method:"POST",
   data:{query:query},
   beforeSend:function(){  
                          $('#result').html("Fetching Data...");  
                     },  
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#valueToSearchcontracts').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
  
});
</script>

<?php } ?>