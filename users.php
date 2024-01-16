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
                <h1>Users</h1>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form class="form-inline d-print-none" action="index1.php?page=users" method="POST">
                <div class="form-group">
                    <input type="text" name="valueToSearchusers" id="valueToSearchusers" class="form-control border border-info" placeholder="Search">
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
            <span class="h6" for="filteruser">Filter Results By: </span>
            <select class="col-sm-3" id="fetchval" name="filteruser">
                <option value="userID">User ID</option>
                <option value="firstName">First Name</option>
                <option value="lastName">Last Name</option>
                <option value="userRole">User Access Role</option>
                <option value="email">Email</option>
                <option value="phone">Phone Number</option>
                <option value="lastUpdated">Date Last Updated</option>
            </select>
        </div>
    </div>
    
    <br>
    <div class="row" id="source-html">
        <div class="col-sm-12" id="result">
        <br>
        <span></span>
            <form><input type="hidden" name="type" value="user"></form>
        </div>
    </div>


</div>
</div>
    
<script>
  $(document).ready(function(){
      $("#fetchval").on('change', function(){
          var value = $(this).val();
          $.ajax({
              url:"fetch-users.php",
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
   url:"fetch-users.php",
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
 $('#valueToSearchusers').keyup(function(){
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