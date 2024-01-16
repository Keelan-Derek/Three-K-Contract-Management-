<!-- Login Page -->

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
          height:150px;
          width:150px;
      }
      .signup{
        background-color: rgb(255,212,170);
        border: 1px solid #1b7b9f;
      }
      #userRole1, #userRole2, #userRole3{
          width:30px;
          height:20px;
      }
  </style>

</head>
<body>

    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
        <div class="card border-0 bg-transparent">
          <img src="images/Three K System Logo.png" alt="Three K Services Logo" class="align-self-center"/>
          </div>
          <div class="card p-3 rounded-lg signup">
            <div class="card-body">
            <h1 class="text-center">Create a User Account</h1>
            <hr>
            <form name="Signup" method="post" class="text-center" action="db-login-signup.php">
                <h3 class="text-center">Personal Information</h3>
                <hr>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6 mb-4">
                            <input class="form-control form-control-lg" type="text" name="firstname" required="required" placeholder="First Name"/>
                        </div>
                        
                        <div class="form-group col-12 col-md-6 mb-4">
                            <input class="form-control form-control-lg" type="text" name="lastname" required="required" placeholder="Last Name"/>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-md-6">
                            <input class="form-control form-control-lg" type="text" name="email" required="required" placeholder="Email"/>
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <input class="form-control form-control-lg" type="text" name="phoneNumber" required="required" placeholder="Phone Number"/>
                        </div>
                    </div>
                <hr>
                <h3 class="text-center">Account Credentials</h3>
                <hr>
           
                    <div class="form-row">
                        <div class="form-group col-12 col-md-4 mb-0">
                            <h5 class="text-center"><label for="userRole">User Access Role:</label></h5>
                        </div>
                        <div class="form-group mt-0 col-12 col-md-8">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userRole" id="userRole1" value="Administrator">
                                <label class="form-check-label" for="userRole1"> Administrator </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userRole" id="userRole2" value="Administrative Staff">
                                <label class="form-check-label" for="userRole2"> Administrative Staff </label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="userRole" id="userRole3" value="Project Manager">
                                <label class="form-check-label" for="userRole3"> Project Manager </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input class="form-control form-control-lg" type="text" name="username" required="required" placeholder="Username"/>
                    </div>
                    
                    <div class="form-group mb-4">
                        <input class="form-control form-control-lg" type="password" name="password" id="log-pass" required="required" placeholder="Password"/>
                    </div>
                    
                    <input type="hidden" name="form" value="Signup">
                    <input class="btn btn-primary pr-5 pl-5 pt-3 pb-3" type="submit" value="Create User">

              </form>
                  <br>
                  <a href="login.php"><input class="btn text-center btn-outline-dark" value="Back"></a> 
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>

</body>
</html>