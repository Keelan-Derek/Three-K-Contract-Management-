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

  $qry1 = "SELECT * FROM contracts";
  $ret1 = mysqli_query($connection, $qry1);

  $qry2 = "SELECT * FROM payment_method";
  $ret2 = mysqli_query($connection, $qry2);

  $modalForm = "";

  if(isset($_POST["modalForm"])){
      $modalForm = $_POST["modalForm"];
  }

  if($modalForm == "addPayment"){

    $contractID = mysqli_real_escape_string($connection, $_POST["contractID"]);
    $paymentMethodID = mysqli_real_escape_string($connection, $_POST["paymentMethodID"]);
    $paymentDate = mysqli_real_escape_string($connection, $_POST["paymentDate"]);
    $amountPaid = mysqli_real_escape_string($connection, $_POST["amountPaid"]);
    $amountToPay = mysqli_real_escape_string($connection, $_POST["amountToPay"]);

    $query = "INSERT INTO payments (contractID, paymentMethodID, paymentDate, amountPaid, amountToPay)
              VALUES ('$contractID', '$paymentMethodID', '$paymentDate', '$amountPaid', '$amountToPay')";
    $ret = mysqli_query($connection, $query);

    if ($ret) {
        echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Payment succesfully added.</span> &nbsp; Please reload page to see the effectuated change.</div>';
    } else {
        echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button>Error' . mysqli_error($connection) . '</div>';
    } 
  }else if($modalForm == "addPaymentMethod"){
      $methodName =  mysqli_real_escape_string($connection, $_POST["methodName"]);

      $query2 = "INSERT INTO payment_method(methodName) 
                VALUES('$methodName')";
      $ret2 = mysqli_query($connection, $query2);

      if ($ret2) {
          echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Payment Method succesfully added.</span> &nbsp; Please reload page to see the effectuated change.</div>';
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
                <h1>Payments</h1>
                <form class="form-inline pt-3 justify-content-end">
                <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                    <div class="text-right">
                        <button class="btn btn-primary d-print-none" type="button" data-toggle="modal" data-target="#addPayment">Add Payment</button>
                    </div>
                <?php }else{ }?>
                &nbsp;&nbsp;
                <?php if($_SESSION["accessRole"] == 'Administrator'){?>
                    <div class="text-right">
                        <button class="btn btn-primary d-print-none" type="button" data-toggle="modal" data-target="#addPaymentMethod">Add Payment Method</button>
                    </div>
                <?php }else{ }?>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline d-print-none" action="index1.php?page=payments" method="POST">
                <div class="form-group">
                    <input type="text" name="valueToSearchpayments" id="valueToSearchpayments" class="form-control border border-info" placeholder="Search">
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
            <span class="h6" for="filterpayment">Filter Results By: </span>
            <select class="col-sm-3" id="fetchval" name="filterpayment">
                <option value="paymentID">Payment ID</option>
                <option value="contractID">Contract ID</option>
                <option value="paymentMethodID">Payment Method ID</option>
                <option value="paymentDate">Payment Date</option>
                <option value="amountPaid">Amount Paid</option>
                <option value="amountToPay">Amount Left to Pay</option>
            </select>
        </div>
    </div>

    <br>
    <div class="row" id="source-html">
        <div class="col-sm-12" id="result">
        <br>
        <span></span>
            <form><input type="hidden" name="type" value="payment"></form>
        </div>
    </div>

    <!-- Add Payment Modal -->

    <div class="modal fade" id="addPayment" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Payment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Payment">Add a Payment</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                    <form method="POST" action="#" id="addForm">
                    <div class="form-group">
                        <label for="contractID" class="font-weight-bold">Contract ID</label>
                        <select class="form-control" id="contractID" name="contractID" required>
                            <option selected>Choose...</option>
                            <?php

                                while($row = mysqli_fetch_array($ret1)){
                                    echo "<option value='" . $row["contractID"] ."'>". $row["contractID"]. " - ". $row["contractName"] ." (Grand Total: ". $row["grandTotal"] .")</option>";
                                }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paymentMethodID" class="font-weight-bold">Payment Method ID</label>
                        <select class="form-control" id="paymentMethodID" name="paymentMethodID" required>
                            <option selected>Choose...</option>
                            <?php

                                while($row2 = mysqli_fetch_array($ret2)){
                                    echo "<option value='" . $row2["paymentMethodID"] ."'>". $row2["paymentMethodID"]. " - ". $row2["methodName"] ."</option>";
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
                    <input type="hidden" name="modalForm" value="addPayment">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Add Payment">Add Payment</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal End -->

    <!-- Add Payment Method Modal -->

    <div class="modal fade" id="addPaymentMethod" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Payment Method" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Payment Method">Add a Payment Method</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                    <form method="POST" action="" id="addForm"> 
                    <div class="form-group">
                        <label for="methodName" class="font-weight-bold">Method Name</label>
                        <input class="form-control" type="text" id="methodName" name="methodName" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="modalForm" value="addPaymentMethod">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Add Payment Method">Add Payment Method</button>
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
              url:"fetch-payments.php",
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
   url:"fetch-payments.php",
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
 $('#valueToSearchpayments').keyup(function(){
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