<!-- Login Page -->
<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Three K Contract Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/> 
  <link href="fontawesome-free-5.12.0-web/css/all.css" rel="stylesheet" type="text/css"/>
  <script src="js/jquery-3.4.1.js"></script>
  <script src="js/bootstrap.min.js"></script>
   
  <style>
      body{
        background-color: #e3f2fd;
      }
      img{
          height:300px;
          width:300px;
      }
      .signin{
        background-color: rgb(255,212,170);
        border: 1px solid #1b7b9f;
      }
  </style>

</head>
<body>

    <div class="container-fluid">

    <?php if (isset($_SESSION["error"])) { ?>
        <div class='alert alert-danger alert-dismissible' role='alert'><button type="button" class="close" data-dismiss="alert" aria-label="Close" title="Close"><i class="fas fa-times"></i></button><span class="font-weight-bold"><?= $_SESSION["error"] ?></span></div>
    <?php  } unset($_SESSION["error"]);?>

      <div class="row align-items-center">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          <div class="card border-0 bg-transparent">
          <img src="images/Three K System Logo.png" alt="Three K Services Logo" class="align-self-center"/>
          </div>
          <div class="card card-lg p-3 rounded-lg signin">
            
            <div class="card-body">
            <?php
                if(isset($_COOKIE["lock"])){
                    echo "<div class='alert alert-danger border border-danger text-center' role='alert'>3 Unsuccessful Login Attempts Have Been Made. <br> Please wait for 3 minutes.</div>";
                }else {
            ?>
            <form name="Login" method="POST" class="text-center" action="db-login-signup.php">
                <h1>Sign In</h1>
                <br>
                  <div class="form-group mb-4">
                    <input class="form-control form-control-lg" type="text" name="username" required="required" placeholder="Username"/>
                  </div>
                  
                    <div class="form-group mb-4">
                      <input class="form-control form-control-lg" type="password" name="password" id="log-pass" required="required" placeholder="Password"/>
                    </div>

                    <input type="hidden" name="form" value="Login">
                    <input class="btn btn-primary pr-5 pl-5 pt-2 pb-2" type="submit" value="Login">
              </form>
                  <br>
                  <span> Need to make a new user? <a href="signup.php">Create New User Account</a></span>
            </div>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
    <?php } ?>
</body>
</html>