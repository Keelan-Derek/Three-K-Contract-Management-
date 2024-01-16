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

  $modalForm = "";

    if(isset($_POST["modalForm"])){
        $modalForm = $_POST["modalForm"];
    }

    if($modalForm == "addCustomer"){
        $customerType =  mysqli_real_escape_string($connection, $_POST["customerType"]);
        $fullName = mysqli_real_escape_string($connection, $_POST["customerName"]); 
        $email = mysqli_real_escape_string($connection, $_POST["customerEmail"]);
        $phone = mysqli_real_escape_string($connection, $_POST["customerPhone"]);
        $address = mysqli_real_escape_string($connection, $_POST["customerAddress"]);
        $DOB = mysqli_real_escape_string($connection, $_POST["customerDOB"]);

        $query = "INSERT INTO customers(customerType, fullName, email, phoneNumber, addr, DOB) 
                VALUES('$customerType', '$fullName', '$email', '$phone', '$address', '$DOB')";
        $ret = mysqli_query($connection, $query);
        if ($ret) {
            echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold">Customer succesfully added.</span> &nbsp; Please reload page to see the effectuated change.</div>';
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

    <div class="row">
        <div class="col-sm-12">
            <div class="jumbotron pt-5 pb-5" style="background-color: rgb(205, 221, 241);">
                <h1>Customers</h1>
                <?php if($_SESSION["accessRole"] == 'Administrator' OR $_SESSION["accessRole"] =='Administrative Staff'){?>
                    <div class="text-right">
                        <button class="btn btn-primary d-print-none" type="button" data-toggle="modal" data-target="#addCustomer">Add Customer</button>
                    </div>
                <?php }else{ }?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline d-print-none" action="index1.php?page=customers" method="POST">
                <div class="form-group">
                    <input type="text" name="valueToSearchcustomers" id="valueToSearchcustomers" class="form-control border border-info" placeholder="Search">
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
            <span class="h6" for="filtercustomer">Filter Results By: </span>
            <select class="col-sm-3" id="fetchval" name="filtercustomer">
                <option value="customerID">Customer ID</option>
                <option value="customerType">Customer Type</option>
                <option value="fullName">Full Name</option>
                <option value="email">Email</option>
                <option value="phoneNumber">Phone Number</option>
                <option value="address">Address</option>
                <option value="DOB">Date of Birth</option>
                <option value="lastUpdated">Date Last Updated</option>
            </select>
        </div>
    </div>

    <br>
    <div class="row" id="source-html">
        <div class="col-sm-12" id="result">
        <br>
        <span></span>
            <form><input type="hidden" name="type" value="customer"></form>
        </div>
    </div>

    <!-- Add Customer Modal  -->

    <div class="modal fade" id="addCustomer" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="Add Customer" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="Add Customer">Add a Customer</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body p-5">
                    <form method="POST" action="#" id="addForm">
                    <div class="form-group">
                        <label for="customerType" class="font-weight-bold">Customer Type</label>
                        <select class="form-control" id="customerType" name="customerType" required>
                            <option selected>Choose...</option>
                            <option name="CustomerType" value="Business">Business</option>
                            <option name="CustomerType" value="Individual">Individual</option>
                        </select>
                    </div>  
                    <div class="form-group">
                        <label for="customerName" class="font-weight-bold">Full Name</label>
                        <input class="form-control" type="text" id="customerName" name="customerName" required>
                    </div>
                    <div class="form-group">
                        <label for="customerEmail" class="font-weight-bold">Email</label>
                        <input class="form-control" type="text" id="customerEmail" name="customerEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="customerPhone" class="font-weight-bold">Phone Number</label>
                        <input class="form-control" type="text" id="customerPhone" name="customerPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="customerAddress" class="font-weight-bold">Address</label>
                        <input class="form-control" type="text" id="customerAddress" name="customerAddress" required>
                    </div>
                    <div class="form-group">
                        <label for="customerDOB" class="font-weight-bold">Date of Birth</label>
                        <input class="form-control" type="text" id="customerDOB" name="customerDOB" placeholder="Format: YYYY-MM-DD" required>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    <input type="hidden" name="customerID" id="customerID">
                    <input type="hidden" name="modalForm" value="addCustomer">
                    <button type="submit" class="btn btn-success" name="create" id="create" value="Add Customer">Add Customer</button>
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
              url:"fetch-customers.php",
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
   url:"fetch-customers.php",
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
 $('#valueToSearchcustomers').keyup(function(){
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